<?php
    $codigo_planDesarrollo=$iduno;

    include('crud/rs/lstdoNvelUno.php'); 
    header("Content-type: application/json");
    echo $listaNivelUno;

?>