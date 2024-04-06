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
        <div class="UserMassageBox" data-senderu="{{ $message->senderu }}">
            <a href="/message-view-show/t/'{{ $message->senderu }}'" >
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
@endsection



@section ('MessageEnd')


@endsection
