<?php
    function caracteres($palabra){
        $no_admitidas = array(".",",");
        $admitidas = array("");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    include('prcsos/rp/mdfcarRp.php');

    $personaSistema = $_SESSION['idusuario'];

    $txtFecha = $_REQUEST['txtFecha'];
    $txtCodigoRp = caracteres($_REQUEST['txtCodigoRp']);
    $checkOtrval = $_REQUEST['checkOtrval'];
    $valor =  str_replace('.','',$_REQUEST['valor']);
    $codigo_cdp = $_REQUEST['codigo_cdp'];
    $codigo_rp = $_REQUEST['codigo_rp'];
    $txtProveedor = str_replace("'","&apos;",$_REQUEST['txtProveedor']);
    $txtActoAdm = str_replace("'","&apos;",$_REQUEST['txtActoAdm']);
    $txtServicio = str_replace("'","&apos;",$_REQUEST['txtServicio']);

    if($checkOtrval){
        $otro_valor = 1;
    }
    else{
        $otro_valor = 0;
    }

    $modificarRP = new MdfcarRp();

    $modificarRP->setFecha($txtFecha);
    $modificarRP->setNumero($txtCodigoRp);
    $modificarRP->setOtroValor($otro_valor);
    $modificarRP->setValorRP($valor);
    $modificarRP->setCodigoCdp($codigo_cdp);
    $modificarRP->setPersonaSistema($personaSistema);
    $modificarRP->setCodigo($codigo_rp);
    $modificarRP->setProveedor($txtProveedor);
    $modificarRP->setActoAdministrativo($txtActoAdm);
    $modificarRP->setServicio($txtServicio);

    echo $modificarRP->modificar_rp();
?>