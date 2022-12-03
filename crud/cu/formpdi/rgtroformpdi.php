<?php
    include('prcsos/formpdi/rgstroFormpdi.php');

    $personaSistema = $_SESSION['idusuario'];
    $selSede = $_REQUEST['selSede'];
    $selTipoVicerrectoria = $_REQUEST['selTipoVicerrectoria'];
    $selTipoFacultad = $_SESSION['selTipoFacultad'];
    $selDependencia= $_REQUEST['selDependencia'];
    $selTipoArea= $_REQUEST['selTipoArea'];
    $selCodigoPDI= $_SESSION['selCodigoPDI'];
    $selTipoAccion = $_REQUEST['selTipoAccion'];
    $inputPlantaFisica = $_REQUEST['inputPlantaFisica'];
    $selLineaEquipo= $_REQUEST['selLineaEquipo'];
    $selSublineaEquipo= $_SESSION['selSublineaEquipo'];
    $selEquipo = $_REQUEST['selEquipo'];
    $selCaracteristicas = $_REQUEST['selCaracteristicas'];
    $selCantidad = $_REQUEST['selCantidad'];


    $registroplancompraspdi = new RgstroFormpdi();

    $registroplancompraspdi->setPersonaSistema($personaSistema);
    $registroplancompraspdi->setSede($selSede);
    $registroplancompraspdi->setVicerrectoria($selTipoVicerrectoria);
    $registroplancompraspdi->setFacultad($selTipoFacultad);
    $registroplancompraspdi->setDependencia($selDependencia);
    $registroplancompraspdi->setArea($selTipoArea);
    $registroplancompraspdi->setCodigopdi($selCodigoPDI);
    $registroplancompraspdi->setAccion($selTipoAccion);
    $registroplancompraspdi->setPlantafisica($inputPlantaFisica);
    $registroplancompraspdi->setLineaequipo($selLineaEquipo);
    $registroplancompraspdi->setSublineaequipo($selSublineaEquipo);
    $registroplancompraspdi->setEquipo($selEquipo);
    $registroplancompraspdi->setCaracteristicas($selCaracteristicas);
    $registroplancompraspdi->setCantidad($selCantidad);


    echo $registroplancompras->insertPlanCompras();
?>