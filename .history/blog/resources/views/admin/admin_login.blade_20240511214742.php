<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>登入頁面</title>
    <link rel="stylesheet" href="{{ asset('css/admin_login.css') }}">
</head>

<body>
    
	<div id="container"></div>
    <!--script type="module" src="{{ asset('js/three_font_1.js') }}"></script-->
    @if(mt_rand(1,100)<50)
    <script type="module" src="{{ asset('js/three.js') }}"></script>
    @else
    <script type="module" src="{{ asset('js/three_font.js') }}"></script>
    @endif
    <div id="magic"></div>
        <div class="playground">
            <div class="bottomPosition">
            </div>
        </div>
    </div>
    <div id="scene-container">
    <div id="login-container" class="login-container">
        <div style="text-align: center; margin-top: 15px;">
            <h2>登入</h2>
            <form method="POST" action="{{ route('user.login') }}" style="">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label for="email">帳號:</label><br>
                    <input type="text" id="username" name="username" required>
                </div>
        
                <div style="margin-bottom: 20px;">
                    <label for="password">密碼:</label><br>
                    <input type="password" id="password" name="password" required>
                </div>
                @if(session('error'))
                <div style="color: red;">
                    {{ session('error') }}
                </div>
                @endif
                <div style="margin-bottom: 20px;">
                    <br><button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
            <div><span>您還沒有帳號嗎?<a href="/user_register">點此註冊</a></span></div>
        </div>
       
        
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>
</html>
