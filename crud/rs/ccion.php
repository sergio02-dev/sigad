<?php

    include('prcsos/prdcto/ccion.php');

    $objRsccion = new Ccion();

    //$codigo_subsistema=2;
    $objRsccion->selectAccion($codigo_subsistema); 
    $objRsccion->setCodigoSubsistema($codigo_subsistema);
    $rs_accion=$objRsccion->dataAccion();


?>