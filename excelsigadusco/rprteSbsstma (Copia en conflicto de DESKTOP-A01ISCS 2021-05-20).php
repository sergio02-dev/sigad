<?php
/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/
set_time_limit(1800000000);

date_default_timezone_set("America/Bogota");
$hora=time();

//$fecha_actual =date("Y-m-d H:i:00",$hora);

//$fecha_generar=date('Ymd_His');
$fecha_generar=date('Y-m-d h:i:sa', $hora);


$codigo_subsistema=$_REQUEST['codigo_subsistema'];
$year=$_REQUEST['year'];

if($year==20191){
  $trimestreee=1;
}

if($year==20192){
  $trimestreee=2;
}

if($year==20193){
  $trimestreee=3;
}

if($year==20194){
  $trimestreee=4;
}

$nombre_documento="";
if($codigo_subsistema==1){
  $responsableSubsistema="Vicerrectoría Academica";
}
if($codigo_subsistema==2){
  $responsableSubsistema="Vicerrectoría de Investigación";
}
if($codigo_subsistema==3){
  $responsableSubsistema="Vicerrectoría de Proyección Social";
}
if($codigo_subsistema==4){
  $responsableSubsistema="Bienestar Universitario";
}
if($codigo_subsistema==5){
  $responsableSubsistema="Vicerrectoría Administrativa";
}
/** Incluir la libreria PHPExcel */
require_once 'Classes/PHPExcel.php';

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

  $datosNegativos= array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'F91A00'),
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
  $objPHPExcel->getActiveSheet()->setTitle('PROYECTO');

  $sheet = $objPHPExcel->getActiveSheet($numero_registro);
  $sheet->getPageMargins()->setTop(0.6);
  $sheet->getPageMargins()->setBottom(0.6);
  $sheet->getPageMargins()->setHeader(0.4);
  $sheet->getPageMargins()->setFooter(0.4);
  $sheet->getPageMargins()->setLeft(0.4);
  $sheet->getPageMargins()->setRight(0.4);
 

// INICIO Filas titulos
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
  ->setCellValue('L1', 'RESPONSABLE')
  ->setCellValue('M1', 'TRIMESTRE '.$trimestreee);


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
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('M1')->applyFromArray($styleFuenteLetra);

  include('crud/rs/rprteSbstmaExcel.php');

  $nombre_documento=$objRsrprteSbstmaExcel->nombreFormato($codigo_subsistema);

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
    $ArrayCostoAccion= array();
    $ArrayCostoProyecto= array();
    $ArrayProcentajeAccion= array();
    $ArrayPorcentejeProyecto= array();
    $ArrayLogroTotalAccion= array();
    $numeradorAccion=0;
    $numeradorProyecto=0;
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

      $sqlRsAccioProyecto=$objRsrprteSbstmaExcel->sqlRsAccioProyecto($pro_codigo);
      if($sqlRsAccioProyecto){

        $cntdadAccion=COUNT($sqlRsAccioProyecto);
        $cant_accion=1;
        $porcentajeAccion=0;
        $totalTotalAccion=0;
        //Valor Costo del Total de Acciones
        $valorTotalAccion=0;
        foreach($sqlRsAccioProyecto as $data_accionProyecto){
          $acc_codigo=$data_accionProyecto['acc_codigo'];
          $acc_referencia=$data_accionProyecto['acc_referencia'];
          $acc_descripcion=$data_accionProyecto['acc_descripcion'];
          $lineaBaseTa=$data_accionProyecto['acc_lineabase'];/*
          $metaResultado=$data_accionProyecto['acc_metaresultado'];*/
          
          $lineaBase18=$objRsrprteSbstmaExcel->LineaBase($acc_codigo);

          if($acc_codigo==7){
            $metaResultado=$objRsrprteSbstmaExcel->RsMetaHasta2019($acc_codigo);
          }
          else{
            $metaResultado=$objRsrprteSbstmaExcel->MetaResultado($acc_codigo);
          }
           //////////////////////////////////////////////////////////////////
           if(($lineaBase18<=0) || ($acc_codigo==8) || ($acc_codigo==9)){
             $lineaBase=$lineaBaseTa;
           }
           else{
             $lineaBase=$lineaBase18;
           }
         

          $diferenciaMetaLinea=$metaResultado-$lineaBase;

          $cantidad_acciones_proyecto=$objRsrprteSbstmaExcel->cantidadAcciones($pro_codigo);

          $cantidada_actividades_accion=$objRsrprteSbstmaExcel->cantidadActividadAccionExcel($pro_codigo, $acc_codigo, $trimestreee) ;
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
          $actividad_accionProyecto=$objRsrprteSbstmaExcel->sqlRsAtividad($pro_codigo, $acc_codigo, $trimestreee);
          if($actividad_accionProyecto){
            foreach($actividad_accionProyecto as $data_actividad){
              $act_codigo=$data_actividad['act_codigo'];
              $act_referencia=$data_actividad['act_referencia'];
              $act_descripcion=$data_actividad['act_descripcion'];
              $act_certificado=$data_actividad['act_certificado'];
              $act_dependencia=$data_actividad['act_dependencia'];

              $valor_actividadCertificado=$objRsrprteSbstmaExcel->sqlRsValorActividad($act_codigo);

              //Certificado Hijo
              $valor_actividad=$valor_actividadCertificado;
              $certificadoHijo=$objRsrprteSbstmaExcel->certificadoHijo($act_codigo, $trimestreee);
              if($certificadoHijo){
                foreach($certificadoHijo as $data_certificadoHijo){
                  $act_codigoHijo=$data_certificadoHijo['act_codigo'];
                  $act_estadoactividadHijo=$data_certificadoHijo['act_estadoactividad'];
                  $aco_valorHijo=$data_certificadoHijo['aco_valor'];

                  if($act_estadoactividadHijo==2){
                    $valor_actividad=$valor_actividad-$aco_valorHijo;
                  }
                  else{
                    $valor_actividad=$valor_actividad+$aco_valorHijo;
                  }
                }
              }

              //Sumatoria Costo Accion 
              $valorTotalAccion=$valorTotalAccion+$valor_actividad;


              if($act_dependencia>0){
                $reponsable=$objRsrprteSbstmaExcel->RsDependencia($act_dependencia);
              }
              else{
                $reponsable=$responsableSubsistema;
              }
              
              $logroActivity=$objRsrprteSbstmaExcel->sqlLogroAvanzadoPorcentaje($act_codigo, $trimestreee, $year);

             $logro_porcentaje=0;
             foreach ($logroActivity as $data_logroActivity){
               $suma=$data_logroActivity['suma'];

              $logro_porcentaje=$logro_porcentaje+$suma;
             }
             
              $sqlLogroAvanzadoTotal=$objRsrprteSbstmaExcel->sqlLogroAvanzadoTotal($act_codigo, $trimestreee, $year);

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
        
         
          $num_registroAccion++;
          $cantidad_accion++;
          $cant_accion++;
          //Total Porcentaje Acciones 
          $porcentajeAccionesProyecto=$porcentajeAccion/$cantidad_actividadaccionn;
          //Array Porcentaje Accion 
          $ArrayProcentajeAccion[$numeradorAccion]=$porcentajeAccionesProyecto;



          //Total total Acciones
          $totalizadototalAccion=($metaResultado-$lineaBase)*round($porcentajeAccionesProyecto,2)/100;
          if($totalizadototalAccion<0){
            $colorValorNegativo=$datosNegativos;
            $mostrarTotalizadoAccion=round($totalizadototalAccion,2);
          }
          else{
            $colorValorNegativo=$totalizados;
            $mostrarTotalizadoAccion=round($totalizadototalAccion,2);
          }
          //Array Logro Total Accion 
          $ArrayLogroTotalAccion[$numeradorAccion]=$mostrarTotalizadoAccion;

          

          
          //Totalizado por accion

          //totalizado Proyectos 
          $porcentajeProyecto=$porcentajeProyecto+$porcentajeAccionesProyecto;
          $totalTotalProyecto=$totalizadototalAccion+$totalizadototalAccion;
          if($diferenciaMetaLinea<0){
            $colorValores=$datosNegativos;
            $diff_Metalinea=$diferenciaMetaLinea;
          }
          else{
            $diff_Metalinea=$diferenciaMetaLinea;
            $colorValores=$totalizados;
          }
          //Valor Final de la Accion
          $valorFinalAccion=$valorTotalAccion;
          //Array Costo Accion 
          $ArrayCostoAccion[$numeradorAccion]=$valorFinalAccion;
         



          //Acumulao Valor Proyecto
          $costoTotalProyecto=$costoTotalProyecto+$valorFinalAccion;
          $num=$posicion_accion;
          $objPHPExcel->setActiveSheetIndex($numero_registro)
          ->setCellValue('B'.$num, "")
          ->setCellValue('C'.$num, "")
          ->setCellValue('D'.$num, $diff_Metalinea)
          ->setCellValue('E'.$num_registroActividad, "TOTAL ACCIÓN ".substr($acc_referencia,3,8))
          ->setCellValue('F'.$num_registroActividad, "")
          ->setCellValue('G'.$num_registroActividad, $valorFinalAccion)
          ->setCellValue('H'.$num_registroActividad, round($porcentajeAccionesProyecto,2))
          ->setCellValue('I'.$num_registroActividad, round($mostrarTotalizadoAccion));

          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->applyFromArray($colorValorNegativo);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registroActividad)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registroActividad)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registroActividad)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registroActividad)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registroActividad)->applyFromArray($totalizados);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registroActividad)->applyFromArray($colorValores);

          $porcentajeAccion=0;
          $num_registroActividad++;
          $posicion_accion++;
         

          ///Numerador Accion
          $valorTotalAccion=0;
          $numeradorAccion++;
        }
        
      }

      $costoFinalProyecto=$costoTotalProyecto;

      //Array costo total Proyecto 
      $ArrayCostoProyecto[$numeradorProyecto]=$costoFinalProyecto;
      
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

      ///Array Porcentaje Proyecto 
      $ArrayPorcentejeProyecto[$numeradorProyecto]=$proyectoPorcentajeFinal;
      
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

      //Numerador
      
      $numeradorProyecto++;
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
        //'bold'  => true,
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
  
  $celdasRojo= array(
    'font'  => array(
        //'bold'  => true,
        'color' => array('rgb' => 'EB1608'),
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
/////Colores Semaforo
$muyBajo= array(
  'font'  => array(
      'bold'  => true,
      'color' => array('rgb' => 'FFFFFF'),
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
    'color' => array('rgb' => '8D26EE')
  )
);
$bajo= array(
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
    'color' => array('rgb' => 'F6240B')
  )
);
$medio= array(
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
    'color' => array('rgb' => 'DFE085')
  )
);

$alto= array(
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
    'color' => array('rgb' => 'F5F903')
  )
);
$muyAlto= array(
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
    'color' => array('rgb' => '2AE910')
  )
);
 
  $numero_registro=1;
  $objPHPExcel->createSheet();
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet()->setTitle('SEGUIMIENTO TRIMESTRE '.$trimestreee);


  $sheet = $objPHPExcel->getActiveSheet();
  $sheet->getPageMargins()->setTop(0.6);
  $sheet->getPageMargins()->setBottom(0.6);
  $sheet->getPageMargins()->setHeader(0.4);
  $sheet->getPageMargins()->setFooter(0.4);
  $sheet->getPageMargins()->setLeft(0.4);
  $sheet->getPageMargins()->setRight(0.4);

  $nummArr=0;
  $nummArrdos=0;
  $num_registro=1;
  $id_registro=1;
  $numero_arraylogro=0;
  $LogroGrafica= array();
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
      ->setCellValue('A'.$num_registro, 'TRIMESTRE 1');

      $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num_registro).":G".($num_registro))->applyFromArray($trimestre);

      $num_registro++;

      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValue('A'.$num_registro, 'META RESULTADO (1)')
      ->setCellValue('B'.$num_registro, 'LÍNEA BASE 2018  (2)')
      ->setCellValue('C'.$num_registro, 'ACUMULADO PDI  2019    (3)')
      ->setCellValue('D'.$num_registro, 'META 2019 (4)')
      ->setCellValue('E'.$num_registro, 'LOGRO  (5)')
      ->setCellValue('F'.$num_registro, 'DIFERENCIA (6) = 4 - 5')
      ->setCellValue('G'.$num_registro, 'EFICACIA  (7) = 5 / 4')
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
          $lineaBase2014=$data_accioProyectoSeguimiento['acc_lineabase'];
          $metaResultado2014=$data_accioProyectoSeguimiento['acc_metaresultado'];

          $lineaBase=$objRsrprteSbstmaExcel->LineaBase($acc_codigo);
          $metaResultado=$objRsrprteSbstmaExcel->MetaResultado($acc_codigo);


          $diffMetaLinea=$metaResultado-$lineaBase;
          if($diffMetaLinea<0){
            //$difffMetaLinea="-";
            $celdaNormalC=$celdasRojo;
            $difffMetaLinea=$diffMetaLinea;
          }
          else{
            $difffMetaLinea=$diffMetaLinea;
            $celdaNormalC=$celdas;
          }
///asdsa
          $lineaAccionArrEn=$ArrayLogroTotalAccion[$nummArr];

          if($ArrayLogroTotalAccion[$nummArr]<0){
            $celdaNormalE=$celdasRojo;
            $lineaAccionArr=round($ArrayLogroTotalAccion[$nummArr],2);
          }
          else{
             $celdaNormalE=$celdas;
            $lineaAccionArr=round($ArrayLogroTotalAccion[$nummArr],2);
          }
          //Diferencia 
          $diferencia=$difffMetaLinea-$lineaAccionArr;
          if($diferencia<0){
            $celdaNormalF=$celdasRojo;
            $diferencia4mns5=$diferencia;
          }
          else{
            $diferencia4mns5=$diferencia;
            $celdaNormalF=$celdas;
          }
          
          if(($lineaAccionArrEn==0)||($difffMetaLinea==0)){
            $eficiencia=0;
          }
          else{
            $eficiencia=($lineaAccionArrEn/$difffMetaLinea)*100;
          }
        
          

          if($eficiencia<0){
            //$efficiencia="-";
            $celdaNormalG=$celdasRojo;
            $efficiencia=round($eficiencia,2);
          }
          else{
            $celdaNormalG=$celdas;
            $efficiencia=round($eficiencia,2);
          }

          ///Semaforo 
          if($efficiencia<=20){
            $semaforoTablaUno=$muyBajo;
            $textoTablaUno="MUY BAJO";
            $bolitasSemaforo = "img/semaforo/violsemaforo.png";
          }
          if(($efficiencia>20)&&($efficiencia<=40)){
            $semaforoTablaUno=$bajo;
            $textoTablaUno="BAJO";
            $bolitasSemaforo = "img/semaforo/redsemaforo.png";
          }
          if(($efficiencia>40)&&($efficiencia<=60)){
            $semaforoTablaUno=$medio;
            $textoTablaUno="MEDIO";
            $bolitasSemaforo = "img/semaforo/yellowsemaforo.png";
          }
          if(($efficiencia>60)&&($efficiencia<=80)){
            $semaforoTablaUno=$alto;
            $textoTablaUno="ALTO";
            $bolitasSemaforo = "img/semaforo/orangesemaforo.png";
          }
          if($efficiencia>80){
            $semaforoTablaUno=$muyAlto;
            $textoTablaUno="MUY ALTO";
            $bolitasSemaforo = "img/semaforo/greensemaforo.png";
          }

          $objPHPExcel->setActiveSheetIndex($numero_registro)
          ->setCellValue('A'.$num_registro, $acc_indicador)
          ->setCellValue('B'.$num_registro, $lineaBase)
          ->setCellValue('C'.$num_registro, $metaResultado)
          ->setCellValue('D'.$num_registro, round($difffMetaLinea))
          ->setCellValue('E'.$num_registro, round($lineaAccionArr))
          ->setCellValue('F'.$num_registro, round($diferencia4mns5))
          ->setCellValue('G'.$num_registro, round($efficiencia,2))
          ->setCellValue('H'.$num_registro, $textoTablaUno);

          $objDrawing = new PHPExcel_Worksheet_Drawing();
          $objDrawing->setName($textoTablaUno);
          $objDrawing->setDescription($textoTablaUno);
          $objDrawing->setPath($bolitasSemaforo);
          $objDrawing->setCoordinates('I'.$num_registro);   
                          
          //setOffsetX works properly
          $objDrawing->setOffsetX(10); 
          $objDrawing->setOffsetY(5);                
          //set width, height
          $objDrawing->setWidth(50); 
          $objDrawing->setHeight(25); 
          $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
          $objPHPExcel->getActiveSheet()->getRowDimension($num_registro)->setRowHeight(30);


         

          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($celdas);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($celdas);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($celdaNormalC);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($celdas);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($celdaNormalE);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registro)->applyFromArray($celdaNormalF);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->applyFromArray($celdaNormalG);
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num_registro)->applyFromArray($semaforoTablaUno);
         
          
          $num_registro++;
          $nummArr++;

        }
        $nummArr=$nummArr;
      }
      

     //Tabla Dos
     $objPHPExcel->setActiveSheetIndex($numero_registro)
     ->setCellValue('A'.$num_registro, '')
     ->setCellValue('B'.$num_registro, '')
     ->setCellValue('C'.$num_registro, '')
     ->setCellValue('D'.$num_registro, '')
     ->setCellValue('E'.$num_registro, '')
     ->setCellValue('F'.$num_registro, '')
     ->setCellValue('G'.$num_registro, '')
     ->setCellValue('H'.$num_registro, '');

     $num_registro++;
     //Inicio Tabla Dos
     $sheet->mergeCells("A".($num_registro).":G".($num_registro));
     $objPHPExcel->setActiveSheetIndex($numero_registro)
     ->setCellValue('A'.$num_registro, 'ACUMULADO 2015 T 1 2019');

     $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num_registro).":G".($num_registro))->applyFromArray($trimestre);

     $num_registro++;

     $objPHPExcel->setActiveSheetIndex($numero_registro)
     ->setCellValue('A'.$num_registro, 'META RESULTADO (1)')
     ->setCellValue('B'.$num_registro, 'LÍNEA BASE 2014  (2)')
     ->setCellValue('C'.$num_registro, 'ACUMULADO PDI T 1 2019 (3) = LINEA BASE 2018 + META 2019 / 4)')
     ->setCellValue('D'.$num_registro, 'LOGRO HASTA T 1 2019 (4) = LINEA BASE 2018 + LOGRO T1 2019')
     ->setCellValue('E'.$num_registro, 'DIFERENCIA (5) = 4 - 5')
     ->setCellValue('F'.$num_registro, 'EFICACIA (6) = 4 / 3')
     ->setCellValue('G'.$num_registro, 'RANGO INDICADOR DE EFICACIA');

     $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($encabezado);
     $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($encabezado);
     $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($encabezado);
     $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($encabezado);
     $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($encabezado);
     $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registro)->applyFromArray($encabezado);
     $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->applyFromArray($encabezado);
     $num_registro++;

     
     
     $accion_ProyectoSeguimientoDos=$objRsrprteSbstmaExcel->sqlRsAccioProyecto($pro_codigo);
     if($accion_ProyectoSeguimientoDos){
       foreach($accion_ProyectoSeguimientoDos as $data_accioProyectoSeguimientoDos){
         $acc_codigoo=$data_accioProyectoSeguimientoDos['acc_codigo'];
         $acc_referencia=$data_accioProyectoSeguimientoDos['acc_referencia'];
         $acc_descripcion=$data_accioProyectoSeguimientoDos['acc_descripcion'];
         $acc_indicador=$data_accioProyectoSeguimientoDos['acc_indicador'];
         $lineaBase2014=$data_accioProyectoSeguimientoDos['acc_lineabase'];
         $metaResultado2014=$data_accioProyectoSeguimientoDos['acc_metaresultado'];

         $lineaBase=$objRsrprteSbstmaExcel->LineaBase($acc_codigoo);
         $metaResultado=$objRsrprteSbstmaExcel->MetaResultado($acc_codigoo);

         $valorEsperado=$objRsrprteSbstmaExcel->lineaBase2018($acc_codigo);

         $diffMetaLineaVla=$metaResultado-$lineaBase;

         $cmpoC=$valorEsperado+(($diffMetaLineaVla/4)*$trimestreee);
         if($cmpoC>0){
           $celdasCC=$celdas;
          $campoC=round($cmpoC,2);
         }
         else{
           $celdasCC=$celdasRojo;
           $campoC=round($cmpoC,2);
         }

         $diffMetaLinea=$metaResultado-$lineaBase;
         if($diffMetaLinea<0){
           //$difffMetaLinea="-";
           $difffMetaLinea=$diffMetaLinea;
         }
         else{
           $difffMetaLinea=$diffMetaLinea;
         }

         $lineaAccionArrEn=round($ArrayProcentajeAccion[$nummArrdos],2);

         if($ArrayProcentajeAccion[$nummArrdos]<0){
           //$lineaAccionArr="-";
           $lineaAccionArr=round($ArrayProcentajeAccion[$nummArrdos],2);
         }
         else{
           $lineaAccionArr=round($ArrayProcentajeAccion[$nummArrdos],2);
         }

         //Campo D 
         $cmpoD=$lineaBase+$lineaAccionArrEn;
         if($cmpoD>0){
           $celdasDD=$celdas;
           $campoD=$cmpoD;
         }
         else{
          $celdasDD=$celdasRojo;
           //$campoD="-";
           $campoD=$cmpoD;
         }

         $numero_arraylogro=0;
         //$LogroGrafica[$numero_arraylogro]=new arra();

         $cmpoE=$cmpoD-$cmpoC;
         if($cmpoE<0){
           $celdasEE=$celdasRojo;
         }
         else{
          $celdasEE=$celdas;
         }

        if($cmpoD>0 && $cmpoC>0){
          $cmpoF=($cmpoD/$cmpoC)*100;
        }
        else{
          $cmpoF=0;
        }

         if($cmpoF<0){
           $celdasFF=$celdasRojo;
         }
         else{
           $celdasFF=$celdas;
         }

         ///Semaforo 
        if($cmpoF<=20){
          $semaforoTablaDos=$muyBajo;
          $textoTablaDos="MUY BAJO";
          $bolitasSemaforoDos="img/semaforo/violsemaforo.png";
        }
        if(($cmpoF>20)&&($cmpoF<=40)){
          $semaforoTablaDos=$bajo;
          $textoTablaDos="BAJO";
          $bolitasSemaforoDos="img/semaforo/redsemaforo.png";

        }
        if(($cmpoF>40)&&($cmpoF<=60)){
          $semaforoTablaDos=$medio;
          $textoTablaDos="MEDIO";
          $bolitasSemaforoDos = "img/semaforo/yellowsemaforo.png";

        }
        if(($cmpoF>60)&&($cmpoF<=80)){
          $semaforoTablaDos=$alto;
          $textoTablaDos="ALTO";
          $bolitasSemaforoDos = "img/semaforo/orangesemaforo.png";

        }
        if($cmpoF>80){
          $semaforoTablaDos=$muyAlto;
          $textoTablaDos="MUY ALTO";
          $bolitasSemaforoDos = "img/semaforo/greensemaforo.png";

        }


         $objPHPExcel->setActiveSheetIndex($numero_registro)
         ->setCellValue('A'.$num_registro, $acc_indicador)
         ->setCellValue('B'.$num_registro, $lineaBase2014)
         ->setCellValue('C'.$num_registro, round($campoC))
         ->setCellValue('D'.$num_registro, round($campoD))
         ->setCellValue('E'.$num_registro, round($cmpoE))
         ->setCellValue('F'.$num_registro, round($cmpoF,2))
         ->setCellValue('G'.$num_registro, $textoTablaDos);

         
         $objDrawing = new PHPExcel_Worksheet_Drawing();
         $objDrawing->setName($textoTablaDos);
         $objDrawing->setDescription($textoTablaDos);
         $objDrawing->setPath($bolitasSemaforoDos);
         $objDrawing->setCoordinates('H'.$num_registro);   


          //setOffsetX works properly
          $objDrawing->setOffsetX(10); 
          $objDrawing->setOffsetY(5);                
          //set width, height
          $objDrawing->setWidth(50); 
          $objDrawing->setHeight(25); 
          $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
          $objPHPExcel->getActiveSheet()->getRowDimension($num_registro)->setRowHeight(30);

         $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($celdas);
         $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($celdas);
         $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($celdasCC);
         $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($celdasDD);
         $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($celdasEE);
         $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num_registro)->applyFromArray($celdasFF);
         $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num_registro)->applyFromArray($semaforoTablaDos);
        
         
         $num_registro++;
         $nummArrdos++;

       }
       $nummArrdos=$nummArrdos;
      
     }
   
     $objPHPExcel->setActiveSheetIndex($numero_registro)
     ->setCellValue('A'.$num_registro, '')
     ->setCellValue('B'.$num_registro, '')
     ->setCellValue('C'.$num_registro, '')
     ->setCellValue('D'.$num_registro, '')
     ->setCellValue('E'.$num_registro, '')
     ->setCellValue('F'.$num_registro, '')
     ->setCellValue('G'.$num_registro, '')
     ->setCellValue('H'.$num_registro, '');

     $num_registro++;

     
    }
      
    $num_registro=$num_registro;
  }
  

  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(45);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(18);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(12);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(10);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(15);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(13);
  $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setWidth(13);
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
  $objPHPExcel->getActiveSheet()->setTitle('RESUMEN');

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
  ->setCellValue('E1', 'TOTALES $');




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
  $contadorAccion=0;
  $contadorProyecto=0;
  $costoSubsistema=0;
  $promedioProyecto=0;
  if ($rsProyectoSubsistema) {
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
  
                       
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValueExplicit('B'.$num_registro, $acc_indicador,PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('C'.$num_registro, round($ArrayProcentajeAccion[$contadorAccion],2))
            ->setCellValue('D'.$num_registro, round($ArrayLogroTotalAccion[$contadorAccion],2))
            ->setCellValueExplicit('E'.$num_registro, $ArrayCostoAccion[$contadorAccion],PHPExcel_Cell_DataType::TYPE_NUMERIC);
            
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$numero_registroProyecto)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($colorHojaDos);

            $num_registro++; 
            ///Contador Accion
            $contadorAccion++;
           
            $contadorAccion=$contadorAccion;
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
  
  
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValueExplicit('B'.$num_registro, $acc_indicador,PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('C'.$num_registro, round($ArrayProcentajeAccion[$contadorAccion],2))
            ->setCellValue('D'.$num_registro, round($ArrayLogroTotalAccion[$contadorAccion],2))
            ->setCellValueExplicit('E'.$num_registro, $ArrayCostoAccion[$contadorAccion],PHPExcel_Cell_DataType::TYPE_NUMERIC);

            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$numero_registroProyecto)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($colorHojaDos);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($colorHojaDos);
            $num_registro++;    
            
            
            ///Contador Accion
            $contadorAccion++;
          }
          
          $num_registro=$num_registro;
        }
      }
      
      $num_registro+1;
      $numero_registroProyecto=$posicion_ResumenA;

      //Semaforo
      if(round($ArrayPorcentejeProyecto[$contadorProyecto],2)<=20){
        $semaforoResumen=$muyBajo;
      }
      if((round($ArrayPorcentejeProyecto[$contadorProyecto],2)>20)&&(round($ArrayPorcentejeProyecto[$contadorProyecto],2)<=40)){
        $semaforoResumen=$bajo;
      }
      if((round($ArrayPorcentejeProyecto[$contadorProyecto],2)>40)&&(round($ArrayPorcentejeProyecto[$contadorProyecto],2)<=60)){
        $semaforoResumen=$medio;
      }
      if((round($ArrayPorcentejeProyecto[$contadorProyecto],2)>60)&&(round($ArrayPorcentejeProyecto[$contadorProyecto],2)<=80)){
        $semaforoResumen=$alto;
      }
      if(round($ArrayPorcentejeProyecto[$contadorProyecto],2)>80){
        $semaforoResumen=$muyAlto;
      }

      $promedioProyecto=$promedioProyecto+round($ArrayPorcentejeProyecto[$contadorProyecto],2);

      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValueExplicit('A'.$numero_registroProyecto, '',PHPExcel_Cell_DataType::TYPE_STRING)
      ->setCellValueExplicit('B'.$num_registro, 'PROMEDIO AVANCE PROYECTO',PHPExcel_Cell_DataType::TYPE_STRING)
      ->setCellValueExplicit('C'.$num_registro, (round($ArrayPorcentejeProyecto[$contadorProyecto],2)/100),PHPExcel_Cell_DataType::TYPE_STRING)
      ->setCellValueExplicit('D'.$num_registro, 'TOTAL PROYECTO $',PHPExcel_Cell_DataType::TYPE_STRING)
      ->setCellValueExplicit('E'.$num_registro, $ArrayCostoProyecto[$contadorProyecto],PHPExcel_Cell_DataType::TYPE_NUMERIC);

      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($styleFuenteLetraHojaDos);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($semaforoResumen);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->getNumberFormat()->applyFromArray(array('code'=> PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($styleFuenteLetraHojaDos);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->applyFromArray($colorHojaDos);

      $num_registro++;
      $numero_registroProyecto++;

      //Total Subsistema 
      $costoSubsistema=$costoSubsistema+$ArrayCostoProyecto[$contadorProyecto];

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
      //Contador Proyecto 
      $contadorProyecto++;
    }
    if(($promedioProyecto==0) ||($contador_proyecto==0)){
     $promediofinalProyecto=0;
    }
    else{
      $promediofinalProyecto=$promedioProyecto/$contador_proyecto;
    }

    //Semaforo Subsistema
      if($promediofinalProyecto<=20){
        $semaforoSubsistema=$muyBajo;
      }
      if(($promediofinalProyecto>20)&&($promediofinalProyecto<=40)){
        $semaforoSubsistema=$bajo;
      }
      if(($promediofinalProyecto>40)&&($promediofinalProyecto<=60)){
        $semaforoSubsistema=$medio;
      }
      if(($promediofinalProyecto>60)&&($promediofinalProyecto<=80)){
        $semaforoSubsistema=$alto;
      }
      if($promediofinalProyecto>80){
        $semaforoSubsistema=$muyAlto;
      }

      $valorPromedioProyecto=$promediofinalProyecto/100;
    $num_registro+2;
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$num_registro, '')
    ->setCellValue('B'.$num_registro, 'PROMEDIO AVANCE SUBSISTEMA')
    ->setCellValue('C'.$num_registro, $valorPromedioProyecto)
    ->setCellValue('D'.$num_registro, 'TOTAL SUBSISTEMA $')
    ->setCellValueExplicit('E'.$num_registro, $costoSubsistema,PHPExcel_Cell_DataType::TYPE_NUMERIC);

    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num_registro)->applyFromArray($ultimaFila);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num_registro)->applyFromArray($styleFuenteLetraHojaDos);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->applyFromArray($semaforoSubsistema);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num_registro)->getNumberFormat()->applyFromArray(array('code'=> PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num_registro)->applyFromArray($styleFuenteLetraHojaDos);
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
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
  $objPHPExcel->createSheet();
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
   
          
      $actividad_proyecto=$objRsrprteSbstmaExcel->sqlRsAtividadProyectoCertificados($pro_codigo, $trimestreee);
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

/***************Inicio Hoja Cinco ****************************/

/*********************Inicio Grafica ****************************/
$numero_registro=4;
$objPHPExcel->setActiveSheetIndex($numero_registro);
$objPHPExcel->getActiveSheet()->setTitle('Graficas');
$nombreHoja="Graficas";
/*
$objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A1', '')
  ->setCellValue('B1', '2010')
  ->setCellValue('C1', '2011')
  ->setCellValue('D1', '2012');


$objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A2', 'Q1')
  ->setCellValue('B2', '12')
  ->setCellValue('C2', '15')
  ->setCellValue('D2', '21');


$objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A3', 'Q2')
  ->setCellValue('B3', '56')
  ->setCellValue('C3', '73')
  ->setCellValue('D3', '86');

$objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A4', 'Q3')
  ->setCellValue('B4', '52')
  ->setCellValue('C4', '61')
  ->setCellValue('D4', '69');

$objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A5', 'Q4')
  ->setCellValue('B5', '30')
  ->setCellValue('C5', '32')
  ->setCellValue('D5', '0');

//	Set the Labels for each data series we want to plot
//		Datatype
//		Cell reference for data
//		Format Code
//		Number of datapoints in series
//		Data values
//		Data Marker
$dataseriesLabels = array(
	new PHPExcel_Chart_DataSeriesValues('String', $nombreHoja.'!$B$1', null, 1),	//	2010
	new PHPExcel_Chart_DataSeriesValues('String', $nombreHoja.'!$C$1', null, 1),	//	2011
	new PHPExcel_Chart_DataSeriesValues('String', $nombreHoja.'!$D$1', null, 1),	//	2012
);
//	Set the X-Axis Labels
//		Datatype
//		Cell reference for data
//		Format Code
//		Number of datapoints in series
//		Data values
//		Data Marker
$xAxisTickValues = array(
	new PHPExcel_Chart_DataSeriesValues('String', $nombreHoja.'!$A$2:$A$5', null, 4),	//	Q1 to Q4
);
//	Set the Data values for each data series we want to plot
//		Datatype
//		Cell reference for data
//		Format Code
//		Number of datapoints in series
//		Data values
//		Data Marker
$dataSeriesValues = array(
	new PHPExcel_Chart_DataSeriesValues('Number', $nombreHoja.'!$B$2:$B$5', null, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', $nombreHoja.'!$C$2:$C$5', null, 4),
	new PHPExcel_Chart_DataSeriesValues('Number', $nombreHoja.'!$D$2:$D$5', null, 4),
);
//	Build the dataseries
$series = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_LINECHART,		// plotType
	PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
	range(0, count($dataSeriesValues)-1),			// plotOrder
	$dataseriesLabels,								// plotLabel
	$xAxisTickValues,								// plotCategory
	$dataSeriesValues								// plotValues
);
//	Set the series in the plot area
$plotarea = new PHPExcel_Chart_PlotArea(null, array($series));
//	Set the chart legend
$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_TOPRIGHT, null, false);
$title = new PHPExcel_Chart_Title('Test Stacked Line Chart');
$yAxisLabel = new PHPExcel_Chart_Title('Value ($k)');
//	Create the chart
$chart = new PHPExcel_Chart(
	'chart1',		// name
	$title,			// title
	$legend,		// legend
	$plotarea,		// plotArea
	true,			// plotVisibleOnly
	0,				// displayBlanksAs
	null,			// xAxisLabel
	$yAxisLabel		// yAxisLabel
);
//	Set the position where the chart should appear in the worksheet
$chart->setTopLeftPosition('A7');
$chart->setBottomRightPosition('H18');
//	Add the chart to the worksheet
//$objPHPExcel->addChart($chart);
$sheet->addChart($chart);
*/

/*********************Fin Grafica  *****************************/


// Fin de Registros //

/*
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(25);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(80);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);*/




/*****************Fin Hoja cinco  ******************************/

  // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
  $objPHPExcel->setActiveSheetIndex(0);



  // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="Reporte '.$nombre_documento.$fecha_generar.'-trimestre'.$trimestreee.'.xlsx"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  // incluir o gráfico no ficheiro que vamos gerar
  $objWriter->setIncludeCharts(TRUE);
  ob_end_clean();
  $objWriter->save('php://output');
  exit;

?>
