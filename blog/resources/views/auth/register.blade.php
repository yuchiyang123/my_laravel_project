@extends('layouts.app')

@section('title', '註冊')

@section('content')
<div style="text-align: center; margin-top: 15px;">
    <a href="/front">旅遊媒合平台</a>
    <h2>註冊</h2>
    <form method="POST" action="{{ route('register_sbmit') }}" style="margin-top: 10px;">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="name">使用者名稱:</label><br>
            <input class="form-control" type="text" id="username" name="username" required>
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