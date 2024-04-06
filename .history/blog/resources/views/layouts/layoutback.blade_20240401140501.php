<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/frontpagestyles.css') }}">
</head>

<body>


    @include('header')

    <div id="box" class="box">

        <div class="grid-container">
            <div></div>
                <div class="four"></div>
                <div class="first">
                </div>
                <div class="five"></div>
                <div class="grid-item">
                    <div class="end">3</div>
                </div>
                    
                <div class="mid">




                    @yield("Post")

                </div>

        </div>
    </div>
</body>