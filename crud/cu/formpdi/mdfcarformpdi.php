<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('prcsos/formpdi/mdfcarFormpdi.php');
    $codigoPlanCompras = $_REQUEST['codigoPlanComprasPdi'];
    $personaSistema = $_SESSION['idusuario'];
    $selSede = $_REQUEST['selSede'];
    $selTipoVicerrectoria = $_REQUEST['selTipoVicerrectoria'];
    $selTipoFacultad = $_REQUEST['selTipoFacultad'];
    $selDependencia= $_REQUEST['selDependencia'];
    $selArea= $_REQUEST['selArea'];
    $selAccion = $_REQUEST['selAccion'];
    $chkestado = $_REQUEST['chkestado'];
    
    $plantaFisica= $_REQUEST['plantaFisica'];

    if($plantaFisica == 1){
        $inputPlantaFisica = $_REQUEST['inputPlantaFisica'];
        $selLineaEquipo= 0;
        $selSublineaEquipo= 0;
        $selEquipo = 0;
        $selCaracteristicas = 0;
        $selCantidad = 0;
        $valor_unitario = 0;
    }
    else{
        $inputPlantaFisica = "";
        $selLineaEquipo= $_REQUEST['selLineaEquipo'];
        $selSublineaEquipo= $_REQUEST['selSublineaEquipo'];
        $selEquipo = $_REQUEST['selEquipo'];
        $selCaracteristicas = $_REQUEST['selCaracteristicas'];
        $selCantidad = $_REQUEST['selCantidad'];
        $valor_unitario = $_REQUEST['selValorUnitario'];
    }
    


    $mdfcarplancompraspdi = new MdfcarFormpdi();

    $mdfcarplancompraspdi->setCodigo($codigoPlanCompras);
    $mdfcarplancompraspdi->setPersonaSistema($personaSistema);
    $mdfcarplancompraspdi->setSede($selSede);
    $mdfcarplancompraspdi->setVicerrectoria($selTipoVicerrectoria);
    $mdfcarplancompraspdi->setFacultad($selTipoFacultad);
    $mdfcarplancompraspdi->setDependencia($selDependencia);
    $mdfcarplancompraspdi->setArea($selArea);
    $mdfcarplancompraspdi->setAccion($selAccion);
    $mdfcarplancompraspdi->setPlantafisica($inputPlantaFisica);
    $mdfcarplancompraspdi->setLineaequipo($selLineaEquipo);
    $mdfcarplancompraspdi->setSublineaequipo($selSublineaEquipo);
    $mdfcarplancompraspdi->setEquipo($selEquipo);
    $mdfcarplancompraspdi->setCaracteristicas($selCaracteristicas);
    $mdfcarplancompraspdi->setCantidad($selCantidad);
    $mdfcarplancompraspdi->setValorunitario($valor_unitario);
    $mdfcarplancompraspdi->setEstado($chkestado);


    echo $mdfcarplancompraspdi->updateformpdi()
?>