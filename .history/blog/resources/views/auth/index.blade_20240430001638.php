@include('header')
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>探索社群 - 打工換宿、旅遊揪團及創作平台</title>
    <style>
        body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f4f9;
        color: #333;
    }

    .navbar-custom {
        background-color: #0056b3;
        border-bottom: 3px solid #003580;
    }

    .header-bg {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://via.placeholder.com/1920x600');
        height: 300px;
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .text-container h1, .text-container p {
        color: white;
        text-align: center;
    }

    .feature-card {
        background: white;
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 16px rgba(0,0,0,0.2);
    }

    .feature-card img {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .card-body {
        padding: 15px;
        text-align: center;
    }

    .btn-outline-primary {
        border-color: #0056b3;
        color: #0056b3;
    }

    .btn-outline-primary:hover {
        background: #0056b3;
        color: white;
    }

    .footer-custom {
        background-color: #333;
        color: white;
        padding: 10px 0;
        position: relative;
        bottom: 0;
        width: 100%;
    }

    @media (min-width: 992px) {
        .header-bg {
            height: 400px;
        }
    }
    .custom-select {
                            border-radius: 20px; /* 設定圓角大小 */
                        }
    </style>
    <head>
        <meta charset="utf-8">
        <title>旅遊媒合平台</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
    
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">
    
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    
        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    
        <!-- Libraries Stylesheet -->
        <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        
        <!-- Template Stylesheet -->
        <link href="{{ asset('css1/style.css') }}" rel="stylesheet">

    </head>
</head>
<body>
    <!--div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div-->

    <div class="container-fluid bg-primary py-5 mb-5 hero-header" style="height: 400px">
        <div class="container py-5 d-flex flex-column justify-content-center align-items-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">相約旅途，暢遊人生</h1>
                <p class="fs-4 text-white mb-4 animated slideInDown">一同探索世界，品味生活的美好</p>

                <div class="position-relative w-75 mx-auto animated slideInDown">
                    
                    
                    <select class="form-select border-0 rounded-pill w-100 py-3 ps-4 pe-5 custom-select">
                        <option selected disabled>選擇地區</option>
                        <optgroup label="北部">
                            <option value="台北">台北</option>
                            <option value="新北">新北</option>
                            <option value="基隆">基隆</option>
                            <option value="桃園">桃園</option>
                            <option value="新竹">新竹</option>
                            <option value="宜蘭">宜蘭</option>
                        </optgroup>
                        <optgroup label="中部">
                            <option value="台中">台中</option>
                            <option value="彰化">彰化</option>
                            <option value="南投">南投</option>
                            <option value="苗栗">苗栗</option>
                            <option value="雲林">雲林</option>
                        </optgroup>
                        <optgroup label="南部">
                            <option value="台南">台南</option>
                            <option value="高雄">高雄</option>
                            <option value="嘉義">嘉義</option>
                            <option value="屏東">屏東</option>
                        </optgroup>
                        <optgroup label="東部">
                            <option value="花蓮">花蓮</option>
                            <option value="台東">台東</option>
                        </optgroup>
                        <optgroup label="離島">
                            <option value="澎湖">澎湖</option>
                            <option value="金門">金門</option>
                            <option value="馬祖">馬祖</option>
                            <option value="綠島">綠島</option>
                            <option value="蘭嶼">蘭嶼</option>
                        </optgroup>
                    </select>
                    
                    
                    <button type="button" class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2" style="margin-top: 7px;">Search</button>
                </div>
            </div>
        </div>
    </div>
    

    <div class="container py-5">
        <div class="text-center fade show" data-bs-wow-delay="0.1s">
            <h6 class="section-title bg-light text-center text-primary px-3">三大功能</h6>
            <h1 class="mb-5">我們的服務</h1>
        </div>
        
        <div class="row g-4">
            <!-- Card for Work Exchange -->
            <div class="col-md-4">
                <div class="feature-card">
                    <img class="img-fluid" src="{{ asset('image/shop.webp') }}" alt="工作換宿">
                    <div class="card-body">
                        <h4 class="card-title">打工換宿</h4>
                        <p>深入當地文化，節省旅行開支。</p>
                        <a href="#" class="btn btn-outline-primary">探索更多</a>
                    </div>
                </div>
            </div>
            <!-- Card for Group Travel -->
            <div class="col-md-4">
                <div class="feature-card">
                    <img class="img-fluid" src="{{ asset('image/mjoin.webp') }}" alt="旅遊揪團">
                    <div class="card-body">
                        <h4 class="card-title">旅遊揪團</h4>
                        <p>與志同道合者一起，享受旅程的樂趣。</p>
                        <a href="#" class="btn btn-outline-primary">探索更多</a>
                    </div>
                </div>
            </div>
            <!-- Card for Creative Platform -->
            <div class="col-md-4">
                <div class="feature-card">
                    <img class="img-fluid" src="{{ asset('image/artwork.webp') }}" alt="創作平台">
                    <div class="card-body">
                        <h4 class="card-title">創作平台</h4>
                        <p>分享你的故事，啟發他人，擴展視野。</p>
                        <a href="#" class="btn btn-outline-primary">探索更多</a>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
    <div class="text-center fade show" data-bs-wow-delay="0.1s">
        <h6 class="section-title bg-light text-center text-primary px-3">精選貼文</h6>
        <h1 class="mb-5">最新消息</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="pt-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4 fw-bold">打工</h3>
                            <div class="row">
                                @if(!empty($s))
                                    @foreach($s->take(2) as $item)
                                        <div class="col-md-6 mb-4">
                                            <div class="card">
                                                <img src="{{ asset('image/unfound.webp') }}" class="card-img-top" alt="圖片">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="{{ route('shop_solo', ['shopId' => $item->id]) }}">{{ $item->shop_name }}</a></h5>
                                                    <p class="card-text">{{ Str::limit(strip_tags($item->shop_information), 75, '...') }}</p>
                                                    <p class="card-text"><small class="text-muted">{{ $item->created_at }}</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <p>暫無內容</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4 fw-bold">揪團</h3>
                            <div class="row">
                                @if(!empty($m))
                                    @foreach($m->take(2) as $item)
                                        <div class="col-md-6 mb-4">
                                            <div class="card">
                                                <img src="{{ asset('image/unfound.webp') }}" class="card-img-top" alt="圖片">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="{{ route('mjoin_solo', ['mjoinId' => $item->id]) }}">{{ $item->title }}</a></h5>
                                                    <p class="card-text">{{ Str::limit(strip_tags($item->description), 75, '...') }}</p>
                                                    <p class="card-text"><small class="text-muted">發起者: {{ $item->posted_by_u }}</small></p>
                                                    <p class="card-text"><small class="text-muted">{{ $item->created_at }}</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <p>暫無內容</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4 fw-bold">創作</h3>
                            <div class="row">
                                @if(!empty($a))
                                    @foreach($a->take(2) as $item)
                                        <div class="col-md-6 mb-4">
                                            <div class="card">
                                                @if($item->image_data != null)
                                                    <img src="{{ 'data:' . $item->image_type . ';base64,' . base64_encode($item->image_data) }}" class="card-img-top" alt="圖片">
                                                @else
                                                    <img src="{{ asset('image/unfound.webp') }}" class="card-img-top" alt="圖片">
                                                @endif
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="{{ route('arkwork_solo', ['ark_id' => $item->id]) }}">{{ $item->title }}</a></h5>
                                                    <p class="card-text">{{ Str::limit(strip_tags($item->main), 75, '...') }}</p>
                                                    <p class="card-text"><small class="text-muted">{{ $item->created_at }}</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <p>暫無內容</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
