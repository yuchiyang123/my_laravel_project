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
    
    </style>
    <head>
        <meta charset="utf-8">
        <title>Tourist - Travel Agency HTML Template</title>
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
        <link href="{{ asset('css1/bootstrap.min.css') }}" rel="stylesheet">

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
                <h1 class="display-3 text-white mb-3 animated slideInDown">Enjoy Your Vacation With Us</h1>
                <p class="fs-4 text-white mb-4 animated slideInDown">Tempor erat elitr rebum at clita diam amet diam et eos erat ipsum lorem sit</p>
                <div class="position-relative w-75 mx-auto animated slideInDown">
                    <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="EX. 台北">
                    <button type="button" class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2" style="margin-top: 7px;">Search</button>
                </div>
            </div>
        </div>
    </div>
    

    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">三大功能</h6>
            <h1 class="mb-5">我們服務</h1>
        </div>
        <div class="row g-4">
            <!-- Card for Work Exchange -->
            <div class="col-md-4">
                <div class="feature-card">
                    <img class="img-fluid" src="https://www.greenroof.com.tw/uploads/images/plant/plant1-20180918042515.jpg" alt="工作換宿">
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
                    <img class="img-fluid" src="https://www.greenroof.com.tw/uploads/images/plant/plant1-20180918042515.jpg" alt="旅遊揪團">
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
                    <img class="img-fluid" src="https://www.greenroof.com.tw/uploads/images/plant/plant1-20180918042515.jpg" alt="創作平台">
                    <div class="card-body">
                        <h4 class="card-title">創作平台</h4>
                        <p>分享你的故事，啟發他人，擴展視野。</p>
                        <a href="#" class="btn btn-outline-primary">探索更多</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
