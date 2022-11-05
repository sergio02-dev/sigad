<?php
    require '../cnxn/cnfg_db.php';

    require '../cnxn/cnf_class.php';

    $cnxn_pag = Dtbs::getInstance();

    $datos_vinculacion = json_decode(file_get_contents("vnclacion.json"));
    $codigo_vnclacion = 1;
    foreach ($datos_vinculacion->vinculacion as $dta_fncnrio) {
        $identificacion = $dta_fncnrio->num_identificacion;
        $cargo = $dta_fncnrio->cargo;
        $oficina = $dta_fncnrio->oficina;


        $sql_persona="SELECT per_codigo, per_identificacion
                        FROM principal.persona
                       WHERE CAST(per_identificacion AS BIGINT) = $identificacion;";

        $query_persona = $cnxn_pag->ejecutar($sql_persona);
        $data_persona = $cnxn_pag->obtener_filas($query_persona);
        $codigo_persona = $data_persona['per_codigo'];

       

        $sql_vinculacion = "INSERT INTO usco.vinculacion(
                                        vin_codigo, vin_persona, vin_oficina, vin_cargo, vin_estado, vin_fechacreo, vin_fechamodifico, vin_personacreo, vin_personamodifico)
                                VALUES ($codigo_vnclacion, $codigo_persona, $oficina, $cargo, 1, NOW(), NOW(), 1, 1);";


        echo $sql_vinculacion."<br><br>";

        $codigo_vnclacion++;
    }
?>