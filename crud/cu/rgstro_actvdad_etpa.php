<?php
    include('prcsos/rprteactvdad/rgstro_rporte_actvdad_etpa.php');


    $personaSistema = $_SESSION['idusuario'];
    $codigo_certificado = $_REQUEST['codigo_certificado'];
    $codigo_actividad = $_REQUEST['codigo_actividad'];
    $codigo_etapa = $_REQUEST['codigo_etapa'];
    $tipo_actividad = $_REQUEST['selTipoActividad'];
    $numero_veces = $_REQUEST['textNumeroVeces'];
    $cantidad = $_REQUEST['textCantidad'];

    if($cantidad){
        $logro = $cantidad;
    }
    else{
        $logro = 0;
    }

    $registroreporteactividadetapa = new RgstroActvdadEtpa();

    $registroreporteactividadetapa->setCodigoCertificado($codigo_certificado);
    $registroreporteactividadetapa->setCodigoActividad($codigo_actividad);
    $registroreporteactividadetapa->setCodigoEtapa($codigo_etapa);
    $registroreporteactividadetapa->setTipoActividad($tipo_actividad);
    $registroreporteactividadetapa->setNumeroVeces($numero_veces);
    $registroreporteactividadetapa->setLogro($logro);
    $registroreporteactividadetapa->setPersonaSistema($personaSistema);

    echo $registroreporteactividadetapa->insertReporteActividadEtapa();
    

?>