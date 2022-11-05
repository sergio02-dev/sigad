<?php
    //header('Content-type: text/plain; charset=utf-8');

    $datos_cargo = json_decode(file_get_contents("cargos_nuevo.json"));

    foreach ($datos_cargo->cargos as $dta_crgo) {
        $codigo = $dta_crgo->codigo;
        $nombre = $dta_crgo->nombre;

        $sql_cargos = "INSERT INTO usco.cargo(car_codigo, car_nombre, car_estado, car_fechacreo, car_fechamodifico, car_personacreo, car_personamodifico)
                             VALUES($codigo, '$nombre', 1, NOW(), NOW(), 1,1);";

        echo $sql_cargos."<br><br>";
    }
?>