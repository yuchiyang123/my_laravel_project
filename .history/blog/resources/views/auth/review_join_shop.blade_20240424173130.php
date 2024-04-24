@extends('layouts.layoutback')

@section('title', '')

@section('Form')

<script>
.user-info {
    background-color: #f4f4f4;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
}

.user-info p {
    margin: 5px 0;
    font-size: 16px;
}

.user-info p:first-child {
    font-weight: bold;
}
</script>
    
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                
                <div class="image-container">
                    <a href="/user-profile/index/d/{{ $review_join_user->username }}">
                        @if($review_join_user->profileImage != null)
                            <?php $imageDataUri = 'data:' . $review_join_user->profileImage_type  . ';base64,' . base64_encode( $review_join_user->profileImage ); ?>
                            <img src="{{ $imageDataUri }}" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                        @else
                            <img src="https://github.com/mdo.png"  class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                        @endif
                    </a>
                </div>
                <div class="text-container">
                    <div class="user">
                        <!--貼文用戶名-->
                        <div><a href="/user-profile/index/d/{{ $review_join_user->username }}">{{ $review_join_user->username }}</a></div>
                    </div>
                    <div class="date">
                        <!--貼文日期-->
                        <div class="fw-bold">申請時間: <a href="#">{{ $review_join_shop->created_at }}</a></div>
                    </div>
                </div>
                
                <div class="user-info">
                    <p>性別: {{ Auth::user()->sex == 'male' ? '男性' : '女性' }}</p>
                    <p>偏好: {{ $review_join_shop->preferences }}</p>
                    <p>期望待遇: {{ $review_join_shop->expected_salary }}</p>
                    <p>個性: {{ $review_join_shop->personality }}</p>
                    <p>是否擁有駕照: {{ $review_join_shop->driving_license }}</p>
                    <p>聯絡方式電話: {{ $review_join_shop->contact_number }}</p>
                    <p>聯絡方式Email: {{ $review_join_shop->email }}</p>
                    <p>可工作時間: {{ $review_join_shop->availability }} 小時</p>
                    <p>工作經驗: {{ $review_join_shop->work_experience }}</p>
                    <p>申請動機: {!! $review_join_shop->editor !!}</p>
                </div>
                <div class="mb-3 pt-3">
                    
                    <div class="row">
                        <div class="col">
                            <form id="postForm" action="/review_mjoin_reject/{{ $review_join_mjoin->id }}" method="POST">
                                @csrf
                                <input type="submit" class="btn btn-danger" value="拒絕" />
                            </form>
                        </div>
                        <div class="col">
                            <form id="postForm" action="/review_mjoin_pass/{{ $review_join_mjoin->id }}" method="POST">
                                @csrf
                                <input type="submit" class="btn btn-primary" value="通過" />
                            </form>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


@endsection