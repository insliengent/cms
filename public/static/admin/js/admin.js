$(function () {
  $("#upload-btn").on("change","#file",function(ev){
    ev.stopPropagation();
    ev.preventDefault();
    var formdata = new FormData();
    formdata.append("file",document.getElementById('file').files[0]);
      $.ajax({
        url:"/admin/upload",
        type:'post',
        data:formdata,
        processData:false,
        contentType:false,
        dataType:'json',
        success: function(data){
          $('#uploadurl').attr("value",data['src']);
          $('#imgview').attr("src",data['src']);
        },
      })
  })
})