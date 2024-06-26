<script src="{{ asset('js/app.js') }}"></script>
<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.min.js"></script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<!-- JavaScript Bundle with Popper -->


@extends('layouts.frontpage')

@section('title', '')

@section('condition_add')
<div class="condition">
    <div class="radio-tophead d-block mx-auto fs-3 fw-bolder ">
        <label></label>
    </div>
    <form action="" method="get" id="search_shop">
        @csrf
        <div class="condition-radio text-start">
            <div class="radio-head fs-5 fw-bolder border-bottom pb-2">
                <label>地區</label-->
            </div>
            
            <select id="selectwhere" name="destination" required class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="臺北市">臺北市</option>
                        <option value="新北市">新北市</option>
                        <option value="桃園市">桃園市</option>
                        <option value="臺中市">臺中市</option>
                        <option value="臺南市">臺南市</option>
                        <option value="高雄市">高雄市</option>
                        <option value="新竹縣">新竹縣</option>
                        <option value="苗栗縣">苗栗縣</option>
                        <option value="彰化縣">彰化縣</option>
                        <option value="南投縣">南投縣</option>
                        <option value="雲林縣">雲林縣</option>
                        <option value="嘉義縣">嘉義縣</option>
                        <option value="屏東縣">屏東縣</option>
                        <option value="宜蘭縣">宜蘭縣</option>
                        <option value="花蓮縣">花蓮縣</option>
                        <option value="臺東縣">臺東縣</option>
                        <option value="澎湖縣">澎湖縣</option>
                        <option value="金門縣">金門縣</option>
                        <option value="連江縣">連江縣</option>
                        <option value="基隆市">基隆市</option>
                        <option value="新竹市">新竹市</option>
                        <option value="嘉義市">嘉義市</option>
                    </select>
        </div>

        <div class="condition-radio text-start">
            <div class="condition-radio">
                <div class="radio-head  fs-5 fw-bolder border-bottom pb-2">
                    <label>性別</label>
                </div>
                <div class="radio-group">
                    <div class="form-check pt-2 pb-1">
                        <input class="form-check-input" type="radio" name="sex" value="不拘"><label class="form-check-label fw-bold">不拘</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="sex" value="male"><label class="form-check-label fw-bold">男</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="sex" value="female"><label class="form-check-label fw-bold">女</label>
                    </div>
                </div>
            </div>
        </div>



        <div>
            <div class="condition-radio text-start">
                <div class="radio-head  fs-5 fw-bolder border-bottom pb-2">
                    <label>駕照</label>
                </div>
                <div class="radio-group">
                    <div class="form-check pt-2 pb-1">
                        <input class="form-check-input" type="radio" name="skill" value="不需要"><label class="form-check-label fw-bold">不需要</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="skill" value="car"><label class="form-check-label fw-bold">開車</label>
                    </div>
                </div>
                <div class="radio-group">
                    <div class="form-check pb-1">
                        <input class="form-check-input" type="radio" name="skill" value="motorcycle"><label class="form-check-label fw-bold">騎車</label>
                    </div>
                </div>
            </div>
        </div>

       

        <div>
            <div class="condition-radio text-start">
                <div class="radio-head  fs-5 fw-bolder border-bottom pb-2">
                    <label>工作經驗</label>
                </div>
                <div class="radio-group">
                    <div class="form-check pt-2 pb-1">
                        <input class="form-check-input" type="radio" name="conditions_exp" value=""><label class="form-check-label fw-bold">不限制</label>
                    </div>
                </div>
                <div class="radio-group pb-1">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="conditions_exp" value=""><label class="form-check-label fw-bold">需要</label>
                    </div>
                </div>
                
                <div class="d-grid gap-2">
                    <input type="submit" id="searchForm" class="btn btn-primary" value="搜尋">
                </div>
            </div>
        </div>
    </form>
</div>
</div>

@endsection

@section('PostBtn')

@if(session('user_name')!=null)
<form action="/work_post_form" method="GET">
    <div class="d-grid gap-2">
        @csrf
        <input type="submit" class="btn btn-primary" value="發文">
    </div>
</form>
@endif

@endsection

@section('Post')
@if(isset($error_message))
    <div class="alert alert-danger">
        {{ $error_message }}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif
<div class="outside">
    @foreach($shops as $shop)

    <div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="image-container">
                <a href="/user-profile/index/d/{{ $shop->posted_by_u }}">
                    @if($shop->profileImage != null)
                        <?php $imageDataUri = 'data:' . $shop->profileImage_type  . ';base64,' . base64_encode( $shop->profileImage ); ?>
                        <img src="{{ $imageDataUri }}" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                    @else
                        <img src="https://github.com/mdo.png"  class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                    @endif
                    </a>
                </div>
                <div class="text-container">
                    <div class="user">
                        <!--貼文用戶名-->
                        <div><a href="/user-profile/index/d/{{ $shop->posted_by_u }}">{{ $shop->posted_by_u }}</a></div>
                    </div>
                    <div class="date">
                        <!--貼文日期-->
                        <div><a href="#">{{ $shop->created_at }}</a></div>
                    </div>
                </div>
                <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;">
                    <label class="flex-fill ps-3">店名:{{ $shop->shop_name }}</label>
                    <label class="flex-fill ps-3">招募期間:{{ $shop->recruitment_period }}</label>
                    <label class="flex-fill">縣市:{{ $shop->selectwhere }}</label>
                    <label class="flex-fill">地址:{{ $shop->location }}</label>
                    <label class="flex-fill">性別:{{ $shop->sex }}</label>
                    <label class="flex-fill">工作經驗:{{ $shop->conditions_exp }}</label>
                    <label class="flex-fill">每日工時:{{ $shop->work_hours }}</label>
                    <label class="flex-fill">需要技能:{{ $shop->driver_license_requirements }}</label>
                    <label class="flex-fill">提供:{{ $shop->benefits }}</label>
                    <label class="flex-fill">語言能力:{{ $shop->language }}</label>
                </div>
                <div class="clearfix"></div>
                <div class="image-container">
                    <div class="d-block mb-3 text-start text-break">
                        <span>工作內容:{{ $shop->job_description }}</span>
                        @php
                        // 从 $shop->description 中提取文本和图片
                        $text = Str::limit(strip_tags($shop->shop_information), 150); // 提取并限制文本长度为150字
                        preg_match_all('/<img[^>]+src="([^">]+)"/', $shop->shop_information, $matches); // 提取第一个图片
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
                            <p>{!! $text !!}<a href="#" class="link-secondary" id="{{ $shop->id }}" data-shop-id="{{ $shop->id }}" onclick="showPopup({{ $shop->id }})">繼續閱讀</a></p>
                            
                            @else
                            <p>{!! $text !!}</p>
                            @endif
                            @if ($images)
                            <div id="carouselExampleControlsNoTouching{{ $shop->id }}" class="carousel carousel-dark slide" data-bs-interval="false">
                                <div class="carousel-inner">
                                    @foreach($allimg as $allimgs)
                                    @if($imgcount==1)
                                    <div class="carousel-item active {{ $shop->id }}">
                                        <img src="{{ $allimgs }}" class="d-block mx-auto" alt="Image">
                                    </div>
                                    @php
                                    $imgcount +=1;
                                    @endphp
                                    @else
                                    <div class="carousel-item {{ $shop->id }}">
                                        <img src="{{ $allimgs }}" class="d-block mx-auto" alt="Image">
                                    </div>
                                    @php
                                    $imgcount +=1;
                                    @endphp
                                    @endif

                                    @endforeach
                                </div>
                                @if($imgcount > 2)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching{{ $shop->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching{{ $shop->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                @endif
                            </div>

                            @endif
                    </div>
                </div>


                <div class="container">
                    
                    <div class="messagecount" id="messagecount_{{ $shop->id }}">

                    </div>
                </div>
                <div class="line">
                    
                    

                    @if(session('user_name')!=null && 
                    \App\Models\Shop_join::where('article_id', $shop->id)->where('status','pass','end')->where('user_id', Auth::user()->id)->exists())

                    <!-- 显示评分按钮 -->
                    
                            <a href="/shop_score_form/{{ $shop->id }}"><button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="要完成評分喔">評分</button></a>
                    @else
                        
                    
                    <!-- 不显示评分按钮 -->
                    @endif


                                
                    
                    @if(session('user_name')==$shop->posted_by_u)
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            更多
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="/shop_post_posts/edit/{{ $shop->id }}">編輯</a></li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">刪除</a></li>
                            <li><a id="collect_{{ $shop->id }}" class="dropdown-item" href="javascript:void(0);" data-shop-id="{{ $shop->id }}" onclick="collect({{ $shop->id }})">
                                @if($shop->status_b == 0)
                                    收藏
                                @elseif ($shop->status_b == 1)
                                    取消收藏
                                @endif
                                </a></li>
                        </ul>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">
                            <div class="modal-dialog mx-auto">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">刪除文章</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        您確定要刪除該揪團的文章?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">返回</button>
                                        <form action="/shop_post_posts/edit/delete/{{ $shop->id }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">確定刪除</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @php 
                    $exists = \App\Models\Shop_join::where('article_id', $shop->id)->where('user_id', Auth::user()->id)->exists();  
                    $endtime = \App\Models\UserPostWork::where('id', $shop->id)->first();
                    
                    $endtime_exlode = explode(' - ', $endtime->time);
                    $end_date = \Carbon\Carbon::parse($endtime_exlode[1]);
                    $end_now = now()->greaterThan($end_date);
                    @endphp
                    @if(session('user_name')!=null && session('user_name')!=$shop->posted_by_u && !$exists &&!$end_now)
                    <div class="inner-grid">
                        <span><a href="/join_shop/{{ $shop->id }}">加入</a></span>
                    </div>
                    @endif
                </div>
                
                <div class="ShowAllMessage" id="showAllMessage_{{ $shop->id }}">

                </div>
                @if(session('user_name')!=null)
                    
                        @csrf
                        <div class="LeaveMessageInput flex-row">
                            <div class="LeaveMessageInputrpAname p-2">
                                @if(Auth::user()->profileImage != null)
                                    <?php $imageDataUri = 'data:' . Auth::user()->profileImage_type  . ';base64,' . base64_encode( Auth::user()->profileImage ); ?>
                                    <img src="{{ $imageDataUri }}" alt="mdo" width="50" height="50" class="rounded-circle">
                                @else
                                    <img src="https://github.com/mdo.png" alt="mdo" width="50" height="50" class="rounded-circle">
                                @endif
                            </div>
                            <div class="p-2">
                                <textarea class="form-control" placeholder="留言" id="messageTextarea_{{ $shop->id }}" name="messageTextarea_{{ $shop->id }}" rows="1"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submitReply" onclick="submitReply({{ $shop->id }})">留言</button>
                        </div>
                        
                    
                @endif

                <div class="ShowAllMessage">
                    <script>
                        $(document).ready(function() {

                            showReply({{ $shop -> id }});
                            messagecount({{ $shop -> id }});

                        });
                        function showReply(shopId) {
                            $.ajax({
                                url: "/shop-reply/" + shopId,
                                type: "GET",
                                success: function(response) {
                                    // 在彈出的視窗中顯示留言
                                    $('#showAllMessage_' + shopId).html(response.htmlContent);
                                    $('#showAllMessage_' + shopId).show();
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            })
                        }

                        function messagecount(shopId) {
                            $.ajax({
                                url: "/shop-reply-count/" + shopId,
                                type: "GET",
                                success: function(response) {
                                    $('#messagecount_' + shopId).html(response.htmlContent_reply);
                                    $('#messagecount_' + shopId).show();
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }

                       
                        var interval = 2000; 
                        setInterval(function() {
                            // 调用 fetchData 并传递参数
                            showReply({{ $shop -> id }});
                        }, interval);

                        function showReplyall(shopId) {
                            $.ajax({
                                url: "/shop-reply-all/" + shopId,
                                type: "GET",
                                success: function(response) {
                                    // 在彈出的視窗中顯示留言
                                    $('#showAllMessageall_' + shopId).html(response.htmlContent);
                                    $('#showAllMessageall_' + shopId).show();
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            })
                        }
                        var interval = 1000; 
                        setInterval(function() {
                            // 调用 fetchData 并传递参数
                            showReplyall({{ $shop -> id }});
                        }, interval);
                                         
                    </script>
                </div>

            </div>
        </div>
    </div>

    <br>
    @endforeach


    <script>
        
        //收藏
        function collect(shopId){
            $.ajax({
                url:"/collect_shop/collect/" + shopId,
                type: "GET",
                success: function(response) {
                    if(response.status == 'NO') {
                        $('#collect_' + shopId).text('收藏');
                    } else {
                        $('#collect_' + shopId).text('取消收藏');
                    }

                }
            })
        }
        //回復
        function submitReply(shopId) {
                            var messageTextarea = $('#messageTextarea_' + shopId).val();
                            if (messageTextarea.trim() === '') {
                                alert('留言不能為空');
                                return;
                            }

                            // 使用 GET 请求提交留言内容
                            $.ajax({
                                url: "/shop-reply-submit/" + shopId,
                                type: "GET",
                                data: {
                                    messageTextarea: messageTextarea
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // 添加 CSRF token
                                },
                                success: function(response) {
                                    if(response.success == true){
                                        // 你可以在这里添加一些成功后的处理逻辑
                                        // 如刷新留言列表等
                                        showReply(shopId);
                                        messagecount(shopId);
                                        //alert(response.message); // 显示成功提示
                                        $('#messageTextarea_' + shopId).val(''); 
                                        console.log(messageTextarea);
                                    } else {
                                        //alert(response.message); // 显示错误提示
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                       

                        
    </script>
</div>
@endsection

<div class="overlay" id="overlay"></div>
                            <div class="popup" style="display: none;">
                                <div class="popup-content">
                                    <!-- 数据将会显示在这里 -->
                                    
                                </div>
                                
                            </div>

                            <script>
        var overlay = document.getElementById('overlay');
        //var trigger = document.querySelector('.trigger a');
        var popup = document.getElementById('popup');
        var header = document.querySelector('.header');
        /*
        trigger.addEventListener('click', function(event) {
            event.preventDefault();
            popup.style.display = 'block';
            header.style.backgroundColor = 'rgba(0, 0, 0, 0.000001)';
            overlay.style.display = 'block';
            popup.style.border = '1px solid gray';
            popup.style.boxShadow = '0px 0px 15px rgba(0, 0, 0, 0.7)';
            /*
            document.body.classList.add('blur-background'); 
            popup.style.filter = 'none';// 移除 body 元素的模糊效果
        });
        */
        function showPopup(shopId) {
            var popup = $('.popup');
            var overlay = $('.overlay');
            var header = $('.header');

            popup.css('display', 'block');
            overlay.css('display', 'block');
            popup.css('border', '1px solid gray');
            popup.css('box-shadow', '0px 0px 15px rgba(0, 0, 0, 0.7)');
            header.css('background-color', 'rgba(0, 0, 0, 0.000001)');

            $.ajax({
                url: "/showallshop/" + shopId,
                type: "GET",
                success: function(response) {
                    // 在彈出的視窗中顯示留言
                    //var encodedHtmlContent = utf8_encode(response.htmlContent);
                    $('.popup-content').html(response.htmlContent);
                    $('.popup').show();
                    $('#showAllMessageall_' + shopId).html(showReplyall(shopId));
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        //處理留言
        


        var closeBtn = document.querySelector('.close a');
        /*
        closeBtn.addEventListener('click', function(event) {
            event.preventDefault(); 
            popup.style.display = 'none'; 
            popup.style.boxShadow = 'none';   
        });
        */
        overlay.addEventListener('click', function(event) {
            var popup = document.querySelector('.popup');
            var overlay = document.querySelector('.overlay');
            var header = document.querySelector('.header');

            event.preventDefault();
            event.stopPropagation();
            //popup.style.display = 'none';
            $('.popup').hide();
            overlay.style.display = 'none';
            //popup.style.boxShadow = 'none';
            header.style.backgroundColor = '#ffffff';
        });
    </script>