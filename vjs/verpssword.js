function mostrarPassword(){
        
    var cambio = $('#inputPassword').attr('type');
    if(cambio == "password"){
      //alert("passwd")
      $('#inputPassword').attr('type', 'text');
      $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
      $('#inputPassword').attr('type', 'password');
      $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
  } 