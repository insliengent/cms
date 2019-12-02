<?php /*a:5:{s:52:"D:\wamp64\www\a\application\admin\view\exam\add.html";i:1573144045;s:56:"D:\wamp64\www\a\application\admin\view\public\_head.html";i:1573053339;s:56:"D:\wamp64\www\a\application\admin\view\public\_left.html";i:1573144658;s:59:"D:\wamp64\www\a\application\admin\view\public\_navtree.html";i:1573049068;s:56:"D:\wamp64\www\a\application\admin\view\public\_foot.html";i:1574854748;}*/ ?>
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
  <div class="breadcrumbs">添加试题</div>
  <div class="page-body">
    <form class="form-warp">
      <div class="form-control">
        <label for="title">标题</label>
        <input type="text" name="title" id="title">
      </div>
      <div class="form-control">
        <label>选择章节（必须）</label>
        <link rel="stylesheet" href="/static/admin/style/select2.min.css">
<script src="/static/admin/js/select2.min.js"></script>
<div class="select-box">
  <select class="booklst js-example-responsive" name="book_id" id="book_id" style="width: 100%">
    <option></option>
    <?php if(is_array($booktree) || $booktree instanceof \think\Collection || $booktree instanceof \think\Paginator): $i = 0; $__LIST__ = $booktree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <option value="<?php echo htmlentities($vo['id']); ?>"><?php if($vo['level'] != 0): ?>&nbsp;&nbsp;|<?php endif; ?><?php echo str_repeat('-',$vo['level'] * 2) ?><?php echo htmlentities($vo['title']); ?></option>
    <?php endforeach; endif; else: echo "" ;endif; ?>
  </select>
</div>
<script>
  $('.booklst').select2({
    placeholder: "选择分类",
    width: 'resolve'
  });
</script>
      </div>
      <div class="form-control">
        <label for="question">问题</label>
        <textarea type="text" name="question" id="question"></textarea>
      </div>
      <div class="form-control">
        <label>选项</label>
          <div class="option-box clearfix">
            <div class="input-group">
              <input class="checkbox" type="checkbox" value="A" name="check[]">
              <textarea type="text" name="answer[]"></textarea>
            </div>
            <div class="input-group">
              <input class="checkbox" type="checkbox" value="B" name="check[]">
              <textarea type="text" name="answer[]"></textarea>
            </div>
            <div class="input-group">
              <input class="checkbox" type="checkbox" value="C" name="check[]">
              <textarea type="text" name="answer[]"></textarea>
            </div>
            <div class="input-group">
              <input class="checkbox" type="checkbox" value="D" name="check[]">
              <textarea type="text" name="answer[]"></textarea>
            </div>
            <div class="input-group">
              <input class="checkbox" type="checkbox" value="E" name="check[]">
              <textarea type="text" name="answer[]"></textarea>
            </div>
            <div class="input-group">
              <input class="checkbox" type="checkbox" value="F" name="check[]">
              <textarea type="text" name="answer[]"></textarea>
            </div>
          </div>
        </div>
        <div class="form-control">
          <span class="btn" id="add-options">添加选项</span>
          <span class="btn" id="del-options">删除选项</span>
        </div>
        <div class="form-control">
          <label>答案解析</label>
          <textarea type="text" name="analysis" id="analysis"></textarea>
        </div>
        <div class="form-control">
          <button type="submit" class="btn btn-primary" id="btn">添加</button>
        </div>
    </form>
  </div>
</main>
<script>
$(function(){
var input_group = '<div class="input-group"><input class="checkbox" type="checkbox" value="1" name="check[]"><textarea type="text" name="answer[]"></textarea></div>';

$("#add-options").on('click', function() {
    $(".option-box").append(input_group);
   });
$("#del-options").on('click', function() {
    $(".option-box").children().eq(-1).remove();
   });


});
</script>
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
