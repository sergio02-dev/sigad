<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

    include('prcsos/plnccion/dltCtvdadCcion.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $codigo_poai=$_REQUEST['codigo_poai'];

    
    $deleteActividadAccion = new DltCtvdadCcion();
    $deleteActividadAccion->setCodigoActividad($codigo_poai);
    $deleteActividadAccion->setPersonaSistema($personaSistema);

    echo $deleteActividadAccion->deleteActividadAccion();


?>