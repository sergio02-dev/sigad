<?php

set_time_limit(1800000000000);
ini_set('memory_limit', '-1');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php

require_once '../Classes/PHPExcel.php';

$archivo = "sigad_usco_poai_nuevo.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
$registro=61;
$poav_codigo=1;

for ($row = 2; $row <= $highestRow; $row++){
    $accion = $sheet->getCell("A".$row)->getValue();
    $codigo_accion = str_replace('"','',$accion);
    $sede = $sheet->getCell("AB".$row)->getValue();//Sedes

    $uno = $sheet->getCell("C".$row)->getValue();//49
    if(($uno != '') || ($uno >0)){
        $sql_uno = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                         VALUES ($poav_codigo, $codigo_accion, 49, $sede, $uno, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_uno;
        $poav_codigo++;
    }
    

    $dos = $sheet->getCell("D".$row)->getValue();//50
    if(($dos != '') || ($dos >0)){
        $sql_dos = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 50, $sede, $dos, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_dos;
        $poav_codigo++;
    }

    $tres = $sheet->getCell("E".$row)->getValue();//2022011123194141736
    if(($tres != '') || ($tres >0)){
        $sql_tres = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 2022011123194141736, $sede, $tres, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_tres;
        $poav_codigo++;
    }

    $cuatro = $sheet->getCell("F".$row)->getValue();//2022011123164869048
    if(($cuatro != '') || ($cuatro >0)){
        $sql_cuatro = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 2022011123164869048, $sede, $cuatro, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_cuatro;
        $poav_codigo++;
    }

    $cinco = $sheet->getCell("G".$row)->getValue();//2022011123244862721
    if(($cinco != '') || ($cinco >0)){
        $sql_cinco = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 2022011123244862721, $sede, $cinco, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_cinco;
        $poav_codigo++;
    }

    $seis = $sheet->getCell("H".$row)->getValue();//2022011122042638425
    if(($seis != '') || ($seis >0)){
        $sql_seis = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 2022011122042638425, $sede, $seis, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_seis;
        $poav_codigo++;
    }

    $siete = $sheet->getCell("I".$row)->getValue();//42
    if(($siete != '') || ($siete >0)){
        $sql_siete = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 42, $sede, $siete, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_siete;
        $poav_codigo++;
    }

    $ocho = $sheet->getCell("J".$row)->getValue();//45
    if(($ocho != '') || ($ocho >0)){
        $sql_ocho = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 45, $sede, $ocho, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_ocho;
        $poav_codigo++;
    }


    $nueve = $sheet->getCell("K".$row)->getValue();//44
    if(($nueve != '') || ($nueve >0)){
        $sql_nueve = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 44, $sede, $nueve, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_nueve;
        $poav_codigo++;
    }

    $diez = $sheet->getCell("L".$row)->getValue();//43
    if(($diez != '') || ($diez >0)){
        $sql_diez = "INSERT INTO planaccion.poai_veinte_veintidos(
                                    poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                            VALUES ($poav_codigo, $codigo_accion, 43, $sede, $diez, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_diez;
        $poav_codigo++;
    }

    $once = $sheet->getCell("M".$row)->getValue();//41
    if(($once != '') || ($once >0)){
        $sql_once = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 41, $sede, $once, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_once;
        $poav_codigo++;
    }

    $doce = $sheet->getCell("N".$row)->getValue();//48
    if(($doce != '') || ($doce >0)){
        $sql_doce = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 48, $sede, $doce, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_doce;
        $poav_codigo++;
    }

    $trece = $sheet->getCell("O".$row)->getValue();//47
    if(($trece != '') || ($trece >0)){
        $sql_trece = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 47, $sede, $trece, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_trece;
        $poav_codigo++;
    }

    $catorce = $sheet->getCell("P".$row)->getValue();//46
    if(($catorce != '') || ($catorce >0)){
        $sql_catorce = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 46, $sede, $catorce, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_catorce;
        $poav_codigo++;
    }

    $quince = $sheet->getCell("Q".$row)->getValue();//2022021419211875865
    if(($quince != '') || ($quince >0)){
        $sql_quince = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 2022021419211875865, $sede, $quince, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_quince;
        $poav_codigo++;
    }

    $dieciseis = $sheet->getCell("R".$row)->getValue();//2022011123132367152
    if(($dieciseis != '') || ($dieciseis >0)){
        $sql_dieciseis = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 2022011123132367152, $sede, $dieciseis, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_dieciseis;
        $poav_codigo++;
    }

    $diecisiete = $sheet->getCell("S".$row)->getValue();//2022011122542142465
    if(($diecisiete != '') || ($diecisiete >0)){
        $sql_diecisiete = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 2022011122542142465, $sede, $diecisiete, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_diecisiete;
        $poav_codigo++;
    }

    $dieciocho = $sheet->getCell("T".$row)->getValue();//2022011123044754797
    if(($dieciocho != '') || ($dieciocho >0)){
        $sql_dieciocho = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 2022011123044754797, $sede, $dieciocho, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_dieciocho;
        $poav_codigo++;
    }

    $diecinueve = $sheet->getCell("U".$row)->getValue();//2022011123035411613
    if(($diecinueve != '') || ($diecinueve >0)){
        $sql_diecinueve = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 2022011123035411613, $sede, $diecinueve, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_diecinueve;
        $poav_codigo++;
    }
    
    $veinte = $sheet->getCell("V".$row)->getValue();//202201112302575944
    if(($veinte != '') || ($veinte >0)){
        $sql_veinte = "INSERT INTO planaccion.poai_veinte_veintidos(
                                poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                        VALUES ($poav_codigo, $codigo_accion, 202201112302575944, $sede, $veinte, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_veinte;
        $poav_codigo++;
    }

    $veinti_uno = $sheet->getCell("W".$row)->getValue();//2022011123020592268
    if(($veinti_uno != '') || ($veinti_uno >0)){
        $sql_veinti_uno = "INSERT INTO planaccion.poai_veinte_veintidos(
                                        poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                                VALUES ($poav_codigo, $codigo_accion, 2022011123020592268, $sede, $veinti_uno, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_veinti_uno;
        $poav_codigo++;
    }

    $veinti_dos = $sheet->getCell("X".$row)->getValue();//202201112309336004
    if(($veinti_dos != '') || ($veinti_dos >0)){
        $sql_veinti_dos = "INSERT INTO planaccion.poai_veinte_veintidos(
                                       poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                               VALUES ($poav_codigo, $codigo_accion, 202201112309336004, $sede, $veinti_dos, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_veinti_dos;
        $poav_codigo++;
    }

    $veinti_tres = $sheet->getCell("Y".$row)->getValue();//2022011123060352930
    if(($veinti_tres != '') || ($veinti_tres >0)){
        $sql_veinti_tres = "INSERT INTO planaccion.poai_veinte_veintidos(
                                       poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                               VALUES ($poav_codigo, $codigo_accion, 2022011123060352930, $sede, $veinti_tres, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_veinti_tres;
        $poav_codigo++;
    }


    $veinti_cuatro = $sheet->getCell("Z".$row)->getValue();//2022011123075083138
    if(($veinti_cuatro != '') || ($veinti_cuatro >0)){
        $sql_veinti_cuatro = "INSERT INTO planaccion.poai_veinte_veintidos(
                                       poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                               VALUES ($poav_codigo, $codigo_accion, 2022011123075083138, $sede, $veinti_cuatro, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_veinti_cuatro;
        $poav_codigo++;
    }

    $veinti_cinco = $sheet->getCell("AA".$row)->getValue();//39
    if(($veinti_cinco != '') || ($veinti_cinco >0)){
        $sql_veinti_cinco = "INSERT INTO planaccion.poai_veinte_veintidos(
                                       poav_codigo, poav_accion, poav_fuentefinanciacion, poav_sede, poav_recurso, poav_estado, poav_fechacreo, poav_fechamodifico, poav_personacreo, poav_personamodifico)
                               VALUES ($poav_codigo, $codigo_accion, 39, $sede, $veinti_cinco, 1, NOW(), NOW(), 1, 1);";
        echo "<br> ".$sql_veinti_cinco;
        $poav_codigo++;
    }

    $registro++;
}
?>
