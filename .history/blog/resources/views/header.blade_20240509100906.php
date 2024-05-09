<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
    a {
    text-decoration: none;
    color: black;
}

   .header {
    position: sticky; 
    top: 0;
    z-index: 9999; 
    
    grid-area: header; 
    width: 100%;
    height: 56px; 
    margin-bottom: 10px;
    box-sizing: border-box;
}
ion-icon {
  font-size: 35px;
}
.profileimg{
    width: 35px;
    height: auto;
}

.headerdiv{
    display: grid;
    grid-template-columns: 170px  150px auto repeat(4, 100px) 180px 50px auto 170px;
    grid-template-rows: 56px;
    text-align:center;
    margin: auto;
    font-size: 24px;
}
.headerlogomargin{
    margin: auto;
}
.headerprofileimgmargin{
    margin: auto;
}
.headeractionmargin{
    margin: auto;
}
.nav-link {
    text-decoration: none;
    color: black;
    cursor: pointer;
}
.nav-link.underline {
    text-decoration: underline;
}


/* 更多的 CSS 样式根据你的需要进行添加 */

</style>
<header class="header">
    <div >
        <div class="headerdiv">
            <div class="headerlogomargin pe-2">
                <a href="/index">旅遊媒合平台</a>
            </div>
            <form action="" method="POST">
                
            </form>
            <div></div>
            <div class="headeractionmargin">
                <a href="/index" class="nav-link text-dark" id="link1" onclick="toggleUnderline(event)"><svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="40px" fill="#000000"><path d="M226.67-186.67h140v-246.66h226.66v246.66h140v-380L480-756.67l-253.33 190v380ZM160-120v-480l320-240 320 240v480H526.67v-246.67h-93.34V-120H160Zm320-352Z"/></svg></a>
            </div>
            <div class="headeractionmargin">
                <a href="/front" class="nav-link text-dark" id="link2" onclick="toggleUnderline(event)"><svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="40px" fill="#000000"><path d="M465.33-80.67Q385-83.33 314.67-115.83q-70.34-32.5-122.34-86.17t-82.16-125.18Q80-398.69 80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q148 0 257.83 93.17Q847.67-693.67 873.33-553h-68q-17.66-80.33-70.16-143.5t-130.5-94.83V-774q0 34.33-23.84 59.5-23.83 25.17-58.16 25.17H438v84.66q0 16.72-12.83 28.03-12.84 11.31-29.84 11.31h-82V-480h100v123.33h-58l-200-200q-4.33 19.34-6.5 38.45-2.16 19.11-2.16 38.22 0 133.67 91.33 230.33Q329.33-153 465.33-147.33v66.66Zm382.67-24-132-132q-21 14-45.33 22-24.34 8-50.38 8-72.34 0-122.98-50.58-50.64-50.57-50.64-122.83 0-72.25 50.58-122.75 50.57-50.5 122.83-50.5 72.25 0 122.75 50.64t50.5 122.98q0 26.04-8.33 50.38-8.33 24.33-21.67 46l132 131.33L848-104.67ZM619.91-273.33q44.76 0 75.76-30.91 31-30.91 31-75.67 0-44.76-30.91-75.76-30.91-31-75.67-31-44.76 0-75.76 30.91-31 30.91-31 75.67 0 44.76 30.91 75.76 30.91 31 75.67 31Z"/></svg></a>
            </div>
            <div class="headeractionmargin">
                <a href="/work" class="nav-link text-dark" id="link3" onclick="toggleUnderline(event)"><svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="40px" fill="#000000"><path d="M146.67-120q-27 0-46.84-19.83Q80-159.67 80-186.67v-466.66q0-27 19.83-46.84Q119.67-720 146.67-720H320v-93.33q0-27 19.83-46.84Q359.67-880 386.67-880h186.66q27 0 46.84 19.83Q640-840.33 640-813.33V-720h173.33q27 0 46.84 19.83Q880-680.33 880-653.33v466.66q0 27-19.83 46.84Q840.33-120 813.33-120H146.67Zm0-66.67h666.66v-466.66H146.67v466.66Zm240-533.33h186.66v-93.33H386.67V-720Zm-240 533.33v-466.66 466.66Z"/></svg></a>
            </div>
            <div class="headeractionmargin">
                <a href="/message-view-show" class="nav-link text-dark" id="link4" onclick="toggleUnderline(event)"><svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="40px" fill="#000000"><path d="M240-399.33h315.33V-466H240v66.67ZM240-526h480v-66.67H240V-526Zm0-126.67h480v-66.66H240v66.66ZM80-80v-733.33q0-27 19.83-46.84Q119.67-880 146.67-880h666.66q27 0 46.84 19.83Q880-840.33 880-813.33v506.66q0 27-19.83 46.84Q840.33-240 813.33-240H240L80-80Zm131.33-226.67h602v-506.66H146.67v575l64.66-68.34Zm-64.66 0v-506.66 506.66Z"/></svg></a>
            </div>
            <div ></div>
            <div ></div>
            <div class="headeractionmargin">
                @if(Auth::check())
                <div class="dropdown">
                    <a class="" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="width: 50px; height: 50px; margin: auto;">
                        <span class="position-relative" onclick="allnotify_all()"><svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="40px" fill="#000000"><path d="M160-200v-66.67h80v-296q0-83.66 49.67-149.5Q339.33-778 420-796v-24q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v24q80.67 18 130.33 83.83Q720-646.33 720-562.67v296h80V-200H160Zm320-301.33ZM480-80q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80ZM306.67-266.67h346.66v-296q0-72-50.66-122.66Q552-736 480-736t-122.67 50.67q-50.66 50.66-50.66 122.66v296Z"/></svg></span>
                        <span id="count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px">
                            
                            <span class="visually-hidden">unread messages</span>
                        </span>
                        
                    </a>
    
                    <ul class="dropdown-menu mt-2 dropdown-menu-end overflow-auto" aria-labelledby="dropdownMenuLink" style="max-height: 800px; overflow-y: auto;">
                        <div>
                        <label class="dropdown-header fw-bold fs-5">申請通知</label>
                        <div id="join_normalnotify">
                      
                    </div>
                    
                        <label class="dropdown-header fw-bold fs-5">一般通知</label>
                        <div id="normalnotify">
                        
                        </div>
                        </div>
                    </ul>
                    
                  </div>
                  @endif
            </div>
            <div class="headerprofileimgmargin">
                <div>
                @if(Auth::check())
                    <div class="flex-shrink-0 dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()->profileImage != null)
                                <?php $imageDataUri = 'data:' . Auth::user()->profileImage_type  . ';base64,' . base64_encode( Auth::user()->profileImage ); ?>
                                <img src="{{ $imageDataUri }}" alt="mdo" width="40" height="40" class="rounded-circle">
                            @else
                                <img src="https://github.com/mdo.png" alt="mdo" width="40" height="40" class="rounded-circle">
                            @endif
                            <label>{{ Auth::user()->username }}</label>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="{{ route('user_profile_d', ['username' => Auth::user()->username ]) }}">個人頁面</a></li>
                            <li><a class="dropdown-item" href="/edit_profile">設定</a></li>
                            <li><a class="dropdown-item" href="#">還沒想到</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">登出</a></li>
                        </ul>
                    </div>
                @else
                    <div><a href="{{ route('login') }}" class="btn btn-primary">登入</a> <a href="{{ route('register') }}" class="btn btn-primary">註冊</a></div>
                    <div></div>
                @endif

                    <?php 
                    /*
                        $user_email = session('user_email');
                        $user_name = session('user_name');
                        if(isset($user_email)){
                            echo substr($user_email,0,1);
                            echo substr($user_name,0,1);
                        }else{
                            echo "Fail";
                        }*/
                    ?>
                </div>
            </div>
        </div>
    </div>    
</header>
<script>
    window.onload = function() {
        const links = document.querySelectorAll('.nav-link');
        const storedLinkId = sessionStorage.getItem('underlineLinkId');
        if (storedLinkId) {
            const storedLink = document.getElementById(storedLinkId);
            if (storedLink) {
                storedLink.classList.add('underline');
            }
        }
    };
    var interval = 1000; 
    setInterval(function() {notifyMe();}, interval);
    function toggleUnderline(event) {
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            link.classList.remove('underline');
        });
        event.target.classList.add('underline');
        // 存储当前链接的 id
        sessionStorage.setItem('underlineLinkId', event.target.id);
    }
    
   

    function notifyMe(){
            $.ajax({
                url:"/allnotify" ,
                type: "GET",
                success: function(response) {
                    $('#join_normalnotify').html(response.htmlContent_join);
                    $('#join_normalnotify').show();
                    $('#normalnotify').html(response.htmlContent);
                    $('#normalnotify').show();
                    $('#count').html(response.count);
                    $('#count').show();
                }
            })
        }
    function allnotify_all(){
            $.ajax({
                url:"/allnotify/all" ,
                type: "GET",
                success: function(response) { 
                    notifyMe();
                }
            })
        }  

</script>