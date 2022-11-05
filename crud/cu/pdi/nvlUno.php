<?php

    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    include('prcsos/plndsrrllo/rgstroNvlUno.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $nombreNivelUno=$_REQUEST['txtNombre'];
    $txtReferenciaUno=$_REQUEST['txtReferenciaUno'];
    $txtReferenciaCompleta=$_REQUEST['txtReferenciaCompleta'];
    $planDesarrolloNivelUno=$_REQUEST['codigoPlanDesarrollo'];
    $actoAdministrativo=$_REQUEST['actoAdministrativo'];
    $selResponsable=$_REQUEST['selResponsable'];
    $selOficina = $_REQUEST['selOficina'];
    $selCargo = $_REQUEST['selCargo'];
    $tipo_responsable = $_REQUEST['tipo_responsable'];
    
      
    $registroNivelUno = new RgsrtoNvlUno();
    
    $registroNivelUno->setNombreNivelUno(strtoupper(tildes($nombreNivelUno)));
    $registroNivelUno->setActoAdminNivelUno($actoAdministrativo);
    $registroNivelUno->setPlanDesarrolloNivelUno($planDesarrolloNivelUno);
    $registroNivelUno->setReferenciaNivelUno($txtReferenciaUno);
    $registroNivelUno->setRef($txtReferenciaCompleta);
    $registroNivelUno->setPersonaSistemaNivelUno($personaSistema);
    $registroNivelUno->setResponsable($selResponsable);
    $registroNivelUno->setOficina($selOficina);
    $registroNivelUno->setCargo($selCargo);
    $registroNivelUno->setTipoResponsable($tipo_responsable);

    echo $registroNivelUno->insertNivelUno();


?>