<?php

    include('prcsos/ctvdad/ctvdadCcion.php');

    $objRsctvdadCcion = new CcionCtvdad();

    $rsActividadesLista=$objRsctvdadCcion->data_lista_actividades($codigo_accion); 
 
?>