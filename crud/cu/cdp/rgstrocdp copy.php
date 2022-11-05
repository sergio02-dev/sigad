<?php
    function caracteres($palabra){
        $no_admitidas = array(".",",");
        $admitidas = array("");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    include('prcsos/cdp/rgstroCdp.php');

    $personaSistema = $_SESSION['idusuario'];

    $txtFechaExpedicion = $_REQUEST['txtFechaExpedicion'];
    $txtNumeroExpedicion = caracteres($_REQUEST['txtNumeroExpedicion']);
    $codigo_solicitud = $_REQUEST['codigo_solicitud'];

    $registroCdp = new RgstroCdp();

    $registroCdp->setFecha($txtFechaExpedicion);
    $registroCdp->setNumero($txtNumeroExpedicion);
    $registroCdp->setCodigoSolicitud($codigo_solicitud);
    $registroCdp->setPersonaSistema($personaSistema);

    $registroCdp->insert_cdp();
?>