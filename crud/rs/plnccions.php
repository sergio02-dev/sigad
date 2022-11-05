<?php

    include('prcsos/plnccion/plnccion.php');
    $objPlanAccion = new PlnCcion();
    $codigo_planaccion=$iduno;
    $plan_accion=$objPlanAccion->acciones($codigo_planaccion);
    
   


  // print_r($plan_accion);

?>
