<?php
    include('prcsos/ctvdad/ctvdadCcion.php');

    $objRsctvdadCcion = new CcionCtvdad();

    $data_actividad_reporte = $objRsctvdadCcion->data_actividad_reporte($codigo_accion);
?>