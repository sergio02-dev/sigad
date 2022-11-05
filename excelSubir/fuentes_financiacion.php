<?php

set_time_limit(1800000000000);
ini_set('memory_limit', '-1');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php

require_once '../Classes/PHPExcel.php';

$archivo = "fuentes_financiacion.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
$registro=61;
$dmg_codigo=30;

for ($row = 2; $row <= $highestRow; $row++){
    $codigo_clasificacion = $sheet->getCell("A".$row)->getValue();
    $nombre_clasificacion = $sheet->getCell("B".$row)->getValue();
    $codigo_linix = $sheet->getCell("C".$row)->getValue();
    $referencia_linix = $sheet->getCell("D".$row)->getValue();
    $descripcion_fuente = $sheet->getCell("E".$row)->getValue();
    $grupo_fuente = $sheet->getCell("F".$row)->getValue();

    $codigo_grupo = str_replace('"','',$grupo_fuente);

    $sql_fuentefin="INSERT INTO planaccion.fuente_financiacion(
                                ffi_codigo, 
                                ffi_nombre, 
                                ffi_descripcion, 
                                ffi_tipofuente, 
                                ffi_fechacreo, 
                                ffi_fechamodifico, 
                                ffi_personacreo, 
                                ffi_personamodifico, 
                                ffi_estado, 
                                ffi_clasificacion,
                                ffi_codigolinix,
                                ffi_referencialinix)
                        VALUES ($dmg_codigo, 
                                '$descripcion_fuente', 
                                '', 
                                $codigo_grupo, 
                                NOW(), 
                                NOW(), 
                                1, 
                                1, 
                                1, 
                                $codigo_clasificacion,
                                $codigo_linix,
                                '$referencia_linix');";

    echo $sql_fuentefin."<br><br>";


    $dmg_codigo++;
    $registro++;
  }
?>
