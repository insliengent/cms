<?php /*a:1:{s:55:"D:\wamp64\www\a\application\admin\view\index\login.html";i:1573049064;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="static/admin/style/login.css">
    <script src="https://cdn.bootcss.com/jquery/2.2.2/jquery.min.js"></script>
</head>
<body>
<header class="header">
  <div class="container">
  <img src="/static/admin/img/logo.png" alt="" class="logo">
  </div>
</header>
<div class="login-bg">
<div class="container">
  <div class="login-box">
    <form>
      <div class="form-group">
        <input type="text" name="phone" id="phone" placeholder="手机号">
      </div>
      <div class="form-group">
        <input type="password" name="password" id="password" placeholder="密码">
      </div>
      <div class="form-group">
        <div class="error"></div>
      </div>
      <div class="form-group">
          <label>
            <input type="checkbox" class="little"> Remember me
          </label>
        <a class="little" href="<?php echo url('admin/index/forget'); ?>">忘记密码?</a>
      </div>
      <div class="form-group">
        <button type="submit" class="btn" id="login">登录</button>
      </div>
    </form>
  </div>
</div>
</div>
<footer class="foot">
  Copyright © 2006-2019 高顿税务师, All Rights Reserved.
</footer>
<script>

  $(function () {
       $('#login').click(function () {
           $.ajax({
               url:"<?php echo url('admin/index/login'); ?>",
               type:"post",
               data:$('form').serialize(),
               dataType:'json',
               success:function (data) {
                  if (data.code == 1) {
                    location.href = data.url;
                  }else{
                    $('.error').html(data.msg);
                  }
               }
           });
           return false;
       });
    });
</script>
</body>
</html>