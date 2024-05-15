@extends('layouts.layoutback')

@section('title', '')

@section('Form')

<style>
    .container {
        margin-top: 50px;
    }
    .user-info {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .user-info p {
        margin: 10px 0;
        font-size: 16px;
    }
    .user-info p:first-child {
        font-weight: bold;
    }
    .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .btn-group {
        display: flex;
        justify-content: space-between;
    }
</style>
</head>
<body>

<div class="container">
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <div class="image-container me-3">
                <a href="/user-profile/index/d/{{ $review_join_user->username }}">
                    @if($review_join_user->profileImage != null)
                        <?php $imageDataUri = 'data:' . $review_join_user->profileImage_type  . ';base64,' . base64_encode( $review_join_user->profileImage ); ?>
                        <img style="width: 40px;" src="{{ $imageDataUri }}" class="img-fluid" alt="">
                    @else
                        <img style="width: 40px;" src="https://github.com/mdo.png" class="img-fluid" alt="">
                    @endif
                </a>
            </div>
            <div class="text-container">
                <h5 class="card-title"><a href="/user-profile/index/d/{{ $review_join_user->username }}">{{ $review_join_user->username }}</a></h5>
                <h6 class="card-subtitle mb-2 text-muted">申請時間: <a href="#">{{ $review_join_shop->created_at }}</a></h6>
                <a href="/user_score_all/{{ $review_join_user->username }}">使用者評分: @if($averageTotalScore!=0){{$averageTotalScore}}@else 尚未評分 @endif</a>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-3">
            @if(Auth::check())
                @if(Auth::user()->username != $review_join_user->username)
                    <a href="/message-view-show/{{$review_join_user->username}}">
                        <button type="submit" class="btn btn-primary btn-sm">聯絡我</button>
                    </a>
                @endif
            @endif
        </div>
        <div class="user-info">
            <p>姓名: {{ $review_join_shop->name }}</p>
            <p>性別: {{ Auth::user()->sex == 'male' ? '男性' : '女性' }}</p>
            <p>期望待遇: {{ $review_join_shop->expected_salary }}</p>
            <p>個性: {{ $review_join_shop->personality }}</p>
            <p>是否擁有駕照: {{ $review_join_shop->driving_license }}</p>
            <p>聯絡方式電話: {{ $review_join_shop->contact_number }}</p>
            <p>聯絡方式Email: {{ $review_join_shop->email }}</p>
            <p>可工作時間: {{ $review_join_shop->availability }} 小時</p>
            <p>工作經驗: {{ $review_join_shop->work_experience }}</p>
            <p>申請動機: {!! $review_join_shop->motivation !!}</p>
        </div>
        <div class="btn-group mt-3">
            <form id="postForm" action="/review_shop_pass/{{ $review_join_shop->id }}" method="POST" class="me-2">
                @csrf
                <input type="submit" class="btn btn-primary" value="通過" />
            </form>
            <form id="postForm" action="/review_shop_reject/{{ $review_join_shop->id }}" method="POST">
                @csrf
                <input type="submit" class="btn btn-danger" value="拒絕" />
            </form>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection