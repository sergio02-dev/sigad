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

    // INICIO Filas titulos tipo fuente
    $sheet->mergeCells("A1:A2");
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A1', 'VIGENCIA');

    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A1:A2')->applyFromArray($styleFuenteLetra);

    $lista_tipo_fuente = $objRprtePPI->lista_tipo_fuente($codigo_plan, $codigo_ppi);
    
    if($lista_tipo_fuente){
        $numeroletasaumenta = 66;
        $numeroletrauno = 66;
        $numeroletrados = 64;
        foreach ($lista_tipo_fuente as $dta_lista_tipo_fuente) {
            $tff_codigo = $dta_lista_tipo_fuente['tff_codigo'];
            $tff_nombre = $dta_lista_tipo_fuente['tff_nombre'];

            $numero_fuente = $objRprtePPI->numero_fuentes($codigo_plan, $codigo_ppi, $tff_codigo);

            if($numero_fuentes == 1){
                if($numeroletasaumenta>90 || $numeroletasaumenta>116){//si es mayor a 90 
                    if($numeroletrauno == 91){//si es == 91 
                        $numeroletrauno = 65;
                        $numeroletrados++;
                    }
                    else{//Si no que siga aumentando
                        $numeroletrauno++;
                    }//cierre else
                    $letra = chr($numeroletrados).''.chr($numeroletrauno);
                }//fin si primera condicion
                else{//Sino Primera condicion
                    $letra = chr($numeroletasaumenta);
                    $numeroletrauno++;
                }

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue($letra.'1', strtoupper(tildes($tff_nombre)));
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.'1')->applyFromArray($styleFuenteLetra);

                $numeroletasaumenta++;
            }
            else{
                $desde_letra = letra_celda($numeroletasaumenta, $numeroletrauno, $numeroletrados);
                $siguiente = $numeroletasaumenta + ($numero_fuente - 1);
                if($siguiente>90 || $siguiente>116){//si es mayor a 90 
                    if($numeroletrauno == 91){//si es == 91 
                        $numeroletrauno = 65;
                        $numeroletrados++;
                    }
                    else{//Si no que siga aumentando
                        $numeroletrauno = $numeroletrauno + $numero_fuente;
                        if($numeroletrauno > 90){
                            $numeros_demas = $numeroletrauno - 90;
                            $numeroletrauno = 64 + $numeros_demas;
                        }
                        else{
                            $numeroletrauno = $numeroletrauno;
                        }
                    }//cierre else
                    $letra = chr($numeroletrados).''.chr($numeroletrauno);
                }//fin si primera condicion
                else{//Sino Primera condicion
                    $letra = chr($siguiente);
                    $numeroletrauno++;
                }
                
                //$desde_letra = $letra;
                //$hasta_letra = letra_celda($numero_fuente, $siguiente, $numeroletrauno, $numeroletrados);

                $sheet->mergeCells($desde_letra."1:".$letra."1");
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue($desde_letra.'1', strtoupper(tildes($tff_nombre)));
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($desde_letra.'1:'.$letra.'1')->applyFromArray($styleFuenteLetra);

                $numeroletasaumenta = $numeroletasaumenta + $numero_fuente;
            }

        }
        if($numeroletasaumenta>90 || $numeroletasaumenta>116){//si es mayor a 90 
            if($numeroletrauno == 91){//si es == 91 
                $numeroletrauno = 65;
                $numeroletrados++;
            }
            else{//Si no que siga aumentando
                $numeroletrauno++;
            }//cierre else
            $letra = chr($numeroletrados).''.chr($numeroletrauno);
        }//fin si primera condicion
        else{//Sino Primera condicion
            $letra = chr($numeroletasaumenta);
            $numeroletrauno++;
        }

        $sheet->mergeCells($letra."1:".$letra."2");
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue($letra.'1', 'TOTAL');
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.'1:'.$letra.'2')->applyFromArray($styleFuenteLetra);

        $numeroletasaumenta++;

    }

    //INICIO Fila titulo Fuente
    $list_tpos_fntes = $objRprtePPI->lista_tipo_fuente($codigo_plan, $codigo_ppi);
    if($list_tpos_fntes){
        $numeroletasaumenta = 66;
        $numeroletrauno = 66;
        $numeroletrados = 64;
        foreach ($list_tpos_fntes as $dta_list_tpos_fntes) {
            $tff_codigo = $dta_list_tpos_fntes['tff_codigo'];
            $tff_nombre = $dta_list_tpos_fntes['tff_nombre'];

            $lista_nombre_fuente = $objRprtePPI->lista_nombre_fuente($codigo_plan, $codigo_ppi, $tff_codigo);
            if($lista_nombre_fuente){
                foreach ($lista_nombre_fuente as $dta_nmbre_fnte) {
                    $ffi_codigo = $dta_nmbre_fnte['ffi_codigo'];
                    $ffi_nombre = $dta_nmbre_fnte['ffi_nombre'];


                    if($numeroletasaumenta>90 || $numeroletasaumenta>116){//si es mayor a 90 
                        if($numeroletrauno == 91){//si es == 91 
                            $numeroletrauno = 65;
                            $numeroletrados++;
                        }
                        else{//Si no que siga aumentando
                            $numeroletrauno++;
                        }//cierre else
                        $letra = chr($numeroletrados).''.chr($numeroletrauno);
                    }//fin si primera condicion
                    else{//Sino Primera condicion
                        $letra = chr($numeroletasaumenta);
                        $numeroletrauno++;
                    }
    
                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue($letra.'2', strtoupper(tildes($ffi_nombre)));
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.'2')->applyFromArray($styleFuenteLetra);
    
                    $numeroletasaumenta++;
                }
            }
        }
    }


    $num_registro = 3;
    //Lista Vigencias
    list($anio_inicio, $anio_fin) = $objRprtePPI->anios_plan($codigo_plan);
    for ($lista_vigencias = $anio_inicio; $lista_vigencias <= $anio_fin ; $lista_vigencias++) {

        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('A'.$num_registro, $lista_vigencias);

        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($colorHoja);

        //lista tipos Fuentes
        if($list_tpos_fntes){
            $numeroletasaumenta = 66;
            $numeroletrauno = 66;
            $numeroletrados = 64;
            foreach ($list_tpos_fntes as $dta_list_tpos_fntes) {
                $tff_codigo = $dta_list_tpos_fntes['tff_codigo'];
                $tff_nombre = $dta_list_tpos_fntes['tff_nombre'];
    
                $lista_nmbre_fuente = $objRprtePPI->lista_nombre_fuente($codigo_plan, $codigo_ppi, $tff_codigo);
                if($lista_nmbre_fuente){
                    foreach ($lista_nmbre_fuente as $dta_nombre_fnte) {
                        $ffi_codigo = $dta_nombre_fnte['ffi_codigo'];
                        $ffi_nombre = $dta_nombre_fnte['ffi_nombre'];

                            
    
                        if($numeroletasaumenta>90 || $numeroletasaumenta>116){//si es mayor a 90 
                            if($numeroletrauno == 91){//si es == 91 
                                $numeroletrauno = 65;
                                $numeroletrados++;
                            }
                            else{//Si no que siga aumentando
                                $numeroletrauno++;
                            }//cierre else
                            $letra = chr($numeroletrados).''.chr($numeroletrauno);
                        }//fin si primera condicion
                        else{//Sino Primera condicion
                            $letra = chr($numeroletasaumenta);
                            $numeroletrauno++;
                        }

                        $recurso_fuente_vigencia = $objRprtePPI->recurso_fuente_vigencia($codigo_plan, $codigo_ppi, $lista_vigencias, $ffi_codigo);
        
                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue($letra.$num_registro, $recurso_fuente_vigencia);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($colorHoja);
        
                        $numeroletasaumenta++;
                    }
                }
            }
            if($numeroletasaumenta>90 || $numeroletasaumenta>116){//si es mayor a 90 
                if($numeroletrauno == 91){//si es == 91 
                    $numeroletrauno = 65;
                    $numeroletrados++;
                }
                else{//Si no que siga aumentando
                    $numeroletrauno++;
                }//cierre else
                $letra = chr($numeroletrados).''.chr($numeroletrauno);
            }//fin si primera condicion
            else{//Sino Primera condicion
                $letra = chr($numeroletasaumenta);
                $numeroletrauno++;
            }
            
            $valor_vigencia = $objRprtePPI->recursos_ppi_vigencia($codigo_plan, $codigo_ppi, $lista_vigencias);

            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue($letra.$num_registro, $valor_vigencia);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($styleFuenteLetra);
    
            $numeroletasaumenta++;
        }
        
        $num_registro++;
    }

    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$num_registro, 'TOTALES');

    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($styleFuenteLetra);

    if($list_tpos_fntes){
        $numeroletasaumenta = 66;
        $numeroletrauno = 66;
        $numeroletrados = 64;
        foreach ($list_tpos_fntes as $dta_list_tpos_fntes) {
            $tff_codigo = $dta_list_tpos_fntes['tff_codigo'];
            $tff_nombre = $dta_list_tpos_fntes['tff_nombre'];

            $lista_nmbre_fuente = $objRprtePPI->lista_nombre_fuente($codigo_plan, $codigo_ppi, $tff_codigo);
            if($lista_nmbre_fuente){
                foreach ($lista_nmbre_fuente as $dta_nombre_fnte) {
                    $ffi_codigo = $dta_nombre_fnte['ffi_codigo'];
                    $ffi_nombre = $dta_nombre_fnte['ffi_nombre'];

                        

                    if($numeroletasaumenta>90 || $numeroletasaumenta>116){//si es mayor a 90 
                        if($numeroletrauno == 91){//si es == 91 
                            $numeroletrauno = 65;
                            $numeroletrados++;
                        }
                        else{//Si no que siga aumentando
                            $numeroletrauno++;
                        }//cierre else
                        $letra = chr($numeroletrados).''.chr($numeroletrauno);
                    }//fin si primera condicion
                    else{//Sino Primera condicion
                        $letra = chr($numeroletasaumenta);
                        $numeroletrauno++;
                    }

                    $total_fuente = $objRprtePPI->recursos_totales_fuente($codigo_plan, $codigo_ppi, $ffi_codigo);
    
                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue($letra.$num_registro, $total_fuente);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($styleFuenteLetra);
    
                    $numeroletasaumenta++;
                }
            }
        }
        if($numeroletasaumenta>90 || $numeroletasaumenta>116){//si es mayor a 90 
            if($numeroletrauno == 91){//si es == 91 
                $numeroletrauno = 65;
                $numeroletrados++;
            }
            else{//Si no que siga aumentando
                $numeroletrauno++;
            }//cierre else
            $letra = chr($numeroletrados).''.chr($numeroletrauno);
        }//fin si primera condicion
        else{//Sino Primera condicion
            $letra = chr($numeroletasaumenta);
            $numeroletrauno++;
        }
        
        $recurso_final = $objRprtePPI->recurso_final($codigo_plan, $codigo_ppi);

        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue($letra.$num_registro, $recurso_final);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($styleFuenteLetra);

        $numeroletasaumenta++;

    }

$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(15);

if($list_tpos_fntes){
    $numeroletasaumenta = 66;
    $numeroletrauno = 66;
    $numeroletrados = 64;
    foreach ($list_tpos_fntes as $dta_list_tpos_fntes) {
        $tff_codigo = $dta_list_tpos_fntes['tff_codigo'];
        $tff_nombre = $dta_list_tpos_fntes['tff_nombre'];

        $lista_nmbre_fuente = $objRprtePPI->lista_nombre_fuente($codigo_plan, $codigo_ppi, $tff_codigo);
        if($lista_nmbre_fuente){
            foreach ($lista_nmbre_fuente as $dta_nombre_fnte) {
                $ffi_codigo = $dta_nombre_fnte['ffi_codigo'];
                $ffi_nombre = $dta_nombre_fnte['ffi_nombre'];

                    

                if($numeroletasaumenta>90 || $numeroletasaumenta>116){//si es mayor a 90 
                    if($numeroletrauno == 91){//si es == 91 
                        $numeroletrauno = 65;
                        $numeroletrados++;
                    }
                    else{//Si no que siga aumentando
                        $numeroletrauno++;
                    }//cierre else
                    $letra = chr($numeroletrados).''.chr($numeroletrauno);
                }//fin si primera condicion
                else{//Sino Primera condicion
                    $letra = chr($numeroletasaumenta);
                    $numeroletrauno++;
                }

                $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension($letra)->setWidth(33);

                $numeroletasaumenta++;
            }
        }
    }
    if($numeroletasaumenta>90 || $numeroletasaumenta>116){//si es mayor a 90 
        if($numeroletrauno == 91){//si es == 91 
            $numeroletrauno = 65;
            $numeroletrados++;
        }
        else{//Si no que siga aumentando
            $numeroletrauno++;
        }//cierre else
        $letra = chr($numeroletrados).''.chr($numeroletrauno);
    }//fin si primera condicion
    else{//Sino Primera condicion
        $letra = chr($numeroletasaumenta);
        $numeroletrauno++;
    }

    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension($letra)->setWidth(36);

    $numeroletasaumenta++;
}

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
