<?php

set_time_limit(1800000000000);
ini_set('memory_limit', '-1');

require '../cnxn/cnfg_db.php';

require '../cnxn/cnf_class.php';

$cnxn_pag = Dtbs::getInstance();

function tildes($palabra){
    $no_admitidas = array("á","é","í","ó","ú","ñ");
    $admitidas = array("Á", "É", "Í", "Ó", "Ú", "Ñ");
    $texto = str_replace($no_admitidas, $admitidas ,$palabra);
    return $texto;
}

require_once '../Classes/PHPExcel.php';

$archivo = "organigrama/inventario_sigad.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();

for ($row = 2; $row <= $highestRow; $row++){
    $codigo_linea = $sheet->getCell("A".$row)->getValue();
    $nombre_linea = strtoupper(tildes($sheet->getCell("B".$row)->getValue()));
    $codigo_sublinea = $sheet->getCell("C".$row)->getValue();
    $nombre_sublinea = strtoupper(tildes($sheet->getCell("D".$row)->getValue()));
    $codigo_equipo = $sheet->getCell("E".$row)->getValue();
    $nombre_equipo = strtoupper(tildes($sheet->getCell("F".$row)->getValue()));
    $codigo_descripcion = $sheet->getCell("G".$row)->getValue();
    $descripcion_equipo = strtoupper(tildes($sheet->getCell("H".$row)->getValue()));
    $valor_descripcion = $sheet->getCell("I".$row)->getValue();

    //Se consulta la linea para saber si existe !
    $sqlValidarLinea = "SELECT lin_codigo, lin_nombre, lin_estado
                          FROM inventario.linea
                         WHERE lin_codigo = $codigo_linea;";

    $queryValidarLinea = $cnxn_pag->ejecutar($sqlValidarLinea);
    $dataValidarLinea = $cnxn_pag->obtener_filas($queryValidarLinea);

    $lin_codigo = $dataValidarLinea['lin_codigo'];

    //Si la linea no viene se crea
    if($lin_codigo == ''){
        $sql_linea = "INSERT INTO inventario.linea(
                                  lin_codigo, lin_nombre, lin_estado, lin_fechacreo, lin_fechamodifico, lin_personacreo, lin_personamodifico, lin_codigoctic)
                          VALUES ($codigo_linea, '$nombre_linea', 1, NOW(), NOW(), 1, 1, 0);";

        $cnxn_pag->ejecutar($sql_linea);
    }

    //Se consulta la sub linea para saber si existe !
    $sqlValidarSubLinea = "SELECT slin_codigo, slin_linea, slin_nombre 
                             FROM inventario.sub_linea
                            WHERE slin_codigo =  $codigo_sublinea;";

    $queryValidarSubLinea = $cnxn_pag->ejecutar($sqlValidarSubLinea);
    $dataValidarSubLinea = $cnxn_pag->obtener_filas($queryValidarSubLinea);

    $slin_codigo = $dataValidarSubLinea['slin_codigo'];

    //Si la Sub Linea no existe se crea! 
    if($slin_codigo == ''){
        $sql_sublinea = "INSERT INTO inventario.sub_linea(
                                     slin_codigo, slin_linea, slin_nombre, slin_estado, slin_fechacreo, slin_fechamodifico, slin_personacreo, slin_personamodifico, slin_codigoctic)
                             VALUES ($codigo_sublinea, $codigo_linea, '$nombre_sublinea', 1, NOW(), NOW(), 1, 1, 0);";

        $cnxn_pag->ejecutar($sql_sublinea);       
    }


    //Se consulta el equipo para saber si existe 
    $sqlValidarEquipo = "SELECT equi_codigo, equi_sublinea, equi_nombre 
                           FROM inventario.equipo
                          WHERE equi_codigo = $codigo_equipo;";

    $queryValidarEquipo = $cnxn_pag->ejecutar($sqlValidarEquipo);
    $dataValidarEquipo = $cnxn_pag->obtener_filas($queryValidarEquipo);

    $equi_codigo = $dataValidarEquipo['equi_codigo'];

    if($equi_codigo == ''){
        $sql_equipo = "INSERT INTO inventario.equipo(
                                   equi_codigo, equi_sublinea, equi_nombre, equi_estado, equi_fechacreo, equi_fechamodifico, equi_personacreo, equi_personamodifico, equi_codigoctic)
                           VALUES ($codigo_equipo, $codigo_sublinea, '$nombre_equipo', 1, NOW(), NOW(), 1, 1, 0);";
        
        $cnxn_pag->ejecutar($sql_equipo);
    }

    $sqlCodigoDescripcion = "SELECT MAX(deq_codigo) AS maximodes
	                           FROM inventario.descripcion_equipo;";

    $queryCodigoDescripcion = $cnxn_pag->ejecutar($sqlCodigoDescripcion);
    $dataCodigoDescripcion = $cnxn_pag->obtener_filas($queryCodigoDescripcion);

    $maximodes = $dataCodigoDescripcion['maximodes'];

    if($maximodes){
        $codigo_descripcion = $maximodes+1;
    }
    else{
        $codigo_descripcion = 1;
    }

    $sql_descripcion = "INSERT INTO inventario.descripcion_equipo(
                                    deq_codigo, deq_equipo, deq_descripcion, deq_valor, deq_estado, deq_fechacreo, deq_fechamodifico, deq_personacreo, deq_personamodifico, deq_codigoctic)
                            VALUES ($codigo_descripcion, $codigo_equipo, '$descripcion_equipo', $valor_descripcion, 1, NOW(), NOW(), 1, 1, 0);";

    $cnxn_pag->ejecutar($sql_descripcion);

}
?>
