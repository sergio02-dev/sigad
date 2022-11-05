<?php



$Server = $_SERVER['SERVER_NAME'];
$Ruta = $_SERVER['PHP_SELF'] ;
$Carpeta = dirname($_SERVER['SCRIPT_NAME']);



$nombreCarpeta = explode('/',$Carpeta);


if (empty($nombreCarpeta[1])){
	$online = true;
	$enlace = 'http://'.$Server."/";
}
else{
	$online = false;
	$enlace = 'http://'.$Server.$Carpeta."/";
}


?>

