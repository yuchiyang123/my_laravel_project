<?php

namespace App\Services;
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UserPostMjoin;
use App\Models\Mjoin_reply;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Auth\SendActionLink;
use Kreait\Firebase\Auth\SendActionLink\RawOobCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserRecord;
use App\Models\UserPostArkwork;
use App\Models\Artwork_reply;
use Illuminate\Http\Request;
use App\Models\UserGood;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Messaging\CloudMessage;
use App\Models\User_phone;
use App\Models\User_join_mjoin;
use App\Models\User_notify_mjoin;
use App\Models\Shop_Join;

use function Symfony\Component\HttpKernel\Log\record;

class UserJoinController extends Controller
{
    //加入表單
    public function join_mjoin_form($mjoinId){
        $check_YoN = UserPostMjoin::where('id',$mjoinId)->first();
        $check = UserPostMjoin::where('posted_by_u',Auth::user()->username)->where('id',$mjoinId)->first();
        $check_repeat = User_join_mjoin::where('user_id',Auth::user()->id)->where('article_id',$mjoinId)->first();
        $limit_join = User_join_mjoin::where('user_id',Auth::user()->id)
                                        ->where('status','<>','complete,exit')->first();
        //登入判斷
        if(!Auth::check()){
            return redirect('/login');
        }
        //驗證電話判斷
        if(Auth::user()->verify == 'no'){
            return redirect('/user_verify_phone')->with('error','加入揪團前請先完成驗證電話號碼');
        } 
        if($check_repeat){
            session()->flash('error', '請勿重複加入揪團');
            return redirect('/front');
        }
        if($limit_join) {
            return redirect('/front')->with('error', '一人只能加入一個揪團，或是你的揪團正在申請中，請耐心等候');
        }
        
        //判斷是否已經加入過 and 判斷是否為自己加入 and 判斷是否已經發表過
        if( $check||$check_repeat || !$check_YoN){
            return redirect()->route('error');
        }
        
        $User_infor = DB::table('user')
                        ->select('user.*','user_phone.phone')
                        ->leftJoin('user_phone','user.id','=','user_phone.user_id')
                        ->where('user.id',Auth::user()->id)
                        ->first();
        $User_mjoin_infor = UserPostMjoin::where('id',$mjoinId)->first();
        //dd($User_infor);
        return view('auth.join_mjoin_form', compact('User_infor','User_mjoin_infor'));
    }

    //表單送出
    public function join_mjoin_submit(Request $request,$mjoinId){
        $check_YoN = UserPostMjoin::where('id',$mjoinId)->first();
        $check = UserPostMjoin::where('posted_by_u',Auth::user()->username)->where('id',$mjoinId)->first();
        $check_repeat = User_join_mjoin::where('user_id',Auth::user()->id)->where('article_id',$mjoinId)->first();
        $limit_join = User_join_mjoin::where('user_id',Auth::user()->id)->first();
        //登入判斷
        if(!Auth::check()){
            return redirect('/login');
        }
        //驗證電話判斷
        if(Auth::user()->verify == 'no'){
            return redirect('/user_verify_phone')->with('error','加入揪團前請先完成驗證電話號碼');
        }   
        //判斷是否已經加入過 and 判斷是否為自己加入 and 判斷是否已經發表過
        if($check || $check_repeat || !$check_YoN){
            return redirect()->route('error');
        }
        if($limit_join) {
            return redirect()->route('front')->with('error', '一人只能加入一個揪團~');
        }

        $User_join_mjoin = new User_join_mjoin();
        $User_join_mjoin->user_id = Auth::user()->id;
        $User_join_mjoin->article_id = $mjoinId;
        $User_join_mjoin->sex = $request->input('sex');
        $User_join_mjoin->age = $request->input('age');
        $preferences = $request->input('preferences');
        $foodallergy = $request->input('foodallergy');
        $languages = $request->input('languages');
        $license = $request->input('license');
        $contact_method = $request->input('contact_method');

        // 將陣列轉換為以逗號分隔的字串，如果陣列為空則設置為空字串
        $preferencesString = !empty($preferences) ? implode(',', $preferences) : '';
        $foodallergyString = !empty($foodallergy) ? implode(',', $foodallergy) : '';
        $languagesString = !empty($languages) ? implode(',', $languages) : '';
        $licenseString = !empty($license) ? implode(',', $license) : '';
        $contactMethodString = !empty($contact_method) ? implode(',', $contact_method) : '';

        // 將轉換後的字串賦值給相應的屬性
        $User_join_mjoin->preferences = $preferencesString;
        $User_join_mjoin->foodallergy = $foodallergyString;
        $User_join_mjoin->languages = $languagesString;
        $User_join_mjoin->license = $licenseString;
        $User_join_mjoin->contact_method = $contactMethodString;

        $User_join_mjoin->editor = $request->input('editor');
        $User_join_mjoin->status = 'pending';
        $User_join_mjoin->save();

        $User_join_notify_mjoin = new User_notify_mjoin();
        $User_join_notify_mjoin->user_id = Auth::user()->id;
        $User_join_notify_mjoin->article_id = $mjoinId;
        $User_join_notify_mjoin->join_id = $User_join_mjoin->id;
        $User_join_notify_mjoin->status = 'pending';
        $User_join_notify_mjoin->save();

        return redirect('/success');
    }
    //審核表單
    public function review_mjoin_form($joinId)
    {
        if(!Auth::check()){
            return redirect('/login');
        }
        $review_join_mjoin = User_join_mjoin::where('id',$joinId)->first();
        //$review_join_mjoins = User_notify_mjoin::where('id',$joinId)->first();
        $review_join_user = User::where('id',$review_join_mjoin->user_id)->first();
        if(!$review_join_mjoin){
            return redirect()->route('error');
        }
        

        $age = Carbon::parse($review_join_mjoin->age)->age;
        return view('auth.review_join_mjoin', compact('review_join_mjoin','review_join_user','age'));

    }

    public function review_mjoin_pass($joinId)
    {
        $review_join_mjoin = User_notify_mjoin::where('join_id',$joinId)->first();
        //$review_join_user = User::where('id',$review_join_mjoin->user_id)->first();
        $review_join_mjoin_join = User_join_mjoin::where('id',$joinId)->first();
        if(!$review_join_mjoin){
            return redirect()->route('error');
        }
        $review_join_mjoin->status = 'pass';
        $review_join_mjoin->save();
        $review_join_mjoin_join->status = 'pass';
        $review_join_mjoin_join->save();
        return redirect('/success');
    }
    public function review_mjoin_reject($joinId)
    {
        $review_join_mjoin = User_notify_mjoin::where('id',$joinId)->first();
        //$review_join_user = User::where('id',$review_join_mjoin->user_id)->first();
        $review_join_mjoin_join = User_join_mjoin::where('id',$joinId)->first();
        if(!$review_join_mjoin){
            return redirect()->route('error');
        }
        $review_join_mjoin->status = 'rejected';
        $review_join_mjoin->save();
        $review_join_mjoin_join->status = 'rejected';
        $review_join_mjoin_join->save();
        return redirect('/success');
    }

    public function join_mjoin_form($mjoinId){
        $check_YoN = UserPostMjoin::where('id',$mjoinId)->first();
        $check = UserPostMjoin::where('posted_by_u',Auth::user()->username)->where('id',$mjoinId)->first();
        $check_repeat = User_join_mjoin::where('user_id',Auth::user()->id)->where('article_id',$mjoinId)->first();
        $limit_join = User_join_mjoin::where('user_id',Auth::user()->id)
                                        ->where('status','<>','complete,exit')->first();
        //登入判斷
        if(!Auth::check()){
            return redirect('/login');
        }
        //驗證電話判斷
        if(Auth::user()->verify == 'no'){
            return redirect('/user_verify_phone')->with('error','加入揪團前請先完成驗證電話號碼');
        } 
        if($check_repeat){
            session()->flash('error', '請勿重複加入揪團');
            return redirect('/front');
        }
        if($limit_join) {
            return redirect('/front')->with('error', '一人只能加入一個揪團，或是你的揪團正在申請中，請耐心等候');
        }
        
        //判斷是否已經加入過 and 判斷是否為自己加入 and 判斷是否已經發表過
        if( $check||$check_repeat || !$check_YoN){
            return redirect()->route('error');
        }
        
        $User_infor = DB::table('user')
                        ->select('user.*','user_phone.phone')
                        ->leftJoin('user_phone','user.id','=','user_phone.user_id')
                        ->where('user.id',Auth::user()->id)
                        ->first();
        $User_mjoin_infor = UserPostMjoin::where('id',$mjoinId)->first();
        //dd($User_infor);
        return view('auth.join_mjoin_form', compact('User_infor','User_mjoin_infor'));
    }

    //表單送出
    public function join_mjoin_submit(Request $request,$mjoinId){
        $check_YoN = UserPostMjoin::where('id',$mjoinId)->first();
        $check = UserPostMjoin::where('posted_by_u',Auth::user()->username)->where('id',$mjoinId)->first();
        $check_repeat = User_join_mjoin::where('user_id',Auth::user()->id)->where('article_id',$mjoinId)->first();
        $limit_join = User_join_mjoin::where('user_id',Auth::user()->id)->first();
        //登入判斷
        if(!Auth::check()){
            return redirect('/login');
        }
        //驗證電話判斷
        if(Auth::user()->verify == 'no'){
            return redirect('/user_verify_phone')->with('error','加入揪團前請先完成驗證電話號碼');
        }   
        //判斷是否已經加入過 and 判斷是否為自己加入 and 判斷是否已經發表過
        if($check || $check_repeat || !$check_YoN){
            return redirect()->route('error');
        }
        if($limit_join) {
            return redirect()->route('front')->with('error', '一人只能加入一個揪團~');
        }

        $User_join_mjoin = new User_join_mjoin();
        $User_join_mjoin->user_id = Auth::user()->id;
        $User_join_mjoin->article_id = $mjoinId;
        $User_join_mjoin->sex = $request->input('sex');
        $User_join_mjoin->age = $request->input('age');
        $preferences = $request->input('preferences');
        $foodallergy = $request->input('foodallergy');
        $languages = $request->input('languages');
        $license = $request->input('license');
        $contact_method = $request->input('contact_method');

        // 將陣列轉換為以逗號分隔的字串，如果陣列為空則設置為空字串
        $preferencesString = !empty($preferences) ? implode(',', $preferences) : '';
        $foodallergyString = !empty($foodallergy) ? implode(',', $foodallergy) : '';
        $languagesString = !empty($languages) ? implode(',', $languages) : '';
        $licenseString = !empty($license) ? implode(',', $license) : '';
        $contactMethodString = !empty($contact_method) ? implode(',', $contact_method) : '';

        // 將轉換後的字串賦值給相應的屬性
        $User_join_mjoin->preferences = $preferencesString;
        $User_join_mjoin->foodallergy = $foodallergyString;
        $User_join_mjoin->languages = $languagesString;
        $User_join_mjoin->license = $licenseString;
        $User_join_mjoin->contact_method = $contactMethodString;

        $User_join_mjoin->editor = $request->input('editor');
        $User_join_mjoin->status = 'pending';
        $User_join_mjoin->save();

        $User_join_notify_mjoin = new User_notify_mjoin();
        $User_join_notify_mjoin->user_id = Auth::user()->id;
        $User_join_notify_mjoin->article_id = $mjoinId;
        $User_join_notify_mjoin->join_id = $User_join_mjoin->id;
        $User_join_notify_mjoin->status = 'pending';
        $User_join_notify_mjoin->save();

        return redirect('/success');
    }
    //審核表單
    public function review_mjoin_form($joinId)
    {
        if(!Auth::check()){
            return redirect('/login');
        }
        $review_join_mjoin = User_join_mjoin::where('id',$joinId)->first();
        //$review_join_mjoins = User_notify_mjoin::where('id',$joinId)->first();
        $review_join_user = User::where('id',$review_join_mjoin->user_id)->first();
        if(!$review_join_mjoin){
            return redirect()->route('error');
        }
        

        $age = Carbon::parse($review_join_mjoin->age)->age;
        return view('auth.review_join_mjoin', compact('review_join_mjoin','review_join_user','age'));

    }

    public function review_mjoin_pass($joinId)
    {
        $review_join_mjoin = User_notify_mjoin::where('join_id',$joinId)->first();
        //$review_join_user = User::where('id',$review_join_mjoin->user_id)->first();
        $review_join_mjoin_join = User_join_mjoin::where('id',$joinId)->first();
        if(!$review_join_mjoin){
            return redirect()->route('error');
        }
        $review_join_mjoin->status = 'pass';
        $review_join_mjoin->save();
        $review_join_mjoin_join->status = 'pass';
        $review_join_mjoin_join->save();
        return redirect('/success');
    }
    public function review_mjoin_reject($joinId)
    {
        $review_join_mjoin = User_notify_mjoin::where('id',$joinId)->first();
        //$review_join_user = User::where('id',$review_join_mjoin->user_id)->first();
        $review_join_mjoin_join = User_join_mjoin::where('id',$joinId)->first();
        if(!$review_join_mjoin){
            return redirect()->route('error');
        }
        $review_join_mjoin->status = 'rejected';
        $review_join_mjoin->save();
        $review_join_mjoin_join->status = 'rejected';
        $review_join_mjoin_join->save();
        return redirect('/success');
    }
}