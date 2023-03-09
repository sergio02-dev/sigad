<?php

set_time_limit(1800000000000);
ini_set('memory_limit', '-1');

require_once '../Classes/PHPExcel.php';

$archivo = "plan_compras.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
$pdi_codigo=1;

for ($row = 2; $row <= $highestRow; $row++){
    $sede = $sheet->getCell("A".$row)->getValue();
    $vice = $sheet->getCell("B".$row)->getValue();
    $facu = $sheet->getCell("C".$row)->getValue();
    $depe = $sheet->getCell("D".$row)->getValue();
    $area = $sheet->getCell("E".$row)->getValue();
    $tipo_gasto = $sheet->getCell("F".$row)->getValue();
    $pdi = $sheet->getCell("G".$row)->getValue();
    $accion = $sheet->getCell("H".$row)->getValue();
    $descripcion = $sheet->getCell("I".$row)->getValue();
    $linea = $sheet->getCell("J".$row)->getValue();
    $subLinea = $sheet->getCell("K".$row)->getValue();
    $equipo = $sheet->getCell("L".$row)->getValue();
    $caracteristica = $sheet->getCell("M".$row)->getValue();
    $cantidad = $sheet->getCell("N".$row)->getValue();
    $valor_unitario = $sheet->getCell("O".$row)->getValue();

    $codigo_accion = str_replace('"','',$accion);

    $sql_plan_compras="INSERT INTO usco.formulariopdi(
                                   pdi_codigo, pdi_sede, pdi_vicerrectoria, pdi_facultad, 
                                   pdi_dependencia, pdi_area, pdi_accion, pdi_plantafisica, 
                                   pdi_linea, pdi_sublinea, pdi_equipo, pdi_equipodescripcion, 
                                   pdi_valorunitario, pdi_cantidad, pdi_fechacreo, 
                                   pdi_fechamodifico, pdi_personacreo, pdi_personamodifico, pdi_estado)
                           VALUES ($pdi_codigo, $sede, $vice, $facu, 
                                   $depe, $area, $codigo_accion, '$descripcion', 
                                   $linea, $subLinea, $equipo, $caracteristica, 
                                   $valor_unitario, $cantidad, NOW(), 
                                   NOW(), 1, 1, 1);";

    echo $sql_plan_compras."<br><br>";


    $pdi_codigo++;
  }
?>
