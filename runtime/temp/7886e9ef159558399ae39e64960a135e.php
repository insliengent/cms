<?php /*a:3:{s:52:"D:\wamp64\www\a\template\mobile\index\user\home.html";i:1575098521;s:56:"D:\wamp64\www\a\template\mobile\index\public\header.html";i:1575098021;s:56:"D:\wamp64\www\a\template\mobile\index\public\footer.html";i:1575208392;}*/ ?>
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

<div class="container">
  <div class="user-set plr15 clearfix">
    <a href="<?php echo url('index/user/set'); ?>">
      <div class="left">
      <img src="<?php echo htmlentities($user['avatar']); ?>" alt="">
      </div>
      <div class="right">
        <h2>昵称：<?php echo htmlentities($user['nickname']); ?></h2>
        <p>已加入<span><?php echo htmlentities($day); ?></span>天</p>
      </div>
      <i class="icon i-arrow-right"></i>
    </a>
  </div>
  <div class="user-rate">
    <h3>学习进度</h3>
  </div>
  <div class="user-card ">
    <ul class="clearfix plr10">
     <li>
      <a href="<?php echo url('index/user/exam'); ?>">
        收藏的习题
        <div class="num"><?php echo htmlentities($myExamCount); ?> <span>个</span></div>
      </a>
      </li>
     <li>
       <a href="<?php echo url('index/user/point'); ?>">
         收藏的考点
         <div class="num"><?php echo htmlentities($myPointCount); ?><span>个</span></div>
       </a>
     </li>
     <li>
       <a href="<?php echo url('index/user/comment'); ?>">
         我的评论
         <div class="num"><?php echo htmlentities($myCommentCount); ?><span>个</span></div>
       </a>
     </li>
    </ul>
  </div>
  <div class="user-book">
    <ul>
      <li></li>
      <li></li>
      <li></li>
    </ul>
  </div>
   <div class="user-loginout" id="loginout">退出登录</div>
</div>
<script>
$(function () {
  $('#loginout').click(function(ev) {
    ev.stopPropagation();
    ev.preventDefault();
    $.ajax({
      url:"<?php echo url('index/index/loginout'); ?>",
      type:'post',
      dataType:'json',
      success : function (data) {
        location.href = data.url;
      }
    })//endajax
  })//endclick
})
</script>
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