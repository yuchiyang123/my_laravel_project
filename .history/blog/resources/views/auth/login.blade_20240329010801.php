@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div style="text-align: center; margin-top: 50px;">
        <h2>Login</h2>
        @if(session('error'))
            <div style="color: red;">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('user.login') }}" style="margin-top: 20px;">
            @csrf
            <div style="margin-bottom: 20px;">
                <label for="name">Email:</label><br>
                <input type="email" id="email" name="name" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required>
            </div>

            <div style="margin-bottom: 20px;">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
@endsection
