<!DOCTYPE html>
<html lang="zh-TW">
<head>
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
        <form class="login-form">
            <label for="username">使用者名稱:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">密碼:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">登入</button>
        </form>
    </div>
    </div>
    
</body>
</html>
