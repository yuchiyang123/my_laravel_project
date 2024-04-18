@extends('layouts.app')

@section('title', '驗證電話')

@section('content')
<div style="text-align: center; margin-top: 15px;">
    <h2>電話驗證</h2>
    <form method="POST" action="{{ route('user.login') }}" style="margin-top: 10px;">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="name">Email:</label><br>
            <input type="text" id="phone" name="phone" required>
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