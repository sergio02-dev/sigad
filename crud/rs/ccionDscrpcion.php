<?php 
include('prcsos/ctvdad/cccionCtvdadDscrpcion.php');

$rsCcnCtvdad= new CcionCtvdadDscrpcion();


$descccion=$rsCcnCtvdad->selectCcion($codigo_accion);

$desctvdad=$rsCcnCtvdad->selectActividad($codigo_actividad);
?>