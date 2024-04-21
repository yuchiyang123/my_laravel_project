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
        /*$n_a_r = DB::table('reply_artwork')
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
                    ->get();*/

                    /*$notifications = DB::table('reply_artwork')
                    ->select('reply_artwork.*', 'user.profileImage', 'user.profileImage_type', DB::raw('NULL as additional_field'))
                    ->leftJoin('artwork', 'reply_artwork.reply_id', '=', 'artwork.id')
                    ->leftJoin('user', 'reply_artwork.name_u', '=', 'user.username')
                    ->where('artwork.status', '<>', 'del')
                    ->where('reply_artwork.status', '<>', 'del')
                    ->where('artwork.user_id', Auth::user()->id)
                    ->where('reply_artwork.name_u', '<>', Auth::user()->username);
                
                $notifications = $notifications->unionAll(function ($query) {
                    $query->select('reply.*', 'user.profileImage', 'user.profileImage_type', DB::raw('NULL as additional_field'))
                        ->from('reply')
                        ->leftJoin('mjoin', 'reply.reply_id', '=', 'mjoin.id')
                        ->leftJoin('user', 'reply.name_u', '=', 'user.username')
                        ->where('mjoin.status', '<>', 'del')
                        ->where('reply.status', '<>', 'del')
                        ->where('mjoin.posted_by_u', Auth::user()->username)
                        ->where('reply.name_u', '<>', Auth::user()->username);
                });*/
                
                /*$notifications = $notifications->unionAll(function ($query) {
                    $query->select('great.*', 'user.profileImage', 'user.profileImage_type', DB::raw('NULL as additional_field'))
                        ->from('great')
                        ->leftJoin('mjoin', 'great.reply_id', '=', 'mjoin.id')
                        ->leftJoin('user', 'great.clickgood_u', '=', 'user.username')
                        ->where('mjoin.status', '<>', 'del')
                        ->where('great.status', '<>', 'del')
                        ->where('mjoin.posted_by_u', Auth::user()->username)
                        ->where('great.clickgood_u', '<>', Auth::user()->username)
                        ->where('great.many', '1');
                });
                
                $notifications = $notifications->unionAll(function ($query) {
                    $query->select('great_arkwork.*', 'user.profileImage', 'user.profileImage_type', DB::raw('NULL as additional_field'))
                        ->from('great_arkwork')
                        ->leftJoin('artwork', 'great_arkwork.article_id ', '=', 'artwork.id')
                        ->leftJoin('user', 'great_arkwork.user_id', '=', 'user.username')
                        ->where('artwork.status', '<>', 'del')
                        ->where('great_arkwork.status', '<>', 'del')
                        ->where('artwork.user_id', Auth::user()->id)
                        ->where('great_arkwork.user_id', '<>', Auth::user()->id)
                        ->where('great_arkwork.many', '1');
                });
                
                $notifications = $notifications->unionAll(function ($query) {
                    $query->select('notify_join_mjoin.*', 'user.profileImage', 'user.profileImage_type', DB::raw('NULL as additional_field'))
                        ->from('notify_join_mjoin')
                        ->leftJoin('mjoin', 'notify_join_mjoin.article_id', '=', 'mjoin.id')
                        ->leftJoin('user', 'notify_join_mjoin.name_u', '=', 'user.username')
                        ->where('mjoin.posted_by_u', Auth::user()->username)
                        ->where('notify_join_mjoin.status', '<>', 'pass');
                });
                */
                //$notifications = $notifications->orderBy('updated_at', 'desc')->get();
                $query1 = DB::table('reply_artwork')
                    ->select('reply_artwork.*', 'user.profileImage', 'user.profileImage_type', DB::raw('NULL as additional_field'), DB::raw('"reply_artwork" as source'))
                    ->leftJoin('artwork', 'reply_artwork.reply_id', '=', 'artwork.id')
                    ->leftJoin('user', 'reply_artwork.name_u', '=', 'user.username')
                    ->where('artwork.status', '<>', 'del')
                    ->where('reply_artwork.status', '<>', 'del')
                    ->where('artwork.user_id', Auth::user()->id)
                    ->where('reply_artwork.name_u', '<>', Auth::user()->username)
                    ->orderBy('updated_at', 'desc')
                    ->get();

                $query2 = DB::table('reply')
                    ->select('reply.*', 'user.profileImage', 'user.profileImage_type', DB::raw('NULL as additional_field'), DB::raw('"reply" as source'))
                    ->leftJoin('mjoin', 'reply.reply_id', '=', 'mjoin.id')
                    ->leftJoin('user', 'reply.name_u', '=', 'user.username')
                    ->where('mjoin.status', '<>', 'del')
                    ->where('reply.status', '<>', 'del')
                    ->where('mjoin.posted_by_u', Auth::user()->username)
                    ->where('reply.name_u', '<>', Auth::user()->username)
                    ->orderBy('updated_at', 'desc')
                    ->get();

                $query3 = DB::table('great')
                    ->select('great.*', 'user.profileImage', 'user.profileImage_type', DB::raw('NULL as additional_field'), DB::raw('"great" as source'))
                    ->leftJoin('mjoin', 'great.reply_id', '=', 'mjoin.id')
                    ->leftJoin('user', 'great.clickgood_u', '=', 'user.username')
                    ->where('mjoin.status', '<>', 'del')
                    ->where('great.status', '<>', 'del')
                    ->where('mjoin.posted_by_u', Auth::user()->username)
                    ->where('great.clickgood_u', '<>', Auth::user()->username)
                    ->where('great.many', '1')
                    ->orderBy('updated_at', 'desc')
                    ->get();

                $query4 = DB::table('great_arkwork')
                    ->select('great_arkwork.*', 'user.profileImage', 'user.profileImage_type', DB::raw('NULL as additional_field'), DB::raw('"great_arkwork" as source'))
                    ->leftJoin('artwork', 'great_arkwork.article_id', '=', 'artwork.id')
                    ->leftJoin('user', 'great_arkwork.user_id', '=', 'user.username')
                    ->where('artwork.status', '<>', 'del')
                    ->where('artwork.user_id', Auth::user()->id)
                    ->where('great_arkwork.user_id', '<>', Auth::user()->id)
                    ->where('great_arkwork.status', '1')
                    ->orderBy('updated_at', 'desc')
                    ->get();

                $query5 = DB::table('notify_join_mjoin')
                    ->select('notify_join_mjoin.*', 'user.profileImage', 'user.profileImage_type', DB::raw('NULL as additional_field'), DB::raw('"notify_join_mjoin" as source'))
                    ->leftJoin('mjoin', 'notify_join_mjoin.article_id', '=', 'mjoin.id')
                    ->leftJoin('user', 'notify_join_mjoin.user_id', '=', 'user.username')
                    ->where('mjoin.posted_by_u', Auth::user()->username)
                    ->where('notify_join_mjoin.status', '<>', 'pass')
                    ->orderBy('updated_at', 'desc')
                    ->get();
        $notifications = $query1->merge($query2)->merge($query3)->merge($query4)->merge($query5);

                //dd($notifications->toSql());
                //$result = $notifications;
                //dd($notifications);
                
        
        $htmlContent = '';
        $htmlContent_join = '';

        foreach ($notifications as $notification) {
            // 根据通知来源判断通知类型
            if ($notification->source === 'reply_artwork') {
                $imageDataUri = 'data:' . $notification->profileImage_type  . ';base64,' . base64_encode( $notification->profileImage );
                // 如果通知来源于回复艺术品的表
                $content = '你收到了一条关于你的作品的回复';
                $url = '/arkwork_solo/solo/' . $notification->reply_id;
            } elseif ($notification->source === 'great_arkwork') {
                $imageDataUri = 'data:' . $notification->profileImage_type  . ';base64,' . base64_encode( $notification->profileImage );
                // 如果通知来源于 mjoin 回复的表
                $content = $notification->username.'你收到了一条关于你的作品的回复';
                $url = '/arkwork_solo/solo/' . $notification->article_id;
            } elseif ($notification->source === 'reply') {
                $imageDataUri = 'data:' . $notification->profileImage_type  . ';base64,' . base64_encode( $notification->profileImage );
                // 如果通知来源于 mjoin 回复的表
                $content = '你收到了一条关于 mjoin 的回复';
                //$url = '/arkwork_solo/solo/' . $notification->article_id;
                $url= '';
            } elseif ($notification->source === 'great') {
                $imageDataUri = 'data:' . $notification->profileImage_type  . ';base64,' . base64_encode( $notification->profileImage );
                // 如果通知来源于点赞的表
                $content = $notification->username.'你的帖子收到了点赞';
                //$url = '/post/' . $notification->reply_id;
                $url= '';
            } elseif ($notification->source === 'notify_join_mjoin') {
                $imageDataUri_join = 'data:' . $notification->profileImage_type  . ';base64,' . base64_encode( $notification->profileImage );
                // 如果通知来源于 mjoin 加入通知的表
                $content_join = '有人申请加入你的揪團';
                //$url = '/mjoin/' . $notification->user_id;
                $url_join= '';
            }
            

            // 生成通知 HTML 内容
            if($notification){
                 $htmlContent .= '<li><a class="dropdown-item" href="' . $url . '" id="join_normalnotify">';
                $htmlContent .= '<img src="' . $imageDataUri . '" alt="mdo" width="50" height="50" class="rounded-circle">';
                $htmlContent .= '<span class="fw-bold">' . $content . '</span>';
                $htmlContent .= '</a></li>';
            }
           

            if($imageDataUri_join){
                $htmlContent_join .= '<li><a class="dropdown-item" href="' . $url_join . '" id="join_normalnotify">';
                $htmlContent_join .= '<img src="' . $imageDataUri_join . '" alt="mdo" width="50" height="50" class="rounded-circle">';
                $htmlContent_join .= '<span class="fw-bold">' . $content_join . '</span>';
                $htmlContent_join .= '</a></li>';
            }
            
        }

        // 输出 HTML 内容
        return response()->json(['htmlContent' => $htmlContent,'htmlContent_join'=>$htmlContent_join]);

        
    }         
}