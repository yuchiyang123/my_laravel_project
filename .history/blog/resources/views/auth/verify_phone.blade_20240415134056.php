
@extends('layouts.app')

@section('title', '驗證電話')

@section('content')
@if(!session('verification_code'))
            <h2>Phone Verification</h2>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone">
                    <div id="phoneError" class="text-danger" style="display: none;"></div>
                </div>
                <button type="button" class="btn btn-primary" id="sendCodeButton">Send Verification Code</button>
            <script src="{{ asset('js/app.js') }}"></script>
            <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('sendCodeButton').addEventListener('click', function () {
                sendVerificationCode();
            });
        });

        function sendVerificationCode() {
            var phone = document.getElementById('phone').value;
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('value'); // 修改此处的属性名为 'value'

            fetch('{{ route('sendVerificationCode') }}', {
                method: 'POST', // 将方法改为 'POST'
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': token
                },
                body: JSON.stringify({ phone: phone })
            })

            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(error => {
                console.log(error);
                document.getElementById('phoneError').innerText = 'Failed to send verification code';
                document.getElementById('phoneError').style.display = 'block';
            });
        }

    </script>
        @else
            <h2>Verify Phone Number</h2>
            <form method="post" action="{{ route('verify_phone_submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="verification_code" class="form-label">Verification Code</label>
                    <input type="text" class="form-control" id="verification_code" name="verification_code">
                    @error('verification_code')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Verify</button>
                <input type="hidden" name="verification_code" value="{{ session('verification_code') }}">
            </form>
        @endif
    </div>

    
@endsection
