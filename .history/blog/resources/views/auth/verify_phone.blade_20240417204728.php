<script src="{{ asset('js/app.js') }}"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>

@extends('layouts.app')

@section('title', '驗證電話')

@section('content')
        <div class="alert alert-danger" id="error" style="display: none;"></div>
        <h2 style="text-align: center;">簡訊驗證</h2>
        <div class="alert alert-success" id="successAuth" style="display: none;"></div>
        <form>
            <div style="margin-bottom: 20px;">
            <label>電話:</label>
            <input type="text" id="number" class="form-control" placeholder="+886*********" required><br>
            <div id="recaptcha-container"></div>
            <button type="button" class="btn btn-primary mt-3" onclick="sendOTP();">發送簡訊</button>
            </div>
        </form>

            <div style="margin-bottom: 20px;">
            <label>電話:</label>
            <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>
            <form>
                <input type="text" id="verification" class="form-control" placeholder="Verification code">
                <button type="button" class="btn btn-danger mt-3" onclick="verify()">驗證</button>
            </form>
            </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyDnY37byXfJH6EDSovfolM27bYV_k1r7ko",
            authDomain: "project-410302.firebaseapp.com",
            projectId: "project-410302",
            storageBucket: "project-410302.appspot.com",
            messagingSenderId: "956395546338",
            appId: "1:956395546338:web:f10b15015d724ab9a020bb",
            measurementId: "G-HY8KVX12J0"
        };
        firebase.initializeApp(firebaseConfig);
    </script>
    <script type="text/javascript">
        window.onload = function () {
            render();
        };
        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }
        function sendOTP() {
            var number = $("#number").val();

            // 在发送验证码之前检查数据库中是否存在该电话号码的记录
            firebase.database().ref('verifications/' + number).once('value', function(snapshot) {
                var verificationData = snapshot.val();

                if (verificationData && verificationData.verified) {
                    // 如果已验证，返回错误消息
                    $("#error").text("Phone number already verified");
                    $("#error").show();
                } else {
                    // 如果未验证，发送验证码
                    firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
                        window.confirmationResult = confirmationResult;
                        coderesult = confirmationResult;
                        console.log(coderesult);
                        $("#successAuth").text("Message sent");
                        $("#successAuth").show();

                        // 将电话号码和验证码状态存储在数据库中
                        firebase.database().ref('verifications/' + number).set({
                            codeSent: true,
                            verified: false // 尚未验证
                        });
                    }).catch(function (error) {
                        $("#error").text(error.message);
                        $("#error").show();
                    });
                }
            });
        }
        function verify() {
            var code = $("#verification").val();
            coderesult.confirm(code).then(function (result) {
                var user = result.user;
                console.log(user);
                $("#successOtpAuth").text("Auth is successful");
                $("#successOtpAuth").show();
            }).catch(function (error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
    </script>

    
@endsection