<?php
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
->setTitle("Plan Desarrollo")
->setSubject("Plan Desarrollo")
->setDescription("Plan Desarrollo")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Plan Desarrollo");

$styleFuenteLetra = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 8,
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
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'B92109')
    )
);

$pieSubsistema = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 8,
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
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'D8EDF8')
    )
);

$colorHoja=array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '000000'),
        'size'  => 8,
        'name'  => 'Verdana'
    ),
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
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    )
);

$datos_dinero=array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '000000'),
        'size'  => 8,
        'name'  => 'Verdana'
    ),
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
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    )
);

$nombreSubsistema=array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '000000'),
        'size'  => 8,
        'name'  => 'Verdana'
    ),
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
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    )
);

function tildes($palabra){
    $no_admitidas = array("á","é","í","ó","ú","ñ");
    $admitidas = array("Á", "É", "Í", "Ó", "Ú","N");
    $texto = str_replace($no_admitidas, $admitidas ,$palabra);
    return $texto;
}

function tldes_minuscula($palabra){
    $no_admitidas = array("Á", "É", "Í", "Ó", "Ú", "Ñ");
    $admitidas = array("á","é","í","ó","ú", "ñ");
    $texto = str_replace($no_admitidas, $admitidas ,$palabra);
    return $texto;
}


$codigo_plandesarrollo = $_REQUEST['codigo_plandesarrollo'];
$vigencia = $_REQUEST['vigencia'];
$sub_sistema = $_REQUEST['sub_sistema'];

include('crud/rs/rprte_asgnacion_pln_accion/rsRprtePoaiEtpaCmplto.php');

$numero_excel = 0;
$numero_registro = 0;
$Subsistemas = $reportepoaietapa->subSistemasXCodigo($codigo_plandesarrollo, $sub_sistema);

if($Subsistemas){//If Subsistema
    foreach ($Subsistemas as $data_subsistema) {//Forech Subsistema
        $sub_codigo = $data_subsistema['sub_codigo'];
        $sub_nombre = $data_subsistema['sub_nombre'];
        $sub_referencia = $data_subsistema['sub_referencia'];
        $sub_ref = $data_subsistema['sub_ref'];

        $referenciaSubsistema = $sub_referencia.$sub_ref;

        $nombreHoja = $sub_referencia.$sub_ref;
        $numero_ingresos = 1;
        $num = 1;
        if($numero_registro > 0){      
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($numero_registro);
            $objPHPExcel->getActiveSheet()->setTitle($nombreHoja);
        }
        else{      
            $objPHPExcel->getActiveSheet()->setTitle($nombreHoja);
        }


        $sheet = $objPHPExcel->getActiveSheet($numero_registro);
        $sheet->getPageMargins()->setTop(0.6);
        $sheet->getPageMargins()->setBottom(0.6);
        $sheet->getPageMargins()->setHeader(0.4);
        $sheet->getPageMargins()->setFooter(0.4);
        $sheet->getPageMargins()->setLeft(0.4);
        $sheet->getPageMargins()->setRight(0.4);

        $proyecto_subsistema = $reportepoaietapa->proyecto_subsistema($sub_codigo);
        if($proyecto_subsistema){
            foreach ($proyecto_subsistema as $dat_prycto_sbstema) {
                $pro_codigo = $dat_prycto_sbstema['pro_codigo'];
                $pro_referencia = $dat_prycto_sbstema['pro_referencia']; 
                $pro_numero = $dat_prycto_sbstema['pro_numero']; 
                $pro_descripcion = $dat_prycto_sbstema['pro_descripcion'];  
                $pro_objetivo = $dat_prycto_sbstema['pro_objetivo'];

                $accion_proyecto = $reportepoaietapa->accion_proyecto($pro_codigo);
                if($accion_proyecto){
                    foreach ($accion_proyecto as $dat_acciones) {
                        $acc_codigo = $dat_acciones['acc_codigo'];
                        $acc_referencia = $dat_acciones['acc_referencia'];
                        $acc_numero = $dat_acciones['acc_numero'];
                        $acc_descripcion = $dat_acciones['acc_descripcion'];
                        $acc_responsable = $dat_acciones['acc_responsable'];
                        $acc_proyecto = $dat_acciones['acc_proyecto'];

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValueExplicit('A'.$num, '' ,PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValue('B'.$num, '');

                        /************* NOMBRES DE LAS FUENTES DE FINANCIACIÓN *************/
                        $numeroletasaumenta = 67;
                        $numeroletrauno = 67;
                        $numeroletrados = 64;

                        $list_fuente_financiacion = $reportepoaietapa->list_fuente_disponibilidad($acc_codigo, $vigencia);
                        if($list_fuente_financiacion){
                            foreach ($list_fuente_financiacion as $dta_lsta_fuente_financiacion) {
                                $codigo_fuente = $dta_lsta_fuente_financiacion['codigo_fuente'];
                                $vigencia_recurso = $dta_lsta_fuente_financiacion['vigencia_recurso'];
                                $nombre_fuente = $dta_lsta_fuente_financiacion['nombre_fuente'];
                                $recurso_disponible = $dta_lsta_fuente_financiacion['recurso_disponible'];

                                if($numeroletasaumenta>90){//si es mayor a 90 
                                    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                                        $numeroletrauno=65;
                                        $numeroletrados++;
                                    }
                                    else{//Si no que siga aumentando
                                        $numeroletrauno++;
                                    }//cierre else
                                    $letra=chr($numeroletrados).''.chr($numeroletrauno);
                                }//fin si primera condicion
                                else{//Sino Primera condicion
                                    $letra=chr($numeroletasaumenta);
                                    $numeroletrauno++;
                                }

                                $objPHPExcel->setActiveSheetIndex($numero_registro)
                                ->setCellValue($letra.$num, str_replace('INV -','',$nombre_fuente)." ".$vigencia_recurso);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($styleFuenteLetra);
                                
                                $numeroletasaumenta++;
                            }
                        }

                        $num++;

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('A'.$num, '')
                        ->setCellValue('B'.$num, 'POAI');

                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num)->applyFromArray($styleFuenteLetra);

                        /************* RECURSOS DE LAS FUENTES DE FINANCIACIÓN *************/
                        $numeroletasaumenta = 67;
                        $numeroletrauno = 67;
                        $numeroletrados = 64;

                        $list_fuente_financiacion = $reportepoaietapa->list_fuente_disponibilidad($acc_codigo, $vigencia);
                        if($list_fuente_financiacion){
                            foreach ($list_fuente_financiacion as $dta_lsta_fuente_financiacion) {
                                $codigo_fuente = $dta_lsta_fuente_financiacion['codigo_fuente'];
                                $vigencia_recurso = $dta_lsta_fuente_financiacion['vigencia_recurso'];
                                $nombre_fuente = $dta_lsta_fuente_financiacion['nombre_fuente'];
                                $recurso_disponible = $dta_lsta_fuente_financiacion['recurso_disponible'];

                                if($numeroletasaumenta>90){//si es mayor a 90 
                                    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                                        $numeroletrauno=65;
                                        $numeroletrados++;
                                    }
                                    else{//Si no que siga aumentando
                                        $numeroletrauno++;
                                    }//cierre else
                                    $letra=chr($numeroletrados).''.chr($numeroletrauno);
                                }//fin si primera condicion
                                else{//Sino Primera condicion
                                    $letra=chr($numeroletasaumenta);
                                    $numeroletrauno++;
                                }

                                $objPHPExcel->setActiveSheetIndex($numero_registro)
                                ->setCellValue($letra.$num, $recurso_disponible);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($datos_dinero);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                                $numeroletasaumenta++;
                            }
                        }

                        $num++;
                        
                        $actividadPoai = $reportepoaietapa->actividadPoai($acc_codigo, $vigencia);
                        if($actividadPoai){
                            foreach ($actividadPoai as $dat_actvdad) {
                                $acp_codigo = $dat_actvdad['acp_codigo'];
                                $acp_referencia = $dat_actvdad['acp_referencia'];
                                $acp_numero = $dat_actvdad['acp_numero'];
                                $acp_descripcion = $dat_actvdad['acp_descripcion'];
                                $acp_sedeindicador = $dat_actvdad['acp_sedeindicador'];

                                $sede_indicar = $reportepoaietapa->sede_indicar($acp_sedeindicador);

                                $desc_actividad = $acp_referencia.".".$acp_numero." ".$acp_descripcion;

                                $objPHPExcel->setActiveSheetIndex($numero_registro)
                                ->setCellValue('A'.$num, $desc_actividad);

                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num)->applyFromArray($colorHoja);

                                $objPHPExcel->setActiveSheetIndex($numero_registro)
                                ->setCellValue('B'.$num, $sede_indicar);

                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num)->applyFromArray($colorHoja);


                                /************* RECURSOS DE LAS FUENTES DE FINANCIACIÓN *************/
                                $numeroletasaumenta = 67;
                                $numeroletrauno = 67;
                                $numeroletrados = 64;

                                $list_fuente_financiacion = $reportepoaietapa->list_fuente_disponibilidad($acc_codigo, $vigencia);
                                if($list_fuente_financiacion){
                                    foreach ($list_fuente_financiacion as $dta_lsta_fuente_financiacion) {
                                        $codigo_fuente = $dta_lsta_fuente_financiacion['codigo_fuente'];
                                        $vigencia_recurso = $dta_lsta_fuente_financiacion['vigencia_recurso'];
                                        $nombre_fuente = $dta_lsta_fuente_financiacion['nombre_fuente'];

                                        if($numeroletasaumenta>90){//si es mayor a 90 
                                            if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                                                $numeroletrauno=65;
                                                $numeroletrados++;
                                            }
                                            else{//Si no que siga aumentando
                                                $numeroletrauno++;
                                            }//cierre else
                                            $letra=chr($numeroletrados).''.chr($numeroletrauno);
                                        }//fin si primera condicion
                                        else{//Sino Primera condicion
                                            $letra=chr($numeroletasaumenta);
                                            $numeroletrauno++;
                                        }

                                        $valor_asignado_actividad = $reportepoaietapa->valor_asignado_actividad($acp_codigo, $codigo_fuente, $vigencia, $vigencia_recurso);

                                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                                        ->setCellValue($letra.$num, $valor_asignado_actividad);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($datos_dinero);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                                        $numeroletasaumenta++;
                                    }
                                }

                                $num++;
                            }
                        }

                        /********************************** TOTALES *********************************/
                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('A'.$num, '')
                        ->setCellValue('B'.$num, '');

                        $numeroletasaumenta = 67;
                        $numeroletrauno = 67;
                        $numeroletrados = 64;

                        $list_fuente_financiacion = $reportepoaietapa->list_fuente_disponibilidad($acc_codigo, $vigencia);
                        if($list_fuente_financiacion){
                            foreach ($list_fuente_financiacion as $dta_lsta_fuente_financiacion) {
                                $codigo_fuente = $dta_lsta_fuente_financiacion['codigo_fuente'];
                                $vigencia_recurso = $dta_lsta_fuente_financiacion['vigencia_recurso'];
                                $nombre_fuente = $dta_lsta_fuente_financiacion['nombre_fuente'];
                                $recurso_disponible = $dta_lsta_fuente_financiacion['recurso_disponible'];

                                if($numeroletasaumenta>90){//si es mayor a 90 
                                    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                                        $numeroletrauno=65;
                                        $numeroletrados++;
                                    }
                                    else{//Si no que siga aumentando
                                        $numeroletrauno++;
                                    }//cierre else
                                    $letra=chr($numeroletrados).''.chr($numeroletrauno);
                                }//fin si primera condicion
                                else{//Sino Primera condicion
                                    $letra=chr($numeroletasaumenta);
                                    $numeroletrauno++;
                                }

                                $valor_asignado_accion = $reportepoaietapa->valor_asignado_accion($acc_codigo, $codigo_fuente, $vigencia, $vigencia_recurso);

                                $disponible = $recurso_disponible - $valor_asignado_accion;

                                $objPHPExcel->setActiveSheetIndex($numero_registro)
                                ->setCellValue($letra.$num, $disponible);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($datos_dinero);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                                $numeroletasaumenta++;
                            }
                        }

                        $num++;
                        $num++;
                        
                    }
                }
                
            }
        }


        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(40);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(10);
  
        if($proyecto_subsistema){
            foreach ($proyecto_subsistema as $dat_prycto_sbstema) {
                $pro_codigo = $dat_prycto_sbstema['pro_codigo'];

                $accion_proyecto = $reportepoaietapa->accion_proyecto($pro_codigo);
                if($accion_proyecto){
                    foreach ($accion_proyecto as $dat_acciones) {
                        $acc_codigo = $dat_acciones['acc_codigo'];

                        /************* LISTADO FUENTES DE FINANCIACIÓN *************/
                        $numeroletasaumenta = 67;
                        $numeroletrauno = 67;
                        $numeroletrados = 64;

                        $list_fuente_financiacion = $reportepoaietapa->list_fuente_disponibilidad($acc_codigo, $vigencia);
                        if($list_fuente_financiacion){
                            foreach ($list_fuente_financiacion as $dta_lsta_fuente_financiacion) {

                                if($numeroletasaumenta>90){//si es mayor a 90 
                                    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                                        $numeroletrauno=65;
                                        $numeroletrados++;
                                    }
                                    else{//Si no que siga aumentando
                                        $numeroletrauno++;
                                    }//cierre else
                                    $letra=chr($numeroletrados).''.chr($numeroletrauno);
                                }//fin si primera condicion
                                else{//Sino Primera condicion
                                    $letra=chr($numeroletasaumenta);
                                    $numeroletrauno++;
                                }

                                $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension($letra)->setWidth(18);

                                $numeroletasaumenta++;
                            }
                        }

                    }
                }
            }
        }
        

        $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);

        $numero_registro++;
    }//Cierre Foreach Subsistema
}//Cierre if subsistemas

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="PlanAccion'.$fecha_generar.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// incluir o gráfico no ficheiro que vamos gerar
$objWriter->setIncludeCharts(TRUE);
ob_end_clean();
$objWriter->save('php://output');
exit;

?>