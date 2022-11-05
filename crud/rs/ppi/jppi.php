<?php
    include('prcsos/ppi/rsPPI.php');

    $objPPI = new RsPPI();

    $rs_ppi = $objPPI->dtaTipoFuente($codigo_plan);
?>