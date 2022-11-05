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
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
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



$titulo_left = array(
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
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
    )
);

$titulo_center = array(
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
    )
);

function tildes($palabra){
    $no_admitidas = array("á","é","í","ó","ú");
    $admitidas = array("Á", "É", "Í", "Ó", "Ú");
    $texto = str_replace($no_admitidas, $admitidas ,$palabra);
    return $texto;
}

$codigo_plandesarrollo=$_REQUEST['codigo_planDesarrollo'];
include('crud/rs/rprtePlanCcionRspnsble.php');

$numero_excel=0;
$numero_registro=0;

$Subsistemas = $objRprte->list_subsistemas($codigo_plandesarrollo);

if($Subsistemas){//If Subsistema
    foreach ($Subsistemas as $data_subsistema) {//Forech Subsistema
        $sub_codigo = $data_subsistema['sub_codigo'];
        $sub_nombre = $data_subsistema['sub_nombre'];
        $sub_referencia = $data_subsistema['sub_referencia'];
        $sub_ref = $data_subsistema['sub_ref'];


        $referenciaSubsistema = $sub_referencia.$sub_ref;

        $nombreHoja = $sub_referencia.$sub_ref;
        $numero_ingresos = 1;
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

        $nombreNivelTres = $objRprte->nombreNivelTres($codigo_plandesarrollo);

        $nombreNivelDos = $objRprte->nombreNivelDos($codigo_plandesarrollo);

        $list_proyecto = $objRprte->proyecto_subsistema($codigo_plandesarrollo, $sub_codigo);

        $num=1;

        if($list_proyecto){
            foreach ($list_proyecto as $dta_list_proyecto){
                $pro_codigo = $dta_list_proyecto['pro_codigo'];
                $pro_descripcion = $dta_list_proyecto['pro_descripcion'];
                $pro_referencia = $dta_list_proyecto['pro_referencia'];
                $pro_numero = $dta_list_proyecto['pro_numero'];
                $pro_objetivo = $dta_list_proyecto['pro_objetivo'];

                if($codigo_plandesarrollo == 1){
                    $referencia_proyectos = $sub_referencia.".".$pro_referencia;
                }
                else{
                    $referencia_proyectos = $pro_referencia.".".$pro_numero;
                }

                $descripcion_proyecto = $referencia_proyectos." ".$pro_descripcion;

                $objetivo_proyecto = "OBJETIVO: ".$pro_objetivo;

                $sheet->mergeCells("A".($num).":A".($num+1));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, strtoupper(tildes($nombreNivelDos)).':');

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":A".($num+1))->applyFromArray($titulo_left);

                $sheet->mergeCells("B".($num).":J".($num));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('B'.$num, $descripcion_proyecto);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":J".($num))->applyFromArray($texto_left);

                $num++;

                $sheet->mergeCells("B".($num).":J".($num));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('B'.$num, $objetivo_proyecto);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":J".($num))->applyFromArray($texto_left);

                $num++;

                $accion_proyecto = $objRprte->accion_proyecto($sub_codigo, $pro_codigo);

                if($accion_proyecto){
                    foreach ($accion_proyecto as $dta_accion_proyecto) {
                        $acc_codigo=$dta_accion_proyecto['acc_codigo'];
                        $acc_referencia=$dta_accion_proyecto['acc_referencia'];
                        $acc_descripcion=$dta_accion_proyecto['acc_descripcion'];
                        $acc_numero=$dta_accion_proyecto['acc_numero'];

                        if($acc_numero==0){
                            $codigo_nivelTres=$referenciaSubsistema.'.'.$pro_referencia;
                        }
                        else{
                            $codigo_nivelTres=$acc_referencia.'.'.$acc_numero;
                        }
                
                        $descripcion_nivelTres=$codigo_nivelTres.' '.$acc_descripcion;
                
                        //Encabezado Accion
                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('A'.$num, strtoupper(tildes($nombreNivelTres)).':');
                
                        $sheet->mergeCells("B".($num).":J".($num));
                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('B'.$num, $descripcion_nivelTres);
                
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($titulo_left);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":J".($num))->applyFromArray($texto_left);

                        $num++;
                    
                        $actividadPoai=$objRprte->actividadPoai($acc_codigo);
                        if($actividadPoai){
                            foreach($actividadPoai as $data_actividadPoai){
                                $acp_codigo = $data_actividadPoai['acp_codigo'];
                                $acp_referencia = $data_actividadPoai['acp_referencia'];
                                $acp_numero = $data_actividadPoai['acp_numero'];
                                $acp_descripcion = $data_actividadPoai['acp_descripcion'];
                                $acp_oficina = $data_actividadPoai['acp_oficina'];
                                $acp_cargo = $data_actividadPoai['acp_cargo'];
                
                                if($acp_oficina){
                                    $nombre_oficina = $objRprte->nombre_oficina($acp_oficina);
                                }
                
                                $oficina = "Oficina: ".$nombre_oficina;
                
                                if($acp_cargo){
                                    $nombre_cargo = $objRprte->nombre_cargo($acp_cargo);
                                }
                
                                $cargo = "Responsable: ".$nombre_cargo;
                
                                $rsponsable = $oficina."\n".$cargo;

                                $actividadDescripcionPoai=$acp_referencia.'.'.$acp_numero.' '.$acp_descripcion;

                                //Encabezado Actividad
                                $objPHPExcel->setActiveSheetIndex($numero_registro)
                                ->setCellValue('A'.$num, 'Actividad')
                                ->setCellValue('B'.$num, 'Etapa')
                                ->setCellValue('C'.$num, 'Recursos')
                                ->setCellValue('D'.$num, 'Vigencia')
                                ->setCellValue('E'.$num, 'Peso de la Etapa %')
                                ->setCellValue('F'.$num, 'Avance inicial de la Etapa %')
                                ->setCellValue('G'.$num, 'Responsable')
                                ->setCellValue('H'.$num, 'Codigo Presupuestal')
                                ->setCellValue('I'.$num, 'Descripción Codigo Presupuestal')
                                ->setCellValue('J'.$num, 'DANE');

                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($titulo_center);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->applyFromArray($titulo_center);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registroActividad)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($titulo_center);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->applyFromArray($titulo_center);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num)->applyFromArray($titulo_center);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num)->applyFromArray($titulo_center);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num)->applyFromArray($titulo_center);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num)->applyFromArray($titulo_center);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num)->applyFromArray($titulo_center);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('J'.$num)->applyFromArray($titulo_center);
                            

                                $num++;

                                //Encabezado Cuerpo
                                $cantidadActividaddes=$objRprte->cantidadCombinar($acp_codigo);
                                if($cantidadActividaddes==1 || $cantidadActividaddes==0){
                                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                                    ->setCellValue('A'.$num, $actividadDescripcionPoai);

                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($texto_left);
                                }
                                else{
                                    $sheet->mergeCells("A".($num).":A".($num+$cantidadActividaddes-1));
                                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                                    ->setCellValue('A'.$num, $actividadDescripcionPoai);
                                    
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":A".($num+$cantidadActividaddes))->applyFromArray($texto_left);
                                }
                                //Etapas Actividad
                                $etapas=$objRprte->etapas($acp_codigo);
                                if($etapas){
                                    foreach ($etapas as $data_etapas) {
                                        $poa_codigo = $data_etapas['poa_codigo'];
                                        $poa_referencia = $data_etapas['poa_referencia'];
                                        $poa_objeto = $data_etapas['poa_objeto'];
                                        $poa_recurso = $data_etapas['poa_recurso'];
                                        $poa_logro = $data_etapas['poa_logro'];
                                        $poa_numero = $data_etapas['poa_numero'];
                                        $poa_vigencia = $data_etapas['poa_vigencia'];
                                        $poa_logroejecutado = $data_etapas['poa_logroejecutado'];
                                        $avance_esperado = $data_etapas['avance_esperado'];
                                        $poa_personacreo = $data_etapas['poa_personacreo'];
                                        $poa_codigoclasificadorpresupuestal = $data_etapas['poa_codigoclasificadorpresupuestal'];
                                        $poa_dane = $data_etapas['poa_dane'];
                                        $poa_descripcionclasificador = $data_etapas['poa_descripcionclasificador'];

                                        /*if($poa_codigoclasificadorpresupuestal){
                                            list($codigo_pre, $descripicion_codigo) = $objtReportePlanAccion->codigo_presupuestal($poa_codigoclasificadorpresupuestal);
                                        }
                                        else{
                                            $codigo_pre = "";
                                            $descripicion_codigo = "";
                                        }*/

                                        $codigo_pre = $poa_codigoclasificadorpresupuestal;
                                        $descripicion_codigo = $poa_descripcionclasificador;
                                        

                                        $etapa_descripcion=$poa_referencia.'.'.$poa_numero.' '.$poa_objeto;

                                        $avanceInicial=$poa_logroejecutado.'=>'.$avance_esperado/100;

                                        //$encargadoEtapa=$objRprte->responsable_etapa($poa_personacreo);
                                    
                                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                                        ->setCellValue('B'.$num, $etapa_descripcion)
                                        ->setCellValue('C'.$num, $poa_recurso)
                                        ->setCellValue('D'.$num, $poa_vigencia)
                                        ->setCellValue('E'.$num, $poa_logro)
                                        ->setCellValue('F'.$num, $avanceInicial)
                                        ->setCellValue('G'.$num, $rsponsable)
                                        ->setCellValueExplicit('H'.$num, $codigo_pre,PHPExcel_Cell_DataType::TYPE_STRING)
                                        ->setCellValue('I'.$num, $descripicion_codigo)
                                        ->setCellValue('J'.$num, $poa_dane);

                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->applyFromArray($texto_left);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($texto_center);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->applyFromArray($texto_center);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num)->applyFromArray($texto_center);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num)->applyFromArray($texto_center);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num)->applyFromArray($texto_center);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num)->applyFromArray($texto_center);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num)->applyFromArray($texto_center);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('J'.$num)->applyFromArray($texto_center);
                                
                                        $num++;
                                    }
                                
                                }
                                else{
                                    $sheet->mergeCells("B".($num).":J".($num));
                                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                                    ->setCellValue('B'.$num, 'No hay Etapas');

                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":J".($num))->applyFromArray($texto_left);
                                    $num++;
                                }
                            }
                        }
                        else{
                            $sheet->mergeCells("A".($num).":J".($num));
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('A'.$num, 'No hay Actividades');

                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":J".($num))->applyFromArray($texto_left);
                            $num++;
                        }
                    }
                }
                else{
                    $sheet->mergeCells("A".($num).":J".($num));
                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('A'.$num, 'No hay Registros');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":J".($num))->applyFromArray($texto_left);

                    $num++;
                }



            }
        }

        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(43);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(40);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(18);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(30);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(80);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setWidth(35);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('I')->setWidth(65);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('J')->setWidth(28);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('K')->setWidth(12);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('M')->setWidth(12);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('O')->setWidth(12);
        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('P')->setWidth(20);

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
