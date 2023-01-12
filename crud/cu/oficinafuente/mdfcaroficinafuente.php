<?php
    include('prcsos/oficinafuente/mdfcaroficinafuente.php');

    $personaSistema = $_SESSION['idusuario'];
    $codigo_oficina = $_REQUEST['codigo_oficina'];
    $codigo_cargo = $_REQUEST['codigo_cargo'];
    $fuente = $_REQUEST['fuente'];
    $chkestado = $_REQUEST['chkestado'];;
    
    
    $modificaroficinafuente = new MdfcarOficinaFuente();

    $modificaroficinafuente->setPersonaSistema($personaSistema);
    $modificaroficinafuente->setOficina($codigo_oficina);
    $modificaroficinafuente->setCargo($codigo_cargo);
    $modificaroficinafuente->setFuente($fuente);
    $modificaroficinafuente->setEstado($chkestado);


    $modificaroficinafuente->updateOficinafuente();
?>