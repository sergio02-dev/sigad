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


$codigo_plandesarrollo=$_REQUEST['codigo_planDesarrollo'];
include('crud/rs/rsRprtePlnCcion.php');

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

    $nombreNivelTres=$objtReportePlanAccion->nombreNivelTres($codigo_plandesarrollo);

    $num=1;
    $accionSubsistema=$objtReportePlanAccion->accionSubsistema($sub_codigo);
    if($accionSubsistema){// if Proyecto
      foreach ($accionSubsistema as $data_accionSubsistema) {//Foreach Proyectos
        $acc_codigo=$data_accionSubsistema['acc_codigo'];
        $acc_referencia=$data_accionSubsistema['acc_referencia'];
        $acc_descripcion=$data_accionSubsistema['acc_descripcion'];
        $acc_numero=$data_accionSubsistema['acc_numero'];

        if($acc_numero==0){
          $codigo_nivelTres=$referenciaSubsistema.'.'.$pro_referencia;
        }
        else{
          $codigo_nivelTres=$acc_referencia.'.'.$acc_numero;
        }
        
        $descripcion_nivelTres=$codigo_nivelTres.' '.$acc_descripcion;

        //Encabezado Accion
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('A'.$num, strtoupper($nombreNivelTres).':');

        $sheet->mergeCells("B".($num).":F".($num));
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('B'.$num, $descripcion_nivelTres)
        ->setCellValue('G'.$num, '');

        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($titulo_left);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":F".($num))->applyFromArray($texto_left);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num)->applyFromArray($titulo_center);

        $num++;
        
        $actividadPoai=$objtReportePlanAccion->actividadPoai($acc_codigo);
        if($actividadPoai){
          foreach($actividadPoai as $data_actividadPoai){
            $acp_codigo=$data_actividadPoai['acp_codigo'];
            $acp_referencia=$data_actividadPoai['acp_referencia'];
            $acp_numero=$data_actividadPoai['acp_numero'];
            $acp_descripcion=$data_actividadPoai['acp_descripcion'];

            $actividadDescripcionPoai=$acp_referencia.'.'.$acp_numero.' '.$acp_descripcion;

            //Encabezado Actividad
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('A'.$num, 'Actividad')
            ->setCellValue('B'.$num, 'Etapa')
            ->setCellValue('C'.$num, 'Recursos')
            ->setCellValue('D'.$num, 'Vigencia')
            ->setCellValue('E'.$num, 'Peso de la Etapa %')
            ->setCellValue('F'.$num, 'Avance inicial de la Etapa %')
            ->setCellValue('G'.$num, 'Responsable');

            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($titulo_center);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->applyFromArray($titulo_center);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registroActividad)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($titulo_center);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->applyFromArray($titulo_center);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num)->applyFromArray($titulo_center);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num)->applyFromArray($titulo_center);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num)->applyFromArray($titulo_center);
         

            $num++;

            //Encabezado Cuerpo
            $cantidadActividaddes=$objtReportePlanAccion->cantidadCombinar($acp_codigo);
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
            $etapas=$objtReportePlanAccion->etapas($acp_codigo);
            if($etapas){
              foreach ($etapas as $data_etapas) {
                $poa_codigo=$data_etapas['poa_codigo'];
                $poa_referencia=$data_etapas['poa_referencia'];
                $poa_objeto=$data_etapas['poa_objeto'];
                $poa_recurso=$data_etapas['poa_recurso'];
                $poa_logro=$data_etapas['poa_logro'];
                $poa_numero=$data_etapas['poa_numero'];
                $poa_vigencia=$data_etapas['poa_vigencia'];
                $poa_logroejecutado=$data_etapas['poa_logroejecutado'];
                $avance_esperado=$data_etapas['avance_esperado'];
                $poa_personacreo=$data_etapas['poa_personacreo'];

                $etapa_descripcion=$poa_referencia.'.'.$poa_numero.' '.$poa_objeto;

                $avanceInicial=$poa_logroejecutado.'=>'.$avance_esperado/100;

                $encargadoEtapa=$objtReportePlanAccion->responsable_etapa($poa_personacreo);
              
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('B'.$num, $etapa_descripcion)
                ->setCellValue('C'.$num, $poa_recurso)
                ->setCellValue('D'.$num, $poa_vigencia)
                ->setCellValue('E'.$num, $poa_logro)
                ->setCellValue('F'.$num, $avanceInicial)
                ->setCellValue('G'.$num, $encargadoEtapa);

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->applyFromArray($texto_left);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($texto_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->applyFromArray($texto_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num)->applyFromArray($texto_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num)->applyFromArray($texto_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num)->applyFromArray($texto_center);
          
                $num++;
              }
              
            }
            else{
              $sheet->mergeCells("B".($num).":G".($num));
              $objPHPExcel->setActiveSheetIndex($numero_registro)
              ->setCellValue('B'.$num, 'No hay Etapas');

              $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":G".($num))->applyFromArray($texto_left);
              $num++;
            }
          }
        }
        else{
          $sheet->mergeCells("A".($num).":G".($num));
          $objPHPExcel->setActiveSheetIndex($numero_registro)
          ->setCellValue('A'.$num, 'No hay Actividades');

          $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":G".($num))->applyFromArray($texto_left);
          $num++;
        }
    


      }//Forech Proyecto
    
    }//fin If

    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(43);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(40);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(18);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(30);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(35);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setWidth(20);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('I')->setWidth(12);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('J')->setWidth(20);
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
