
@extends('layouts.app')

@section('title', '登入')

@section('content')
<div style="text-align: center; margin-top: 15px;">
    <a href="/front">旅遊媒合平台</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>