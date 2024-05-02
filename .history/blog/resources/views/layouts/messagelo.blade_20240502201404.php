
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="{{ mix('js/msg.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/Messagepagestyles.css') }}">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @include('header')

    <div id="box" class="box">

        <div class="grid-container">
            <div></div>
                <div class="first vh-100">
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