<?php
set_time_limit(1800000000);
$fecha_generar=date('Y-m-d_H:i:s');

/** Incluir la libreria PHPExcel */
require_once 'Classes/PHPExcel.php';
require_once 'Classes\PHPExcel\Worksheet\Drawing.php';
//$persona_entidad=$_SESSION['entidad_persona'];
// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();
//$objWorksheet = $objPHPExcel->getActiveSheet();

// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Cattivo")
->setLastModifiedBy("Cattivo")
->setTitle("Reporte CDP")
->setSubject("Reporte CDP")
->setDescription("Reporte CDP")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Reporte CDP");

$titulo_left = array(
    'font'  => array(
      'bold'  => true,
      'color' => array('rgb' => 'FFFFFF'),
      'size'  => 12,
      'name'  => 'Arial'
    ),
    'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('rgb' => 'B92109')
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

  $subtitulo = array(
    'font'  => array(
      'bold'  => true,
      'color' => array('rgb' => '000000'),
      'size'  => 11,
      'name'  => 'Arial'
    ),
    'borders' => array(
      'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN,
        'color' => array('rgb' => 'B92109')
      )
    ),
    'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'wrap' => true
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'FFFFFF')
    )
  );

  $cuerpoExcelBorderNegro = array(
    'font'  => array(
      'color' => array('rgb' => '000000'),
      'size'  => 11,
      'name'  => 'Arial'
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
      'color' => array('rgb' => 'FFFFFF')
    )
  );
  

  $informacionHoja = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 10,
        'name'  => 'Arial'
      ),
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('rgb' => 'B92109')
        )
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFFFFF')
      )
  );

  $cuerpoExcelSinBold = array(
    'font'  => array(
        'color' => array('rgb' => '000000'),
        'size'  => 10,
        'name'  => 'Arial'
      ),
    
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'wrap' => true
      ),
  );

  $cuerpoExcelSinBoldpeque = array(
    'font'  => array(
        'color' => array('rgb' => '000000'),
        'size'  => 8,
        'name'  => 'Arial'
      ),
    
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'wrap' => true
      ),
  );

  $letrapeque = array(
    'font'  => array(
        'color' => array('rgb' => '000000'),
        'size'  => 8,
        'name'  => 'Arial'
      ),
    
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'wrap' => true
      ),
  );

  $cuerpoExcelSinBorder = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 10,
        'name'  => 'Arial'
      ),
    
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
      ),
  );

  $enunciadoInformacion= array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 10,
        'name'  => 'Arial'
      ),
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('rgb' => 'B92109')
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
  $contenedorLogo=array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFFFFF')
    ),
    'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('rgb' => 'B92109')
        )
      ),
  );

  $contenedorBorde=array(
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
  );
  
  $numero_registro=0;
  $numero_excel=0;
  $numero_ingresos=1;

  $objPHPExcel->getActiveSheet()->setTitle('Reporte CDP');
 

  $sheet = $objPHPExcel->getActiveSheet();
  



                // Establecer el ancho de la celda
 

// INICIO Filas titulos
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A4', 'CODIGO')
  ->setCellValue('C4', 'AP-FIN-FO-08')
  ->setCellValue('I4', 'VERSION')
  ->setCellValue('P4','8')
  ->setCellValue('U4', 'VIGENCIA')
  ->setCellValue('Y4','2021')
  ->setCellValue('AC4', 'PAGINA')
  ->setCellValue('AI4','1 DE 1');

  
   

  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A4')->applyFromArray($enunciadoInformacion);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C4')->applyFromArray($informacionHoja);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I4')->applyFromArray($enunciadoInformacion);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('P4')->applyFromArray($informacionHoja);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('U4')->applyFromArray($enunciadoInformacion);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('Y4')->applyFromArray($informacionHoja);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('AC4')->applyFromArray($enunciadoInformacion);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('AI4')->applyFromArray($informacionHoja);




  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A6:AJ78')->applyFromArray($contenedorBorde);

  $num=1;

  $sheet->mergeCells("C1:AH1");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('C1', "UNIVERSIDAD SURCOLOMBIANA");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C1:AH1")->applyFromArray($titulo_left);

  $sheet->mergeCells("C2:AH2");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('C2',"GESTIÓN FINANCIERA Y DE RECURSOS FÍSICOS");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C2:AH2")->applyFromArray($titulo_left);
  
  $sheet->mergeCells("C3:AH3");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('C3', "FORMATO ÚNICO SOLICITUD DE EXPEDICIÓN CERTIFICADO DE DISPONIBILIDAD PRESUPUESTAL - CDP");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C3:AH3")->applyFromArray($subtitulo);

  $sheet->mergeCells("A1:B3");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A1');
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A1:B3")->applyFromArray($contenedorLogo);


  $sheet->mergeCells("A".($num+3).":B".($num+3));
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num+3).":B".($num+3))->applyFromArray($enunciadoInformacion);

  $sheet->mergeCells("C".($num+3).":H".($num+3));
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C".($num+3).":H".($num+3))->applyFromArray($informacionHoja);

  $sheet->mergeCells("I".($num+3).":O".($num+3));
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I".($num+3).":O".($num+3))->applyFromArray($enunciadoInformacion);

  $sheet->mergeCells("P".($num+3).":T".($num+3));
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("P".($num+3).":T".($num+3))->applyFromArray($informacionHoja);

  $sheet->mergeCells("U".($num+3).":X".($num+3));
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("U".($num+3).":X".($num+3))->applyFromArray($enunciadoInformacion);

  $sheet->mergeCells("Y".($num+3).":AB".($num+3));
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("Y".($num+3).":AB".($num+3))->applyFromArray($informacionHoja);

  $sheet->mergeCells("AC".($num+3).":AH".($num+3));
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AC".($num+3).":AH".($num+3))->applyFromArray($enunciadoInformacion);

  $sheet->mergeCells("AI".($num+3).":AJ".($num+3));
  $objPHPExcel->setActiveSheetIndex($numero_registro);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AI".($num+3).":AJ".($num+3))->applyFromArray($informacionHoja);

  
  $sheet->mergeCells("AI1:AJ3");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('AI1');
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AI1:AJ3")->applyFromArray($contenedorLogo);
  

  // CUERPO EXCEL

  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('AC14', 'X');


  
  $sheet->mergeCells("A6:K6");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A6',"ORDENADOR DEL GASTO:");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A6:K6")->applyFromArray($cuerpoExcelSinBorder);

  
  $sheet->mergeCells("A7:B7");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A7',"NOMBRE:");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A7:B7")->applyFromArray($cuerpoExcelSinBold);

    
  $sheet->mergeCells("A8:B8");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A8',"CARGO:");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A8:B8")->applyFromArray($cuerpoExcelSinBold);

  $sheet->mergeCells("A22:H22");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A22',"EXCEDENTES DE FACULTAD:");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A22:H22")->applyFromArray($cuerpoExcelSinBold);



   
  $sheet->mergeCells("A9:V9");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A9',"RESOLUCIÓN ORDENACIÓN DEL GASTO No:");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A9:V9")->applyFromArray($cuerpoExcelSinBold);

  $sheet->mergeCells("A10:B10");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A10',"FECHA:");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A10:B10")->applyFromArray($cuerpoExcelSinBorder);

  $sheet->mergeCells("U12:AD12");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('U12',"SOLICITUD No.:");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("U12:AD12")->applyFromArray($cuerpoExcelSinBorder);

  $sheet->mergeCells("A14:AF14");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A14',"EXPEDIDO POR: ");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A14:AF14")->applyFromArray($cuerpoExcelSinBorder);


  $sheet->mergeCells("AE12:AI12");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('AE12',"2023-00001");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AE12:AI12")->applyFromArray($cuerpoExcelSinBorder);

  $sheet->mergeCells("C18:AI18");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('C18',"diligenciar por parte del usuario");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C18:AI18")->applyFromArray($cuerpoExcelBorderNegro);

  $sheet->mergeCells("M22:N22");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('M22',"SI");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("M22:N22")->applyFromArray($cuerpoExcelBorderNegro);

  
  $sheet->mergeCells("O22:P22");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('O22'," ");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("O22:P22")->applyFromArray($cuerpoExcelBorderNegro);

  
  $sheet->mergeCells("Q22:R22");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('Q22',"NO");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("Q22:R22")->applyFromArray($cuerpoExcelBorderNegro);


  $sheet->mergeCells("S22:T22");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('S22'," ");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("S22:T22")->applyFromArray($cuerpoExcelBorderNegro);

  $sheet->mergeCells("W22:AI22");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('W22',"en caso de venir agun recursos de excedente marcar si");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("W22:AI22")->applyFromArray($cuerpoExcelSinBold);

  $sheet->mergeCells("A23:H23");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A23',"CON CARGO:");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A23:H23")->applyFromArray($cuerpoExcelSinBold);

  $sheet->mergeCells("A24:H24");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A24',"PLAN DE ACCIÓN:");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A24:H24")->applyFromArray($cuerpoExcelSinBorder);

  $sheet->mergeCells("I24:N24");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('I24',"VALOR");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I24:N24")->applyFromArray($letrapeque);

  $sheet->mergeCells("P24:X24");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('P24',"CODIGO PRESUPUESTAL");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("P24:X24")->applyFromArray($letrapeque);

  

  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('Y24', 'CODIGO DANE');
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('Y24')->applyFromArray($letrapeque);

  $sheet->mergeCells("Z24:AG24");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('Z24',"FUENTE DE FINANCIACIÓN");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("Z24:AG24")->applyFromArray($letrapeque);

  $sheet->mergeCells("AH24:AI24");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('AH24',"ETAPA DE LA ACTIVIDAD No.");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AH24:AI24")->applyFromArray($letrapeque);

  $sheet->mergeCells("A70:N70");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A70',"PROYECTO FONDO ESPECIAL");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A70:N70")->applyFromArray($cuerpoExcelSinBorder);

  $sheet->mergeCells("A71:H71");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A71',"OTROS CONCEPTOS");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A71:H71")->applyFromArray($cuerpoExcelSinBorder);

  $sheet->mergeCells("A72:L72");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A72',"VALOR TOTAL SOLICITADO");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A72:L72")->applyFromArray($cuerpoExcelSinBorder);

  
  $sheet->mergeCells("A75:H75");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A75',"VIGENCIA DEL CDP:");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A75:H75")->applyFromArray($cuerpoExcelSinBorder);

  $sheet->mergeCells("G75:AD75");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('G75',"TENER EN CUENTA LA VIGENCIA DE LOS CONVENIOS");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("G75:AD75")->applyFromArray($cuerpoExcelSinBold);

  $sheet->mergeCells("AE75:AI75");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('AE75',"31/12/2023");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AE75:AI75")->applyFromArray($cuerpoExcelSinBold);

  $sheet->mergeCells("A77:J77");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A77',"Firma Ordenador del Gasto");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A77:J77")->applyFromArray($letrapeque);

  
  $sheet->mergeCells("A78:H78");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A78',"Proyectó:");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A78:H78")->applyFromArray($cuerpoExcelSinBoldpeque);

  $sheet->mergeCells("A79:AJ80");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A79',"Vigilada Mineducación
  La versión vigente y controlada de este documento, solo podrá ser consultada a través del sitio web Institucional  www.usco.edu.co, link Sistema Gestión de Calidad. La copia o impresión diferente a la publicada, será considerada como documento no controlado y su uso indebido no es de responsabilidad de la Universidad Surcolombiana.");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A79:AJ80")->applyFromArray($letrapeque);

  





  $sheet->mergeCells("A18:B18");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A18',"OBJETO");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A18:B18")->applyFromArray($cuerpoExcelSinBorder);

  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('AC14')->applyFromArray($cuerpoExcelSinBold);
 

 // Fin de Registros //



    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(9);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(3);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(3);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(3);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(3);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(3);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(3);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setWidth(3);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('I')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('J')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('K')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('L')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('M')->setWidth(4);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('N')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('O')->setWidth(1);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('P')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('Q')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('R')->setWidth(3);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('S')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('T')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('U')->setWidth(3);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('V')->setWidth(1);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('W')->setWidth(4);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('X')->setWidth(4);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('Y')->setWidth(22);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('Z')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('AA')->setWidth(1);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('AB')->setWidth(1);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('AC')->setWidth(4);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('AD')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('AE')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('AF')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('AG')->setWidth(2);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('AH')->setWidth(1);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('AI')->setWidth(18);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('AJ')->setWidth(2);

 
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(18);

    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('3')->setRowHeight(30);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('4')->setRowHeight(15,8);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('5')->setRowHeight(4,5);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('6')->setRowHeight(15,8);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('7')->setRowHeight(13,5);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('8')->setRowHeight(13,5);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('9')->setRowHeight(13,5);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('10')->setRowHeight(13,5);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('11')->setRowHeight(7,5);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('13')->setRowHeight(6,8);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('17')->setRowHeight(6,3);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('18')->setRowHeight(71);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('19')->setRowHeight(6);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('21')->setRowHeight(6);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('22')->setRowHeight(30);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('23')->setRowHeight(30);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('24')->setRowHeight(23,4);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('76')->setRowHeight(56,3);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('77')->setRowHeight(40,5);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('78')->setRowHeight(16,5);
    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('79')->setRowHeight(42,8);






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
