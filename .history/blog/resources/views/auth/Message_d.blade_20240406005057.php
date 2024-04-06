<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="{{ $senderu }}" width="40" height="40">
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    <strong>{{ $senderu }}</strong>
                                    <div class="text-muted small"><em></em></div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="position-relative" >
						<div class="chat-messages p-4 " id="message_show_d">
                            @foreach($messages_d as $message)
                                @if($message->senderu === $username)
                                    <div class="chat-message-right pb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="{{ $username }}" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1">You</div>
                                            {{ $message->main }}
                                        </div>
                                    </div>
                                @else
                                    <div class="chat-message-left pb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="{{ $message->senderu }}" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">2:34 am</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                            <div class="font-weight-bold mb-1">{{ $message->senderu }}</div>
                                            {{ $message->main }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach  
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection

@section ('MessageEnd')


@endsection
