<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<style>
    
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
    grid-template-columns: 150px auto repeat(4, 100px) 35px 50px auto 70px;
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
            <div class="headerlogomargin">
                <a>旅遊媒合平台</a>
            </div>
            <div></div>
            <div class="headeractionmargin">
                <a href="#" class="nav-link" id="link1" onclick="toggleUnderline(event)">首</a>
            </div>
            <div class="headeractionmargin">
                <a href="/front-view" class="nav-link" id="link2" onclick="toggleUnderline(event)">揪</a>
            </div>
            <div class="headeractionmargin">
                <a href="#" class="nav-link" id="link3" onclick="toggleUnderline(event)">打</a>
            </div>
            <div class="headeractionmargin">
                <a href="#" class="nav-link" id="link4" onclick="toggleUnderline(event)">訊</a>
            </div>
            <div ></div>
            <div ></div>
            <div ></div>
            <div class="headerprofileimgmargin">
                <div>
                    <?php 
                        $user_email = session('user_email');
                        $user_name = session('user_name');
                        if(isset($user_email)){
                            echo substr($user_email,0,1);
                            echo substr($user_name,0,1);
                        }else{
                            echo "Fail";
                        }
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