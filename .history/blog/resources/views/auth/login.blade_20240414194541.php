@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="text-align: center; margin-top: 50px;">
    <h2>登入</h2>
    <form method="POST" action="{{ route('user.login') }}" style="margin-top: 20px;">
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

</div>
@endsection