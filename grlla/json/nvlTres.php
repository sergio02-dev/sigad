<?php
    $codigo_planDesarrollo=$iduno;

    include('crud/rs/lstdoNvelTres.php'); 
    header("Content-type: application/json");
    echo $listaNivelTres;

?>