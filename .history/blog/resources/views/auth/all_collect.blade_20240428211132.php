<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/userprofile.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
@include ('header')
<div class="container ">
<div class="d-flex justify-content-center" style="">
    <div class="col-xl-8">
        <div class="card">
            <div class="tab-content p-4">
                <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h3 class="card-title mb-4 fw-bold me-auto">全部{{ $username }}收藏</h3>
                        </div>
                        
                    </div>

                    <div class="row" id="all-projects">
                        @if(!empty($userCollections) || !empty($userCollections_mjoin|| !empty($userCollections_shop)))
                            @foreach([$userCollections, $userCollections_mjoin ,$userCollections_shop] as $collection)
                                @foreach($collection as $item)
                                    <div class="col-md-6" id="project-items-1">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                @if($collection == $userCollections)
                                                <a href="{{ route('arkwork_solo', ['ark_id' => $item->id]) }}">{{ $item->title }}</a>
                                                @elseif($collection == $userCollections_mjoin)
                                                <a href="{{ route('mjoin_solo', ['mjoinId' => $item->id]) }}">{{ $item->title }}</a>
                                                @else
                                                <a href="{{ route('shop_solo', ['shopId' => $item->id]) }}">{{ $item->shop_name }}</a>
                                                @endif
                                            </li>
                                            <li class="list-group-item">A second item</li>
                                            <li class="list-group-item">A third item</li>
                                            <li class="list-group-item">A fourth item</li>
                                            <li class="list-group-item">And a fifth one</li>
                                        </ul>

                                        <div class="card">
                                            <div class="card-body">
                                                <div>
                                                    @if($item->image_data != null)
                                                        <img src="{{ 'data:' . $item->image_type . ';base64,' . base64_encode($item->image_data) }}" alt="圖片" style="width: 180px; height:auto;">
                                                    @else
                                                        <img src="{{ asset('image/image.png') }}" alt="圖片" style="width: 180px; height:auto;">
                                                    @endif
                                                </div>
                                                <div class="mb-4">
                                                    @if($collection == $userCollections)
                                                        <a href="{{ route('arkwork_solo', ['ark_id' => $item->id]) }}">
                                                            <h4 class="mb-1 font-size-17 team-title pt-1">{{ $item->title }}</h4>
                                                        </a>
                                                        <p class="text-muted mb-0 team-description">
                                                            {!! Str::limit(strip_tags($item->main, '<p><a><br><b><strong><i><em><ul><ol><li><blockquote><code>'), 75, '...') !!}
                                                        </p>
                                                    @elseif ($collection == $userCollections_mjoin)
                                                        <a href="{{ route('mjoin_solo', ['mjoinId' => $item->id]) }}">
                                                            <h4 class="mb-1 font-size-17 team-title pt-1">{{ $item->title }}</h4>
                                                        </a>
                                                        <p class="text-muted mb-0 team-description">
                                                            {!! Str::limit(strip_tags($item->description, '<p><a><br><b><strong><i><em><ul><ol><li><blockquote><code>'), 75, '...') !!}
                                                        </p>
                                                    @else
                                                        <a href="{{ route('shop_solo', ['shopId' => $item->id]) }}">
                                                            <h4 class="mb-1 font-size-17 team-title pt-1">{{ $item->shop_name }}</h4>
                                                        </a>
                                                        <p class="text-muted mb-0 team-description">
                                                            {!! Str::limit(strip_tags($item->shop_information, '<p><a><br><b><strong><i><em><ul><ol><li><blockquote><code>'), 75, '...') !!}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="d-flex">
                                                    <div class="avatar-group float-start flex-grow-1 task-assigne">
                                                        <div class="flex-grow-1 align-items-start">
                                                            <div>
                                                                <h6 class="mb-0 text-muted">
                                                                    <span class="team-date">{{ $item->created_at }}</span>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div><!-- end avatar group -->
                                                    <div class="align-self-end">
                                                        @if($collection == $userCollections)
                                                            <span class="badge badge-soft-danger p-2 team-status">{{ $userarkwork->class }}</span>
                                                        @endif
                                                    </div>
                                                </div><!-- end d-flex -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-md-6 -->
                                @endforeach
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <p>目前沒有收藏文章</p>
                            </div>
                        @endif
                    </div><!-- end row -->
                   
                </div><!-- end tab pane -->   
            </div>
        </div><!-- end card -->
         @endif
                    </div><!-- end row -->
                </div><!-- end tab pane -->   
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
    </div>
    </div>
    </div>
    </div>