<html>
  <body>
    <div class="system_name">
      <h2>○○系統</h2>
    </div>
    
    <div class="login_page">
      <div id="container1">

        <div class="login">  
          
          <h3>登入 Login</h3>

          <form action="用戶管理.php">
            <input type="text" id="username" name="username" placeholder="帳號" required>
            <div class="tab"></div>
            <input type="text" id="password" name="password" placeholder="密碼" required>
            <div class="tab"></div>
            <input type="submit" value="登入" class="submit" onclick="location.href='https://codepen.io/rosewang0303/full/OQbLBv/'">
          </form>  

          <h5 onclick="show_hide()">註冊帳號</h5>
          
        </div><!-- login end-->
      </div><!-- container1 end-->
    </div><!-- login_page end-->
    
    <div class="signup_page"
      <div id="container2">

        <div class="signup">  
          
          <h3>註冊 Sign Up</h3>

          <form action="用戶管理.php">
            <input type="text" id="fullname" name="fullname" placeholder="使用者全名" required>
            <div class="tab"></div>
            <input type="text" id="username2" name="username" placeholder="帳號" required>
            <div class="tab"></div>
            <input type="text" id="password2" name="password" placeholder="密碼" required>
            <div class="tab"></div>
            <input type="text" id="comfirm_password" name="comfirm_password" placeholder="確認密碼" required>
            <div class="tab"></div>            
            <input type="submit" value="註冊" class="submit">
          </form>  

          <h5 onclick="show_hide()">登入帳號</h5>
          
        </div><!-- signup end-->
      </div><!-- container2 end-->
    </div><!-- signup_page end--> 

    <div id="copyright">
      <h4>Copyright © 2018 RoseWang All rights reserved</h4><!--因為js，會跑版--> 
    </div>    
  </body>
</html>