<?php /*a:4:{s:52:"D:\wamp64\www\a\application\admin\view\user\lst.html";i:1575196171;s:56:"D:\wamp64\www\a\application\admin\view\public\_head.html";i:1573053339;s:56:"D:\wamp64\www\a\application\admin\view\public\_left.html";i:1573144658;s:56:"D:\wamp64\www\a\application\admin\view\public\_foot.html";i:1574854748;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理面板</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/static/admin/style/admin.css">
    <link rel="stylesheet" href="https://at.alicdn.com/t/font_1167221_01xdpb1niv8v.css">
    <script src="/static/admin/js/jquery.min.js"></script>
    <script src="/static/admin/js/admin.js"></script>
</head>
<body>
<header class="header">
  <div class="container">
   <a class="logo" href="<?php echo url('admin/home/index'); ?>"><img  src="/static/admin/img/logow.png" alt=""></a>
   <div class="fr-nav">
     <ul>
       <li><a href="javascript:;" id="loginout">退出</a></li>
     </ul>
   </div>
  </div>
</header>
<div class="wrapper">
<aside class="sidebar clearfix" id="aside">
  <ul class="sidebar-nav clearfix">
    <li><a href="<?php echo url('admin/home/index'); ?>"><i class="icon i-dashboard"></i>仪表盘</a></li>
    <li class="<?php if(app('request')->controller() == 'Slider'): ?>on<?php endif; ?>">
      <a href="javascript:;"><i class="icon i-banner"></i> 幻灯片</a>
      <ul class="sub-menu">
        <li><a href="<?php echo url('admin/slider/lst'); ?>">列表</a></li>
        <li><a href="<?php echo url('admin/slider/add'); ?>">添加</a></li>
      </ul>
    </li>
    <li class="<?php if(app('request')->controller() == 'News'): ?>on<?php endif; if(app('request')->controller() == 'Newscate'): ?>on<?php endif; ?>">
      <a href="javascript:;"><i class="icon i-news"></i>新闻</a>
      <ul class="sub-menu">
        <li><a href="<?php echo url('admin/news/lst'); ?>">所有</a></li>
        <li><a href="<?php echo url('admin/news/add'); ?>">添加</a></li>
        <li><a href="<?php echo url('admin/newscate/lst'); ?>">分类</a></li>
      </ul>
    </li>

    <li class="<?php if(app('request')->controller() == 'Exam'): ?>on<?php endif; ?>">
      <a href="javascript:;"><i class="icon i-codepen"></i>题库</a>
      <ul class="sub-menu">
        <li><a href="<?php echo url('admin/exam/lst'); ?>">所有试题</a></li>
        <li><a href="<?php echo url('admin/exam/add'); ?>">添加试题</a></li>
        <li><a href="<?php echo url('admin/exam/import'); ?>">表格导入</a></li>
      </ul>
    </li>
    <li class="<?php if(app('request')->controller() == 'Point'): ?>on<?php endif; ?>">
      <a href="javascript:;"><i class="icon i-ziliao"></i>知识点</a>
      <ul class="sub-menu">
        <li><a href="<?php echo url('admin/point/lst'); ?>">知识点列表</a></li>
        <li><a href="<?php echo url('admin/point/add'); ?>">添加知识点</a></li>
      </ul>
    </li>
    <li class="<?php if(app('request')->controller() == 'Video'): ?>on<?php endif; ?>">
      <a href="javascript:;"><i class="icon i-video"></i>视频</a>
      <ul class="sub-menu">
        <li><a href="<?php echo url('admin/video/lst'); ?>">所有视频</a></li>
        <li><a href="<?php echo url('admin/video/add'); ?>">添加</a></li>
      </ul>
    </li>

    <li class="<?php if(app('request')->controller() == 'Tax'): ?>on<?php endif; ?>">
      <a href="javascript:;"><i class="icon i-region"></i>税务局</a>
      <ul class="sub-menu">
        <li><a href="<?php echo url('admin/tax/lst'); ?>">列表</a></li>
        <li><a href="<?php echo url('admin/tax/add'); ?>">添加</a></li>
        <li><a href="<?php echo url('admin/taxcate/lst'); ?>">分类库</a></li>
      </ul>
    </li>
    <li class="<?php if(app('request')->controller() == 'Book'): ?>on<?php endif; ?>">
      <a href="javascript:;"><i class="icon i-ziliao1"></i>科目</a>
      <ul class="sub-menu">
        <li><a href="<?php echo url('admin/book/lst'); ?>">科目列表</a></li>
        <li><a href="<?php echo url('admin/book/chapteradd'); ?>">添加章节</a></li>
      </ul>
    </li>
    <li class="<?php if(app('request')->controller() == 'Down'): ?>on<?php endif; if(app('request')->controller() == 'Downcate'): ?>on<?php endif; ?>">
      <a href="javascript:;"><i class="icon i-down"></i>资料下载</a>
      <ul class="sub-menu">
        <li><a href="<?php echo url('admin/down/lst'); ?>">所有</a></li>
        <li><a href="<?php echo url('admin/downcate/lst'); ?>">分类</a></li>
        <li><a href="<?php echo url('admin/down/add'); ?>">添加</a></li>
      </ul>
    </li>
    <li class="<?php if(app('request')->controller() == 'Guide'): ?>on<?php endif; ?>">
      <a href="javascript:;"><i class="icon i-zuzhijiagou"></i>报考指南</a>
      <ul class="sub-menu">
        <li><a href="<?php echo url('admin/guide/lst'); ?>">所有</a></li>
        <li><a href="<?php echo url('admin/guide/add'); ?>">添加</a></li>
      </ul>
    </li>

    <li>
      <a href="<?php echo url('admin/comment/lst'); ?>"><i class="icon i-comment"></i>评论列表</a>
    </li>

    <li class="<?php if(app('request')->controller() == 'User'): ?>on<?php endif; ?>">
      <a href="javascript:;"><i class="icon i-banner"></i>用户管理</a>
      <ul class="sub-menu">
        <li><a href="<?php echo url('admin/user/lst'); ?>">用户列表</a></li>
        <li><a href="<?php echo url('admin/score/score'); ?>">积分管理</a></li>
      </ul>
    </li>
    <li><a href="<?php echo url('admin/system/webset'); ?>">系统设置</a></li>
  </ul>
</aside>
<main class="main">
  <div class="breadcrumbs">用户管理</div>
  <div class="page-body">
    <div class="widget">
      <header class="head clearfix">
        <a href="<?php echo url('admin/news/add'); ?>" class="btn fl">添加新闻</a>
        <form class="serachform" id="serach" action="<?php echo url('admin/news/search'); ?>" method="post">
          <input type="text" placeholder="请输入标题" id="s" name="s">
          <button type="submit" id="serach-submit">搜索</button>
      </form>
      </header>
       <div class="body">
         <table class="table ">
          <thead>
             <tr>
               <th>ID</th>
               <th>用户名</th>
               <th>学历</th>
               <th>专业</th>
               <th>手机</th>
               <th>关注的科目</th>
               <th>错题</th>
               <th>注册时间</th>
               <th>上次登录时间</th>
             </tr>
          </thead>
           <tbody>
          <?php if(is_array($userlst) || $userlst instanceof \think\Collection || $userlst instanceof \think\Paginator): $i = 0; $__LIST__ = $userlst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <tr>
            <td><?php echo htmlentities($vo['id']); ?></td>
            <td><?php echo htmlentities($vo['username']); ?></td>
            <td><?php echo htmlentities($vo['education']); ?></td>
            <td><?php echo htmlentities($vo['major']); ?></td>
            <td><?php echo htmlentities($vo['phone']); ?></td>
            <td><?php echo htmlentities($vo['follow_book']); ?></td>
            <td><?php echo htmlentities($vo['username']); ?></td>
            <td><?php echo htmlentities(date("Y-m-d",!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></td>
            <td><?php echo htmlentities(date("Y-m-d",!is_numeric($vo['lastlogin_time'])? strtotime($vo['lastlogin_time']) : $vo['lastlogin_time'])); ?></td>
          </tr>
           <?php endforeach; endif; else: echo "" ;endif; ?>
           </tbody>
         </table>
         <?php echo $userlst; ?>
       </div>
    </div>
    </div>
  </div>
</main>

</div>
<footer>
<script>
<?php
$currController = Request::controller();
$currAction     = Request::action();
$currModule     = Request::module();
?>
$(function () {
  $('.sidebar-nav li').click(function() {
    if($(this).hasClass('on')) {
       $(this).removeClass('on');
       $(this).sli('on');
      }else{
        $(this).addClass('on');
      }
  });

  //loginout
 $('#loginout').click(function (ev) {
    ev.stopPropagation();
    ev.preventDefault();
    $(this).parent().parent().remove();
    var id = $(this).val();
    $.ajax({
       url:"<?php echo url('admin/index/loginout'); ?>",
       type:'post',
       data:{id:id},
       dataType:'json',
       success:function (data) {
           if (data.code == 1) {
             location.href = data.url;
           }
       }
   });
  });//end loginout

  $('#btn').click(function (ev) {
    ev.stopPropagation();
    ev.preventDefault();
    $.ajax({
      url:"<?php echo url($currModule.'/'.$currController.'/'.$currAction); ?>",
      type:'post',
      data:$('form').serialize(),
      dataType:'json',
      success : function (data) {
         if (data.code == 0) {
            $('#btn').html(data.msg);
            setTimeout(function() {
               $('#btn').html('添加');
             },1000);
          }else {
            $('#btn').html(data.msg);
          }
      },
    });
  });

});
</script>
</footer>
</body>
</html>
