<?php
   include('crud/rs/rslcnes.php'); 
    
   $rs_resolucion = $objResolucion->dataListResoluciones();

   header("Content-type: application/json");
        
   echo $rs_resolucion;

?>