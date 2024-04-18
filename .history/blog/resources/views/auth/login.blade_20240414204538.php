
@extends('layouts.app')

@section('title', '登入')

@section('content')
<div style="text-align: center; margin-top: 15px;">
    <h2>登入</h2>
    <form method="POST" action="{{ route('user.login') }}" style="margin-top: 10px;">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="name">Email:</label><br>
            <input type="email" id="email" name="email" required>
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
            <br><button type="submit">Login</button>
        </div>
    </form>
    <div><span>您還沒有帳號嗎?<a href="/user_register">點此註冊</a></span></div>
</div>
@endsection