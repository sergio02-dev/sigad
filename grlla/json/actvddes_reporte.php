<?php
    $codigo_accion=$iduno;
    
    include('crud/rs/actvdad_rportda.php');
    header("Content-type: application/json");
    echo $data_actividad_reporte;

?>