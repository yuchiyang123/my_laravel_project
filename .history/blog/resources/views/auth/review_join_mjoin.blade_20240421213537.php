@extends('layouts.layoutback')

@section('title', '')

@section('Form')


    
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
                        <div><a href="#">{{ $review_join_mjoin->created_at }}</a></div>
                    </div>
                </div>
                <div class="image-container">
                    {{ $review_join_mjoin->sex }}
                    {{ $review_join_mjoin->age }}
                    {{ $review_join_mjoin->preferences }}
                    {{ $review_join_mjoin->foodallergy }}
                    {{ $review_join_mjoin->languages }}
                    {{ $review_join_mjoin->license }}
                    {{ $review_join_mjoin->contact_method }}
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