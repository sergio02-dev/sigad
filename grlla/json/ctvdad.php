<?php
 
    $codigo_subsistema=$iduno;

    include('crud/rs/ctvdad.php'); 
    header("Content-type: application/json");
    echo $rs_actividad;

?>
