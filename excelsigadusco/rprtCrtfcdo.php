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
->setTitle("Certificados")
->setSubject("Certificados")
->setDescription("Certificados")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Certificados");

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
  $colorHoja=array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'CCD6F6')
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

  $texto_actividad=array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'CCD6F6')
    ),
    'borders' => array(
      'outline' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN,
        'color' => array('rgb' => '000000')
      )
    ),
    'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY,
      'wrap' => true
    )
  );

  
  
  $numero_registro=0;
  $numero_excel=0;
  $numero_ingresos=1;
  $objPHPExcel->createSheet();
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet()->setTitle('CERTIFICADOS');
 

  $sheet = $objPHPExcel->getActiveSheet();
  $sheet->getPageMargins()->setTop(0.6);
  $sheet->getPageMargins()->setBottom(0.6);
  $sheet->getPageMargins()->setHeader(0.4);
  $sheet->getPageMargins()->setFooter(0.4);
  $sheet->getPageMargins()->setLeft(0.4);
  $sheet->getPageMargins()->setRight(0.4);

  // INICIO Filas titulos
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A1', '# CERTIFICADO')
  ->setCellValue('B1', 'F. EXPEDICIÓN')
  ->setCellValue('C1', 'VALOR')
  ->setCellValue('D1', 'CÓDIGO ACCIÓN')
  ->setCellValue('E1', 'ACTIVIDAD');

  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E1')->applyFromArray($styleFuenteLetra);
  //inicio foreach

  include('crud/rs/rprte_sbsstema.php');

  $num_registro=2;
  $id_registro=1;

  $plan_desarrollo = $_REQUEST['plan_desarrollo'];
  $vigencia = $_REQUEST['vigencia'];

  $lista_todos_certificados=$objRsrprteSbstma->lista_todos_certificados($plan_desarrollo, $vigencia);
  if($lista_todos_certificados){
    
    foreach ($lista_todos_certificados as $data_listado_certificados){
      $act_codigo = $data_listado_certificados['act_codigo'];
      $sub_codigo = $data_listado_certificados['sub_codigo'];
      $sub_nombre = $data_listado_certificados['sub_nombre'];
      $pde_codigo = $data_listado_certificados['pde_codigo'];
      $sub_referencia = $data_listado_certificados['sub_referencia'];
      $sub_ref = $data_listado_certificados['sub_ref'];
      $pro_codigo = $data_listado_certificados['pro_codigo'];
      $pro_referencia = $data_listado_certificados['pro_referencia'];
      $pro_numero = $data_listado_certificados['pro_numero'];
      $acc_codigo = $data_listado_certificados['acc_codigo'];
      $acc_referencia = $data_listado_certificados['acc_referencia'];
      $acc_numero = $data_listado_certificados['acc_numero'];
      $act_referencia = $data_listado_certificados['act_referencia'];
      $act_descripcion = $data_listado_certificados['act_descripcion'];
      $act_fechaexpedicion = $data_listado_certificados['act_fechaexpedicion'];
      $act_certificado = $data_listado_certificados['act_certificado'];
      $aco_valor = $data_listado_certificados['aco_valor'];
      $act_vigencia = $data_listado_certificados['act_vigencia'];
      $act_accion = $data_listado_certificados['act_accion'];

      if($pde_codigo == 1){
        $act_descripcion = $act_referencia." ".$act_descripcion;
        $ref_mostrar = $objRsrprteSbstma->referencias_accion_plan_old($act_accion);
      }
      else{
        $actividades_certificado = $objRsrprteSbstma->actividades_certificado($act_codigo);
        $ref_mostrar = $objRsrprteSbstma->referencias_accion_plan_new($act_accion);

        if($actividades_certificado){
          $act_descripcion = "";
          foreach ($actividades_certificado as $dta_actividades_certificado) {
            $cee_actividad = $dta_actividades_certificado['cee_actividad'];
            $acp_descripcion = $dta_actividades_certificado['acp_descripcion'];
            $acp_referencia = $dta_actividades_certificado['acp_referencia'];
            $acp_numero = $dta_actividades_certificado['acp_numero'];

            $descrpcionActividadCompleta = $acp_referencia.".".$acp_numero." ".$acp_descripcion;

            $etapas = $objRsrprteSbstma->etapas_actividades($cee_actividad, $act_codigo);

            if($etapas){
              $ett  = "";
              foreach ($etapas as $dtaEptas) {
                $poa_codigo = $dtaEptas['poa_codigo'];
                $poa_referencia = $dtaEptas['poa_referencia'];
                $poa_objeto = $dtaEptas['poa_objeto'];
                $poa_numero = $dtaEptas['poa_numero'];
                $poa_recurso = $dtaEptas['poa_recurso'];

                $despEtapaCompleta = "  ".$poa_referencia.".".$poa_numero." ".$poa_objeto."  $".number_format($poa_recurso,0,'','.');

                $ett = $ett.$despEtapaCompleta."\n";
              }
            }
            $act_descripcion = $act_descripcion.$descrpcionActividadCompleta."\n".$ett."\n";
                  
          }
        }
      }

      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValue('A'.$num_registro, $act_certificado)
      ->setCellValue('B'.$num_registro, substr($act_fechaexpedicion,0,10))
      ->setCellValue('C'.$num_registro, $aco_valor)
      ->setCellValue('D'.$num_registro, $ref_mostrar)
      ->setCellValue('E'.$num_registro, $act_descripcion);

      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($texto_actividad);


      $num_registro++;
      $id_registro++;
    }
      
  }
  $num_registro=$num_registro;



  // Fin de Registros //


  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(20);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(90);
  $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);

  /********************** Hoja Uno *********************************/

  /********************** Hoja Dos *********************************/
  $numero_registro=1;
  //$objPHPExcel->createSheet();
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet()->setTitle('CERTIFICADOS ETAPAS');

  $sheet = $objPHPExcel->getActiveSheet();
  $sheet->getPageMargins()->setTop(0.6);
  $sheet->getPageMargins()->setBottom(0.6);
  $sheet->getPageMargins()->setHeader(0.4);
  $sheet->getPageMargins()->setFooter(0.4);
  $sheet->getPageMargins()->setLeft(0.4);
  $sheet->getPageMargins()->setRight(0.4);

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
  $colorHoja=array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'CCD6F6')
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

  $texto_actividad=array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'CCD6F6')
    ),
    'borders' => array(
      'outline' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN,
        'color' => array('rgb' => '000000')
      )
    ),
    'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY,
      'wrap' => true
    )
  );

  // INICIO Filas titulos
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A1', '# CERTIFICADO')
  ->setCellValue('B1', 'F. EXPEDICIÓN')
  ->setCellValue('C1', 'VALOR')
  ->setCellValue('D1', 'CÓDIGO ACCIÓN')
  ->setCellValue('E1', 'ACTIVIDAD')
  ->setCellValue('F1', 'ETAPA')
  ->setCellValue('G1', 'VALOR ETAPA');

  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G1')->applyFromArray($styleFuenteLetra);
  //inicio foreach

  $lista_tods_certificados_etapa = $objRsrprteSbstma->lista_tods_certificados_etapa($plan_desarrollo, $vigencia);
  $num_registro=2;
  $id_registro=1;
  if($lista_tods_certificados_etapa){
    foreach ($lista_tods_certificados_etapa as $data_lista_tdos_certificados_etapa) {
      $act_codigo = $data_lista_tdos_certificados_etapa['act_codigo'];
      $sub_codigo = $data_lista_tdos_certificados_etapa['sub_codigo'];
      $sub_nombre = $data_lista_tdos_certificados_etapa['sub_nombre'];
      $pde_codigo = $data_lista_tdos_certificados_etapa['pde_codigo'];
      $sub_referencia = $data_lista_tdos_certificados_etapa['sub_referencia'];
      $sub_ref = $data_lista_tdos_certificados_etapa['sub_ref'];
      $pro_codigo = $data_lista_tdos_certificados_etapa['pro_codigo'];
      $pro_referencia = $data_lista_tdos_certificados_etapa['pro_referencia'];
      $pro_numero = $data_lista_tdos_certificados_etapa['pro_numero'];
      $acc_codigo = $data_lista_tdos_certificados_etapa['acc_codigo'];
      $acc_referencia = $data_lista_tdos_certificados_etapa['acc_referencia'];
      $acc_numero = $data_lista_tdos_certificados_etapa['acc_numero'];
      $act_referencia = $data_lista_tdos_certificados_etapa['act_referencia'];
      $act_descripcion = $data_lista_tdos_certificados_etapa['act_descripcion'];
      $act_fechaexpedicion = $data_lista_tdos_certificados_etapa['act_fechaexpedicion'];
      $act_certificado = $data_lista_tdos_certificados_etapa['act_certificado'];
      $aco_valor = $data_lista_tdos_certificados_etapa['aco_valor'];
      $act_vigencia = $data_lista_tdos_certificados_etapa['act_vigencia'];
      $act_accion = $data_lista_tdos_certificados_etapa['act_accion'];
      $acp_referencia = $data_lista_tdos_certificados_etapa['acp_referencia'];
      $acp_numero = $data_lista_tdos_certificados_etapa['acp_numero']; 
      $acp_descripcion = $data_lista_tdos_certificados_etapa['acp_descripcion'];
      $poa_referencia = $data_lista_tdos_certificados_etapa['poa_referencia'];
      $poa_numero = $data_lista_tdos_certificados_etapa['poa_numero'];
      $poa_objeto = $data_lista_tdos_certificados_etapa['poa_objeto'];
      $poa_recurso = $data_lista_tdos_certificados_etapa['poa_recurso'];
      

      if($pde_codigo == 1){
        $act_descripcion = $act_referencia." ".$act_descripcion;
        $ref_mostrar = $objRsrprteSbstma->referencias_accion_plan_old($act_accion);
        $nombre_etpa = "";
        $valor_etpa = "";
      }
      else{
        $act_descripcion = $acp_referencia.".".$acp_numero." ".$acp_descripcion;
        $ref_mostrar = $objRsrprteSbstma->referencias_accion_plan_new($act_accion);
        $nombre_etpa = $poa_referencia.".".$poa_numero." ".$poa_objeto;
        $valor_etpa = $poa_recurso;
      }

      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValue('A'.$num_registro, $act_certificado)
      ->setCellValue('B'.$num_registro, substr($act_fechaexpedicion,0,10))
      ->setCellValue('C'.$num_registro, $aco_valor)
      ->setCellValue('D'.$num_registro, $ref_mostrar)
      ->setCellValue('E'.$num_registro, $act_descripcion)
      ->setCellValue('F'.$num_registro, $nombre_etpa)
      ->setCellValue('G'.$num_registro, $valor_etpa);

      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($texto_actividad);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registro)->applyFromArray($texto_actividad);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->applyFromArray($colorHoja);

      $num_registro++;
      $id_registro++;
    }
  }
  $num_registro=$num_registro;





  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(20);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(90);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(85);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(20);
  $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);




  // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
  $objPHPExcel->setActiveSheetIndex(0);



  // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="Certificados'.$fecha_generar.'.xlsx"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  // incluir o gráfico no ficheiro que vamos gerar
  $objWriter->setIncludeCharts(TRUE);
  ob_end_clean();
  $objWriter->save('php://output');
  exit;

?>
