<?php

    include('crud/rs/actoAdministrativo.php');
    $actoAdministrativo=$objActoAdmin->dataActo();
    header("Content-type: application/json");
    echo $actoAdministrativo;

?>
