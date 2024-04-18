<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
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
    background-color: #ffff;
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
    grid-template-columns: 170px  150px auto repeat(4, 100px) 45px 50px auto 170px;
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
                <div class="ui action input pt-3 d-flex" style="height: 45px; width:250px; font-size: 16px;">
                    <input type="text" placeholder="search...">
                    <select class="ui compact selection" style="font-size: 13px;">
                        <option value="all">全部</option>
                        <option selected="" value="user">用戶</option>
                        <option value="post">貼文</option>
                    </select>
                    <button class="ui icon button" type="submit">
                        <i class="search icon"></i>
                    </button>
                </div>
            </form>
            <div></div>
            <div class="headeractionmargin">
                <a href="#" class="nav-link text-dark" id="link1" onclick="toggleUnderline(event)">首</a>
            </div>
            <div class="headeractionmargin">
                <a href="/front-view" class="nav-link text-dark" id="link2" onclick="toggleUnderline(event)">揪</a>
            </div>
            <div class="headeractionmargin">
                <a href="#" class="nav-link text-dark" id="link3" onclick="toggleUnderline(event)">打</a>
            </div>
            <div class="headeractionmargin">
                <a href="/message-view-show" class="nav-link text-dark" id="link4" onclick="toggleUnderline(event)">訊</a>
            </div>
            <div ></div>
            <div ></div>
            <div ></div>
            <div class="headerprofileimgmargin">
                <div>
                    <div class="flex-shrink-0 dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            <lable>
                                <?php 
                                    $user_email = session('user_email');
                                    $user_name = session('user_name');
                                    if(isset($user_name)){
                                        //echo substr($user_email,0,1);
                                        echo $user_name;
                                    }
                                ?>
                            </lable>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="{{ route('user_profile_d', ['username' => $user_name]) }}">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
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