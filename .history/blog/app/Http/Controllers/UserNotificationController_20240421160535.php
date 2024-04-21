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
use App\Models\Mjoin_reply;

use function Laravel\Prompts\alert;
use function Symfony\Component\HttpKernel\Log\record;

class UserNotificationController extends Controller
{
    public function allnotify(){
        //未登入
        if(!Auth::check()){
            return redirect('/login');
        }
        //按讚創作、揪團、回覆、加入通知
        $n_a_r = DB::table('artwork_reply')
                    ->select('artwork_reply.*')
                    ->leftJoin('artwork', 'artwork_reply.reply_id', '=', 'artwork.id')
                    ->where('artwork.status', '<>', 'del')
                    ->where('artwork_reply.status', '<>', 'del')
                    ->where('artwork.user_id', Auth::user()->id)
                    ->where('artwork_reply.name_u','<>', Auth::user()->username)
                    ->orderBy('artwork_reply.id','desc')
                    ->get();
        $n_m_r = DB::table('mjoin_reply')
                    ->select('reply.*')
                    ->leftJoin('mjoin', 'reply.reply_id', '=', 'mjoin.id')
                    ->where('mjoin.status', '<>', 'del')
                    ->where('reply.status', '<>', 'del')
                    ->where('mjoin.posted_by_u', Auth::user()->username)
                    ->where('reply.name_u','<>', Auth::user()->username)
                    ->orderBy('reply.id','desc')
                    ->get();
        $n_m_g = DB::table('great')
                    ->select('great.*')
                    ->leftJoin('mjoin', 'great.reply_id', '=', 'mjoin.id')
                    ->where('mjoin.status', '<>', 'del')
                    ->where('great.status', '<>', 'del')
                    ->where('mjoin.posted_by_u', Auth::user()->username)
                    ->where('great.clickgood_u','<>', Auth::user()->username)
                    ->orderBy('reply.id','desc')
                    ->get();
    }               
}