<?php

    include('prcsos/plnccion/insrtActvdadPoai.php');

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
    $selSedes = $_REQUEST['selSedes'];
    $txtUnidad = $_REQUEST['txtUnidad'];

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
    $objPlanAccion->setSede($selSedes);
    $objPlanAccion->setUnidad($txtUnidad);

    $numeroActividad=$objPlanAccion->numeroActividades($codigoAccion, $personaSistema);

    //if($numeroActividad>=10){
      //  $valor=1;
    //}
    //else{
        echo $objPlanAccion->insertRegistroActividadPoai();
        $valor=0;
    //}

    echo $valor;

?>
