<?php

    include('prcsos/plndsrrllo/rgstroActoAdmnstrtvo.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $txtNombre = $_REQUEST['txtNombre'];
    $selTipoActo = $_REQUEST['chktipoacto'];
    $txtVigencia = $_REQUEST['txtVigencia'];
    $txtUrl = $_REQUEST['txtUrl'];
    $selAcuerdo = $_REQUEST['selAcuerdo'];
    $txtDescripcion = $_REQUEST['txtDescripcion'];

    if($selTipoActo == 1){
        $acuerdo_seleccionado = 0;
    }
    else{
        $acuerdo_seleccionado = $selAcuerdo;
    }
    
    $registroActoAdministrativo = new RgstroActoAdmnstrtvo();
    
    $registroActoAdministrativo->setNombreActoAdministrativo($txtNombre);
    $registroActoAdministrativo->setTipoActoAdministrativo($selTipoActo);
    $registroActoAdministrativo->setVigenciaActoAdministrativo($txtVigencia);
    $registroActoAdministrativo->setPersonaActoAdministrativo($personaSistema);
    $registroActoAdministrativo->setUrlActoAdministrativo($txtUrl);
    $registroActoAdministrativo->setDescripcionActoAdministrativo($txtDescripcion);
    $registroActoAdministrativo->setAcuerdoPapa($acuerdo_seleccionado);

    echo $registroActoAdministrativo->insertActoAdministrativo();


?>