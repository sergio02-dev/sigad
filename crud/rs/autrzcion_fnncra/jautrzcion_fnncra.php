<?php
    include('prcsos/autrzcion_fnncra/rsAutrzcionFnncra.php');

    $objAutorizacionFinanciera = new RsAutrzcionFnncra();

    $datListSolicitudes = $objAutorizacionFinanciera->datListSolicitudes();
?>