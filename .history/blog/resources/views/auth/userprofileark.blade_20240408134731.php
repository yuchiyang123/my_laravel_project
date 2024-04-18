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
                            <h3 class="card-title mb-4 fw-bold me-auto">創作(顯示最新兩篇)</h3>
                        </div>
                        <a type="button" href="{{ route('arkwork_post_form') }}" class="btn btn-primary btn">新增創作</a>
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
                                        <div class="dropdown ms-2">
                                            <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-horizontal"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ $userarkwork->id }}" data-bs-toggle="modal" data-bs-target=".bs-example-new-project" onclick="editProjects('project-items-1')">Edit</a>
                                                <a class="dropdown-item" href="javascript: void(0);">Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item" onclick="deleteProjects('project-items-1')" data-id="project-items-1" href="{{ $userarkwork->id }}">Delete</a>
                                            </div>
                                        </div>
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
                                        <h4 class="mb-1 font-size-17 team-title pt-1">{{ $userarkwork->title }}</h4>
                                        <p class="text-muted mb-0 team-description">{!! $userarkwork->main !!}</p>
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

                        <div class="col-md-6" id="project-items-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="flex-grow-1 align-items-start">
                                            <div>
                                                <h6 class="mb-0 text-muted">
                                                    <i class="mdi mdi-circle-medium text-success fs-3 align-middle"></i>
                                                    <span class="team-date">13 Aug, 2021</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="dropdown ms-2">
                                            <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-horizontal"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="javascript: void(0);" data-bs-toggle="modal" data-bs-target=".bs-example-new-project" onclick="editProjects('project-items-2')">Edit</a>
                                                <a class="dropdown-item" href="javascript: void(0);">Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item" href="javascript:void(0);" onclick="deleteProjects('project-items-2')" data-id="project-items-2">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="mb-1 font-size-17 team-title">Website Design</h5>
                                        <p class="text-muted mb-0 team-description">Creating the design
                                            and layout of a
                                            website.</p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="avatar-group float-start flex-grow-1 task-assigne">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-10" aria-label="Kelly Osborn" data-bs-original-title="Kelly Osborn">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="rounded-circle avatar-sm">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-2" aria-label="John Page" data-bs-original-title="John Page">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" class="rounded-circle avatar-sm">
                                                </a>
                                            </div>
                                        </div><!-- end avatar group -->
                                        <div class="align-self-end">
                                            <span class="badge badge-soft-success p-2 team-status">Completed</span>
                                        </div>
                                    </div>
                                </div><!-- end cad-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-md-6" id="project-items-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="flex-grow-1 align-items-start">
                                            <div>
                                                <h6 class="mb-0 text-muted">
                                                    <i class="mdi mdi-circle-medium text-warning fs-3 align-middle"></i>
                                                    <span class="team-date">08 Sep, 2021</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="dropdown ms-2">
                                            <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-horizontal"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="javascript: void(0);" data-bs-toggle="modal" data-bs-target=".bs-example-new-project" onclick="editProjects('project-items-3')">Edit</a>
                                                <a class="dropdown-item" href="javascript: void(0);">Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item" href="javascript: void(0);" data-id="project-items-3" onclick="deleteProjects('project-items-3')">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="mb-1 font-size-17 team-title">UI / UX Design</h5>
                                        <p class="text-muted mb-0 team-description">Plan and onduct user
                                            research and analysis</p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="avatar-group float-start flex-grow-1 task-assigne">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-3" aria-label="Judy Newland" data-bs-original-title="Judy Newland">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="" class="rounded-circle avatar-sm">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-5" aria-label="Jeffery Legette" data-bs-original-title="Jeffery Legette">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="" class="rounded-circle avatar-sm">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-6" aria-label="Jose Rosborough" data-bs-original-title="Jose Rosborough">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="" class="rounded-circle avatar-sm">
                                                </a>
                                            </div>
                                        </div><!-- end avatar group -->
                                        <div class="align-self-end">
                                            <span class="badge badge-soft-warning p-2 team-status">Progress</span>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-md-6" id="project-items-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="flex-grow-1 align-items-start">
                                            <div>
                                                <h6 class="mb-0 text-muted">
                                                    <i class="mdi mdi-circle-medium text-danger fs-3 align-middle"></i>
                                                    <span class="team-date">20 Sep, 2021</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="dropdown ms-2">
                                            <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-horizontal"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="javascript: void(0);" data-bs-toggle="modal" data-bs-target=".bs-example-new-project" onclick="editProjects('project-items-4')">Edit</a>
                                                <a class="dropdown-item" href="javascript: void(0);">Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="project-items-4" onclick="deleteProjects('project-items-4')">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="mb-1 font-size-17 team-title">Testing</h5>
                                        <p class="text-muted mb-0 team-description">The procurement
                                            specifications should
                                            describe</p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="avatar-group float-start flex-grow-1 task-assigne">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" value="member-10" aria-label="Jansh Wells" data-bs-original-title="Jansh Wells">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="rounded-circle avatar-sm">
                                                </a>
                                            </div>
                                        </div><!-- end avatar group -->
                                        <div class="align-self-end">
                                            <span class="badge badge-soft-danger p-2 team-status">Pending</span>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        
                    </div><!-- end row -->
                </div><!-- end tab pane -->   
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
    </div>
    </div>
    </div>
    </div>