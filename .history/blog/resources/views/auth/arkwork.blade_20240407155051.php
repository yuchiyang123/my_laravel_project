@extends('layouts.layoutback')

@section('title', '')

@section('Form')

<form id="postForm" action="{{ route('mjoin_post_posts') }}" method="POST">
    @csrf

@endsection