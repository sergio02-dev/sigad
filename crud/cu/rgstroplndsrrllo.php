<?php

    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('prcsos/plndsrrllo/rgstroPlnDsrrllo.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $nombrePlanDesarrollo=$_REQUEST['txtNombre'];
    $yearInicioPlanDesarrollo=$_REQUEST['selYearInicio'];
    $yearFinPlanDesarrollo=$_REQUEST['selYearFin'];
    $actoAdminPlanDesarrollo=$_REQUEST['selActoAdmin'];
    $txtNivelUno=$_REQUEST['txtNivelUno'];
    $txtNivelDos=$_REQUEST['txtNivelDos'];
    $txtNivelTres=$_REQUEST['txtNivelTres'];
    $txtReferenciaNivelUno=$_REQUEST['txtReferenciaNivelUno'];
    $txtReferenciaNivelDos=$_REQUEST['txtReferenciaNivelDos'];
    $selResponsable=$_REQUEST['selResponsable'];
    
      
    $registroPlanDesarrollo = new RgsrtoPlnDsrrllo();
    
    $registroPlanDesarrollo->setNombrePlanDesarrollo(strtoupper(tildes($nombrePlanDesarrollo)));
    $registroPlanDesarrollo->setYearIncioPlanDesarrollo($yearInicioPlanDesarrollo);
    $registroPlanDesarrollo->setYearFinPlanDesarrollo($yearFinPlanDesarrollo);
    $registroPlanDesarrollo->setActoAdminPlanDesarrollo($actoAdminPlanDesarrollo);
    $registroPlanDesarrollo->setPersonaSistemaPlanDesarrollo($personaSistema);
    $registroPlanDesarrollo->setNivelUnoPlanDesarrollo($txtNivelUno);
    $registroPlanDesarrollo->setReferenciaNivelUnoPlanDesarrollo($txtReferenciaNivelUno);
    $registroPlanDesarrollo->setReferenciaNivelDosPlanDesarrollo($txtReferenciaNivelDos);
    $registroPlanDesarrollo->setNivelDosPlanDesarrollo($txtNivelDos);
    $registroPlanDesarrollo->setNivelTresPlanDesarrollo($txtNivelTres);
    $registroPlanDesarrollo->setResponsablePlanDesarrollo($selResponsable);

    echo $registroPlanDesarrollo->insertPlanDesarrollo();


?>