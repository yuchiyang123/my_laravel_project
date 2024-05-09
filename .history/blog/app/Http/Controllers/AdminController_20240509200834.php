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
use App\Models\MjoinScore;
use App\Models\User_notify_mjoin;
use App\Models\User_join_mjoin;
use App\Models\UserPostMjoin;
use App\Models\WorkScore;
use App\Models\Shop_join;
use App\Models\UserPostWork;

use function Laravel\Prompts\alert;
use function Symfony\Component\HttpKernel\Log\record;

class AdminController extends Controller
{
    public function admin_index()
    {
        return view('admin.index2');
    }

    public function user_auth()
    {
        $users = User::join('user_phone', 'user.id', '=', 'user_phone.user_id')
                        ->select('user.*', 'user_phone.phone_number')
                        ->get();
        //$user_phone = User_phone::where('user_id',$users)->get();
        return view('admin.user_auth',compact('users'));
    }
}