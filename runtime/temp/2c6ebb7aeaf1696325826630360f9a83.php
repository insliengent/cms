<?php /*a:3:{s:54:"D:\wamp64\www\a\template\mobile\index\index\index.html";i:1575021881;s:56:"D:\wamp64\www\a\template\mobile\index\public\header.html";i:1575098021;s:56:"D:\wamp64\www\a\template\mobile\index\public\footer.html";i:1575208392;}*/ ?>
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

<link rel="stylesheet" href="static/moblie/css/swiper.min.css">
<script src="static/moblie/js/swiper.min.js"></script>
<div class="container">
<section class="swiper-container banner">
<ul class="swiper-wrapper">
  <?php if(is_array($sliderlst) || $sliderlst instanceof \think\Collection || $sliderlst instanceof \think\Paginator): $i = 0; $__LIST__ = $sliderlst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
  <li class="swiper-slide"><a href="<?php echo htmlentities($v['link']); ?>"><img src="<?php echo htmlentities($v['img']); ?>" alt="<?php echo htmlentities($v['title']); ?>"></a></li>
  <?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<div class="swiper-pagination"></div>
</section>
<nav class="icon-nav">
  <ul class="clearfix">
      <li><a href="<?php echo url('index/point/home'); ?>"><i class="icon i-target"></i>考点</a></li>
      <li><a href="<?php echo url('index/exam/home'); ?>"><i class="icon i-university"></i>题库</a></li>
      <li><a href="<?php echo url('index/video/lst'); ?>"><i class="icon i-cube-outline"></i>视频</a></li>
      <li><a href="<?php echo url('index/guide/lst'); ?>"><i class="icon i-compass"></i>报考</a></li>
      <li><a href="<?php echo url('index/news/lst', ['id' => '118']); ?>"><i class="icon i-notice"></i>通知</a></li>
      <li><a href="<?php echo url('index/news/lst'); ?>"><i class="icon i-news"></i>资讯</a></li>
      <li><a href="<?php echo url('index/news/lst', ['id' => '121']); ?>"><i class="icon i-mortarboard"></i>经验</a></li>
      <li><a href="<?php echo url('index/down/home'); ?>"><i class="icon i-ziliao"></i>资料</a></li>
  </ul>
</nav>
<section class="tip">
  <img src="/static/moblie/img/hot_top.png" alt="" class="tip-img">
  <ul>
    <li>距离税务师报名结束还有<span id="day_show"></span>天</li>
  </ul>
</section>
<section class="book ptb15">
  <ul class="clearfix">
    <?php if(is_array($books) || $books instanceof \think\Collection || $books instanceof \think\Paginator): $i = 0; $__LIST__ = $books;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <li>
      <a href="<?php echo url('index/index/book', ['id' => $vo['id']]); ?>">
        <img src="<?php echo htmlentities($vo['img']); ?>" alt="">
      </a>
    </li>
    <?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>
</section>
<section class="news pd15">
  <?php if(is_array($newslst) || $newslst instanceof \think\Collection || $newslst instanceof \think\Paginator): $i = 0; $__LIST__ = $newslst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
  <a href="<?php echo url('index/news/art', ['id' => $vo['id']]); ?>" class="art-news">
      <div class="left">
        <div  class="img" style="background-image: url(<?php echo htmlentities($vo['img']); ?>);"></div>
      </div>
      <div class="right">
        <h2><?php echo htmlentities($vo['title']); ?></h2>
        <div class="mate">
          <span><?php echo htmlentities(date('Y-m-d',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></span>
          <span>赞：<?php echo htmlentities($vo['like']); ?></span>
          <span>评论：<?php echo htmlentities($vo['comment_count']); ?></span>
        </div>
      </div>
  </a>
  <?php endforeach; endif; else: echo "" ;endif; ?>
  <input type="hidden" id="more_div">
  <input type="hidden" id="offect" value="8" />
  <div class="no-more" id="show_more">没有更多了</div>
</section>

</div>
<script>
  $(window).scroll(
        function() {
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(this).height();
        if (scrollTop + windowHeight == scrollHeight) {
            $("#show_more").html('数据加载中');
            $offect = $("#offect").val();
            $.post('<?php echo url("index/index/index"); ?>',{offect:$offect}, function(data){
                if(data != -1){
                    var item = eval("("+data+")");
                    var str = "";
                    for(var p in item){
                        str += '<a href="/news/'+item[p].id+'" class="art-news"><div class="left"><div class="img" style="background-image: url('+item[p].img+');"></div></div><div class="right"><h2>'+item[p].title+'</h2><div class="mate"><span>'+item[p].create_time+'</span><span>赞：'+item[p].like+'</span><span>评论：'+item[p].comment_count+'</span></div></div></a>'

                    };
                    $("#offect").val($offect*1+8);
                    $("#more_div").before(str);
                }else{
                    $("#show_more").html('没有更多数据了');
                }
            }, 'json');
        }
    });
    var swiper = new Swiper('.banner', {
            autoplay:{
                delay:3000,
                disableOnInteraction: false,
            },
        loop : true,
        slidesPerView: 'auto',
        centeredSlides: true,
    });
  var deadline =new Date(2020,1,21,0,0,0);//月份要减一
  var currentTime=new Date().getTime();
  var timeInterval=deadline.getTime()-currentTime;
  var remainTime=parseInt(timeInterval/1000);
  var day=parseInt(remainTime/(3600*24));
  function addzeros(time){
    if(time<10){
      time='0'+time;
    }
    return time;
  }
  $('#day_show').html(addzeros(day));
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