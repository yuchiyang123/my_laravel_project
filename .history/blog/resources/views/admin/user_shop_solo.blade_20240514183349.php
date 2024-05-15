
@extends('admin.layout.layout')

@section('main_content')

<div class="outside">
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="row">
                <div class="image-container">
                <a href="/user-profile/index/d/{{ $shops->posted_by_u }}">
                    @if($shops->profileImage != null)
                        <?php $imageDataUri = 'data:' . $shops->profileImage_type  . ';base64,' . base64_encode( $shops->profileImage ); ?>
                        <img src="{{ $imageDataUri }}" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                    @else
                        <img src="https://github.com/mdo.png"  class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                    @endif
                    </a>
                </div>
                <div class="text-container">
                    <div class="user">
                        <!--貼文用戶名-->
                        <div><a href="/user-profile/index/d/{{ $shops->posted_by_u }}">{{ $shops->posted_by_u }}</a></div>
                    </div>
                    <div class="date">
                        <!--貼文日期-->
                        <div><a href="#">{{ $shops->created_at }}</a></div>
                    </div>
                </div>
                </div>
                @if($shops->status == ['end','del','complete'])
                    <div class="d-flex justify-content-end">
                        <img style="width: 120px; margin-top: -80px;" src="{{ asset('image/停止招募.png') }}" alt="">
                    </div>
                @else
                    <div class="d-flex justify-content-end">
                        <img style="width: 120px; " src="{{ asset('image/正在招募.png') }}" alt="">
                    </div>
                @endif
                <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;">
                    <label class="flex-fill ps-3">店名:{{ $shops->shop_name }}</label>
                    <label class="flex-fill ps-3">招募期間:{{ $shops->recruitment_period }}</label>
                    <label class="flex-fill">縣市:{{ $shops->selectwhere }}</label>
                    <label class="flex-fill">地址:{{ $shops->location }}</label>
                    <label class="flex-fill">性別:{{ $shops->sex }}</label>
                    <label class="flex-fill">工作經驗:{{ $shops->conditions_exp }}</label>
                    <label class="flex-fill">每日工時:{{ $shops->work_hours }}</label>
                    <label class="flex-fill">需要技能:{{ $shops->driver_license_requirements }}</label>
                    <label class="flex-fill">提供:{{ $shops->benefits }}</label>
                    <label class="flex-fill">語言能力:{{ $shops->language }}</label>
                </div>
                <div class="clearfix"></div>
                <div class="image-container">
                    <div class="d-block mb-3 text-start text-break">
                        <span>工作內容:{{ $shops->job_description }}</span>
                        <div>詳細介紹:{!! $shops->shop_information !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection