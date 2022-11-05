<?php
    require '../cnxn/cnfg_db.php';

    require '../cnxn/cnf_class.php';

    $cnxn_pag = Dtbs::getInstance();

    $datos_funcionario = json_decode(file_get_contents("funcionario_usuario.json"));
    $num = 36;
    $num_entidad = 1;
    foreach ($datos_funcionario->personas as $dta_fncnrio) {
        $identificacion = $dta_fncnrio->Num_identificacion;
        $nombre = $dta_fncnrio->nombres;
        $apellidos = $dta_fncnrio->Apellidos;
        $genero = $dta_fncnrio->Genero;

        if($genero == "F"){
            $nombre_genero = "M";
        }

        
        if($genero == "M"){
            $nombre_genero = "H";
        }


        $sql_persona="SELECT per_codigo, per_identificacion
                            FROM principal.persona
                            WHERE CAST(per_identificacion AS BIGINT) = $identificacion;";

        $query_persona = $cnxn_pag->ejecutar($sql_persona);
        $data_persona = $cnxn_pag->obtener_filas($query_persona);
        $codigo_persona = $data_persona['per_codigo'];

        if($codigo_persona){

            $updte_persona = "UPDATE principal.persona
                                 SET per_nombre = '$nombre', per_primerapellido = '$apellidos', per_tipoidentificacion = 1,
                                     per_personamodifico = 1, per_fechamodifico = NOW(), per_genero = '$nombre_genero', 
                                     per_estado = 1
                               WHERE per_codigo = $codigo_persona;";

            echo $updte_persona."<br><br>";
        }
        else{
            $codigo_new_person = $num;
            $codigo_new_entdad = $num_entidad;

            $insert_persona="INSERT INTO principal.persona(
                                        per_codigo, per_nombre, per_primerapellido, 
                                        per_personacreo, per_personamodifico, per_fechacreo, per_fechamodifico, 
                                        per_genero, per_tipoidentificacion, per_identificacion, per_estado)
                                VALUES ($codigo_new_person, '$nombre', '$apellidos',  
                                        '1', '1', NOW(), NOW(), 
                                        '$nombre_genero', 1, '$identificacion', '1');";

            echo $insert_persona."<br>";

            $insert_entidad_persona="INSERT INTO principal.entidad_persona(
                                                epe_codigo, epe_persona, epe_estado, epe_personacreo, epe_personamodifico, 
                                                epe_fechacreo, epe_fechamodifico, epe_entidad)
                                        VALUES ($codigo_new_entdad, $codigo_new_person, '1', 1, 1, 
                                                NOW(), NOW(), 0);";
            
            echo $insert_entidad_persona."<br><br>";

            $num++;
            $num_entidad++;
        }


    }
?>