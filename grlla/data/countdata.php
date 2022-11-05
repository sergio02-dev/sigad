<?php
$cant_activity=0;
    foreach($rsAccionProyecto as $data_accion){
        $acc_codigo=$data_accion['acc_codigo'];
        $acc_referencia=$data_accion['acc_referencia'];
        
        $cantidad_actividadess=$objRsrprteSbstma->cantidadActividadesAccion($pro_codigo, $acc_codigo);
        //echo "----> ".$cantidad_actividadess;
        if($cantidad_actividadess==0){
            $canti_rowss=1;
        }
        else{
            $canti_rowss=$cantidad_actividadess;
        }
        $cant_activity=$cant_activity+$canti_rowss;

    }
echo "Cantidad Actividad ".$cant_activity;
?>