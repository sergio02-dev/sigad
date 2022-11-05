<?php
    include('prcsos/sldos_fnte_fnccion/rgstroSldosfnteFncccion.php');

    $personaSistema = $_SESSION['idusuario'];
    $selVigencia = $_REQUEST['selVigencia'];
    $selFuenteFinanciacion = $_REQUEST['selFuenteFinanciacion'];
    $txtSaldo =  str_replace('.','',$_REQUEST['txtSaldo']);
    $chkestado = $_REQUEST['chkestado'];
    $selAcuerdoActo = $_REQUEST['selAcuerdoActo'];
    

    $registrosaldosduentedinanciacion = new RgstroSldosFnteFnnccion();

    $registrosaldosduentedinanciacion->setPersonaSistema($personaSistema);
    $registrosaldosduentedinanciacion->setVigencia($selVigencia);
    $registrosaldosduentedinanciacion->setFuenteFinanciacion($selFuenteFinanciacion);
    $registrosaldosduentedinanciacion->setSaldo($txtSaldo);
    $registrosaldosduentedinanciacion->setEstado($chkestado);
    $registrosaldosduentedinanciacion->setAcuerdo($selAcuerdoActo);

    echo $registrosaldosduentedinanciacion->insertSaldoFuente();
?>