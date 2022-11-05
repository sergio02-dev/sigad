<?php
    include('prcsos/sldos_fnte_fnccion/rsSaldoFuenteFinanciacion.php');

    $objSaldosFuente = new RsSaldoFuentesFinanciacion();

    $rs_saldos_fuente = $objSaldosFuente->datListSaldosFuente();
?>