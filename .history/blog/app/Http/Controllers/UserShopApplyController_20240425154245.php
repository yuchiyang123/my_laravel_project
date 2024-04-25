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
use App\Models\Shop_apply;


use function Symfony\Component\HttpKernel\Log\record;

class UserShopApplyController extends Controller
{
    public function shop_apply_form()
    {

    
        if(!Auth::check()){
            return redirect('/login')->with('error', '請先登入');;
        }
        if(Auth::user()->permissions != 3 &&  1){
            return redirect('/work')->with('error', '您已經是店家了');;
        }
        return view('auth.usershop_applyform');
    }

    public function shop_score_form_submit(Request $request)
    {
        $apply = 
        if(!Auth::check()){
            return redirect('/login')->with('error', '請先登入');;
        }
        if(Auth::user()->permissions != 3 &&  1){
            return redirect('/work')->with('error', '您已經是店家了');;
        }
    }
}