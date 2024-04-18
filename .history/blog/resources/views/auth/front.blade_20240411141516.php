<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@extends('layouts.frontpage')

@section('title', '')

@section('condition_add')
<div class="condition">
    <div class="radio-tophead d-block mx-auto fs-3 fw-bolder ">
        <label></label>
    </div>
    <form action="/search-mjoin" method="get" id="search_mjoin">
        @csrf
        <div class="condition-radio text-start">
            <div class="radio-head fs-5 fw-bolder border-bottom pb-2">
                <label>天數</label-->
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
                        <input class="form-check-input" type="radio" name="sex" value=" "><label class="form-check-label fw-bold">不拘</label>
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
                        <input class="form-check-input" type="radio" name="skill" value=" "><label class="form-check-label fw-bold">不需要</label>
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
                        <input class="form-check-input" type="radio" name="NOpeople" value=" "><label class="form-check-label fw-bold">不拘</label>
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
                        <input class="form-check-input" type="radio" name="age" value=" "><label class="form-check-label fw-bold">不拘</label>
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
<div class="outside">
@foreach($mjoins as $mjoin)

<div class="cut">
    <div class="grid-item">
        <div class="limt">
            <div class="image-container">
                <a href="/user-profile/index/d/{{ $mjoin->posted_by_u }}">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
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
            <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;">
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
                    $text = Str::limit(strip_tags($mjoin->description), 150); // 提取并限制文本长度为150字
                    preg_match_all('/<img[^>]+src="([^">]+)"/', $mjoin->description, $matches); // 提取第一个图片
                    $images = !empty($matches[1]) ? $matches[1] : null;
                    allimg = array();
                    if($images){
                        foreach($images as $image){
                            allimg[] = $image;
                        }
                    }
                @endphp
                <p>{{ $text }}</p>

                @if ($image)
                    <img src="{{ $image }}" alt="Image">
                    @foreach($allimg as $allimgs)
                    <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{  $allimgs }}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    @endforeach
                @endif
                </div>
            </div>


            <div class="container">
                <div class="respond">

                    <a href="#">👍🏽</a>
                    <div>
                        <a href="#">0</a>
                    </div>
                </div>
                <div class="messagecount" id="messagecount_{{ $mjoin->id }}">

                </div>
            </div>
            <div class="line">
                <div class="inner-grid">讚</div>
                <div class="inner-grid">
                    <a href="#" id="{{ $mjoin->id }}" data-mjoin-id="{{ $mjoin->id }}" onclick="showPopup({{ $mjoin->id }})">查看完整内容</a>
                </div>
                <div class="inner-grid">更多</div>
            </div>

            <div class="ShowAllMessage" id="showAllMessage_{{ $mjoin->id }}">

            </div>
            @if(session('user_name')!=null)
            <form action=" {{ route('front.reply.submit', ['mjoinid' => $mjoin->id]) }}" method="POST">
                @csrf
                <div class="LeaveMessageInput flex-row">
                    <div class="LeaveMessageInputrpAname p-2">
                        <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                    </div>
                    <div class="p-2">
                        <textarea class="form-control" placeholder="留言" id="floatingTextarea_{{ $mjoin->id }}" name="MessageTextarea_{{ $mjoin->id }}" rows="1"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">留言</button>
            </form>
            @endif
            <div class="ShowAllMessage">
                <script>
                    $(document).ready(function() {
                        showReply({{ $mjoin->id }});
                        messagecount({{ $mjoin->id }});
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
</div>

<br>
@endforeach
</div>
@endsection

