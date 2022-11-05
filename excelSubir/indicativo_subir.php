<?php


set_time_limit(1800000000000);
ini_set('memory_limit', '-1');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//require_once 'PHPExcel/Classes/PHPExcel.php';
require_once '../Classes/PHPExcel.php';

$archivo = "INDICATIVO.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
$registro=61;
$ind_codigo = 1;//Yaaa cambie
$ind_vigencia = 1;


for ($row = 2; $row <= $highestRow; $row++){
    $codigoaccion = $sheet->getCell("A".$row)->getValue();
    $descri_accion = $sheet->getCell("B".$row)->getValue();
    $linea_base = $sheet->getCell("C".$row)->getValue();
    $meta_resultado = $sheet->getCell("D".$row)->getValue();
    $indicador = $sheet->getCell("E".$row)->getValue();
    $tpo_cmprtmiento = $sheet->getCell("F".$row)->getValue();
    $sede = $sheet->getCell("G".$row)->getValue();
    $unidad_2022 = $sheet->getCell("H".$row)->getValue();
    $valor_2022 = $sheet->getCell("I".$row)->getValue();
    $unidad_2023 = $sheet->getCell("J".$row)->getValue();
    $valor_2023 = $sheet->getCell("K".$row)->getValue();
    $unidad_2024 = $sheet->getCell("L".$row)->getValue();
    $valor_2024 = $sheet->getCell("M".$row)->getValue();

    $codigo_accion = str_replace('"','',$codigoaccion);
    $tipo_comportamiento = str_replace('"','',$tpo_cmprtmiento);
    $codigo_sede = str_replace('"','',$sede);

    $sql_indicador="INSERT INTO plandesarrollo.indicador(
                                ind_codigo, ind_unidadmedida, ind_lineabase, 
                                ind_metaresultado, ind_accion, ind_estado, 
                                ind_fechacreo, ind_fechamodifico, ind_personacreo, 
                                ind_personamodifico, ind_tipocomportamiento, 
                                ind_tendencia, ind_sede)
                        VALUES ($ind_codigo, '$indicador', $linea_base, 
                                $meta_resultado, $codigo_accion, '1', 
                                NOW(), NOW(), 1, 
                                1, $tipo_comportamiento, 
                                1, $codigo_sede);";

    echo $sql_indicador."<br>";

    $sql_indicador_vigencia2022="INSERT INTO plandesarrollo.indicador_vigencia(
                                             ivi_codigo, ivi_indicador, ivi_valorlogrado, 
                                             ivi_presupuesto, ivi_vigencia, ivi_estado, 
                                             ivi_fechacreo, ivi_fechamodifico, ivi_personacreo, 
                                             ivi_personamodifico)
                                     VALUES ($ind_vigencia, $ind_codigo, $unidad_2022, 
                                             $valor_2022, 2022, '1', NOW(), NOW(), 1, 1);";

    echo $sql_indicador_vigencia2022."<br>"; $ind_vigencia++;

    $sql_indicador_vigencia2023="INSERT INTO plandesarrollo.indicador_vigencia(
                                            ivi_codigo, ivi_indicador, ivi_valorlogrado, 
                                            ivi_presupuesto, ivi_vigencia, ivi_estado, 
                                            ivi_fechacreo, ivi_fechamodifico, ivi_personacreo, 
                                            ivi_personamodifico)
                                    VALUES ($ind_vigencia, $ind_codigo, $unidad_2023, 
                                            $valor_2023, 2023, '1', NOW(), NOW(), 1, 1);";

    echo $sql_indicador_vigencia2023."<br>";$ind_vigencia++;

    $sql_indicador_vigencia2024="INSERT INTO plandesarrollo.indicador_vigencia(
                                            ivi_codigo, ivi_indicador, ivi_valorlogrado, 
                                            ivi_presupuesto, ivi_vigencia, ivi_estado, 
                                            ivi_fechacreo, ivi_fechamodifico, ivi_personacreo, 
                                            ivi_personamodifico)
                                    VALUES ($ind_vigencia, $ind_codigo, $unidad_2024,
                                            $valor_2024, 2024, '1', NOW(), NOW(), 1, 1);";

    echo $sql_indicador_vigencia2024."<br><br>";$ind_vigencia++;


    $ind_codigo++;
    $registro++;
}
?>
