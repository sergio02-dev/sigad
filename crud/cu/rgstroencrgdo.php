<?php
/**
 * Karen Yuliana Palacio Minú
 * Crud Encargado 
 * 21 de Enero 2020 07:19am
 */
include('prcsos/plnccion/rgstroencrgdo.php');


$personaSistema = $_SESSION['idusuario'];
$codigo_accion=$_REQUEST['codigo_accion'];
$personaencargado=$_REQUEST['personaencargado'];
$cantidadInsert=COUNT($personaencargado);

//echo "----> ".$cantidadInsert;
print_r($personaencargado);

$crudencargado= new RgstroEncrgdo();

$crudencargado->setPersonaSistema($personaSistema);
$crudencargado->setCantidadInsert($cantidadInsert);
$crudencargado->setCodigoAccion($codigo_accion);
$crudencargado->setCodigoPersona($personaencargado);

echo $crudencargado->insertEncargado();
?>