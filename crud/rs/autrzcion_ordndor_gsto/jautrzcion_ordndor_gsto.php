<?php
    include('prcsos/autrzcion_ordndor_gsto/rsAutrzcionOrdndorGsto.php');

    $objAutorizacionOrdenadorGasto = new RsAutrzcionOrdndorGsto();

    $datListSolicitudes = $objAutorizacionOrdenadorGasto->datListSolicitudes();
?>