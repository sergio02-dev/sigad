<?php

    include('Ccso.php');
    include('tken.php');
    include('prcsos/sstma/rgstroCcso.php');
    

   
    $user=$_REQUEST["user"];
    $paswd=$_REQUEST["pswd"];

    
    $ip=$_SERVER['REMOTE_ADDR'];
    $idregistro=date('YmdHis');


    $ingresar = new Csso();
    $ingresar->setUser($user);
    $ingresar->setPasswd($paswd);
    $ingresar->acceso();

    
 //echo $ingresar->acceso();

    $_SESSION['idusuario'] = $ingresar->getPrsona();
    $_SESSION['nomusuario'] = $ingresar->getNompersona()." ".$ingresar->getApeprsona();
    $_SESSION['nameusuario'] = $ingresar->getNompersona();
    $_SESSION['subsistema'] = $ingresar->getSubsispersona();
    $_SESSION['visibilidadBotones'] = $ingresar->getVisibilidadBotones();
    $_SESSION['perfil'] = $ingresar->getPerfil();
    $_SESSION['tokenin']=$tokenIngreso;
    $ingreso=$ingresar->getEntroAcceso();

    if($ingreso=='acceso_ok'){

        $token = new TokenLogin();
        $tokenIngreso = $token->tokeningreso();

        $registroAcceso=new ResgistrarAcceso();
        $registroAcceso->setAccIp($ip);
        $registroAcceso->setAccCodigo($idregistro);
        $registroAcceso->setAccToken($tokenIngreso);
        $registroAcceso->setAccPersona($ingresar->getPrsona());
        $registroAcceso->setAccSystem('acceso');
        $registroAcceso->insertAcceso();
    }
    else{
        $registro='noOk';
    }


    echo $ingresar->getEntroAcceso();
   //echo $ingresar->getPrsona();

?>