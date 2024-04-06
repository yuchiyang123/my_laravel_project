@extends ('layouts.messagelo')

@section ('title','')

@section ('MessageFirst')
<div class="">
    <div class="d-flex m-3 fw-bold align-items-center">
        <div class="">
            <label class="fs-3">聊天室</label>
        </div>
        <button class="circular blue ui icon button">
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