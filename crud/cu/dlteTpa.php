<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

    include('prcsos/plnccion/dltTpa.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $codigo_etapa=$_REQUEST['codigo_etapa'];

    $deleteEtapa = new DltTpa();
    $deleteEtapa->setCodigoActividad($codigo_etapa);
    $deleteEtapa->setPersonaSistema($personaSistema);

    echo $deleteEtapa->deleteEtapa();


?>