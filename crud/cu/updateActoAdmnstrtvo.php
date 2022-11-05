<?php

    include('prcsos/plndsrrllo/updateActoAdmnstrtvo.php');
    
    $personaSistema = $_SESSION['idusuario'];
    $codigo_Acto = $_REQUEST['codigoActo'];
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
      
    $updateActoAdministrativo = new UpdateActoAdmnstrtvo();
    
    $updateActoAdministrativo->setCodigoActoAdministrativo($codigo_Acto);
    $updateActoAdministrativo->setNombreActoAdministrativo($txtNombre);
    $updateActoAdministrativo->setTipoActoAdministrativo($selTipoActo);
    $updateActoAdministrativo->setVigenciaActoAdministrativo($txtVigencia);
    $updateActoAdministrativo->setPersonaActoAdministrativo($personaSistema);
    $updateActoAdministrativo->setUrlActoAdministrativo($txtUrl);
    $updateActoAdministrativo->setDescripcionActoAdministrativo($txtDescripcion);
    $updateActoAdministrativo->setAcuerdoPapa($acuerdo_seleccionado);

    echo $updateActoAdministrativo->updateActoAdministrativo();


?>