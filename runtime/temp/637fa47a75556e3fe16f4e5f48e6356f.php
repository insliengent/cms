<?php /*a:3:{s:51:"D:\wamp64\www\a\template\mobile\index\news\lst.html";i:1574840713;s:56:"D:\wamp64\www\a\template\mobile\index\public\header.html";i:1573050616;s:56:"D:\wamp64\www\a\template\mobile\index\public\footer.html";i:1575014386;}*/ ?>
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

<section class="container pd15">
    <?php if(is_array($newslst) || $newslst instanceof \think\Collection || $newslst instanceof \think\Paginator): $i = 0; $__LIST__ = $newslst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <a href="<?php echo url('index/news/art', ['id' => $vo['id']]); ?>" class="art-news">
      <div class="left">
        <div  class="img" style="background-image: url(<?php echo htmlentities($vo['img']); ?>);"></div>
      </div>
      <div class="right">
        <h2><?php echo htmlentities($vo['title']); ?></h2>
        <div class="mate">
          <span><?php echo htmlentities(date('Y-m-d',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></span>
          <span>赞：<?php echo htmlentities($vo['views']); ?></span>
          <span>评论：<?php echo htmlentities($vo['love']); ?></span>
        </div>
      </div>
      </a>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <?php echo $newslst; ?>
</section>
<?php
$currController = Request::controller();
if($currController == "News"){
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
