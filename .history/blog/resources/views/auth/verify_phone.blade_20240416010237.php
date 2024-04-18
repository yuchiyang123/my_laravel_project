
@extends('layouts.app')

@section('title', '驗證電話')

@section('content')
@if(!session('verification_code'))
            <h2>Phone Verification</h2>
            <form>    
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone">
                    <div id="phoneError" class="text-danger" style="display: none;"></div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf
                <button type="button" class="btn btn-primary" id="sendCodeButton">Send Verification Code</button>
            </form>    
            <script src="{{ asset('js/app.js') }}"></script>
            <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('sendCodeButton').addEventListener('click', function () {
                sendVerificationCode();
            });
        });

        function sendVerificationCode() {
            
            var phone = document.getElementById('phone').value;
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Change attribute name to 'content'
            fetch('{{ route('sendVerificationCode') }}', {
                method: 'POST', // Change method to 'POST'
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token // Use the token variable here
                },
                body: JSON.stringify({ phone: phone })
            })
            /*.then(response => console.log(response))*/
            
            .then(response => {
                
                if (!response.ok) {
                    console.log('Network response was not ok');
                    throw new Error('Network response was not ok');
                }
                console.log(data);
                return response.json();
            })
            
            .then(data => {

                alert(data.message);
                location.reload();
            })
            .catch(error => {
                
                document.getElementById('phoneError').innerText = 'Failed to send verification code';
                document.getElementById('phoneError').style.display = 'block';
                console.log(error);
            });
            /*
            var phone = document.getElementById('phone').value;
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            $.ajax({
                url: '{{ route('sendVerificationCode') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: JSON.stringify({ phone: phone }),
                contentType: 'application/json',
                success: function(data) {
                    alert(data.message);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    console.log('Error - ' + errorMessage);
                    document.getElementById('phoneError').innerText = 'Failed to send verification code';
                    document.getElementById('phoneError').style.display = 'block';
                }
            });*/

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
