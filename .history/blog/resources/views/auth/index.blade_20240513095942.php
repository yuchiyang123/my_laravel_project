
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<!DOCTYPE html>
<html lang="zh"> 
    <head>
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
                            .footer {
        background-color: #333; /* 背景顏色 */
        color: #fff; /* 文字顏色 */
        padding: 50px 0; /* 上下間距 */
    }
    
    .footer ul {
        list-style: none;
        padding: 0;
    }
    
    .footer ul li {
        margin-bottom: 10px;
    }
    
    .footer a {
        color: #fff; /* 鏈接顏色 */
    }
    
    .footer a:hover {
        text-decoration: underline; /* 滑過時底線 */
    }
    .noto-serif-tc-regular {
  font-family: "Noto Serif TC", serif;
  font-weight: 400;
  font-style: normal;
}

        </style>
        <meta charset="utf-8">
        <title>旅遊媒合平台</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        
    
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC&display=swap" rel="stylesheet">
    
        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    
        <!-- Libraries Stylesheet -->
        <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        

        <!-- Template Stylesheet -->
        <link href="{{ asset('css1/style.css') }}" rel="stylesheet">

    </head>
    @include('header')
    <script>
        $(document).ready(function(){
            // 初始化Bootstrap的dropdown组件
            $('.dropdown-toggle').dropdown();
        });
    </script>
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
                    
                <form class="d-flex align-items-center justify-content-center" action="{{ route('search') }}" method="GET">
                    <select class="form-select border-0 rounded-pill w-100 py-3 ps-4 pe-5 custom-select" name="location">
                        <option selected disabled>選擇地區</option>
                        <optgroup label="北部">
                            <option value="臺北市">臺北市</option>
                            <option value="新北市">新北市</option>
                            <option value="基隆市">基隆市</option>
                            <option value="桃園市">桃園市</option>
                            <option value="新竹市">新竹市</option>
                            <option value="宜蘭縣">宜蘭縣</option>
                        </optgroup>
                        <optgroup label="中部">
                            <option value="臺中市">臺中市</option>
                            <option value="彰化縣">彰化縣</option>
                            <option value="南投縣">南投縣</option>
                            <option value="苗栗縣">苗栗縣</option>
                            <option value="雲林縣">雲林縣</option>
                        </optgroup>
                        <optgroup label="南部">
                            <option value="臺南市">臺南市</option>
                            <option value="高雄市">高雄市</option>
                            <option value="嘉義市">嘉義市</option>
                            <option value="屏東縣">屏東縣</option>
                        </optgroup>
                        <optgroup label="東部">
                            <option value="花蓮縣">花蓮縣</option>
                            <option value="臺東縣">臺東縣</option>
                        </optgroup>
                        <optgroup label="離島">
                            <option value="澎湖縣">澎湖縣</option>
                            <option value="金門縣">金門縣</option>
                            <option value="馬祖縣">馬祖縣</option>
                            <option value="綠島縣">綠島縣</option>
                            <option value="蘭嶼縣">蘭嶼縣</option>
                        </optgroup>
                    </select>
                    
                    
                    <button type="submit" class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2" style="margin-top: 7px;">搜尋</button>
                </form>
                </div>
            </div>
        </div>
    </div>
   
    <div class="container py-5">
        <div class="text-center fade show" data-bs-wow-delay="0.1s">
            <h6 class="section-title bg-light text-center text-primary px-3">三大功能</h6>
            <h1 class="mb-5">我們的服務</h1>
        </div>
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Card for Work Exchange -->
            <div class="col">
                <div class="feature-card">
                    <img src="{{ asset('image/shop.webp') }}" class="card-img-top img-fluid" alt="工作換宿">
                    <div class="card-body">
                        <h4 class="card-title p-2">打工換宿</h4>
                        <p class="card-text">深入當地文化，節省旅行開支。</p>
                        <a href="/work" class="btn btn-outline-primary m-3">探索更多</a>
                    </div>
                </div>
            </div>
            <!-- Card for Group Travel -->
            <div class="col">
                <div class="feature-card">
                    <img src="{{ asset('image/mjoin.webp') }}" class="card-img-top img-fluid" alt="旅遊揪團">
                    <div class="card-body">
                        <h4 class="card-title p-2">旅遊揪團</h4>
                        <p class="card-text">與志同道合者一起，享受旅程的樂趣。</p>
                        <a href="/front" class="btn btn-outline-primary m-3">探索更多</a>
                    </div>
                </div>
            </div>
            <!-- Card for Creative Platform -->
            <div class="col">
                <div class="feature-card">
                    <img src="{{ asset('image/artwork.webp') }}" class="card-img-top img-fluid" alt="創作平台">
                    <div class="card-body">
                        <h4 class="card-title p-2">創作平台</h4>
                        <p class="card-text">分享你的故事，啟發他人，擴展視野。</p>
                        <a href="#" class="btn btn-outline-primary m-3">探索更多</a>
                    </div>
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
                                @if(!empty($s) && $s->count() > 0)
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
                                @if(!empty($m) && $m->count() > 0)
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
                                @if(!empty($a) && $a->count() > 0)
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
    <footer class="footer">
        <div class="container text-white">
            <div class="row">
                <div class="col-lg-6">
                    <h3>聯絡我們</h3>
                    <p>如果您有任何問題或意見，請隨時與我們聯繫。</p>
                    <ul>
                        <li>電子郵件：D11016150@gs.takming.edu.tw</li>
                        <li>電話：+沒有這種東西</li>
                        <li>地址：114台北市內湖區環山路一段56號</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h3>社交媒體</h3>
                    <ul>
                        <li><a href="https://www.facebook.com/chiwsw.chi/">Facebook</a></li>
                        <li><a href="https://www.instagram.com/_yjisnow/">Instagram</a></li>
                        <li><a href="https://www.linkedin.com/in/%E7%B4%80%E7%85%AC-%E4%BD%99-a261392a8/">LinkedIn</a></li>
                        <li><a href="https://github.com/yuchiyang123">github</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
</body>
</html>
