$('.submenu').click(function(){
    $(this).children('.children').slideToggle();
});
$('.children').click(function(p){
    p.stopPropagation();
});

$(function(){

  $(document).on('keyup','#n_pass, #r_pass',function(){
    var n_pass = $('#n_pass').val().trim();
    var r_pass = $('#r_pass').val().trim();
    if( !n_pass || !r_pass || n_pass == '' || r_pass == '' ){
      $('#poo').removeClass('text-success').addClass('text-danger').text('Las contraseñas no coinciden');
    }
    
    else{
      if( n_pass !== r_pass ){
        $('#poo').removeClass('text-success').addClass('text-danger').text('Las contraseñas no coinciden');
      }
      
      else{
      $('#poo').removeClass('text-danger').addClass('text-success').text('Las contraseñas si coinciden');
      }
    }
  });
});
$(document).ready(function(){
    $("#show").mousedown(function(){
        $('#pass').attr('type','text');
         $('#show').addClass('fa-eye-slash').removeClass('fa-eye');
    });
    $("#shown").mousedown(function(){
        $('#n_pass').attr('type','text');
        $('#shown').addClass('fa-eye-slash').removeClass('fa-eye');
        
    });
    $("#showr").mousedown(function(){
        $('#r_pass').attr('type','text');
        $('#showr').addClass('fa-eye-slash').removeClass('fa-eye');
        
    });

    $("#show").mouseup(function(){
        $('#pass').attr('type','password'); 
        $('#show').addClass('fa-eye').removeClass('fa-eye-slash');
    });
    $("#shown").mouseup(function(){ 
        $('#n_pass').attr('type','password'); 
        $('#shown').addClass('fa-eye').removeClass('fa-eye-slash');
    });
    $("#showr").mouseup(function(){ 
        $('#r_pass').attr('type','password');
        $('#showr').addClass('fa-eye').removeClass('fa-eye-slash');
    });

   $("input[type='text']").on('paste', function(e){
    e.preventDefault();
    alert('Esta acción está prohibida');
  })
  
  $("input[type='text']").on('copy', function(e){
    e.preventDefault();
    alert('Esta acción está prohibida');
  })
 
});
