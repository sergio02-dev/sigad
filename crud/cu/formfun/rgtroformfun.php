<?php
    include('prcsos/formfun/rgtroFormfun.php');

    $personaSistema = $_SESSION['idusuario'];
    $selSede = $_REQUEST['selSede'];
    $selTipoVicerrectoria = $_REQUEST['selTipoVicerrectoria'];
    $selTipoFacultad = $_REQUEST['selTipoFacultad'];
    $selDependencia= $_REQUEST['selDependencia'];
    $selArea= $_REQUEST['selArea'];
    $selLineaEquipo= $_REQUEST['selLineaEquipo'];
    $selSublineaEquipo= $_REQUEST['selSublineaEquipo'];
    $selEquipo = $_REQUEST['selEquipo'];
    $selCaracteristicas = $_REQUEST['selCaracteristicas'];
    $selCantidad = $_REQUEST['selCantidad'];
    $selValorunitario = $_REQUEST['valor_unitario'];
    



    $registroplancomprasfuncionamiento = new RgstroFormfun();

    $registroplancomprasfuncionamiento->setPersonaSistema($personaSistema);
    $registroplancomprasfuncionamiento->setSede($selSede);
    $registroplancomprasfuncionamiento->setVicerrectoria($selTipoVicerrectoria);
    $registroplancomprasfuncionamiento->setFacultad($selTipoFacultad);
    $registroplancomprasfuncionamiento->setDependencia($selDependencia);
    $registroplancomprasfuncionamiento->setArea($selArea);
    $registroplancomprasfuncionamiento->setLineaequipo($selLineaEquipo);
    $registroplancomprasfuncionamiento->setSublineaequipo($selSublineaEquipo);
    $registroplancomprasfuncionamiento->setEquipo($selEquipo);
    $registroplancomprasfuncionamiento->setCaracteristicas($selCaracteristicas);
    $registroplancomprasfuncionamiento->setCantidad($selCantidad);
    $registroplancomprasfuncionamiento->setValorunitario($selValorunitario);


    echo $registroplancomprasfuncionamiento->insertFormfun()
?>