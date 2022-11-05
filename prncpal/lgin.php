
<?php 
$destroy=1;
session_unset();
session_destroy();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="">
    <title>SIGAD - USCO</title>

    

    <!-- Bootstrap core CSS -->
  
  
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet" >
   

    <script src='js/jquery.min.js'></script>
    <script src='bootstrap/js/bootstrap.min.js'></script>
    <script type="text/javascript" src="vjs/cambio_u.js"></script>
    <script type="text/javascript" src="vjs/cambio_c.js"></script>

    <script type="text/javascript" src="vjs/verpssword.js">

    </script>

    <!-- Custom styles for this template -->
    <link href="css/floating-labels.css" rel="stylesheet">

    <link href="css/fontawesome/css/all.min.css" rel="stylesheet"/> 
  </head>
  <body>
    <form class="form-signin" role="form" id="loginform">
      <div class="text-center mb-4">
        <img class="mb-4" src="img/logoUSCOTBG.png" alt="" >
        <h1 class="h4 mb-4 font-weight-normal"><strong>Sistema de Gestión Administración</strong></h1>
      </div>

      <div class="form-label-group form-group">
        <input type="text" id="inputUsuario" name="textUsuario" class="form-control" placeholder="Usuario" data-rule-required="true" data-msg-required="Por favor ingrese su Usuario." required autofocus>
        <label for="inputUsuario">Usuario</label>
        <span class="help-block" id="error"></span> 
      </div>
<!--
      <div class="form-label-group form-group">
        <input type="password" id="inputPassword" name="textPassword" class="form-control" placeholder="Contraseña" data-rule-required="true" data-msg-required="Por favor ingrese su Contraseña."  required>
        <label for="inputPassword">Contraseña</label>
        <span class="help-block" id="error"></span> 
        <div class="error_login" id="error_login" ></div> 
      </div>
-->

      <div class="form-label-group form-group input-group">
       
        <input type="password" id="inputPassword" name="textPassword" class="form-control" placeholder="Contraseña" data-rule-required="true" data-msg-required="Por favor ingrese su Contraseña."  required>
        <label for="inputPassword">Contraseña</label>
          <div class="input-group-append">
            <button id="show_password" class="btn btn-primary boton-primary-rojo" type="button" onclick="mostrarPassword();"> <span class="fa fa-eye-slash icon"></span> </button>
          </div>
         
        
        
        <span class="help-block" id="error"></span> 
        <div class="error_login" id="error_login" ></div> 
      </div>

      
      <button class="btn btn-success btn-lg btn-danger btn-block" type="submit" onClick="validar_asopano();" ><strong>Entrar</strong></button>

      <p class="mt-5 mb-3 text-muted text-center">&copy;SIGAD-USCO V2.0</p>
  </form>
</body>
</html>
<script src="js/jquery.validate.min.js"></script>
<script src="vjs/envio_login.js"></script>