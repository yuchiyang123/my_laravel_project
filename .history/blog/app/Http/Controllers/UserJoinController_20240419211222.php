<?php

namespace App\Services;
namespace App\Http\Controllers;

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
    public function join_mjoin_form(){
        if(Auth::check()){
            if(Auth::user()->verify == 'yes'){
                return view('auth.join_mjoin_form');
            } else {
                return view('/user_verify_phone')->with('error','加入要驗證電話號碼喔');
            }
            
        } else {
            return redirect('/login');
        }
        
    }
}