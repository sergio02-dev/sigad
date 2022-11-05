<?php

    //error_reporting(E_ALL);
    //ini_set('display_errors', '1');

    include('prcsos/crtfcdos/dlteCrtfcdo.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $codigo_actividad=$_REQUEST['codigo_actividad'];

    
    $deleteCertificado = new DlteCrtfcdo();
    $deleteCertificado->setcodigoActividad($codigo_actividad);

    echo $deleteCertificado->deleteCertificado();


?>