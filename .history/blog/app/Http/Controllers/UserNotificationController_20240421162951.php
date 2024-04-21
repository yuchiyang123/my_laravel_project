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
use App\Models\User_notify_mjoin;

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
        $n_a_r = DB::table('reply_artwork')
                    ->select('reply_artwork.*','user.profileImage','user.profileImage_type')
                    ->leftJoin('artwork', 'reply_artwork.reply_id', '=', 'artwork.id')
                    ->leftJoin('user', 'reply_artwork.name_u', '=', 'user.username')
                    ->where('artwork.status', '<>', 'del')
                    ->where('reply_artwork.status', '<>', 'del')
                    ->where('artwork.user_id', Auth::user()->id)
                    ->where('reply_artwork.name_u','<>', Auth::user()->username)
                    ->orderBy('reply_artwork.id','desc')
                    ->get();
        $n_m_r = DB::table('mjoin_reply')
                    ->select('reply.*','user.profileImage','user.profileImage_type')
                    ->leftJoin('mjoin', 'reply.reply_id', '=', 'mjoin.id')
                    ->leftjoin('user','reply.name_u','=','user.username')
                    ->where('mjoin.status', '<>', 'del')
                    ->where('reply.status', '<>', 'del')
                    ->where('mjoin.posted_by_u', Auth::user()->username)
                    ->where('reply.name_u','<>', Auth::user()->username)
                    ->orderBy('reply.id','desc')
                    ->get();
        $n_m_g = DB::table('great')
                    ->select('great.*','user.profileImage','user.profileImage_type')
                    ->leftJoin('mjoin', 'great.reply_id', '=', 'mjoin.id')
                    ->leftjoin('user','great.clickgood_u','=','user.username')
                    ->where('mjoin.status', '<>', 'del')
                    ->where('great.status', '<>', 'del')
                    ->where('mjoin.posted_by_u', Auth::user()->username)
                    ->where('great.clickgood_u','<>', Auth::user()->username)
                    ->where('great.many','1')
                    ->orderBy('great.id','desc')
                    ->get();
        $n_a_g = DB::table('great')
                    ->select('great_arkwork.*','user.profileImage','user.profileImage_type')
                    ->leftJoin('artwork', 'great_arkwork.article_id ', '=', 'artwork.id')
                    ->leftJoin('user', 'great_arkwork.user_id', '=', 'user.username')
                    ->where('artwork.status', '<>', 'del')
                    ->where('great_arkwork.status', '<>', 'del')
                    ->where('artwork.user_id', Auth::user()->id)
                    ->where('great_arkwork.user_id','<>', Auth::user()->id)
                    ->where('great.many','1')
                    ->orderBy('great.id','desc')
                    ->get();
        $n_m_j = DB::table('notify_join_mjoin')
                    ->select('notify_join_mjoin.*','user.profileImage','user.profileImage_type')
                    ->leftJoin('mjoin', 'notify_join_mjoin.article_id', '=','mjoin.id')
                    ->where('mjoin.posted_by_u',Auth::user()->username)
                    ->where('notify_join_mjoin.status','<>','pass')
                    ->get();
        
        $htmlContent = '';

        
    }         
}