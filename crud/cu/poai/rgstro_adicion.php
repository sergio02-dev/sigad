<?php
    include('prcsos/poai/rgstroAdicion.php');

    $personaSistema = $_SESSION['idusuario'];
    $selFuenteFinanciacion = $_REQUEST['selFuenteFinanciacion'];
    $txtSaldo =  str_replace('.','',$_REQUEST['txtSaldo']);
    $chkestado = $_REQUEST['chkestado'];
    $codigo_poai = $_REQUEST['codigo_poai'];

    $registroadicionpoai = new RgstroAdicionPOAI();

    $registroadicionpoai->setPersonaSistema($personaSistema);
    $registroadicionpoai->setCodigoSaldo($selFuenteFinanciacion);
    $registroadicionpoai->setRecurso($txtSaldo);
    $registroadicionpoai->setCodigoPoai($codigo_poai);
    $registroadicionpoai->setEstado($chkestado);

    echo $registroadicionpoai->insertAdiccion();
?>