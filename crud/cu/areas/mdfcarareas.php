<?php
    include('prcsos/areas/mdfcarAreas.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $chkestado = $_REQUEST['chkestado'];
    $codigo_areas = $_REQUEST['codigo_areas'];

    $modificarareas = new MdfcarAreas();

    $modificarareas->setPersonaSistema($personaSistema);
    $modificarareas->setNombre($txtNombre);
    $modificarareas->setEstado($chkestado);
    $modificarareas->setCodigo($codigo_areas);

    $modificarareas->updateAreas();
?>