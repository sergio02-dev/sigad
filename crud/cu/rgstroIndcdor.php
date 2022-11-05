<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

    include('prcsos/plndsrrllo/rgstroIndcdor.php');
    
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
    $selSedes = $_REQUEST['selSedes'];



    $regustroIndicadores = new RgstroIndcdor();

    $regustroIndicadores->setCodigoAccion($codigoAccion);
    $regustroIndicadores->setIndicador($txtUnidadMedida);
    $regustroIndicadores->setLineaBase($txtLineaBase);
    $regustroIndicadores->setMetaResultado($txtMetaResultado);
    $regustroIndicadores->setComportamiento($selTipoComportamiento);
    $regustroIndicadores->setTendenciaPositiva($selTendencia);
    $regustroIndicadores->setUnidad($txtValorLogro);
    $regustroIndicadores->setPresupuesto($txtPresupuesto);
    $regustroIndicadores->setPersonaSistema($personaSistema);
    $regustroIndicadores->setVigencia($txtVigencia);
    $regustroIndicadores->setTotalInsert($totalInsert);
    $regustroIndicadores->setSede($selSedes);

    echo $regustroIndicadores->insertIndicador();


?>