<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UserPostMjoin;
use App\Models\Mjoin_reply;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class UserMjoinController extends Controller
{
    //所有揪團
    public function mjoin()
    {
        $mjoins = UserPostMjoin::orderBy('id', 'desc')->get();

        return view('auth.front', compact('mjoins'));
    }
    //搜尋揪團貼文
    public function search_mjoin(Request $request)
    {
        if($request->has('search_mjoin')){
            $date = $request->input('date');
            if ($date >= 1 && $date <= 3) {
                $date = 1;
            } elseif ($date >= 4 && $date <= 6) {
                $date = 4;
            } elseif ($date >= 7 && $date <= 9) {
                $date = 7;
            } elseif ($date >= 10) {
                $date = 10;
            } else {
                $date = $date;
            }
            $sex = $request->input('sex');
            $skill = $request->input('skill');
            $NOpeople = $request->input('NOpeople');
            if ($NOpeople >= 2 && $NOpeople <= 4) {
                $NOpeople = 1;
            } elseif ($NOpeople >= 5 && $$NOpeople <= 7) {
                $NOpeople = 4;
            } elseif ($$NOpeople >= 8 && $NOpeople <= 10) {
                $date = 7;
            } elseif ($date >= 10) {
                $date = 10;
            } else {
                $NOpeople = $NOpeople;
            }
            $age = $request->input('age');

            $search_mjoin = UserPostMjoin::where('diffDay',$date)
                                         ->where('sex', $sex)
                                         ->where('skill', $skill)
                                         ->where('people', $NOpeople)
                                         ->where('age', $age)
                                         ->get();
            $htmlContent = '';
            foreach($search_mjoin as $search_mjoins){
                $htmlContent = '
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="image-container">
                    " + mjoin.posted_by + "
                </div>
                <div class="text-container">
                    <div class="user">
                        <!--貼文用戶名-->
                        <div><a href="#">" + mjoin.posted_by + "</a></div>
                    </div>
                    <div class="date">
                        <!--貼文日期-->
                        <div><a href="#">" + mjoin.date + "</a></div>
                    </div>
                </div>
                <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;">
                    <label class="flex-fill ps-3">日期:" + mjoin.time + "</label>
                    <label class="flex-fill">人數:" + mjoin.people + "</label>
                    <label class="flex-fill">預算:" + mjoin.money + "</label>
                    <label class="flex-fill">性別:" + mjoin.sex + "</label>
                    <label class="flex-fill">需要技能:" + mjoin.skill + "</label>
                    <label class="flex-fill pe-3">年齡:" + mjoin.age + "</label>
                </div>
                <div class="clearfix"></div>
                <div class="image-container">
                    <div class="d-block mb-3 text-start text-break">
                        " + mjoin.description + "
                    </div>
                </div>


                <div class="container">
                    <div class="respond">

                        <a href="#">👍🏽</a>
                        <div>
                            <a href="#">0</a>
                        </div>
                    </div>
                    <div class="messagecount" id="messagecount_" + mjoin.id + ">

                    </div>
                </div>
                <div class="line">
                    <div class="inner-grid">讚</div>
                    <div class="inner-grid">
                        <a href="#" id=" + mjoin.id + " data-mjoin-id=" + mjoin.id + " onclick="showPopup(" + mjoin.id + ")">查看完整内容</a>
                    </div>
                    <div class="inner-grid">更多</div>
                </div>

                <div class="ShowAllMessage" id="showAllMessage_" + mjoin.id + ">

                </div>
                <form action=" {{ route('front.reply.submit', ['mjoinid' => " + mjoin.id + "]) }}" method="POST">
                    @csrf
                    <div class="LeaveMessageInput flex-row">
                        <div class="LeaveMessageInputrpAname p-2">
                            <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                        </div>
                        <div class="p-2">
                            <textarea class="form-control" placeholder="留言" id="floatingTextarea_" + mjoin.id + " name="MessageTextarea_" + mjoin.id + " rows="1"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">留言</button>
                </form>
                <div class="ShowAllMessage">
                    <script>
                        $(document).ready(function() {
                            showReply(" + mjoin.id + "),
                                messagecount(" + mjoin.id + ");
                        });

                        function showReply(mjoinId) {
                            $.ajax({
                                url: "/front-reply/" + mjoinId,
                                type: "GET",
                                success: function(response) {
                                    // 在彈出的視窗中顯示留言
                                    $('#showAllMessage_' + mjoinId).html(response.htmlContent);
                                    $('#showAllMessage_' + mjoinId).show();
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            })
                        }

                        function messagecount(mjoinId) {
                            $.ajax({
                                url: "/front-reply-count/" + mjoinId,
                                type: "GET",
                                success: function(response) {
                                    $('#messagecount_' + mjoinId).html(response.htmlContent_reply);
                                    $('#messagecount_' + mjoinId).show();
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    </script>
                </div>

            </div>
        </div>
    </div>';

            }
        }
    }
    //揪團發文
    public function mjoin_post(Request $request){
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
            $post->diffDay = $diffDay;
            $post->people = $people;
            $post->money = $money;
            $post->sex = $sex;
            $post->skill = $skill;
            $post->age = $age;
            $post->description = $description;
            $post->posted_by = session('user_email');
            $post->status = "pending";
            $post->save();
            return redirect()->route('front');
        }
    }

    //按讚
    public function mjoin_c_good($mjoin){
        UserPostMjoin::where('id',$mjoin)->increment('good', 1);
    }
    public function mjoin_reply_sumbit(Request $request,$mjoinId)
    {
        if($request->has('MessageTextarea_' . $mjoinId)) {
            date_default_timezone_set('Asia/Taipei');
            $main = $request->input('MessageTextarea_' . $mjoinId);
            $count = Mjoin_reply::where('reply_id', $mjoinId)->count();
            $reply = new Mjoin_reply();
            
            $reply->reply_id = $mjoinId;
            $reply->name = session('user_email');
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
        $mjoin_replys_count = Mjoin_reply::where('reply_id', $mjoinId)->count();

        $htmlContent = '<div class="SeeAllMessage">
                            <a href="#">查看全部留言</a>
                        </div>';
        if($mjoin_replys_count === 0){
            $htmlContent = '
            <div class="LeaveMessage" style="text-align:center;width:auto;display:inline-block;">
                <h2>無留言</h2>
            </div>';
        }else{
            foreach ($mjoin_replys as $mjoin_reply) {
                // 時˙間差
                $postTime = Carbon::parse($mjoin_reply->created_at);
                $currentTime = Carbon::now();
                $timeDifference = $currentTime->diffForHumans($postTime);
    
                // 生成HTML内容
                $htmlContent .= '
                
                <div class="LeaveMessage">
                    <div>
                        <div class="LeaveMessageimgdiv">
                            <a href="#">'.$mjoin_reply->name.'</a>
                        </div>
                        <div class="LeaveMessageall">
                            <div class="LeaveMessageUsername">
                                <a href="#">'.$mjoin_reply->name.'</a>
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
                    '.$allmjoin->posted_by.'
                    </div>
                    <div class="text-container">
                        <div class="user">
                            '.$allmjoin->posted_by.'
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