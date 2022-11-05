<?php

// ----------------------------------------------------------------------------------------------
// DATOS SERVIDOR
// ----------------------------------------------------------------------------------------------
/*$Server = $_SERVER['SERVER_NAME'] ;
$Ruta = $_SERVER['PHP_SELF'] ;
$Carpeta = dirname($_SERVER['SCRIPT_NAME']);
/*
echo 'SERVER: '.$Server.'<br>';
echo 'Ruta: '.$Ruta.'<br>';
echo 'Carpeta: '.$Carpeta.'<br><br><br>';
*/

// ----------------------------------------------------------------------------------------------
// TOMA URL
// ----------------------------------------------------------------------------------------------
//$url = $_SERVER['PATH_INFO'];

$url = $_SERVER["REQUEST_URI"]; // toma carpeta

if($online == true){
	$url = $Server.$url;
}

$url_pagina=$url;

//print_r(parse_url($url_pagina));
//$url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
//echo $url_actual;

//echo $url."<br>";
//$url = $_SERVER["PHP_SELF"];
// If for some reason $_SERVER["PATH_INFO"] does not work then
// you could use $_SERVER["REQUEST_URI"] or $_SERVER["PHP_SELF"]
// Remove the /index.php/ at the beginning REMOVER LA EXTENSION

$url = preg_replace('/^(\/)/','',$url);



// ----------------------------------------------------------------------------------------------
// EXPLOTA EL ARRAY URL
// ----------------------------------------------------------------------------------------------
$url = explode('/',$url);
//print_r($url); // Display array

//TOTAL DE VARIABLES EN EL ARRAY URL
$totalVariables = count($url);

//echo 'total: '.$totalVariables.'<br><br>';



// ----------------------------------------------------------------------------------------------
// REGLA PARA EL DESGLOCE
// ----------------------------------------------------------------------------------------------
//echo '<hr />';
$codigo_nota=0;
//NIVEL 1 - PAGINA INICIAL O  DE CONTENIDO

if ($totalVariables == 2){

    //echo $url[1];
	//PAGINA INICIAL
	if (empty($url[1])) {
		//echo 'va al inicio';
		//echo $url[1];
		$contenido = 1;

		$seccion_pagurl='nada';
		//echo $seccion_pagurl;
	}

	else {
		//SI ES BUSQUEDA
		//if (strpos($url[1], "buscar=") !== false) echo "Lo contiene";
		//$esBusqueda = substr($url[1] , 0, 7);

		//PAGINA DE CONTENIDO

		//	$seccion = $url[1];
		//	$contenido = 2;

			//paginado
			$seccion_url = $url[1];
			$seccion_pagurl=$seccion_url;
			$valores_url = explode('?',$seccion_url);


			//Una Variables
			$seccion_url = $valores_url[0]; //nombre de seccion
			$codigo_elemento = $valores_url[1]; //variable

			//  n Variables
			//$codigos_url = explode('-',$codigo_elemento);
			$codigos_url = explode('-',$codigo_elemento);
			$codigo_elemento1 = $codigos_url[0]; //variable 1
			$codigo_elemento2 = $codigos_url[1]; //variable 2
			$codigo_elemento3 = $codigos_url[2]; //variable 2


			$contenido = 2;

			$seccion_pagurl=$seccion_url;

			$valores_url = explode('cdgint',$seccion_url);
			$seccion_pagurl = $valores_url[0]; //nombre de seccion
			$codigo_elemento = $valores_url[1]; //variable

			//$seccion_pagurl=str_replace("-", "", $seccion_pagurl);



	}
	
	//echo $url[1];

}
elseif ($totalVariables == 3){

				$contenido = 3;


	$seccion_url = $url[1];
	$titulo_url = $url[2];

	$seccion_pagurl=$seccion_url;
	$subseccionurl=$url[2];
			$valores_url = explode('cdgint',$titulo_url);


			//Una Variables
			$seccion = $valores_url[0]; //nombre de seccion
			$codigo_elemento = $valores_url[1]; //variable


			$valores_elemento = explode('?',$codigo_elemento);

			$codigo_notaelemento=$valores_elemento[0];

			//  n Variables
			//$codigos_url = explode('-',$codigo_elemento);
			//$codigo_elemento1 = $codigos_url[0]; //variable 1
			//$codigo_elemento2 = $codigos_url[1]; //variable 2
			//$codigo_elemento3 = $codigos_url[2]; //variable 2

}

/*
//NIVEL 2 - PAGINA DE SUBCONTENIDO
else if ($totalVariables == 4){
	//echo 'esta en nivel 2';
	//$seccion = $url[1];

	//NOTICIAS
	if($url[1] == 'noticias'){
		$seccion = $url[2]; //nombre de seccion

		//saca url y fecha de la noticia
		$seccion_url = $url[3];
		$valores_url = explode('_',$seccion_url);

		$fecha_noticia= $valores_url[0];
		$url_noticia  = $valores_url[1];

		$modulo = 1; //activar modulos para miga de pan
		$contenido = 2;
	}
	//GALERIAS
	else if($url[2] == 'galerias'){
		$seccion = $url[2]; //nombre de seccion

		//saca url y fecha de la noticia
		$galeria_url = $url[3];

		$modulo = 1; //activar modulos para miga de pan
		$contenido = 2;
	}
	else{
		$contenido = 3;
		$seccion = $url[1];
		$subseccion=$url[2];
		$urlcodigo = explode('_',$subseccion);

		//$fecha_noticia= $valores_url[0];
		$codigo_nota = $urlcodigo[1];

		//echo $codigo_nota;

	}
	//echo '$seccion: '.$seccion.' // $subseccion: '.$subseccion.'<br>';
}


//ERROR SI NO ESTA DENTRO DE LA  REGLA DE LOS NIVELES
else {
	$error = true;
	//echo 'FUERA DE TODO NIVEL';
}
*/


?>
