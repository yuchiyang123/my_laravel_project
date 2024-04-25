<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\UserPostMjoin;
use App\Models\Mjoin_reply;
use App\Models\User_collections_mjoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Symfony\Component\Routing\Route;
use App\Models\User_join_mjoin;
use App\Models\MjoinScore;


class UserMjoinController extends Controller
{

    public function mjoin_post_form()
    {
        $check = UserPostMjoin::where('posted_by_u', Auth::user()->username)
                                ->where('status','<>', 'del,complete,end')->first();
        if(!Auth::check()){
            return redirect('/login')->with('error', '請先登入');
        }
        if($check){
            $error_message = "您已經發過文，請勿重複發文";
            return redirect()->route('front')->with('error_message', $error_message);
        }
        return view('auth.Mjoinform');

    }
    //所有揪團
    public function mjoin()
    {
        /*$mjoins = UserPostMjoin::orderBy('id', 'desc')
                               ->where('status','<>','del')                        
                               ->get();*/
                               $mjoins = DB::table('mjoin')
                               ->select('mjoin.*', 'user_collections_mjoin.status as status_b', 'user.profileImage_type', 'user.profileImage')
                               ->leftJoin('user_collections_mjoin', 'mjoin.id', '=', 'user_collections_mjoin.article_id')
                               ->leftJoin('user', 'mjoin.posted_by_u', '=', 'user.username')
                               ->orderBy('mjoin.id', 'desc')
                               ->where('mjoin.status', '<>', 'del')
                               ->distinct()
                               ->get();
                           
                           $articleIds = $mjoins->pluck('id')->toArray(); // 提取文章 ID
                           
                           $checks = [];
                           if (!empty($articleIds)) {
                               foreach ($articleIds as $articleId) {
                                   $check = MjoinScore::where('rater_id', $articleId)->first();
                                   $checks[$articleId] = $check;
                               }
                           }
                           //時間超過就會自動轉成end
                           
                           foreach ($mjoins as $mjoin) {
                            $dates = explode(' - ', $mjoin->time);
                            $end_date = Carbon::parse($dates[1]);
                            if (now()->greaterThan($end_date)) {
                                DB::table('mjoin')
                                    ->where('id', $mjoin->id)
                                    ->where('status', '!=', 'del,complete,end')
                                    ->update(['status' => 'end']);
                                }
                            }

                            
                                               

        return view('auth.front', compact('mjoins','checks'));
    }
    //揪團刪除
    public function mjoin_post_delete($mjoinId)
    {
        if(Auth::check()){
            $mjoindel = UserPostMjoin::where('id',$mjoinId)
                                       ->first();
            if(session('user_name')===$mjoindel->posted_by_u){
                $status = 'del';
                $mjoindel->status = $status;
                $mjoindel->update();
                return redirect()->route('front');
            }
        }else{
            return view('/');
        }
    }
    //揪團編輯
    public function mjoin_post_edit(Request $request,$mjoinId)
    {
        if(Auth::check()){
            $mjoinedits = UserPostMjoin::where('id',$mjoinId)
                                         ->first();
            if(session('user_name')===$mjoinedits->posted_by_u){
                $post = UserPostMjoin::find($mjoinId);
                //時間tw
                date_default_timezone_set('Asia/Taipei');
                $title = $request->input('title');
                $destination = $request->input('destination');
                $time = $request->input('time');
                $diffDay = $request->input('diffDay');
                $people = $request->input('people');
                $money = $request->input('money');
                $sex = $request->input('sex');
                $skill = $request->input('skill');
                $age = $request->input('age');
                $description = $request->input('editor');
                
                $post->title = $title;
                $post->destination = $destination;
                $post->time = $time;
                $post->diffDay = $diffDay;
                $post->people = $people;
                $post->money = $money;
                $post->sex = $sex;
                $post->skill = $skill;
                $post->age = $age;
                $post->description = $description;
                $post->update();
                return redirect()->Route('front');
            } else {
                return view('/');
            }   
            
            
        }else{
            return view('/');
        }
    }
    //揪團編輯表單
    public function mjoin_edit($mjoinId)
    {
        if(Auth::check()){
            $mjoinedits = UserPostMjoin::where('id',$mjoinId)
                                         ->first();
            if(session('user_name')===$mjoinedits->posted_by_u){
                return view('auth.Mjoinform_edit', compact('mjoinedits'));
            } else {
                return redirect()->route('error');
            }   
            
            
        }else{
            return view('/');
        }
        
    }

    //搜尋揪團貼文
    public function search_mjoin(Request $request)
    {
        if($request != null){
            $date = urldecode($request->input('date'));
            if ($date == '1') {
                $datestart = $date;
                $dateend = $date;
            } elseif ($date == '2') {
                $datestart = $date;
                $dateend = $date;
            } elseif ($date == '3') {
                $datestart = $date;
                $dateend = $date;
            } elseif ($date == '4~6') {
                $datestart = 4;
                $dateend = 6;
            } elseif ($date == '7~9') {
                $datestart = 7;
                $dateend = 9;
            } elseif ($date == '10~99') {
                $datestart = 10;
                $dateend = 99;
            }
            //dd($datestart);

            $sex = $request->input('sex');
            $skill = $request->input('skill');
            $NOpeople = $request->input('NOpeople');
            //dd($NOpeople);
            $age = $request->input('age');
            //dd($age,$datestart,$dateend,$skill,$sex,$NOpeople);
            $mjoins = UserPostMjoin::whereBetween('diffDay',[$datestart,$dateend])
                                    ->where('sex', $sex)
                                    ->where('skill',$skill)
                                    ->where('people',$NOpeople)
                                    ->where('age', $age)
                                    ->get();
            //dd($mjoins);

            return view('auth.front', compact('mjoins'));
                                         
        }
    }
    //揪團發文
    public function mjoin_post(Request $request){
        if(Auth::check()){
            if($request->has('editor')) {
                $post = new UserPostMjoin();
                //時間tw
                date_default_timezone_set('Asia/Taipei');
                $title = $request->input('title');
                $destination = $request->input('destination');
                $time = $request->input('time');
                $diffDay = $request->input('diffDay');
                $people = $request->input('people');
                $money = $request->input('money');
                $sex = $request->input('sex');
                $skill = $request->input('skill');
                $age = $request->input('age');
                $description = $request->input('editor');
                
                $post->title = $title;
                $post->destination = $destination;
                $post->time = $time;
                $post->diffDay = $diffDay+1;
                $post->people = $people;
                $post->money = $money;
                $post->sex = $sex;
                $post->skill = $skill;
                $post->age = $age;
                $post->description = $description;
                $post->posted_by_e = session('user_email');
                $post->posted_by_u = session('user_name');
                $post->status = "pending";
                $post->save();
                return redirect()->route('front');
            }
        } else {
            return redirect()->route('login');
        } 
        
    }

    //按讚
    public function mjoin_c_good($mjoin){
        UserPostMjoin::where('id',$mjoin)->increment('good', 1);
    }
    //留言送出
    public function mjoin_reply_submit(Request $request, $mjoinId)
    {
        if ($request->has('messageTextarea')) {
            date_default_timezone_set('Asia/Taipei');
            $main = $request->input('messageTextarea');
            $count = Mjoin_reply::where('reply_id', $mjoinId)->count();
            $reply = new Mjoin_reply();
            
            $reply->reply_id = $mjoinId;
            $reply->name_e = session('user_email');
            $reply->name_u = session('user_name');
            $reply->main = $main;
            $reply->good = 0;
            $reply->status = "pending";
            $level = ($count == 0) ? 1 : ($count + 1);
            $reply->level = $level;
            $reply->save();

            // 如果需要返回一些数据给前端，可以使用 JSON 格式
            return response()->json(['success' => true, 'message' => '留言成功']);
        } else {
            // 如果回复内容为空，则返回错误消息给前端
            return response()->json(['success' => false, 'message' => '留言内容不能为空']);
        }
    }



    public function mjoin_reply_count($mjoinId){
        
        $count = Mjoin_reply::where('reply_id', $mjoinId)->count();
        $count_replys = '
            <div>
                <a href="#">'.$count.'則留言</a>
            </div>';
        return response()->json(['htmlContent_reply' => $count_replys]);
    }

    //回復顯示(2)
    public function mjoin_reply($mjoinId)
    {
        date_default_timezone_set('Asia/Taipei');
        //$mjoin_replys = Mjoin_reply::where('reply_id', $mjoinId)->get();
        $mjoin_replys = DB::table('reply')
                            ->select('reply.*','user.profileImage_type','user.profileImage','user.profileImage_type')
                            ->leftjoin('user','reply.name_u','=','user.username')
                            ->where('reply.reply_id', $mjoinId)
                            ->orderBy('reply.created_at','asc')
                            ->get();
        //IF回復為0
        $mjoin_replys_count = Mjoin_reply::where('reply_id', $mjoinId)
                                         ->count();

        $htmlContent = '<div class="SeeAllMessage">
                        <a href="#" data-mjoin-id="'.$mjoinId.'" onclick="showPopup('.$mjoinId.')">查看全部留言</a>
                        </div>';
                     
        if($mjoin_replys_count === 0){
            $htmlContent = '
            <div class="LeaveMessage" style="text-align:center;width:auto;display:inline-block;">
                <h2>無留言</h2>
            </div>';
        }else{
            $last_two_replies = $mjoin_replys->take(-2);
            foreach ($last_two_replies as $mjoin_reply) {
                // 時˙間差
                $postTime = Carbon::parse($mjoin_reply->created_at);
                $currentTime = Carbon::now();
                $timeDifference = $currentTime->diffForHumans($postTime);
                $imageDataUri = 'data:' . $mjoin_reply->profileImage_type  . ';base64,' . base64_encode( $mjoin_reply->profileImage );
                // 生成HTML内容
                $htmlContent .= '
                    <div class="LeaveMessage">
                        <div>
                            <div class="LeaveMessageimgdiv">';
                $htmlContent .= '
                                <a href="/user-profile/index/d/' . $mjoin_reply->name_u . '">';
                $htmlContent .= ($mjoin_reply->profileImage != null) ? 
                                '<img src="' . $imageDataUri . '" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">' :
                                '<img src="https://github.com/mdo.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">';
                $htmlContent .= '</a>';
                $htmlContent .= '
                            </div>
                            <div class="LeaveMessageall">
                                <div class="LeaveMessageUsername">
                                    <a href="/user-profile/index/d/' . $mjoin_reply->name_u . '">' . $mjoin_reply->name_u . '</a>
                                </div>
                                <div class="LeaveMessageMain">
                                    ' . $mjoin_reply->main . '
                                </div>
                                <div class="LeaveMessageAction">
                                    <a href="#">' . $timeDifference . '</a>&emsp;<a href="#">' . $mjoin_reply->good .
                                    '讚</a>&emsp;<a href="' . $mjoin_reply->level . $mjoin_reply->reply_id . '">回復</a>
                                </div>
                            </div>
                        </div>
                    </div>';

            }
    
        }
        
        return response()->json(['htmlContent' => $htmlContent]);
    }

    //全部回復顯示
    
    public function mjoin_reply_all($mjoinId)
    {
        date_default_timezone_set('Asia/Taipei');
        //$mjoin_replys = Mjoin_reply::where('reply_id', $mjoinId)->get();
        $mjoin_replys = DB::table('reply')
                            ->select('reply.*','user.profileImage_type','user.profileImage')
                            ->leftjoin('user','reply.name_u','=','user.username')
                            ->where('reply.reply_id', $mjoinId)
                            ->orderBy('reply.created_at','asc')
                            ->get();
        //IF回復為0
        $mjoin_replys_count = Mjoin_reply::where('reply_id', $mjoinId)
                                         ->count();

        $htmlContent = '<div class="SeeAllMessage"></div>';
                     
        if($mjoin_replys_count === 0){
            $htmlContent = '
            <div class="LeaveMessage" style="text-align:center;width:auto;display:inline-block;">
                <h2>無留言</h2>
            </div>';
        }else{
            //$last_two_replies = $mjoin_replys->take(-2);
            foreach ($mjoin_replys as $mjoin_reply) {
                // 時˙間差
                $postTime = Carbon::parse($mjoin_reply->created_at);
                $currentTime = Carbon::now();
                $timeDifference = $currentTime->diffForHumans($postTime);
                $imageDataUri = 'data:' . $mjoin_reply->profileImage_type  . ';base64,' . base64_encode( $mjoin_reply->profileImage );
                // 生成HTML内容
                $htmlContent .= '
                    <div class="LeaveMessage">
                        <div>
                            <div class="LeaveMessageimgdiv">';
                $htmlContent .= '
                                <a href="/user-profile/index/d/' . $mjoin_reply->name_u . '">';
                $htmlContent .= ($mjoin_reply->profileImage != null) ? 
                                '<img src="' . $imageDataUri . '" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">' :
                                '<img src="https://github.com/mdo.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">';
                $htmlContent .= '</a>';
                $htmlContent .= '
                            </div>
                            <div class="LeaveMessageall">
                                <div class="LeaveMessageUsername">
                                    <a href="/user-profile/index/d/' . $mjoin_reply->name_u . '">' . $mjoin_reply->name_u . '</a>
                                </div>
                                <div class="LeaveMessageMain">
                                    ' . $mjoin_reply->main . '
                                </div>
                                <div class="LeaveMessageAction">
                                    <a href="#">' . $timeDifference . '</a>&emsp;<a href="#">' . $mjoin_reply->good .
                                    '讚</a>&emsp;<a href="' . $mjoin_reply->level . $mjoin_reply->reply_id . '">回復</a>
                                </div>
                            </div>
                        </div>
                    </div>';

            }
    
        }
        
        return response()->json(['htmlContent' => $htmlContent]);
    }


    //單一揪團顯示
    public function showallmjoin($mjoinId)
    {
        //$allmjoin = UserPostMjoin::where('id', $mjoinId)->first();
        $allmjoin = DB::table('mjoin')
                        ->select('mjoin.*','user.profileImage_type','user.profileImage')
                        ->leftjoin('user','mjoin.posted_by_u','=','user.username')
                        ->where('mjoin.id', $mjoinId)
                        ->first();
        //套用上面的方法回復顯示
        $mjoinReplyHtml = $this->mjoin_reply($mjoinId);
        $mjoinReplyContent = json_decode($mjoinReplyHtml->getContent(), true)['htmlContent'];
        $imageData = 'data:' . $allmjoin->profileImage_type  . ';base64,' . base64_encode( $allmjoin->profileImage );
        $imageDatayou = 'data:' . Auth::User()->profileImage_type  . ';base64,' . base64_encode( Auth::User()->profileImage );
        $htmlContent = 
    '<div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="image-container">
                    <a href="/user-profile/index/d/'.$allmjoin->posted_by_u.'">
                        <img src="' . ($allmjoin->profileImage ? $imageData : 'https://github.com/mdo.png') . '" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                    </a>
                </div>
                <div class="text-container">
                    <div class="user">
                        '.$allmjoin->posted_by_u.'
                    </div>
                    <div class="date">
                        <!--貼文日期-->
                        '.$allmjoin->date.'
                    </div>
                </div>
                <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;">
                    <label class="flex-fill ps-3">日期:'.$allmjoin->time.'</label>
                    <label class="flex-fill">人數:'.$allmjoin->people.'</label>
                    <label class="flex-fill">預算:'.$allmjoin->money.'</label>
                    <label class="flex-fill">性別:'.$allmjoin->sex.'</label>
                    <label class="flex-fill">需要技能:'.$allmjoin->skill.'</label>
                    <label class="flex-fill pe-3">年齡:'.$allmjoin->age.'</label>
                </div>
                <div class="clearfix"></div>
                <div class="main image-container text-start">
                    '. $allmjoin->description.'
                </div>
                <div class="container">
                    <div class="respond">
                        <a href="#">👍🏽</a>
                        <div>
                            <a href="#">0</a>
                        </div>
                    </div>
                    <div class="message">
                        <div>
                            <a href="#">8則留言</a>
                        </div>
                    </div>
                </div>
                <div class="line">
                    <div class="inner-grid">';
                        if(isset($_SESSION['user_name'])) {
                            echo '<a href="#" data-mjoin-id="'. $allmjoin->id .'" class="like-button">
                                    <div class="inner-grid">
                                        <span class="material-icons animate__animated">
                                        </span>
                                        <div class="">讚</div>
                                    </div>
                                </a>';
                        }
                        // PHP code for date handling
                        $dates = explode(' - ', $allmjoin->time);
                        $start_date = \Carbon\Carbon::parse($dates[0]);
                        $end_date = \Carbon\Carbon::parse($dates[1]);

                        if(!\Carbon\Carbon::now()->gt($end_date) && isset($_SESSION['user_name']) && 
                        \App\Models\User_join_mjoin::where('article_id', $allmjoin->id)->where('user_id', auth()->id())->exists()) {
                            // PHP code for displaying score button
                            if(\App\Models\MjoinScore::where('rater_id', Auth::user()->id)->first() == null && 
                                \App\Models\User_join_mjoin::select('status')->where('user_id', Auth::user()->id)->where('article_id', $allmjoin>id)->first()->status == 'pass') {
                                    if(\App\Models\UserPostMjoin::select('status')->where('posted_by_u', Auth::user()->username)->first()->status == 'complete' || 'end') {
                                        echo '<a href="/score_form/'. $allmjoin->id .'"><button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="要完成評分喔">評分</button></a>';
                                    } else {
                                        echo '<span>已完成評分</span>';
                                    }
                            }
                        } else {
                            // PHP code for not displaying score button
                        }
                    echo '</div>
                    <div class="inner-grid">';
                        // Modal HTML content with PHP
                    echo '</div>
                    <div class="inner-grid">';
                        // Dropdown HTML content with PHP
                    echo '</div>
                    <a href="#" class="" id="'. $mjoin->id .'" data-mjoin-id="'. $mjoin->id .'" onclick="showPopup('. $mjoin->id .')">回覆</a>';
                    // PHP code for condition
                    if(isset($_SESSION['user_name']) && $_SESSION['user_name'] != $mjoin->posted_by_u && 
                    !\Carbon\Carbon::now()->gt($end_date)) {
                        echo '<div class="inner-grid">
                                <span><a href="/join_mjoin/'. $mjoin->id .'">加入</a></span>
                            </div>';
                    }
                echo '</div>
            </div>
        </div>
    </div>
    <div class="ShowAllMessageall" id="showAllMessageall_'. $mjoinId .'"></div>
    <div class="LeaveMessageInput flex-row">
        <div class="LeaveMessageInputrpAname p-2">';

            
            $htmlContent .= (Auth::User()->profileImage != null) ? 
                            '<img src="' . $imageDatayou  . '" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">' :
                            '<img src="https://github.com/mdo.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">';
            $htmlContent .= '</div>
                            <div class="p-2">
                                <textarea class="form-control" placeholder="留言" id="messageTextarea_'.$mjoinId.'" name="messageTextarea_'.$mjoinId.'" rows="1"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submitReply" onclick="submitReply('.$mjoinId.')">留言</button>
                        </div>';
                
        return response()->json(['htmlContent' => $htmlContent]);
    }

}