<?php
    include('prcsos/prsna/mdfcarVinculacion.php');

    $personaSistema = $_SESSION['idusuario'];
    $selOficina = $_REQUEST['selOficina'];
    $selCargo = $_REQUEST['selCargo'];
    $chkestado = $_REQUEST['chkestado'];
    $codigo_vinculacion = $_REQUEST['codigo_vinculacion'];

    $modfcarvinculacion = new MdfcarVnclcion();

    $modfcarvinculacion->setPersonaSistema($personaSistema);
    $modfcarvinculacion->setOficina($selOficina);
    $modfcarvinculacion->setCargo($selCargo);
    $modfcarvinculacion->setEstado($chkestado);
    $modfcarvinculacion->setCodigo($codigo_vinculacion);

    echo $modfcarvinculacion->mdfcar_vinculacion();
?>