<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/userprofile.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
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
                            <h3 class="card-title mb-4 fw-bold me-auto">全部{{ $username }}創作</h3>
                        </div>
                        @if($username == session('user_name'))
                            <a type="button" href="{{ route('arkwork_post_form') }}" class="btn btn-primary btn">新增創作</a>
                        @endif
                    </div>

                    <div class="row" id="all-projects">
                        @foreach($userarkworksall as $userarkwork)
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
                                                <a class="dropdown-item" href="{{ $userarkwork->id }}" data-bs-toggle="modal" data-bs-target=".bs-example-new-project">編輯</a>
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
                                        <a href="{{ route('arkwork_solo', ['ark_id' => $userarkwork->id]) }}"><h4 class="mb-1 font-size-17 team-title pt-1">{{ $userarkwork->title }}</h4></a>
                                        <p class="text-muted mb-0 team-description">
                                            {!! strip_tags($userarkwork->main, '<p><a><br><b><strong><i><em><ul><ol><li><blockquote><code>') !!}
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
    </div><!-- end col -->
    </div>
    </div>
    </div>
    </div>