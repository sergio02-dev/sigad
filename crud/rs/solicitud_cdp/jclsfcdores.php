<?php
    include('prcsos/solicitud_cdp/rsSolicitudCdp.php');

    $objSolicitudCdp = new RsSolicitudCdp();
     
    $jsonCsfcdores = $objSolicitudCdp->jsonCsfcdores();
?>