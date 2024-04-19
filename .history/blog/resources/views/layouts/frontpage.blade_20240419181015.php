<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/frontpagestyles.css') }}">
    <!--https://animate.style動畫-->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
</head>

<body>


    @include('header')

    <div id="box" class="box">

        <div class="grid-container">
            <div></div>
            <div class="grid-item ">
                <div class="four"></div>
                <div class="first border border-2 p-3 custom-shadow">
                    @yield("condition_add")
                </div>
                <div class="five"></div>
                <div class="end"></div>
                
                    
                <div class="mid">
                    @yield('PostBtn')




                    @yield("Post")

                </div>

            </div>
        </div><br>
        

        
    </div>
    </div>
    </div>
    </div>
    </div>
    
    </div>
</body>
</body>

</html>