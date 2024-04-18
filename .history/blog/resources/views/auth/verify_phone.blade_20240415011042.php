<script src="{{ asset('js/app.js') }}"></script>
@include('header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@endsection