<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.3/socket.io.js"></script>

<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <link rel="stylesheet" href="{{ asset('css/Messagepagestyles.css') }}">
</head>
@include('header')
<body>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    

    <div id="box" class="box">

        <div class="grid-container">
            <div></div>
                <div class="first vh-80">
                    @yield("MessageFirst")
                </div>
                <div class="mid vh-100">
                    @yield("MessageMid")
                </div>
                <div class="end vh-100">
                    @yield("MessageEnd")
                </div>
        </div>
    </div>
</body>
<script>
    
</script>