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


class UserMjoinController extends Controller
{
    //所有揪團
    public function mjoin()
    {
        /*$mjoins = UserPostMjoin::orderBy('id', 'desc')
                               ->where('status','<>','del')                        
                               ->get();*/
        $mjoins = DB::table('mjoin')
                    ->select('mjoin.*','user_collections_mjoin.status as status_b','user.*')
                    ->leftjoin('user_collections_mjoin','mjoin.id','=','user_collections_mjoin.article_id')
                    ->rightJoin('user','mjoin.posted_by_u','=','user.username')
                    ->orderBy('mjoin.id','desc')
                    ->where('mjoin.status','<>','del')
                    ->get();

        return view('auth.front', compact('mjoins'));
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
    public function mjoin_reply_sumbit(Request $request,$mjoinId)
    {
        if($request->has('MessageTextarea_' . $mjoinId)) {
            date_default_timezone_set('Asia/Taipei');
            $main = $request->input('MessageTextarea_' . $mjoinId);
            $count = Mjoin_reply::where('reply_id', $mjoinId)->count();
            $reply = new Mjoin_reply();
            
            $reply->reply_id = $mjoinId;
            $reply->name_e = session('user_email');
            $reply->name_u = session('user_name');
            $reply->main = $main;
            $reply->good = 0;
            $reply->status = "pending";
            $level = ($count==0) ? 1 : ($count+1) ;
            $reply->level = $level;
            $reply->save();

            return redirect()->route('front');
        }else{
            return redirect()->back()->with('error', '回复内容不能为空！');
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

    //回復顯示
    public function mjoin_reply($mjoinId)
    {
        date_default_timezone_set('Asia/Taipei');
        $mjoin_replys = Mjoin_reply::where('reply_id', $mjoinId)->get();
        
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
                
                // 生成HTML内容
                $htmlContent .= '
                
                <div class="LeaveMessage">
                    <div>
                        <div class="LeaveMessageimgdiv">
                            <a href="/user-profile/index/d/'.$mjoin_reply->name_u.' ">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                            </a>
                        </div>
                        <div class="LeaveMessageall">
                            <div class="LeaveMessageUsername">
                                <a href="/user-profile/index/d/'.$mjoin_reply->name_u.'">'.$mjoin_reply->name_u.'</a>
                            </div>
                            <div class="LeaveMessageMain">
                                '.$mjoin_reply->main.'
                            </div>
                            <div class="LeaveMessageAction">
                                <a href="#">'.$timeDifference.'</a>&emsp;<a href="#">'.$mjoin_reply->good.
                                '讚</a>&emsp;<a href="'.$mjoin_reply->level.$mjoin_reply->reply_id.'">回复</a>
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
        $allmjoin = UserPostMjoin::where('id', $mjoinId)->first();

        //套用上面的方法回復顯示
        $mjoinReplyHtml = $this->mjoin_reply($mjoinId);
        $mjoinReplyContent = json_decode($mjoinReplyHtml->getContent(), true)['htmlContent'];


        $htmlContent = 
         '<div class="cut">
            <div class="grid-item">
                <div class="limt">
                    <div class="image-container">
                        <a href="/user-profile/index/d/'.$allmjoin->posted_by_u.'">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
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
                        <div class="inner-grid">@yield("PostAcion1")</div>
                        <div class="inner-grid">@yield("PostAcion2")</div>
                        <div class="inner-grid">@yield("PostAcion3")</div>
                    </div>
                    '.$mjoinReplyContent .'
                    <br>
                </div>
            </div>
        </div>';
        return response()->json(['htmlContent' => $htmlContent]);
    }

}