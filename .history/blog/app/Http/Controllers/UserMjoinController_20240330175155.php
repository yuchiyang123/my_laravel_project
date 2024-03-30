<?php
namespace App\Http\Controllers;

use App\Models\UserPostMjoin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserMjoinController extends Controller
{
    public function mjoin()
    {
        $mjoins = UserPostMjoin::all();

        return view('auth.front', compact('mjoins'));
    }

    public function showallmjoin($mjoinId)
    {
        $allmjoin = UserPostMjoin::where('id', $mjoinId)->first();

        $description = Str::of($allmjoin->description)->wordwrap(86, "<br>\n", true);

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
                    <div class="SeeAllMessage">
                        <a href="#">查看全部留言</a>
                    </div>
                    <div class="LeaveMessage">
                        <div><a href="#"></a></div>
                        <div>
                            <div class="LeaveMessageimgdiv">

                                <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                            </div>
                            <div class="LeaveMessageall">
                                <div class="LeaveMessageUsername">
                                    222222
                                </div>
                                <div class="LeaveMessageMain">
                                    11111
                                </div>
                                <div class="LeaveMessageAction">
                                    <a href="#">4天</a>&emsp;<a href="#">讚</a>&emsp;<a href="#">回復</a>&emsp;<a href="#">動作</a-->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="LeaveMessage">
                        <div><a href="#"></a></div>
                        <div>
                            <div class="LeaveMessageimgdiv">
                                <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                            </div>
                            <div class="LeaveMessageall">
                                <div class="LeaveMessageUsername">
                                    留言姓名
                                </div>
                                <div class="LeaveMessageMain">
                                    內容內容內容內容內容
                                </div>
                                <div class="LeaveMessageAction">
                                    <a href="#">4天</a>&emsp;<a href="#">讚</a>&emsp;<a href="#">回復</a>&emsp;<a href="#">動作</a>
                                </div>
                            </div>
                        </div>
                    </div><br>
                </div>
            </div>
        </div>';

        //return response()->json($allmjoin);

        /*return view('back.popup', ['popupContent' => $allmjoin]);*/
        return response()->json(['htmlContent' => $htmlContent]);
    }
}