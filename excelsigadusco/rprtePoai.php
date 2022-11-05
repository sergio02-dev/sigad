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
->setTitle("Reporte Poai")
->setSubject("Reporte Poai")
->setDescription("Reporte Poai")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Reporte Poai");

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
      'color' => array('rgb' => 'D8D5D5')
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
  
  $numero_registro=0;
  $numero_excel=0;
  $numero_ingresos=1;

  $objPHPExcel->getActiveSheet()->setTitle('Reporte Poai');
 

  $sheet = $objPHPExcel->getActiveSheet();
  $sheet->getPageMargins()->setTop(0.6);
  $sheet->getPageMargins()->setBottom(0.6);
  $sheet->getPageMargins()->setHeader(0.4);
  $sheet->getPageMargins()->setFooter(0.4);
  $sheet->getPageMargins()->setLeft(0.4);
  $sheet->getPageMargins()->setRight(0.4);


  $codigo_plandesarrollo=$_REQUEST['codigo_plandesarrollo'];
  $vigencia=$_REQUEST['vigencia'];
  
  include('crud/rs/rsRprtePoai.php');

// INICIO Filas titulos


  $sheet->mergeCells("A1:A2");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A1', 'SUBSISTEMA');

  $sheet->mergeCells("B1:B2");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('B1', 'PROYECTO');

  $sheet->mergeCells("C1:C2");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('C1', 'SIGLA');

  $sheet->mergeCells("D1:D2");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('D1', 'ACCION');

  $sheet->mergeCells("E1:E2");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('E1', 'RUBRO');

  $sheet->mergeCells("F1:F2");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('F1', 'RESPONSABLE');

  $sheet->mergeCells("G1:I1");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('G1', '');

  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('G2', 'TOTAL ASIGNADO')
  ->setCellValue('H2', 'PDI')
  ->setCellValue('I2', 'POR ASIGNAR');


  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A1:A2")->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B1:B2")->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C1:C2")->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("D1:D2")->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("E1:E2")->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("F1:F2")->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("G1:G2")->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("H1:H2")->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I1:I2")->applyFromArray($styleFuenteLetra);

  ///////////////////////////////////////////////////////////
  $fuentes_financiacion=$objReportePoai->fuenteFinanciacion();
  if($fuentes_financiacion){//if datos fuentes de financiaion
    $numeroletasaumenta=74;
    $numeroletrauno=74;
    $numeroletrados=64;
    $nmro=1;
    foreach ($fuentes_financiacion as $data_fuentefinanciacion){//Foreach fuentes de financiacion
      $ffi_codigo=$data_fuentefinanciacion['ffi_codigo'];
      $ffi_nombre=$data_fuentefinanciacion['ffi_nombre'];
      $ffi_descripcion=$data_fuentefinanciacion['ffi_descripcion'];
      $ffi_tipofuente=$data_fuentefinanciacion['ffi_tipofuente'];

      if($numeroletasaumenta>90){//si es mayor a 90 
       if($numeroletrauno==91){//si es == 91 
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
      ->setCellValue($letra.'2', $ffi_nombre );
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.'2')->applyFromArray($styleFuenteLetra);

      if($nmro==22){
        $numeroletasaumenta++;
        if($numeroletasaumenta>90){//si es mayor a 90 
          if($numeroletrauno==91){//si es == 91 
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
        ->setCellValue($letra.'2', 'EXCED. FAC.');
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.'2')->applyFromArray($styleFuenteLetra);
      }

    
      $numeroletasaumenta++;
      $nmro++;
    }//Fn Foreach fuentes de financiacion
  }//cierre if datos fuentes de financiaion

  //////////////////////////////////////////////////////////




  
//inicio foreach


$num_registro=3;
$id_registro=1;

$Subsistemas=$objReportePoai->subsistemas($codigo_plandesarrollo);
if($Subsistemas){
  foreach ($Subsistemas as $data_subsistema){
    $sub_codigo=$data_subsistema['sub_codigo'];
    $sub_nombre=$data_subsistema['sub_nombre'];
    $sub_referencia=$data_subsistema['sub_referencia'];
    $sub_ref=$data_subsistema['sub_ref'];
    
    $referenciaSubsistema=$sub_referencia.$sub_ref;

    $proyecto=$objReportePoai->proyecto($sub_codigo);
    $subsistema_acciones=0;
    if($proyecto){
      foreach ($proyecto as $data_proyecto) {
       $pro_codigo=$data_proyecto['pro_codigo'];

       $cantidadAcciones=$objReportePoai->cantidadAcciones($pro_codigo);
       if($cantidadAcciones==0){
        $cnt=1;
       }
       else{
        $cnt=$cantidadAcciones;
       }
       $subsistema_acciones=$subsistema_acciones+$cnt;
      }
    }
    else{
      $subsistema_acciones=1;
    }

   if($subsistema_acciones==1){
      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValue('A'.$num_registro, $sub_nombre);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($nombreSubsistema);
    }
    else{
      $row_subsistema=$num_registro+$subsistema_acciones-1;
      $sheet->mergeCells("A".($num_registro).":A".($row_subsistema));
      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValue('A'.$num_registro, $sub_nombre);
      //$objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($nombreSubsistema);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num_registro).":A".($row_subsistema))->getAlignment()->setTextRotation(90);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num_registro).":A".($row_subsistema))->applyFromArray($colorHoja);
    }
   
    $proyectSubsistema=$objReportePoai->proyecto($sub_codigo);
    if($proyectSubsistema){
      foreach ($proyectSubsistema as $data_proyectoSubsistema){
        $pro_codigo=$data_proyectoSubsistema['pro_codigo'];
        $pro_descripcion=$data_proyectoSubsistema['pro_descripcion'];
        $subsistema=$data_proyectoSubsistema['subsistema'];
        $pro_referencia=$data_proyectoSubsistema['pro_referencia'];
        $pro_numero=$data_proyectoSubsistema['pro_numero'];
        $pro_objetivo=$data_proyectoSubsistema['pro_objetivo'];

        if($pro_numero==0){
          $referenciaProyecto=$referenciaSubsistema.'.'.$pro_referencia;
        }
        else{
          $referenciaProyecto=$pro_referencia.'.'.$pro_numero;
        }

        $descripcion=$referenciaProyecto.'. '.$pro_descripcion;

        $cantAccionProyecto=$objReportePoai->cantidadAcciones($pro_codigo);
        if($cantAccionProyecto==0){
          $cantAccn=1;
        }
        else{
          $cantAccn=$cantAccionProyecto;
        }

        if($cantAccn==1){
          $objPHPExcel->setActiveSheetIndex($numero_registro)
          ->setCellValue('B'.$num_registro, $descripcion);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($colorHoja);
        }
        else{
          $row_proyecto=$num_registro+$cantAccn-1;
          $sheet->mergeCells("B".($num_registro).":B".($row_proyecto));
          $objPHPExcel->setActiveSheetIndex($numero_registro)
          ->setCellValue('B'.$num_registro, $descripcion);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num_registro).":B".($row_proyecto))->applyFromArray($colorHoja);
        }
        
        $accionProyecto=$objReportePoai->acciones($pro_codigo);
        if($accionProyecto){
          foreach ($accionProyecto as $data_accionProyecto){
            $acc_codigo=$data_accionProyecto['acc_codigo'];
            $acc_referencia=$data_accionProyecto['acc_referencia'];
            $acc_descripcion=$data_accionProyecto['acc_descripcion'];
            $acc_proyecto=$data_accionProyecto['acc_proyecto'];
            $acc_indicador=$data_accionProyecto['acc_indicador'];
            $acc_numero=$data_accionProyecto['acc_numero'];

            if($acc_numero==0){
              $referenciaAccion=$referenciaSubsistema.'.'.$acc_referencia;
            }
            else{
              $referenciaAccion=$acc_referencia.'.'.$acc_numero;
            }


            $responsable_accion="";
            $encargadosAccion=$objReportePoai->responsables_accion($acc_codigo);
            if($encargadosAccion){
                foreach ($encargadosAccion as $data_responsableAccion) {
                    $per_nombre=$data_responsableAccion['per_nombre'];
                    $per_primerapellido=$data_responsableAccion['per_primerapellido'];
                    $per_segundoapellido=$data_responsableAccion['per_segundoapellido'];
    
                    $encargado=$per_nombre." ".$per_primerapellido." ".$per_segundoapellido;
    
                    $responsable_accion=$responsable_accion.$encargado."\n";
                }
            }

            $rubro_accion=$objReportePoai->rubro_accion($acc_codigo, $vigencia);

            $pdi_accion=$objReportePoai->pdi_accion($acc_codigo, $vigencia);
            $asignadoaccion=$objReportePoai->totalAsignadoAccion($vigencia, $acc_codigo);
            $porasignaraaccion=$pdi_accion-$asignadoaccion;

            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('C'.$num_registro, $referenciaAccion)
            ->setCellValue('D'.$num_registro, $acc_descripcion)
            ->setCellValue('E'.$num_registro, $rubro_accion)
            ->setCellValue('F'.$num_registro, $responsable_accion)
            ->setCellValue('G'.$num_registro, $asignadoaccion)
            ->setCellValue('H'.$num_registro, $pdi_accion)
            ->setCellValue('I'.$num_registro, $porasignaraaccion);

            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($colorHoja);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($colorHoja);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($colorHoja);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registro)->applyFromArray($colorHoja);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->applyFromArray($colorHoja);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registro)->applyFromArray($colorHoja);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registro)->applyFromArray($colorHoja);

              ///////////////////////////////////////////////////////////
              $fuentes_financiacion=$objReportePoai->fuenteFinanciacion();
              if($fuentes_financiacion){//if datos fuentes de financiaion
                $numeroletasaumenta=74;
                $numeroletrauno=74;
                $numeroletrados=64;
                $nmro=1;
                foreach ($fuentes_financiacion as $data_fuentefinanciacion){//Foreach fuentes de financiacion
                  $ffi_codigo=$data_fuentefinanciacion['ffi_codigo'];
                  $ffi_nombre=$data_fuentefinanciacion['ffi_nombre'];
                  $ffi_descripcion=$data_fuentefinanciacion['ffi_descripcion'];
                  $ffi_tipofuente=$data_fuentefinanciacion['ffi_tipofuente'];

                  if($numeroletasaumenta>90){//si es mayor a 90 
                  if($numeroletrauno==91){//si es == 91 
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

                  $valor_fuente=$objReportePoai->valor_accion_fuente($ffi_codigo, $vigencia, $acc_codigo);

                  $objPHPExcel->setActiveSheetIndex($numero_registro)
                  ->setCellValue($letra.$num_registro, $valor_fuente);
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($colorHoja);


                  if($nmro==22){
                    $numeroletasaumenta++;
                    if($numeroletasaumenta>90){//si es mayor a 90 
                      if($numeroletrauno==91){//si es == 91 
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

                    $valor_fuente_facultad=$objReportePoai->valor_accion_fuente_facultad($vigencia, $acc_codigo);
                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue($letra.$num_registro, $valor_fuente_facultad);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($colorHoja);
                  }
                
                  $numeroletasaumenta++;
                  $nmro++;
                }//Fn Foreach fuentes de financiacion
              }//cierre if datos fuentes de financiaion

              //////////////////////////////////////////////////////////

            $num_registro++;
          }
        }
        else{
          $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('C'.$num_registro, '')
            ->setCellValue('D'.$num_registro, '')
            ->setCellValue('E'.$num_registro, '')
            ->setCellValue('F'.$num_registro, '')
            ->setCellValue('G'.$num_registro, '')
            ->setCellValue('H'.$num_registro, '')
            ->setCellValue('I'.$num_registro, '');

            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($colorHoja);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($colorHoja);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($colorHoja);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registro)->applyFromArray($colorHoja);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->applyFromArray($colorHoja);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registro)->applyFromArray($colorHoja);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registro)->applyFromArray($colorHoja);

            ///////////////////////////////////////////////////////////
            $fuentes_financiacion=$objReportePoai->fuenteFinanciacion();
            if($fuentes_financiacion){//if datos fuentes de financiaion
              $numeroletasaumenta=74;
              $numeroletrauno=74;
              $numeroletrados=64;
              $nmro=1;
              foreach ($fuentes_financiacion as $data_fuentefinanciacion){//Foreach fuentes de financiacion
                $ffi_codigo=$data_fuentefinanciacion['ffi_codigo'];
                $ffi_nombre=$data_fuentefinanciacion['ffi_nombre'];
                $ffi_descripcion=$data_fuentefinanciacion['ffi_descripcion'];
                $ffi_tipofuente=$data_fuentefinanciacion['ffi_tipofuente'];

                if($numeroletasaumenta>90){//si es mayor a 90 
                if($numeroletrauno==91){//si es == 91 
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
                ->setCellValue($letra.$num_registro, '' );
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($colorHoja);


                if($nmro==22){
                  $numeroletasaumenta++;
                  if($numeroletasaumenta>90){//si es mayor a 90 
                    if($numeroletrauno==91){//si es == 91 
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

                  //$valor_fuente_facultad=$objReportePoai->valor_accion_fuente_facultad($vigencia, $acc_codigo);
                  $objPHPExcel->setActiveSheetIndex($numero_registro)
                  ->setCellValue($letra.$num_registro, '');
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($colorHoja);
                }
              
                $numeroletasaumenta++;
                $nmro++;
              }//Fn Foreach fuentes de financiacion
            }//cierre if datos fuentes de financiaion

            //////////////////////////////////////////////////////////

            $num_registro++;

        }

        //$num_registro=$num_registro+$cantAccn;
      }
      
    }
    else{
      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValue('B'.$num_registro, '')
      ->setCellValue('C'.$num_registro, '')
      ->setCellValue('D'.$num_registro, '')
      ->setCellValue('E'.$num_registro, '')
      ->setCellValue('F'.$num_registro, '')
      ->setCellValue('G'.$num_registro, '')
      ->setCellValue('H'.$num_registro, '')
      ->setCellValue('I'.$num_registro, '');

      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registro)->applyFromArray($colorHoja);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registro)->applyFromArray($colorHoja);

      ///////////////////////////////////////////////////////////
      $fuentes_financiacion=$objReportePoai->fuenteFinanciacion();
      if($fuentes_financiacion){//if datos fuentes de financion
        $numeroletasaumenta=74;
        $numeroletrauno=74;
        $numeroletrados=64;
        $nmro=1;
        foreach ($fuentes_financiacion as $data_fuentefinanciacion){//Foreach fuentes de financiacion
          $ffi_codigo=$data_fuentefinanciacion['ffi_codigo'];
          $ffi_nombre=$data_fuentefinanciacion['ffi_nombre'];
          $ffi_descripcion=$data_fuentefinanciacion['ffi_descripcion'];
          $ffi_tipofuente=$data_fuentefinanciacion['ffi_tipofuente'];

          if($numeroletasaumenta>90){//si es mayor a 90 
          if($numeroletrauno==91){//si es == 91 
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
          ->setCellValue($letra.$num_registro, '' );
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($colorHoja);

          if($nmro==22){
            $numeroletasaumenta++;
            if($numeroletasaumenta>90){//si es mayor a 90 
              if($numeroletrauno==91){//si es == 91 
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
            ->setCellValue($letra.$num_registro, '');
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($colorHoja);
          }
        
          $numeroletasaumenta++;
          $nmro++;
        }//Fn Foreach fuentes de financiacion
      }//cierre if datos fuentes de financion
      //////////////////////////////////////////////////////////

      $num_registro++;
    }
    $totalAsignado=$objReportePoai->totalAsignadoSubsistema($sub_codigo, $vigencia);
    $pdi_subsistema=$objReportePoai->pdi_subsistema($sub_codigo, $vigencia);
    $porasignar=$pdi_subsistema-$totalAsignado;
    $nombre_niveluno=$objReportePoai->nombre_nivel_uno($codigo_plandesarrollo);

    $tituloPiePagina=$nombre_niveluno.' '.$sub_nombre;
    //Pie de cada Subsistema
    $sheet->mergeCells("A".($num_registro).":D".($num_registro));
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$num_registro, strtoupper($tituloPiePagina));
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num_registro).":D".($num_registro))->applyFromArray($pieSubsistema);

    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('E'.$num_registro, '')
    ->setCellValue('F'.$num_registro, '')
    ->setCellValue('G'.$num_registro, $totalAsignado)
    ->setCellValue('H'.$num_registro, $pdi_subsistema)
    ->setCellValue('I'.$num_registro, $porasignar);

  
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($pieSubsistema);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registro)->applyFromArray($pieSubsistema);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->applyFromArray($pieSubsistema);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registro)->applyFromArray($pieSubsistema);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registro)->applyFromArray($pieSubsistema); 

    ///////////////////////////////////////////////////////////
    $fuentes_financiacion=$objReportePoai->fuenteFinanciacion();
    if($fuentes_financiacion){//if datos fuentes de financion
      $numeroletasaumenta=74;
      $numeroletrauno=74;
      $numeroletrados=64;
      $nmro=1;
      foreach ($fuentes_financiacion as $data_fuentefinanciacion){//Foreach fuentes de financiacion
        $ffi_codigo=$data_fuentefinanciacion['ffi_codigo'];
        $ffi_nombre=$data_fuentefinanciacion['ffi_nombre'];
        $ffi_descripcion=$data_fuentefinanciacion['ffi_descripcion'];
        $ffi_tipofuente=$data_fuentefinanciacion['ffi_tipofuente'];

        if($numeroletasaumenta>90){//si es mayor a 90 
        if($numeroletrauno==91){//si es == 91 
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

        $poaitechosubsistema=$objReportePoai->poai_techo_subsistema_fuente($ffi_codigo, $vigencia, $sub_codigo);
        
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue($letra.$num_registro, $poaitechosubsistema);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($pieSubsistema);

        if($nmro==22){
          $numeroletasaumenta++;
          if($numeroletasaumenta>90){//si es mayor a 90 
            if($numeroletrauno==91){//si es == 91 
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

          $poaitechosubsistemafacultad=$objReportePoai->poai_techo_subsistema_fuente_facultad($vigencia, $sub_codigo);
        
          $objPHPExcel->setActiveSheetIndex($numero_registro)
          ->setCellValue($letra.$num_registro, $poaitechosubsistemafacultad);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($pieSubsistema);
        }

      
        $numeroletasaumenta++;
        $nmro++;
      }//Fn Foreach fuentes de financiacion
    }//cierre if datos fuentes de financion
    //////////////////////////////////////////////////////////

    $num_registro++;
    //$num_registro=$num_registro+$subsistema_acciones;
    $id_registro++;
  }
  $num_registro=$num_registro;
}
    



// Fin de Registros //


 $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(15);
 $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(40);
 $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(20);
 $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(33);
 $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(15);
 $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(25);
 $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(25);
 $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setWidth(25);
 $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('I')->setWidth(25);
 ///////////////////////////////////////////////////////////
 $fuentes_financiacion=$objReportePoai->fuenteFinanciacion();
 if($fuentes_financiacion){//if datos fuentes de financion
   $numeroletasaumenta=74;
   $numeroletrauno=74;
   $numeroletrados=64;
   $nmro=1;
   foreach ($fuentes_financiacion as $data_fuentefinanciacion){//Foreach fuentes de financiacion
     $ffi_codigo=$data_fuentefinanciacion['ffi_codigo'];
     $ffi_nombre=$data_fuentefinanciacion['ffi_nombre'];
     $ffi_descripcion=$data_fuentefinanciacion['ffi_descripcion'];
     $ffi_tipofuente=$data_fuentefinanciacion['ffi_tipofuente'];

     if($numeroletasaumenta>90){//si es mayor a 90 
     if($numeroletrauno==91){//si es == 91 
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
     
     $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension($letra)->setWidth(16);

     if($nmro==22){
      $numeroletasaumenta++;
      if($numeroletasaumenta>90){//si es mayor a 90 
        if($numeroletrauno==91){//si es == 91 
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
    }

   
     $numeroletasaumenta++;
     $nmro++;
   }//Fn Foreach fuentes de financiacion
 }//cierre if datos fuentes de financion
 //////////////////////////////////////////////////////////

 $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(25);



  // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
  $objPHPExcel->setActiveSheetIndex(0);



  // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="ReportePoai'.$fecha_generar.'.xlsx"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  // incluir o gráfico no ficheiro que vamos gerar
  $objWriter->setIncludeCharts(TRUE);
  ob_end_clean();
  $objWriter->save('php://output');
  exit;

?>
