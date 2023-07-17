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
    //'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    'wrap' => true
  )
);

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

$titulo_center = array(
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

include('crud/rs/rsRprtePlnCcion.php');
include('crud/rs/rprte_plan_accion/rprte_plan_accion.php');
include('crud/rs/rprte_asgnacion_pln_accion/rsRprteAsgncionRcrsosPlnAccion.php');

$codigo_plandesarrollo = $_REQUEST['codigo_plandesarrollo'];
$vigencia = $_REQUEST['vigencia'];
$sub_sistema = $_REQUEST['sub_sistema'];
$proyecto_cod = $_REQUEST['proyecto_cod'];
$accion_cod = $_REQUEST['accion_cod'];
$actividad_cod = $_REQUEST['actividad_cod'];

$sigla_nivel_cuatro = $objRprtePlnAccion->sigla_nivel_cuatro($actividad_cod);

$nombre_rprte = "AsignacionRecursosPlanAccion_".$sigla_nivel_cuatro."_";

$numero_excel=0;
$numero_registro=0;

$Subsistemas = $objRprtePlnAccion->subsstema($codigo_plandesarrollo, $sub_sistema);

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

    $nombreNivelTres = $objtReportePlanAccion->nombreNivelTres($codigo_plandesarrollo);

    $nombreNivelDos = $objtReportePlanAccion->nombreNivelDos($codigo_plandesarrollo);

    $list_proyecto = $objRprtePlnAccion->list_proyecto($sub_codigo, $proyecto_cod);

    $num=1;

    if($list_proyecto){
      foreach ($list_proyecto as $dta_list_proyecto){
        $pro_codigo = $dta_list_proyecto['pro_codigo'];
        $pro_descripcion = $dta_list_proyecto['pro_descripcion'];
        $pro_referencia = $dta_list_proyecto['pro_referencia'];
        $pro_numero = $dta_list_proyecto['pro_numero'];
        $pro_objetivo = $dta_list_proyecto['pro_objetivo'];

        if($codigo_plandesarrollo == 1){
          $referencia_proyectos = $sub_referencia.".".$pro_referencia;
        }
        else{
          $referencia_proyectos = $pro_referencia.".".$pro_numero;
        }

        $descripcion_proyecto = $referencia_proyectos." ".$pro_descripcion;

        $objetivo_proyecto = "OBJETIVO: ".$pro_objetivo;

        $sheet->mergeCells("A".($num).":A".($num+1));
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('A'.$num, strtoupper(tildes($nombreNivelDos)).':');

        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":A".($num+1))->applyFromArray($titulo_left);

        $sheet->mergeCells("B".($num).":K".($num));
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('B'.$num, $descripcion_proyecto);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":K".($num))->applyFromArray($texto_left);

        $num++;

        $sheet->mergeCells("B".($num).":K".($num));
        $objPHPExcel->setActiveSheetIndex($numero_registro)
        ->setCellValue('B'.$num, $objetivo_proyecto);
        $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":K".($num))->applyFromArray($texto_left);

        $num++;

        $accion_proyecto = $objRprtePlnAccion->accion_prycto($pro_codigo, $accion_cod);

        if($accion_proyecto){
          foreach ($accion_proyecto as $dta_accion_proyecto) {
            $acc_codigo=$dta_accion_proyecto['acc_codigo'];
            $acc_referencia=$dta_accion_proyecto['acc_referencia'];
            $acc_descripcion=$dta_accion_proyecto['acc_descripcion'];
            $acc_numero=$dta_accion_proyecto['acc_numero'];

            if($acc_numero==0){
              $codigo_nivelTres=$referenciaSubsistema.'.'.$pro_referencia;
            }
            else{
              $codigo_nivelTres=$acc_referencia.'.'.$acc_numero;
            }
            
            $descripcion_nivelTres=$codigo_nivelTres.' '.strtolower(tldes_minuscula($acc_descripcion));
    
            //Encabezado Accion
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('A'.$num, strtoupper(tildes($nombreNivelTres)).':');
    
            $sheet->mergeCells("B".($num).":K".($num));
            $objPHPExcel->setActiveSheetIndex($numero_registro)
            ->setCellValue('B'.$num, $descripcion_nivelTres);
    
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($titulo_left);
            $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":K".($num))->applyFromArray($texto_left);

            $num++;
        
            $actividadPoai=$objRprtePlnAccion->actvdadPoai($acc_codigo, $vigencia, $actividad_cod);
            if($actividadPoai){
              
              foreach($actividadPoai as $data_actividadPoai){
                $acp_codigo = $data_actividadPoai['acp_codigo'];
                $acp_referencia = $data_actividadPoai['acp_referencia'];
                $acp_numero = $data_actividadPoai['acp_numero'];
                $acp_descripcion = $data_actividadPoai['acp_descripcion'];
                $acp_oficina = $data_actividadPoai['acp_oficina'];
                $acp_cargo = $data_actividadPoai['acp_cargo'];
                $acp_sedeindicador = $data_actividadPoai['acp_sedeindicador'];
                $acp_unidad = $data_actividadPoai['acp_unidad'];
                $acp_vigencia = $data_actividadPoai['acp_vigencia'];
                $acp_objetivo = $data_actividadPoai['acp_objetivo'];

                $datos_indicador = $objtReportePlanAccion->datos_indicador($acp_sedeindicador);
                if($datos_indicador){
                  foreach ($datos_indicador as $dta_dtos_indicador) {
                    $ind_codigo = $dta_dtos_indicador['ind_codigo'];
                    $ind_unidadmedida = $dta_dtos_indicador['ind_unidadmedida'];
                    $ind_sede = $dta_dtos_indicador['ind_sede'];
                    $sed_nombre = $dta_dtos_indicador['sed_nombre'];
                  }
                }

                if($acp_oficina){
                  $nombre_oficina = $objtReportePlanAccion->nombre_oficina($acp_oficina);
                }

                $oficina = "Oficina: ".$nombre_oficina;

                if($acp_cargo){
                  $nombre_cargo = $objtReportePlanAccion->nombre_cargo($acp_cargo);
                }

                $cargo = "Responsable: ".$nombre_cargo;

                $rsponsable = $oficina."\n".$cargo;
                
                $actividadDescripcionPoai=$acp_referencia.'.'.$acp_numero.' '.strtolower(tldes_minuscula($acp_descripcion));

                $totalAvance=0;

                $total_por_asignar = 0;
                
                //Encabezado Actividad
                $objPHPExcel->setActiveSheetIndex($numero_registro)
                ->setCellValue('A'.$num, 'Actividad')
                ->setCellValue('B'.$num, 'Objetivo')
                ->setCellValue('C'.$num, 'Vigencia')
                ->setCellValue('D'.$num, 'Sede')
                ->setCellValue('E'.$num, 'Descripción Unidad de Medida')
                ->setCellValue('F'.$num, 'Meta')
                ->setCellValue('G'.$num, 'Etapa')
                ->setCellValue('H'.$num, 'Vigencia')
                ->setCellValue('I'.$num, 'Recursos')
                ->setCellValue('J'.$num, 'Peso de la Etapa %')
                ->setCellValue('K'.$num, 'Avance inicial de la Etapa %');

                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($titulo_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->applyFromArray($titulo_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($titulo_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->applyFromArray($titulo_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('E'.$num)->applyFromArray($titulo_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num)->applyFromArray($titulo_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num)->applyFromArray($titulo_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num)->applyFromArray($titulo_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num)->applyFromArray($titulo_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registroActividad)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('J'.$num)->applyFromArray($titulo_center);
                $objPHPExcel->getActiveSheet($numero_registro)->getStyle('K'.$num)->applyFromArray($titulo_center);
                
                //Datos Asignacion 
                $fuentes_asignadas_accion = $objRprte->fuentes_asignadas_accion($acp_codigo);
                if($fuentes_asignadas_accion){
                  $numeroletasaumenta = 76;
                  $numeroletrauno = 76;
                  $numeroletrados = 64;
                  foreach ($fuentes_asignadas_accion as $dta_lsta_fuente_financiacion) {
                    $asre_fuente = $dta_lsta_fuente_financiacion['asre_fuente'];
                    $asre_vigenciarecurso = $dta_lsta_fuente_financiacion['asre_vigenciarecurso'];
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

                    $titulo = str_replace('INV -','',$ffi_nombre)." ".$asre_vigenciarecurso;

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue($letra.$num, $titulo);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($titulo_center);

                    $numeroletasaumenta++;
                  }
                  //Total
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
                  ->setCellValue($letra.$num, 'TOTAL');
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($titulo_center);

                  $numeroletasaumenta++;
                  //Por Asignar
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
                  ->setCellValue($letra.$num, 'POR ASIGNAR');
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($titulo_center);

                  $numeroletasaumenta++;
                }

                $num++;

                //Encabezado Cuerpo
                $cantidadActividaddes=$objtReportePlanAccion->cantidadCombinar($acp_codigo);
                if($cantidadActividaddes==1 || $cantidadActividaddes==0){
                  $objPHPExcel->setActiveSheetIndex($numero_registro)
                  ->setCellValue('A'.$num, $actividadDescripcionPoai)
                  ->setCellValue('B'.$num, $acp_objetivo)
                  ->setCellValue('C'.$num, $acp_vigencia)
                  ->setCellValue('D'.$num, $sed_nombre)
                  ->setCellValue('E'.$num, $ind_unidadmedida)
                  ->setCellValue('F'.$num, $acp_unidad);

                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('A'.$num)->applyFromArray($texto_left);
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('B'.$num)->applyFromArray($texto_left);
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('C'.$num)->applyFromArray($texto_center);
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('D'.$num)->applyFromArray($texto_center);
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num)->applyFromArray($texto_left);
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('F'.$num)->applyFromArray($texto_center);
                }
                else{
                  $sheet->mergeCells("A".($num).":A".($num+$cantidadActividaddes-1));
                  $objPHPExcel->setActiveSheetIndex($numero_registro)
                  ->setCellValue('A'.$num, $actividadDescripcionPoai);
                  
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":A".($num+$cantidadActividaddes))->applyFromArray($texto_left);
                  
                  $sheet->mergeCells("B".($num).":B".($num+$cantidadActividaddes-1));
                  $objPHPExcel->setActiveSheetIndex($numero_registro)
                  ->setCellValue('B'.$num, $acp_objetivo);
                  
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":B".($num+$cantidadActividaddes))->applyFromArray($texto_left);

                  $sheet->mergeCells("C".($num).":C".($num+$cantidadActividaddes-1));
                  $objPHPExcel->setActiveSheetIndex($numero_registro)
                  ->setCellValue('C'.$num, $acp_vigencia);
                  
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("C".($num).":C".($num+$cantidadActividaddes))->applyFromArray($texto_center);

                  $sheet->mergeCells("D".($num).":D".($num+$cantidadActividaddes-1));
                  $objPHPExcel->setActiveSheetIndex($numero_registro)
                  ->setCellValue('D'.$num, $sed_nombre);
                  
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("D".($num).":D".($num+$cantidadActividaddes))->applyFromArray($texto_center);

                  $sheet->mergeCells("E".($num).":E".($num+$cantidadActividaddes-1));
                  $objPHPExcel->setActiveSheetIndex($numero_registro)
                  ->setCellValue('E'.$num, $ind_unidadmedida);
                  
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("E".($num).":E".($num+$cantidadActividaddes))->applyFromArray($texto_left);

                  $sheet->mergeCells("F".($num).":F".($num+$cantidadActividaddes-1));
                  $objPHPExcel->setActiveSheetIndex($numero_registro)
                  ->setCellValue('F'.$num, $acp_unidad);
                  
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("F".($num).":F".($num+$cantidadActividaddes))->applyFromArray($texto_center);
                
                }
                //Etapas Actividad
                $etapas=$objtReportePlanAccion->etapas($acp_codigo);
                if($etapas){
                  $peso_estapa = 0;
                  $cdgos_etpas = '';
                  $numero_etpas = count($etapas);
                  $contador_etpas = 1;
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
                    $poa_codigoclasificadorpresupuestal = $data_etapas['poa_codigoclasificadorpresupuestal'];
                    $poa_dane = $data_etapas['poa_dane'];
                    $poa_descripcionclasificador =$data_etapas['poa_descripcionclasificador'];
                    
                    $codigo_pre = $poa_codigoclasificadorpresupuestal;
                    $descripicion_codigo = $poa_descripcionclasificador;

                    $etapa_descripcion=$poa_referencia.'.'.$poa_numero.' '.$poa_objeto;

                    $avanceInicial=$poa_logroejecutado.'=>'.$avance_esperado/100;

                    $peso_estapa = $peso_estapa + $poa_logro;
                  
                    $asignado_etapa = 0;

                    if($numero_etpas == $contador_etpas){
                      $coma = '';
                    }
                    else{
                      $coma = ',';
                    }

                    $cdgos_etpas = $cdgos_etpas.$poa_codigo.$coma;

                    $objPHPExcel->setActiveSheetIndex($numero_registro)
                    ->setCellValue('G'.$num, $etapa_descripcion)
                    ->setCellValue('H'.$num, $poa_vigencia)
                    ->setCellValue('I'.$num, $poa_recurso)
                    ->setCellValue('J'.$num, $poa_logro)
                    ->setCellValue('K'.$num, $avanceInicial);

                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('G'.$num)->applyFromArray($texto_left);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('H'.$num)->applyFromArray($texto_center);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num)->applyFromArray($texto_center);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('J'.$num)->applyFromArray($texto_center);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle('K'.$num)->applyFromArray($texto_center);
                    
                    //Datos Asignacion 
                    $fuentes_asignadas_accion = $objRprte->fuentes_asignadas_accion($acp_codigo);
                    if($fuentes_asignadas_accion){
                      $numeroletasaumenta = 76;
                      $numeroletrauno = 76;
                      $numeroletrados = 64;
                      foreach ($fuentes_asignadas_accion as $dta_lsta_fuente_financiacion) {
                        $asre_fuente = $dta_lsta_fuente_financiacion['asre_fuente'];
                        $asre_vigenciarecurso = $dta_lsta_fuente_financiacion['asre_vigenciarecurso'];
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

                        $recurso_asignado = $objRprte->recurso_asignado($poa_codigo, $asre_fuente, $asre_vigenciarecurso);

                        $asignado_etapa = $asignado_etapa + $recurso_asignado;

                        $objPHPExcel->setActiveSheetIndex($numero_registro)
                        ->setCellValue($letra.$num, $recurso_asignado);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($texto_center);
                        $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                        $numeroletasaumenta++;
                      }
                      //Total
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
                      ->setCellValue($letra.$num, $asignado_etapa);
                      $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($texto_center);
                      $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                      $numeroletasaumenta++;
                      //Por Asignar
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

                      $por_asignar = $poa_recurso - $asignado_etapa;

                      $total_por_asignar = $total_por_asignar + $por_asignar;

                      $objPHPExcel->setActiveSheetIndex($numero_registro)
                      ->setCellValue($letra.$num, $por_asignar);
                      $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($texto_center);
                      $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                      $numeroletasaumenta++;
                    }

                    $contador_etpas++;
                    $num++;
                  }
                  $sumaRecurso = $objtReportePlanAccion->sumaRecursoEtapas($acp_codigo);

                  $rs_avanceEsperado=$objtReportePlanAccion->avanceEsperado($acp_codigo);

                  if($rs_avanceEsperado){
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

                  $sheet->mergeCells("A".($num).":H".($num));
                  $objPHPExcel->setActiveSheetIndex($numero_registro)
                  ->setCellValue('A'.$num, 'TOTAL')
                  ->setCellValue('I'.$num, $sumaRecurso)
                  ->setCellValue('J'.$num, $peso_estapa)
                  ->setCellValue('K'.$num, $av);
                  
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":H".($num))->applyFromArray($texto_centr_total);
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num)->applyFromArray($texto_center);
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('I'.$num_registroActividad)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('J'.$num)->applyFromArray($texto_center);
                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle('K'.$num)->applyFromArray($texto_center);

                  ///************************* TOTAL X FUENTES  ************************
                  $lst_fntes_accion = $objRprte->fuentes_asignadas_accion($acp_codigo);
                  if($lst_fntes_accion){
                    $numeroletasaumenta = 76;
                    $numeroletrauno = 76;
                    $numeroletrados = 64;
                    $total_asignado_completo = 0;
                    foreach ($lst_fntes_accion as $datt_fntes) {
                      $asre_fuente = $dta_lsta_fuente_financiacion['asre_fuente'];
                      $asre_vigenciarecurso = $dta_lsta_fuente_financiacion['asre_vigenciarecurso'];
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

                      $total_asignado_fuente = $objRprte->recurso_asignado($cdgos_etpas, $asre_fuente, $asre_vigenciarecurso);

                      $total_asignado_completo = $total_asignado_completo + $total_asignado_fuente;

                      $objPHPExcel->setActiveSheetIndex($numero_registro)
                      ->setCellValue($letra.$num, $total_asignado_fuente);
                      $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($texto_center);
                      $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                      $numeroletasaumenta++;
                    }
            
                    //Total
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
                    ->setCellValue($letra.$num, $total_asignado_completo);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($texto_center);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                    $numeroletasaumenta++;
                    //Por Asignar
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
                    ->setCellValue($letra.$num, $total_por_asignar);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->applyFromArray($texto_center);
                    $objPHPExcel->getActiveSheet($numero_registro)->getStyle($letra.$num)->getNumberFormat()->setFormatCode('_("$"* #,##0_);_("$"* \(#,##0\);_("$"* "-"??_);_(@_)');

                    $numeroletasaumenta++;
                  }

                  $num++;
                }
                else{
                  $sheet->mergeCells("B".($num).":K".($num));
                  $objPHPExcel->setActiveSheetIndex($numero_registro)
                  ->setCellValue('B'.$num, 'No hay Etapas');

                  $objPHPExcel->getActiveSheet($numero_registro)->getStyle("B".($num).":K".($num))->applyFromArray($texto_left);
                  $num++;
                }
                $acp_codigo = 0;
                $av = 0;
                $peso_estapa = 0;
              }
            }//IF ACTIVIDADES
            else{
              $sheet->mergeCells("A".($num).":K".($num));
              $objPHPExcel->setActiveSheetIndex($numero_registro)
              ->setCellValue('A'.$num, 'No hay Actividades');

              $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":K".($num))->applyFromArray($texto_left);
              $num++;
            }
          }
        }
        else{
          $sheet->mergeCells("A".($num).":K".($num));
          $objPHPExcel->setActiveSheetIndex($numero_registro)
          ->setCellValue('A'.$num, 'No hay Registros');
          $objPHPExcel->getActiveSheet($numero_registro)->getStyle("A".($num).":K".($num))->applyFromArray($texto_left);

          $num++;
        }
      }
    }

    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('A')->setWidth(25);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('B')->setWidth(23);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('C')->setWidth(10);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('D')->setWidth(12);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('F')->setWidth(10);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('G')->setWidth(30);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('H')->setWidth(10);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('I')->setWidth(18);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('J')->setWidth(11);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('K')->setWidth(12);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('L')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('M')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('N')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('O')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('P')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('Q')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('R')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('S')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('T')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('U')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('V')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('W')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('X')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('Y')->setWidth(24);
    $objPHPExcel->getActiveSheet($numero_excel)->getColumnDimension('Z')->setWidth(24);

    $objPHPExcel->getActiveSheet($numero_excel)->getRowDimension($numero_ingresos)->setRowHeight(30);


    $numero_registro++;
  }//Cierre Foreach Subsistema
}//Cierre if subsistemas

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$nombre_rprte.$fecha_generar.'.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// incluir o gráfico no ficheiro que vamos gerar
$objWriter->setIncludeCharts(TRUE);
ob_end_clean();
$objWriter->save('php://output');
exit;

?>