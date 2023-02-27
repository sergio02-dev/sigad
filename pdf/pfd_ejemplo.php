<?php
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
        $image_escudocolombia = 'img/logo/logodocument.png';
        $this->setTextColor(0, 0, 0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.1);
        $this->setTextColor(0, 0, 0);
        
        $this->SetFillColor(255, 255, 127);
        
        $version='GABC-GA-04-01';

        $nombrecolegio='GIMNASIO AMERICANO ABC';

        $fchaa = date('Y-m-d');

        $year_numm = substr($fchaa,0,4);
        $mes_numm = substr($fchaa,5,2);
        $dia_numm = substr($fchaa,8,2);

        $fchh = "Fecha: ".$dia_numm."/".$mes_numm."/".$year_numm;
        
        $DTOS = 'DIAGNOSTICO';

        // version
        $this->SetFont('helvetica', ' ', 8);
        $this->MultiCell(40, 6, $version, 1, 'C', 0, 0, '', '', true, 0, false, true, 6, 'M');
        // nombre de la institución
        $this->SetFont('dejavusans', ' ', 18);
        $this->MultiCell(110, 20, $nombrecolegio , 1, 'C', 0, 0, '', '', true, 1, false, true, 320, 'T');
        // modalidad y resolución
        $this->SetFont('helvetica', ' ', 10);
        $this->MultiCell(110, 20, 'EDUCACIÓN PREESCOLAR Y BÁSICA PRIMARIA'."\n".'Licencia de Funcionamiento por resolución 2725 de 2002' , 1, 'C', 0, 0, 50, 5, true, 1, false, true, 18, 'B');
        
        // imagen de la institución
        $this->SetFont('helvetica', ' ', 8);
        $this->MultiCell(40, 30, ' ', 1, 'C', 0, 1, '', '', true);			
        $this->Image($image_escudocolombia, 167, 8, 25, 25, 'PNG', '', 'M', false, 120, '', false, false, 0, false, false, false);
        
        // informacion del formato
        $this->MultiCell(40, 14, 'Revisión: V.6', 1, 'C', 0, 0, '', 11, true, 0, false, true, 14, 'M');
        $this->SetFont('dejavusans', ' ', 12);
        $this->MultiCell(110, 10, $DTOS, 1, 'C', 0, 1, 50, 25, true, 0, false, true, 10, 'M');
        $this->SetFont('helvetica', ' ', 8);
        $this->MultiCell(40, 10, $fchh, 1, 'C', 0, 0, '', 25, true, 0, false, true, 10, 'M');			
			
    }

	// Page footer
	public function Footer() {
	    $style2 = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
	    //$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

        // Position at 15 mm from bottom

        // Set font
        $this->SetFont('helvetica', '', 8);
        // Page number
        //$this->Line(2, 288, 200, 288, $style2);
        
        //$this->Cell(0, 0, ' "Juntos es más fácil" ', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        //$this->Cell(0, 0, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'Letter', true, 'UTF-8', false);

///////////////////////////////////

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


$html.='
    <table nobr="true" style="padding-left: 5px;" cellpadding="2">
        <tr nobr="true">
            <th style="width: 673px; font-size:44px; left; text-align:justify;">Ejemplo</th>
        </tr>
    </table>
    <p style="font-size: 30px;"> &nbsp;</p>
';



$html.='
    <table nobr="true" style="padding-left: 5px;" cellpadding="2">
        <tr nobr="true">
            <th style="width: 336px; height: 50px; font-size:75%; left; text-align:left;"><div style="position: relative;"><div style="left: 0;margin: 0;position: absolute;right: 0;text-align: left;top: 50%;transform: translateY(-50%);"></div></div></th>
            <th style="width: 337px; height: 50px; font-size:75%; left; text-align:left;"><div style="position: relative;"><div style="left: 0;margin: 0;position: absolute;right: 0;text-align: center;top: 50%;transform: translateY(-50%);"></div></div></th>
        </tr>
        <tr nobr="true">
            <td style="width: 336px; height: 40px; font-size:70%; text-align:left;"><strong>'.$nombre_director.'<br>Director de grupo</strong></td>
            <td style="width: 337px; height: 40px; font-size:70%; text-align:center;"><strong></strong></td>
        </tr>

    </table>
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
