<?php
    include('prcsos/pln_cmpras/rgstroPlnCmpras.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtDescripcion = str_replace("'","&apos;",$_REQUEST['txtDescripcion']);
    $txtCantidad = str_replace(',','.',$_REQUEST['txtCantidad']);
    $txtValorUnitario = str_replace('.','',$_REQUEST['txtValorUnitario']);
    $codigo_poai = $_REQUEST['codigo_poai'];
    $estado = $_REQUEST['chkestado'];
    

    $registroplancompras = new RgstroPlanCompras();

    $registroplancompras->setCodigoEtapa($codigo_poai);
    $registroplancompras->setDescripcion($txtDescripcion);
    $registroplancompras->setCantidad($txtCantidad);
    $registroplancompras->setValorUnitario($txtValorUnitario);
    $registroplancompras->setPersonaSistema($personaSistema);
    $registroplancompras->setEstado($estado);

    echo $registroplancompras->insertPlanCompras();
?>