<?php
    include('prcsos/vcrctrias/rgstroVicerectoria.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $sedes = $_REQUEST['sedes'];
    $chkestado = $_REQUEST['chkestado'];;

    $registrovicerrectoria = new RgstroVicerectoria();

    $registrovicerrectoria ->setPersonaSistema($personaSistema);
    $registrovicerrectoria->setNombre($txtNombre);
    $registrovicerrectoria -> setSedes($sedes);
    $registrovicerrectoria->setEstado($chkestado);

    $registrovicerrectoria->insertVicerrectoria();
?>