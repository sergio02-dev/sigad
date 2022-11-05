<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

  include('prcsos/plnccion/insrtplnccion.php');

  $personaSistema = $_SESSION['idusuario'];

  $codigoActividad=$_REQUEST['codigoActividad'];
  $referenciaActividad=$_REQUEST['referenciaActividad'];
  $objetoAccion=$_REQUEST['objetoAccion'];
  $recursoAccion=$_REQUEST['recursoAccion'];
  $logroAccion=$_REQUEST['logroAccion'];
  $logroEjecutado= str_replace(',','.',$_REQUEST['logroEjecutado']);
  $vigenciaActividad=$_REQUEST['vigenciaActividad'];
  $estado=$_REQUEST['chkestado'];
  $txtDescripcionClasificador = $_REQUEST['txtDescripcionClasificador'];
  $codigoClasificador = $_REQUEST['codigoClasificador'];
  $txtDane=$_REQUEST['txtDane'];
  $checkedPlanCompras = $_REQUEST['checkedPlanCompras'];

  if($checkedPlanCompras){
    $planCompras = $checkedPlanCompras;
  }
  else{
    $planCompras = 0;
  }

  if($recursoAccion == 0){
    $clasfcador = 0;
  }
  else{
    $clasfcador = $codigoClasificador;
  }

  $objPlanAccion = new PlnAccon();

  $objPlanAccion->setCodigoActividad($codigoActividad);
  $objPlanAccion->setReferencia($referenciaActividad);
  $objPlanAccion->setObjeto($objetoAccion);
  $objPlanAccion->setRecurso($recursoAccion);
  $objPlanAccion->setLogro($logroAccion);
  $objPlanAccion->setLogroEjecutado($logroEjecutado);
  $objPlanAccion->setVigenciaActividad($vigenciaActividad);
  $objPlanAccion->setEstado($estado);
  $objPlanAccion->setPersonaSistema($personaSistema);
  $objPlanAccion->setCodigoClasificador($clasfcador);
  $objPlanAccion->setDescripcionClasificador($txtDescripcionClasificador);
  $objPlanAccion->setDane($txtDane);
  $objPlanAccion->setPlanCompras($planCompras);


  $numeroEtapas=$objPlanAccion->numeroEtapas();

  /*if($numeroEtapas>=10){
      $valoretapas=1;
  }
  else{*/
  $valoretapas=0;
  
  $suma=$objPlanAccion->suma();

  $sumaMod=$suma-$avacanceActividad;
  $valorTotal=$sumaMod+$logroAccion;

  if($valorTotal>100 ){
    $valortotal=1;
  }
  else{
    echo $objPlanAccion->insertPlanAccion();
    $valortotal=0;
  }

//}

  echo $valoretapas.'-'.$valortotal;
?>
