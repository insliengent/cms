<?php /*a:3:{s:52:"D:\wamp64\www\a\template\mobile\index\point\art.html";i:1575208329;s:56:"D:\wamp64\www\a\template\mobile\index\public\header.html";i:1575098021;s:56:"D:\wamp64\www\a\template\mobile\index\public\footer.html";i:1575208392;}*/ ?>
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
  <div class="post-head pd15">
    <h1><?php echo htmlentities($info['title']); ?></h1>
  </div>
  <div class="post-mate pd15">
    <span>更新时间：<?php echo htmlentities(date("Y.m.d",!is_numeric($info['update_time'])? strtotime($info['update_time']) : $info['update_time'])); ?></span>
  </div>
  <div class="post-body pd15">
    <?php echo $info['content']; ?>
  </div>
  <div class="post-mate">
    <?php if(($prv)!=null): ?>
    <div class="post-prv">
      上一篇：<a  href="<?php echo url('index/point/art', ['id' => $prv['id']]); ?>" title="<?php echo htmlentities($prv['title']); ?>"><?php echo htmlentities($prv['title']); ?></a>
    </div>
    <?php endif; if(($next)!=null): ?>
    <div class="post-next">
      下一篇：
    <a  href="<?php echo url('index/point/art', ['id' => $next['id']]); ?>" title="<?php echo htmlentities($next['title']); ?>"><?php echo htmlentities($next['title']); ?></a>
    </div>
    <?php endif; ?>
  </div>

  <div id="comments" class="comments" name="comments">
    <div class="comments-area">
      <ol class="comment-list" style="font-size: 9px">
        <?php if(is_array($comments) || $comments instanceof \think\Collection || $comments instanceof \think\Paginator): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li class="comment-li clearfix" id="#comment-<?php echo htmlentities($vo['id']); ?>">
          <div class="author-avatar"><img src="<?php echo htmlentities($vo['avatar']); ?>" alt=""></div>
          <div class="comment-body">
            <div class="author-name"><?php echo htmlentities($vo['nickname']); ?></div>
            <div class="comment-content"><?php echo htmlentities($vo['content']); ?></div>
            <time><?php echo htmlentities(date("m-d",!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></time>
            <span class="comment-add"><i class="icon i-comment"></i></span>
            <span class="comment-up" data-id="<?php echo htmlentities($vo['id']); ?>"><em><?php echo htmlentities($vo['like']); ?></em><i class="icon i-thumbs-o-up"></i></span>
          </div>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </ol>
    </div>
    <form class="post-comment" id="comment-form">
      <textarea type="text" name="comment" class="comment"></textarea>
      <input type="text" hidden="hidden" name="id" value="<?php echo htmlentities($info['id']); ?>">
      <input type="text" hidden="hidden" name="controller" value="<?php echo Request::controller()?>">
      <div class="btn" id="comment-submit">发布</div>
    </form>
  </div>

</div>
<footer class="post-footer">
  <a href="javascript:" id="like" data-id="<?php echo htmlentities($info['id']); ?>" class="icon i-thumbs-o-up"></a>
  <a href="javascript:" id="love" data-id="<?php echo htmlentities($info['id']); ?>" class="icon i-staro"></a>
  <a href="#comments" id="comment-btn" class="icon i-comment"></a>
</footer>
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