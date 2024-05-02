<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@extends ('layouts.messagelo')

@section ('title','')


@section ('MessageFirst')
<div class="">
    <div class="d-flex m-3 fw-bold align-items-center">
        <div class="">
            <label class="fs-3">聊天室</label>
        </div>
        <button class="circular ui icon button">
            <i class="edit icon"></i>
        </button>
    </div>
    <div class="" style="width: 95%;margin: auto;">
        <div class="ui action input W-100">
            <input type="text" placeholder="搜尋">
            <button class="ui icon button">
                <i class="search icon"></i>
            </button>
        </div>
    </div>
    @foreach ($messages as $message)
    <div>
        <div class="UserMassageBox" >
            <a href="/message-view-show/t/{{ $message->receiver_id }}" >
                <div id= "message_container">
                    <div class="d-flex flex-row align-items-center" id="message_show_d{{ $message->id }}">
                        <img src="{{ asset('image/head.png') }}" style="width: 90px;" class="user_img_message" id="l_{{ $message->receiver_id }} ">
                        <div class="">
                            <div class="d-flex align-items-center fw-bold UserMassageBoxName">
                                <span class="">{{ $message->receiver_id }}</span>
                            </div>
                            <div class="d-flex align-items-center UserMassageBoxMessage">
                                <span class="">{{ $message->message }} </span>
                                <span class="">。{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans(null,true) }}</span>
                            </div>
                        </div>

                    </div>
                </div>
                
            </a>
        </div>
    </div>
    @endforeach
</div>

<script>
$(document).ready(function() {
    // 存储已存在的消息的对象
    var existingMessages = {};

    // 在页面加载时，查找并填充已存在的消息对象
    $('.user_img_message').each(function() {
        var messageId = $(this).attr('id').split('_')[1];
        existingMessages[messageId] = true;
    });

    Echo.channel('chat{{ Auth::user()->id }}{{ $message->receiver_id }}')
        .listen('msg_outside', (e) => {
            console.log(e);
            // 构造新消息的 HTML 元素
            var newMessage = `
                <div class="d-flex flex-row align-items-center" id="message_show_d${e.message_id}">
                    <img src="https://github.com/mdo.png" style="width: 90px;" class="user_img_message" id="l_${e.toUserId}">
                    <div class="">
                        <div class="d-flex align-items-center fw-bold UserMassageBoxName">
                            <span>${e.toUserId}</span>
                        </div>
                        <div class="d-flex align-items-center UserMassageBoxMessage">
                            <span>${e.message}</span>
                            <span>。${e.created_at}</span>
                        </div>
                    </div>
                </div>
            `;
            
            // 查找页面上是否已存在相同 message_id 的消息
            var existingMessage = existingMessages[e.message_id];
            if(existingMessage) {
                // 如果存在，则更新消息内容
                $('#message_show_d' + e.message_id).html(newMessage);
            } else {
                // 否则将新消息添加到容器的顶部
                $('#message_container').prepend(newMessage);
                // 将新消息添加到已存在的消息对象中
                existingMessages[e.message_id] = true;
            }
        });
});




 
 </script>

@endsection



@section ('MessageEnd')


@endsection
