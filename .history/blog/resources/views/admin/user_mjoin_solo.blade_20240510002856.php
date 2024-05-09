@extends('admin.layout.layout')

@section('main_content')
<div class="outside">
    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="image-container">
                <a href="/user-profile/index/d/{{ $mjoin->posted_by_u }}">
                    @if($mjoin->profileImage != null)
                        <?php $imageDataUri = 'data:' . $mjoin->profileImage_type  . ';base64,' . base64_encode( $mjoin->profileImage ); ?>
                        <img src="{{ $imageDataUri }}" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                    @else
                        <img src="https://github.com/mdo.png"  class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                    @endif
                    </a>
                </div>
                <div class="text-container">
                    <div class="user">
                        <!--貼文用戶名-->
                        <div><a href="/user-profile/index/d/{{ $mjoin->posted_by_u }}">{{ $mjoin->posted_by_u }}</a></div>
                    </div>
                    <div class="date">
                        <!--貼文日期-->
                        <div><a href="#">{{ $mjoin->date }}</a></div>
                    </div>
                </div>
                @if($mjoin->status == ['end','del','complete'])
                    <div class="d-flex justify-content-end">
                        <img style="width: 120px; margin-top: -80px;" src="{{ asset('image/停止招募.png') }}" alt="">
                    </div>
                @else
                    <div class="d-flex justify-content-end">
                        <img style="width: 120px; margin-top: -80px;" src="{{ asset('image/正在招募.png') }}" alt="">
                    </div>
                @endif
                <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;top:-30px;position:relative;">
                    <label class="flex-fill ps-3">日期:{{ $mjoin->time }}</label>
                    <label class="flex-fill">人數:{{ $mjoin->people }}</label>
                    <label class="flex-fill">預算:{{ $mjoin->money }}</label>
                    <label class="flex-fill">性別:{{ $mjoin->sex }}</label>
                    <label class="flex-fill">需要技能:{{ $mjoin->skill }}</label>
                    <label class="flex-fill pe-3">年齡:{{ $mjoin->age }}</label>
                </div>
                <div class="clearfix"></div>
                <div class="image-container">
                    <div class="d-block mb-3 text-start text-break">
                        @php
                        // 从 $mjoin->description 中提取文本和图片
                        $text = strip_tags($mjoin->description); // 提取并限制文本长度为150字
                        preg_match_all('/<img[^>]+src="([^">]+)"/', $mjoin->description, $matches); // 提取第一个图片
                            $images = !empty($matches[1]) ? $matches[1] : null;
                            $allimg = array();
                            if($images){
                                foreach($images as $image){
                                    $allimg[] = $image;
                                }
                            }
                            $imgcount = 1;
                            @endphp
                            @if(strlen($text) > 150)
                            <p>{!! $text !!}</p>
                            
                            @else
                            <p>{!! $text !!}</p>
                            @endif
                            @if ($images)
                            <div id="carouselExampleControlsNoTouching{{ $mjoin->id }}" class="carousel carousel-dark slide" data-bs-interval="false">
                                <div class="carousel-inner">
                                    @foreach($allimg as $allimgs)
                                    @if($imgcount==1)
                                    <div class="carousel-item active {{ $mjoin->id }}">
                                        <img src="{{ $allimgs }}" class="d-block mx-auto" alt="Image">
                                    </div>
                                    @php
                                    $imgcount +=1;
                                    @endphp
                                    @else
                                    <div class="carousel-item {{ $mjoin->id }}">
                                        <img src="{{ $allimgs }}" class="d-block mx-auto" alt="Image">
                                    </div>
                                    @php
                                    $imgcount +=1;
                                    @endphp
                                    @endif

                                    @endforeach
                                </div>
                                @if($imgcount > 2)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching{{ $mjoin->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching{{ $mjoin->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                @endif
                            </div>

                            @endif
                    </div>
                </div>

@endsection