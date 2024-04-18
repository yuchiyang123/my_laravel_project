<script src="{{ asset('js/app.js') }}"></script>
<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.min.js"></script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

@extends('layouts.layoutback')

@section('title', '')

@section('Form')

<div class="cut">
    <div class="grid-item">
        <div class="limt">
            <div class="text-container">
                <div class="title">
                    <h3>{{ $userarkworksolo->title }}</h3>
                </div>
            </div>
            <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;">
                <label class="flex-fill ps-3">創作者:{{ $userarkworksolo->posted_by_u }}</label>
                <label class="flex-fill">創作日期:{{ $userarkworksolo->created_at }}</label>
            </div>
            <div class="clearfix"></div>
            <div class="image-container">
                <div class="d-block mb-3 mt-3 text-start text-break">
                    {!! $userarkworksolo->main !!}
                </div>
            </div>


            <div class="container">
                <div class="respond">

                    <a href="#">👍🏽</a>
                        <div>
                            <a href="#">
                                <span class="goodcount_{{ $userarkworksolo->id }}"></span>
                            </a>
                        </div>
                </div>
                <div class="messagecount" id="messagecount_{{ $userarkworksolo->id }}">

                </div>
            </div>
            <div class="line">
                <a href="#" data-mjoin-id="{{ $userarkworksolo->id }}" class="like-button">
                        <div class="inner-grid">
                            <span class="material-icons animate__animated">

                            </span>
                            <div class="">讚</div>
                        </div>
                    </a>
                </div>
                <div class="inner-grid">
                    <a href="#"></a>
                </div>
                <div class="inner-grid">更多</div>
            </div>
            <div class="ShowAllMessage" id="">
                @if($userartworkreplys!=null)
                    @foreach($userartworkreplys as $userartworkreply)
                    <div class="LeaveMessage">
                        <div>
                            <div class="LeaveMessageimgdiv">
                                <a href="/user-profile/index/d/'.$mjoin_reply->name_u.' ">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                                </a>
                            </div>
                            <div class="LeaveMessageall">
                                <div class="LeaveMessageUsername">
                                    <a href="/user-profile/index/d/'.$mjoin_reply->name_u.'">{{ $userartworkreply->name_u }}</a>
                                </div>
                                <div class="LeaveMessageMain">
                                    {{ $userartworkreply->main }}
                                </div>
                                <div class="LeaveMessageAction">
                                    <a href="#">{{ $userartworkreply->created_at }}</a>&emsp;
                                    <a href="'.$mjoin_reply->level.$mjoin_reply->reply_id.'">回覆</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="LeaveMessage" style="text-align:center;width:auto;display:inline-block;">
                        <h2>無留言</h2>
                    </div>
                @endif
                
            </div>
        </div>
            <form action="{{ route('artwork_reply_sumbit',[ 'ark_id' => $userarkworksolo->id ]) }}" method="POST">
                @csrf
                <div class="LeaveMessageInput flex-row">
                    <div class="LeaveMessageInputrpAname p-2">
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                    </div>
                    <div class="p-2">
                        <textarea class="form-control" placeholder="留言" id="floatingTextarea_{{ $userarkworksolo->id }}" name="MessageTextarea_{{ $userarkworksolo->id }}" rows="1"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">留言</button>
            </form>
        </div>
    </div>
</div>
<script>
     $(document).ready(function() {
        art_post_countgood({{ $userarkworksolo->id }});

        

        var link = $('.like-button');

        var article_id = {{ $userarkworksolo->id }};
        Echo.channel('article_id_' + article_id)
            .listen('PostGoodCountUDARK', (e) => {
                $('.goodcount_' + e.article_id).text(e.goodcount);
            });
            $.ajax({
                    type: 'GET',
                    url: '/art_post_posts/checkgood/' + article_id,
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
                link.click(function(event) {
                    event.preventDefault(); // 阻止默认行为

                    // 检查超链接是否已经被喜欢
                    if (link.hasClass('liked')) {
                        // 調用取消喜歡的函數
                        ungood(article_id, link);
                    } else {
                        // 調用喜歡的函數
                        good(article_id, link);
                    }
                   
                });
    });

    function mjoin_post_countgood(mjoinId) {
                            $.ajax({
                                url: "/art_post_posts/countgood/" + mjoinId,
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

    function good(article_id, link) {
            $.ajax({
                url: "/art_post_posts/good/" + article_id,
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
        function ungood(article_id, link) {
            $.ajax({
                url: "/art_post_posts/ungood/" + article_id,
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
        function collect(article_id){
            $.ajax({
                url:"/collect_artwork/collect/" + article_id,
                type: "GET",
                success: function(response) {
                    if(response.status == 'NO') {
                        $('#collect_' + article_id).text('收藏');
                    } else {
                        $('#collect_' + article_id).text('取消收藏');
                    }

                }
            })
        }
    
</script>
@endsection