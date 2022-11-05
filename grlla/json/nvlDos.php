<?php
    $codigo_planDesarrollo=$iduno;

    include('crud/rs/lstdoNvelDos.php'); 
    header("Content-type: application/json");
    echo $listoNivelDos;

?>