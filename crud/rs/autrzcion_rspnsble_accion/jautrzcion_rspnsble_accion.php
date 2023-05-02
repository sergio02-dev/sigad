<?php
    include('prcsos/autrzcion_rspnsble_accion/rsAutrzcionRspnsbleAccion.php');

    $objAutorizacionResponsableAccion = new RsAutrzcionRspnsbleAccion();

    $datListSolicitudes = $objAutorizacionResponsableAccion->datListSolicitudes();
?>