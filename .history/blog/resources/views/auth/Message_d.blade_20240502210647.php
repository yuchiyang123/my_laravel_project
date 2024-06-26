<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

@extends ('layouts.messagelo')

@section ('title','')

@section ('MessageMid')

<main class="content">
    <div class=" p-0">
		<div class="card vh-100 d-flex">
			<div class="row g-0">
				<div class="">
                    <div id="message_head">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="d-flex align-items-center py-1">
                                <div class="position-relative">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" width="40" height="40">
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    <strong>{{ $messagessolo->receiver_id }}</strong>
                                    <div class="text-muted small"><em></em></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
					<div class="position-relative" >
                        @foreach($messages as $message)
						<div class="chat-messages p-4 " id="message_show_d">{{ $message->message }}</div>
                        @endforeach
                    </div>
                    <div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
   $(document).ready(function() {
    console.log(Echo);
    console.log('chat{{ Auth::user()->id }}{{ $receiver_id }}');
    Echo.channel('chat{{ Auth::user()->id }}{{ $receiver_id }}')
        //console.log('chat{{ Auth::user()->id }}{{ $receiver_id }}');
        //console.log(Echo);
        .listen('msg', (e) => {
            console.log('chat{{ Auth::user()->id }}{{ $receiver_id }}');
            // 更新界面上對應帖子的點讚數顯示
            $('#message_show_d').html('<div class="chat-messages p-4" id="message_show_d">' + e.message + '</div>');
        });
});
</script>

@endsection

@section ('MessageEnd')


@endsection
