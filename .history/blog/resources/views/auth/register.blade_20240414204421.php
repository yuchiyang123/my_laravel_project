<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
@extends('layouts.app')

@section('title', '註冊')

@section('content')
<div style="text-align: center; margin-top: 15px;">
    <h2>登入</h2>
    <form method="POST" action="{{ route('register_sbmit') }}" style="margin-top: 10px;">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="name">使用者名稱:</label><br>
            <input class="form-control" type="email" id="username" name="username" required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="email">Email:</label><br>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="password">密碼:</label><br>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="confirm_password">再次密碼:</label><br>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
        @endif
        <div style="margin-bottom: 20px;">
            <br><button type="submit">註冊</button>
        </div>
    </form>
    <div><span>您有帳號嗎嗎?<a href="/">點此登入</a></span></div>
</div>
@endsection