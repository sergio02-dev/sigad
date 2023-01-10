<?php
set_time_limit(180000000000);
ini_set('memory_limit', '512M');
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
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'B92109')
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
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    )
);

$datos_dinero=array(
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

function tildes($palabra){
    $no_admitidas = array("á","é","í","ó","ú");
    $admitidas = array("Á", "É", "Í", "Ó", "Ú");
    $texto = str_replace($no_admitidas, $admitidas ,$palabra);
    return $texto;
}

$codigo_plan = $_REQUEST['codigo_plan'];
$vigencia = $_REQUEST['vigencia'];
$acuerdo = $_REQUEST['acuerdo'];

include('crud/rs/poai/rprte_poai.php');
include('crud/rs/poai/rprte_poai_actos.php');
//objReportePoaiActs

$nombre_casilla_a = $objReportePoai->nombre_casilla($codigo_plan);

$list_fuente_financiacion = $objReportePoaiActs->list_fuente_financiacion($codigo_plan, $vigencia, $acuerdo);

// INICIO Filas titulos
$objPHPExcel->setActiveSheetIndex($numero_registro)
->setCellValue('A1', strtoupper(tildes($nombre_casilla_a)));
$objPHPExcel->getActiveSheet($numero_registro)->getStyle("A1")->applyFromArray($styleFuenteLetra);

$numeroletasaumenta = 66;
$numeroletrauno = 66;
$numeroletrados = 64;
if($list_fuente_financiacion){
    foreach ($list_fuente_financiacion as $dta_lsta_fuente_financiacion) {
        $ffi_codigo = $dta_lsta_fuente_financiacion['ffi_codigo'];
        $ffi_nombre = $dta_lsta_fuente_financiacion['ffi_nombre'];
        $vigencia_fuente = $dta_lsta_fuente_financiacion['vigencia_fuente'];

        if($numeroletasaumenta>90){//si es mayor a 90 
            if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                $numeroletrauno=65;
                $numeroletrados++;
            }
            else{//Si no que siga aumentando
                $numeroletrauno++;
            }//cierre else
            $letra=chr($numeroletrados).''.chr($numeroletrauno);
            //echo "qui <br>";
        }//fin si primera condicion
        else{//Sino Primera condicion
            $letra=chr($numeroletasaumenta);
            $numeroletrauno++;
        }

        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue($letra.'1', str_replace('INV -','',$ffi_nombre)." ".$vigencia_fuente);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.'1')->applyFromArray($styleFuenteLetra);
        
        $numeroletasaumenta++;
    }
}
//ultimas total
if($numeroletasaumenta>90){//si es mayor a 90 
    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
        $numeroletrauno=65;
        $numeroletrados++;
    }
    else{//Si no que siga aumentando
        $numeroletrauno++;
    }//cierre else
    $letra=chr($numeroletrados).''.chr($numeroletrauno);
    //echo "qui <br>";
}//fin si primera condicion
else{//Sino Primera condicion
    $letra=chr($numeroletasaumenta);
    $numeroletrauno++;
}

$objPHPExcel->setActiveSheetIndex($numero_registro)
->setCellValue($letra.'1', 'TOTAL');
$objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.'1')->applyFromArray($styleFuenteLetra);
$numeroletasaumenta++;
//columnas SEDE
if($numeroletasaumenta>90){//si es mayor a 90 
    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
        $numeroletrauno=65;
        $numeroletrados++;
    }
    else{//Si no que siga aumentando
        $numeroletrauno++;
    }//cierre else
    $letra=chr($numeroletrados).''.chr($numeroletrauno);
    //echo "qui <br>";
}//fin si primera condicion
else{//Sino Primera condicion
    $letra=chr($numeroletasaumenta);
    $numeroletrauno++;
}

$objPHPExcel->setActiveSheetIndex($numero_registro)
->setCellValue($letra.'1', 'SEDE');
$objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.'1')->applyFromArray($styleFuenteLetra);
$numeroletasaumenta++;
//UNIDAD
if($numeroletasaumenta>90){//si es mayor a 90 
    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
        $numeroletrauno=65;
        $numeroletrados++;
    }
    else{//Si no que siga aumentando
        $numeroletrauno++;
    }//cierre else
    $letra=chr($numeroletrados).''.chr($numeroletrauno);
    //echo "qui <br>";
}//fin si primera condicion
else{//Sino Primera condicion
    $letra=chr($numeroletasaumenta);
    $numeroletrauno++;
}

$objPHPExcel->setActiveSheetIndex($numero_registro)
->setCellValue($letra.'1', 'UNIDAD');
$objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.'1')->applyFromArray($styleFuenteLetra);
$numeroletasaumenta++;
//UNIDAD MEDIDA
if($numeroletasaumenta>90){//si es mayor a 90 
    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
        $numeroletrauno=65;
        $numeroletrados++;
    }
    else{//Si no que siga aumentando
        $numeroletrauno++;
    }//cierre else
    $letra=chr($numeroletrados).''.chr($numeroletrauno);
    //echo "qui <br>";
}//fin si primera condicion
else{//Sino Primera condicion
    $letra=chr($numeroletasaumenta);
    $numeroletrauno++;
}

$objPHPExcel->setActiveSheetIndex($numero_registro)
->setCellValue($letra.'1', 'UNIDAD DE MEDIDA');
$objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.'1')->applyFromArray($styleFuenteLetra);
$numeroletasaumenta++;

///DATA POAI
$lista_poai = $objReportePoai->lista_poai($codigo_plan);
$num_registro = 2;
if($lista_poai){
    foreach ($lista_poai as $dta_list_poai) {
        $acc_codigo = $dta_list_poai['acc_codigo'];
        $acc_referencia = $dta_list_poai['acc_referencia'];
        $acc_numero = $dta_list_poai['acc_numero'];
        $acc_descripcion = $dta_list_poai['acc_descripcion'];
        $ind_codigo = $dta_list_poai['ind_codigo'];
        $ind_sede = $dta_list_poai['ind_sede'];
        $sed_nombre = $dta_list_poai['sed_nombre'];
        $sed_nombre = $dta_list_poai['sed_nombre'];
        $ind_unidadmedida = $dta_list_poai['ind_unidadmedida'];

        $descrpcion_accion = $acc_referencia.".".$acc_numero." ".$acc_descripcion;

        $unidad_vigencia = $objReportePoai->unidad_vigencia($ind_codigo, $vigencia);

        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('A'.$num_registro, $descrpcion_accion);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num_registro)->applyFromArray($colorHoja);
        
        $total_poai_indicador = 0;

        // Fuentes list 
        $numeroletasaumenta = 66;
        $numeroletrauno = 66;
        $numeroletrados = 64;
        if($list_fuente_financiacion){
            foreach ($list_fuente_financiacion as $dta_lsta_fuente_financiacion) {
                $ffi_codigo = $dta_lsta_fuente_financiacion['ffi_codigo'];
                $ffi_nombre = $dta_lsta_fuente_financiacion['ffi_nombre'];
                $vigencia_fuente = $dta_lsta_fuente_financiacion['vigencia_fuente'];

                if($numeroletasaumenta>90){//si es mayor a 90 
                    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                        $numeroletrauno=65;
                        $numeroletrados++;
                    }
                    else{//Si no que siga aumentando
                        $numeroletrauno++;
                    }//cierre else
                    $letra=chr($numeroletrados).''.chr($numeroletrauno);
                    //echo "qui <br>";
                }//fin si primera condicion
                else{//Sino Primera condicion
                    $letra=chr($numeroletasaumenta);
                    $numeroletrauno++;
                }

                $valor_poai_acuerdo = $objReportePoaiActs->valor_poai_acuerdo($vigencia_fuente, $acc_codigo, $ffi_codigo, $ind_codigo, $vigencia, $acuerdo);
                //$recurso_poai = $objReportePoaiActs->totalizado_poai_acuerdo($vigencia, $acc_codigo, $ffi_codigo, $ind_codigo, $acuerdo, $vigencia_fuente);

                $total_poai_indicador = $total_poai_indicador + $valor_poai_acuerdo;

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue($letra.$num_registro, $valor_poai_acuerdo);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($datos_dinero);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                $numeroletasaumenta++;
            }
        }

        if($numeroletasaumenta>90){//si es mayor a 90 
            if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                $numeroletrauno=65;
                $numeroletrados++;
            }
            else{//Si no que siga aumentando
                $numeroletrauno++;
            }//cierre else
            $letra=chr($numeroletrados).''.chr($numeroletrauno);
            //echo "qui <br>";
        }//fin si primera condicion
        else{//Sino Primera condicion
            $letra=chr($numeroletasaumenta);
            $numeroletrauno++;
        }

        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue($letra.$num_registro, $total_poai_indicador);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($datos_dinero);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

        $numeroletasaumenta++;

        //ultimas columnas SEDE
        if($numeroletasaumenta>90){//si es mayor a 90 
            if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                $numeroletrauno=65;
                $numeroletrados++;
            }
            else{//Si no que siga aumentando
                $numeroletrauno++;
            }//cierre else
            $letra=chr($numeroletrados).''.chr($numeroletrauno);
            //echo "qui <br>";
        }//fin si primera condicion
        else{//Sino Primera condicion
            $letra=chr($numeroletasaumenta);
            $numeroletrauno++;
        }

        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue($letra.$num_registro, $sed_nombre);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($datos_dinero);
        $numeroletasaumenta++;
        //UNIDAD
        if($numeroletasaumenta>90){//si es mayor a 90 
            if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                $numeroletrauno=65;
                $numeroletrados++;
            }
            else{//Si no que siga aumentando
                $numeroletrauno++;
            }//cierre else
            $letra=chr($numeroletrados).''.chr($numeroletrauno);
            //echo "qui <br>";
        }//fin si primera condicion
        else{//Sino Primera condicion
            $letra=chr($numeroletasaumenta);
            $numeroletrauno++;
        }

        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue($letra.$num_registro, $unidad_vigencia);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($datos_dinero);
        $numeroletasaumenta++;
        //UNIDAD MEDIDA
        if($numeroletasaumenta>90){//si es mayor a 90 
            if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                $numeroletrauno=65;
                $numeroletrados++;
            }
            else{//Si no que siga aumentando
                $numeroletrauno++;
            }//cierre else
            $letra=chr($numeroletrados).''.chr($numeroletrauno);
            //echo "qui <br>";
        }//fin si primera condicion
        else{//Sino Primera condicion
            $letra=chr($numeroletasaumenta);
            $numeroletrauno++;
        }

        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue($letra.$num_registro, $ind_unidadmedida);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($datos_dinero);
        $numeroletasaumenta++;


        $num_registro++;
    }
    ////TOTALES 
    $objPHPExcel->setActiveSheetIndex($numero_registro)
    ->setCellValue('A'.$num_registro, 'TOTALES');
    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num_registro)->applyFromArray($colorHoja);

    // Fuentes list 
    $numeroletasaumenta = 66;
    $numeroletrauno = 66;
    $numeroletrados = 64;
    if($list_fuente_financiacion){
        $total_todo = 0;
        foreach ($list_fuente_financiacion as $dta_lsta_fuente_financiacion) {
            $ffi_codigo = $dta_lsta_fuente_financiacion['ffi_codigo'];
            $ffi_nombre = $dta_lsta_fuente_financiacion['ffi_nombre'];
            $vigencia_fuente = $dta_lsta_fuente_financiacion['vigencia_fuente'];

            if($numeroletasaumenta>90){//si es mayor a 90 
                if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                    $numeroletrauno=65;
                    $numeroletrados++;
                }
                else{//Si no que siga aumentando
                    $numeroletrauno++;
                }//cierre else
                $letra=chr($numeroletrados).''.chr($numeroletrauno);
                //echo "qui <br>";
            }//fin si primera condicion
            else{//Sino Primera condicion
                $letra=chr($numeroletasaumenta);
                $numeroletrauno++;
            }

            $totalizado_fuente_poai = $objReportePoaiActs->sum_fuente_plan_acuerdo($codigo_plan, $ffi_codigo, $vigencia_fuente, $vigencia, $acuerdo);

            $total_todo = $total_todo + $totalizado_fuente_poai;

            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue($letra.$num_registro, $totalizado_fuente_poai);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($datos_dinero);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

            $numeroletasaumenta++;
        }
        //ultimas columnas TOTAL
        if($numeroletasaumenta>90){//si es mayor a 90 
            if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                $numeroletrauno=65;
                $numeroletrados++;
            }
            else{//Si no que siga aumentando
                $numeroletrauno++;
            }//cierre else
            $letra=chr($numeroletrados).''.chr($numeroletrauno);
            //echo "qui <br>";
        }//fin si primera condicion
        else{//Sino Primera condicion
            $letra=chr($numeroletasaumenta);
            $numeroletrauno++;
        }

        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue($letra.$num_registro, $total_todo);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($datos_dinero);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

        $numeroletasaumenta++;
    }

    $num_registro = $num_registro + 2;

    //Final Subsistema
    $list_subsistema = $objReportePoai->list_subsistema($codigo_plan);
    if($list_subsistema){
        foreach ($list_subsistema as $data_subsistema) {
            $sub_codigo = $data_subsistema['sub_codigo'];
            $sub_nombre = $data_subsistema['sub_nombre'];
            $sub_referencia = $data_subsistema['sub_referencia'];
            $sub_ref = $data_subsistema['sub_ref'];
            $nivel_uno = $data_subsistema['nivel_uno'];

            $nombre_subsistema = $nivel_uno." ".$sub_nombre;


            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('A'.$num_registro, strtoupper(tildes($nombre_subsistema)));
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num_registro)->applyFromArray($styleFuenteLetra);

            $numeroletasaumenta = 66;
            $numeroletrauno = 66;
            $numeroletrados = 64;
            if($list_fuente_financiacion){
                $suma_subsistema = 0;
                foreach ($list_fuente_financiacion as $dta_lsta_fuente_financiacion) {
                    $ffi_codigo = $dta_lsta_fuente_financiacion['ffi_codigo'];
                    $ffi_nombre = $dta_lsta_fuente_financiacion['ffi_nombre'];
                    $vigencia_fuente = $dta_lsta_fuente_financiacion['vigencia_fuente'];

                    if($numeroletasaumenta>90){//si es mayor a 90 
                        if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                            $numeroletrauno=65;
                            $numeroletrados++;
                            
                        }
                        else{//Si no que siga aumentando
                            $numeroletrauno++;
                        }//cierre else
                        $letra=chr($numeroletrados).''.chr($numeroletrauno);
                        //echo "qui <br>";
                    }//fin si primera condicion
                    else{//Sino Primera condicion
                        $letra=chr($numeroletasaumenta);
                        $numeroletrauno++;
                    }

                    $suma_poai_subsistema = $objReportePoaiActs->suma_poai_subsistema($codigo_plan, $sub_codigo, $vigencia, $ffi_codigo, $vigencia_fuente, $acuerdo);

                    $suma_subsistema = $suma_subsistema + $suma_poai_subsistema;

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue($letra.$num_registro, $suma_poai_subsistema);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($datos_dinero);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                    
                    $numeroletasaumenta++;
                }
                //Total subsistema
                if($numeroletasaumenta>90){//si es mayor a 90 
                    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                        $numeroletrauno=65;
                        $numeroletrados++;
                        
                    }
                    else{//Si no que siga aumentando
                        $numeroletrauno++;
                    }//cierre else
                    $letra=chr($numeroletrados).''.chr($numeroletrauno);
                    //echo "qui <br>";
                }//fin si primera condicion
                else{//Sino Primera condicion
                    $letra=chr($numeroletasaumenta);
                    $numeroletrauno++;
                }

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue($letra.$num_registro, $suma_subsistema);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->applyFromArray($datos_dinero);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num_registro)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

            }

            $num_registro++;
        }
    }

}

//inicio foreach


$num_registro=3;
$id_registro=1;


// Fin de Registros //


$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(50);

//TAMAÑO CELDAS VALORES
$numeroletasaumenta = 66;
$numeroletrauno = 66;
$numeroletrados = 64;
if($list_fuente_financiacion){
    foreach ($list_fuente_financiacion as $dta_lsta_fuente_financiacion) {
        $ffi_codigo = $dta_lsta_fuente_financiacion['ffi_codigo'];
        $ffi_nombre = $dta_lsta_fuente_financiacion['ffi_nombre'];

        if($numeroletasaumenta>90){//si es mayor a 90 
            if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
                $numeroletrauno=65;
                $numeroletrados++;
            }
            else{//Si no que siga aumentando
                $numeroletrauno++;
            }//cierre else
            $letra=chr($numeroletrados).''.chr($numeroletrauno);
            //echo "qui <br>";
        }//fin si primera condicion
        else{//Sino Primera condicion
            $letra=chr($numeroletasaumenta);
            $numeroletrauno++;
        }

        $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension($letra)->setWidth(22);
        $numeroletasaumenta++;
    }
}

//ULTIMA TOTAL
if($numeroletasaumenta>90){//si es mayor a 90 
    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
        $numeroletrauno=65;
        $numeroletrados++;
    }
    else{//Si no que siga aumentando
        $numeroletrauno++;
    }//cierre else
    $letra=chr($numeroletrados).''.chr($numeroletrauno);
    //echo "qui <br>";
}//fin si primera condicion
else{//Sino Primera condicion
    $letra=chr($numeroletasaumenta);
    $numeroletrauno++;
}

$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension($letra)->setWidth(30);
$numeroletasaumenta++;

//ultimas columnas SEDE
if($numeroletasaumenta>90){//si es mayor a 90 
    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
        $numeroletrauno=65;
        $numeroletrados++;
    }
    else{//Si no que siga aumentando
        $numeroletrauno++;
    }//cierre else
    $letra=chr($numeroletrados).''.chr($numeroletrauno);
    //echo "qui <br>";
}//fin si primera condicion
else{//Sino Primera condicion
    $letra=chr($numeroletasaumenta);
    $numeroletrauno++;
}

$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension($letra)->setWidth(30);
$numeroletasaumenta++;

//UNIDAD
if($numeroletasaumenta>90){//si es mayor a 90 
    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
        $numeroletrauno=65;
        $numeroletrados++;
    }
    else{//Si no que siga aumentando
        $numeroletrauno++;
    }//cierre else
    $letra=chr($numeroletrados).''.chr($numeroletrauno);
    //echo "qui <br>";
}//fin si primera condicion
else{//Sino Primera condicion
    $letra=chr($numeroletasaumenta);
    $numeroletrauno++;
}

$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension($letra)->setWidth(43);
$numeroletasaumenta++;
//UNIDAD MEDIDA
if($numeroletasaumenta>90){//si es mayor a 90 
    if($numeroletrauno==91  || $numeroletasaumenta == 117 || $numeroletasaumenta == 143){//si es == 91 
        $numeroletrauno=65;
        $numeroletrados++;
    }
    else{//Si no que siga aumentando
        $numeroletrauno++;
    }//cierre else
    $letra=chr($numeroletrados).''.chr($numeroletrauno);
    //echo "qui <br>";
}//fin si primera condicion
else{//Sino Primera condicion
    $letra=chr($numeroletasaumenta);
    $numeroletrauno++;
}

$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension($letra)->setWidth(38);
$numeroletasaumenta++;
///////////////////////////////////////////////////////////

$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(36);

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
