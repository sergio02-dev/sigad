<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('prcsos/dpndncia/mdfcarDependencia.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $chkestado = $_REQUEST['chkestado'];
    $codigo_dependencia = $_REQUEST['codigo_dependencia'];

    $modificardependencia = new MdfcarDependencia();

    $modificardependencia->setPersonaSistema($personaSistema);
    $modificardependencia->setNombre($txtNombre);
    $modificardependencia->setEstado($chkestado);
    $modificardependencia->setCodigo($codigo_dependencia);

    $modificardependencia->updateDependencia();
?>