<?php
    include('prcsos/prsna/rgstroVinculacion.php');

    $personaSistema = $_SESSION['idusuario'];
    $selOficina = $_REQUEST['selOficina'];
    $selCargo = $_REQUEST['selCargo'];
    $chkestado = $_REQUEST['chkestado'];
    $codigo_persona = $_REQUEST['codigo_persona'];

    $regstrovinculacion = new RgstroVnclcion();

    $regstrovinculacion->setPersonaSistema($personaSistema);
    $regstrovinculacion->setOficina($selOficina);
    $regstrovinculacion->setCargo($selCargo);
    $regstrovinculacion->setEstado($chkestado);
    $regstrovinculacion->setPersona($codigo_persona);

    echo $regstrovinculacion->insert_vinculacion();
?>