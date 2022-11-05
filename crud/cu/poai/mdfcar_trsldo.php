<?php
    include('prcsos/poai/mdfcarTrsldo.php');

    $personaSistema = $_SESSION['idusuario'];
    $codigo_poai = $_REQUEST['codigo_poai'];
    $selAccion = $_REQUEST['selAccion'];
    $selAcuerdo = $_REQUEST['selAcuerdo'];
    $selRecurso = $_REQUEST['selRecurso'];
    $selSede = $_REQUEST['selSede'];
    $selIndicador = $_REQUEST['selIndicador'];
    $txtSaldo = str_replace('.','',$_REQUEST['txtSaldo']);
    $chkestado = $_REQUEST['chkestado'];
    $codigo_traslado = $_REQUEST['codigo_traslado'];

    $modificartraslado = new MdfcarTrsldo();

    $modificartraslado->setPoai($codigo_poai);
    $modificartraslado->setAccion($selAccion);
    $modificartraslado->setAcuerdo($selAcuerdo);
    $modificartraslado->setRecurso($selRecurso);
    $modificartraslado->setSede($selSede);
    $modificartraslado->setIndicador($selIndicador);
    $modificartraslado->setSaldo($txtSaldo);
    $modificartraslado->setEstado($chkestado);
    $modificartraslado->setPersonaSistema($personaSistema);
    $modificartraslado->setCodigo($codigo_traslado);

    $modificartraslado->updteTraslado();
?>