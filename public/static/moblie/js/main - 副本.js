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

  function link(id){
    $(id).click(function() {
      $(this).find('i').toggleClass('i-thumbs-up').toggleClass('i-thumbs-o-up');
    })
  }
  link("#link");
  function love(id){
    $(id).click(function() {
      $(this).find('i').toggleClass('i-staro').toggleClass('i-star');
    })
  }
  $('#love').click(function() {
      $(this).find('i').toggleClass('i-staro').toggleClass('i-star');
    })
  //love("#love");
  function commentbtn(id) {
    $(id).click(function() {
      $('.i-comment').toggleClass('on');
    })
  }
  commentbtn("#comment-btn");


});//end$