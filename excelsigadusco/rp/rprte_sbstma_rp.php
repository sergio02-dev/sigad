<?php
//ini_set('memory_limit', '-1');
set_time_limit(180000000000);
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

$texto_centr_total=array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 9,
        'name'  => 'Verdana'
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'B92109')
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
        'color' => array('rgb' => 'D1D1D1')
    )
);

$titulo_center_blanco = array(
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
        'color' => array('rgb' => 'FFFFFF')
    )
);

$titulo_center_azul = array(
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
        'color' => array('rgb' => 'D6DAF2')
    )
);

$titulo_center_verde = array(
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
        'color' => array('rgb' => 'D9F2D6')
    )
);

$titulo_center_naranja = array(
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
        'color' => array('rgb' => 'F2D4BA')
    )
);

$texto_center_azul = array(
    'font'  => array(
        'bold'  => false,
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
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'D6DAF2')
    )
);

$texto_center_verde = array(
    'font'  => array(
        'bold'  => false,
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
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'D9F2D6')
    )
);

$texto_center_naranja = array(
    'font'  => array(
        'bold'  => false,
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
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'F2D4BA')
    )
);

$titulo_center_gris = array(
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
        'color' => array('rgb' => 'D1D1D1')
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

$texto_moneda=array(
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
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    )
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

$titulo_left_red = array(
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
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap' => true
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'B92109')
    )
);

$barra_red = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'B92109'),
        'size'  => 9,
        'name'  => 'Verdana'
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => 'B92109')
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'B92109')
    )
);

$titulo_center_red = array(
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


$texto_left_azul_claro=array(
    'font'  => array(
        'color' => array('rgb' => '000000'),
        'size'  => 9,
        'name'  => 'Verdana'
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'B5D3E4')
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

$texto_center_azul_claro=array(
    'font'  => array(
        'color' => array('rgb' => '000000'),
        'size'  => 9,
        'name'  => 'Verdana'
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'B5D3E4')
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

$codigo_plan = $_REQUEST['codigo_plan'];
$codigo_vigencia = $_REQUEST['codigo_vigencia'];
$codigo_subsistema = $_REQUEST['codigo_subsistema'];

include('crud/rs/rp/rprte_rp.php');

$sigla_nivel_uno = $objRprteRP->sigla_nivel_uno($codigo_subsistema);

$nombre_subsistema = $objRprteRP->nombre_subsistema($codigo_subsistema);

list($inicio_plan, $fin_plan) = $objRprteRP->anios_plan($codigo_plan);

$nombre_nivel_uno = $objRprteRP->nombre_nivel_uno($codigo_plan);

$nombre_nivel_dos = $objRprteRP->nombre_nivel_dos($codigo_plan);

$nombre_nivel_tres = $objRprteRP->nombre_nivel_tres($codigo_plan);

$nombre_archvo = $nombre_nivel_uno."_".$nombre_subsistema."_".$fecha_generar;

//Pagina Uno 
$numero_registro = 0;
$objPHPExcel->setActiveSheetIndex($numero_registro);
$objPHPExcel->getActiveSheet()->setTitle('Hoja 1');
$sheet = $objPHPExcel->getActiveSheet($numero_registro);

$sheet->getPageMargins()->setTop(0.6);
$sheet->getPageMargins()->setBottom(0.6);
$sheet->getPageMargins()->setHeader(0.4);
$sheet->getPageMargins()->setFooter(0.4);
$sheet->getPageMargins()->setLeft(0.4);
$sheet->getPageMargins()->setRight(0.4);

$num = 1;
$list_prycto_subsstema = $objRprteRP->list_prycto_subsstema($codigo_subsistema);
if($list_prycto_subsstema){
    foreach($list_prycto_subsstema as $dat_pryecto){
        $pro_codigo = $dat_pryecto['pro_codigo'];
        $pro_referencia = $dat_pryecto['pro_referencia']; 
        $pro_numero = $dat_pryecto['pro_numero'];
        $pro_descripcion = $dat_pryecto['pro_descripcion'];
        $pro_objetivo = $dat_pryecto['pro_objetivo'];

        if($codigo_plan == 1){
            $descripcion_proyecto = $sigla_nivel_uno.".".$pro_referencia." ".$pro_descripcion;
        }
        else{
            $descripcion_proyecto = $pro_referencia.".".$pro_numero." ".$pro_descripcion;
        }

        $cambinar = $num + 1;
        $sheet->mergeCells("A".$num.":A".$cambinar);
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('A'.$num, strtoupper(tildes($nombre_nivel_dos)));
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num.":A".$cambinar)->applyFromArray($titulo_left_red);

        $sheet->mergeCells("B".$num.":J".$num);
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('B'.$num, $descripcion_proyecto)
        ->setCellValue('K'.$num, '');

        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num.":J".$num)->applyFromArray($texto_left);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num)->applyFromArray($barra_red);
        $num++;

        $sheet->mergeCells("B".$num.":J".$num);
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('B'.$num, "OBJETIVO: ".$pro_objetivo)
        ->setCellValue('K'.$num, '');

        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num.":J".$num)->applyFromArray($texto_left);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num)->applyFromArray($barra_red);
        $num++;

        $list_acciones = $objRprteRP->list_acciones($pro_codigo);
        if($list_acciones){
            foreach($list_acciones as $dat_acciones){
                $acc_codigo = $dat_acciones['acc_codigo'];
                $acc_referencia = $dat_acciones['acc_referencia']; 
                $acc_numero = $dat_acciones['acc_numero'];
                $acc_descripcion = $dat_acciones['acc_descripcion'];
                $acc_proyecto = $dat_acciones['acc_proyecto'];
                
                if($codigo_plan == 1){
                    $descrpcion_accion = $sigla_nivel_uno.".".$acc_referencia." ".$acc_descripcion;
                }
                else{
                    $descrpcion_accion = $acc_referencia.".".$acc_numero." ".$acc_descripcion;
                }

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, strtoupper(tildes($nombre_nivel_tres)));

                $sheet->mergeCells("B".$num.":J".$num);
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('B'.$num, $descrpcion_accion)
                ->setCellValue('K'.$num, '');

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num)->applyFromArray($texto_left);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num.":J".$num)->applyFromArray($texto_left);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num)->applyFromArray($barra_red);
                $num++;

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, 'ACTIVIDAD')
                ->setCellValue('B'.$num, 'OBJETIVO')
                ->setCellValue('C'.$num, 'VIGENCIA')
                ->setCellValue('D'.$num, 'SEDE')
                ->setCellValue('E'.$num, 'DESCRIPCIÓN UNIDAD DE MEDIDA')
                ->setCellValue('F'.$num, 'META')
                ->setCellValue('G'.$num, 'ETAPA')
                ->setCellValue('H'.$num, 'RECURSOS')
                ->setCellValue('I'.$num, 'PESO DE LA ETAPA %')
                ->setCellValue('J'.$num, 'AVANCE INICIAL DE LA ETAPA %')
                ->setCellValue('K'.$num, '')
                ->setCellValue('L'.$num, 'CLASIFICADOR')
                ->setCellValue('M'.$num, 'FUENTE')
                ->setCellValue('N'.$num, '# CDP')
                ->setCellValue('O'.$num, 'FECHA CDP')
                ->setCellValue('P'.$num, 'VALOR CDP')
                ->setCellValue('Q'.$num, '# RP')
                ->setCellValue('R'.$num, 'FECHA RP')
                ->setCellValue('S'.$num, 'VALOR RP')
                ->setCellValue('T'.$num, 'SALDO POAI')
                ->setCellValue('U'.$num, 'SALDO DE CDP')
                ->setCellValue('V'.$num, 'PROVEEDOR')
                ->setCellValue('W'.$num, 'CONTRATO')
                ->setCellValue('X'.$num, 'ACTO ADMINISTRATIVO');

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("D".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("E".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("F".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("G".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("H".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("J".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num)->applyFromArray($barra_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("L".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("M".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("N".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("O".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("P".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("Q".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("R".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("S".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("T".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("U".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("V".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("W".$num)->applyFromArray($titulo_center_red);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("X".$num)->applyFromArray($titulo_center_red);
                $num++;

                $actvddes_accion = $objRprteRP->actvddes_accion($acc_codigo, $codigo_vigencia);
                if($actvddes_accion){
                    $suma_actividad = 0;
                    foreach($actvddes_accion as $dat_actvddes){
                        $acp_codigo = $dat_actvddes['acp_codigo'];
                        $acp_accion = $dat_actvddes['acp_accion'];
                        $acp_referencia = $dat_actvddes['acp_referencia']; 
                        $acp_numero = $dat_actvddes['acp_numero'];
                        $acp_descripcion = $dat_actvddes['acp_descripcion'];
                        $acp_objetivo = $dat_actvddes['acp_objetivo']; 
                        $acp_vigencia = $dat_actvddes['acp_vigencia'];
                        $acp_sedeindicador = $dat_actvddes['acp_sedeindicador']; 
                        $acp_unidad = $dat_actvddes['acp_unidad'];

                        $datos_indicador = $objRprteRP->datos_indicador($acp_sedeindicador);
                        if($datos_indicador){
                            foreach ($datos_indicador as $dta_dtos_indicador) {
                                $ind_codigo = $dta_dtos_indicador['ind_codigo'];
                                $ind_unidadmedida = $dta_dtos_indicador['ind_unidadmedida'];
                                $ind_sede = $dta_dtos_indicador['ind_sede'];
                                $sed_nombre = $dta_dtos_indicador['sed_nombre'];
                            }
                        }

                        $cantidad_convinar = $objRprteRP->cantidad_convinar($acp_codigo);

                        $descripcion_actvddes = $acp_referencia.".".$acp_numero." ".$acp_descripcion;

                        if($cantidad_convinar == 0){
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('A'.$num, $descripcion_actvddes)
                            ->setCellValue('B'.$num, $acp_objetivo)
                            ->setCellValue('C'.$num, $acp_vigencia)
                            ->setCellValue('D'.$num, $sed_nombre)
                            ->setCellValue('E'.$num, $ind_unidadmedida)
                            ->setCellValue('F'.$num, $acp_unidad);

                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num)->applyFromArray($texto_left);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num)->applyFromArray($texto_left);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C".$num)->applyFromArray($texto_left);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("D".$num)->applyFromArray($texto_center);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("E".$num)->applyFromArray($texto_left);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("F".$num)->applyFromArray($texto_center);
                        }
                        else{
                            $hasta = $num + $cantidad_convinar;

                            $sheet->mergeCells("A".$num.":A".$hasta);
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('A'.$num, $descripcion_actvddes);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num.":A".$hasta)->applyFromArray($texto_left);
                            
                            $sheet->mergeCells("B".$num.":B".$hasta);
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('B'.$num, $acp_objetivo);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num.":B".$hasta)->applyFromArray($texto_left);
                            
                            $sheet->mergeCells("C".$num.":C".$hasta);
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('C'.$num, $acp_vigencia);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C".$num.":C".$hasta)->applyFromArray($texto_left);
                            
                            $sheet->mergeCells("D".$num.":D".$hasta);
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('D'.$num, $sed_nombre);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("D".$num.":D".$hasta)->applyFromArray($texto_center);
                            
                            $sheet->mergeCells("E".$num.":E".$hasta);
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('E'.$num, $ind_unidadmedida);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("E".$num.":E".$hasta)->applyFromArray($texto_left);
                            
                            $sheet->mergeCells("F".$num.":F".$hasta);
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('F'.$num, $acp_unidad);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("F".$num.":F".$hasta)->applyFromArray($texto_center);
                        }

                        //etapas 
                        $list_etapas = $objRprteRP->list_etapas($acp_codigo);
                        if($list_etapas){
                            $peso_estapa = 0;
                            foreach($list_etapas as $dat_etpas){
                                $poa_codigo = $dat_etpas['poa_codigo'];
                                $poa_referencia = $dat_etpas['poa_referencia'];
                                $poa_numero = $dat_etpas['poa_numero'];
                                $poa_objeto = $dat_etpas['poa_objeto'];
                                $poa_recurso = $dat_etpas['poa_recurso'];
                                $poa_logro = $dat_etpas['poa_logro']; 
                                $avance_esperado = $dat_etpas['avance_esperado'];
                                $poa_logroejecutado = $dat_etpas['poa_logroejecutado'];

                                $suma_actividad = $suma_actividad + $poa_recurso;

                                $dscrpcion_etapa = $poa_referencia.".".$poa_numero." ".$poa_objeto;

                                $cantidad_cdp_etapa = $objRprteRP->cantidad_cdp_etapa($poa_codigo);

                                if($avance_esperado == 0){ 
                                    $avanceInicial = $poa_logroejecutado.'=>0';
                                }
                                else{
                                    $avanceInicial = $poa_logroejecutado.'=>'.$avance_esperado/100;
                                }

                                $saldo_poai = $objRprteRP->valor_poai($poa_codigo);

                                $peso_estapa = $peso_estapa + $poa_logro;

                                if($cantidad_cdp_etapa == 0){
                                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                                    ->setCellValue('G'.$num, $dscrpcion_etapa)
                                    ->setCellValue('H'.$num, $poa_recurso)
                                    ->setCellValue('I'.$num, $poa_logro)
                                    ->setCellValue('J'.$num, $avanceInicial)
                                    ->setCellValue('K'.$num, '');
                
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("G".$num)->applyFromArray($texto_left);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("H".$num)->applyFromArray($texto_left);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("H".$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I".$num)->applyFromArray($texto_center);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("J".$num)->applyFromArray($texto_center);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num)->applyFromArray($barra_red);
                                
                                }
                                else{
                                    $hasta_etapa = $num + $cantidad_cdp_etapa;

                                    $sheet->mergeCells("G".$num.":G".$hasta_etapa);
                                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                                    ->setCellValue('G'.$num, $dscrpcion_etapa);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("G".$num.":G".$hasta_etapa)->applyFromArray($texto_left);
                                    
                                    $sheet->mergeCells("H".$num.":H".$hasta_etapa);
                                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                                    ->setCellValue('H'.$num, $poa_recurso);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("H".$num.":H".$hasta_etapa)->applyFromArray($texto_left);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("H".$num.":H".$hasta_etapa)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                                    $sheet->mergeCells("I".$num.":I".$hasta_etapa);
                                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                                    ->setCellValue('I'.$num, $poa_logro);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I".$num.":I".$hasta_etapa)->applyFromArray($texto_center);
                                    
                                    $sheet->mergeCells("J".$num.":J".$hasta_etapa);
                                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                                    ->setCellValue('J'.$num, $avanceInicial);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("J".$num.":J".$hasta_etapa)->applyFromArray($texto_center);
                                    
                                    $sheet->mergeCells("K".$num.":K".$hasta_etapa);
                                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                                    ->setCellValue('K'.$num, '');
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num.":K".$hasta_etapa)->applyFromArray($barra_red);
                                }
                                
                                $list_cdp = $objRprteRP->list_cdp($poa_codigo);
                                if($list_cdp){
                                    foreach ($list_cdp as $dat_cdp) {
                                        $cdp_codigo = $dat_cdp['cdp_codigo'];
                                        $cdp_solicitud = $dat_cdp['cdp_solicitud'];
                                        $cdp_fecha = $dat_cdp['cdp_fecha']; 
                                        $cdp_numeroexpedicion = $dat_cdp['cdp_numeroexpedicion'];
                                        $aes_etapa = $dat_cdp['aes_etapa']; 

                                        $total_cdp = $objRprteRP->val_cdp($cdp_codigo);

                                        $list_clasfcdres = $objRprteRP->list_clasfcdres($cdp_solicitud, $aes_etapa);                

                                        $list_fuentes = $objRprteRP->list_fuentes($cdp_solicitud, $aes_etapa);

                                        $saldo_poai = $saldo_poai - $total_cdp;

                                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                                        ->setCellValueExplicit('L'.$num, $list_clasfcdres, PHPExcel_Cell_DataType::TYPE_STRING)
                                        ->setCellValueExplicit('M'.$num, $list_fuentes, PHPExcel_Cell_DataType::TYPE_STRING)
                                        ->setCellValueExplicit('N'.$num, $cdp_numeroexpedicion, PHPExcel_Cell_DataType::TYPE_STRING)
                                        ->setCellValue('O'.$num, date('d/m/Y',strtotime($cdp_fecha)))
                                        ->setCellValue('P'.$num, $total_cdp);

                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("L".$num)->applyFromArray($texto_left_azul_claro);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("M".$num)->applyFromArray($texto_left_azul_claro);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("N".$num)->applyFromArray($texto_left_azul_claro);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("O".$num)->applyFromArray($texto_center_azul_claro);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("O".$num)->getNumberFormat()->setFormatCode('[$-C09]d mmm yyyy;@');
                                        //$objPHPExcel->getActiveSheet($numero_registro)->getStyle("O".$num)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("P".$num)->applyFromArray($texto_left_azul_claro);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("P".$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                                        $datos_rp = $objRprteRP->datos_rp($cdp_codigo);
                                        if($datos_rp){
                                            foreach($datos_rp as $dat_rp){
                                                $rp_codigo = $dat_rp['rp_codigo'];
                                                $rp_fecha = $dat_rp['rp_fecha']; 
                                                $rp_numerorp = $dat_rp['rp_numerorp'];
                                                $rp_otrovalor = $dat_rp['rp_otrovalor'];
                                                $rp_valor = $dat_rp['rp_valor'];
                                                $rp_proveedor = $dat_rp['rp_proveedor']; 
                                                $rp_actoadmin = $dat_rp['rp_actoadmin'];
                                                $rp_servicio = $dat_rp['rp_servicio'];
                                            }
                                             
                                            $sldo_cdp = $total_cdp - $rp_valor;                                            

                                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                                            ->setCellValue('Q'.$num, $rp_numerorp)
                                            ->setCellValue('R'.$num, date('d/m/Y',strtotime($rp_fecha)))
                                            ->setCellValue('S'.$num, $rp_valor)
                                            ->setCellValue('T'.$num, $saldo_poai)
                                            ->setCellValue('U'.$num, $sldo_cdp)
                                            ->setCellValue('V'.$num, $rp_proveedor)
                                            ->setCellValue('W'.$num, $rp_servicio)
                                            ->setCellValue('X'.$num, $rp_actoadmin);

                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("Q".$num)->applyFromArray($texto_left);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("R".$num)->applyFromArray($texto_left);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("R".$num)->getNumberFormat()->setFormatCode('[$-C09]d mmm yyyy;@');
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("S".$num)->applyFromArray($texto_left);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("S".$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("T".$num)->applyFromArray($texto_left);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("T".$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("U".$num)->applyFromArray($texto_left);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("U".$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("V".$num)->applyFromArray($texto_left);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("W".$num)->applyFromArray($texto_left);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("X".$num)->applyFromArray($texto_left);
                                        }
                                        else{
                                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                                            ->setCellValue('Q'.$num, '')
                                            ->setCellValue('R'.$num, '')
                                            ->setCellValue('S'.$num, '')
                                            ->setCellValue('T'.$num, $saldo_poai)
                                            ->setCellValue('U'.$num, 0)
                                            ->setCellValue('V'.$num, '')
                                            ->setCellValue('W'.$num, '')
                                            ->setCellValue('X'.$num, '');

                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("Q".$num)->applyFromArray($texto_center);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("R".$num)->applyFromArray($texto_center);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("S".$num)->applyFromArray($texto_left);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("T".$num)->applyFromArray($texto_left);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("T".$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("U".$num)->applyFromArray($texto_left);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("U".$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("V".$num)->applyFromArray($texto_left);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("W".$num)->applyFromArray($texto_left);
                                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("X".$num)->applyFromArray($texto_left);
                                        }

                                        $num++;

                                        /*$objPHPExcel->setActiveSheetIndex($numero_registro)
                                        ->setCellValue('L'.$num, '')
                                        ->setCellValue('M'.$num, '')
                                        ->setCellValue('N'.$num, '')
                                        ->setCellValue('O'.$num, '')
                                        ->setCellValue('P'.$num, '')
                                        ->setCellValue('Q'.$num, '')
                                        ->setCellValue('R'.$num, '')
                                        ->setCellValue('S'.$num, '')
                                        ->setCellValue('T'.$num, '')
                                        ->setCellValue('U'.$num, '');
    
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("L".$num)->applyFromArray($texto_left_azul_claro);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("M".$num)->applyFromArray($texto_left_azul_claro);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("N".$num)->applyFromArray($texto_left_azul_claro);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("O".$num)->applyFromArray($texto_left_azul_claro);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("P".$num)->applyFromArray($texto_left_azul_claro);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("Q".$num)->applyFromArray($texto_left);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("R".$num)->applyFromArray($texto_left);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("S".$num)->applyFromArray($texto_left);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("T".$num)->applyFromArray($texto_left);
                                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("U".$num)->applyFromArray($texto_left);*/

                                    }
                                }
                                else{
                                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                                    ->setCellValue('L'.$num, '')
                                    ->setCellValue('M'.$num, '')
                                    ->setCellValue('N'.$num, '')
                                    ->setCellValue('O'.$num, '')
                                    ->setCellValue('P'.$num, '')
                                    ->setCellValue('Q'.$num, '')
                                    ->setCellValue('R'.$num, '')
                                    ->setCellValue('S'.$num, '')
                                    ->setCellValue('T'.$num, '')
                                    ->setCellValue('U'.$num, '')
                                    ->setCellValue('V'.$num, '')
                                    ->setCellValue('W'.$num, '')
                                    ->setCellValue('X'.$num, '');

                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("L".$num)->applyFromArray($texto_left_azul_claro);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("M".$num)->applyFromArray($texto_left_azul_claro);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("N".$num)->applyFromArray($texto_left_azul_claro);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("O".$num)->applyFromArray($texto_left_azul_claro);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("P".$num)->applyFromArray($texto_left_azul_claro);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("Q".$num)->applyFromArray($texto_left);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("R".$num)->applyFromArray($texto_left);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("S".$num)->applyFromArray($texto_left);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("T".$num)->applyFromArray($texto_left);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("U".$num)->applyFromArray($texto_left);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("V".$num)->applyFromArray($texto_left);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("W".$num)->applyFromArray($texto_left);
                                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("X".$num)->applyFromArray($texto_left);
                                    $num++;
                                }
                            }
                            //Totalizados
                            
                        }
                        else{
                            $sheet->mergeCells("G".$num.":J".$num);
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('G'.$num, 'No hay Etapas')
                            ->setCellValue('K'.$num, '');
        
                            $sheet->mergeCells("L".$num.":U".$num);
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('L'.$num, 'No hay Datos');
        
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("G".$num.":J".$num)->applyFromArray($texto_left);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num)->applyFromArray($barra_red);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("L".$num.":U".$num)->applyFromArray($texto_left);
                            $num++;
                        }

                        $rs_avanceEsperado = $objRprteRP->avanceEsperado($acp_codigo);

                        if($rs_avanceEsperado){
                            $totalAvance = 0;
                            foreach ($rs_avanceEsperado as $dataAvanceEsperado) {
                                $poa_logro=$dataAvanceEsperado['poa_logro'];
                                $poa_logroejecutado=$dataAvanceEsperado['poa_logroejecutado'];

                                $avance_esperadoTotal=($poa_logro*$poa_logroejecutado)/100;

                                $totalAvance=$totalAvance+$avance_esperadoTotal;
                            }
                            $av = number_format($totalAvance, 2, ",", ".").'%';
                        }
                        else{
                            $av = '0%';
                        }

                        //TOTALES ACTIVIDAD
                        $sheet->mergeCells("A".$num.":G".$num);
                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue('A'.$num, 'TOTALES')
                        ->setCellValue('H'.$num, $suma_actividad)
                        ->setCellValue('I'.$num, $peso_estapa)
                        ->setCellValue('J'.$num, $av)
                        ->setCellValue('K'.$num, '');
                        

                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num.":G".$num)->applyFromArray($titulo_center_red);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("H".$num)->applyFromArray($texto_left);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("H".$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I".$num)->applyFromArray($texto_center);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("J".$num)->applyFromArray($texto_center);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num)->applyFromArray($barra_red);
                        $num++;
                    }
                    
                }
                else{
                    $sheet->mergeCells("A".$num.":J".$num);
                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('A'.$num, 'No hay Actividades')
                    ->setCellValue('K'.$num, '');

                    $sheet->mergeCells("L".$num.":U".$num);
                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('L'.$num, 'No hay Datos');

                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num.":J".$num)->applyFromArray($texto_left);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num)->applyFromArray($barra_red);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("L".$num.":U".$num)->applyFromArray($texto_left);
                    $num++;
                }

            }
        }

    }
}

$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(29);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(29);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(8);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(11);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(12);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(26);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('I')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('J')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('K')->setWidth(3);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('L')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('M')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('N')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('O')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('P')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('Q')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('R')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('S')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('T')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('U')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('V')->setWidth(20);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('W')->setWidth(26);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('X')->setWidth(20);

$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);

//Pagina Dos
$numero_registro = 1;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex($numero_registro);
$objPHPExcel->getActiveSheet()->setTitle('Hoja 2');

$sheet = $objPHPExcel->getActiveSheet($numero_registro);
$sheet->getPageMargins()->setTop(0.6);
$sheet->getPageMargins()->setBottom(0.6);
$sheet->getPageMargins()->setHeader(0.4);
$sheet->getPageMargins()->setFooter(0.4);
$sheet->getPageMargins()->setLeft(0.4);
$sheet->getPageMargins()->setRight(0.4);

$num = 1;
$list_prycto_subsstema = $objRprteRP->list_prycto_subsstema($codigo_subsistema);
if($list_prycto_subsstema){
    foreach ($list_prycto_subsstema as $dat_lsta_prycto_subsstma) {
        $pro_codigo = $dat_lsta_prycto_subsstma['pro_codigo'];
        $pro_referencia = $dat_lsta_prycto_subsstma['pro_referencia']; 
        $pro_numero = $dat_lsta_prycto_subsstma['pro_numero'];
        $pro_descripcion = $dat_lsta_prycto_subsstma['pro_descripcion'];
        $pro_objetivo = $dat_lsta_prycto_subsstma['pro_objetivo'];

        if($codigo_plan == 1){
            $descripcion_proyecto = $sigla_nivel_uno.".".$pro_referencia." ".$pro_descripcion;
        }
        else{
            $descripcion_proyecto = $pro_referencia.".".$pro_numero." ".$pro_descripcion;
        }

        $list_accion_ejecucion_x_proyecto = $objRprteRP->list_accion_ejecucion_x_proyecto($pro_codigo, $codigo_vigencia);
        if($list_accion_ejecucion_x_proyecto){
            foreach ($list_accion_ejecucion_x_proyecto as $dta_accnes_ejccion_x_prycto) {
                $acc_codigo = $dta_accnes_ejccion_x_prycto['acc_codigo'];
                $acc_referencia = $dta_accnes_ejccion_x_prycto['acc_referencia']; 
                $acc_numero = $dta_accnes_ejccion_x_prycto['acc_numero'];
                $acc_descripcion = $dta_accnes_ejccion_x_prycto['acc_descripcion']; 
                $acc_proyecto = $dta_accnes_ejccion_x_prycto['acc_proyecto'];
                $ind_codigo = $dta_accnes_ejccion_x_prycto['ind_codigo'];
                $ind_unidadmedida = $dta_accnes_ejccion_x_prycto['ind_unidadmedida']; 
                $ind_lineabase = $dta_accnes_ejccion_x_prycto['ind_lineabase'];
                $ind_metaresultado = $dta_accnes_ejccion_x_prycto['ind_metaresultado'];
                $ind_sede = $dta_accnes_ejccion_x_prycto['ind_sede'];
                $ivi_presupuesto = $dta_accnes_ejccion_x_prycto['ivi_presupuesto'];
                $ind_tipocomportamiento = $dta_accnes_ejccion_x_prycto['ind_tipocomportamiento'];

                if($codigo_plan == 1){
                    $descripcion_accion = $sigla_nivel_uno.".".$acc_referencia." ".$acc_descripcion;
                }
                else{
                    $descripcion_accion = $acc_referencia.".".$acc_numero." ".$acc_descripcion;
                }

                $sheet->mergeCells("A".$num.":G".$num);
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, 'PLAN INDICATIVO '.$codigo_vigencia);

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num.":G".$num)->applyFromArray($titulo_center_blanco);
                $num++;
                
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, strtoupper($nombre_nivel_dos));

                $sheet->mergeCells("B".$num.":G".$num);
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('B'.$num, $descripcion_proyecto);

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num)->applyFromArray($titulo_left);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num.":G".$num)->applyFromArray($titulo_left);
                $num++;

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, 'OBJETIVO');

                $sheet->mergeCells("B".$num.":G".$num);
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('B'.$num, $pro_objetivo);

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num)->applyFromArray($titulo_left);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num.":G".$num)->applyFromArray($titulo_left);
                $num++;

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, strtoupper(tildes($nombre_nivel_tres)))
                ->setCellValue('B'.$num, 'LÍNEA BASE '.$inicio_plan)
                ->setCellValue('C'.$num, 'META RESULTADO '.$fin_plan)
                ->setCellValue('D'.$num, 'DESCRIPCIÓN DE UNIDAD DE MEDIDA')
                ->setCellValue('E'.$num, 'TIPO DE META')
                ->setCellValue('F'.$num, 'SEDE')
                ->setCellValue('G'.$num, 'PRESUPUESTO');

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num)->applyFromArray($titulo_center_gris);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num)->applyFromArray($titulo_center_gris);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C".$num)->applyFromArray($titulo_center_gris);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("D".$num)->applyFromArray($titulo_center_gris);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("E".$num)->applyFromArray($titulo_center_gris);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("F".$num)->applyFromArray($titulo_center_gris);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("G".$num)->applyFromArray($titulo_center_gris);
                $num++;

                $tipo_meta = $objRprteRP->tipo_meta($ind_tipocomportamiento);

                $nombre_sede = $objRprteRP->nombre_sede($ind_sede);

                //ivi_presupuesto
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, $descripcion_accion)
                ->setCellValue('B'.$num, $ind_lineabase)
                ->setCellValue('C'.$num, $ind_metaresultado)
                ->setCellValue('D'.$num, $ind_unidadmedida)
                ->setCellValue('E'.$num, $tipo_meta)
                ->setCellValue('F'.$num, $nombre_sede)
                ->setCellValue('G'.$num, $ivi_presupuesto);

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num)->applyFromArray($texto_left);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num)->applyFromArray($texto_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C".$num)->applyFromArray($texto_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("D".$num)->applyFromArray($texto_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("E".$num)->applyFromArray($texto_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("F".$num)->applyFromArray($texto_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("G".$num)->applyFromArray($texto_moneda);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                $num++;
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, '')
                ->setCellValue('B'.$num, '')
                ->setCellValue('C'.$num, '')
                ->setCellValue('D'.$num, '')
                ->setCellValue('E'.$num, '')
                ->setCellValue('F'.$num, '')
                ->setCellValue('G'.$num, '');

                $num++;
                //actividades
                $sheet->mergeCells("A".$num.":F".$num);
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, 'PLAN DE ACCIÓN '.$codigo_vigencia);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num.":F".$num)->applyFromArray($titulo_center_blanco);

                $sheet->mergeCells("G".$num.":H".$num);
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('G'.$num, 'POAI');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("G".$num.":H".$num)->applyFromArray($titulo_center_azul);

                $sheet->mergeCells("I".$num.":J".$num);
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('I'.$num, 'EJECUCIÓN CDP');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I".$num.":J".$num)->applyFromArray($titulo_center_verde);

                $sheet->mergeCells("K".$num.":L".$num);
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('K'.$num, 'EJECUCIÓN RP');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num.":L".$num)->applyFromArray($titulo_center_naranja);

                $num++;

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, 'ACTIVIDAD');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num)->applyFromArray($titulo_center_blanco);

                $sheet->mergeCells("B".$num.":D".$num);
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('B'.$num, 'ETAPA');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num.":D".$num)->applyFromArray($titulo_center_blanco);

                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('E'.$num, 'COSTO ET')
                ->setCellValue('F'.$num, 'TOTAL ACTIV')
                ->setCellValue('G'.$num, 'POAI')
                ->setCellValue('H'.$num, 'POR ASIGNAR')
                ->setCellValue('I'.$num, 'CDP')
                ->setCellValue('J'.$num, 'SALDO POAI')
                ->setCellValue('K'.$num, 'RP')
                ->setCellValue('L'.$num, 'SALDO CDP');
                
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("E".$num)->applyFromArray($titulo_center_blanco);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("F".$num)->applyFromArray($titulo_center_blanco);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("G".$num)->applyFromArray($titulo_center_azul);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("H".$num)->applyFromArray($titulo_center_azul);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I".$num)->applyFromArray($titulo_center_verde);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("J".$num)->applyFromArray($titulo_center_verde);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num)->applyFromArray($titulo_center_naranja);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("L".$num)->applyFromArray($titulo_center_naranja);
                $num++;

                //ucfirst
                $list_actividades = $objRprteRP->list_actividades($acc_codigo, $codigo_vigencia, $ind_codigo);
                if($list_actividades){
                    $total_plan = 0;
                    $total_poai = 0;
                    $total_asignar = 0;
                    $total_cdp = 0;
                    $total_saldo_poai = 0;
                    $total_rp = 0;
                    $total_saldo_cdp = 0;
                    $inicio = $num;
                    foreach ($list_actividades as $dat_actvdades) {
                        $acp_codigo = $dat_actvdades['acp_codigo'];
                        $acp_referencia = $dat_actvdades['acp_referencia']; 
                        $acp_numero = $dat_actvdades['acp_numero'];
                        $acp_descripcion = $dat_actvdades['acp_descripcion'];

                        $descrpcion_actvdad = $acp_referencia.".".$acp_numero." ".ucfirst(tldes_minuscula($acp_descripcion));

                        $cantidad_etapas = $objRprteRP->cantidad_etapas($acp_codigo);

                        if($cantidad_etapas == 0){
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('A'.$num, $descrpcion_actvdad);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num)->applyFromArray($texto_left);
                        }
                        else{
                            $hasta = $num + $cantidad_etapas;
                            $sheet->mergeCells("A".$num.":A".$hasta);
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('A'.$num, $descrpcion_actvdad);
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num.":A".$hasta)->applyFromArray($texto_left);
                        }

                        $list_etapas = $objRprteRP->list_etapas($acp_codigo);

                        if($list_etapas){
                            $num_etapas = 1;
                            foreach ($list_etapas as $dat_etapas) {
                                $poa_codigo = $dat_etapas['poa_codigo'];
                                $poa_referencia = $dat_etapas['poa_referencia'];
                                $poa_numero = $dat_etapas['poa_numero']; 
                                $poa_objeto = $dat_etapas['poa_objeto'];
                                $poa_recurso = $dat_etapas['poa_recurso'];
                                $poa_logro = $dat_etapas['poa_logro']; 
                                $poa_estado = $dat_etapas['poa_estado'];

                                if($num_etapas == $cantidad_etapas+1){
                                    $valor_actividad = $objRprteRP->valor_actividad($acp_codigo);
                                }
                                else{
                                    $valor_actividad = 0;
                                }

                                $total_plan = $total_plan + $valor_actividad;

                                $valor_poai = $objRprteRP->valor_poai($poa_codigo);

                                $total_poai = $total_poai + $valor_poai;

                                $por_asignar = $poa_recurso - $valor_poai;

                                $total_asignar = $total_asignar + $por_asignar;

                                $valor_cdp = $objRprteRP->valor_cdp($poa_codigo);

                                $total_cdp =  $total_cdp + $valor_cdp;

                                $saldo_poai = $valor_poai - $valor_cdp;

                                $total_saldo_poai = $total_saldo_poai + $saldo_poai;

                                $valor_rp = $objRprteRP->valor_rp($poa_codigo);

                                $total_rp = $total_rp + $valor_rp;

                                $saldo_cdp = $valor_cdp - $valor_rp;

                                $total_saldo_cdp = $total_saldo_cdp + $saldo_cdp;

                                $descrpcion_etpa = $poa_referencia.".".$poa_numero." ".$poa_objeto;

                                $objPHPExcel->getActiveSheet()->getRowDimension($num)->setRowHeight(40);
                                $sheet->mergeCells("B".$num.":D".$num);
                                $objPHPExcel->setActiveSheetIndex($numero_registro)
                                ->setCellValue('B'.$num, ucfirst(tldes_minuscula($descrpcion_etpa)));
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num.":D".$num)->applyFromArray($texto_left);

                                $objPHPExcel->setActiveSheetIndex($numero_registro)
                                ->setCellValue('E'.$num, $poa_recurso)
                                ->setCellValue('F'.$num, $valor_actividad)
                                ->setCellValue('G'.$num, $valor_poai)
                                ->setCellValue('H'.$num, $por_asignar)
                                ->setCellValue('I'.$num, $valor_cdp)
                                ->setCellValue('J'.$num, $saldo_poai)
                                ->setCellValue('K'.$num, $valor_rp)
                                ->setCellValue('L'.$num, $saldo_cdp);
                                
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("E".$num)->applyFromArray($texto_moneda);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("F".$num)->applyFromArray($texto_moneda);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("G".$num)->applyFromArray($texto_center_azul);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("H".$num)->applyFromArray($texto_center_azul);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I".$num)->applyFromArray($texto_center_verde);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("J".$num)->applyFromArray($texto_center_verde);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('J'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num)->applyFromArray($texto_center_naranja);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('K'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle("L".$num)->applyFromArray($texto_center_naranja);
                                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('L'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                                $num_etapas++;
                                $num++;
                            }
                        }
                        else{
                            $sheet->mergeCells("B".$num.":L".$num);
                            $objPHPExcel->setActiveSheetIndex($numero_registro)
                            ->setCellValue('B'.$num, 'No hay Etapas');
                            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num.":L".$num)->applyFromArray($texto_left);
                            $num++;
                        }
                       
                    }
                    //-----Footer 
                    $sheet->mergeCells("A".$num.":E".$num);
                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('A'.$num, 'TOTAL PLAN INDICATIVO');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num.":E".$num)->applyFromArray($titulo_center_gris);

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('F'.$num, $total_plan)
                    ->setCellValue('G'.$num, $total_poai)
                    ->setCellValue('H'.$num, $total_asignar)
                    ->setCellValue('I'.$num, $total_cdp)
                    ->setCellValue('J'.$num, $total_saldo_poai)
                    ->setCellValue('K'.$num, $total_rp)
                    ->setCellValue('L'.$num, $total_saldo_cdp);

                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".$num)->applyFromArray($titulo_center_gris);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C".$num)->applyFromArray($titulo_center_gris);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("D".$num)->applyFromArray($titulo_center_gris);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("E".$num)->applyFromArray($titulo_center_gris);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("F".$num)->applyFromArray($titulo_center_gris);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("G".$num)->applyFromArray($titulo_center_gris);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("H".$num)->applyFromArray($titulo_center_gris);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("I".$num)->applyFromArray($titulo_center_gris);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("J".$num)->applyFromArray($titulo_center_gris);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('J'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("K".$num)->applyFromArray($titulo_center_gris);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('K'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("L".$num)->applyFromArray($titulo_center_gris);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('L'.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                    $num++;
                }
                else{
                    $sheet->mergeCells("A".$num.":L".$num);
                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('A'.$num, 'No hay Actividades');
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".$num.":L".$num)->applyFromArray($titulo_center_blanco);
                    $num++;
                }
                //$num++;
            }
        }
        
    }
}



$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(29);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(12);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(16);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(21);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('I')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('J')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('K')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('L')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('M')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('N')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('O')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('P')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('Q')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('R')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('S')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('T')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('U')->setWidth(19);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('V')->setWidth(20);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('W')->setWidth(26);
$objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('X')->setWidth(20);


$objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);


// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Rprte'.$nombre_archvo.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// incluir o gráfico no ficheiro que vamos gerar
$objWriter->setIncludeCharts(TRUE);
ob_end_clean();
$objWriter->save('php://output');
exit;

?>