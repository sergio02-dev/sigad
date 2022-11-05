<?php

    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('prcsos/plndsrrllo/updteNvlDos.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $selNivelUno=$_REQUEST['selNivelUno'];
    $nombreNivelUno=$_REQUEST['txtNombre'];
    $txtReferenciaUno=$_REQUEST['txtReferenciaUno'];
    $txtReferenciaCompleta=$_REQUEST['txtReferenciaCompleta'];
    $codigoNivelDos=$_REQUEST['codigoNivelDos'];
    $txtObjetivo=$_REQUEST['txtObjetivo'];
    $selResponsable=$_REQUEST['selResponsable'];

   
    $referencia=$txtReferenciaUno;

      
    $updateNivelDos = new UpdteNvlDos();
    
    $updateNivelDos->setNombreNivelDos(strtoupper(tildes($nombreNivelUno)));
    $updateNivelDos->setReferenciaNivelDos(strtoupper(tildes($referencia)));
    $updateNivelDos->setCodigoNivelUno($selNivelUno);
    $updateNivelDos->setPersonaSistemaNivelDos($personaSistema);
    $updateNivelDos->setNumeroNivelDos($txtReferenciaCompleta);
    $updateNivelDos->setCodigoNivelDos($codigoNivelDos);
    $updateNivelDos->setObjetivo($txtObjetivo);
    $updateNivelDos->setResponsable($selResponsable);

    echo $updateNivelDos->updateNivelDos();


?>