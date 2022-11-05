<?php 
$cant_accion=$objRsrprteSbstmaExcel->sqlRsAccioProyecto($pro_codigo);
    $row_proyecto=0;
    foreach($cant_accion as $data_cantAccion){
       $acco_codigo=$data_cantAccion['acc_codigo'];
       
       $cant_actAccion=$objRsrprteSbstmaExcel->cantidadActividadesAccion($pro_codigo, $acco_codigo, $trimestreee);

       if($cant_actAccion==0){
           $cantidadacti=1;
       }
       else{
           $cantidadacti=$cant_actAccion;
       }
       $row_proyecto=$row_proyecto+$cantidadacti;
    }

?>