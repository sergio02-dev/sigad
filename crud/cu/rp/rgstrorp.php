<?php
    /*ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);*/
    function caracteres($palabra){
        $no_admitidas = array(".",",");
        $admitidas = array("");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    include('prcsos/rp/rgstroRp.php');

    $personaSistema = $_SESSION['idusuario'];

    $txtFecha = $_REQUEST['txtFecha'];
    $txtCodigoRp = caracteres($_REQUEST['txtCodigoRp']);
    $checkOtrval = $_REQUEST['checkOtrval'];
    $valor =  str_replace('.','',$_REQUEST['valor']);
    $codigo_cdp = $_REQUEST['codigo_cdp'];
    $txtProveedor = str_replace("'","&apos;",$_REQUEST['txtProveedor']);
    $txtActoAdm = str_replace("'","&apos;",$_REQUEST['txtActoAdm']);
    $txtServicio = str_replace("'","&apos;",$_REQUEST['txtServicio']);

    if($checkOtrval){
        $otro_valor = 1;
    }
    else{
        $otro_valor = 0;
    }

    $registroRP = new RgstroRp();

    $registroRP->setFecha($txtFecha);
    $registroRP->setNumero($txtCodigoRp);
    $registroRP->setOtroValor($otro_valor);
    $registroRP->setValorRP($valor);
    $registroRP->setCodigoCdp($codigo_cdp);
    $registroRP->setProveedor($txtProveedor);
    $registroRP->setActoAdministrativo($txtActoAdm);
    $registroRP->setServicio($txtServicio);
    $registroRP->setPersonaSistema($personaSistema);

    echo $registroRP->registro_rp();
?>