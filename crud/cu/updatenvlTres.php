<?php

    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('prcsos/plndsrrllo/updateNvlTres.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $selNivelUno=$_REQUEST['selNivelUno'];
    $selNivelDos=$_REQUEST['selNivelDos'];
    $txtReferencia=$_REQUEST['txtReferencia'];
    $txtNombre=$_REQUEST['txtNombre'];
    $actoAdministrativo=$_REQUEST['actoAdministrativo'];
    $selResponsable=$_REQUEST['selResponsable'];
    $checkplandecompras = $_REQUEST['checkplandecompras'];
    $checkplantafisica = $_REQUEST['checkplantafisica'];
    /*
    $txtLineaBase=$_REQUEST['txtLineaBase'];
    $txtMetaResultado=$_REQUEST['txtMetaResultado'];
    $txtUnidadMedida=$_REQUEST['txtUnidadMedida'];  
    $selTendencia=$_REQUEST['selTendencia'];
    $selTipoComportamiento=$_REQUEST['selTipoComportamiento'];*/
    $codigoNivelTres=$_REQUEST['codigoNivelTres'];
    $numero=$_REQUEST['numero'];


    if($checkplandecompras){
        $plan_compras = $checkplandecompras;
    }
    else{
        $plan_compras = 0;
    }

    if($checkplantafisica){
        $planta_fisica = $checkplantafisica;
    }
    else{
        $planta_fisica = 0;
    }

    $updateNivelTres = new UpdateNvlTres();
    
    $updateNivelTres->setCodigo($codigoNivelTres);
    $updateNivelTres->setCodigoNivelDos($selNivelDos);
    $updateNivelTres->setReferencia(strtoupper(tildes($txtReferencia)));
    $updateNivelTres->setDescripcion(strtoupper(tildes($txtNombre)));
    $updateNivelTres->setActoAdmin($actoAdministrativo);
    $updateNivelTres->setPersonaSistema($personaSistema);
    $updateNivelTres->setResponsable($selResponsable);
    $updateNivelTres->setPlanCompras($plan_compras);
    $updateNivelTres->setPlantaFisica($planta_fisica);


    /*$updateNivelTres->setLineaBase($txtLineaBase);
    $updateNivelTres->setTendenciaPositiva($selTendencia);
    $updateNivelTres->setComportamiento($selTipoComportamiento);*/
    $updateNivelTres->setNumero($numero);

    echo $updateNivelTres->updateNivelTres();


?>