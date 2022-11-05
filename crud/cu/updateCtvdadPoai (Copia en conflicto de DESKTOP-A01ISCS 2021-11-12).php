<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

    include('prcsos/plnccion/updatepoai.php');

    $personaSistema = $_SESSION['idusuario'];

    $codigoActividad=$_REQUEST['codigoActividad'];
    $codigoSubsistema=$_REQUEST['codigo_subsistema'];
    $codigoProyecto=$_REQUEST['codigo_proyecto'];
    $codigoAccion=$_REQUEST['codigo_accion'];
    $referenciaAccion=$_REQUEST['referenciaAccion'];
    $selActividad=$_REQUEST['textActividad'];
    $vigenciaActividad=$_REQUEST['vigenciaActividad'];
    $estado=$_REQUEST['chkestado'];
    $textObjetivo = $_REQUEST['textObjetivo'];

    $objPlanAccion = new CtvdadPoai();

    $objPlanAccion->setCodigoActividad($codigoActividad);
    $objPlanAccion->setCodigoSubsistema($codigoSubsistema);
    $objPlanAccion->setCodigoProyecto($codigoProyecto);
    $objPlanAccion->setCodigoAccion($codigoAccion);
    $objPlanAccion->setReferencia($referenciaAccion);
    $objPlanAccion->setNombreActividad($selActividad);
    $objPlanAccion->setVigenciaActividad($vigenciaActividad);
    $objPlanAccion->setEstado($estado);
    $objPlanAccion->setPersonaSistema($personaSistema);
    $objPlanAccion->setObjetivo($textObjetivo);

    echo $objPlanAccion->updateActividadPoai();


?>
