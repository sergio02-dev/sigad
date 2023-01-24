<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('prcsos/areas/rgstroAreas.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $chkestado = $_REQUEST['chkestado'];;

    $registroareas = new RgstroAreas();

    $registroareas->setPersonaSistema($personaSistema);
    $registroareas->setNombre($txtNombre);
    $registroareas->setEstado($chkestado);

    $registroareas->insertAreas();
?>