<?php
/**
 * Karen Yuliana Palacio Minú
 * Crud Encargado 
 * 21 de Enero 2020 07:19am
 */
include('prcsos/ncrgdoccion/rgstroCcionNcrgdo.php');


$personaSistema = $_SESSION['idusuario'];
$codigo_accion=$_REQUEST['accion'];
$personaencargado=$_REQUEST['per_codigo'];
$cantidadInsert=COUNT($codigo_accion);

//echo "----> ".$cantidadInsert;
print_r($personaencargado);

$crudaccionencargado= new RgstroAccionEncrgdo();

$crudaccionencargado->setPersonaSistema($personaSistema);
$crudaccionencargado->setCantidadInsert($cantidadInsert);
$crudaccionencargado->setCodigoAccion($codigo_accion);
$crudaccionencargado->setCodigoPersona($personaencargado);

echo $crudaccionencargado->insertEncargado();
?>