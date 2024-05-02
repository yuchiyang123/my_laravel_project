<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @include('header')
    <div class="grid-container1" style="height: 40%"> @yield("img")</div>
    <div id="box" class="box pt-2">
        
        <div class="grid-container">
            <div></div>
                <div class="four"></div>
                <div class="first">
                </div>
                <div class="five"></div>
                <div class="grid-item">
                    <div class="end"></div>
                </div>
                    
                <div class="mid">

                    @yield("Form")

                </div>

        </div>
    </div>
</body>
<script>
    
    


</script>