<html>
    <head>
        <title>應用程式名稱 - @yield('title')</title>
    </head>
    <body>
        @section('sidebar')
            這是主要的側邊欄。
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>