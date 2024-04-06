@extends ('layouts.messagelo')

@section ('title','')

@section ('MessageFirst')
<div class="">
    <div class="d-flex">
        <div class="">
            <label class="">聊天室</label>
        </div>
        <div class="">
            <a class="">寫新訊息</a>
        </div>
    </div>
    <div class="">
        <input type="text" class="" placeholder="搜尋">
    </div>
    <div>
        <div class="d-block">
            <a href="#">
                <div class="">
                    <img src="{{ asset('image/head.png') }}" class="rounded float-start user_img_message">
                </div>
            </a>
        </div>
        <div>
            <a href="#">
                <div class="">
                    <img src="{{ asset('image/head.png') }}" class="rounded float-start user_img_message">
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@section ('MessageMid')


@endsection

@section ('MessageEnd')


@endsection