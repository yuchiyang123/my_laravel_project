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
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">探索社群</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">首頁</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">打工換宿</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">旅遊揪團</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">創作平台</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="header-bg">
        <div class="text-container">
            <h1>歡迎來到探索社群</h1>
            <p>探索新的旅行方式，發現未知的可能。</p>
        </div>
    </header>

    <div class="container py-5">
        <div class="row g-4">
            <!-- Card for Work Exchange -->
            <div class="col-md-4">
                <div class="feature-card">
                    <img src="https://via.placeholder.com/300x200" alt="工作換宿">
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
                    <img src="https://via.placeholder.com/300x200" alt="旅遊揪團">
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
                    <img src="https://via.placeholder.com/300x200" alt="創作平台">
                    <div class="card-body">
                        <h4 class="card-title">創作平台</h4>
                        <p>分享你的故事，啟發他人，擴展視野。</p>
                        <a href="#" class="btn btn-outline-primary">探索更多</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer-custom">
        <div class="text-center">
            <p>版權所有 © 探索社群 2024</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
