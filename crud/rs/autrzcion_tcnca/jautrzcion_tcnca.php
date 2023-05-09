<?php
    include('prcsos/autrzcion_tcnca/rsAutrzcionTcnca.php');
    
    $objAutorizacionTecnica = new RsAutrzcionTcnca();

    $datListSolicitudes = $objAutorizacionTecnica->datListSolicitudes();
?>