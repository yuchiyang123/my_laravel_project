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
            <div >
                <div class="relative font-[sans-serif] w-max mx-auto">
                    <button type="button"
                      class="w-12 h-12 flex items-center justify-center rounded-full text-white text-sm font-semibold border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-blue-600">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20px" class="cursor-pointer fill-[#fff]"
                        viewBox="0 0 371.263 371.263">
                        <path
                          d="M305.402 234.794v-70.54c0-52.396-33.533-98.085-79.702-115.151.539-2.695.838-5.449.838-8.204C226.539 18.324 208.215 0 185.64 0s-40.899 18.324-40.899 40.899c0 2.695.299 5.389.778 7.964-15.868 5.629-30.539 14.551-43.054 26.647-23.593 22.755-36.587 53.354-36.587 86.169v73.115c0 2.575-2.096 4.731-4.731 4.731-22.096 0-40.959 16.647-42.995 37.845-1.138 11.797 2.755 23.533 10.719 32.276 7.904 8.683 19.222 13.713 31.018 13.713h72.217c2.994 26.887 25.869 47.905 53.534 47.905s50.54-21.018 53.534-47.905h72.217c11.797 0 23.114-5.03 31.018-13.713 7.904-8.743 11.797-20.479 10.719-32.276-2.036-21.198-20.958-37.845-42.995-37.845a4.704 4.704 0 0 1-4.731-4.731zM185.64 23.952c9.341 0 16.946 7.605 16.946 16.946 0 .778-.12 1.497-.24 2.275-4.072-.599-8.204-1.018-12.336-1.138-7.126-.24-14.132.24-21.078 1.198-.12-.778-.24-1.497-.24-2.275.002-9.401 7.607-17.006 16.948-17.006zm0 323.358c-14.431 0-26.527-10.3-29.342-23.952h58.683c-2.813 13.653-14.909 23.952-29.341 23.952zm143.655-67.665c.479 5.15-1.138 10.12-4.551 13.892-3.533 3.773-8.204 5.868-13.353 5.868H59.89c-5.15 0-9.82-2.096-13.294-5.868-3.473-3.772-5.09-8.743-4.611-13.892.838-9.042 9.282-16.168 19.162-16.168 15.809 0 28.683-12.874 28.683-28.683v-73.115c0-26.228 10.419-50.719 29.282-68.923 18.024-17.425 41.498-26.887 66.528-26.887 1.198 0 2.335 0 3.533.06 50.839 1.796 92.277 45.929 92.277 98.325v70.54c0 15.809 12.874 28.683 28.683 28.683 9.88 0 18.264 7.126 19.162 16.168z"
                          data-original="#000000"></path>
                      </svg>
                    </button>
                    <div class='absolute shadow-lg bg-white py-2 z-[1000] min-w-full rounded-lg w-[410px] max-h-[500px] overflow-auto'>
                      <div class="flex items-center justify-between my-4 px-4">
                        <p class="text-xs text-blue-500 cursor-pointer">Clear all</p>
                        <p class="text-xs text-blue-500 cursor-pointer">Mark as read</p>
                      </div>
                      <ul class="divide-y">
                        <li class='py-4 px-4 flex items-center hover:bg-gray-50 text-black text-sm cursor-pointer'>
                          <img src="https://readymadeui.com/profile_2.webp" class="w-12 h-12 rounded-full shrink-0" />
                          <div class="ml-6">
                            <h3 class="text-sm text-[#333] font-semibold">Your have a new message from Yin</h3>
                            <p class="text-xs text-gray-400 mt-2">Hello there, check this new items in from the your may interested from
                              the motion school</p>
                            <p class="text-xs text-blue-500 leading-3 mt-2">10 minutes ago</p>
                          </div>
                        </li>
                        <li class='py-4 px-4 flex items-center hover:bg-gray-50 text-black text-sm cursor-pointer'>
                          <img src="https://readymadeui.com/profile_3.webp" class="w-12 h-12 rounded-full shrink-0" />
                          <div class="ml-6">
                            <h3 class="text-sm text-[#333] font-semibold">Your have a new message from Haper</h3>
                            <p class="text-xs text-gray-400 mt-2">Hello there, check this new items in from the your may interested from
                              the motion school</p>
                            <p class="text-xs text-blue-500 leading-3 mt-2">2 hours ago</p>
                          </div>
                        </li>
                        <li class='py-4 px-4 flex items-center hover:bg-gray-50 text-black text-sm cursor-pointer'>
                          <img src="https://readymadeui.com/profile_4.webp" class="w-12 h-12 rounded-full shrink-0" />
                          <div class="ml-6">
                            <h3 class="text-sm text-[#333] font-semibold">Your have a new message from San</h3>
                            <p class="text-xs text-gray-400 mt-2">Hello there, check this new items in from the your may interested from
                              the motion school</p>
                            <p class="text-xs text-blue-500 leading-3 mt-2">1 day ago</p>
                          </div>
                        </li>
                        <li class='py-4 px-4 flex items-center hover:bg-gray-50 text-black text-sm cursor-pointer'>
                          <img src="https://readymadeui.com/profile_5.webp" class="w-12 h-12 rounded-full shrink-0" />
                          <div class="ml-6">
                            <h3 class="text-sm text-[#333] font-semibold">Your have a new message from Seeba</h3>
                            <p class="text-xs text-gray-400 mt-2">Hello there, check this new items in from the your may interested from
                              the motion school</p>
                            <p class="text-xs text-blue-500 leading-3 mt-2">30 minutes ago</p>
                          </div>
                        </li>
                      </ul>
                      <p class="text-sm px-4 mt-6 mb-4 inline-block text-blue-500 cursor-pointer">View all Notifications</p>
                    </div>
                  </div>
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

    function toggleUnderline(event) {
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            link.classList.remove('underline');
        });
        event.target.classList.add('underline');
        // 存储当前链接的 id
        sessionStorage.setItem('underlineLinkId', event.target.id);
    }
</script>