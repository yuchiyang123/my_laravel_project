@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <h2>Welcome to Our Website</h2>
    <p>This is the home page content. Feel free to explore!</p>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
@endsection
