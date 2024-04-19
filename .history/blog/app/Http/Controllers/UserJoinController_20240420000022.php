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
        dd($User_infor);
        $User_infor = DB::table('user')
                        ->select('user.*','user_phone.phone','mjoin.title')
                        ->leftJoin('user_phone','user.id','=','user_phone.user_id')
                        ->rightJoin('mjoin','user.username','=','mjoin.posted_by_u')
                        ->where('user.id',Auth::user()->id)
                        ->where('mjoin.id',$mjoinId)
                        ->first();
        return view('auth.join_mjoin_form', compact('User_infor'));
    }
}