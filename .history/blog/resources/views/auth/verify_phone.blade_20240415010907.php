
<script src="{{ asset('js/app.js') }}"></script>
@include('header')

@extends('layouts.app')

@section('title', '驗證電話')

@section('content')
@if(!session('verification_code'))
<div style="text-align: center; margin-top: 15px;">
    <h2>電話驗證</h2>
    <form method="POST" action="" style="margin-top: 10px;">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="name">電話:</label><br>
            <input type="text" id="phone" name="phone" required>
        </div>
        @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
        @endif
        <div style="margin-bottom: 20px;">
            <br><button type="submit">
                驗證
            </button>
        </div>
    </form>
</div>
@elseif(session('verification_code'))
<div style="text-align: center; margin-top: 15px;">
    <h2>電話驗證</h2>
    <form method="POST" action="{{ route('user.login') }}" style="margin-top: 10px;">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="name">輸入驗證碼:</label><br>
            <input type="text" id="phone" name="phone" required>
        </div>
        @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
        @endif
        <div style="margin-bottom: 20px;">
            <br><button type="submit">驗證</button>
        </div>
    </form>
</div>
@endif
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection