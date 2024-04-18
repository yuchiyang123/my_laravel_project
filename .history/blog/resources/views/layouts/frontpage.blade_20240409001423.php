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
            <div class="grid-item ">
                <div class="four"></div>
                <div class="first border border-2 p-3 custom-shadow">
                    @yield("condition_add")
                </div>
                <div class="five"></div>
                <div class="end">3</div>
                
                    
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
    <script>
        var overlay = document.getElementById('overlay');
        //var trigger = document.querySelector('.trigger a');
        var popup = document.getElementById('popup');
        var header = document.querySelector('.header');
        /*
        trigger.addEventListener('click', function(event) {
            event.preventDefault();
            popup.style.display = 'block';
            header.style.backgroundColor = 'rgba(0, 0, 0, 0.000001)';
            overlay.style.display = 'block';
            popup.style.border = '1px solid gray';
            popup.style.boxShadow = '0px 0px 15px rgba(0, 0, 0, 0.7)';
            /*
            document.body.classList.add('blur-background'); 
            popup.style.filter = 'none';// 移除 body 元素的模糊效果
        });
        */
        function showPopup(mjoinId) {
            var popup = $('.popup');
            var overlay = $('.overlay');
            var header = $('.header');

            popup.css('display', 'block');
            overlay.css('display', 'block');
            popup.css('border', '1px solid gray');
            popup.css('box-shadow', '0px 0px 15px rgba(0, 0, 0, 0.7)');
            header.css('background-color', 'rgba(0, 0, 0, 0.000001)');

            $.ajax({
                url: "/showallmjoin/" + mjoinId,
                type: "GET",
                success: function(response) {
                    // 在彈出的視窗中顯示留言
                    //var encodedHtmlContent = utf8_encode(response.htmlContent);
                    $('.popup-content').html(response.htmlContent);
                    $('.popup').show();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        //處理留言
        


        var closeBtn = document.querySelector('.close a');
        /*
        closeBtn.addEventListener('click', function(event) {
            event.preventDefault(); 
            popup.style.display = 'none'; 
            popup.style.boxShadow = 'none';   
        });
        */
        overlay.addEventListener('click', function(event) {
            var popup = $('.popup');
            var overlay = $('.overlay');
            var header = $('.header');

            event.preventDefault();
            event.stopPropagation();
            
            popup.hide();
            overlay.hide();
            header.css('background-color', '#ffffff');
        });

    </script>
    </div>
</body>
</body>

</html>