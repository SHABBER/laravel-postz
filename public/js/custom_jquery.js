// const { method } = require("lodash");

$(document).ready(function(){
    $('#file').change(displayimg);
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
});

function displayimg(e){
    $('#update_image').attr('src',URL.createObjectURL(e.target.files[0]));
}

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$('#live-post-search').keyup(function(){

    var key = $(this).val();
    // alert(key);
    if(key!=''){
        
        // $.ajaxSetup({
        //     headers: {
        //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        //   });

        $.ajax({
            url: '/search/post' ,
            method: 'POST',
            data: {key: key} ,
            dataType:'JSON', 
            async : true,
            success: function(data){
                $('#search-result').html(data['msg']);
                // alert(JSON.parse(data));
                // alert(data['msg']);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown); 
            } 
        });

    }else
    $('#search-result').html('');

});


function approvecomment(event, id){
   
    $.ajax({
        url: '/comment/ajaxupdate' ,
        method: 'PATCH',
        data: {id: id} ,
        // dataType:'JSON', 
        async : true,
        success: function(data){
            // $('#search-result').html(data['msg']);
            // alert(data['act']);
            event.target.innerText = data['act'];
            // alert(data['msg']);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); 
            alert("Error: " + errorThrown); 
        } 
    });

   }



   
   function approvecommentreply(event, id){
   
    $.ajax({
        url: '/comment/reply/ajaxupdate' ,
        method: 'PATCH',
        data: {id: id} ,
        // dataType:'JSON', 
        async : true,
        success: function(data){
            // $('#search-result').html(data['msg']);
            // alert(data['act']);
            event.target.innerText = data['act'];
            // alert(data['msg']);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); 
            alert("Error: " + errorThrown); 
        } 
    });

   }



   function showReplies(replyid){
    $('#'+replyid).slideToggle('slow');
  }


  // HOVER DIV SHOW
  function hoverdiv(e,divid,id){

        var left  = e.clientX  + "px";
        var top  = e.clientY  + "px";

        var div = document.getElementById(divid);

        div.style.left = left;
        div.style.top = top;

        // ajax code

        $.ajax({
            url: '/user/profile/preview/'+id,
            method: 'GET',
            // data: {id:id},
            success: function(data){
                // alert(data['name']+data['email']);
                $('#divtoshow>#profilepreview>.card-body>h5').text(data['name']);
                $('#divtoshow>#profilepreview>.card-body>h6').text(data['username']);
                $('#divtoshow>#profilepreview>.card-body>p').text(data['email']);
                $('#divtoshow>#profilepreview>div>img').attr('src',data['avatar']);



            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                // alert(errorThrown);
            }

        });


        $("#"+divid).toggle();
        return false;
  }

function showHideRow(row) {
    $("#" + row).slideToggle('fast');
}

