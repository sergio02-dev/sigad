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
      'color' => array('rgb' => 'FE0606')
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
  
  $numero_registro=0;
  $numero_excel=0;
  $numero_ingresos=1;

  $objPHPExcel->getActiveSheet()->setTitle('Responsable Acción');
 

  $sheet = $objPHPExcel->getActiveSheet();
  $sheet->getPageMargins()->setTop(0.6);
  $sheet->getPageMargins()->setBottom(0.6);
  $sheet->getPageMargins()->setHeader(0.4);
  $sheet->getPageMargins()->setFooter(0.4);
  $sheet->getPageMargins()->setLeft(0.4);
  $sheet->getPageMargins()->setRight(0.4);


// INICIO Filas titulos
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A1', 'CODIGO')
  ->setCellValue('B1', 'DESCRIPCIÓN')
  ->setCellValue('C1', 'RESPONSABLE');




  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C1')->applyFromArray($styleFuenteLetra);
//inicio foreach

$codigo_plandesarrollo=$_REQUEST['codigo_planDesarrollo'];
  include('crud/rs/rsRprtePlnCcion.php');

$num_registro=2;
$id_registro=1;

if($Subsistemas){
  foreach ($Subsistemas as $data_subsistema){
    $sub_codigo=$data_subsistema['sub_codigo'];
    $sub_nombre=$data_subsistema['sub_nombre'];
    $sub_referencia=$data_subsistema['sub_referencia'];
    $sub_ref=$data_subsistema['sub_ref'];
    
    $referenciaSubsistema=$sub_referencia.$sub_ref;

    $accionSubsistema=$objtReportePlanAccion->accionSubsistema($sub_codigo);
    if($accionSubsistema){
      foreach ($accionSubsistema as $data_accionSubsistema) {
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

        $descripcion_nivelTres=$acc_descripcion;
        
        $NombreEncargado="";
        $encargadosAccion=$objtReportePlanAccion->responsableAccion($acc_codigo);
        if($encargadosAccion){
            foreach ($encargadosAccion as $data_responsableAccion) {
                $per_nombre=$data_responsableAccion['per_nombre'];
                $per_primerapellido=$data_responsableAccion['per_primerapellido'];
                $per_segundoapellido=$data_responsableAccion['per_segundoapellido'];

                $encargado=$per_nombre." ".$per_primerapellido." ".$per_segundoapellido;

                $NombreEncargado=$NombreEncargado.$encargado."\n";
            }
        }

        
        
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('A'.$num_registro, $codigo_nivelTres)
        ->setCellValue('B'.$num_registro, $descripcion_nivelTres)
        ->setCellValue('C'.$num_registro, $NombreEncargado);

        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($colorHoja);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($colorHoja);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($colorHoja);


        $num_registro++;
        $id_registro++;
      }
    }
  }
  $num_registro=$num_registro;
}
    



// Fin de Registros //


 $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(15);
 $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(40);
 $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(25);
 $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);



  // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
  $objPHPExcel->setActiveSheetIndex(0);



  // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="ResponsableAccion'.$fecha_generar.'.xlsx"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  // incluir o gráfico no ficheiro que vamos gerar
  $objWriter->setIncludeCharts(TRUE);
  ob_end_clean();
  $objWriter->save('php://output');
  exit;

?>
