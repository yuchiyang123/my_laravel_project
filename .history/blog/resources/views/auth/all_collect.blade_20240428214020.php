<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                            <h3 class="card-title mb-4 fw-bold me-auto">全部{{ $user->username }}收藏</h3>
                        </div>
                        
                    </div>

                    <div class="" id="all-projects">
                        @if(!empty($userCollections) || !empty($userCollections_mjoin|| !empty($userCollections_shop)))
                            @foreach([$userCollections, $userCollections_mjoin ,$userCollections_shop] as $collection)
                                @foreach($collection as $item)
                                    <div class="" id="project-items-1">
                                        <ul class="list-group" style="width: 750px">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    @if($collection == $userCollections)
                                                    <a class="" href="{{ route('arkwork_solo', ['ark_id' => $item->id]) }}">{{ $item->title }}</a>
                                                    @elseif($collection == $userCollections_mjoin)
                                                    <a href="{{ route('mjoin_solo', ['mjoinId' => $item->id]) }}">{{ $item->title }}</a>
                                                    @else
                                                    <a href="{{ route('shop_solo', ['shopId' => $item->id]) }}">{{ $item->shop_name }}</a>
                                                    @endif
                                                </div>
                                                <div class="text-end">
                                                    <span>{{ $item->created_at }}</span>
                                                    <span class="badge bg-primary rounded-pill me-1">
                                                        @if($collection == $userCollections)
                                                        創作
                                                        @elseif($collection == $userCollections_mjoin)
                                                        揪團
                                                        @else
                                                        打工
                                                        @endif
                                                    </span>
                                                    
                                                </div>
                                            </li>
                                        </ul>
                                        
                                        
                                        
                                        

                                        
                                       
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
         
                    </div><!-- end row -->
                </div><!-- end tab pane -->   
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
    </div>
    </div>
    </div>
    </div>