<?php

    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    include('prcsos/plndsrrllo/rgstroNvlTres.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $selNivelUno=$_REQUEST['selNivelUno'];
    $selNivelDos=$_REQUEST['selNivelDos'];
    $txtReferencia=$_REQUEST['txtReferencia'];
    $txtNombre=$_REQUEST['txtNombre'];
    $txtLineaBase=$_REQUEST['txtLineaBase'];
    $txtMetaResultado=$_REQUEST['txtMetaResultado'];
    $txtUnidadMedida=$_REQUEST['txtUnidadMedida'];  
    $actoAdministrativo=$_REQUEST['actoAdministrativo'];
    $selTendencia=$_REQUEST['selTendencia'];
    $selTipoComportamiento=$_REQUEST['selTipoComportamiento'];
    $selResponsable=$_REQUEST['selResponsable'];
    $checkplandecompras = $_REQUEST['checkplandecompras'];
    $checkplantafisica = $_REQUEST['checkplantafisica'];

    if($checkplandecompras){
        $plan_compras = $checkplandecompras;
        if($checkplantafisica){
            $planta_fisica = $checkplantafisica;
        }
        else{
            $planta_fisica = 0;
        }
    }
    else{
        $plan_compras = 0;
        $planta_fisica = 0;
    }

    

    $registroNivelTres = new RgstroNvlTres();
    
    $registroNivelTres->setCodigoNivelDos($selNivelDos);
    $registroNivelTres->setReferencia($txtReferencia);
    $registroNivelTres->setDescripcion(strtoupper(tildes($txtNombre)));
    $registroNivelTres->setLineaBase($txtLineaBase);
    $registroNivelTres->setMetaResultado($txtMetaResultado);
    $registroNivelTres->setIndicador($txtUnidadMedida);
    $registroNivelTres->setActoAdmin($actoAdministrativo);
    $registroNivelTres->setPersonaSistema($personaSistema);
    $registroNivelTres->setTendenciaPositiva($selTendencia);
    $registroNivelTres->setComportamiento($selTipoComportamiento);
    $registroNivelTres->setResponsable($selResponsable);
    $registroNivelTres->setPlanCompras($plan_compras);
    $registroNivelTres->setPlantaFisica($planta_fisica);

    echo $registroNivelTres->insertNivelTres();


?>