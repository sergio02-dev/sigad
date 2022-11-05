<?php
    include('prcsos/poai/rgstroTrsldo.php');

    $personaSistema = $_SESSION['idusuario'];
    $codigo_poai = $_REQUEST['codigo_poai'];
    $selAccion = $_REQUEST['selAccion'];
    $selAcuerdo = $_REQUEST['selAcuerdo'];
    $selRecurso = $_REQUEST['selRecurso'];
    $selSede = $_REQUEST['selSede'];
    $selIndicador = $_REQUEST['selIndicador'];
    $txtSaldo = str_replace('.','',$_REQUEST['txtSaldo']);
    $chkestado = $_REQUEST['chkestado'];

    $registrotraslado = new RgstroTrsldo();

    $registrotraslado->setPoai($codigo_poai);
    $registrotraslado->setAccion($selAccion);
    $registrotraslado->setAcuerdo($selAcuerdo);
    $registrotraslado->setRecurso($selRecurso);
    $registrotraslado->setSede($selSede);
    $registrotraslado->setIndicador($selIndicador);
    $registrotraslado->setSaldo($txtSaldo);
    $registrotraslado->setEstado($chkestado);
    $registrotraslado->setPersonaSistema($personaSistema);

    $registrotraslado->insertTraslado();
?>