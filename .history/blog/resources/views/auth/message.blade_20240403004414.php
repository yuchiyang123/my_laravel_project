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
        <a>
            <div class="">
                <img src="{{ asset('image/head.png') }}" class="img-thumbnail">
            </div>
        </a>
    </div>
</div>
@endsection

@section ('MessageMid')


@endsection

@section ('MessageEnd')


@endsection