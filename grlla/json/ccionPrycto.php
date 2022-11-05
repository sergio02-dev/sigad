<?php 

    $codigo_proyecto=$iduno;

    include('crud/rs/ccionRgstroPlnccion.php');
    header("Content-type: application/json");
    echo $rsAccionProyecto;
?>