<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

    include('prcsos/plndsrrllo/updteIndcdor.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $txtUnidadMedida=$_REQUEST['txtUnidadMedida'];
    $txtLineaBase=$_REQUEST['txtLineaBase'];
    $txtMetaResultado=$_REQUEST['txtMetaResultado'];

    $selTipoComportamiento=$_REQUEST['selTipoComportamiento'];
    $selTendencia=$_REQUEST['selTendencia'];
    $txtValorLogro=$_REQUEST['txtValorLogro'];
    $txtPresupuesto=$_REQUEST['txtPresupuesto']; 
    $codigoAccion=$_REQUEST['codigoAccion']; 
    $txtVigencia=$_REQUEST['txtVigencia'];
    $totalInsert=$_REQUEST['totalInsert'];
    $codigoIndicador=$_REQUEST['codigoIndicador'];
    $selSedes = $_REQUEST['selSedes'];

    $updateIndicador = new UpdteIndcdor();

    $updateIndicador->setCodigoAccion($codigoAccion);
    $updateIndicador->setIndicador($txtUnidadMedida);
    $updateIndicador->setLineaBase($txtLineaBase);
    $updateIndicador->setMetaResultado($txtMetaResultado);
    $updateIndicador->setComportamiento($selTipoComportamiento);
    $updateIndicador->setTendenciaPositiva($selTendencia);
    $updateIndicador->setUnidad($txtValorLogro);
    $updateIndicador->setPresupuesto($txtPresupuesto);
    $updateIndicador->setPersonaSistema($personaSistema);
    $updateIndicador->setVigencia($txtVigencia);
    $updateIndicador->setTotalInsert($totalInsert);
    $updateIndicador->setCodigoIndicador($codigoIndicador);
    $updateIndicador->setSede($selSedes);

    echo $updateIndicador->updateIndicador();


?>