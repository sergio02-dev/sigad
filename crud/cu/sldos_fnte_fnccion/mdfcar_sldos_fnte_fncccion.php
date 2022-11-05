<?php
    include('prcsos/sldos_fnte_fnccion/mdfcarSldosfnteFncccion.php');

    $personaSistema = $_SESSION['idusuario'];
    $selVigencia = $_REQUEST['selVigencia'];
    $selFuenteFinanciacion = $_REQUEST['selFuenteFinanciacion'];
    $txtSaldo =  str_replace('.','',$_REQUEST['txtSaldo']);
    $chkestado = $_REQUEST['chkestado'];
    $codigo_saldo_fuente = $_REQUEST['codigo_saldo_fuente'];
    $selAcuerdoActo = $_REQUEST['selAcuerdoActo'];

    $modificarsaldofuentefinanciacion = new MdfcarSldosFnteFnnccion();

    $modificarsaldofuentefinanciacion->setPersonaSistema($personaSistema);
    $modificarsaldofuentefinanciacion->setVigencia($selVigencia);
    $modificarsaldofuentefinanciacion->setFuenteFinanciacion($selFuenteFinanciacion);
    $modificarsaldofuentefinanciacion->setSaldo($txtSaldo);
    $modificarsaldofuentefinanciacion->setEstado($chkestado);
    $modificarsaldofuentefinanciacion->setCodigo($codigo_saldo_fuente);
    $modificarsaldofuentefinanciacion->setAcuerdo($selAcuerdoActo);

    echo $modificarsaldofuentefinanciacion->modfcarSaldoFuente();
?>