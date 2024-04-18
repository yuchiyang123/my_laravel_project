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
    renderRecaptcha();
};

function renderRecaptcha() {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
}

function sendOTP() {
    var number = $("#number").val();

    // 检查电话号码是否已被注册
    checkForPhoneNumber(number).then(function (isRegistered) {
        if (!isRegistered) {
            // 电话号码未注册，发送验证码
            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                console.log(coderesult);
                $("#successAuth").text("Message sent");
                $("#successAuth").show();
            }).catch(function (error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        } else {
            // 电话号码已被注册，显示错误消息
            $("#error").text("Phone number already registered");
            $("#error").show();
        }
    }).catch(function (error) {
        // 处理错误
        $("#error").text(error.message);
        $("#error").show();
    });
}

// 检查电话号码是否已被注册
function checkForPhoneNumber(number) {
    return new Promise(function (resolve, reject) {
        var database = firebase.database();
        var ref = database.ref('/users');

        ref.orderByChild('phone').equalTo(number).once('value', function (snapshot) {
            if (snapshot.exists()) {
                // 找到相同电话号码
                resolve(true);
            } else {
                // 未找到相同电话号码
                resolve(false);
            }
        }, function (error) {
            // 处理错误
            reject(error);
        });
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
