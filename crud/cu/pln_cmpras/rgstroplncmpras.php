
<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('prcsos/pln_cmpras/rgstroPlnCmpras.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtDescripcion = str_replace("'","&apos;",$_REQUEST['txtDescripcion']);
    $txtCantidad = str_replace(',','.',$_REQUEST['txtCantidad']);
    $txtValorUnitario = str_replace('.','',$_REQUEST['txtValorUnitario']);
    $codigo_etapa = $_REQUEST['codigo_etapa'];
    $estado = $_REQUEST['chkestado'];
    $codigo_actividad = $_REQUEST['codigo_actividad'];
    $plancompras = $_REQUEST['plancompras'];

    $registroplancompras = new RgstroPlanCompras();

    $registroplancompras->setCodigoEtapa($codigo_etapa);
    $registroplancompras->setSede($codigo_actividad);
    $registroplancompras->setDescripcion($txtDescripcion);
    $registroplancompras->setCantidad($txtCantidad);
    $registroplancompras->setValorUnitario($txtValorUnitario);
    $registroplancompras->setPersonaSistema($personaSistema);
    $registroplancompras->setEstado($estado);
    $registroplancompras->setPlancompras($plancompras);

    $registroplancompras->insertPlanCompras();
?>