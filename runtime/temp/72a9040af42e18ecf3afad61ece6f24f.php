<?php /*a:2:{s:51:"D:\wamp64\www\a\template\mobile\index\exam\art.html";i:1574822118;s:56:"D:\wamp64\www\a\template\mobile\index\public\header.html";i:1575098021;}*/ ?>
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

<div class="container pd15 examh">
  <form>
  <div class="post-head">
    <h1><?php echo htmlentities($examInfo['title']); ?> 练习题</h1>
    <p><?php echo htmlentities($examInfo['question']); ?></p>
   </div>
  <div class="post-body">
    <?php if(is_array($artBody) || $artBody instanceof \think\Collection || $artBody instanceof \think\Paginator): $i = 0; $__LIST__ = $artBody;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
    <div class="post-option post-box">
      <div class="l <?php echo htmlentities($optState); ?>" v="<?php echo htmlentities($v['opt']); ?>" my="0"><?php echo htmlentities($v['abc']); ?></div>
      <div class="r"><?php echo htmlentities($v['answer']); ?></div>
       </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <button type="submit" class="btn" id="submit">提交</button>
  </div>
<div class="post-Analysis post-box">
        正确答案：<?php if(is_array($artBody) || $artBody instanceof \think\Collection || $artBody instanceof \think\Paginator): $i = 0; $__LIST__ = $artBody;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['opt'] == '1'): ?><?php echo htmlentities($vo['abc']); ?><?php endif; ?><if><?php endforeach; endif; else: echo "" ;endif; ?><br>
        答案解析：<br>
      <?php echo htmlentities($examInfo['analysis']); ?></div>
  </form>
  <footer class="page-footer">
    <div class="nextprv">
     <?php if(($next)!=null): ?>
    <a  href="<?php echo url('index/exam/art', ['id' => $next['id']]); ?>" title="<?php echo htmlentities($next['title']); ?>">上一题</a>
    <?php endif; if(($prv)!=null): ?>
    <a  href="<?php echo url('index/exam/art', ['id' => $prv['id']]); ?>" title="<?php echo htmlentities($prv['title']); ?>">下一题</a>
    <?php endif; ?>
    </div>
  </footer>
</div>

<script>
 $(function () {
  $('.post-option').click(function(ev){
    $(this).children('.l').toggleClass("on");
    $my_v =$(this).children('.l').attr('my');
    $my_v = $my_v==0 ? 1 : 0;
    $(this).children('.l').attr('my',$my_v);

  });

  $('#submit').click(function(ev){
    $('.post-Analysis').toggleClass("on");
  });

   $('#submit').click(function (ev) {
    ev.stopPropagation();
    ev.preventDefault();
    var myarr = new Array();
    $.each($('.post-option'), function(){
      myarr.push($(this).find(".l").attr("my"));
    });
    myarr = myarr.join(",")
    var varr = new Array();
    $.each($('.post-option'), function(){
      varr.push($(this).find(".l").attr("v"));
    });
    varr = varr.join(",");
    var count=1;
    if (myarr != varr ) {
      $.ajax({
       url:"<?php echo url('index/exam/count'); ?>",
       type:'post',
       data:{count:count,id:<?php echo htmlentities($examInfo['id']); ?>},
       dataType:'json',
      });
    };

   });
});
</script>
<footer class="foot">

</footer>
</body>
</html>