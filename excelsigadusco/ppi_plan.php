<?php 

function tildes($palabra){
    $no_admitidas = array("á","é","í","ó","ú");
    $admitidas = array("Á", "É", "Í;", "Ó", "Ú");
    $texto = str_replace($no_admitidas, $admitidas ,$palabra);
    return $texto;
}

function letra_celda($numero_letras, $letra_uno, $letra_dos){
    if($numero_letras>90){//si es mayor a 90 
        if($letra_uno == 91){//si es == 91 
            $letra_uno = 65;
        }
        else{//Si no que siga aumentando
        }//cierre else
        $letra_convertir = chr($letra_dos).''.chr($letra_uno);
    }//fin si primera condicion
    else{//Sino Primera condicion
        $letra_convertir = chr($numero_letras);
    }

    return $letra_convertir;
}


set_time_limit(1800000000);
$fecha_generar=date('Y-m-d_H:i:s');

/** Incluir la libreria PHPExcel */
require_once 'Classes/PHPExcel.php';
//$persona_entidad=$_SESSION['entidad_persona'];
// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();
//$objWorksheet = $objPHPExcel->getActiveSheet();

// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Cattivo")
->setLastModifiedBy("Cattivo")
->setTitle("Responsable Acción")
->setSubject("Responsable Acción")
->setDescription("Responsable Acción")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Responsable Acción");

$styleFuenteLetra = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 9,
        'name'  => 'Verdana'
    ),
    'borders' => array(
    'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'A22929')
    )
);

$styleFuenteLeft = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '000000'),
        'size'  => 9,
        'name'  => 'Verdana'
    ),
    'borders' => array(
    'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'DFDADA')
    )
);

$colorHoja=array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFFFFF')
    ),
    'borders' => array(
    'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'wrap' => true
    )
);

$colorHojaRight=array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFFFFF')
    ),
    'borders' => array(
    'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        'wrap' => true
    )
);

$codigo_plan = $iduno;
$codigo_ppi = $iddos;

$numero_registro=0;
$numero_excel=0;
$numero_ingresos=1;

$objPHPExcel->getActiveSheet()->setTitle('PPI');

$sheet = $objPHPExcel->getActiveSheet();
$sheet->getPageMargins()->setTop(0.6);
$sheet->getPageMargins()->setBottom(0.6);
$sheet->getPageMargins()->setHeader(0.4);
$sheet->getPageMargins()->setFooter(0.4);
$sheet->getPageMargins()->setLeft(0.4);
$sheet->getPageMargins()->setRight(0.4);

    include('crud/rs/ppi/rporte_ppi.php');


    list($anio_inicio, $anio_fin) = $objRprtePPI->anios_plan($codigo_plan);

    $cantdad_anios = 66 + ($anio_fin - $anio_inicio) + 1;

    // INICIO Filas titulos tipo fuente
    $sheet->mergeCells("A1:".chr($cantdad_anios)."1");
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A1', 'PLAN PLURIANUAL DE INVERSIONES - FUENTES DE FINANCIACIÓN ');


    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A1:'.chr($cantdad_anios).'1')->applyFromArray($styleFuenteLetra);

    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A2', 'FUENTES');


    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A2')->applyFromArray($styleFuenteLetra);

    $num_anio = 66;
    for ($years_plan = $anio_inicio; $years_plan <= $anio_fin ; $years_plan++) { 

        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue(chr($num_anio).'2', $years_plan);

        $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($num_anio).'2')->applyFromArray($styleFuenteLetra);
        
        $num_anio++;
    }

    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue(chr($num_anio).'2', 'TOTAL POR FUENTE');

    $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($num_anio).'2')->applyFromArray($styleFuenteLetra);

    $num_registro = 3;
    $list_fuentes = $objRprtePPI->list_fuentes($codigo_plan, $codigo_ppi);
    if($list_fuentes){
        foreach ($list_fuentes as $dta_list_fuentes) {
            $ppi_fuente = $dta_list_fuentes['ppi_fuente'];
            $ffi_nombre = $dta_list_fuentes['ffi_nombre'];

            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('A'.$num_registro, $ffi_nombre);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($styleFuenteLeft);

            //Costo Vigencia Fuente
            $num_anio = 66;
            for ($years_plan = $anio_inicio; $years_plan <= $anio_fin ; $years_plan++) { 

                $recurso_fuente_vigencia = $objRprtePPI->recurso_fuente_vigencia($codigo_plan, $codigo_ppi, $years_plan, $ppi_fuente);

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue(chr($num_anio).$num_registro, $recurso_fuente_vigencia);

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($num_anio).$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($num_anio).$num_registro)->applyFromArray($colorHojaRight);
                
                $num_anio++;
            }

            $recursos_totales_fuente = $objRprtePPI->recursos_totales_fuente($codigo_plan, $codigo_ppi, $ppi_fuente);

            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue(chr($num_anio).$num_registro, $recursos_totales_fuente);

            $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($num_anio).$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($num_anio).$num_registro)->applyFromArray($colorHojaRight);

            $num_registro++;
        }
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('A'.$num_registro, 'TOTALES');
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($colorHoja);

        //Costo Total Vigencia
        $num_total_anio = 66;
        for ($years_plan = $anio_inicio; $years_plan <= $anio_fin ; $years_plan++) { 

            $recursos_ppi_vigencia = $objRprtePPI->recursos_ppi_vigencia($codigo_plan, $codigo_ppi, $years_plan);

            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue(chr($num_total_anio).$num_registro, $recursos_ppi_vigencia);

            $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($num_total_anio).$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($num_total_anio).$num_registro)->applyFromArray($colorHojaRight);

            $num_total_anio++;
        }

        $recurso_final = $objRprtePPI->recurso_final($codigo_plan, $codigo_ppi);

        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue(chr($num_total_anio).$num_registro, $recurso_final);

        $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($num_total_anio).$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($num_total_anio).$num_registro)->applyFromArray($colorHojaRight);

    }
   


$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(50);
$num_letra_anio = 66;
for ($years_plan = $anio_inicio; $years_plan <= $anio_fin ; $years_plan++) {
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension(chr($num_letra_anio))->setWidth(26);
    $num_letra_anio++;
}
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension(chr($num_letra_anio))->setWidth(35);


$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);


// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="PPI'.$fecha_generar.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// incluir o gráfico no ficheiro que vamos gerar
$objWriter->setIncludeCharts(TRUE);
ob_end_clean();
$objWriter->save('php://output');
exit;

?>
