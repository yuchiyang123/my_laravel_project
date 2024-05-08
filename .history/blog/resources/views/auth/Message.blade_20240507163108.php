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
                        <div class="d-flex flex-row align-items-center" id="message_show_d{{ $message->receiver_id }}">
                            <img src="{{ asset('image/head.png') }}" style="width: 90px;" class="user_img_message" id="l_{{ $message->receiver_id }}">
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
        // Check if there are any messages
        var messages = {!! $messages->isNotEmpty() ? json_encode($messages->first()) : 'null' !!};
    
        // If there are messages, activate WebSocket
        if(messages !== null) {
            activateWebSocket(messages.receiver_id);
        } else {
            // If no messages, listen on all potential channels
            listenOnAllChannels();
        }
    
        // Function to activate WebSocket
        function activateWebSocket(receiverId) {
            Echo.channel('chat{{ Auth::user()->id }}' + receiverId)
                .listen('msg_outside', (e) => {
                    console.log(e);
                    // Construct HTML for new message
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
                    
                    // Check if there is an existing message with the same receiver_id
                    var existingMessage = $('#message_show_d' + e.toUserId);
                    console.log(existingMessage);
                    if(existingMessage.length > 0) {
                        // If exists, update message content
                        existingMessage.html(newMessage);
                    } else {
                        // Otherwise, prepend the new message to the container
                        $('#message_container').prepend(newMessage);
                    }
                });
        }
    
        // Function to listen on all potential channels
        function listenOnAllChannels() {
            if(Auth::check()){
                // If user is logged in, listen on all potential channels
                Echo.channel('chat{{ Auth::user()->id }}')
                    .listen('msg_outside', (e) => {
                        console.log(e);
                        // Handle messages as needed
                    });
                }
        }
    });
    </script>
    

@endsection



@section ('MessageEnd')


@endsection
