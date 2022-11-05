<?php

error_reporting(0);
    
    include('prcsos/ctvdad/rsRgstroCtvdad.php');
    $personaSistema = $_SESSION['idusuario'];
    $objRsRegistroActividad = new RsRgstroCtvdad();

    $objRsRegistroActividad->setCodigoActividad($codigo_actividad);
    $objRsRegistroActividad->setPersonaSistema($personaSistema);

    $rs_RegistroActividad=$objRsRegistroActividad->sqlRsRegistroActividades(); 
    $re_vigencia=$objRsRegistroActividad->RsVigencia();
    //echo $rs_RegistroActividad;

 

?>