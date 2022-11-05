<?php 
    include('prcsos/ccion/ccion.php');
    
    $objRsccionPrycto = new CcionProyecto();

    $objRsccionPrycto->setProyectoAccion($codigo_proyecto);
    $rsAccionProyecto=$objRsccionPrycto->dataAccionProyecto();
?>