
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>

@extends('layouts.app')

@section('title', '驗證電話')

@section('content')
    <h2>Phone Verification</h2>
        <form id="verificationForm" method="POST">
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
                <div id="phoneError" class="text-danger" style="display: none;"></div>
            </div>
            <button type="button" class="btn btn-primary" id="sendCodeButton">Send Verification Code</button>
            <div class="mb-3">
                <label for="verificationCode" class="form-label">Verification Code</label>
                <input type="text" class="form-control" id="verificationCode" name="verificationCode" required>
            </div>
            @csrf
            <button type="submit" class="btn btn-primary" id="verifyCodeButton" style="display: none;">Verify Code</button>
        </form>
        <script src="{{ asset('js/app.js') }}"></script>
    <script>
        
        document.getElementById('sendCodeButton').addEventListener('click', function() {
            var phoneNumber = document.getElementById('phone').value;
            var appVerifier = new firebase.auth.RecaptchaVerifier('sendCodeButton');
            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                .then(function (confirmationResult) {
                    // 簡訊驗證碼已發送至用戶手機，顯示驗證碼輸入框和驗證按鈕
                    document.getElementById('verificationCode').style.display = 'block';
                    document.getElementById('verifyCodeButton').style.display = 'block';
                })
                .catch(function (error) {
                    // 發生錯誤，輸出錯誤訊息
                    console.error('Error sending SMS verification code:', error);
                });
        });
                /*
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('sendCodeButton').addEventListener('click', function () {
                sendVerificationCode();
            });
        });*/
        
        //function sendVerificationCode() {
            
            /*var phone = document.getElementById('phone').value;
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Change attribute name to 'content'
            fetch('', {
                method: 'post', // Change method to 'POST'
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token // Use the token variable here
                },
                body: JSON.stringify({ phone: phone })
            })*/
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
