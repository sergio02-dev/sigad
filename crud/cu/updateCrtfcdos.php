<?php

    include('prcsos/crtfcdos/updatecrtfcdos.php');

    $personaSistema = $_SESSION['idusuario'];

    $planDesarrollo = $_REQUEST['selPlanDesarrollo'];
    $codigoActividad=$_REQUEST['codigoActividad'];
    $codigoSubsistema=$_REQUEST['selSubsistema'];
    $codigoProyecto=$_REQUEST['selProyecto'];
    $codigoAccion=$_REQUEST['selAccion'];
       
    $fechaExpedicion=$_REQUEST['fechaExpedicion'];
    $dependencia=$_REQUEST['dependenciaActibvidad'];
    $estado=$_REQUEST['chkestado'];

    $act_certificadomod=$_REQUEST['act_certificadomod'];
    $estadoActividad=$_REQUEST['estadoActividad'];

    $certificado=$_REQUEST['textCertificado'];
    $certificadoSelect=$_REQUEST['selectCertificado'];
    $selResolucion = $_REQUEST['selResolucion'];

    $etpass = $_REQUEST['etpass'];
   
    if($planDesarrollo == 1){
        $Actividad=$_REQUEST['selActividad'];
        $certificado_reduccion=explode("-",$act_certificadomod);
        $act_certificadopadre=$certificado_reduccion[0];
        $act_certificadomod=$certificado_reduccion[1];
        $valor = $_REQUEST['textValor'];
        $vigencia = $_REQUEST['vigenciaActividad'];
        $trimestre = $_REQUEST['trimestreActividad'];
        $referencia = $_REQUEST['act_referencia'];
    
        if($estadoActividad==2 || $estadoActividad==3){
            $actcertificadomod=$act_certificadomod;
            $actcertificadopadre=$act_certificadopadre;
        }
        else{
            $actcertificadomod=0;
            $actcertificadopadre=0;
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

        $actcertificadomod = 0;
        $actcertificadopadre = 0;
    }

    

    //echo "Codigo Actividad: ".$act_certificadopadre." Certificado: ".$act_certificadomod;

    $objRscrtfcdo = new Crtfcdos();
    


    $objRscrtfcdo->setcodigoActividad($codigoActividad);
    $objRscrtfcdo->setcodigoSubsistema($codigoSubsistema);
    $objRscrtfcdo->setcodigoProyecto($codigoProyecto);
    $objRscrtfcdo->setcodigoAccion($codigoAccion);
    $objRscrtfcdo->setActividad($Actividad);
    $objRscrtfcdo->setcertificado($certificado);
    $objRscrtfcdo->settrimestre($trimestre);
    $objRscrtfcdo->setvigencia($vigencia);
    $objRscrtfcdo->setvalor($valor);
    $objRscrtfcdo->setfechaExpedicion($fechaExpedicion);
    $objRscrtfcdo->setdependencia($dependencia);
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
        echo $objRscrtfcdo->updateCertificados();
    }
    else{
        echo $objRscrtfcdo->updateCertificadosPlanNuevo();
    }
    


?>
