<?php
    include('prcsos/oficinafuente/rgstrooficinafuente.php');

    $personaSistema = $_SESSION['idusuario'];
    $selOficina = $_REQUEST['selOficina'];
    $selCargo = $_REQUEST['selCargo'];
    $fuente = $_REQUEST['fuente'];
    $chkestado = $_REQUEST['chkestado'];

    $registrooficinafuente = new RgstroOficinaFuente();

    $registrooficinafuente ->setPersonaSistema($personaSistema);
    $registrooficinafuente->setCodigo_oficina($selOficina);
    $registrooficinafuente->setCodigo_cargo($selCargo);
    $registrooficinafuente->setCodigo_fuente($fuente);
    $registrooficinafuente->setEstado($chkestado);

    $registrooficinafuente->insertOficinafuente();
?>