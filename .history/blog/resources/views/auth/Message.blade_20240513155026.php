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
    <div class="UserMassageBox" >
        @php
        $processed_user_ids = []; // 用于存储已处理的用户ID
        $processed_receiver_ids = []; // 用于存储已处理的接收者ID
    @endphp

    @foreach ($messages as $message)
        @php
            // 检查是否已经处理过该用户ID或接收者ID，如果是则跳过
            if (in_array($message->user_id, $processed_user_ids) || in_array($message->receiver_id, $processed_receiver_ids) || in_array($message->receiver_id, $processed_user_ids) || in_array($message->user_id, $processed_user_ids)){
                break;
            }
        


            // 将当前用户ID和接收者ID添加到已处理数组中
            if(Auth::user()->id == $message->user_id){
                
            } else {
                $processed_user_ids[] = $message->user_id;
            }

            if(Auth::user()->id == $message->receiver_id){
                
            } else {
                $processed_receiver_ids[] = $message->receiver_id;
            }
            //$processed_receiver_ids[] += $message->receiver_id;

            // 确定链接的用户ID
            $userid = ($message->user_id == Auth::user()->id) ? $message->receiver_id : $message->user_id;
        @endphp

        <div>
        <a href="/message-view-show/{{ $userid }}" >
            <div id= "message_container">
                <div class="d-flex flex-row align-items-center" id="message_show_d{{ $message->receiver_id }}">
                    <img src="{{ asset('image/head.png') }}" style="width: 90px;" class="user_img_message" id="l_{{ $message->receiver_id }}">
                    <div class="">
                        <div class="d-flex align-items-center fw-bold UserMassageBoxName">
                            <span class="">{{ $message->user_id == Auth::user()->id ? $message->receiver_id : $message->user_id }}</span>
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
@endforeach

    </div>
    
</div>

<script>
$(document).ready(function() {
        
        //console.log(messages);
        Echo.channel('chat{{ Auth::user()->id }}')
        .listen('msg_outside', (e) => {
            console.log(e);
            // 构造新消息的 HTML 元素
            var newMessage = `
                <a href="/message-view-show/${e.toUserId}" >
                    <div id= "message_container">
                <div class="d-flex flex-row align-items-center" id="message_show_d${e.toUserId}">
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
            </div>
                    
                </a>
            `;
            
            // 查找页面上是否已存在相同 receiver_id 的消息
            var existingMessage = $('#message_show_d' + e.toUserId);
            var existingMessage1 = $('#message_show_d' + e.fromUserId);
            console.log(existingMessage);
            if(existingMessage.length > 0) {
                // 如果存在，则更新消息内容
                existingMessage.html(newMessage);
                
            }else if(existingMessage1.length > 0) {
                    existingMessage.html(newMessage);
                }
            else {
                // 否则将新消息添加到容器的顶部
                $('.UserMassageBox').prepend(newMessage);
            }
        });
    
    
});



 
 </script>

@endsection



@section ('MessageEnd')


@endsection
