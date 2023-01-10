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
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'D8EDF8')
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
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    )
);

$datos_dinero=array(
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
    $no_admitidas = array("Á", "É", "Í", "Ó", "Ú");
    $admitidas = array("á","é","í","ó","ú");
    $texto = str_replace($no_admitidas, $admitidas ,$palabra);
    return $texto;
}


$codigo_plandesarrollo = $_REQUEST['codigo_plandesarrollo'];
$vigencia = $_REQUEST['vigencia'];
include('crud/rs/rprte_asgnacion_pln_accion/rsRprtePoaiEtpaCmplto.php');

$numero_excel = 0;
$numero_registro = 0;
$num = 1;
$Subsistemas = $reportepoaietapa->subSistemasPlanDesarrollo($codigo_plandesarrollo);

if($Subsistemas){//If Subsistema
    foreach ($Subsistemas as $data_subsistema) {//Forech Subsistema
        $sub_codigo = $data_subsistema['sub_codigo'];
        $sub_nombre = $data_subsistema['sub_nombre'];
        $sub_referencia = $data_subsistema['sub_referencia'];
        $sub_ref = $data_subsistema['sub_ref'];

        $referenciaSubsistema = $sub_referencia.$sub_ref;

        $nombreHoja = $sub_referencia.$sub_ref;
        $numero_ingresos = 1;
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

                $accion_proyecto = $reporte->accion_proyecto($pro_codigo);
                if($accion_proyecto){
                    foreach ($accion_proyecto as $dat_acciones) {
                        $acc_codigo = $dat_acciones['acc_codigo'];
                        $acc_referencia = $dat_acciones['acc_referencia'];
                        $acc_numero = $dat_acciones['acc_numero'];
                        $acc_descripcion = $dat_acciones['acc_descripcion'];
                        $acc_responsable = $dat_acciones['acc_responsable'];
                        $acc_proyecto = $dat_acciones['acc_proyecto'];

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('A'.$num, '')
                        ->setCellValue('B'.$num, '');

                        $num++;

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('A'.$num, '')
                        ->setCellValue('B'.$num, 'POAI');

                        $num++;

                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num)->applyFromArray($styleFuenteLetra);
                        $actividadPoai = $reportepoaietapa->actividadPoai($acc_codigo, $vigencia);
                        if($actividadPoai){
                            foreach ($actividadPoai as $dat_actvdad) {
                                $acp_codigo = $dat_actvdad['acp_codigo'];
                                $acp_referencia = $dat_actvdad['acp_referencia'];
                                $acp_numero = $dat_actvdad['acp_numero'];
                                $acp_descripcion = $dat_actvdad['acp_descripcion'];
                                $acp_sedeindicador = $dat_actvdad['acp_sedeindicador'];

                                $etapas = $reportepoaietapa->etapas($acp_codigo);
                                if($etapas){
                                    foreach ($etapas as $dat_etpas) {
                                        $poa_codigo = $dat_etpas['poa_codigo'];
                                        $poa_referencia = $dat_etpas['poa_referencia'];
                                        $poa_numero = $dat_etpas['poa_numero'];
                                        $poa_objeto = $dat_etpas['poa_objeto'];


                                        $num++;
                                    }
                                }
                            }
                        }
                    }
                }
                
            }
        }


        




        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(18);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(12);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(30);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('I')->setWidth(18);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('J')->setWidth(11);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('K')->setWidth(12);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('L')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('M')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('N')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('O')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('P')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('Q')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('R')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('S')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('T')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('U')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('V')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('W')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('X')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('Y')->setWidth(24);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('Z')->setWidth(24);

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