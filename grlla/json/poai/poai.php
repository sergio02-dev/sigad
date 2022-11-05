<?php
    $codigo_plan = $iduno;
    
    include('crud/rs/poai/jpoai.php'); 
    header("Content-type: application/json");
    echo $rs_poai;
?>