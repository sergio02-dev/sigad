<?php
    $datos_oficina = json_decode(file_get_contents("ofcna.json"));

    //print_r($datos_oficina);

    foreach ($datos_oficina->oficina as $dta_oficina) {
        $codigo = $dta_oficina->codigo;
        $nombre = $dta_oficina->nombre;

        $sql_oficna = "INSERT INTO usco.oficina(
                                   ofi_codigo, ofi_nombre, ofi_estado, ofi_fechacreo, ofi_fechamodifico, ofi_personacreo, ofi_personamodifico)
                           VALUES ($codigo, '$nombre', 1, NOW(), NOW(), 1, 1);";

        echo $sql_oficna."<br><br>";
    }
?>