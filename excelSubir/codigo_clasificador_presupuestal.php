<?php

set_time_limit(1800000000000);
ini_set('memory_limit', '-1');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php

require_once '../Classes/PHPExcel.php';

$archivo = "codigo_clasificador_presupuestal.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
$registro=61;
$ccp_codigo=1;

for ($row = 2; $row <= $highestRow; $row++){
    $codigo_clasificador = $sheet->getCell("A".$row)->getValue();
    $niv = $sheet->getCell("B".$row)->getValue();
    $descripcion = $sheet->getCell("C".$row)->getValue();
    $fuente = $sheet->getCell("D".$row)->getValue();

    $sql_sql_ccpresupuestal="INSERT INTO planaccion.codigo_clasificador_presupuestal(
                                         ccp_codigo, 
                                         ccp_code, 
                                         ccp_niv, 
                                         ccp_descripcion, 
                                         ccp_fuente, 
                                         ccp_estado, 
                                         ccp_fechacreo, 
                                         ccp_fechamodifico, 
                                         ccp_personacreo, 
                                         ccp_personamodifico)
                                 VALUES ($ccp_codigo, 
                                         '$codigo_clasificador', 
                                         '$niv', 
                                         '$descripcion', 
                                         '$fuente', 
                                         1, 
                                         NOW(), 
                                         NOW(), 
                                         1, 
                                         1);";

    echo $sql_sql_ccpresupuestal."<br><br>";


    $ccp_codigo++;
    $registro++;
  }
?>
