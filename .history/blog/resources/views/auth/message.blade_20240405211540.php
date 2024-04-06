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
        <div class="UserMassageBox">
            <a href="#" onclick="messageall('{{ $message->senderu }}')">
                <div class="d-flex flex-row align-items-center">
                    <img src="{{ asset('image/head.png') }}" style="width: 90px;" class="user_img_message" id="{{ $message->senderu }} ">
                    <div class="">
                        <div class="d-flex align-items-center fw-bold UserMassageBoxName">
                            <span class="">{{ $message->senderu }}</span>
                        </div>
                        <div class="d-flex align-items-center UserMassageBoxMessage">
                            <span class="">{{ mb_strimwidth($message->main ,0 , 20, '...') }} </span>
                            <span class="">。{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans(null,true) }}</span>
                        </div>
                    </div>

                </div>
                
            </a>
        </div>
    </div>
    @endforeach
</div>
<script>

function messageall(senderu) {
    $.ajax({
        url: "/message-view-show/" + senderu,
        type: "GET",
        success: function(response) {
            $('#message_head').html(response.htmlContent_head);
            $('#message_show_d').html(response.htmlContent_message);
            $('#message_show_d').show();
            $('#message_head').show();
            
            // 更新消息内容，并设置定时器以实现实时更新
            update(response.htmlContent_message);
            setInterval(function() {
                update(response.htmlContent_message);
            }, 500); // 每5秒更新一次
        },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function update(htmlContent_message) {
        var datadisplay = $('#message_show_d');
        datadisplay.html(htmlContent_message);
        datadisplay.scrollTop(datadisplay[0].scrollHeight);
    }


</script>
@endsection

@section ('MessageMid')

<main class="content">
    <div class=" p-0">
		<div class="card vh-100 d-flex">
			<div class="row g-0">
				<div class="">
                    <div id="message_head">
                    </div> 
					<div class="position-relative" >
						<div class="chat-messages p-4 " id="message_show_d">
							
                          
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection

@section ('MessageEnd')


@endsection
