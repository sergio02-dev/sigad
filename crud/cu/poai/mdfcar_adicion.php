<?php
    include('prcsos/poai/mdfcarAdicion.php');

    $personaSistema = $_SESSION['idusuario'];
    $selFuenteFinanciacion = $_REQUEST['selFuenteFinanciacion'];
    $txtSaldo =  str_replace('.','',$_REQUEST['txtSaldo']);
    $chkestado = $_REQUEST['chkestado'];
    $codigo_poai = $_REQUEST['codigo_poai'];
    $codigo_adicion = $_REQUEST['codigo_adicion'];

    $registroadicionpoai = new MdfcarAdicionPOAI();

    $registroadicionpoai->setPersonaSistema($personaSistema);
    $registroadicionpoai->setCodigoSaldo($selFuenteFinanciacion);
    $registroadicionpoai->setRecurso($txtSaldo);
    $registroadicionpoai->setCodigoPoai($codigo_poai);
    $registroadicionpoai->setEstado($chkestado);
    $registroadicionpoai->setCodigo($codigo_adicion);

    echo $registroadicionpoai->updteAdiccion();
?>