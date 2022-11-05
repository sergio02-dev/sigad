<?php
  include('prcsos/plnccion/plnccion.php');
  $objPlanAccion = new PlnCcion();

  $rs_RegistroActividad=$objPlanAccion->actividadPoai($accion_code);
    
     
?>
