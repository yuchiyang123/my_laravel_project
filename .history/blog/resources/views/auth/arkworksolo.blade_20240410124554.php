<!--script src="{{ asset('js/test.js') }}"></script-->
<script type="module" src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.0/dist/echo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.2.0/socket.io.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/userprofile.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

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
                        <a href="#">0</a>
                    </div>
                </div>
                <div class="messagecount" id="messagecount_{{ $userarkworksolo->id }}">

                </div>
            </div>
            <div class="line">
                <div class="inner-grid">
                    <form id="like-form" action="{{ route('posts.like', ['reply_id' => $userarkworksolo->id, 'great_code' => 'artwork']) }}" method="POST">
                        @csrf
                        @if(!$usersologood)
                            <button type="submit" class="ui icon button" data-reply-id="{{ $userarkworksolo->id }}">
                                <ion-icon name="thumbs-up-outline">讚</ion-icon>
                            </button>
                        @elseif($usersologood->many=="1")
                            <button type="submit" class="ui icon button" data-reply-id="{{ $userarkworksolo->id }}">
                                <ion-icon name="thumbs-up"></ion-icon>
                            </button>
                        @else
                            <button type="submit" class="ui icon button" data-reply-id="{{ $userarkworksolo->id }}">
                                <ion-icon name="thumbs-up-outline"></ion-icon>
                            </button>
                        @endif
                    </form>
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
    function date(){
        window.Echo = new Echo({
            broadcaster: 'socket.io',
            host: window.location.hostname + ':6001' // 如果 Laravel Echo Server 在同一個主機上運行，可以直接使用 window.location.hostname
        });

    // 訂閱事件頻道
        window.Echo.channel('click_good.' + replyId)
            .listen('click_good', function(event) {
                console.log('有人按讚了這篇貼文:', event);
                // 在這裡執行相應的操作，例如更新 UI
            });

    }
    
</script>
@endsection