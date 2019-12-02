<?php /*a:3:{s:51:"D:\wamp64\www\a\template\mobile\index\user\set.html";i:1575211391;s:56:"D:\wamp64\www\a\template\mobile\index\public\header.html";i:1575098021;s:56:"D:\wamp64\www\a\template\mobile\index\public\footer.html";i:1575208392;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/static/moblie/css/style.css">
<link rel="stylesheet" href="https://at.alicdn.com/t/font_1167221_6ty6ybupngl.css">
<script src="/static/moblie/js/jquery.min.js"></script>
<script src="/static/moblie/js/main.js"></script>
</head>
<body>
<?php
$ua = isset($_GET['ua'])?$_GET['ua']:null;
if ($ua == 'app') {
 $sty = "display: none";
 $urlAddto ="?ua=app";
}else{
  $sty ="";
  $urlAddto="";
}
?>
<header class="header" style="<?php echo $sty?>">
<div class="container">
   <a href="<?php echo url('index/index/index'); ?>" class="site-logo"><img class="logo" src="/static/admin/img/logo.png" alt=""></a>
    <div class="fr">
      <a href="<?php echo url('index/user/home'); ?>"><i class="icon i-dian"></i></a>
    </div>
</div>
</header>

<div class="container pd15">
  <div class="avatar-box">
    <a href="javascript:;" id="upload-btn">
      <img src="<?php echo htmlentities($info['avatar']); ?>" alt="" id="change-avatar">
      <input hidden="hidden" class="change" id="file" type="file">
    </a>
    <input type="text" hidden="hidden" name="uid" value="<?php echo htmlentities($info['id']); ?>">
  </div>
 <form class="user">
  <div class="form-group">
    </div>
   <div class="form-group">
      <label for="nickname">用户昵称</label>
      <input type="text" name="nickname" value="<?php echo htmlentities($info['nickname']); ?>">
    </div>
    <div class="form-group">
      <label for="email">邮箱</label>
      <input type="text" name="email" value="<?php echo htmlentities($info['email']); ?>">
    </div>
    <div class="form-group">
      <label for="phone">手机</label>
      <input type="text" name="phone" value="<?php echo htmlentities($info['phone']); ?>">
    </div>
 </form>
</div>
<?php
$currController = Request::controller();
if($currController == "News" || $currController == "Point"){
}else{ ?>
 <div class="foot-nav" style="<?php echo $sty?>">
  <ul>
   <li><a href="<?php echo url('index/index/index'); ?>"><i class="icon i-home"></i>首页</a></li>
   <li><a href="<?php echo url('index/exam/home'); ?>"><i class="icon i-cube-outline"></i>题库</a></li>
   <li><a href="<?php echo url('index/point/home'); ?>"><i class="icon i-diamond"></i>知识库</a></li>
   <li><a href="<?php echo url('index/user/home'); ?>"><i class="icon i-user"></i>个人中心</a></li>
  </ul>
 </div>

<?php } ?>
<div id="layer" class="layer">
  <div class="login-box">
      <form id="login-form">
        <h2>登录后享受更多功能</h2>
        <div class="form-group">
          <input type="text" name="phone" id="phone" placeholder="手机号">
        </div>
        <div class="form-group">
          <input type="password" name="password" id="password" placeholder="密码">
        </div>
        <div class="form-group clearfix">
          <a class="little fr" href="<?php echo url('index/index/forget'); ?>">忘记密码?</a>
        </div>
        <div class="form-group">
          <input type="text" name="redirect_to" hidden="hidden" value="<?php echo get_current_url() ?>">
          <button type="submit" class="btn" id="login">登录</button>
        </div>
      </form>
  </div>
</div>
</body>
</html>