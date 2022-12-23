<?php
    include('prcsos/vcrctrias/rgstroVicerectoria.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $chkestado = $_REQUEST['chkestado'];;

    $registrovicerrectoria = new RgstroVicerectoria();

    $registrovicerrectoria ->setPersonaSistema($personaSistema);
    $registrovicerrectoria->setNombre($txtNombre);
    $registrovicerrectoria->setEstado($chkestado);

    $registrovicerrectoria->insertVicerrectoria();
?>