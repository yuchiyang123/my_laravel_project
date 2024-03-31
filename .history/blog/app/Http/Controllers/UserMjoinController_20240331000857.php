<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UserPostMjoin;
use App\Models\Mjoin_reply;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserMjoinController extends Controller
{
    //所有揪團
    public function mjoin()
    {
        $mjoins = UserPostMjoin::all();

        return view('auth.front', compact('mjoins'));
    }

    public function mjoin_reply($mjoinId)
    {
        $mjoin_replys = Mjoin_reply::where('reply_id', $mjoinId)->get();

        $htmlContent = '';

        foreach ($mjoin_replys as $mjoin_reply) {
            // 時˙間差
            $postTime = Carbon::parse($mjoin_reply->post_time);
            $currentTime = Carbon::now();
            $timeDifference = $currentTime->diffForHumans($postTime);

            // 生成HTML内容
            $htmlContent .= '
            <div class="LeaveMessage">
                <div>
                    <div class="LeaveMessageimgdiv">
                        <a href="#">'.$mjoin_reply->user.'</a>
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

        return response()->json(['htmlContent' => $htmlContent]);
    }

    //單一揪團顯示
    public function showallmjoin($mjoinId)
    {
        $allmjoin = UserPostMjoin::where('id', $mjoinId)->first();

        $description = Str::of($allmjoin->description)->wordwrap(80, "<br>\n", true);

        //取用留言 json轉化
        $mjoinReplyHtml = $this->mjoin_reply($mjoinId);
        $mjoinReplyContent = json_decode($mjoinReplyHtml->getContent(), true)['htmlContent'];

        $encoding = mb_detect_encoding($description, 'UTF-8, ISO-8859-1, GBK');
        if ($encoding !== 'UTF-8') {
            $description = mb_convert_encoding($description, 'UTF-8', $encoding);
        }
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
                    <div class="clearfix"></div>
                    <p class="main">
                    '. $description.'
                    </p>
                    <div class="container">
                        <div class="respond">

                            <a href="#">👍🏽</a>
                            <div>

                                <a href="#">58</a>
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
                    '.$mjoinReplyContent.'
                    <br>
                </div>
            </div>
        </div>';
        return response()->json(['htmlContent' => $htmlContent]);
    }
}