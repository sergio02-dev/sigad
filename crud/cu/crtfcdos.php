<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

    include('prcsos/crtfcdos/insrtcrtfcdos.php');

    $personaSistema = $_SESSION['idusuario'];

    $planDesarrollo = $_REQUEST['selPlanDesarrollo'];
    $codigoActividad = $_REQUEST['codigoActividad'];
    $codigoSubsistema = $_REQUEST['selSubsistema'];
    $codigoProyecto = $_REQUEST['selProyecto'];
    $codigoAccion = $_REQUEST['selAccion'];
        
    $fechaExpedicion = $_REQUEST['fechaExpedicion'];
    $dependencia = $_REQUEST['dependenciaActibvidad'];
    $estado = $_REQUEST['chkestado'];
    
    $act_certificadomod = $_REQUEST['act_certificadomod'];
    $estadoActividad = $_REQUEST['estadoActividad'];
    $certificadoTexto = $_REQUEST['textCertificado'];
    $certificadoSelect = $_REQUEST['selectCertificado'];
    $selResolucion = $_REQUEST['selResolucion'];

    $certificado = $certificadoTexto;

    //$selResolucion = $_REQUEST['selResolucion'];echo "Certidficadfo ".$certificadoTexto;

    $etpass = $_REQUEST['etpass'];

    $objRscrtfcdo = new Crtfcdos();

    if($planDesarrollo == 1){
        $Actividad = $_REQUEST['selActividad'];
        $certificado_reduccion = explode("-",$act_certificadomod);
        $act_certificadopadre = $certificado_reduccion[0];
        $act_certificadomod = $certificado_reduccion[1];
        $valor = $_REQUEST['textValor'];
        $vigencia = $_REQUEST['vigenciaActividad'];
        $trimestre = $_REQUEST['trimestreActividad'];
        $referencia = $_REQUEST['act_referencia'];
        $otrVal = 0;
    
        if($estadoActividad==2 || $estadoActividad==3){
            $actcertificadomod = $act_certificadomod;
            $actcertificadopadre = $act_certificadopadre;
        }
        else{
            $actcertificadomod = 0;
            $actcertificadopadre = 0;
        }
    }
    else{
        $Actividad="NA";
        $checkedOtroValor = $_REQUEST['checkedOtroValor'];
        $summaa = $_REQUEST['summaa'];
        $txtOtroValor = $_REQUEST['txtOtroValor'];
        $vigencia = substr($fechaExpedicion, 0, 4);
        $trimestre = 0;
        $referencia = "NA";
        
        if($checkedOtroValor == 1){
           $valor = $txtOtroValor;
           $otrVal = 1;
        }
        else{
            $valor = $summaa;
            $otrVal = 0;
        }

        if($estadoActividad == 1){
            $actcertificadomod = 0;
            $actcertificadopadre = 0;
        }
        if($estadoActividad == 2){
            $actcertificadomod = $_REQUEST['certificadoMod'];
            $actcertificadopadre = $_REQUEST['selCertificadoModificar'];
            $otrVal = 1;
            $valor = $_REQUEST['txtValorReducir'];
            $codigoAccion = $_REQUEST['selAccionList'];
            $codigoProyecto = $objRscrtfcdo->proyecto_accion($codigoAccion);
        }

        
    }


    

    $objRscrtfcdo->setCodigoActividad($codigoActividad);
    $objRscrtfcdo->setCodigoSubsistema($codigoSubsistema);
    $objRscrtfcdo->setCodigoProyecto($codigoProyecto);
    $objRscrtfcdo->setCodigoAccion($codigoAccion);
    $objRscrtfcdo->setActividad($Actividad);
    $objRscrtfcdo->setCertificado($certificado);
    $objRscrtfcdo->setTrimestre($trimestre);
    $objRscrtfcdo->setVigencia($vigencia);
    $objRscrtfcdo->setValor($valor);
    $objRscrtfcdo->setFechaExpedicion($fechaExpedicion);
    $objRscrtfcdo->setDependencia($dependencia);
    $objRscrtfcdo->setEstado($estado);
    $objRscrtfcdo->setReferencia($referencia);
    $objRscrtfcdo->setCertificadoMod($actcertificadomod);
    $objRscrtfcdo->setCertificadoPadre($actcertificadopadre);
    $objRscrtfcdo->setEstadoActividad($estadoActividad);
    $objRscrtfcdo->setPersonaSistema($personaSistema);
    $objRscrtfcdo->setEtapas($etpass);
    $objRscrtfcdo->setOtroValor($otrVal);
    $objRscrtfcdo->setResolucion($selResolucion);

    if($planDesarrollo == 1){
        echo $objRscrtfcdo->insertCertificados();
    }
    else{
        if($estadoActividad == 1){
            echo $objRscrtfcdo->insertCertificadosNuevoPlan();
        }

        if($estadoActividad == 2){
            echo $objRscrtfcdo->insertCertificadosNuevoPlanReducir();
        }
        
    }

    


?>
