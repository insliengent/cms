<?php /*a:3:{s:55:"D:\wamp64\www\a\template\mobile\index\user\comment.html";i:1573049376;s:56:"D:\wamp64\www\a\template\mobile\index\public\header.html";i:1575098021;s:56:"D:\wamp64\www\a\template\mobile\index\public\footer.html";i:1575208392;}*/ ?>
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
  <div>
    <?php if(is_array($commentlst) || $commentlst instanceof \think\Collection || $commentlst instanceof \think\Paginator): $i = 0; $__LIST__ = $commentlst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="art-point">
      <i class="icon i-star" artid='<?php echo htmlentities($vo['id']); ?>'></i>
      <a href="<?php echo url('index/exam/art', ['id' => $vo['id']]); ?>"><?php echo htmlentities($vo['title']); ?></a>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <input type="hidden" id="more_div">
    <input type="hidden" id="offect" value="12" />
    <div class="no-more" id="show_more">没有更多了</div>
  </div>
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
            $.post('<?php echo url("index/user/exam"); ?>',{offect:$offect}, function(data){
                if(data != -1){
                    var array = eval("("+data+")");
                    var str = "";
                    for(var p in array){
                        str += '<div class="art-point"><i class="icon i-star" artid='+array[p].id+'></i><a href="<?php echo url("index/exam/art", ["id" =>'+array[p].id+']); ?>">'+array[p].title+'</a></div>';
                    }
                    $("#offect").val($offect*1+8);
                    $("#more_div").before(str);
                }else{
                    $("#show_more").html('没有更多数据了');
                }
            }, 'json');
        }
    });
$(function () {
  $('.art-point i').click(function (ev) {
    ev.stopPropagation();
    ev.preventDefault();
    $(this).parent().fadeOut();
    var id = $(this).attr('artid');
    $.ajax({
      url:"<?php echo url('index/love/click'); ?>",
      type:'post',
      data:{id:id,modename:'exam'},
      dataType:'json',
      success : function (data) {

      }
    });//endajax
  });//endclick
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