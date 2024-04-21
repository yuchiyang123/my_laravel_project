<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


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
                <a>旅遊媒合平台</a>
            </div>
            <form action="" method="POST">
                
            </form>
            <div></div>
            <div class="headeractionmargin">
                <a href="#" class="nav-link text-dark" id="link1" onclick="toggleUnderline(event)">首</a>
            </div>
            <div class="headeractionmargin">
                <a href="/front" class="nav-link text-dark" id="link2" onclick="toggleUnderline(event)">揪</a>
            </div>
            <div class="headeractionmargin">
                <a href="#" class="nav-link text-dark" id="link3" onclick="toggleUnderline(event)">打</a>
            </div>
            <div class="headeractionmargin">
                <a href="/message-view-show" class="nav-link text-dark" id="link4" onclick="toggleUnderline(event)">訊</a>
            </div>
            <div ></div>
            <div ></div>
            <div class="headeractionmargin">
                @if(session('user_name') != null)
                <div class="dropdown ">
                    <a class="" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="width: 50px; height: 50px; margin: auto;">
                        <span class="position-relative" onclick="allnotify_all()">通</span>
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
                @if(session('user_name') != null)
                    <div class="flex-shrink-0 dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()->profileImage != null)
                                <?php $imageDataUri = 'data:' . Auth::user()->profileImage_type  . ';base64,' . base64_encode( Auth::user()->profileImage ); ?>
                                <img src="{{ $imageDataUri }}" alt="mdo" width="32" height="32" class="rounded-circle">
                            @else
                                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            @endif
                            <label>{{ session('user_name') }}</label>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="{{ route('user_profile_d', ['username' => session('user_name')]) }}">個人頁面</a></li>
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
    
    function notifyMe() {
    $.ajax({
        url: "/allnotify",
        type: "GET",
        success: function(response) {
            // 追加新通知到现有通知列表中
            $('#join_normalnotify').prepend(response.htmlContent_join);
            $('#normalnotify').prepend(response.htmlContent);
            // 更新通知计数
            $('#count').html(response.count);
        },
        error: function(xhr, status, error) {
            console.error('Error occurred while fetching notifications:', error);
        }
    });
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