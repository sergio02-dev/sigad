<?php

    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    
    include('prcsos/plndsrrllo/rgstroNvlDos.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $selNivelUno=$_REQUEST['selNivelUno'];

    $nombreNivelUno=$_REQUEST['txtNombre'];
    $txtReferenciaUno=$_REQUEST['txtReferenciaUno'];
    $actoAdministrativo=$_REQUEST['actoAdministrativo'];
    $txtObjetivo=$_REQUEST['txtObjetivo'];
    $selResponsable=$_REQUEST['selResponsable'];
    

    $referencia=$txtReferenciaUno;
      
    $registroNivelDos = new RgsrtoNvlDos();
    
    $registroNivelDos->setNombreNivelDos(strtoupper(tildes($nombreNivelUno)));
    $registroNivelDos->setActoAdminNivelDos($actoAdministrativo);
    $registroNivelDos->setReferenciaNivelDos(strtoupper(tildes($referencia)));
    $registroNivelDos->setCodigoNivelUno($selNivelUno);
    $registroNivelDos->setPersonaSistemaNivelDos($personaSistema);
    $registroNivelDos->setObjetivo($txtObjetivo);
    $registroNivelDos->setResponsable($selResponsable);

    echo $registroNivelDos->insertNivelDos();


?>