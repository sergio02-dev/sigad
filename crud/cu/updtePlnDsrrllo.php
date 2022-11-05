<?php
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í;", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('prcsos/plndsrrllo/updtePlnDsrrllo.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $nombrePlanDesarrollo=$_REQUEST['txtNombre'];
    $yearInicioPlanDesarrollo=$_REQUEST['selYearInicio'];
    $yearFinPlanDesarrollo=$_REQUEST['selYearFin'];
    $actoAdminPlanDesarrollo=$_REQUEST['selActoAdmin'];
    $codigoPlanDesarrollo=$_REQUEST['codigoPlanDesarrollo'];
    $txtNivelUno=$_REQUEST['txtNivelUno'];
    $txtNivelDos=$_REQUEST['txtNivelDos'];
    $txtNivelTres=$_REQUEST['txtNivelTres'];
    $txtReferenciaNivelUno=$_REQUEST['txtReferenciaNivelUno'];
    $txtReferenciaNivelDos=$_REQUEST['txtReferenciaNivelDos'];
    $selResponsable=$_REQUEST['selResponsable'];
    
      
    $updatePlanDesarrollo = new UpdtePlnDsrrllo();
    
    $updatePlanDesarrollo->setNombrePlanDesarrollo(strtoupper(tildes($nombrePlanDesarrollo)));
    $updatePlanDesarrollo->setYearIncioPlanDesarrollo($yearInicioPlanDesarrollo);
    $updatePlanDesarrollo->setYearFinPlanDesarrollo($yearFinPlanDesarrollo);
    $updatePlanDesarrollo->setActoAdminPlanDesarrollo($actoAdminPlanDesarrollo);
    $updatePlanDesarrollo->setPersonaSistemaPlanDesarrollo($personaSistema);
    $updatePlanDesarrollo->setCodigoPlanDesarrollo($codigoPlanDesarrollo);
    $updatePlanDesarrollo->setNivelUnoPlanDesarrollo($txtNivelUno);
    $updatePlanDesarrollo->setReferenciaNivelUnoPlanDesarrollo($txtReferenciaNivelUno);
    $updatePlanDesarrollo->setReferenciaNivelDosPlanDesarrollo($txtReferenciaNivelDos);
    $updatePlanDesarrollo->setNivelDosPlanDesarrollo($txtNivelDos);
    $updatePlanDesarrollo->setNivelTresPlanDesarrollo($txtNivelTres);
    $updatePlanDesarrollo->setResponsablePlanDesarrollo($selResponsable);

    echo $updatePlanDesarrollo->updatePlanDesarrollo();


?>