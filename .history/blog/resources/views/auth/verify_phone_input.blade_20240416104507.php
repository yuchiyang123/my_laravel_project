@extends('layouts.app')

@section('title', '驗證電話')

@section('content')

<h2>Verify Phone Number</h2>
<form method="post" action="{{ route('verify_phone_submit') }}">
    @csrf
    <div class="mb-3">
        <label for="verification_code" class="form-label">驗證電話</label>
        <input type="text" id="phone" value="phone">
        <input type="text" class="form-control" id="verification_code" name="verification_code">
        @error('verification_code')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">驗證</button>
</form>
</div>
@endsection