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
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '6284F7')
    )
);

$texto_left=array(
    'font'  => array(
        'color' => array('rgb' => '000000'),
        'size'  => 9,
        'name'  => 'Verdana'
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        //'color' => array('rgb' => 'CCD6F6')
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

$texto_center=array(
    'font'  => array(
        'color' => array('rgb' => '000000'),
        'size'  => 9,
        'name'  => 'Verdana'
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        //'color' => array('rgb' => 'CCD6F6')
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


  
$titulo_left = array(
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
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '930606')
    )
);

$titulo_center = array(
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
        'color' => array('rgb' => '930606')
    )
);

$texto_objetivo=array(
    'font'  => array(
        'color' => array('rgb' => '000000'),
        'size'  => 9,
        'name'  => 'Verdana'
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
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

$styleFuenteLeft = array(
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
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'DFDADA')
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

include('crud/rs/rsRprtePlnDsrrllo.php');

$codigo_plandesarrollo=$_REQUEST['codigo_plandesarrollo'];

$nmbre_documento = $objRprtePlnDsrrllo->nombre_documento($codigo_plandesarrollo); 

$objPHPExcel->getActiveSheet()->setTitle('Certificados');

$objRprtePlnDsrrllo->setCodigoPlanDesarrollo($codigo_plandesarrollo);
$Subsistemas=$objRprtePlnDsrrllo->subSistemasPlanDesarrollo();
$nombreNivelDos=$objRprtePlnDsrrllo->nivelDosNombre();
$nombreNivelTres=$objRprtePlnDsrrllo->nivelTresNombre();

$numero_excel=0;
$numero_registro=0;
 
if($Subsistemas){//If Subsistema
    foreach ($Subsistemas as $data_subsistema) {//Forech Subsistema
        $sub_codigo=$data_subsistema['sub_codigo'];
        $sub_nombre=$data_subsistema['sub_nombre'];
        $sub_referencia=$data_subsistema['sub_referencia'];
        $sub_ref=$data_subsistema['sub_ref'];


        $referenciaSubsistema=$sub_referencia.$sub_ref;

        $nombreHoja=$sub_referencia.$sub_ref;
        $numero_ingresos=1;
        if($numero_registro>0){
            
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

        $num=1;
        $datosPalnDesarrollo=$objRprtePlnDsrrllo->PlanDesarrolloDatos();
        $years=explode("-",$datosPalnDesarrollo);
        $yearinicio=$years[0];
        $yearfin=$years[1];

        $collCombinar=((($yearfin)-$yearinicio)*2)+4;

        $proyectosSubsistema=$objRprtePlnDsrrllo->proyectosSubsistema($sub_codigo);
        if($proyectosSubsistema){// if Proyecto
            foreach ($proyectosSubsistema as $data_proyectosSubsistema) {//Foreach Proyectos
                $pro_codigo=$data_proyectosSubsistema['pro_codigo'];
                $pro_descripcion=$data_proyectosSubsistema['pro_descripcion'];
                $pro_referencia=$data_proyectosSubsistema['pro_referencia'];
                $pro_numero=$data_proyectosSubsistema['pro_numero'];
                $pro_objetivo=$data_proyectosSubsistema['pro_objetivo'];

                if($pro_numero==0){
                    $codigo_proyecto=$referenciaSubsistema.'.'.$pro_referencia;
                }
                else{
                    $codigo_proyecto=$pro_referencia.'.'.$pro_numero;
                }
                
                $descripcion_proyecto=$codigo_proyecto.' '.$pro_descripcion;

                //Encabezado Proyecto
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, strtoupper($nombreNivelDos).':');

                $combinarBHasta=67+$collCombinar;
                $sheet->mergeCells("B".($num).":".chr($combinarBHasta).($num));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('B'.$num, $descripcion_proyecto);

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($styleFuenteLeft);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":".chr($combinarBHasta).($num))->applyFromArray($texto_left);

                $num++;

                //Objetivo
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, 'OBJETIVO:');

                $combinarBHasta=67+$collCombinar;
                $objPHPExcel->getActiveSheet()->getRowDimension($num)->setRowHeight(50);
                $sheet->mergeCells("B".($num).":".chr($combinarBHasta).($num));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('B'.$num, trim($pro_objetivo));

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($styleFuenteLeft);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":".chr($combinarBHasta).($num))->applyFromArray($texto_objetivo);

                $num++;
                //Encabezado Nivel Tres e indicadores

                $sheet->mergeCells("A".($num).":A".($num+1));
                $objPHPExcel->getActiveSheet()->getRowDimension($num)->setRowHeight(38);
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, $nombreNivelTres);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":A".($num+1))->applyFromArray($titulo_center);

                $sheet->mergeCells("B".($num).":B".($num+1));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('B'.$num, 'SEDE');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":B".($num+1))->applyFromArray($titulo_center);

                $sheet->mergeCells("C".($num).":C".($num+1));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('C'.$num, 'LÍNEA BASE');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C".($num).":C".($num+1))->applyFromArray($titulo_center);

                $sheet->mergeCells("D".($num).":D".($num+1));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('D'.$num, 'META DE RESULTADO');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("D".($num).":D".($num+1))->applyFromArray($titulo_center);

                $sheet->mergeCells("E".($num).":E".($num+1));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('E'.$num, 'DESCRIPCIÓN DE UNIDAD DE MEDIDA');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("E".($num).":E".($num+1))->applyFromArray($titulo_center);

                

                /************INICIO INDICADOR TITULO Y VIGENCIAS ******************************/
                $celdaF=70;
                for($inicioIndicadorVigencia=$yearinicio; $inicioIndicadorVigencia<=$yearfin; $inicioIndicadorVigencia++){


                    $sheet->mergeCells(chr($celdaF).($num).":".chr($celdaF+1).($num));
                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue(chr($celdaF).$num, $inicioIndicadorVigencia);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaF).($num).":".chr($celdaF+1).($num))->applyFromArray($titulo_center);
                    

                    $celdaF=$celdaF+2;
                }

                
                $num++;


                $celdaF=70;
                for($inicioIndicadorVigencia=$yearinicio; $inicioIndicadorVigencia<=$yearfin; $inicioIndicadorVigencia++){

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue(chr($celdaF).$num, 'UNIDAD');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaF).$num)->applyFromArray($titulo_center);

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue(chr($celdaF+1).$num, 'PRESUPUESTO');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaF+1).$num)->applyFromArray($titulo_center);
                    

                    $celdaF=$celdaF+2;
                } 
                /************INICIO INDICADOR TITULO Y VIGENCIAS ******************************/ 
                
                

                $num++;

                $accionProyecto=$objRprtePlnDsrrllo->accion_indicador($pro_codigo);
                if($accionProyecto){
                    foreach ($accionProyecto as $data_accionProyecto) {
                        $acc_codigo = $data_accionProyecto['acc_codigo'];
                        $acc_referencia = $data_accionProyecto['acc_referencia'];
                        $acc_descripcion = $data_accionProyecto['acc_descripcion'];
                        $acc_numero = $data_accionProyecto['acc_numero'];
                        $ind_codigo = $data_accionProyecto['ind_codigo'];
                        $ind_unidadmedida = $data_accionProyecto['ind_unidadmedida'];
                        $ind_lineabase = $data_accionProyecto['ind_lineabase'];
                        $ind_metaresultado = $data_accionProyecto['ind_metaresultado'];
                        $ind_sede = $data_accionProyecto['ind_sede'];

                        if($acc_numero == 0){
                            $codigo_accion = $referenciaSubsistema.'.'.$acc_referencia;
                        }
                        else{
                            $codigo_accion = $acc_referencia.'.'.$acc_numero;
                        }

                        $nombre_sede = $objRprtePlnDsrrllo->nombre_sede($ind_sede);

                        $descripcion_accion=$codigo_accion.'. '.$acc_descripcion;
                        
                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('A'.$num, $descripcion_accion);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($texto_left);

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('B'.$num, $nombre_sede);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->applyFromArray($texto_left);
                    

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('C'.$num, $ind_lineabase);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($colorHojaRight);

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('D'.$num, $ind_metaresultado);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->applyFromArray($colorHojaRight);

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('E'.$num, $ind_unidadmedida);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num)->applyFromArray($texto_center);
                        


                        //************************ Inicio ********************* 

                        $celdaF=70;
                        for($inicioIndicadorVigencia=$yearinicio; $inicioIndicadorVigencia<=$yearfin; $inicioIndicadorVigencia++){
                
                            if($ind_codigo==0){
                                $unidad='';
                                $presupuesto='';
                            }
                            else{
                            $datosIndicadorVigencia=$objRprtePlnDsrrllo->indicadorVigencia($ind_codigo, $inicioIndicadorVigencia);
                                $indicadorVigencia=explode("-",$datosIndicadorVigencia);
                                $unidad=$indicadorVigencia[0];
                                $presupuesto=$indicadorVigencia[1];
                            }

                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue(chr($celdaF).$num, $unidad);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaF).$num)->applyFromArray($colorHojaRight);
                
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue(chr($celdaF+1).$num, $presupuesto);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaF+1).$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaF+1).$num)->applyFromArray($colorHojaRight);
                            
                
                            $celdaF=$celdaF+2;
                        }

                        //************************Fin **************************
                        $num++;
                    }
                }
                else{

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('A'.$num, '');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($titulo_left);

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('B'.$num, '');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->applyFromArray($texto_center);

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('C'.$num, '');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($texto_center);

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('D'.$num, '');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->applyFromArray($texto_center);

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('E'.$num, '');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num)->applyFromArray($texto_center);


                    /************************ Inicio ********************* */

                    $celdaF=70;
                    for($inicioIndicadorVigencia=$yearinicio; $inicioIndicadorVigencia<=$yearfin; $inicioIndicadorVigencia++){

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue(chr($celdaF).$num, '');
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaF).$num)->applyFromArray($colorHojaRight);

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue(chr($celdaF+1).$num, '');
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaF+1).$num)->applyFromArray($colorHojaRight);
                        

                        $celdaF=$celdaF+2;
                    }
                    $num++;

                }

                $sheet->mergeCells("A".($num).":B".($num));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, 'RUBRO PRESUPUESTAL PLANEACIÓN');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":B".($num))->applyFromArray($titulo_center);

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('C'.$num, '');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($texto_center);

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('D'.$num, '');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->applyFromArray($texto_center);

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('E'.$num, '');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num)->applyFromArray($texto_center);

                //************************ Inicio Suma Rubros ********************* 

                $celdaF=70;
                for($inicioIndicadorVigencia=$yearinicio; $inicioIndicadorVigencia<=$yearfin; $inicioIndicadorVigencia++){

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue(chr($celdaF).$num, '');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaF).$num)->applyFromArray($colorHojaRight);

                    $valorProyectoVigencia=$objRprtePlnDsrrllo->valorProyectoVigencia($pro_codigo,$inicioIndicadorVigencia);
                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue(chr($celdaF+1).$num, $valorProyectoVigencia);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaF+1).$num)->applyFromArray($colorHojaRight);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaF+1).$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);

                    $celdaF=$celdaF+2;
                
                }

                $num++;

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, '')
                ->setCellValue('B'.$num, '')
                ->setCellValue('C'.$num, '')
                ->setCellValue('D'.$num, '')
                ->setCellValue('E'.$num, '');


                /************************ Inicio ********************* */

                $celdaF=70;
                for($inicioIndicadorVigencia=$yearinicio; $inicioIndicadorVigencia<=$yearfin; $inicioIndicadorVigencia++){

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue(chr($celdaF).$num, '')
                    ->setCellValue(chr($celdaF+1).$num, '');
                    

                    $celdaF=$celdaF+2;
                }
                $num++;




            }//Forech Proyecto
        
        }//fin If

        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(40);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(18);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(13);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(18);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(28);

        //TAMAÑOS CELDAS
        $celdaF=70;
        for($inicioIndicadorVigencia=$yearinicio; $inicioIndicadorVigencia<=$yearfin; $inicioIndicadorVigencia++){

            $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension(chr($celdaF))->setWidth(18);
            $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension(chr($celdaF+1))->setWidth(28);
            
            $celdaF=$celdaF+2;
        }

        /*$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(12);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(22);*/

        $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(40);

        $numero_registro++;
    }//Cierre Foreach Subsistema
}//Cierre if subsistemas






    // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
    $objPHPExcel->setActiveSheetIndex(0);



    // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nmbre_documento.'"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    // incluir o gráfico no ficheiro que vamos gerar
    $objWriter->setIncludeCharts(TRUE);
    ob_end_clean();
    $objWriter->save('php://output');
    exit;

?>
