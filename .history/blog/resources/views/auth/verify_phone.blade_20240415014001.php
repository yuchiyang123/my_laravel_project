
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
            <input class="form-control" type="text" id="phone" name="phone" required>
        </div>
        @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
        @endif
        <div style="margin-bottom: 20px;">
            <br><button class="btn btn-primary" type="button" id="verificationButton">
                驗證
            </button>
        </div>
    </form>
</div>
<script>
    document.getElementById("verificationButton").onclick = function() {
    var phoneNumber = document.getElementById('phone').value;
    // 在這裡執行你的 collect 函數，並傳遞 phoneNumber 和 mjoinId 參數
    verification(phoneNumber);
};
    function verification(phoneNumber) {
        $.ajax({
            url: "/user_verify_phone/" + phoneNumber,
            type: "GET",
            success: function(response) {
                console.log('good');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
}
</script>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@endif

@endsection