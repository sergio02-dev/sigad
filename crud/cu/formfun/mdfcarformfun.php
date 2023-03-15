<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('prcsos/formfun/mdfcarFormfun.php');
    $codigoPlanCompras = $_REQUEST['codigoPlanComprasFun'];
    $personaSistema = $_SESSION['idusuario'];
    $selSede = $_REQUEST['selSede'];
    $selTipoVicerrectoria = $_REQUEST['selTipoVicerrectoria'];
    $selTipoFacultad = $_REQUEST['selTipoFacultad'];
    $selDependencia= $_REQUEST['selDependencia'];
    $selArea= $_REQUEST['selArea'];
    $selAccion = $_REQUEST['selAccion'];
    $chkestado = $_REQUEST['chkestado'];
    $selLineaEquipo= $_REQUEST['selLineaEquipo'];
    $selSublineaEquipo= $_REQUEST['selSublineaEquipo'];
    $selEquipo = $_REQUEST['selEquipo'];
    $selCaracteristicas = $_REQUEST['selCaracteristicas'];
    $selCantidad = $_REQUEST['selCantidad'];
    $valor_unitario = $_REQUEST['selValorUnitario'];
    $chkestado = $_REQUEST['chkestado'];

    $mdfcarplancomprasfun = new MdfcarFormfun();

    $mdfcarplancomprasfun->setCodigo($codigoPlanCompras);
    $mdfcarplancomprasfun->setPersonaSistema($personaSistema);
    $mdfcarplancomprasfun->setSede($selSede);
    $mdfcarplancomprasfun->setVicerrectoria($selTipoVicerrectoria);
    $mdfcarplancomprasfun->setFacultad($selTipoFacultad);
    $mdfcarplancomprasfun->setDependencia($selDependencia);
    $mdfcarplancomprasfun->setArea($selArea);
    $mdfcarplancomprasfun->setLineaequipo($selLineaEquipo);
    $mdfcarplancomprasfun->setSublineaequipo($selSublineaEquipo);
    $mdfcarplancomprasfun->setEquipo($selEquipo);
    $mdfcarplancomprasfun->setCaracteristicas($selCaracteristicas);
    $mdfcarplancomprasfun->setCantidad($selCantidad);
    $mdfcarplancomprasfun->setValorunitario($valor_unitario);
    $mdfcarplancomprasfun->setEstado($chkestado);


    echo $mdfcarplancomprasfun->updateformfun()
?>