<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<body>
    <?php
    include('header.php');
    ?>
    
    <div id="box" class="box">
        
        <div class="grid-container">
            <div></div>
            <div class="grid-item ">
                <div class="four"></div>
                <div class="first border border-2 p-3 custom-shadow">
                    @yield("condition_add")
                </div>
            <div class="five"></div>
            <div class="grid-item">
                <div class="end">3</div>
            </div>
            <div class="mid">
                <div class="cut">
                    <div class="grid-item">
                        <div class="limt">
                            <div class="image-container">
                                <img src="img/2-1.png" class="imgsize">
                            </div>
                            <div class="text-container">
                                <div class="user"><a href="#">
                                        <div><a href="#">你的名字</a></div>
                                    </a></div>
                                <div class="date">
                                    <div><a href="#">日期</a></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <p class="main">
                                Download Composer Latest: v2.7.2
                                Windows Installer
                                The installer - which requires that you have PHP already installed - will download Composer for you and set up your PATH environment variable so you can simply call composer from any directory.

                                Download and run Composer-Setup.exe - it will install the latest composer version whenever it is executed.

                                Command-line installation
                                To quickly install Composer in the current directory, run the following script in your terminal. To automate the installation, use the guide on installing Composer programmatically.

                                php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
                                php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413f
                                f2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
                                php composer-setup.php
                                php -r "unlink('composer-setup.php');"
                                This installer script will simply check some php.ini settings, warn you if they are set incorrectly, and then download the latest composer.phar in the current directory. The 4 lines above will, in order:

                                Download the installer to the current directory
                                Verify the installer SHA-384, which you can also cross-check here
                                Run the installer
                                Remove the installer<div class="trigger"><a href="#">查看完整内容</a></div>
                            </p>
                            <div class="container">
                                <div class="respond"><a href="#">👍🏽</a>
                                    <div><a href="#">58</a></div>
                                </div>
                                <div class="message">
                                    <div><a href="#">8則留言</a></div>
                                </div>
                            </div>
                            <div class="line">
                                <div class="inner-grid">👍</div>
                                <div class="inner-grid">👍🏻</div>
                                <div class="inner-grid">👍🏿</div>
                            </div>
                            <div class="SeeAllMessage"><a href="#">查看全部留言</a></div>
                            <div class="LeaveMessage">
                                <div><a href="#"></a></div>
                                <div>
                                    <div class="LeaveMessageimgdiv">
                                        <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                                    </div>
                                    <div class="LeaveMessageall">
                                        <div class="LeaveMessageUsername">
                                            留言姓名
                                        </div>
                                        <div class="LeaveMessageMain">
                                            內容內容內容內容內容
                                        </div>
                                        <div class="LeaveMessageAction">
                                            <a href="#">4天</a>&emsp;<a href="#">讚</a>&emsp;<a href="#">回復</a>&emsp;<a href="#">動作</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="LeaveMessage">
                                <div><a href="#"></a></div>
                                <div>
                                    <div class="LeaveMessageimgdiv">
                                        <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                                    </div>
                                    <div class="LeaveMessageall">
                                        <div class="LeaveMessageUsername">
                                            留言姓名
                                        </div>
                                        <div class="LeaveMessageMain">
                                            內容內容內容內容內容
                                        </div>
                                        <div class="LeaveMessageAction">
                                            <a href="#">4天</a>&emsp;<a href="#">讚</a>&emsp;<a href="#">回復</a>&emsp;<a href="#">動作</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="mid">
                    <div class="grid-item">
                        <div class="limt">
                            <div class="image-container">
                                <img src="img/2-1.png" class="imgsize">
                            </div>
                            <div class="text-container">
                                <div class="user"><a href="#">
                                        <div><a href="#">你的名字</a></div>
                                    </a></div>
                                <div class="date">
                                    <div><a href="#">日期</a></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <p class="main">
                                Download Composer Latest: v2.7.2
                                Windows Installer
                                The installer - which requires that you have PHP already installed - will download Composer for you and set up your PATH environment variable so you can simply call composer from any directory.

                                Download and run Composer-Setup.exe - it will install the latest composer version whenever it is executed.

                                Command-line installation
                                To quickly install Composer in the current directory, run the following script in your terminal. To automate the installation, use the guide on installing Composer programmatically.

                                php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
                                php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413f
                                f2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
                                php composer-setup.php
                                php -r "unlink('composer-setup.php');"
                                This installer script will simply check some php.ini settings, warn you if they are set incorrectly, and then download the latest composer.phar in the current directory. The 4 lines above will, in order:

                                Download the installer to the current directory
                                Verify the installer SHA-384, which you can also cross-check here
                                Run the installer
                                Remove the installer<div class="trigger"><a href="#">查看完整内容</a></div>
                            </p>
                            <div class="container">
                                <div class="respond"><a href="#">👍🏽</a>
                                    <div><a href="#">58</a></div>
                                </div>
                                <div class="message">
                                    <div><a href="#">8則留言</a></div>
                                </div>
                            </div>
                            <div class="line">
                                <div class="inner-grid">👍</div>
                                <div class="inner-grid">👍🏻</div>
                                <div class="inner-grid">👍🏿</div>
                            </div>
                            <div class="SeeAllMessage"><a href="#">查看全部留言</a></div>
                            <div class="LeaveMessage">
                                <div><a href="#"></a></div>
                                <div>
                                    <div class="LeaveMessageimgdiv">
                                        <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                                    </div>
                                    <div class="LeaveMessageall">
                                        <div class="LeaveMessageUsername">
                                            留言姓名
                                        </div>
                                        <div class="LeaveMessageMain">
                                            內容內容內容內容內容
                                        </div>
                                        <div class="LeaveMessageAction">
                                            <a href="#">4天</a>&emsp;<a href="#">讚</a>&emsp;<a href="#">回復</a>&emsp;<a href="#">動作</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="LeaveMessage">
                                <div><a href="#"></a></div>
                                <div>
                                    <div class="LeaveMessageimgdiv"><img src="img/2-1.png" class="LeaveMessageUsernameIMG"></div>
                                    <div class="LeaveMessageUsername">留言姓名</div>
                                    <div class="LeaveMessageMain">內容內容內容內容內容</div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="grid-item">4</div><br>
                    <div class="grid-item">5</div><br>
                    <div class="grid-item">6</div><br>
                    <div class="grid-item">7</div><br>
                    <div class="grid-item">8</div><br>
                    <div class="grid-item">9</div>
                    <div class="overlay" id="overlay"></div>
                    <div id="popup" class="popup">
                        <div class="mid">
                            <div class="cut">
                                <div class="grid-item">
                                    <div class="limt">
                                        <div class="image-container">
                                            <img src="img/2-1.png" class="imgsize">
                                        </div>
                                        <div class="text-container">
                                            <div class="user"><a href="#">
                                                    <div><a href="#">你的名字</a></div>
                                                </a></div>
                                            <div class="date">
                                                <div><a href="#">日期</a></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <p class="main">
                                            Download Composer Latest: v2.7.2
                                            Windows Installer
                                            The installer - which requires that you have PHP already installed - will download Composer for you and set up your PATH environment variable so you can simply call composer from any directory.

                                            Download and run Composer-Setup.exe - it will install the latest composer version whenever it is executed.

                                            Command-line installation
                                            To quickly install Composer in the current directory, run the following script in your terminal. To automate the installation, use the guide on installing Composer programmatically.

                                            php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
                                            php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413f
                                            f2e3b6f88543c636f7cd84f6db9189d43a81e5
                                            503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
                                            php composer-setup.php
                                            php -r "unlink('composer-setup.php');"
                                            This installer script will simply check some php.ini settings, warn you if they are set incorrectly, and then download the latest composer.phar in the current directory. The 4 lines above will, in order:

                                            Download the installer to the current directory
                                            Verify the installer SHA-384, which you can also cross-check here
                                            Run the installer
                                            Remove the installer
                                        </p>
                                        <div class="container">
                                            <div class="respond"><a href="#">👍🏽</a>
                                                <div><a href="#">58</a></div>
                                            </div>
                                            <div class="message">
                                                <div><a href="#">8則留言</a></div>
                                            </div>
                                        </div>
                                        <div class="line">
                                            <div class="inner-grid">👍</div>
                                            <div class="inner-grid">👍🏻</div>
                                            <div class="inner-grid">👍🏿</div>
                                        </div>
                                        <div class="SeeAllMessage"><a href="#">查看全部留言</a></div>
                                        <div class="LeaveMessage">
                                            <div><a href="#"></a></div>
                                            <div>
                                                <div class="LeaveMessageimgdiv">
                                                    <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                                                </div>
                                                <div class="LeaveMessageall">
                                                    <div class="LeaveMessageUsername">
                                                        留言姓名
                                                    </div>
                                                    <div class="LeaveMessageMain">
                                                        內容內容內容內容內容
                                                    </div>
                                                    <div class="LeaveMessageAction">
                                                        <a href="#">4天</a>&emsp;<a href="#">讚</a>&emsp;<a href="#">回復</a>&emsp;<a href="#">動作</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="LeaveMessage">
                                            <div><a href="#"></a></div>
                                            <div>
                                                <div class="LeaveMessageimgdiv">
                                                    <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                                                </div>
                                                <div class="LeaveMessageall">
                                                    <div class="LeaveMessageUsername">
                                                        留言姓名
                                                    </div>
                                                    <div class="LeaveMessageMain">
                                                        內容內容內容內容內容
                                                    </div>
                                                    <div class="LeaveMessageAction">
                                                        <a href="#">4天</a>&emsp;<a href="#">讚</a>&emsp;<a href="#">回復</a>&emsp;<a href="#">動作</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="LeaveMessage">
                                            <div><a href="#"></a></div>
                                            <div>
                                                <div class="LeaveMessageimgdiv">
                                                    <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                                                </div>
                                                <div class="LeaveMessageall">
                                                    <div class="LeaveMessageUsername">
                                                        留言姓名
                                                    </div>
                                                    <div class="LeaveMessageMain">
                                                        內容內容內容內容內容
                                                    </div>
                                                    <div class="LeaveMessageAction">
                                                        <a href="#">4天</a>&emsp;<a href="#">讚</a>&emsp;<a href="#">回復</a>&emsp;<a href="#">動作</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="LeaveMessage">
                                            <div><a href="#"></a></div>
                                            <div>
                                                <div class="LeaveMessageimgdiv">
                                                    <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                                                </div>
                                                <div class="LeaveMessageall">
                                                    <div class="LeaveMessageUsername">
                                                        留言姓名
                                                    </div>
                                                    <div class="LeaveMessageMain">
                                                        內容內容內容內容內容
                                                    </div>
                                                    <div class="LeaveMessageAction">
                                                        <a href="#">4天</a>&emsp;<a href="#">讚</a>&emsp;<a href="#">回復</a>&emsp;<a href="#">動作</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="LeaveMessage">
                                            <div><a href="#"></a></div>
                                            <div>
                                                <div class="LeaveMessageimgdiv">
                                                    <img src="img/2-1.png" class="LeaveMessageUsernameIMG">
                                                </div>
                                                <div class="LeaveMessageall">
                                                    <div class="LeaveMessageUsername">
                                                        留言姓名
                                                    </div>
                                                    <div class="LeaveMessageMain">
                                                        內容內容內容內容內容
                                                    </div>
                                                    <div class="LeaveMessageAction">
                                                        <a href="#">4天</a>&emsp;<a href="#">讚</a>&emsp;<a href="#">回復</a>&emsp;<a href="#">動作</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <!--div class="close"><a href="#">关闭</a></div-->
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <script>
            var overlay = document.getElementById('overlay');
            var trigger = document.querySelector('.trigger a');
            var popup = document.getElementById('popup');
            var header = document.querySelector('.header');
            trigger.addEventListener('click', function(event) {
                event.preventDefault();
                popup.style.display = 'block';
                header.style.backgroundColor = 'rgba(0, 0, 0, 0.000001)';
                overlay.style.display = 'block';
                popup.style.border = '1px solid gray';
                popup.style.boxShadow = '0px 0px 15px rgba(0, 0, 0, 0.7)';
                /*
                document.body.classList.add('blur-background'); 
                popup.style.filter = 'none';// 移除 body 元素的模糊效果*/
            });
            var closeBtn = document.querySelector('.close a');
            /*
            closeBtn.addEventListener('click', function(event) {
                event.preventDefault(); 
                popup.style.display = 'none'; 
                popup.style.boxShadow = 'none';   
            });
            */
            overlay.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                popup.style.display = 'none';
                overlay.style.display = 'none';
                popup.style.boxShadow = 'none';
                header.style.backgroundColor = '#ffffff';
            });
        </script>
</body>
</body>
</html>
