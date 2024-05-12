<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>賽博朋克風格登入頁面</title>
    <link rel="stylesheet" href="{{ asset('css/admin_login.css') }}">
</head>
<body>
    
	<div id="container"></div>
    <script type="module" src="{{ asset('js/three_dog.js') }}"></script>
    
    
    <div id="scene-container">
    <div class="login-container">
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
