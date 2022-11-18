<?php
    include('prcsos/dpndncia/rgstroDependencia.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $chkestado = $_REQUEST['chkestado'];;

    $registrodependencia = new RgstroDependencia();

    $registrodependencia->setPersonaSistema($personaSistema);
    $registrodependencia->setNombre($txtNombre);
    $registrodependencia->setEstado($chkestado);

    $registrodependencia->insertDependencia();
?>