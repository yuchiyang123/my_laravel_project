<script src="{{ asset('js/app.js') }}"></script>
@extends('layouts.app')

@section('title', '驗證電話')

@section('content')
    <h2>Phone Verification</h2>
    <form method="get" action="{{ route('sendVerificationCode') }}">
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone">
            <div id="phoneError" class="text-danger" style="display: none;"></div>
        </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @csrf
            <button type="button" class="btn btn-primary" id="sendCodeButton">傳送簡訊</button>    
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
                /*
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('sendCodeButton').addEventListener('click', function () {
                sendVerificationCode();
            });
        });*/
        
        //function sendVerificationCode() {
            
            /*var phone = document.getElementById('phone').value;
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Change attribute name to 'content'
            fetch('{{ route('sendVerificationCode') }}', {
                method: 'post', // Change method to 'POST'
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token // Use the token variable here
                },
                body: JSON.stringify({ phone: phone })
            })
            /*.then(response => console.log(response))
            
            .then(response => {
                
                if (!response.ok) {
                    console.log('Network response was not ok');
                    throw new Error('Network response was not ok');
                }
                console.log(response.code);
                //alert(session('user_name'));
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
            });*/
            /*
            var phone = document.getElementById('phone').value;
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            $.ajax({
                url: '/user_verify_phone_send/send',
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                //data: JSON.stringify({ phone: phone }),
                contentType: 'application/json',
                success: function(response) {
                    console.log(response.phone);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    console.log('Error - ' + errorMessage);
                    document.getElementById('phoneError').innerText = 'Failed to send verification code';
                    document.getElementById('phoneError').style.display = 'block';
                }
            });

        }*/
        </script>
    </div>

    
@endsection
