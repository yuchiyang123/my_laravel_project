

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/userprofile.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Semantic UI CSS -->

<!-- Semantic UI JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
@include ('header')
@if(Session::has('success'))
    <div class="alert alert alert-primary">
        {{ Session::get('success') }}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif
<div class="container">
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="text-center border-end">
                            @if($userrecord->profileImage != null)
                                <?php $imageDataUri = 'data:' . $userrecord->profileImage_type  . ';base64,' . base64_encode( $userrecord->profileImage ); ?>
                                <img src="{{ $imageDataUri }}" alt="mdo" width="150" height="150" class="rounded-circle">
                            @else
                                <img src="https://github.com/mdo.png" alt="mdo" width="150" height="150" class="rounded-circle">
                            @endif
                            <h4 class="text-primary font-size-20 mt-3 mb-2">{{ $userrecord->username }}</h4>
                            <h5 class="text-muted font-size-13 mb-0"></h5>
                        </div>
                    </div><!-- end col -->
                    <div class="col-md-9">
                        <div class="ms-3">
                            <div>
                                <h4 class="card-title mb-2 fw-bold">自我介紹
                                    @if(Auth::check())
                                        @if(Auth::user()->username != $userrecord->username)
                                        <a href="/message-view-show/{{$userrecord->username}}">
                                            <button type="submit" class="btn btn-primary btn-sm">聯絡我</button>
                                        </a>
                                        @endif
                                    @endif
                                </h4>
                                @if(!is_null($userinfo) && $userinfo->self_introduction != null)
                                    <p class="mb-0 text-muted">{{ $userinfo->self_introduction }}</p>
                                @else
                                    <p class="mb-0 text-muted">設定->小屋設定可以輸入自我介紹喔</p>
                                @endif

                            </div>
                            <div class="row my-4">
                                <div class="col-md-12" style="min-height: 50px">
                                    <div>
                                        @if(!is_null($userinfo) && $userinfo->social_links != null)
                                        <p class="text-muted fw-medium mb-0"><i class="mdi mdi-email-outline me-2"></i><a href="{{ $userinfo->social_links }}">{{ $userinfo->social_links }}
                                        </a></p>
                                        @endif
                                        @if(!is_null($userinfo) && $userinfo->social_links2 != null)
                                        <p class="text-muted fw-medium mb-0"><i class="mdi mdi-phone-in-talk-outline me-2"></i><a href="{{ $userinfo->social_links2 }}">{{ $userinfo->social_links2 }}
                                        </a></p>
                                        @endif
                                        @if(!is_null($userinfo) && $userinfo->social_links3 != null)
                                        <p class="text-muted fw-medium mb-0"><i class="mdi mdi-phone-in-talk-outline me-2"></i><a href="{{ $userinfo->social_links3 }}">{{ $userinfo->social_links3 }}
                                        </a></p>
                                        @endif
                                        @if(!is_null($userinfo) && $userinfo->social_links4 != null)
                                        <p class="text-muted fw-medium mb-0"><i class="mdi mdi-phone-in-talk-outline me-2"></i><a href="{{ $userinfo->social_links4 }}">{{ $userinfo->social_links4 }}
                                        </a></p>
                                        @endif
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->

                            
                            <ul class="nav nav-tabs nav-tabs-custom border-bottom-0 mt-3 nav-justfied" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <div class="col">
                                        <ul class="nav">
                                            <li class="nav-item">
                                                <a class="nav-link px-4 active" href="/arkwork_all/a/{{ $userrecord->username }}" role="tab" tabindex="-1">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">全部創作</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link px-4 active" href="/user_collections_all/{{ $userrecord->username }}" role="tab" tabindex="-1">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">全部收藏</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link px-4 active" href="/user_score_all/{{ $userrecord->username }}" role="tab" tabindex="-1">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">全部評語</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li><!-- end li -->
                            </ul><!-- end ul -->
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end card body -->
        </div><!-- end card -->

        <div class="card">
            <div class="tab-content p-4">
                <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h3 class="card-title mb-4 fw-bold me-auto">創作(顯示最新兩篇)</h3>
                        </div>
                        @if($userrecord->username == session('user_name'))
                            <a type="button" href="{{ route('arkwork_post_form') }}" class="btn btn-primary btn">新增創作</a>
                        @endif
                    </div>

                    <div class="row" id="all-projects">
                        @foreach($userarkworks->take(2) as $userarkwork)
                        <div class="col-md-6" id="project-items-1">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <!--div class="flex-grow-1 align-items-start">
                                            <div>
                                                <h6 class="mb-0 text-muted">
                                                    <i class="mdi mdi-circle-medium text-danger fs-3 align-middle"></i>
                                                    <span class="team-date">{{ $userarkwork->created_at }}</span>
                                                </h6>
                                            </div>
                                        </div-->
                                        @if($userrecord->username == Auth::user()->username)
                                            <div class="dropdown ms-2">
                                                <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="/arkwork_edit/edit/{{ $userarkwork->id }}" data-bs-target=".bs-example-new-project">編輯</a>
                                                    <a id="collect_{{ $userarkwork->id }}" class="dropdown-item" href="javascript:void(0);" data-mjoin-id="{{ $userarkwork->id }}" onclick="collect({{ $userarkwork->id }})">
                                                    @if($userCollections->artwork_status == '0')
                                                    收藏
                                                    @else
                                                    取消收藏
                                                    @endif
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete-item"  
                                                    data-id="project-items-1" href="#" onclick="confirmDelete('{{ route('artwork_del',['ark_id' =>$userarkwork->id ])}}')">刪除</a>
                                                </div>
                                            </div>
                                            <script>
                                                function confirmDelete(url) {
                                                    if (confirm('確定要刪除這篇創作嗎？')) {
                                                        window.location.href = url;
                                                    }
                                                }
                                                function collect(arkId){
                                                    $.ajax({
                                                        url:"/collect_artwork/collect/" + arkId,
                                                        type: "GET",
                                                        success: function(response) {
                                                            if(response.status == 'NO') {
                                                                $('#collect_' + arkId).text('收藏');
                                                            } else {
                                                                $('#collect_' + arkId).text('取消收藏');
                                                            }

                                                        }
                                                    })
                                                }
                                            </script>
                                        @endif
                                    </div>
                                    <!---->
                                    <div>
                                        <?php $imageDataUri = 'data:' . $userarkwork->image_type  . ';base64,' . base64_encode( $userarkwork->image_data ); ?>
                                        @if($userarkwork->image_data != null)
                                            <img src="{{ $imageDataUri }}" alt="圖片" class="" style="width: 180px; height:auto;">
                                        @endif
                                        @if($userarkwork->image_data == null)
                                            <img src="{{ asset('image/image.png') }}" alt="圖片" class="" style="width: 180px; height:auto;">
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <a href="/arkwork_solo/solo/{{ $userarkwork->id }}"><h4 class="mb-1 font-size-17 team-title pt-1">{{ $userarkwork->title }}</h4></a>
                                        <p class="text-muted mb-0 team-description">
                                        {!! Str::limit(strip_tags($userarkwork->main, '<p><a><br><b><strong><i><em><ul><ol><li><blockquote><code>'), 75, '...') !!}
                                        </p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="avatar-group float-start flex-grow-1 task-assigne">
                                        <div class="flex-grow-1 align-items-start">
                                            <div>
                                                <h6 class="mb-0 text-muted">
                                                    <span class="team-date">{{ $userarkwork->created_at }}</span>
                                                </h6>
                                            </div>
                                            
                                        </div>
                                            <!--div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-6" aria-label="Terrell Soto" data-bs-original-title="Terrell Soto">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="rounded-circle avatar-sm">
                                                </a>
                                            </div-->
                                            <!--div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-1" aria-label="Ruhi Shah" data-bs-original-title="Ruhi Shah">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="rounded-circle avatar-sm">
                                                </a>
                                            </div-->
                                            <!--div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-15" data-bs-original-title="Denny Silva">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title rounded-circle bg-primary">
                                                            D
                                                        </div>
                                                    </div>
                                                </a>
                                            </div-->
                                        </div><!-- end avatar group -->
                                        <div class="align-self-end">
                                            <span class="badge badge-soft-danger p-2 team-status">{{ $userarkwork->class }}</span>
                                        </div>
                                    </div><!---->
                                </div>
                                <!-- end cardbody -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        @endforeach
                    </div><!-- end row -->
                </div><!-- end tab pane -->   
            </div>
        </div><!-- end card -->
@if(!is_null($userinfo) && $userinfo->favorite_articles_visibility == 'public' || !empty($userinfo->favorite_articles_visibilit) || $userrecord->username == Auth::user()->username)
        <div class="card">
            <div class="tab-content p-4">
                <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h3 class="card-title mb-4 fw-bold me-auto">收藏文章</h3>
                        </div>
                    </div>

                    <div class="row" id="all-projects">
                    
                        @if(!empty($userCollections) || !empty($userCollections_mjoin|| !empty($userCollections_shop)))
                            @foreach([$userCollections, $userCollections_mjoin ,$userCollections_shop] as $collection)
                                @foreach($collection->take(2) as $item)
                                    <div class="col-md-6" id="project-items-1">
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
        </div>
            <!-- end card -->
         @endif
    </div><!-- end col -->
    
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="card-title mb-4">用戶評分</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row">打工評分</th>
                                    <td>@if($averageScore){{ $averageScore }}@else 尚未有人評分 @endif</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <th scope="row">揪團評分</th>
                                    <td>@if($averageScore_shop){{ $averageScore_shop }}@else 尚未有人評分 @endif</td>
                                </tr><!-- end tr -->
                                
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
        <div class="card">
            <div class="card-body">
                <!--div class="pb-2">
                    <h4 class="card-title mb-3"></h4>
                    <p>Hi I'm Jansh, has been the industry's standard dummy text To an English
                        person, it will seem like
                        simplified.</p>
                    <ul class="ps-3 mb-0">
                        <li>it will seem like simplified.</li>
                        <li>To achieve this, it would be necessary to have uniform pronunciation</li>
                    </ul>
                    
                </div--><!-- end ul -->
                <!--hr-->
                <div class="pt-2">
                    <h4 class="card-title mb-4">標籤</h4>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge badge-soft-secondary p-2">花蓮</span>
                        <span class="badge badge-soft-secondary p-2">揪團</span>
                        <span class="badge badge-soft-secondary p-2">打工</span>
                        <span class="badge badge-soft-secondary p-2">自由行</span>
                        <span class="badge badge-soft-secondary p-2">派對咖</span>
                    </div>
                </div>
            </div><!-- end cardbody -->
        </div><!-- end card -->

        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="card-title mb-4">個人資料</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row" style="width: 40%">帳號</th>
                                    <td>{{ $userrecord->username }}</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <th scope="row">總分數</th>
                                    <td>@if($averageTotalScore){{ $averageTotalScore }}@else 尚未有人評分 @endif</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <th scope="row">性別</th>
                                    <td>
                                        {{ $userrecord->sex == 'male' ? '男性' : '女性' }}
                                    </td>
                                </tr><!-- end tr -->
                                <tr>
                                    <th scope="row">年齡</th>
                                    <td>{{ $userrecord->age }}歲</td>
                                </tr><!-- end tr -->
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="card-title mb-4">個人版面資訊</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row">最後登入時間</th>
                                    <td>{{ $userrecord->logintime }}</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <th scope="row">登入次數</th>
                                    <td>{{ $userrecord->loginmany }}</td>
                                </tr><!-- end tr -->
                                
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

        
    </div><!-- end col -->
</div>
</div>