<?php
set_time_limit(1800000000);

date_default_timezone_set("America/Bogota");
$hora=time();

//$fecha_actual =date("Y-m-d H:i:00",$hora);

//$fecha_generar=date('Ymd_His');
$fecha_generar=date('Y-m-d h:i:sa', $hora);
$codigo_subsistema=$_REQUEST['codigo_subsistema'];
$nombre_documento="";
if($codigo_subsistema==1){
  $nombre_documento="Subsistema de Formación ";
  $responsableSubsistema="Vicerrectoría Academica";
}
if($codigo_subsistema==2){
  $nombre_documento="Subsistema Investigación ";
  $responsableSubsistema="Vicerrectoría de Investigación";
}
if($codigo_subsistema==3){
  $nombre_documento="Subsistema Proyección Social ";
  $responsableSubsistema="Vicerrectoría de Proyección Social";
}
if($codigo_subsistema==4){
  $nombre_documento="Subsistema Bienestar Universitario ";
  $responsableSubsistema="Bienestar Universitario";
}
if($codigo_subsistema==5){
  $nombre_documento="Subsistema de Administración ";
  $responsableSubsistema="Vicerrectoría Administrativa";
}
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
->setTitle("Reporte por Subsistema")
->setSubject("Reporte por Subsistema")
->setDescription("Reporte por Subsistema")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Reporte por Subsistema");

  $styleFuenteLetra = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Calibri'
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
      'color' => array('rgb' => 'FB9522')
    )
  );
  
 $colorFondo1=array(
      'font'  => array(
        //'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Calibri'
      ),
      'fill' => array(
          'type' => PHPExcel_Style_Fill::FILL_SOLID,
          'color' => array('rgb' => 'FBFBBA')
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

 $colorFondo2=array(
    'font'  => array(
      //'bold'  => true,
      'color' => array('rgb' => '000000'),
      'size'  => 11,
      'name'  => 'Calibri'
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'EDEDE8')
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
  $adicionales=array(
    'font'  => array(
      'color' => array('rgb' => '000000'),
      'size'  => 11,
      'name'  => 'Calibri'
    ),
    'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'wrap' => true
    )
  );
  $totalizados= array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Calibri'
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
      'color' => array('rgb' => '95BAEC')
    )
  );

  $numero_registro=0;
  $numero_excel=0;
  $numero_ingresos=1;
/* creacion de Hoja */
  $objPHPExcel->createSheet();
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet()->setTitle('Proyecto');

  $sheet = $objPHPExcel->getActiveSheet($numero_registro);
  $sheet->getPageMargins()->setTop(0.6);
  $sheet->getPageMargins()->setBottom(0.6);
  $sheet->getPageMargins()->setHeader(0.4);
  $sheet->getPageMargins()->setFooter(0.4);
  $sheet->getPageMargins()->setLeft(0.4);
  $sheet->getPageMargins()->setRight(0.4);
 

// INICIO Filas titulos
 // $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('A')->setWidth(100);
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A1', 'PROYECTO')
  ->setCellValue('B1', 'ACCION')
  ->setCellValue('C1', 'LINEA DE BASE')
  ->setCellValue('D1', 'META DE RESULTADO')
  ->setCellValue('E1', 'ACTIVIDAD')
  ->setCellValue('F1', 'CERTIFICADO')
  ->setCellValue('G1', 'VALOR $')
  ->setCellValue('H1', 'LOGRO %')
  ->setCellValue('I1', 'LOGRO TOTAL')
  ->setCellValue('J1', 'CDP')
  ->setCellValue('K1', 'RP')
  ->setCellValue('L1', 'RESPONSABLE');


  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('J1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('K1')->applyFromArray($styleFuenteLetra);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('L1')->applyFromArray($styleFuenteLetra);

  $numArr=0;
  $arraLogro = array();
  //$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".($num_registro)."A".($num_registro+3))
  include('crud/rs/rprteSbstma.php');

  if($rsProyectoSubsistema){
    $num_registro=2;
    $id_registro=1; 
    $num_registroAccion=2;  
    $num_registroActividad=2;
    $No_color=1;
/**
 * inicio foreach
**/ 



    $porcentajeProyecto=0;
    $totalTotalProyecto=0;
    $costoTotalProyecto=0;
    $posicion_celdaA=0;
    $posicion_accion=0;
    $numero_proyecto=1;
    $cantidad_accion=1;
    foreach($rsProyectoSubsistema as $data_proyectoSubsistema){
      $pro_codigo=$data_proyectoSubsistema['pro_codigo'];
      $pro_descripcion=$data_proyectoSubsistema['pro_descripcion'];
      $pro_referencia=$data_proyectoSubsistema['pro_referencia'];

      //Cantidad Acciones 
      $canti_accion=$objRsrprteSbstmaExcel->cantidadAcciones($pro_codigo);
      
      if($No_color==1){
        $color=$colorFondo1;
      }
      else{
        $color=$colorFondo2;
        $No_color=0;
      }
      $count_accion=$objRsrprteSbstmaExcel->cantidadAcciones($pro_codigo);

      include('grlla/data/cntActvtys.php');
  
      if($numero_proyecto==1){
        $celda_proyecto= ($num_registro+$row_proyecto+$canti_accion)-1;
        $posicion_celdaA=$num_registro+$row_proyecto+$canti_accion;
        $sheet->mergeCells("A".($num_registro).":A".($celda_proyecto));
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('A'.$num_registro, $pro_referencia." ".$pro_descripcion);

        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num_registro).":A".($celda_proyecto))->applyFromArray($color); 
        
        $objPHPExcel->getActiveSheet()
        ->getStyle('A'.$num_registro)
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          }
      else{
        $celda_proyecto= ($posicion_celdaA+$row_proyecto+$canti_accion)-1;
        $num_registroo=$posicion_celdaA;
        $posicion_celdaA=$posicion_celdaA+$row_proyecto+$canti_accion;
        $sheet->mergeCells("A".($num_registroo).":A".($celda_proyecto));
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('A'.$num_registroo, $pro_referencia." ".$pro_descripcion);

        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num_registroo).":A".($celda_proyecto))->applyFromArray($color);
        $objPHPExcel->getActiveSheet()
        ->getStyle('A'.$num_registroo)
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);          
      }
      //$objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($color);
      $sqlRsAccioProyecto=$objRsrprteSbstmaExcel->sqlRsAccioProyecto($pro_codigo);
      if($sqlRsAccioProyecto){

        $cntdadAccion=COUNT($sqlRsAccioProyecto);
        $cant_accion=1;
        $porcentajeAccion=0;
        $totalTotalAccion=0;
        foreach($sqlRsAccioProyecto as $data_accionProyecto){
          $acc_codigo=$data_accionProyecto['acc_codigo'];
          $acc_referencia=$data_accionProyecto['acc_referencia'];
          $acc_descripcion=$data_accionProyecto['acc_descripcion'];
          $lineaBase=$data_accionProyecto['acc_lineabase'];
          $metaResultado=$data_accionProyecto['acc_metaresultado'];
          
          //$lineaBase=$objRsrprteSbstmaExcel->LineaBase($acc_codigo);
          //$metaResultado=$objRsrprteSbstmaExcel->MetaResultado($acc_codigo);


          $diferenciaMetaLinea=$metaResultado-$lineaBase;

          $cantidad_acciones_proyecto=$objRsrprteSbstmaExcel->cantidadAcciones($pro_codigo);

          $cantidada_actividades_accion=$objRsrprteSbstmaExcel->cantidadActividadAccionExcel($pro_codigo, $acc_codigo);
          if($cantidada_actividades_accion==0){
            $cantidad_actividadaccionn=1;
          }
          else{
            $cantidad_actividadaccionn=$cantidada_actividades_accion;
          }
          $row_accion=$cantidad_actividadaccionn;

          if($cantidad_accion==1){
              if($row_accion==1){
                $posicion_accion=  $num_registroAccion+$row_accion;
                
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('B'.$num_registroAccion, $acc_referencia." ".$acc_descripcion)
                ->setCellValue('C'.$num_registroAccion, $lineaBase)
                ->setCellValue('D'.$num_registroAccion, $metaResultado);


                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registroAccion)->applyFromArray($color);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registroAccion)->applyFromArray($color);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registroAccion)->applyFromArray($color);
 
              }
              else{
                $celda_accion= ($num_registroAccion+$row_accion)-1;
                $posicion_accion=  $num_registroAccion+$row_accion;
                $sheet->mergeCells("B".($num_registroAccion).":B".($celda_accion));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('B'.$num_registroAccion, $acc_referencia." ".$acc_descripcion);

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num_registroAccion).":B".($celda_accion))->applyFromArray($color);

                $sheet->mergeCells("C".($num_registroAccion).":C".($celda_accion));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('C'.$num_registroAccion, $lineaBase);

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C".($num_registroAccion).":C".($celda_accion))->applyFromArray($color);

                $sheet->mergeCells("D".($num_registroAccion).":D".($celda_accion));
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('D'.$num_registroAccion, $metaResultado);

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("D".($num_registroAccion).":D".($celda_accion))->applyFromArray($color);
           
              }
            
          }
          else{
            if($row_accion==1){
              $num_registroAccin=$posicion_accion;
              $posicion_accion=$posicion_accion+$row_accion;

              $objPHPExcel->setActiveSheetIndex($numero_registro)
              ->setCellValue('B'.$num_registroAccin, $acc_referencia." ".$acc_descripcion)
              ->setCellValue('C'.$num_registroAccin, $lineaBase)
              ->setCellValue('D'.$num_registroAccin, $metaResultado);

              $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registroAccin)->applyFromArray($color);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registroAccin)->applyFromArray($color);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registroAccin)->applyFromArray($color);
            }
            else{
              $celda_accion=($posicion_accion+$row_accion)-1;
              $num_registroAccionn=$posicion_accion;
              $posicion_accion=$posicion_accion+$row_accion;

              $sheet->mergeCells("B".($num_registroAccionn).":B".($celda_accion));
              $objPHPExcel->setActiveSheetIndex($numero_registro)
              ->setCellValue('B'.$num_registroAccionn, $acc_referencia." ".$acc_descripcion);

              $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num_registroAccionn).":B".($celda_accion))->applyFromArray($color);

              $sheet->mergeCells("C".($num_registroAccionn).":C".($celda_accion));
              $objPHPExcel->setActiveSheetIndex($numero_registro)
              ->setCellValue('C'.$num_registroAccionn, $lineaBase);

              $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C".($num_registroAccionn).":C".($celda_accion))->applyFromArray($color);

              $sheet->mergeCells("D".($num_registroAccionn).":D".($celda_accion));
              $objPHPExcel->setActiveSheetIndex($numero_registro)              
              ->setCellValue('D'.$num_registroAccionn, $metaResultado);

              $objPHPExcel->getActiveSheet($numero_registro)->getStyle("D".($num_registroAccionn).":D".($celda_accion))->applyFromArray($color);
            }
          }
          $actividad_accionProyecto=$objRsrprteSbstmaExcel->sqlRsAtividad($pro_codigo, $acc_codigo);
          if($actividad_accionProyecto){
            foreach($actividad_accionProyecto as $data_actividad){
              $act_codigo=$data_actividad['act_codigo'];
              $act_referencia=$data_actividad['act_referencia'];
              $act_descripcion=$data_actividad['act_descripcion'];
              $act_certificado=$data_actividad['act_certificado'];
              $act_dependencia=$data_actividad['act_dependencia'];

              $valor_actividad=$objRsrprteSbstmaExcel->sqlRsValorActividad($act_codigo);

              if($act_dependencia>0){
                $reponsable=$objRsrprteSbstmaExcel->RsDependencia($act_dependencia);
              }
              else{
                $reponsable="";
              }
              
             
              
              $sqlRsCantidadActividadRealizadaPorcentaje=$objRsrprteSbstmaExcel->sqlRsCantidadActividadRealizadaPorcentaje($act_codigo);
              if($sqlRsCantidadActividadRealizadaPorcentaje>0){
                  $sqlLogroAvanzadoPorcentaje=$objRsrprteSbstmaExcel->sqlLogroAvanzadoPorcentaje($act_codigo);
                  $logroporcentaje=$sqlLogroAvanzadoPorcentaje/$sqlRsCantidadActividadRealizadaPorcentaje;

                  $logro_porcentaje=$logroporcentaje;
              }
              else{
                  $logro_porcentaje=0;
              }

              $sqlLogroAvanzadoTotal=$objRsrprteSbstmaExcel->sqlLogroAvanzadoTotal($act_codigo);

              if($sqlLogroAvanzadoTotal){
                  $logro_total=$sqlLogroAvanzadoTotal;
              }
              else{
                  $logro_total=0;
              }
              //Suma Porcentaje
              $porcentajeAccion=$porcentajeAccion+$logro_porcentaje;
              //Suma Total
              $totalTotalAccion=$totalTotalAccion+$logro_total;

              $objPHPExcel->setActiveSheetIndex($numero_registro)
              ->setCellValue('E'.$num_registroActividad, $act_referencia." ".$act_descripcion)
              ->setCellValue('F'.$num_registroActividad, $act_certificado)
              ->setCellValueExplicit('G'.$num_registroActividad, $valor_actividad,PHPExcel_Cell_DataType::TYPE_NUMERIC)
              ->setCellValue('H'.$num_registroActividad, round($logro_porcentaje,2))
              ->setCellValue('I'.$num_registroActividad, $logro_total)
              ->setCellValue('J'.$num_registroActividad, "")
              ->setCellValue('K'.$num_registroActividad, "")
              ->setCellValue('L'.$num_registroActividad, $reponsable);
              


              $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registroActividad)->applyFromArray($color);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registroActividad)->applyFromArray($color);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registroActividad)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registroActividad)->applyFromArray($color);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registroActividad)->applyFromArray($color);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registroActividad)->applyFromArray($color);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle('J'.$num_registroActividad)->applyFromArray($adicionales);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle('K'.$num_registroActividad)->applyFromArray($adicionales);
              $objPHPExcel->getActiveSheet($numero_registro)->getStyle('L'.$num_registroActividad)->applyFromArray($adicionales);

              $num_registroActividad++;
            }
          }
          else{
               /* $sheet->mergeCells("E".($num_registroActividad).":I".($num_registroActividad));*/
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('E'.$num_registroActividad, "No hay Actividades")
                ->setCellValue('F'.$num_registroActividad, '0')
                ->setCellValue('G'.$num_registroActividad, '0')
                ->setCellValue('H'.$num_registroActividad, '0')
                ->setCellValue('I'.$num_registroActividad, '0');

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registroActividad)->applyFromArray($color);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registroActividad)->applyFromArray($color);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registroActividad)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registroActividad)->applyFromArray($color);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registroActividad)->applyFromArray($color);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registroActividad)->applyFromArray($color);

                 $num_registroActividad++;
              }
         
          $totalCostoAccion=$objRsrprteSbstmaExcel->totalCostoAccion($pro_codigo, $acc_codigo);

          //Acumulador Valor Total Costo Proyecto
          $costoTotalProyecto=$costoTotalProyecto+$totalCostoAccion;
         
          $num_registroAccion++;
          $cantidad_accion++;
          $cant_accion++;
          //Total Porcentaje Acciones 
          $porcentajeAccionesProyecto=$porcentajeAccion/$cantidad_actividadaccionn;
          //Total total Acciones
          $totalizadototalAccion=($metaResultado-$lineaBase)*round($porcentajeAccionesProyecto,2)/100;
          if($totalizadototalAccion<0){
            $ttlzdottlaccn="-";
            $mostrarTotalizadoAccion=$ttlzdottlaccn;
          }
          else{
            $ttlzdottlaccn=$totalizadototalAccion;
            $mostrarTotalizadoAccion=round($ttlzdottlaccn,2);
          }
          $arraLogro[$numArr]=$totalizadototalAccion;

          
          //Totalizado por accion

          //totalizado Proyectos 
          $porcentajeProyecto=$porcentajeProyecto+$porcentajeAccionesProyecto;
          $totalTotalProyecto=$totalizadototalAccion+$totalizadototalAccion;
          if($diferenciaMetaLinea<0){
            $diff_Metalinea="-";
          }
          else{
            $diff_Metalinea=$diferenciaMetaLinea;
          }
          $num=$posicion_accion;
          $objPHPExcel->setActiveSheetIndex($numero_registro)
          ->setCellValue('B'.$num, "")
          ->setCellValue('C'.$num, "")
          ->setCellValue('D'.$num, $diff_Metalinea)
          ->setCellValue('E'.$num_registroActividad, "TOTAL ACCIÓN ".substr($acc_referencia,3,8))
          ->setCellValue('F'.$num_registroActividad, "")
          ->setCellValue('G'.$num_registroActividad, $totalCostoAccion)
          ->setCellValue('H'.$num_registroActividad, round($porcentajeAccionesProyecto,2))
          ->setCellValue('I'.$num_registroActividad, $mostrarTotalizadoAccion);

          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registroActividad)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registroActividad)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registroActividad)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registroActividad)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registroActividad)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registroActividad)->applyFromArray($totalizados);

          $porcentajeAccion=0;
          $num_registroActividad++;
          $posicion_accion++;
          $numArr++;
        }
        
      }

      $costoFinalProyecto=$costoTotalProyecto;
      
      $num_registro++;
      $id_registro++;
      $numero_proyecto++;
      $No_color++;
       // $sheet->mergeCells("B".($num_registroAccion).":B".($celda_accion));
      $numro_registro=$posicion_celdaA;
      $num=$posicion_accion;
     
      

      
      //Total Proyectos 

      $proyectoPorcentajeFinal=$porcentajeProyecto/$count_accion;
      $totalProyectoTotal=$totalTotalProyecto;
      
      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValue('A'.$numro_registro, "")
      ->setCellValue('B'.$num, "")
      ->setCellValue('C'.$num, "")
      ->setCellValue('D'.$num, "")
      ->setCellValue('E'.$num_registroActividad, "TOTAL PROYECTO")
      ->setCellValue('F'.$num_registroActividad, "")
      ->setCellValue('G'.$num_registroActividad, $costoFinalProyecto)
      ->setCellValue('H'.$num_registroActividad, round($proyectoPorcentajeFinal,2))
      ->setCellValue('I'.$num_registroActividad, '');

      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($totalizados);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->applyFromArray($totalizados);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($totalizados);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->applyFromArray($totalizados);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registroActividad)->applyFromArray($totalizados);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registroActividad)->applyFromArray($totalizados);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registroActividad)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registroActividad)->applyFromArray($totalizados);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registroActividad)->applyFromArray($totalizados);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registroActividad)->applyFromArray($totalizados);

      $posicion_celdaA++;
      $posicion_accion++;
      $num_registroActividad++;
      $num_registro++;
      $id_registro++;

      $numro_registro=$posicion_celdaA;
      $sheet->mergeCells("A".($numro_registro).":I".($numro_registro));
      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValue('A'.$numro_registro, "");
     

      $posicion_celdaA++;
      $posicion_accion++;
      $num_registroActividad++;
      $num_registro++;
      $id_registro++;

      $costoTotalProyecto=0;
      $porcentajeProyecto=0;
      $totalTotalProyecto=0;
    }
    $num_registro=$num_registro;
  }

// Fin de Registros //

//$objWorksheet->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(20);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(18);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(10);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(10);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(55);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(10);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(13);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setWidth(11);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('I')->setWidth(11);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('J')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('K')->setWidth(8);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('L')->setWidth(18);
  //$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(20);
  $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);
  
  //***************Final Hoja Uno*************** */

  //**************Inicio Hoja Dos **************** */
  $proyecto= array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Calibri'
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'CACCCF')
    )
  );
  $trimestre= array(
    'font'  => array(
        //'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Calibri'
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    )
  );
  $encabezado= array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Calibri'
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
      'color' => array('rgb' => 'BFD8F9')
    )
  );
  $celdas= array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Calibri'
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
    )
  );

 
  $numero_registro=1;
  $objPHPExcel->createSheet();
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet()->setTitle('SEGUIMIENTO');


  $sheet = $objPHPExcel->getActiveSheet();
  $sheet->getPageMargins()->setTop(0.6);
  $sheet->getPageMargins()->setBottom(0.6);
  $sheet->getPageMargins()->setHeader(0.4);
  $sheet->getPageMargins()->setFooter(0.4);
  $sheet->getPageMargins()->setLeft(0.4);
  $sheet->getPageMargins()->setRight(0.4);

  $nummArr=0;
  $num_registro=1;
  $id_registro=1;
  $proyectosSeguimiento=$objRsrprteSbstmaExcel->sqlRsProyectoSubsistema($codigo_subsistema);
  if($proyectosSeguimiento){
    foreach($proyectosSeguimiento as $data_ProyectoSubsistemaSeguimiento){
      $pro_codigo=$data_ProyectoSubsistemaSeguimiento['pro_codigo'];
      $pro_referencia=$data_ProyectoSubsistemaSeguimiento['pro_referencia'];
      $pro_descripcion=$data_ProyectoSubsistemaSeguimiento['pro_descripcion'];

      $sheet->mergeCells("A".($num_registro).":G".($num_registro));
      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValue('A'.$num_registro, $pro_referencia." ".strtoupper($pro_descripcion));

      $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num_registro).":G".($num_registro))->applyFromArray($proyecto);

      $num_registro++;
      
      $sheet->mergeCells("A".($num_registro).":G".($num_registro));
      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValue('A'.$num_registro, 'TRIMESTRE');

      $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num_registro).":G".($num_registro))->applyFromArray($trimestre);

      $num_registro++;

      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValue('A'.$num_registro, 'META RESULTADO (1)')
      ->setCellValue('B'.$num_registro, 'LÍNEA BASE 2018 (2)')
      ->setCellValue('C'.$num_registro, 'ACUMULADO PDI 2019 (3)')
      ->setCellValue('D'.$num_registro, 'META 2019 (4)')
      ->setCellValue('E'.$num_registro, 'LOGRO (5)')
      ->setCellValue('F'.$num_registro, 'DIFERENCIA (6) = 4 - 5')
      ->setCellValue('G'.$num_registro, 'EFICACIA (7) = 5 / 4')
      ->setCellValue('H'.$num_registro, 'RANGO INDICADOR DE EFICACIA');

      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($encabezado);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($encabezado);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($encabezado);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($encabezado);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($encabezado);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registro)->applyFromArray($encabezado);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->applyFromArray($encabezado);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registro)->applyFromArray($encabezado);
      $num_registro++;

      $accion_ProyectoSeguimiento=$objRsrprteSbstmaExcel->sqlRsAccioProyecto($pro_codigo);
      if($accion_ProyectoSeguimiento){
        foreach($accion_ProyectoSeguimiento as $data_accioProyectoSeguimiento){
          $acc_codigo=$data_accioProyectoSeguimiento['acc_codigo'];
          $acc_referencia=$data_accioProyectoSeguimiento['acc_referencia'];
          $acc_descripcion=$data_accioProyectoSeguimiento['acc_descripcion'];
          $acc_indicador=$data_accioProyectoSeguimiento['acc_indicador'];
          $lineaBase=$data_accioProyectoSeguimiento['acc_lineabase'];
          $metaResultado=$data_accioProyectoSeguimiento['acc_metaresultado'];

          /*$lineaBase=$objRsrprteSbstmaExcel->LineaBase($acc_codigo);
          $metaResultado=$objRsrprteSbstmaExcel->MetaResultado($acc_codigo);*/


          $diffMetaLinea=$metaResultado-$lineaBase;
          if($diffMetaLinea<0){
            $difffMetaLinea="-";
          }
          else{
            $difffMetaLinea=$diffMetaLinea;
          }

          $lineaAccionArrEn=round($arraLogro[$nummArr],2);

          if($arraLogro[$nummArr]<0){
            $lineaAccionArr="-";
          }
          else{
            $lineaAccionArr=round($arraLogro[$nummArr],2);
          }
          $diferencia=$metaResultado-round($arraLogro[$nummArr],2);
          if($diferencia<0){
            $diferencia4mns5="-";
          }
          else{
            $diferencia4mns5=$diferencia;
          }

          $eficiencia=$lineaAccionArrEn/$diffMetaLinea;

          if($eficiencia<0){
            $efficiencia="-";
          }
          else{
            $efficiencia=round($eficiencia,2);
          }


          $objPHPExcel->setActiveSheetIndex($numero_registro)
          ->setCellValue('A'.$num_registro, $acc_indicador)
          ->setCellValue('B'.$num_registro, $lineaBase)
          ->setCellValue('C'.$num_registro, $metaResultado)
          ->setCellValue('D'.$num_registro, $difffMetaLinea)
          ->setCellValue('E'.$num_registro, $lineaAccionArr)
          ->setCellValue('F'.$num_registro, $diferencia4mns5)
          ->setCellValue('G'.$num_registro, $efficiencia)
          ->setCellValue('H'.$num_registro, '');

          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($celdas);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($celdas);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($celdas);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($celdas);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($celdas);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registro)->applyFromArray($celdas);
          //$objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->applyFromArray($celdas);
         /* $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->getNumberFormat()->applyFromArray( 
              array( 
                  'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00
              )
          );*/
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->applyFromArray($celdas);
         
          
          $num_registro++;
          $nummArr++;
        }
        $nummArr=$nummArr;
       $num_registro=$num_registro;
      }
      


      $num_registro++;
      $id_registro++;
    
     $num_registro=$num_registro;
    }
  }
  

  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(20);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(18);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(10);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(10);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(55);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(10);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(13);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setWidth(11);
  $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);

  //***************Fin Hoja Dos *************** */
  
  /******************Inicio Hoja Tres***********************/

  $styleFuenteLetraHojaDos = array(
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
  $colorHojaDos=array(
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
  $ultimaFila=array(
   'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FBFBFB')
    ),
    'borders' => array(
      'outline' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN,
        'color' => array('rgb' => 'E5E6EA')
      )
    ),
    'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'wrap' => true
    )
  );
  $numero_registro=2;
  $numero_excel=1;
  $numero_ingresos=2;
  $objPHPExcel->createSheet();
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet()->setTitle('Resumen');

  $sheet = $objPHPExcel->getActiveSheet();
  $sheet->getPageMargins()->setTop(0.6);
  $sheet->getPageMargins()->setBottom(0.6);
  $sheet->getPageMargins()->setHeader(0.4);
  $sheet->getPageMargins()->setFooter(0.4);
  $sheet->getPageMargins()->setLeft(0.4);
  $sheet->getPageMargins()->setRight(0.4);

  // INICIO Filas titulos
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A1', 'PROYECTO')
  ->setCellValue('B1', 'RESULTADO')
  ->setCellValue('C1', 'LOGRO %')
  ->setCellValue('D1', 'LOGRO TOTAL')
  ->setCellValue('E1', 'TOTALES $') ;




  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A1')->applyFromArray($styleFuenteLetraHojaDos);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B1')->applyFromArray($styleFuenteLetraHojaDos);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C1')->applyFromArray($styleFuenteLetraHojaDos);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D1')->applyFromArray($styleFuenteLetraHojaDos);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E1')->applyFromArray($styleFuenteLetraHojaDos);
  //inicio foreach



  $num_registro=2;
  $posicion_ResumenA=2;
  $numero_registroProyecto=2;
  $total_proyect=0;
  $totalProyecto=0;
  if ($rsProyectoSubsistema) {
    $totalSubsistema=$objRsrprteSbstmaExcel->totalSubsistema($codigo_subsistema);
    $contador_proyecto=COUNT($rsProyectoSubsistema);
    $numerodeproyectos=1;
    
    foreach ($rsProyectoSubsistema as $data_rsProyectoSubsistema){
      $pro_codigo=$data_rsProyectoSubsistema['pro_codigo'];
      $pro_referencia=$data_rsProyectoSubsistema['pro_referencia'];
      $pro_descripcion=$data_rsProyectoSubsistema['pro_descripcion'];

      
      

      if($numerodeproyectos==1){
        $accion_proyecto=$objRsrprteSbstmaExcel->sqlRsAccioProyecto($pro_codigo);
        if($accion_proyecto){
          $cantidad_accionesproyect=COUNT($accion_proyecto);
          if($cantidad_accionesproyect==1){
            $posicion_ResumenA=$posicion_ResumenA+$cantidad_accionesproyect;
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValueExplicit('A'.$numero_registroProyecto, $pro_referencia." ".$pro_descripcion,PHPExcel_Cell_DataType::TYPE_STRING);
          }
          else{
            $celda_proyectoResumen= ($posicion_ResumenA+$cantidad_accionesproyect)-1;
            $posicion_ResumenA=$posicion_ResumenA+$cantidad_accionesproyect;
            $sheet->mergeCells("A".($numero_registroProyecto).":A".($celda_proyectoResumen));
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValueExplicit('A'.$numero_registroProyecto, $pro_referencia." ".$pro_descripcion,PHPExcel_Cell_DataType::TYPE_STRING);
          }
          

          foreach($accion_proyecto as $data_accionProyectoResumen){
            $acc_codigo=$data_accionProyectoResumen['acc_codigo'];
            $acc_indicador=$data_accionProyectoResumen['acc_indicador'];
  
            $sqlRsCantidadPorcentaje=$objRsrprteSbstmaExcel->sqlRsCantidadPorcentaje($acc_codigo);
              if($sqlRsCantidadPorcentaje>0){
                $sqlPorcentaje=$objRsrprteSbstmaExcel->sqlPorcentaje($acc_codigo);
  
                $porcentaje_final=$sqlPorcentaje/$sqlRsCantidadPorcentaje;
                $porcentaje=round($porcentaje_final, 2);
              }
              else{
                $porcentaje=0;
              }
  
              $sqlTotal=$objRsrprteSbstmaExcel->sqlTotal($acc_codigo);
              if($sqlTotal){
                $total=round($sqlTotal, 2);
              }
              else{
                $total=0;
              }

              $totalAccion=$objRsrprteSbstmaExcel->totalAccion($acc_codigo);
              
              /*$totalProyecto=$totalProyecto+$totalAccion;
              $total_proyect=$totalProyecto;*/
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValueExplicit('B'.$num_registro, $acc_indicador,PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('C'.$num_registro, $porcentaje)
            ->setCellValue('D'.$num_registro, $total)
            ->setCellValueExplicit('E'.$num_registro, $totalAccion,PHPExcel_Cell_DataType::TYPE_NUMERIC);
            
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$numero_registroProyecto)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($colorHojaDos);

            $num_registro++; 
          }
        }
      }
      else{
        
        

        $posicion_ResumenA=$numero_registroProyecto+1;
        $num_registro++; 
        $accion_proyecto=$objRsrprteSbstmaExcel->sqlRsAccioProyecto($pro_codigo);
        if($accion_proyecto){

          $cantidad_accionesproyect=COUNT($accion_proyecto);
          if($cantidad_accionesproyect==1){
            $numero_registroProyecto=$posicion_ResumenA;
            $posicion_ResumenA=$posicion_ResumenA+$cantidad_accionesproyect;
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValueExplicit('A'.$numero_registroProyecto, $pro_referencia." ".$pro_descripcion,PHPExcel_Cell_DataType::TYPE_STRING);
          }
          else{
            $numero_registroProyecto=$posicion_ResumenA;
            $celda_proyectoResumen= ($posicion_ResumenA+$cantidad_accionesproyect)-1;
            $posicion_ResumenA=$posicion_ResumenA+$cantidad_accionesproyect;
            $sheet->mergeCells("A".($numero_registroProyecto).":A".($celda_proyectoResumen));
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValueExplicit('A'.$numero_registroProyecto, $pro_referencia." ".$pro_descripcion,PHPExcel_Cell_DataType::TYPE_STRING);
          }

          foreach($accion_proyecto as $data_accionProyectoResumen){
            $acc_codigo=$data_accionProyectoResumen['acc_codigo'];
            $acc_indicador=$data_accionProyectoResumen['acc_indicador'];
  
            $sqlRsCantidadPorcentaje=$objRsrprteSbstmaExcel->sqlRsCantidadPorcentaje($acc_codigo);
              if($sqlRsCantidadPorcentaje>0){
                $sqlPorcentaje=$objRsrprteSbstmaExcel->sqlPorcentaje($acc_codigo);
  
                $porcentaje_final=$sqlPorcentaje/$sqlRsCantidadPorcentaje;
                $porcentaje=round($porcentaje_final, 2);
              }
              else{
                $porcentaje=0;
              }
  
              $sqlTotal=$objRsrprteSbstmaExcel->sqlTotal($acc_codigo);
              if($sqlTotal){
                $total=round($sqlTotal, 2);
              }
              else{
                $total=0;
              }

              $totalAccion=$objRsrprteSbstmaExcel->totalAccion($acc_codigo);

              $totalProyecto=$totalProyecto+$totalAccion;
  
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValueExplicit('B'.$num_registro, $acc_indicador,PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('C'.$num_registro, $porcentaje)
            ->setCellValue('D'.$num_registro, $total)
            ->setCellValueExplicit('E'.$num_registro, $totalAccion,PHPExcel_Cell_DataType::TYPE_NUMERIC);

            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$numero_registroProyecto)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($colorHojaDos);
            $num_registro++;             
          }
          
          $num_registro=$num_registro;
        }
      }
      
      $num_registro+1;
      $numero_registroProyecto=$posicion_ResumenA;
      $valorPorProyecto=$objRsrprteSbstmaExcel->totalProyecto($pro_codigo);

      //Promedio Porcentaje por proyecto
      $cantidad_actividadesProyecto=$objRsrprteSbstmaExcel->cantidadActividadesProyecto($pro_codigo);
      $totalizado=0;
     // $totalizadoProcentaje=0;
      if($cantidad_actividadesProyecto>0){
        $totalizadoAccion=0;
        $actividadProyectoActividad=$objRsrprteSbstmaExcel->sqlRsAtividadProyectoCertificados($pro_codigo);
        foreach($actividadProyectoActividad as $data_actividadProyectoCodigo){
          $act_codigoResumen=$data_actividadProyectoCodigo['act_codigo'];

          $sqlLogroAvanzadoPorcentajeResumen=$objRsrprteSbstmaExcel->sqlLogroAvanzadoPorcentaje($act_codigoResumen);
          $logroporcentajeResumen=$sqlLogroAvanzadoPorcentajeResumen;

          $totalizadoAccion=$totalizadoAccion+$logroporcentajeResumen;
        }
        $totalizado=$totalizadoAccion;
        if($totalizado>0){
          $totalizadoProcentaje=round($totalizado/$cantidad_actividadesProyecto,2);
        }
        else{
          $totalizadoProcentaje=0;
        }      
      }
      else{
        $totalizadoProcentaje=0;
      }



      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValueExplicit('A'.$numero_registroProyecto, '',PHPExcel_Cell_DataType::TYPE_STRING)
      ->setCellValueExplicit('B'.$num_registro, 'PROMEDIO AVANCE PROYECTO',PHPExcel_Cell_DataType::TYPE_STRING)
      ->setCellValueExplicit('C'.$num_registro, $totalizadoProcentaje,PHPExcel_Cell_DataType::TYPE_STRING)
      ->setCellValueExplicit('D'.$num_registro, 'TOTAL PROYECTO $',PHPExcel_Cell_DataType::TYPE_STRING)
      ->setCellValueExplicit('E'.$num_registro, $valorPorProyecto,PHPExcel_Cell_DataType::TYPE_NUMERIC);

      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($styleFuenteLetraHojaDos);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($colorHojaDos);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($styleFuenteLetraHojaDos);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($colorHojaDos);

      if($numerodeproyectos<=$contador_proyecto){
        $num_registro++;
        $numero_registroProyecto++;
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValueExplicit('A'.$numero_registroProyecto, 'PROYECTOS',PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('B'.$num_registro, 'RESULTADO',PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('C'.$num_registro, 'LOGRO %',PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('D'.$num_registro, 'LOGRO TOTAL',PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('E'.$num_registro, 'TOTALES $',PHPExcel_Cell_DataType::TYPE_STRING);

        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$numero_registroProyecto)->applyFromArray($styleFuenteLetraHojaDos);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($styleFuenteLetraHojaDos);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($styleFuenteLetraHojaDos);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($styleFuenteLetraHojaDos);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($styleFuenteLetraHojaDos);

        $num_registro=$num_registro;
      }
      
      // INICIO de Registros //
      $numerodeproyectos++;
      $total_proyect=0;
    }
    $num_registro+2;
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$num_registro, '')
    ->setCellValue('B'.$num_registro, '')
    ->setCellValue('C'.$num_registro, '')
    ->setCellValue('D'.$num_registro, 'TOTAL SUBSISTEMA $')
    ->setCellValueExplicit('E'.$num_registro, $totalSubsistema,PHPExcel_Cell_DataType::TYPE_NUMERIC);

    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($ultimaFila);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($ultimaFila);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($ultimaFila);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($styleFuenteLetraHojaDos);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($colorHojaDos);
    
  }

  // Fin de Registros //

  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(35);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(30);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(40);
  $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);


/****************Fin Hoja Tres *******************************/

/****************Inicio Hoja Cuatro **************************/

  $numero_registro=3;
  //$objPHPExcel->createSheet();
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet()->setTitle('Certificados');

  $colorHojaTres=array(
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




  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A1')->applyFromArray($styleFuenteLetraHojaDos);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B1')->applyFromArray($styleFuenteLetraHojaDos);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C1')->applyFromArray($styleFuenteLetraHojaDos);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D1')->applyFromArray($styleFuenteLetraHojaDos);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E1')->applyFromArray($styleFuenteLetraHojaDos);
  //inicio foreach



  $num_registroHoja3=2;
  $posicion_CertificadoA=2;
  $numero_registroProyectoCertificado=2;
  if ($rsProyectoSubsistema){
    $numerodeproyectos=1;
    foreach ($rsProyectoSubsistema as $data_rsProyectoSubsistema){
      $pro_codigo=$data_rsProyectoSubsistema['pro_codigo'];
      $pro_referencia=$data_rsProyectoSubsistema['pro_referencia'];
      $pro_descripcion=$data_rsProyectoSubsistema['pro_descripcion'];
   
          
      $actividad_proyecto=$objRsrprteSbstmaExcel->sqlRsAtividadProyectoCertificados($pro_codigo);
      if($actividad_proyecto){
        foreach($actividad_proyecto as $data_actividadProyectoCertificado){
          $act_codigo=$data_actividadProyectoCertificado['act_codigo'];
          $act_referencia=$data_actividadProyectoCertificado['act_referencia'];
          $act_descripcion=$data_actividadProyectoCertificado['act_descripcion'];
          $act_fechaexpedicion=$data_actividadProyectoCertificado['act_fechaexpedicion'];
          $act_certificado=$data_actividadProyectoCertificado['act_certificado'];
          $aco_valor=$data_actividadProyectoCertificado['aco_valor'];

          $objPHPExcel->setActiveSheetIndex($numero_registro)
          ->setCellValueExplicit('A'.$num_registroHoja3, $act_certificado,PHPExcel_Cell_DataType::TYPE_STRING)
          ->setCellValue('B'.$num_registroHoja3, substr($act_fechaexpedicion,0,10))
          ->setCellValueExplicit('C'.$num_registroHoja3, $aco_valor,PHPExcel_Cell_DataType::TYPE_NUMERIC)
          ->setCellValue('D'.$num_registroHoja3, $act_referencia)
          ->setCellValue('E'.$num_registroHoja3, $act_descripcion);
          
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registroHoja3)->applyFromArray($colorHojaTres);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registroHoja3)->applyFromArray($colorHojaTres);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registroHoja3)->applyFromArray($colorHojaTres);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registroHoja3)->applyFromArray($colorHojaTres);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registroHoja3)->applyFromArray($colorHojaTres);

          $num_registroHoja3++; 
        }
        $num_registroHoja3=$num_registroHoja3;
      }      
      // INICIO de Registros //
      $numerodeproyectos++;
    }
   
  }

  // Fin de Registros //

  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(25);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(20);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(80);
  $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);



/****************Fin Hoja Cuatro *****************************/


  // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
  $objPHPExcel->setActiveSheetIndex(0);



  // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="Reporte '.$nombre_documento.$fecha_generar.'.xlsx"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  // incluir o gráfico no ficheiro que vamos gerar
  $objWriter->setIncludeCharts(TRUE);
  ob_end_clean();
  $objWriter->save('php://output');
  exit;

?>
