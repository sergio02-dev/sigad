<?php
    include('prcsos/rprteactvdad/mdfcar_rporte_actvdad_etpa.php');


    $personaSistema = $_SESSION['idusuario'];
    $codigo_certificado = $_REQUEST['codigo_certificado'];
    $codigo_actividad = $_REQUEST['codigo_actividad'];
    $codigo_etapa = $_REQUEST['codigo_etapa'];
    $tipo_actividad = $_REQUEST['selTipoActividad'];
    $numero_veces = $_REQUEST['textNumeroVeces'];
    $cantidad = $_REQUEST['textCantidad'];
    $codigo_actividad_realizada = $_REQUEST['codigo_actividad_realizada'];
    
    if($cantidad){
        $logro = $cantidad;
    }
    else{
        $logro = 0;
    }

    $modificarreporteactividadetapa = new UpdteActvdadEtpa();

    $modificarreporteactividadetapa->setCodigo($codigo_actividad_realizada);
    $modificarreporteactividadetapa->setCodigoCertificado($codigo_certificado);
    $modificarreporteactividadetapa->setCodigoActividad($codigo_actividad);
    $modificarreporteactividadetapa->setCodigoEtapa($codigo_etapa);
    $modificarreporteactividadetapa->setTipoActividad($tipo_actividad);
    $modificarreporteactividadetapa->setNumeroVeces($numero_veces);
    $modificarreporteactividadetapa->setLogro($logro);
    $modificarreporteactividadetapa->setPersonaSistema($personaSistema);

    echo $modificarreporteactividadetapa->updateReporteActividadEtapa();
    

?>