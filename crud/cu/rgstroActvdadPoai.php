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
  $objPlanAccion = new CtvdadPoai();

  $array_indicadores = array();
  
  for ($list_sedes=0; $list_sedes < count($selSedes); $list_sedes++){
    $codigo_indicador = $selSedes[$list_sedes];
    $unidad_indicador = $_REQUEST['txtUnidad'.$codigo_indicador];


    $array_indicadores[] = array(
      'codigo_indicador' => $codigo_indicador,
      'unidad_indicador' => $unidad_indicador
    );

  }

  

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

  $objPlanAccion->setArrayIndicadores($array_indicadores);

  $numeroActividad=$objPlanAccion->numeroActividades($codigoAccion, $personaSistema);

  //if($numeroActividad>=10){
    //  $valor=1;
  //}
  //else{
      echo $objPlanAccion->insertRegistroActividadPoai();
      print_r($array_indicadores);

  //}

 

?>
