<script src="{{ asset('js/app.js') }}"></script>
<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.min.js"></script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<!-- JavaScript Bundle with Popper -->


@extends('layouts.frontpage')

@section('title', '')

@section('condition_add')
<div class="condition">
    <div class="radio-tophead d-block mx-auto fs-3 fw-bolder ">
        <label></label>
    </div>
    <form action="/mjoin_search" method="get" id="search_mjoin">
        @csrf
        <div class="condition-radio text-start">
            <div class="radio-head fs-5 fw-bolder border-bottom pb-2">
                <label>地區</label-->
            </div>
            <select id="selectwhere" name="destination" required class="form-select form-select-sm" aria-label=".form-select-sm example">
                <optgroup label="北部">
                    <option value="臺北市">臺北市</option>
                    <option value="新北市">新北市</option>
                    <option value="基隆市">基隆市</option>
                    <option value="桃園市">桃園市</option>
                    <option value="新竹市">新竹市</option>
                    <option value="宜蘭縣">宜蘭縣</option>
                </optgroup>
                <optgroup label="中部">
                    <option value="臺中市">臺中市</option>
                    <option value="彰化縣">彰化縣</option>
                    <option value="南投縣">南投縣</option>
                    <option value="苗栗縣">苗栗縣</option>
                    <option value="雲林縣">雲林縣</option>
                </optgroup>
                <optgroup label="南部">
                    <option value="臺南市">臺南市</option>
                    <option value="高雄市">高雄市</option>
                    <option value="嘉義市">嘉義市</option>
                    <option value="屏東縣">屏東縣</option>
                </optgroup>
                <optgroup label="東部">
                    <option value="花蓮縣">花蓮縣</option>
                    <option value="臺東縣">臺東縣</option>
                </optgroup>
                <optgroup label="離島">
                    <option value="澎湖縣">澎湖縣</option>
                    <option value="金門縣">金門縣</option>
                    <option value="馬祖縣">馬祖縣</option>
                    <option value="綠島縣">綠島縣</option>
                    <option value="蘭嶼縣">蘭嶼縣</option>
                </optgroup>
            </select>
        </div>
        <br>
        <div class="condition-radio text-start">
            <div class="radio-head fs-5 fw-bolder border-bottom pb-2">
                <label>天數</label>
            </div>

            <!--div class="radio-group pt-2 pb-1">
                <div class="form-check pb-1">
                    <input class="form-check-input " type="radio" name="date" value=" "><label class="form-check-label fw-bold">全部(0)</label>
                </div>
            </div-->
            <div class="radio-group  pt-2 pb-1">
                <div class="form-check pb-1">
                    <input class="form-check-input pb-2" type="radio" name="date" value="1"><label class="form-check-label fw-bold">當天來回(0)</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="date" value="2"><label class="form-check-label fw-bold">兩日遊(0)</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="date" value="3"><label class="form-check-label fw-bold">三日遊(0)</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="date" value="4~6"><label class="form-check-label fw-bold">四天~六天(0)</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="date" value="7~9"><label class="form-check-label fw-bold">七天~九天(0)</label>
                </div>
            </div>
            <div class="radio-group">
                <div class="form-check pb-1">
                    <input class="form-check-input" type="radio" name="date" value="10~99"><label class="form-check-label fw-bold">十天以上(0)</label>
                </div>
            </div>
        </div>

        <div class="condition-radio text-start">
            <div class="condition-radio">
                <div class="radio-head  fs-5 fw-bolder border-bottom pb-2">
                    <label>性別</label>
                </div>
                <div class="radio-group">
                    <div class="form-check pt-2 pb-1">
                        <input class="form-check-input" type="radio" name="sex" value="不拘"><label class="form-check-label fw-bold">不拘</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="sex" value="male"><label class="form-check-label fw-bold">男</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="sex" value="female"><label class="form-check-label fw-bold">女</label>
                    </div>
                </div>
            </div>
        </div>



        <div>
            <div class="condition-radio text-start">
                <div class="radio-head  fs-5 fw-bolder border-bottom pb-2">
                    <label>技能</label>
                </div>
                <div class="radio-group">
                    <div class="form-check pt-2 pb-1">
                        <input class="form-check-input" type="radio" name="skill" value="不需要"><label class="form-check-label fw-bold">不需要</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="skill" value="car"><label class="form-check-label fw-bold">開車</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="skill" value="motorcycle"><label class="form-check-label fw-bold">騎車</label>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="condition-radio text-start">
                <div class="radio-head  fs-5 fw-bolder border-bottom pb-2">
                    <label>人數</label>
                </div>
                <div class="radio-group">
                    <div class="form-check pt-2 pb-1">
                        <input class="form-check-input" type="radio" name="NOpeople" value="不拘"><label class="form-check-label fw-bold">不拘</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="NOpeople" value="2~4"><label class="form-check-label fw-bold">2~4人</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="NOpeople" value="5~7"><label class="form-check-label fw-bold">5~7人</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="NOpeople" value="8~10"><label class="form-check-label fw-bold">8~10人</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="NOpeople" value="11"><label class="form-check-label fw-bold">10人以上</label>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="condition-radio text-start">
                <div class="radio-head  fs-5 fw-bolder border-bottom pb-2">
                    <label>年齡</label>
                </div>
                <div class="radio-group">
                    <div class="form-check pt-2 pb-1">
                        <input class="form-check-input" type="radio" name="age" value="不限制"><label class="form-check-label fw-bold">不限制</label>
                    </div>
                </div>
                <div class="radio-group pb-1">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="age" value="20"><label class="form-check-label fw-bold">20~30歲</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="age" value="31"><label class="form-check-label fw-bold">31~40歲</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="age" value="41"><label class="form-check-label fw-bold">41~50歲</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-2 border-bottom mb-3">
                        <input class="form-check-input" type="radio" name="age" value="51"><label class="form-check-label fw-bold">51歲以上</label>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <input type="submit" id="searchForm" class="btn btn-primary" value="搜尋">
                </div>
            </div>
        </div>
    </form>
</div>
</div>

@endsection

@section('PostBtn')

@if(session('user_name')!=null)
<form action="/mjoin_post_form" method="POST">
    <div class="d-grid gap-2">
        @csrf
        <input type="submit" class="btn btn-primary" value="發文">
    </div>
</form>
@endif

@endsection

@section('Post')
@if(isset($error_message))
    <div class="alert alert-danger">
        {{ $error_message }}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif
@php
                        // 将日期范围拆分为开始日期和结束日期
        $dates = explode(' - ', $mjoin->time);

        // 将开始日期和结束日期转换为 Carbon 实例
        $start_date = \Carbon\Carbon::parse($dates[0]);
        $end_date = \Carbon\Carbon::parse($dates[1]);
        $current_time = \Carbon\Carbon::now();
    @endphp
<div class="outside">
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="image-container">
                <a href="/user-profile/index/d/{{ $mjoin->posted_by_u }}">
                    @if($mjoin->profileImage != null)
                        <?php $imageDataUri = 'data:' . $mjoin->profileImage_type  . ';base64,' . base64_encode( $mjoin->profileImage ); ?>
                        <img src="{{ $imageDataUri }}" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                    @else
                        <img src="https://github.com/mdo.png"  class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                    @endif
                    </a>
                </div>
                <div class="text-container">
                    <div class="user">
                        <!--貼文用戶名-->
                        <div><a href="/user-profile/index/d/{{ $mjoin->posted_by_u }}">{{ $mjoin->posted_by_u }}</a></div>
                    </div>
                    <div class="date">
                        <!--貼文日期-->
                        <div><a href="#">{{ $mjoin->date }}</a></div>
                    </div>
                </div>
                @if($current_time>$end_date)
                    <div class="d-flex justify-content-end">
                        <img style="width: 120px; margin-top: -80px;" src="{{ asset('image/停止招募.png') }}" alt="">
                    </div>
                @else
                    <div class="d-flex justify-content-end">
                        <img style="width: 120px; margin-top: -80px;" src="{{ asset('image/正在招募.png') }}" alt="">
                    </div>
                @endif
                <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;top:-30px;position:relative;">
                    <label class="flex-fill ps-3">目的:{{ $mjoin->destination }}</label>
                    <label class="flex-fill ps-3">日期:{{ $mjoin->time }}</label>
                    <label class="flex-fill">人數:{{ $mjoin->people }}</label>
                    <label class="flex-fill">預算:{{ $mjoin->money }}</label>
                    <label class="flex-fill">性別:{{ $mjoin->sex }}</label>
                    <label class="flex-fill">需要技能:{{ $mjoin->skill }}</label>
                    <label class="flex-fill pe-3">年齡:{{ $mjoin->age }}</label>
                </div>
                <div class="clearfix"></div>
                <div class="image-container">
                    <div class="d-block mb-3 text-start text-break">
                        @php
                        // 从 $mjoin->description 中提取文本和图片
                        $text = strip_tags($mjoin->description); // 提取并限制文本长度为150字
                        preg_match_all('/<img[^>]+src="([^">]+)"/', $mjoin->description, $matches); // 提取第一个图片
                            $images = !empty($matches[1]) ? $matches[1] : null;
                            $allimg = array();
                            if($images){
                                foreach($images as $image){
                                    $allimg[] = $image;
                                }
                            }
                            $imgcount = 1;
                            @endphp
                            @if(strlen($text) > 150)
                            <p>{!! $text !!}</p>
                            
                            @else
                            <p>{!! $text !!}</p>
                            @endif
                            @if ($images)
                            <div id="carouselExampleControlsNoTouching{{ $mjoin->id }}" class="carousel carousel-dark slide" data-bs-interval="false">
                                <div class="carousel-inner">
                                    @foreach($allimg as $allimgs)
                                    @if($imgcount==1)
                                    <div class="carousel-item active {{ $mjoin->id }}">
                                        <img src="{{ $allimgs }}" class="d-block mx-auto" alt="Image">
                                    </div>
                                    @php
                                    $imgcount +=1;
                                    @endphp
                                    @else
                                    <div class="carousel-item {{ $mjoin->id }}">
                                        <img src="{{ $allimgs }}" class="d-block mx-auto" alt="Image">
                                    </div>
                                    @php
                                    $imgcount +=1;
                                    @endphp
                                    @endif

                                    @endforeach
                                </div>
                                @if($imgcount > 2)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching{{ $mjoin->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching{{ $mjoin->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                @endif
                            </div>

                            @endif
                    </div>
                </div>


                <div class="container">
                    <div class="respond">

                        <a href="#">👍🏽</a>
                        <div>
                            <a href="#">
                                <span class="goodcount_{{ $mjoin->id }}"></span>
                            </a>
                        </div>

                    </div>
                    <div class="messagecount" id="messagecount_{{ $mjoin->id }}">

                    </div>
                </div>
                <div class="line">
                    @if(session('user_name')!=null)
                    <a href="#" data-mjoin-id="{{ $mjoin->id }}" class="like-button">
                        <div class="inner-grid">
                            <span class="material-icons animate__animated">
                            </span>
                            <div class="">讚</div>
                        </div>
                    </a>
                    @endif
                    @php
                        // 将日期范围拆分为开始日期和结束日期
                        $dates = explode(' - ', $mjoin->time);

                        // 将开始日期和结束日期转换为 Carbon 实例
                        $start_date = \Carbon\Carbon::parse($dates[0]);
                        $end_date = \Carbon\Carbon::parse($dates[1]);
                        $current_time = \Carbon\Carbon::now();
                    @endphp
                    <!--文章結束後才能評分-->
                    

                    <!-- 显示评分按钮 -->
                    @php
                        if(Auth::check()){
                            $userMjoinScore = \App\Models\MjoinScore::where('rater_id', Auth::user()->id)
                                                                    ->where('article_id', $mjoin->id)
                                                                    ->exists();
                            $userJoinMjoinStatus = \App\Models\User_join_mjoin::where('user_id', Auth::user()->id)
                                                                            ->where('article_id', $mjoin->id)
                                                                            ->value('status');
                            $userPostMjoinStatus = \App\Models\UserPostMjoin::where('id', $mjoin->id)
                                                                            ->value('status');

                            //$user_post_mjoin = DB::table('mjoin')->where('id',$mjoin->id)->where('posted_by_u',Auth::user()->username)->where('status','<>',['del'])->exists();

                            $user_post_mjoin_join = DB::table('join_mjoin')->where('article_id',$mjoin->id)->exists();

                            $dates = explode(' - ', $mjoin->time);

                        // 将开始日期和结束日期转换为 Carbon 实例
                            $start_date = \Carbon\Carbon::parse($dates[0]);
                            $end_date = \Carbon\Carbon::parse($dates[1]);
                            $current_time = \Carbon\Carbon::now();
                        
                        }
                    @endphp
                    @if(Auth::check())
                        @if($user_post_mjoin_join && $end_date < $current_time)
                            @if($userJoinMjoinStatus == 'complete' || $userPostMjoinStatus == 'complete')
                            <a href="/score_form/{{ $mjoin->id }}">
                                <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="要完成評分喔">評分</button>
                            </a>
                            @else
                            
                            @endif

                        @endif
                    @endif


                                
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">
                        <div class="modal-dialog mx-auto">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">刪除文章</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    您確定要刪除該揪團的文章?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">返回</button>
                                    <form action="/mjoin_post_posts/edit/delete/{{ $mjoin->id }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">確定刪除</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($current_time < $end_date)
                        @if(session('user_name')==$mjoin->posted_by_u)
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                更多
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="/mjoin_post_posts/edit/{{ $mjoin->id }}">編輯</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">刪除</a></li>
                                <li><a id="collect_{{ $mjoin->id }}" class="dropdown-item" href="javascript:void(0);" data-mjoin-id="{{ $mjoin->id }}" onclick="collect({{ $mjoin->id }})">
                                    @if($mjoin->status_b == 0)
                                        收藏
                                    @elseif ($mjoin->status_b == 1)
                                        取消收藏
                                    @endif
                                    </a></li>
                            </ul>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">
                                <div class="modal-dialog mx-auto">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">刪除文章</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            您確定要刪除該揪團的文章?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">返回</button>
                                            <form action="/mjoin_post_posts/edit/delete/{{ $mjoin->id }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">確定刪除</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endif
                    @endif

                    <!--時間過了也不給加-->
                    @if(session('user_name')!=null && session('user_name')!=$mjoin->posted_by_u && 
                    !\Carbon\Carbon::now()->gt($end_date))
                    <div class="inner-grid">
                        <span><a href="/join_mjoin/{{ $mjoin->id }}">加入</a></span>
                    </div>
                    @endif
                </div>
                
                <div class="ShowAllMessage" id="showAllMessage_{{ $mjoin->id }}">

                </div>
                @if(session('user_name')!=null)
                    
                        @csrf
                        <div class="LeaveMessageInput flex-row">
                            <div class="LeaveMessageInputrpAname p-2">
                                @if(Auth::user()->profileImage != null)
                                    <?php $imageDataUri = 'data:' . Auth::user()->profileImage_type  . ';base64,' . base64_encode( Auth::user()->profileImage ); ?>
                                    <img src="{{ $imageDataUri }}" alt="mdo" width="50" height="50" class="rounded-circle">
                                @else
                                    <img src="https://github.com/mdo.png" alt="mdo" width="50" height="50" class="rounded-circle">
                                @endif
                            </div>
                            <div class="p-2">
                                <textarea class="form-control" placeholder="留言" id="messageTextarea_{{ $mjoin->id }}" name="messageTextarea_{{ $mjoin->id }}" rows="1"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submitReply" onclick="submitReply({{ $mjoin->id }})">留言</button>
                        </div>
                        
                    
                @endif

                <div class="ShowAllMessage">
                    <script>
                        @if(Auth::check())
                        document.getElementById('messageTextarea_{{ $mjoin->id }}').addEventListener('keypress', function(event) {
                            if (event.key === 'Enter') {
                                event.preventDefault();
                                submitReply({{ $mjoin->id }});
                            }
                        });
                        @endif
                        $(document).ready(function() {

                            showReply({{ $mjoin -> id }});
                            messagecount({{ $mjoin -> id }});
                            mjoin_post_countgood({{ $mjoin -> id }})

                        });
                        function showReply(mjoinId) {
                            $.ajax({
                                url: "/front-reply-all/" + mjoinId,
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

                        function mjoin_post_countgood(mjoinId) {
                            $.ajax({
                                url: "/mjoin_post_posts/countgood/" + mjoinId,
                                type: "GET",
                                success: function(response) {
                                    $('.goodcount_' + mjoinId).html(response.count);
                                    $('.goodcount_' + mjoinId).show();
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                        var interval = 2000; 
                        setInterval(function() {
                            // 调用 fetchData 并传递参数
                            showReply({{ $mjoin -> id }});
                        }, interval);

                        function showReplyall(mjoinId) {
                            $.ajax({
                                url: "/front-reply-all/" + mjoinId,
                                type: "GET",
                                success: function(response) {
                                    // 在彈出的視窗中顯示留言
                                    $('#showAllMessageall_' + mjoinId).html(response.htmlContent);
                                    $('#showAllMessageall_' + mjoinId).show();
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            })
                        }
                        var interval = 1000; 
                        setInterval(function() {
                            // 调用 fetchData 并传递参数
                            showReplyall({{ $mjoin -> id }});
                        }, interval);
                                         
                    </script>
                </div>

            </div>
        </div>
    </div>



    <script>
        

        $(document).ready(function() {
            // 获取所有点赞按钮
            var links = $('.like-button');
            
           

            // 对每个按钮进行处理
            links.each(function() {
                var link = $(this);
                var mjoinId = link.data('mjoin-id');

                // 发送 AJAX 请求来检查用户的点赞状态
                $.ajax({
                    type: 'GET',
                    url: '/mjoin_post_posts/checkgood/' + mjoinId,
                    success: function(response) {
                        if (response.status === 'true') {
                            // 如果用户已经点赞，添加 liked 类来改变按钮的样式
                            link.addClass('liked');
                            link.find('.material-icons').text('thumb_up');
                            link.find('.fs-6').text('讚');
                        } else {
                            link.removeClass('liked');
                            link.find('.material-icons').text('thumb_up_off_alt');
                            link.find('.fs-6').text('讚');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

                // 点击事件处理
                link.click(function(event) {
                    event.preventDefault(); // 阻止默认行为

                    // 检查超链接是否已经被喜欢
                    if (link.hasClass('liked')) {
                        // 調用取消喜歡的函數
                        ungood(mjoinId, link);
                    } else {
                        // 調用喜歡的函數
                        good(mjoinId, link);
                    }

                    // 通过 Laravel Echo 監聽事件並更新相應的 HTML 元素
                   
                });

            });
        });

        // 讚
        function good(mjoinId, link) {
            $.ajax({
                url: "/mjoin_post_posts/good/" + mjoinId,
                type: "GET",
                success: function(response) {
                    link.addClass('liked'); // 添加 liked 类
                    link.find('.material-icons').text('thumb_up');
                    link.find('.material-icons').addClass('animate__jackInTheBox'); 
                    link.find('.fs-6').text('讚');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // 取消讚
        function ungood(mjoinId, link) {
            $.ajax({
                url: "/mjoin_post_posts/ungood/" + mjoinId,
                type: "GET",
                success: function(response) {
                    link.removeClass('liked'); 
                    link.find('.material-icons').removeClass('animate__jackInTheBox'); // 移除 liked 类
                    link.find('.material-icons').text('thumb_up_off_alt');
                    link.find('.fs-6').text('讚');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
        //收藏
        function collect(mjoinId){
            $.ajax({
                url:"/collect_mjoin/collect/" + mjoinId,
                type: "GET",
                success: function(response) {
                    if(response.status == 'NO') {
                        $('#collect_' + mjoinId).text('收藏');
                    } else {
                        $('#collect_' + mjoinId).text('取消收藏');
                    }

                }
            })
        }
        //回復
        function submitReply(mjoinId) {
                            var messageTextarea = $('#messageTextarea_' + mjoinId).val();
                            if (messageTextarea.trim() === '') {
                                alert('留言不能為空');
                                return;
                            }

                            // 使用 GET 请求提交留言内容
                            $.ajax({
                                url: "/front-reply-submit/" + mjoinId,
                                type: "GET",
                                data: {
                                    messageTextarea: messageTextarea
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // 添加 CSRF token
                                },
                                success: function(response) {
                                    if(response.success == true){
                                        // 你可以在这里添加一些成功后的处理逻辑
                                        // 如刷新留言列表等
                                        showReply(mjoinId);
                                        messagecount(mjoinId);
                                        //alert(response.message); // 显示成功提示
                                        $('#messageTextarea_' + mjoinId).val(''); 
                                        console.log(messageTextarea);
                                    } else {
                                        //alert(response.message); // 显示错误提示
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                       

                        
    </script>
</div>
@endsection
