<?php
    include('prcsos/plnccion/updateEtapas.php');

    $personaSistema = $_SESSION['idusuario'];

    $codigo_poai=$_REQUEST['codigo_poai'];
    $codigoActividad=$_REQUEST['codigoActividad'];
    $referenciaActividad=$_REQUEST['referenciaActividad'];
    $objetoAccion=$_REQUEST['objetoAccion'];
    $recursoAccion=$_REQUEST['recursoAccion'];
    $logroAccion=$_REQUEST['logroAccion'];
    $logroEjecutado= str_replace(',','.',$_REQUEST['logroEjecutado']);
    $vigenciaActividad=$_REQUEST['vigenciaActividad'];
    $estado=$_REQUEST['chkestado'];
    $avacanceActividad=$_REQUEST['avacanceActividad'];
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

    $objPlanAccion->setCodigoPoai($codigo_poai);
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
    
    $suma=$objPlanAccion->suma();

    $sumaMod=$suma-$avacanceActividad;
    $valorTotal=$sumaMod+$logroAccion;

    $sumaAsignacion = $objPlanAccion->sumaAsignacion();
    
    
    $numero=3;
    if($valorTotal>100){
        $valor=1;
    }
    else if($sumaAsignacion > $recursoAccion ){
        $valor=2;
    }else{
        echo $objPlanAccion->updateActividadPoai();
        $valor=0;
    }
    //echo "logro --->".$logroAccion."-----------".$sumaMod."----> <br>";
    echo $numero.'-'.$valor;




?>
