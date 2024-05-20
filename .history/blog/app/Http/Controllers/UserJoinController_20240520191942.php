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
use App\Models\Shop_join;
use App\Models\UserPostWork;


use function Symfony\Component\HttpKernel\Log\record;

class UserJoinController extends Controller
{
    //加入表單
    public function join_mjoin_form($mjoinId)
    {
            //$check_YoN = UserPostMjoin::where('id', $mjoinId)->exists();
            $check = UserPostMjoin::where('posted_by_u', Auth::user()->username)->whereNotIn('status',['complete','del','end'])
                                ->exists();
            //dd($check);
            /*$check_repeat = User_join_mjoin::where('user_id', Auth::user()->id)
                                        ->where('article_id', $mjoinId)
                                        ->exists();*/
            $limit_join = User_join_mjoin::where('user_id', Auth::user()->id)
                                        ->whereNotIn('status', ['complete', 'exit','end','del'])
                                        ->exists();

            
                                        

                                        
        //dd($check,$check_repeat,$limit_join);
        //登入判斷
        if(!Auth::check()){
            return redirect('/login');
        }
        //驗證電話判斷
        if(Auth::user()->verify == 'no'){
            return redirect('/user_verify_phone')->with('error','加入揪團前請先完成驗證電話號碼');
        } 
        
        if($limit_join) {
            return redirect('/front')->with('error', '一人只能加入一個揪團，或是你的揪團正在申請中，請耐心等候');
        }
        
        //判斷是否已經加入過 and 判斷是否為自己加入 and 判斷是否已經發表過
        if($check){
            return redirect('/front')->with('error', '一人只能加入一個揪團，或是你的揪團正在申請中，請耐心等候');
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
    public function join_mjoin_submit(Request $request,$mjoinId)
    {
        // 登入判斷
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 驗證電話判斷
        if (Auth::user()->verify == 'no') {
            return redirect('/user_verify_phone')->with('error', '加入揪團前請先完成驗證電話號碼');
        }

        // 檢查是否存在該揪團
        $check_YoN = UserPostMjoin::where('id', $mjoinId)->first();
        if (!$check_YoN) {
            return redirect()->route('error')->with('error', '揪團不存在');
        }

        // 判斷是否為自己發表的揪團
        $check = UserPostMjoin::where('posted_by_u', Auth::user()->username)
                              ->where('id', $mjoinId)
                              ->exists();

        // 判斷是否重複加入揪團
        $check_repeat = User_join_mjoin::where('user_id', Auth::user()->id)
                                       ->where('article_id', $mjoinId)
                                       ->exists();

        // 判斷是否已經有其他正在進行的揪團
        $limit_join = User_join_mjoin::where('user_id', Auth::user()->id)
                                     ->whereNotIn('status', ['complete', 'exit', 'end', 'del'])
                                     ->exists();

        // 判斷是否已經加入過或是自己發表的揪團
        if ($check || $check_repeat) {
            return redirect()->route('error')->with('error', '不能加入自己發表的揪團或重複加入揪團');
        }

        // 判斷是否已經有其他正在進行的揪團
        if ($limit_join) {
            return redirect()->route('front')->with('error', '一人只能加入一個揪團，或是你的揪團正在申請中，請耐心等候');
        }

        // 檢查必填字段是否有空值
        $requiredFields = [
            'sex' => '性別',
            'age' => '年齡',
            'preferences' => '偏好',
            'foodallergy' => '食物過敏',
            'languages' => '語言',
            'license' => '駕照',
            'contact_method' => '聯絡方式',
            'editor' => '內容'
        ];

        foreach ($requiredFields as $field => $fieldName) {
            if (!$request->filled($field)) {
                return back()->with('error', "{$fieldName}不能為空");
            }
        }

        // 創建新的 User_join_mjoin
        $User_join_mjoin = new User_join_mjoin();
        $User_join_mjoin->user_id = Auth::user()->id;
        $User_join_mjoin->article_id = $mjoinId;
        $User_join_mjoin->sex = $request->input('sex');
        $User_join_mjoin->age = $request->input('age');

        $preferences = $request->input('preferences', []);
        $foodallergy = $request->input('foodallergy', []);
        $languages = $request->input('languages', []);
        $license = $request->input('license', []);
        $contact_method = $request->input('contact_method', []);

        $User_join_mjoin->preferences = implode(',', $preferences);
        $User_join_mjoin->foodallergy = implode(',', $foodallergy);
        $User_join_mjoin->languages = implode(',', $languages);
        $User_join_mjoin->license = implode(',', $license);
        $User_join_mjoin->contact_method = implode(',', $contact_method);
        $User_join_mjoin->editor = $request->input('editor');
        $User_join_mjoin->status = 'pending';
        $User_join_mjoin->save();

        // 創建新的 User_notify_mjoin
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
        if (!Auth::check()) {
            return redirect('/login');
        }
    
        // Fetch the User_join_mjoin record
        $review_join_mjoin = User_join_mjoin::find($joinId);
    
        if (!$review_join_mjoin) {
            return redirect()->route('error');
        }
    
        // Fetch the user associated with the User_join_mjoin record
        $review_join_user = User::find($review_join_mjoin->user_id);
    
        if (!$review_join_user) {
            return redirect()->route('error');
        }
    
        // Calculate scores
        /*$averageScore = DB::table('mjoin_score')
            ->select(DB::raw('ROUND(AVG(score), 1) AS average_score'))
            ->leftJoin('user', 'mjoin_score.evaluated_id', '=', 'user.id')
            ->where('user.id', $review_join_user->id)
            ->value('average_score');
    
        $averageScoreShop = DB::table('shop_score')
            ->select(DB::raw('ROUND(AVG(score), 1) AS shop_score'))
            ->leftJoin('user', 'shop_score.evaluated_id', '=', 'user.id')
            ->where('user.id', $review_join_user->id)
            ->value('shop_score');
    
        $totalScore = DB::table('mjoin_score')
            ->select(DB::raw('SUM(score) AS total_score'))
            ->leftJoin('user', 'mjoin_score.evaluated_id', '=', 'user.id')
            ->where('user.id', $review_join_user->id)
            ->value('total_score');
    
        $totalScoreShop = DB::table('shop_score')
            ->select(DB::raw('SUM(score) AS total_score_shop'))
            ->leftJoin('user', 'shop_score.evaluated_id', '=', 'user.id')
            ->where('user.id', $review_join_user->id)
            ->value('total_score_shop');
    
        $totalCount = DB::table('mjoin_score')
            ->leftJoin('user', 'mjoin_score.evaluated_id', '=', 'user.id')
            ->where('user.id', $review_join_user->id)
            ->count();
    
        $totalCountShop = DB::table('shop_score')
            ->leftJoin('user', 'shop_score.evaluated_id', '=', 'user.id')
            ->where('user.id', $review_join_user->id)
            ->count();
    
        if (($totalCount + $totalCountShop) != 0) {
            $averageTotalScore = round(($totalScore + $totalScoreShop) / ($totalCount + $totalCountShop), 1);
        } else {
            // Handle the case where the denominator is zero
            $averageTotalScore = 0; // or another default value
        }*/
    
        // Calculate the age
        $age = Carbon::parse($review_join_mjoin->age)->age;
    
        return view('auth.review_join_mjoin', compact('review_join_mjoin', 'review_join_user', 'age'));

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


    //打工加入
    public function join_shop_form($shopId)
    {

        $check_YoN = UserPostWork::where('id',$shopId)->first();
        $check = UserPostWork::where('posted_by_u',Auth::user()->username)->where('status','pending')->first();
        $check_repeat = Shop_join::where('user_id',Auth::user()->id)->where('article_id',$shopId)->first();
        $limit_join = Shop_join::where('user_id',Auth::user()->id)
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
            session()->flash('error', '請勿重複加入打工');
            return redirect('/work');
        }
        if($limit_join) {
            return redirect('/work')->with('error', '一人只能加入一個打工，或是你的打工正在申請中，請耐心等候');
        }
        
        //判斷是否已經加入過 and 判斷是否為自己加入 and 判斷是否已經發表過
        /*if( $check||$check_repeat || !$check_YoN){
            return redirect()->route('error');
        }*/
        if($check){
            return redirect('/work')->with('error', '一人只能加入一個打工，或是你的打工正在申請中，請耐心等候');
        }
        if($check_You->posted_by_u != Auth::user()->username){
            
        }

        $User_infor = DB::table('user')
                        ->select('user.*','user_phone.phone')
                        ->leftJoin('user_phone','user.id','=','user_phone.user_id')
                        ->where('user.id',Auth::user()->id)
                        ->first();
        $User_shop_infor = UserPostWork::where('id',$shopId)->first();
        //dd($User_infor);
        return view('auth.join_shop_form', compact('User_infor','User_shop_infor'));
    }

    //表單送出
    public function join_shop_submit(Request $request,$shopId){
        $check_YoN = UserPostWork::where('id',$shopId)->first();
        $check = UserPostWork::where('posted_by_u',Auth::user()->username)->where('id',$shopId)->first();
        $check_repeat = Shop_join::where('user_id',Auth::user()->id)->where('article_id',$shopId)->first();
        $limit_join = Shop_join::where('user_id',Auth::user()->id)->first();
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
            return redirect()->route('work')->with('error', '一人只能加入一個揪團~');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:15',
            'expected_salary' => 'required|array',
            'personality' => 'required|array',
            'driving_license' => 'required|string',
            'availability' => 'required|string',
            'work_experience' => 'required|string',
            'motivation' => 'required|string'
        ], [
            'name.required' => '申請者姓名不能為空',
            'email.required' => '申請者電子郵件地址不能為空',
            'contact_number.required' => '申請者聯繫電話不能為空',
            'expected_salary.required' => '期望的待遇不能為空',
            'personality.required' => '申請者的個性描述不能為空',
            'driving_license.required' => '是否持有駕照不能為空',
            'availability.required' => '可工作時間不能為空',
            'work_experience.required' => '工作經驗不能為空',
            'motivation.required' => '申請工作的動機不能為空'
        ]);
        $User_join_mjoin = new Shop_join();
        $User_join_mjoin->user_id = Auth::user()->id;
        $User_join_mjoin->article_id = $shopId;

        // 定義所有可能出現的名稱
        $names = ['name','email','contact_number', 'editor','expected_salary','driving_license','personality', 'availability', 'work_experience', 'motivation'];

        // 逐一檢查是否有表單中的名稱存在，若存在則設置對應的屬性值
        foreach ($names as $name) {
            if ($request->has($name)) {
                $inputValue = $request->input($name);
                
                // 如果是 checkbox，則轉換為字串
                if (is_array($inputValue)) {
                    $inputValue = implode(',', $inputValue);
                }
                
                // 設置屬性值
                $User_join_mjoin->$name = $inputValue;
            }
        }

        // 保存資料
        $User_join_mjoin->status = 'pending';
        $User_join_mjoin->save();



        return redirect('/success')->with('go','成功');
    }
    //審核表單
    
    public function review_shop_form($joinId)
    {
        if(!Auth::check()){
            return redirect('/login');
        }
        $review_join_shop = shop_join::where('id',$joinId)->first();
        //$review_join_mjoins = User_notify_mjoin::where('id',$joinId)->first();
        $review_join_user = User::where('id',$review_join_shop->user_id)->first();
        if(!$review_join_shop){
            return redirect()->route('error');
        }
        //分數
        /*$averageScore = DB::table('mjoin_score')
        ->select(DB::raw('ROUND(AVG(score), 1) AS average_score'))
        ->leftJoin('user', 'mjoin_score.evaluated_id', '=', 'user.id')
        ->where('user.username', $review_join_user)
        ->value('average_score');
        $averageScore_shop = DB::table('shop_score')
            ->select(DB::raw('ROUND(AVG(score), 1) AS shop_score'))
            ->leftJoin('user', 'shop_score.evaluated_id', '=', 'user.id')
            ->where('user.username', $review_join_user)
            ->value('shop_score');

        $totalScore = DB::table('mjoin_score')
            ->select(DB::raw('SUM(score) AS total_score'))
            ->leftJoin('user', 'mjoin_score.evaluated_id', '=', 'user.id')
            ->where('user.username', $review_join_user)
            ->value('total_score');
        
        $totalScoreShop = DB::table('shop_score')
            ->select(DB::raw('SUM(score) AS total_score_shop'))
            ->leftJoin('user', 'shop_score.evaluated_id', '=', 'user.id')
            ->where('user.username', $review_join_user)
            ->value('total_score_shop');
        
        $totalCount = DB::table('mjoin_score')
            ->leftJoin('user', 'mjoin_score.evaluated_id', '=', 'user.id')
            ->where('user.username', $review_join_user)
            ->count();
        
        $totalCountShop = DB::table('shop_score')
            ->leftJoin('user', 'shop_score.evaluated_id', '=', 'user.id')
            ->where('user.username', $review_join_user)
            ->count();
        
        if (($totalCount + $totalCountShop) != 0) {
            $averageTotalScore = round(($totalScore + $totalScoreShop) / ($totalCount + $totalCountShop), 1);
        } else {
            // 分母為零時的處理方式，例如設置平均分數為0或其他預設值
            $averageTotalScore = 0; // 或者其他預設值
        }*/

        //$age = Carbon::parse($review_join_mjoin->age)->age;
        return view('auth.review_join_shop', compact('review_join_shop','review_join_user'));

    }

    public function review_shop_pass($joinId)
    {
        //$review_join_mjoin = User_notify_mjoin::where('join_id',$joinId)->first();
        //$review_join_user = User::where('id',$review_join_mjoin->user_id)->first();
        $review_join_shop_join = shop_join::where('id',$joinId)->first();
        //dd($review_join_shop_join);
        if(!$review_join_shop_join){
            return redirect()->route('error');
        }
        $review_join_shop_join->status = 'pass';
        $review_join_shop_join->update();
        return redirect('/success')->with('go','成功');
    }
    public function review_shop_reject($joinId)
    {
       
        //$review_join_user = User::where('id',$review_join_mjoin->user_id)->first();
        $review_join_shop_join = shop_join::where('id',$joinId)->first();
        if(!$review_join_shop_join){
            return redirect()->route('error');
        }
        $review_join_shop_join->status = 'rejected';
        $review_join_shop_join->update();
        return redirect('/success')->with('go','成功');
    }
}