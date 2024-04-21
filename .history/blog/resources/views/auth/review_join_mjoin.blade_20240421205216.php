@extends('layouts.layoutback')

@section('title', '')

@section('Form')


    
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                
                <div class="image-container">
                    <a href="/user-profile/index/d/{{ $mjoin->posted_by_u }}">
                        @if($review_join_mjoin->profileImage != null)
                            <?php $imageDataUri = 'data:' . $mjoin->profileImage_type  . ';base64,' . base64_encode( $mjoin->profileImage ); ?>
                            <img src="{{ $imageDataUri }}" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                        @else
                            <img src="https://github.com/mdo.png"  class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                        @endif
                    </a>
                </div>
                <div class="mb-3 pt-3">
                    
                    <form id="postForm" action="{{ route('work_post_posts') }}" method="POST">
                        @csrf
                        <input type="submit" class="btn btn-primary" value="通過" />
                    </form>
                    <form id="postForm" action="{{ route('work_post_posts') }}" method="POST">
                        @csrf
                        <input type="submit" class="btn btn-primary" value="拒絕" />
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection