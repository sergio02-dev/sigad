<?php
    include('prcsos/fcltades/rgstroFacultades.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $chkestado = $_REQUEST['chkestado'];;

    $registrofacultades = new RgstroFacultades();

    $registrofacultades->setPersonaSistema($personaSistema);
    $registrofacultades->setNombre($txtNombre);
    $registrofacultades->setEstado($chkestado);

    $registrofacultades->insertFacultades();
?>