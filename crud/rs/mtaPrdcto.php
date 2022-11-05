<?php

    include('prcsos/ccion/rsMtaPrdcto.php');

    $objRsMtaPrdcto = new RsMetaProducto();


    
    $objRsMtaPrdcto->setAccionMepro($codigo_accion);
    list($valorEsperado,$UnidadMedida)=$objRsMtaPrdcto->selectMetaProducto(); 
    $valorEjecutado=$objRsMtaPrdcto->selectAccionEjecucion(); 

    $datosAccion=$objRsMtaPrdcto->datosAccion($codigo_accion);

    


?>