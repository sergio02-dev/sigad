<?php

set_time_limit(1800000000000);
ini_set('memory_limit', '-1');


require '../cnxn/cnfg_db.php';

require '../cnxn/cnf_class.php';

$cnxn_pag = Dtbs::getInstance();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php

require_once '../Classes/PHPExcel.php';

$archivo = "organigrama/carga_masiva.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
$registro=61;
$codigo_organigrama=1;

for ($row = 2; $row <= $highestRow; $row++){
    $sedes = $sheet->getCell("B".$row)->getValue();
    $vicerrectorias = $sheet->getCell("D".$row)->getValue();
    $facultades = $sheet->getCell("F".$row)->getValue();
    $nombre_dependencia = $sheet->getCell("G".$row)->getValue();
    $dependencias = $sheet->getCell("H".$row)->getValue();
    $areas = $sheet->getCell("J".$row)->getValue();

    if($dependencias == 0){
        $sqlDependencia = "SELECT MAX(ofi_codigo) AS maximo
                             FROM usco.oficina;";

        $queryDependencia = $cnxn_pag->ejecutar($sqlDependencia);
        $dataDependencia = $cnxn_pag->obtener_filas($queryDependencia);

        $maximo = $dataDependencia['maximo'];

        $codigo_dependencia = $maximo+1;

        $sql_registro_dependencia = "INSERT INTO usco.oficina(
                                                 ofi_codigo, ofi_nombre, 
                                                 ofi_estado, ofi_fechacreo, 
                                                 ofi_fechamodifico, ofi_personacreo, 
                                                 ofi_personamodifico, ofi_codigousco)
                                         VALUES ($codigo_dependencia, '$nombre_dependencia', 
                                                 1, NOW(), 
                                                 NOW(), 1, 
                                                 1, 0);";

        $cnxn_pag->ejecutar($sql_registro_dependencia);

    }
    else{
        $codigo_dependencia = $dependencias;
    }

    $sql_organigrama="INSERT INTO usco.organigrama_usco(
                                  org_codigo, org_sede, 
                                  org_vicerrectoria, org_facultades, 
                                  org_dependencias, org_areas, 
                                  org_fechacreacion, org_fechamodifico, 
                                  org_personacreo, org_personamodifico)
                          VALUES ($codigo_organigrama, $sedes, 
                                  $vicerrectorias, $facultades, 
                                  $codigo_dependencia, $areas, 
                                  NOW(), NOW(), 
                                  1, 1);";

    $cnxn_pag->ejecutar($sql_organigrama);

    $codigo_organigrama++;
    $registro++;
}
?>
