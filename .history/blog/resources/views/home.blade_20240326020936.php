@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="login-container">
        <div class="login-form">
            <h2>Login to Your Account</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email or Phone</label>
                    <input id="email" type="email" name="email" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
            </form>
            <div class="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>
        </div>
        <div class="login-info">
            <h2>Welcome to Facebook</h2>
            <p>Connect with friends and the world around you on Facebook.</p>
            <a href="#">Create New Account</a>
        </div>
    </div>
@endsection
