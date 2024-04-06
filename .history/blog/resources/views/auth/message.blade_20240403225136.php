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
        <div class="">
            <a href="#">
                <div class="d-flex flex-row">
                    <img src="{{ asset('image/head.png') }}" style="width: 90px;" class="user_img_message"><div >
                    <span class="d-inline-flex flex-column">你的用戶名</span>
                    <span class="d-inline-flex flex-column">喂喂喂喂喂</span></div>
                </div>
                
            </a>
        </div>
    </div>
    <div>
        <div class="">
            <a href="#">
                <div class="d-block">
                    <img src="{{ asset('image/head.png') }}" class="user_img_message">
                    <span>你的用戶名</span>
                    <span>喂喂喂喂喂</span>
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