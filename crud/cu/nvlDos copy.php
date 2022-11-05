<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

    include('prcsos/plndsrrllo/rgstroNvlDos.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $selNivelUno=$_REQUEST['selNivelUno'];

    $nombreNivelUno=$_REQUEST['txtNombre'];
    $txtReferenciaUno=$_REQUEST['txtReferenciaUno'];
    $actoAdministrativo=$_REQUEST['actoAdministrativo'];
   
    $referencia=$txtReferenciaUno;
      
    $registroNivelDos = new RgsrtoNvlDos();
    
    $registroNivelDos->setNombreNivelDos($nombreNivelUno);
    $registroNivelDos->setActoAdminNivelDos($actoAdministrativo);
    $registroNivelDos->setReferenciaNivelDos($referencia);
    $registroNivelDos->setCodigoNivelUno($selNivelUno);
    $registroNivelDos->setPersonaSistemaNivelDos($personaSistema);

    echo $registroNivelDos->insertNivelDos();


?>