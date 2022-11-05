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
      //'bold'  => true,
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
      'wrap' => true
    )
  );

  $texto_center=array(
    'font'  => array(
      //'bold'  => true,
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
      //'color' => array('rgb' => '6284F7')
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
        'wrap' => true
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      //'color' => array('rgb' => '6284F7')
    )
  );

  
  $texto_objetivo=array(
    'font'  => array(
      //'bold'  => true,
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

            $collCombinar=((($yearfin)-$yearinicio))+2;

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

            $combinarBHasta=66+$collCombinar;
            $sheet->mergeCells("B".($num).":".chr($combinarBHasta).($num));
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('B'.$num, $descripcion_proyecto);

            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($titulo_left);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":".chr($combinarBHasta).($num))->applyFromArray($texto_left);

            $num++;

            //Objetivo
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('A'.$num, 'OBJETIVO:');

            $combinarBHasta=66+$collCombinar;
            $objPHPExcel->getActiveSheet()->getRowDimension($num)->setRowHeight(50);
            $sheet->mergeCells("B".($num).":".chr($combinarBHasta).($num));
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('B'.$num, trim($pro_objetivo));

            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($titulo_left);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":".chr($combinarBHasta).($num))->applyFromArray($texto_objetivo);

            $num++;
            //Encabezado Nivel Tres e indicadores

            $sheet->mergeCells("A".($num).":A".($num+1));
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('A'.$num, $nombreNivelTres);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":A".($num+1))->applyFromArray($titulo_center);

            $sheet->mergeCells("B".($num).":B".($num+1));
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('B'.$num, 'LÍNEA BASE');
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":B".($num+1))->applyFromArray($titulo_center);

            $sheet->mergeCells("C".($num).":C".($num+1));
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('C'.$num, 'META DE RESULTADO');
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C".($num).":C".($num+1))->applyFromArray($titulo_center);

            

            /************INICIO INDICADOR ******************************/
            $celdaD=68;
            for($inicioIndicadorVigencia=$yearinicio; $inicioIndicadorVigencia<=$yearfin; $inicioIndicadorVigencia++){


                /*$sheet->mergeCells(chr($celdaD).($num).":".chr($celdaD+1).($num));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue(chr($celdaD).$num, $inicioIndicadorVigencia);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaD).($num).":".chr($celdaD+1).($num))->applyFromArray($titulo_center);*/

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue(chr($celdaD).$num, $inicioIndicadorVigencia);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaD).$num)->applyFromArray($titulo_center);
                

                $celdaD++;
            }

          
            $num++;


            $celdaD=68;
            for($inicioIndicadorVigencia=$yearinicio; $inicioIndicadorVigencia<=$yearfin; $inicioIndicadorVigencia++){

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue(chr($celdaD).$num, '');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaD).$num)->applyFromArray($titulo_center);

                /*$objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue(chr($celdaD+1).$num, 'PRESUPUESTO');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaD+1).$num)->applyFromArray($titulo_center);*/
                

                $celdaD++;
            }  
         
          

            $num++;

            $accionProyecto=$objRprtePlnDsrrllo->accionProyecto($pro_codigo);
            if($accionProyecto){
                foreach ($accionProyecto as $data_accionProyecto) {
                    $acc_codigo = $data_accionProyecto['acc_codigo'];
                    $acc_referencia = $data_accionProyecto['acc_referencia'];
                    $acc_descripcion = $data_accionProyecto['acc_descripcion'];
                    $acc_numero = $data_accionProyecto['acc_numero'];
                    $acc_lineabase = $data_accionProyecto['acc_lineabase'];
                    $acc_metaresultado = $data_accionProyecto['acc_metaresultado'];

                    if($acc_numero==0){
                        $codigo_accion=$referenciaSubsistema.'.'.$acc_referencia;
                    }
                    else{
                        $codigo_accion=$acc_referencia.'.'.$acc_numero;
                    }

                    $descripcion_accion=$codigo_accion.'. '.$acc_descripcion;
                    
                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('A'.$num, $descripcion_accion);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($texto_left);
                    
                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('B'.$num, $acc_lineabase);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->applyFromArray($texto_center);

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('C'.$num, $acc_metaresultado);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($texto_center);



                    /************************ Inicio ********************* */

                    $celdaD=68;
                    for($inicioIndicadorVigencia=$yearinicio; $inicioIndicadorVigencia<=$yearfin; $inicioIndicadorVigencia++){
            
                        $valor_vigencia_accion = $objRprtePlnDsrrllo->valor_vigencia_accion($acc_codigo, $inicioIndicadorVigencia);

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue(chr($celdaD).$num, $valor_vigencia_accion);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaD).$num)->applyFromArray($texto_center);
            
                        /*$objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue(chr($celdaD+1).$num, $presupuesto);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaD+1).$num)->applyFromArray($texto_center);*/
                        
            
                        $celdaD++;
                    }

                    /*************************Fin ***************************/
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


                /************************ Inicio ********************* */

                $celdaD=68;
                for($inicioIndicadorVigencia=$yearinicio; $inicioIndicadorVigencia<=$yearfin; $inicioIndicadorVigencia++){

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue(chr($celdaD).$num, '');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaD).$num)->applyFromArray($titulo_center);

                    /*$objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue(chr($celdaD+1).$num, '');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaD+1).$num)->applyFromArray($titulo_center);*/
                    

                    $celdaD++;
                }
                $num++;

            }

            $sheet->mergeCells("A".($num).":B".($num));
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('A'.$num, 'RUBRO PRESUPUESTAL');
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":B".($num))->applyFromArray($titulo_center);

            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('C'.$num, '');
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($texto_center);


            /************************ Inicio ********************* */

            $celdaD=68;
            for($inicioIndicadorVigencia=$yearinicio; $inicioIndicadorVigencia<=$yearfin; $inicioIndicadorVigencia++){

              $valor_proyecto_plan_antiguo= $objRprtePlnDsrrllo->valor_proyecto_plan_antiguo($pro_codigo, $inicioIndicadorVigencia);
              
              $objPHPExcel->setActiveSheetIndex($numero_registro)
              ->setCellValue(chr($celdaD).$num, $valor_proyecto_plan_antiguo);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaD).$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaD).$num)->applyFromArray($texto_center);

              /*$valorProyectoVigencia=$objRprtePlnDsrrllo->valorProyectoVigencia($pro_codigo,$inicioIndicadorVigencia);
              $objPHPExcel->setActiveSheetIndex($numero_registro)
              ->setCellValue(chr($celdaD+1).$num, $valorProyectoVigencia);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle(chr($celdaD+1).$num)->applyFromArray($texto_center);*/
              

              $celdaD++;

                
            }

            $num++;

        }//Forech Proyecto
      
      }//fin If

      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(40);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(13);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(15);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(20);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(20);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(20);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(20);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setWidth(20);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('I')->setWidth(20);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('J')->setWidth(20);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('K')->setWidth(20);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('L')->setWidth(20);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('M')->setWidth(20);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('N')->setWidth(20);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('O')->setWidth(20);
      $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('P')->setWidth(20);

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
