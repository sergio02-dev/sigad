<?php
    include('prcsos/plnccion/plnccion.php');
    $objPlanAccion = new PlnCcion();



    $plan_desarrollo=$objPlanAccion->plan_desarrollo();
    if($codigo_planaccion){

        $accion=$objPlanAccion->plan_accion_consulta($codigo_planaccion);

    }


?>
