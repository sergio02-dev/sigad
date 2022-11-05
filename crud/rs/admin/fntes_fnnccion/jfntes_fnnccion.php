<?php
    include('prcsos/admin/fntes_fnnccion/rsFuenteFinanciacion.php');

    $objFuenteFinanciacion = new RsFuntesFinanciacion();

    $rs_fuentes_financiacion = $objFuenteFinanciacion->dtaFuentesFinanciacion();
?>