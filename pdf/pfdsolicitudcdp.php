<?php

use Mpdf\Tag\Center;

set_time_limit(1800000000);
require_once('tcpdf_hefo/config/lang/eng.php');
require_once('tcpdf_hefo/tcpdf.php');

function nombre_mes($numero_mes){

    switch ($numero_mes) {
        case 1:
            $nombre_mes = "Enero";
            break;
        case 2:
            $nombre_mes = "Febrero";
            break;
        case 3:
            $nombre_mes = "Marzo";
            break;
        case 4:
            $nombre_mes = "Abril";
            break;
        case 5:
            $nombre_mes = "Mayo";
            break;
        case 6:
            $nombre_mes = "Junio";
            break;
        case 7:
            $nombre_mes = "Julio";
            break;
        case 8:
            $nombre_mes = "Agosto";
            break;
        case 9:
            $nombre_mes = "Septiembre";
            break;
        case 10:
            $nombre_mes = "Octubre";
            break;
        case 11:
            $nombre_mes = "Noviembre";
            break;
        case 12:
            $nombre_mes = "Diciembre";
            break;
    }
    return $nombre_mes;
}

function tildes($palabra){
    $no_admitidas = array("á","é","í","ó","ú",'ñ');
    $admitidas = array("Á", "É", "Í", "Ó", "Ú",'Ñ');
    $texto = str_replace($no_admitidas, $admitidas ,$palabra);
    return $texto;
}



//////////////Yuliana 

class MYPDF extends TCPDF {
    
	public function Header(){
       // Logo
       $codigo="Código: FM-001";
       $vigencia="Vigente desde: 01/04/2018";
       $version="Versión: 2";
       $style2 = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
       $image_logousco = 'img/logohtml.png';
       $this->setTextColor(0, 0, 0);
       $this->SetDrawColor(0, 0, 0);
       $this->SetLineWidth(0.1);
       
       
       $this->SetFillColor(255, 255, 127);
       
       $version='GABC-GA-04-01';

       $nombrecolegio='GIMNASIO AMERICANO ABC';

       $fchaa = date('Y-m-d');

       $year_numm = substr($fchaa,0,4);
       $mes_numm = substr($fchaa,5,2);
       $dia_numm = substr($fchaa,8,2);

       $fchh = "Fecha: ".$dia_numm."/".$mes_numm."/".$year_numm;
       
       $DTOS = 'DIAGNOSTICO';
       $codigo = 'CODIGO';
       $titulo_universidad = 'UNIVERSIDAD SURCOLOMBIANA';
       $titulo_cartera = 'GESTIÓN FINANCIERA Y DE RECURSOS FÍSICOS';
       $titulo_formato='FORMATO ÚNICO SOLICITUD DE EXPEDICIÓN CERTIFICADO';
       $subtitulo_formato = 'DE DISPONIBILIDAD PRESUPUESTAL - CDP';
       $codigo_formato = 'AP-FIN-FO-08';
       $version = 'VERSION';
       $num_version = '8';
       $vigencia = 'VIGENCIA';
       $num_vigencia = '2023';
       $pagina = 'PAGINA';
       $num_pagina = '1 DE 1';

       // version
       $this->SetFont('helvetica', ' ', 8);
       $this->MultiCell(30, 30, ' ', 1, 'C', 0, 0, '', '', true, 0, false, true, 6, 'M');

       //imagen de la institución
       $this->SetFont('helvetica', ' ', 8);
       //$this->MultiCell(40, 30, ' ', 1, 'C', 0, 1, '', '', true);			
       $this->Image($image_logousco, 7, 8, 25, 25, 'PNG', '', 'M', false, 120, '', false, false, 0, false, false, false);

       // CODIGO
       $this->SetFillColor(185, 33, 9);
       $this->setTextColor(255, 255, 255);
       $this->SetFont('dejavusans', 'B', 9);
       $this->MultiCell(30, 7, $codigo, 1, 'C', 1, 2, '5', '35', true,0,false,true,5);

       //TITULO UNIVERSIDAD
       $this->SetFillColor(185, 33, 9);
       $this->setTextColor(255, 255, 255);
       $this->SetFont('dejavusans', 'B', 9);
       $this->MultiCell(130, 7.5, $titulo_universidad, 1, 'C', 1, 2, '35', '5', true,0,false,true,5);

       //TITULO CARTERA
       $this->SetFillColor(185, 33, 9);
       $this->setTextColor(255, 255, 255);
       $this->SetFont('dejavusans', 'B', 9);
       $this->MultiCell(130, 7.5, $titulo_cartera, 0, 'C', 1, 2, '35', '12', true,0,false,true,5);

       //TITULO FORMATO
       $this->SetFillColor(255, 255, 255);
       $this->setTextColor(0,0,0);
       $this->SetFont('dejavusans', 'B', 9);
       $this->MultiCell(130, 7.5, $titulo_formato, 0, 'C', 1, 1, '35', '20', true,0,false,true,5);

       //SUBTITULO FORMATO
       $this->SetFillColor(255, 255, 255);
       $this->setTextColor(0,0,0);
       $this->SetFont('dejavusans', 'B', 9);
       $this->MultiCell(130, 7.5, $subtitulo_formato, 0, 'C', 1, 1, '35', '27.2', true,0,false,true,5);

       //CODIGO FORMATO
       $this->SetFillColor(255, 255, 255);
       $this->setTextColor(0,0,0);
       $this->SetFont('dejavusans', 'B', 7);
       $this->MultiCell(21.6, 7, $codigo_formato, 1, 'C', 1, 1, '35', '35', true,0,false,true,5);

       
       // VERSION
       $this->SetFillColor(185, 33, 9);
       $this->setTextColor(255, 255, 255);
       $this->SetFont('dejavusans', 'B', 9);
       $this->MultiCell(21.6, 7, $version, 1, 'C', 1, 2, '56.6', '35', true,0,false,true,5);

       //NUMERO VERSION
       $this->SetFillColor(255, 255, 255);
       $this->setTextColor(0,0,0);
       $this->SetFont('dejavusans', 'B', 7);
       $this->MultiCell(21.6, 7, $num_version, 1, 'C', 1, 1, '78.2', '35', true,0,false,true,5);

       // VIGENCIA
       $this->SetFillColor(185, 33, 9);
       $this->setTextColor(255, 255, 255);
       $this->SetFont('dejavusans', 'B', 9);
       $this->MultiCell(21.6, 7, $vigencia, 1, 'C', 1, 2, '99.8', '35', true,0,false,true,5);

       //NUMERO VERSION
       $this->SetFillColor(255, 255, 255);
       $this->setTextColor(0,0,0);
       $this->SetFont('dejavusans', 'B', 7);
       $this->MultiCell(21.6, 7, $num_vigencia, 1, 'C', 1, 1, '121.4', '35', true,0,false,true,5);

       //PAGINA
       $this->SetFillColor(185, 33, 9);
       $this->setTextColor(255, 255, 255);
       $this->SetFont('dejavusans', 'B', 9);
       $this->MultiCell(22, 7, $pagina, 1, 'C', 1, 2, '143', '35', true,0,false,true,5);

       //NUMERO PAGINA
       $this->SetFillColor(255, 255, 255);
       $this->setTextColor(0,0,0);
       $this->SetFont('dejavusans', 'B', 7);
       $this->MultiCell(40, 7, $num_pagina, 1, 'C', 1, 1, '165', '35', true,0,false,true,5);

       //IMAGEN ISO CALIDAD
       $image_calidad = 'plantilla/img/log.png';
       $this->setTextColor(0, 0, 0);
       $this->SetDrawColor(0, 0, 0);
       $this->SetLineWidth(0.1);

       $this->MultiCell(40, 30, ' ', 1, 'C', 0, 0, '165', '5', true, 0, false, true, 6, 'M');
       $this->Image($image_calidad, 170, 8, 30, 20, 'PNG', '', 'M', false, 120, '', false, false, 0, false, false, false);
    }

	// Page footer
	public function Footer() {

        $style2 = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));

        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', '', 8);
        
       
        // Custom footer HTML
        $this->html = '<hr><br><span>Vigilada Mineducación
        La versión vigente y controlada de este documento, solo podrá ser consultada a través del sitio web Institucional  www.usco.edu.co, link Sistema Gestión de Calidad. La copia o impresión diferente a la publicada, será considerada como documento no controlado y su uso indebido no es de responsabilidad de la Universidad Surcolombiana.</span></hr>';
        $this->writeHTML($this->html, false, false, true, false, '');


       
        // Page number
        //$this->Line(2, 288, 200, 288, $style2);
        
        //$this->MultiCell(40, 10, $txt, 1, 'C', 0, 0, '', true, 0, false, true, 10, 'M');
       // $this->Cell(0, 0, $txt , 0, false, 'C', 0, 1, 0, false, 'T', 'M');	
       // $this->Cell(0, 0, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'Letter', true, 'UTF-8', false);

///////////////////////////////////

$codigo_cdp = $_REQUEST['codigo_cdp'];




// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ABC');
$pdf->SetTitle($nombreDocumento);
$pdf->SetSubject('Impresión Diagnostico');
$pdf->SetKeywords('Certificado, PDF, ABC, DIAGNOSTICO');

// remove default header/footer
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setHeaderTemplateAutoreset(true);
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER + 28);


//set auto page breaks

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 19);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 15);

// add a page
$pdf->AddPage();
//echo '---->'.$codigo_acta;

include('crud/rs/rprte_slctud_cdp/rprte_slctud_cdp.php');
list($people,$car_nombre,$scdp_resolucion,$scdp_fecharesolucion,$scdp_numero,$scdp_consecutivo,$scdp_objeto,$valor_cdp) = $objRprteSlctudCdp->resolucionPersona($codigo_cdp);


$html.='
    <table nobr="true" style="padding-left: 5px;" cellpadding="2">
    
        <tr nobr="true">
            <td style="width: 336px; height: 40px; font-size:70%; text-align:left;"><strong>'.$ordenador_gasto.'<br>ORDENADOR DEL GASTO:</strong></td>
         
        </tr>
        <tr nobr="true">
            <td style="width: 336px; height: 10px; font-size:70%; text-align:left; text-transform: uppercase;">'.$nombreordenador_gasto.'<br>NOMBRE:&nbsp;'.$people.'</td>
            
        </tr>
        <tr nobr="true">
            <td style="width: 336px; height: 10px; font-size:70%; text-align:left;">'.$cargoordenador_gasto.'<br>CARGO:&nbsp;'.$car_nombre.'</td>
            
        </tr>
        <tr nobr="true">
            <td style="width: 336px; height: 10px; font-size:70%; text-align:left;">'.$resolucionordenador_gasto.'<br>RESOLUCION ORDENACIÓN DEL GASTO No:&nbsp;'.$scdp_resolucion.'</td>
      
        </tr>
        <tr nobr="true">
            <td style="width: 336px; height: 10px; font-size:70%; text-align:left;">'.$fechaordenador_gasto.'<br>FECHA:&nbsp;'.$scdp_fecharesolucion.'</td>
       
        </tr>

    </table>
    <p style="font-size: 30px;"> &nbsp;</p>
';

$ceros = '';

  if($scdp_consecutivo <10){
    $ceros = '0000';
  }
  else if ($scdp_consecutivo > 9 && $scdp_consecutivo <100){
    $ceros = '000';
  }
  else if( $scdp_consecutivo >99 && $scdp_consecutivo <1000){
    $ceros = '00';
  }
  else if( $scdp_consecutivo >999 && $scdp_consecutivo <10000){
    $ceros = '0';
    
  }else{
    $ceros = '';
  }
  $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;


$html.='
    <table nobr="true" style="padding-left: 5px;" cellpadding="2">
    
        <tr nobr="true">
           
            <td style="width: 450px; height: 10px; font-size:70%; text-align:right; left:50;">'.$solicitud_numero.'<br>SOLICITUD No:&nbsp;'.$numero_solicitudCDP.'</td>

            <td style="width: 337px; height: 40px; font-size:70%; text-align:center;"><strong></strong></td>
        </tr>
        
        <tr nobr="true">
           
            <td style="width: 150px; height: 10px; font-size:70%; text-align:left; ">'.$expedido_por.'<br>EXPEDIDO POR:</td>
            <td style="width: 200px; height: 10px; font-size:70%; text-align:left; "><br>JEFE DE PRESUPUESTO</td>
        </tr>
      
    </table>
    <p style="font-size: 30px;"> &nbsp;</p>
';

$html.='
    <table nobr="true" style="padding-left: 5px;" cellpadding="2">
    
        <tr nobr="true">
            <td style="width: 337px; height: 20px; font-size:70%; text-align:center;"><strong></strong></td>
        </tr>
        <tr nobr="true">
            <td style="width: 100px; height: 10px; font-size:70%; text-align:left;">'.$objeto.'<br>OBJETO:&nbsp;</td>
            <td style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black; height: 80px; font-size:70%;">'.$scdp_objeto.'</td>
        </tr>
    </table>
    <p style="font-size: 30px;"> &nbsp;</p>
';  


$excedenteDeFacultad = $objRprteSlctudCdp->excedenteFacultad($codigo_cdp);

if($excedenteDeFacultad==1){
$html.='
    <table nobr="true" style="padding-left: 5px;" cellpadding="2">
        
        <tr nobr="true">
            <td style="width: 337px; height: 20px; font-size:70%; text-align:center;"><strong></strong></td>
        </tr>
        <tr nobr="true">
            <td style="width: 200px; height: 40px; font-size:70%; text-align:left;">'.$excedentes_facultad.'<br>EXCEDENTES DE FACULTAD:</td>
            <td style="border-collapse: collapse;margin:0px;border:1px solid black; height: 2px; width: 30px; font-size:70%; text-align:center; padding: 2px">SI</td>
            <td style="border-collapse: collapse;margin:0px;border:1px solid black; height: 2px; width: 30px; font-size:70%; text-align:center">X</td>
            <td style="border-collapse: collapse;margin:0px;border:1px solid black;  height: 2px; width: 30px; font-size:70%; text-align:center">NO</td>
            <td style="border-collapse: collapse;margin:0px;border:1px solid black; height: 2px; width: 30px; font-size:70%; text-align:center"></td>
        
        </tr>


    </table>
    <p style="font-size: 30px;"> &nbsp;</p>
';
}
else{
    $html.='
    <table nobr="true" style="padding-left: 5px;" cellpadding="2">
        
        <tr nobr="true">
            <td style="width: 337px; height: 20px; font-size:70%; text-align:center;"><strong></strong></td>
        </tr>
        <tr nobr="true">
            <td style="width: 200px; height: 40px; font-size:70%; text-align:left;">'.$excedentes_facultad.'<br>EXCEDENTES DE FACULTAD:</td>
            <td style="border-collapse: collapse;margin:0px;border:1px solid black; height: 2px; width: 30px; font-size:70%; text-align:center; padding: 2px">SI</td>
            <td style="border-collapse: collapse;margin:0px;border:1px solid black; height: 2px; width: 30px; font-size:70%; text-align:center"></td>
            <td style="border-collapse: collapse;margin:0px;border:1px solid black;  height: 2px; width: 30px; font-size:70%; text-align:center">NO</td>
            <td style="border-collapse: collapse;margin:0px;border:1px solid black; height: 2px; width: 30px; font-size:70%; text-align:center">X</td>
        
        </tr>


    </table>
    <p style="font-size: 30px;"> &nbsp;</p>
';
}

$lista_poai = $objRprteSlctudCdp->poai($codigo_cdp);
  $num_registro=25;
  $id_registro=1;
  if($lista_poai){
    foreach ($lista_poai as $data_lista_etapa) {
      $poa_referencia = $data_lista_etapa['poa_referencia'];
      $poa_numero = $data_lista_etapa['poa_numero'];
      $esc_valor = $data_lista_etapa['esc_valor'];
      $esc_clasificador = $data_lista_etapa['esc_clasificador'];
      $esc_dane = $data_lista_etapa['esc_dane'];
      
      
      $str = $esc_clasificador;
      $numero_caracteres = strlen($str); 
      $desde = $numero_caracteres - 2;
      $ultimos_caracteres= substr($str,$desde,2);

      $fuente = $objRprteSlctudCdp->fuentes_financiacionCDP($ultimos_caracteres);
      
      $poa_etapa = $poa_referencia." ".$poa_numero;

$html.='
    <table nobr="true" style="padding-left: 5px; " cellpadding="2">

        <tr nobr="true">
            <td style="width: 337px; height: 40px; font-size:70%; text-align:center;"><strong></strong></td>
        </tr>
    
        <tr nobr="true">
           
            <th style="width: 160px; height: 10px; font-size:70%; text-align:left;">'.$plan_accion.'<br>PLAN DE ACCIÓN:</th>
            <th style="width: 80px;  font-size:60%; text-align:center;padding-top: 5px ">'.$valor.'<br>VALOR</th>
            <th style="width: 150px; height: 10px; font-size:60%; text-align:center;padding-top: 5px ">'.$codigo_presupuestal.'<br>CODIGO PRESUPUESTAL</th>
            <th style="width: 80px;  font-size:60%; text-align:center;padding-top: 5px ">'.$codigo_dane.'<br>CODIGO DANE</th>
            <th style="width: 150px; height: 10px; font-size:60%; text-align:center;padding-top: 5px ">'.$fuente_financiacion.'<br>FUENTE DE FINANCIACIÓN</th>
            <th style="width: 80px;  font-size:60%; text-align:center;padding-top: 5px ">'.$etapa_actividad.'<br>ESTAPA DE LA ACTIVIDAD No.</th>
           
        </tr>

       

        <tr nobr="true">
           
            <th style="width: 160px; height: 10px; font-size:60%; text-align:center;padding-top: 5px ">'.$valor.'<br></th>
            <th style="width: 80px; height: 10px; font-size:60%; text-align:center;padding-top: 5px ">'.$valor.'<br>'.$esc_valor.'</th>
            <th style="width: 150px; font-size:60%; text-align:center;padding-top: 5px ">'.$codigo_presupuestal.'<br>'.$esc_clasificador.'</th>
            <th style="width: 80px;  font-size:60%; text-align:center;padding-top: 5px ">'.$codigo_dane.'<br>'. $esc_dane.'</th>
            <th style="width: 150px; height: 10px; font-size:60%; text-align:center;padding-top: 5px ">'.$fuente_financiacion.'<br>'.$fuente.'</th>
            <th style="width: 80px;  font-size:60%; text-align:center;padding-top: 5px ">'.$etapa_actividad.'<br>'.$poa_etapa.'</th>
           
        </tr>
        
        <tr nobr="true">
           
    
        </tr>
      
    </table>
    <p style="font-size: 30px;"> &nbsp;</p>
';
  }
}

$html.='
    <table nobr="true" style="padding-left: 5px;" >
        
        <tr nobr="true">
            <td style="width: 337px; height: 100px; font-size:70%; text-align:center;"><strong></strong></td>
        </tr>
        <tr nobr="true">
            <td style="width: 200px; height: 2px; font-size:70%; text-align:left;">'.$otros_conceptos.'<br><strong>OTROS CONCEPTOS:</strong></td>
        </tr>
        <tr nobr="true">
            <td style="width: 200px; height: 40px; font-size:70%; text-align:left;">'.$valor_total.'<br><strong>VALOR TOTAL SOLICITADO:</strong></td>
            <td style="width: 200px; height: 40px; font-size:60%; text-align:left;">'.$valor_total.'<br>'.$valor_cdp.'</td>
        </tr>
        <tr nobr="true">
            <td style="width: 300px; height: 20px; font-size:60%; text-align:center;">'.$vigencia_cdp.'<br><strong>VIGENCIA DEL CDP:</strong></td>
            <td style="width: 350px; height: 80px; font-size:60%; text-align:rigth;">'.$vigencia_fecha.'<br>31/12/2023</td>
        </tr>
        <tr nobr="true">
            <td style="width: 200px; height:20px; font-size:60%; text-align:left;">'.$firma_ordenador.'<br>Firma Ordenador del Gasto</td>
        </tr>
        <tr nobr="true">
            <td style="width: 200px; height:20px; font-size:60%; text-align:left;">'.$proyecto.'<br>Proyectó</td>
        </tr>


    </table>
    <p style="font-size: 30px;"> &nbsp;</p>
';










    ///////////////////////////////////////////////////////------------------------------------------------------------
$tagvs = array('p' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n' => 0)));
$pdf->setHtmlVSpace($tagvs);

$pdf->setCellMargins(0, 0, 0, 0);
$pdf->setCellPaddings(0, 0, 0, 0);

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 10);


$y = $pdf->getY();


// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(0, 0, 0);

// write the first column
$pdf->writeHTMLCell(90, '', '', $y, $left_column, 0, 0, 0, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(0, 0, 0);

// write the second column
$pdf->writeHTMLCell(80, '', '', '', $right_column, 0, 0, 0, true, 'J', true);





// reset pointer to the last page
$pdf->lastPage();
/* ...
Resto del código que genera el PDF
*/
/* Limpiamos la salida del búfer y lo desactivamos */
ob_end_clean();
/* Finalmente generamos el PDF */
//Close and output PDF document
$pdf->Output($nombreDocumento.'.pdf', 'I');

//-------------------------------------------------------------------------

?>
