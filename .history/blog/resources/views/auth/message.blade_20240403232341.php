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
    <div class="w-75">
        <input type="text" class="form-control" placeholder="搜尋">
    </div>
    <div>
        <div class="UserMassageBox">
            <a href="#">
                <div class="d-flex flex-row align-items-center">
                    <img src="{{ asset('image/head.png') }}" style="width: 90px;" class="user_img_message">
                    <div class="">
                        <div class="d-flex align-items-center fw-bold UserMassageBoxName">
                            <span class="">你的用戶名</span>
                        </div>
                        <div class="d-flex align-items-center UserMassageBoxMessage">
                            <span class="">你: 喂喂喂 </span><span class="">。10小時前</span>
                        </div>
                    </div>

                </div>
                
            </a>
        </div>
    </div>
    <div>
        <div class="UserMassageBox">
            <a href="#">
                <div class="d-flex flex-row align-items-center">
                    <img src="{{ asset('image/head.png') }}" style="width: 90px;" class="user_img_message">
                    <div class="">
                        <div class="d-flex align-items-center fw-bold UserMassageBoxName">
                            <span class="">你的用戶名</span>
                        </div>
                        <div class="d-flex align-items-center UserMassageBoxMessage">
                            <span class="">你: 喂喂喂 </span><span class="">。10小時前</span>
                        </div>
                    </div>

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