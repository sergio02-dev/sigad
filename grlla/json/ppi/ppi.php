<?php
    $codigo_plan = $iduno;
    include('crud/rs/ppi/jppi.php'); 
    header("Content-type: application/json");
    echo $rs_ppi;
?>