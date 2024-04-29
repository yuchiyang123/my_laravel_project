
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.3/socket.io.js"></script>

<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.min.js"></script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<!-- JavaScript Bundle with Popper -->


@extends('layouts.index')

@section('title', '')

@section('img')

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" >
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div style="background-color: black; height: 40vh; display: flex; justify-content: center; align-items: center;">
                <img src="{{ asset('image/ff14-1.jpg') }}" class="d-block" style="max-height: 100%; max-width: 100%;" alt="...">
            </div>
        </div>
        <div class="carousel-item">
            <div style="background-color: black; height: 40vh; display: flex; justify-content: center; align-items: center;">
                <img src="{{ asset('image/ff14-2.jpg') }}" class="d-block" style="max-height: 100%; max-width: 100%;" alt="...">
            </div>
        </div>
        <div class="carousel-item">
            <div style="background-color: black; height: 40vh; display: flex; justify-content: center; align-items: center;">
                <img src="{{ asset('image/ff14-3.png') }}" class="d-block" style="max-height: 100%; max-width: 100%;" alt="...">
            </div>
        </div>
        
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

@endsection 

@section('Form')
<div class="w-100">
    <div class="">
        <div class="card">
            <div class="tab-content p-4">
                <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h3 class="card-title mb-4 fw-bold me-auto">打工</h3>
                        </div>
                    </div>

                    <div class="row" id="all-projects">
                    
                        @if(!empty($s))
                            
                                @foreach($s->take(2) as $item)
                                    <div class="col-md-6" id="project-items-1">
                                        <div class="card">
                                            <div class="card-body">
                                                <div>
                                                    
                                                    <img src="{{ asset('image/image.png') }}" alt="圖片" style="width: 180px; height:auto;">
                                                    
                                                </div>
                                                <div class="mb-4">
                                                    
                                                        <a href="{{ route('shop_solo', ['shopId' => $item->id]) }}">
                                                            <h4 class="mb-1 font-size-17 team-title pt-1">{{ $item->shop_name }}</h4>
                                                        </a>
                                                        <p class="text-muted mb-0 team-description">
                                                            {!! Str::limit(strip_tags($item->shop_information, '<p><a><br><b><strong><i><em><ul><ol><li><blockquote><code>'), 75, '...') !!}
                                                        </p>
                                                    
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
                                                    
                                                </div><!-- end d-flex -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-md-6 -->
                                @endforeach
                        @else
                            <div class="col-md-12">
                                <p>打工</p>
                            </div>
                        @endif
                    </div><!-- end row -->
                   
                </div><!-- end tab pane -->   
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
    </div>
    <div class="container">
        <div class="card">
            <div class="tab-content p-4">
                <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h3 class="card-title mb-4 fw-bold me-auto">打工</h3>
                        </div>
                    </div>

                    <div class="row" id="all-projects">
                    
                        @if(!empty($m))
                            
                                @foreach($m->take(2) as $item)
                                    <div class="col-md-6" id="project-items-1">
                                        <div class="card">
                                            <div class="card-body">
                                                <div>
                                                    
                                                    <img src="{{ asset('image/image.png') }}" alt="圖片" style="width: 180px; height:auto;">
                                                    
                                                </div>
                                                <div class="mb-4">
                                                    
                                                        <a href="{{ route('shop_solo', ['shopId' => $item->id]) }}">
                                                            <h4 class="mb-1 font-size-17 team-title pt-1">{{ $item->shop_name }}</h4>
                                                        </a>
                                                        <p class="text-muted mb-0 team-description">
                                                            {!! Str::limit(strip_tags($item->shop_information, '<p><a><br><b><strong><i><em><ul><ol><li><blockquote><code>'), 75, '...') !!}
                                                        </p>
                                                    
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
                                                    
                                                </div><!-- end d-flex -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-md-6 -->
                                @endforeach
                        @else
                            <div class="col-md-12">
                                <p>打工</p>
                            </div>
                        @endif
                    </div><!-- end row -->
                   
                </div><!-- end tab pane -->   
            </div>
        </div><!-- end card -->
    </div>
    <div class="container">
        <div class="card">
            <div class="tab-content p-4">
                <div class="tab-pane active show" id="projects-tab" role="tabpanel">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h3 class="card-title mb-4 fw-bold me-auto">打工</h3>
                        </div>
                    </div>

                    <div class="row" id="all-projects">
                    
                        @if(!empty($a))
                            
                                @foreach($a->take(2) as $item)
                                    <div class="col-md-6" id="project-items-1">
                                        <div class="card">
                                            <div class="card-body">
                                                <div>
                                                    
                                                    <img src="{{ asset('image/image.png') }}" alt="圖片" style="width: 180px; height:auto;">
                                                    
                                                </div>
                                                <div class="mb-4">
                                                    
                                                        <a href="{{ route('shop_solo', ['shopId' => $item->id]) }}">
                                                            <h4 class="mb-1 font-size-17 team-title pt-1">{{ $item->shop_name }}</h4>
                                                        </a>
                                                        <p class="text-muted mb-0 team-description">
                                                            {!! Str::limit(strip_tags($item->shop_information, '<p><a><br><b><strong><i><em><ul><ol><li><blockquote><code>'), 75, '...') !!}
                                                        </p>
                                                    
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
                                                    
                                                </div><!-- end d-flex -->
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div><!-- end col-md-6 -->
                                @endforeach
                        @else
                            <div class="col-md-12">
                                <p>打工</p>
                            </div>
                        @endif
                    </div><!-- end row -->
                   
                </div><!-- end tab pane -->   
            </div>
        </div><!-- end card -->
    </div>
</div>
@endsection