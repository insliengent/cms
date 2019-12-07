$(document).ready(function(){
  new function (){
   var _self = this;
   _self.width = 750;
   _self.fontSize = 100;
   _self.widthProportion = function(){var p = (document.body&&document.body.clientWidth||document.getElementsByTagName("html")[0].offsetWidth)/_self.width;return p>1?1:p<0.32?0.32:p;};
   _self.changePage = function(){
     document.getElementsByTagName("html")[0].setAttribute("style","font-size:"+_self.widthProportion()*_self.fontSize+"px !important");
   }
   _self.changePage();
   window.addEventListener('resize',function(){_self.changePage();},false);
  };
  $('#like').click(function(ev) {
    $(this).toggleClass('i-thumbs-up').toggleClass('i-thumbs-o-up');
    var id = $(this).data('id');
    ev.stopPropagation();
    ev.preventDefault();
    $.ajax({
       url:"/news/like",
       type:'post',
       data:{id:id},
       dataType:'json',
       success:function (data) {
        /*if (data.code == 1) {
          $('#comment-submit').html(data.msg)
        }else{
          $('#comment-submit').html(data.msg)
        }*/
       }
   });
  })
  $('#love').click(function(ev) {
    var id = $(this).data('id');
    ev.stopPropagation();
    ev.preventDefault();
    $.ajax({
      url:"/news/love",
      type:'post',
      data:{id:id},
      dataType:'json',
      success:function(data){
        if (data.code == -1) {
          $('#layer').show();
        }
        if (data.code == 0) {
          $('#love').toggleClass('i-staro').toggleClass('i-star');
        }
      }
    })
  })


 $('#comment-submit').click(function (ev) {
    ev.stopPropagation();
    ev.preventDefault();
    $.ajax({
       url:"/comment/add",
       type:'post',
       data:$("#comment-form").serialize(),
       dataType:'json',
       success:function (data) {
        if (data.code == 1) {
          $('#comment-submit').html(data.msg)
        }else if(data.code == -1){
          $('#comment-submit').html(data.msg)
          $('#layer').show();
        }else if(data.code == 0){
          $('#comment-submit').html(data.msg)
        }
       }
   });
  });
 if($('#comment-form').length>0) {
   var navH = $("#comment-form").offset().top;
   $(window).on('scroll',function(){
      var scroH = $(this).scrollTop();
      if (scroH >= navH) {
        $('.post-footer').hide();
      }else{
        $('.post-footer').show();
      }
   })
  }

  $('#login').click(function (ev) {
    ev.stopPropagation();
    ev.preventDefault();
    $.ajax({
      url:"/login",
      type:"post",
      data:$('#login-form').serialize(),
      dataType:'json',
      success:function (data) {
        if (data.code == 1) {
          location.href = data.url;
        }else{
          $('#login').html(data.msg);
        }
      }
    });
    return false;
  });
  $('.comment-up').click(function(ev) {
    var n  = $(this).find('em').html();
    var num = parseInt(n)+1;
    $(this).find('em').html(num);
    var id = $(this).data('id');
    var id = $(this).data('id');
    var ob = $(this);
    ev.preventDefault();
    ev.stopPropagation();
    $.ajax({
      url:"/comment/like",
      type:"post",
      data:{id:id},
      dataType:'json',
      success:function (data) {
        if (data.code == 1) {
          $(ob).find('i').toggleClass('i-thumbs-o-up').toggleClass('i-thumbs-up');
        }
      }
    })
  })

  $("#upload-btn").on("change","input[type='file']",function(ev){
      ev.stopPropagation();
      ev.preventDefault();
      var file = document.querySelector('input[type=file]').files[0];
      var form = new FormData();
      form.append('file', file);
        $.ajax({
          url:"/user/upload",
          type:'post',
          data:form,
          processData:false,
          contentType:false,
          dataType:'json',
          success: function(data){
            console.log(data);
            $('#change-avatar').attr("src",data['src']);
          },
        })
  })

  $(".comment-li").click(function() {
    var id = $(this).data('comment-id');
    var name = $(this).find('.author-name').html();
    $("#parent").attr('value',id);
    $("#comment-form").css({'position':'fixed','bottom':'0'});
    $("#comment").attr('placeholder','回复@'+name+'');
  })

  $("#check-form label").change(function() {
    $(this).toggleClass('on');
    $(this).siblings('label').removeClass('on');
  })
  $('#submit-check').click(function(ev) {
    ev.stopPropagation();
    ev.preventDefault();
    $.ajax({
      url:"/check",
      type:'post',
      data:$('#check-form').serialize(),
      dataType:'json',
      success: function(data){
        $('#submit-check').html(data.msg);
      },
    })
  })

});//end$