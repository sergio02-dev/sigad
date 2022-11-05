<?php

include('dtctr_movil.php');

if($deviceType=='phone'){
   $es_movil=FALSE; //Aquí se declara la variable falso o verdadero XD
   $usuario = $_SERVER['HTTP_USER_AGENT']; //Con esta leemos la info de su navegador
 
   $usuarios_moviles = "Android, AvantGo, Blackberry, Blazer, Cellphone, Danger, DoCoMo, EPOC, EudoraWeb, Handspring, HTC, Kyocera, LG, MMEF20, MMP, MOT-V, Mot, Motorola, NetFront, Newt, Nokia, Opera Mini, Palm, Palm, PalmOS, PlayStation Portable, ProxiNet, Proxinet, SHARP-TQ-GX10, Samsung, Small, Smartphone, SonyEricsson, SonyEricsson, Symbian, SymbianOS, TS21i-10, UP.Browser, UP.Link, WAP, webOS, Windows CE, hiptop, iPhone, iPod, portalmmm, Elaine/3.0, OPWV"; //En esta cadena podemos quitar o agregar navegadores de dispositivos moviles, te recomiendo que hagas un echo $_SERVER['HTTP_USER_AGENT']; en otra pagina de prueba y veas la info que arroja para que despues agregues el navegador que quieras detectar
 
   $navegador_usuario = explode(',',$usuarios_moviles);

   foreach($navegador_usuario AS $navegador){ //Este ciclo es el que se encarga de detectar el navegador y devolver un TRUE si encuentra la cadena
      if(eregi(trim($navegador),$usuario)){
         $es_movil=TRUE;
      }
   }
}

include('librrs/sglton.php');

include "ck_funciones.php";

$texto="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

// ----------------------------------------------------------------------------------------------
// DATOS SERVIDOR
// ----------------------------------------------------------------------------------------------
$Server = $_SERVER['SERVER_NAME'];
$Ruta = $_SERVER['PHP_SELF'] ;
$Carpeta = dirname($_SERVER['SCRIPT_NAME']);

//echo 'SERVER: '.$Server.'<br>';
//echo 'Ruta: '.$Ruta.'<br>';
//echo 'Carpeta: '.$Carpeta.'<br><br><br>';

$nombreCarpeta = explode('/',$Carpeta);
//echo $nombreCarpeta[0].' ||||| '.$nombreCarpeta[1];


//SI HAY CARPETA
if (empty($nombreCarpeta[1])){
	//echo 'esta en la raíz';
	$online = true;
	$enlace = 'http://'.$Server."/";
}
else{
	//echo 'esta en carpeta';
	$online = false;
	$enlace = 'http://'.$Server.$Carpeta."/";
}




// ----------------------------------------------------------------------------------------------
// ENLACES REGLA URL's
// ----------------------------------------------------------------------------------------------
//Enruta para dar descripcion amigable
include "url_mgbl/urlAmigable.php";

//Enruta para dar la regla de desgloce de la url
include "url_mgbl/urlRegla.php";

//echo $saca;


// ----------------------------------------------------------------------------------------------



$fecha_hoy=date('Y-m-d');


$description_pag="El Mundo desde Nuestra Regi&oacute;n | Inicio | Noticias Neiva Huila Colombia";
$nombre_pagina=" El Mundo desde Nuestra Regi&oacute;n | Noticias Neiva Huila Colombia";



if($contenido==1){
	$numero_pagina=1;
	$nombre_pagina="El Mundo desde Nuestra Regi&oacute;n | Noticias Neiva Huila Colombia";
	$description_pag="El Mundo desde Nuestra Regi&oacute;n | Noticias Politica Economia Deportes Judicial Comunidad Actualidad Panorama Neiva Huila Colombia";
	   if($es_movil==TRUE){
		  header('Location:http://m.opanoticias.com');
	   }
}
else if($contenido==2){

	$sql_pagina="SELECT sec_codigo,sec_nombre FROM seccion WHERE sec_urlamigable='".$seccion_url."' ";
	//$cnx_usuario
	$query_pagina=$cnxn_pag->ejecutar($sql_pagina);
	$numero_secpag=$cnxn_pag->numero_filas($query_pagina);
	
	
	//$datos=$cnxn_pag->obtener_filas($query_pagina);

	
	if($es_movil==TRUE){
      header('Location:http://m.opanoticias.com/'.$seccion_url.'');
   	}
   
	 
	if($numero_secpag < 1){
		$sql_pagina="SELECT esp_codigo, esp_nombre, esp_estado FROM especial WHERE esp_urlamigable='".$seccion_url."' ";
		$query_pagina=$cnxn_pag->ejecutar($sql_pagina);
		$numero_especialpag=$cnxn_pag->numero_filas($query_pagina);
		$dato_pagina=$cnxn_pag->obtener_filas($query_pagina);
		$numero_pagina=$dato_pagina['esp_codigo'];
		$nombre_pagina=$dato_pagina['esp_nombre']." | Noticias Neiva Huila Colombia";
		$description_pag=$dato_pagina['sec_nombre']."| Neiva Huila Colombia";
	}
	else{
		$dato_pagina=$cnxn_pag->obtener_filas($query_pagina);
		$numero_pagina=$dato_pagina['sec_codigo'];
		$nombre_pagina=$dato_pagina['sec_nombre']." | Noticias Neiva Huila Colombia";
		$description_pag=$dato_pagina['sec_nombre']."| Neiva Huila Colombia";
		$seccion_pagina=$dato_pagina['sec_nombre'];


		if($numero_pagina==34){
			$condicion_sccion=" AND noticia.sec_codigo in (18,34) ";
		}
		elseif($numero_pagina==35){
			$condicion_sccion=" AND noticia.sec_codigo in (29,35) ";
		}
		else{
			$condicion_sccion=" AND noticia.sec_codigo=".$numero_pagina." ";
		}
		
		
		if(!$numero_pagina){
			header('Location: http//www.opanoticias.com');
		}
		
	}
	
	 if($seccion_url=='san-pedro'){
		$nombre_pagina="Festival san pedro | Noticias Neiva Huila Colombia";
		$description_pag="Festival san pedro | Neiva Huila Colombia";
	 }
	 
	 if($seccion_url=='opinion'){
		$nombre_pagina="Opini&oacute;n | Noticias Neiva Huila Colombia";
		$description_pag="Opini&oacute;n | Neiva Huila Colombia";
	 }
	 
	
}
else if($contenido==3){
	 if($seccion_conteni=='san-pedro'){
		$nombre_pagina="Festival san pedro Imagenes | Noticias Neiva Huila Colombia";
		$description_pag="Festival san pedro Imagenes | Neiva Huila Colombia";
	 }
	 else{
	
		$sql_titulon="SELECT not_titulo
						   FROM noticia
						   WHERE noticia.not_codigo=".$codigo_noticia;
		$query_titulon=$cnxn_pag->ejecutar($sql_titulon);	
		$titulon=$cnxn_pag->obtener_filas($query_titulon);
		$titulon=$titulon['not_titulo'];
		$nombre_pagina= $titulon." | Noticias Neiva Huila Colombia";
		$description_pag=$titulon;
	}
	if($es_movil==TRUE){
      header('Location:http://m.opanoticias.com/'.$seccion_url.'/'.$contenido_url.'');
   }
}


?>