<?php
    include('prcsos/formpdi/rgstroFormpdi.php');

    $personaSistema = $_SESSION['idusuario'];
    $selSede = $_REQUEST['selSede'];
    $selTipoVicerrectoria = $_REQUEST['selTipoVicerrectoria'];
    $selTipoFacultad = $_REQUEST['selTipoFacultad'];
    $selDependencia= $_REQUEST['selDependencia'];
    $selArea= $_REQUEST['selArea'];
    $selAccion = $_REQUEST['selAccion'];
    $inputPlantaFisica = $_REQUEST['inputPlantaFisica'];
    $selLineaEquipo= $_REQUEST['selLineaEquipo'];
    $selSublineaEquipo= $_REQUEST['selSublineaEquipo'];
    $selEquipo = $_REQUEST['selEquipo'];
    $selCaracteristicas = $_REQUEST['selCaracteristicas'];
    $selCantidad = $_REQUEST['selCantidad'];
    $valor_unitario = $_REQUEST['valor_unitario'];



    $registroplancompraspdi = new RgstroFormpdi();

    $registroplancompraspdi->setPersonaSistema($personaSistema);
    $registroplancompraspdi->setSede($selSede);
    $registroplancompraspdi->setVicerrectoria($selTipoVicerrectoria);
    $registroplancompraspdi->setFacultad($selTipoFacultad);
    $registroplancompraspdi->setDependencia($selDependencia);
    $registroplancompraspdi->setArea($selArea);
    $registroplancompraspdi->setAccion($selAccion);
    $registroplancompraspdi->setPlantafisica($inputPlantaFisica);
    $registroplancompraspdi->setLineaequipo($selLineaEquipo);
    $registroplancompraspdi->setSublineaequipo($selSublineaEquipo);
    $registroplancompraspdi->setEquipo($selEquipo);
    $registroplancompraspdi->setCaracteristicas($selCaracteristicas);
    $registroplancompraspdi->setCantidad($selCantidad);
    $registroplancompraspdi->setValorunitario($valor_unitario);


    echo $registroplancompraspdi->insertFormpdi()
?>