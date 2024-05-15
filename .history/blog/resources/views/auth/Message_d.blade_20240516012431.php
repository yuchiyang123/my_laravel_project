<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


@extends ('layouts.messagelo')

@section ('title','')

@section ('MessageStart')
    @include('auth.Message')
@endsection

@section ('MessageMid')

<main class="content">
    <div class=" p-0">
		<div class="card vh-100 d-flex">
			<div class="row g-0">
				<div class="">
                    <div id="message_head">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="d-flex align-items-center py-1">
                                @php
                                $user_img = \app\Models\User::where('id', $userid)->first();
                                if($user_img->profileImage_type != null){
                                    $imageDataUri = 'data:' . $user_img->profileImage_type  . ';base64,' . base64_encode( $user_img->profileImage );
                                } 
                                @endphp
                                <div class="position-relative">
                                    @if($user_img->profileImage_type != null)
                                        <img src="{{ $imageDataUri }}" class="rounded-circle mr-1" width="40" height="40">
                                    @else
                                    <img src="https://github.com/mdo.png" class="rounded-circle mr-1" width="40" height="40">
                                    @endif
                                    <img src="{{ $imageDataUri }}" class="rounded-circle mr-1" width="40" height="40">
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    <strong>{{ $receiver_id }}</strong>
                                    <div class="text-muted small"><em></em></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
					<div class="position-relative overflow-auto"  id='position-relative_msg' style="max-height: 800px; overflow-y: auto;height: calc(100% - 50px);">
                        @foreach($messagese as $message)
                        @if($message->user_id == Auth::user()->id)
                        <div style="display: flex; justify-content: flex-end;" id="message_show_db{{ $message->id }}">
						<div class="chat-messages p-4 " >{{ $message->message }}</div>
                        </div>
                        @else
                        <div style="display: flex; justify-content: flex-start;" id="message_show_db{{ $message->id }}">
                            <div class="chat-messages p-4 " >{{ $message->message }}</div>
                            </div>
                        @endif
                        @endforeach
                    </div>
                    <div class="position-sticky" style="bottom: 0; left: 0; width: 100%; background-color: #ffffff; padding: 10px; box-sizing: border-box;">
                        <div style="">
                            <input type="text" id="message_submit" style="width: calc(100% - 100px); height: 40px; padding: 5px;" onkeydown="handleKeyDown(event)">
                            <button type="submit" onclick="sendMessage({{ $receiver_id }})" style="width: 90px; height: 40px;">Send</button>
                        </div>
                    </div>
                    
				</div>
			</div>
		</div>
	</div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        Echo.channel('chata{{ $receiver_id }}{{ Auth::user()->id }}')
            .listen('msg', (e) => {
                console.log(e);
                // 將新消息添加到容器的末尾
                if(e.fromUserId == '{{ Auth::user()->id }}'){
                    $('#position-relative_msg').append('<div style="display: flex; justify-content: flex-end;" id="message_show_db{{ $receiver_id }}">'+'<div class="chat-messages p-4">' + e.message + '</div>'+'</div>')
                }
                    
                    
                else if(e.fromUserId != '{{ Auth::user()->id }}'){
                    $('#position-relative_msg').append('<div style="display: flex; justify-content: flex-start;" id="message_show_db{{ $receiver_id }}">'+'<div class="chat-messages p-4">' + e.message + '</div>'+'</div>')
                }
                    
            });
            Echo.channel('chata{{ Auth::user()->id }}{{ $receiver_id }}')
            .listen('msg', (e) => {
                console.log(e);
                // 將新消息添加到容器的末尾
                if(e.fromUserId == '{{ Auth::user()->id }}'){
                    $('#position-relative_msg').append('<div style="display: flex; justify-content: flex-end;" id="message_show_db{{ $receiver_id }}">'+'<div class="chat-messages p-4">' + e.message + '</div>'+'</div>')
                }
                    
                    
                else if(e.fromUserId != '{{ Auth::user()->id }}'){
                    $('#position-relative_msg').append('<div style="display: flex; justify-content: flex-start;" id="message_show_db{{ $receiver_id }}">'+'<div class="chat-messages p-4">' + e.message + '</div>'+'</div>')
                }
                    
            });
    });
    function sendMessage($receiver_id){
        var message = $('#message_submit').val();
        if(message.trim()===''){
            alert('請輸入內容');
            return;
        }
        $.ajax({
            url:"/chat_store/"+$receiver_id,
            type:"GET",
            data:{
                message:message
            },
            success:function(response){
                $('#message_submit').val('');
            },
            error:function(error){
                console.log(error);
            }
        });
    }
    function handleKeyDown(event) {
        if (event.key === 'Enter' && !event.shiftKey) { // 如果按下 Enter 鍵且沒有按下 Shift 鍵
            event.preventDefault(); // 防止預設的 Enter 鍵行為
            sendMessage({{ $receiver_id }}); // 呼叫傳送訊息函式
        }
    }

 </script>
 
@endsection

@section ('MessageEnd')


@endsection
