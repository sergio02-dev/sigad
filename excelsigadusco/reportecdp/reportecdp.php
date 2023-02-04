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

  $letrapeque =array(
    'font' => array(
        'color' => array('rgb' => '000000'),
        'size' => 8,
        'name' => 'Arial'
    ),
    'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'wrap' => true
    )
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

  function tildes($palabra){
    $no_admitidas = array("á","é","í","ó","ú");
    $admitidas = array("Á", "É", "Í", "Ó", "Ú");
    $texto = str_replace($no_admitidas, $admitidas ,$palabra);
    return $texto;
  }
  
  function tldes_minuscula($palabra){
    $no_admitidas = array("Á", "É", "Í", "Ó", "Ú");
    $admitidas = array("á","é","í","ó","ú");
    $texto = str_replace($no_admitidas, $admitidas ,$palabra);
    return $texto;
  }
  

  
  $codigo_cdp = $_REQUEST['codigo_cdp'];
  $numero_registro=0;
  $numero_excel=0;
  $numero_ingresos=1;

  $objPHPExcel->getActiveSheet()->setTitle('Reporte CDP');
 
  $sheet = $objPHPExcel->getActiveSheet();
  

  
  $sheet = $objPHPExcel->getActiveSheet($numero_registro);
  $sheet->getPageMargins()->setTop(0.6);
  $sheet->getPageMargins()->setBottom(0.6);
  $sheet->getPageMargins()->setHeader(0.4);
  $sheet->getPageMargins()->setFooter(0.4);
  $sheet->getPageMargins()->setLeft(0.4);
  $sheet->getPageMargins()->setRight(0.4);

  $num=1;

                // Establecer el ancho de la celda
 

// INICIO Filas titulos
 $sheet->mergeCells("AK4:AM4");
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('AK4', $codigo_cdp);

$sheet->mergeCells("A4:B4");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A4','CODIGO');

$sheet->mergeCells("A4:B4");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A4','CODIGO');

  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A4:B4")->applyFromArray($enunciadoInformacion);
  $sheet->mergeCells("C4:H4");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('C4', 'AP-FIN-FO-08');

  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C4:H4")->applyFromArray($informacionHoja);

  $sheet->mergeCells("I4:O4");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('I4', 'VERSION');

  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I4:O4")->applyFromArray($enunciadoInformacion);

  $sheet->mergeCells("P4:T4");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('P4','8');

  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("P4:T4")->applyFromArray($informacionHoja);

  $sheet->mergeCells("U4:X4");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('U4', 'VIGENCIA');

  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("U4:X4")->applyFromArray($enunciadoInformacion);

  $sheet->mergeCells("Y4:AB4");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('Y4','2021');

  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("Y4:AB4")->applyFromArray($informacionHoja);

  $sheet->mergeCells("AC4:AH4");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('AC4', 'PAGINA');

  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AC4:AH4")->applyFromArray($enunciadoInformacion);
  
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
  ->setCellValue('A1','');
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A1:B3")->applyFromArray($contenedorLogo);
  
  $sheet->mergeCells("AI1:AJ3");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('AI1', ' ');
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AI1:AJ3")->applyFromArray($contenedorLogo);


  $sheet->mergeCells("AI4:AJ4");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('AI4', '1 DE 1');
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AI4:AJ4")->applyFromArray($informacionHoja);

  //FIN ENCABEZADO

  // CUERPO EXCEL

  //IMAGEN LOGOTIPOS

  $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setName('hola');
                    $objDrawing->setDescription('hola');
                    $objDrawing->setPath('plantilla/img/logo.png');
                    $objDrawing->setCoordinates('A1');   
                                    
                    //setOffsetX works properly
                    $objDrawing->setOffsetX(5); 
                    $objDrawing->setOffsetY(5);                
                    //set width, heigh
                    $objDrawing->setWidth(80); 
                    $objDrawing->setHeight(80); 
                    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                
                    $objPHPExcel->getActiveSheet()->getRowDimension($num)->setRowHeight(150);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle(0)->applyFromArray($enunciadoInformacion);


                    $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setName('hola');
                    $objDrawing->setDescription('hola');
                    $objDrawing->setPath('plantilla/img/log.png');
                    $objDrawing->setCoordinates('AI2');   
                                    
                    //setOffsetX works properly
                    $objDrawing->setOffsetX(4); 
                    $objDrawing->setOffsetY(1);                
                    //set width, heigh
                    $objDrawing->setWidth(100); 
                    $objDrawing->setHeight(50); 
                    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                
                    $objPHPExcel->getActiveSheet()->getRowDimension($num)->setRowHeight(150);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle(0)->applyFromArray($informacionHoja);

  //FIN IMAGENES


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

  $sheet->mergeCells("P24:W24");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('P24',"CODIGO PRESUPUESTAL");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("P24:W24")->applyFromArray($letrapeque);

  $sheet->mergeCells("X24:Y24");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('X24',"CODIGO DANE");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("X24:Y24")->applyFromArray($letrapeque);

  $sheet->mergeCells("AA24:AG24");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('AA24',"FUENTE DE FINANCIACIÓN");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AA24:AG24")->applyFromArray($letrapeque);

  $sheet->mergeCells("AH24:AI24");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('AH24',"ETAPA DE LA ACTIVIDAD No.");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AH24:AI24")->applyFromArray($letrapeque);

  $sheet->mergeCells("A51:H51");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A51',"PROYECTO FONDO ESPECIAL");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A51:H51")->applyFromArray($cuerpoExcelSinBorder);

  $sheet->mergeCells("A71:H71");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A71',"OTROS CONCEPTOS");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A71:H71")->applyFromArray($cuerpoExcelSinBorder);

  $sheet->mergeCells("A72:H72");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A72',"VALOR TOTAL SOLICITADO");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A72:H72")->applyFromArray($cuerpoExcelSinBorder);

  $sheet->mergeCells("A75:H75");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A75',"VIGENCIA DEL CDP:");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A75:H75")->applyFromArray($cuerpoExcelSinBorder);

  

  $sheet->mergeCells("I75:AD75");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('I75',"TENER EN CUENTA LA VIGENCIA DE LOS CONVENIOS");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I75:AD75")->applyFromArray($cuerpoExcelSinBold);
  


  $sheet->mergeCells("AE75:AI75");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('AE75',"31/12/2023");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AE75:AI75")->applyFromArray($cuerpoExcelSinBold);

  $sheet->mergeCells("A77:H77");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A77',"Firma Ordenador del Gasto");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A75:H75")->applyFromArray($letrapeque);


  $sheet->mergeCells("A78:H78");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A78',"Proyectó");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A78:H78")->applyFromArray($cuerpoExcelSinBold);

  $sheet->mergeCells("A79:AJ79");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A79',"Vigilada Mineducación
  La versión vigente y controlada de este documento, solo podrá ser consultada a través del sitio web Institucional  www.usco.edu.co, link Sistema Gestión de Calidad. La copia o impresión diferente a la publicada, será considerada como documento no controlado y su uso indebido no es de responsabilidad de la Universidad Surcolombiana.");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A79:AJ79")->applyFromArray($letrapeque);

  $sheet->mergeCells("A18:B18");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('A18',"OBJETO");
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A18:B18")->applyFromArray($cuerpoExcelSinBorder);

  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('AC14')->applyFromArray($cuerpoExcelSinBold);


  //insert datos 
  include('crud/rs/rprte_slctud_cdp/rprte_slctud_cdp.php');
  
  list($people,$car_nombre,$scdp_resolucion,$scdp_fecharesolucion,$scdp_objeto,$scdp_consecutivo,$scdp_numero) = $objRprteSlctudCdp->nombrePersona($codigo_cdp);
  

  $sheet->mergeCells("C7:M7");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('C7', strtoupper(tildes($people)));

  $sheet->mergeCells("C8:M8");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('C8', strtoupper(tildes($car_nombre)));

  $sheet->mergeCells("W9:Z9");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('W9', strtoupper(tildes($scdp_resolucion)));

  $sheet->mergeCells("C10:M10");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('C10', $scdp_fecharesolucion);

  $sheet->mergeCells("C18:AI18");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('C18', strtoupper(tildes($scdp_objeto)));

  $ceros = '';

  if($scdp_consecutivo <10){
    $ceros = '0000';
    $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;
  }else if ($scdp_consecutivo > 9 && $scdp_consecutivo <100){
    $ceros = '000';
    $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;
  }else if( $scdp_consecutivo >99 && $scdp_consecutivo <1000){
    $ceros = '00';
    $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;
  }else if( $scdp_consecutivo >999 && $scdp_consecutivo <10000){
    $ceros = '0';
    $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;
  }else{
    $numero_solicitudCDP = $scdp_numero.'-'.$scdp_consecutivo;
  }


  $sheet->mergeCells("AE12:AI12");
  $objPHPExcel->setActiveSheetIndex($numero_registro)
  ->setCellValue('AE12',$numero_solicitudCDP);
  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("AE12:AI12")->applyFromArray($cuerpoExcelSinBorder);





  //inicio foreach lista etapas

  $lista_poai = $objRprteSlctudCdp->poai($codigo_cdp);
  $num_registro=25;
  $id_registro=1;
  if($lista_poai){
    foreach ($lista_poai as $data_lista_etapa) {
      $poa_referencia = $data_lista_etapa['poa_referencia'];
      $poa_numero = $data_lista_etapa['poa_numero'];
      $esc_valor = $data_lista_etapa['esc_valor'];
      $esc_clasificador = $data_lista_etapa['esc_clasificador'];
      
      $str = $esc_clasificador;
      $numero_caracteres = strlen($str); 
      $desde = $numero_caracteres - 2;
      $ultimos_caracteres= substr($str,$desde,2);

      $fuente = $objRprteSlctudCdp->fuentes_financiacionCDP($ultimos_caracteres);
      
      $poa_etapa = $poa_referencia." ".$poa_numero;
      

      $objPHPExcel->setActiveSheetIndex($numero_registro)
      ->setCellValue('AI'.$num_registro, $poa_etapa);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('AI'.$num_registro)->applyFromArray($letrapeque);
      
      $sheet->mergeCells("I".($num_registro).":N".($num_registro))
      ->setCellValue("I".$num_registro, $esc_valor);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registro)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);

      $sheet->mergeCells("AA".($num_registro).":AG".($num_registro))
      ->setCellValue('AA'.$num_registro, $fuente);
      $objPHPExcel->getActiveSheet($numero_registro)->getStyle('AA'.$num_registro)->getNumberFormat();

      $num_registro++;
    }
  }
  $num_registro=$num_registro;

  //fin




  //fin insert datos

  
 // Fin de Registros //


//TAMAÑOS COLUMNAS
    
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




//TAMAÑO ALTURA 
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(18);

$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('3')->setRowHeight(30);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('4')->setRowHeight(16);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('5')->setRowHeight(5);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('6')->setRowHeight(16);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('7')->setRowHeight(14);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('8')->setRowHeight(14);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('9')->setRowHeight(14);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('10')->setRowHeight(14);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('11')->setRowHeight(8);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('13')->setRowHeight(7);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('17')->setRowHeight(7);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('18')->setRowHeight(71);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('19')->setRowHeight(6);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('21')->setRowHeight(6);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('22')->setRowHeight(30);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('23')->setRowHeight(30);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('24')->setRowHeight(24);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('76')->setRowHeight(57);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('77')->setRowHeight(41);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('78')->setRowHeight(17);
$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension('79')->setRowHeight(43);





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