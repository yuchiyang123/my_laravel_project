@include ('header')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/userprofile.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Semantic UI CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">

<!-- Semantic UI JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

<div class="container">
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="text-center border-end">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-fluid avatar-xxl rounded-circle" alt="">
                            <h4 class="text-primary font-size-20 mt-3 mb-2">{{ $userprofile->username }}</h4>
                            <h5 class="text-muted font-size-13 mb-0"></h5>
                        </div>
                    </div><!-- end col -->
                    <div class="col-md-9">
                        <div class="ms-3">
                            <div>
                                <h4 class="card-title mb-2 fw-bold">自我介紹</h4>
                                <p class="mb-0 text-muted">可供自我定義</p>
                            </div>
                            <div class="row my-4">
                                <div class="col-md-12">
                                    <div>
                                        <p class="text-muted mb-2 fw-medium"><i class="mdi mdi-email-outline me-2"></i>社群媒體url
                                        </p>
                                        <p class="text-muted fw-medium mb-0"><i class="mdi mdi-phone-in-talk-outline me-2"></i>社群媒體url
                                        </p>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->

                            
                            <ul class="nav nav-tabs nav-tabs-custom border-bottom-0 mt-3 nav-justfied" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link px-4 active" href="/arkwork_all/a/{{ $userprofile->username }}" role="tab" tabindex="-1">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">全部創作</span>
                                    </a>
                                </li><!-- end li -->
                                <!--li class="nav-item" role="presentation">
                                    <a class="nav-link px-4"  href="https://bootdey.com/snippets/view/profile-task-with-team-cards" target="__blank" >
                                        <span class="d-block d-sm-none"><i class="mdi mdi-menu-open"></i></span>
                                        <span class="d-none d-sm-block">Tasks</span>
                                    </a>
                                </li--><!-- end li -->
                                <!--li class="nav-item" role="presentation">
                                    <a class="nav-link px-4 "  href="https://bootdey.com/snippets/view/profile-with-team-section" target="__blank" >
                                        <span class="d-block d-sm-none"><i class="mdi mdi-account-group-outline"></i></span>
                                        <span class="d-none d-sm-block">Team</span>
                                    </a>
                                </li--><!-- end li -->
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
                        @if($username == session('user_name'))
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
                                        @if($username == session('user_name'))
                                            <div class="dropdown ms-2">
                                                <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="/arkwork_edit/edit/{{ $userarkwork->id }}" data-bs-target=".bs-example-new-project">編輯</a>
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
                                            @if($username == session('user_name'))
                                            <div class="dropdown ms-2">
                                                <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="/arkwork_edit/edit/{{ $userarkwork->id }}" data-bs-target=".bs-example-new-project">編輯</a>
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
                                            </script>
                                        @endif
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
                                    <th scope="row">總評分</th>
                                    <td>5.0</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <th scope="row">評分</th>
                                    <td>3222</td>
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
                                    <th scope="row">帳號</th>
                                    <td>{{ $userprofile->username }}</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <th scope="row">評分分數</th>
                                    <td>5.0</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <th scope="row">性別</th>
                                    <td>{{ $userprofile->sex }}</td>
                                </tr><!-- end tr -->
                                <tr>
                                    <th scope="row">年齡</th>
                                    <td>{{ $userprofile->age }}</td>
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