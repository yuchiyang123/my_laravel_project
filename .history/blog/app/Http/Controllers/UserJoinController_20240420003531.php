<?php

namespace App\Services;
namespace App\Http\Controllers;

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

use function Symfony\Component\HttpKernel\Log\record;

class UserJoinController extends Controller
{
    //加入表單
    public function join_mjoin_form($mjoinId){
        $check_YoN = UserPostMjoin::where('id',$mjoinId)->first();
        $check = UserPostMjoin::where('posted_by_u',Auth::user()->username)->where('id',$mjoinId)->first();
        $check_repeat = User_join_mjoin::where('user_id',Auth::user()->id)->where('article_id',$mjoinId)->first();
        //登入判斷
        if(!Auth::check()){
            return redirect('/login');
        }
        //驗證電話判斷
        if(Auth::user()->verify == 'no'){
            return redirect('/user_verify_phone')->with('error','加入揪團前請先完成驗證電話號碼');
        }   
        //判斷是否已經加入過 and 判斷是否為自己加入 and 判斷是否已經發表過
        if($check || $check_repeat || !$check_YoN || $check && $check_repeat&&!$check_YoN){
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
    public function join_mjoin_form_submit(Request $request,$mjoinId){
        dd($request);
        $check_YoN = UserPostMjoin::where('id',$mjoinId)->first();
        $check = UserPostMjoin::where('posted_by_u',Auth::user()->username)->where('id',$mjoinId)->first();
        $check_repeat = User_join_mjoin::where('user_id',Auth::user()->id)->where('article_id',$mjoinId)->first();
        //登入判斷
        if(!Auth::check()){
            return redirect('/login');
        }
        //驗證電話判斷
        if(Auth::user()->verify == 'no'){
            return redirect('/user_verify_phone')->with('error','加入揪團前請先完成驗證電話號碼');
        }   
        //判斷是否已經加入過 and 判斷是否為自己加入 and 判斷是否已經發表過
        if($check || $check_repeat || !$check_YoN || $check && $check_repeat&&!$check_YoN){
            return redirect()->route('error');
        }
        $validator = Validator::make($request->all(), [
            'email' =>'required|email|max:255',
            'phone' =>'required|max:255',
            'content' =>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $User_join_mjoin = new User_join_mjoin();
        $User_join_mjoin->user_id = Auth::user()->id;
        $User_join_mjoin->article_id = $mjoinId;
        $User_join_mjoin->content = $request->content;
        $User_join_mjoin->save();
        return redirect('/user_join_mjoin_success');
    }
}