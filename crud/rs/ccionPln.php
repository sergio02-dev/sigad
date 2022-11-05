<?php 
    include('prcsos/plnccion/plnccion.php');

    $objRsPlanAccion = new PlnCcion();

    $rsAccionPlan=$objRsPlanAccion->accionesPlanJson($codigo_plan);
?>