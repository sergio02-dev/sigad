<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

    include('prcsos/ctvdad/updteCtvdad.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $codigoActividad=$_REQUEST['codigoActividad'];
    $selTipoActividad=$_REQUEST['selTipoActividad'];
    $textNumeroVeces=$_REQUEST['textNumeroVeces'];
    $selAvance=$_REQUEST['selAvance'];
    $textCantidad=$_REQUEST['textCantidad'];
    $selActoadmin=$_REQUEST['selActoadmin'];
    $textNombreAcuerdo=$_REQUEST['textNombreAcuerdo'];
    $textNombreTitulo=$_REQUEST['textNombreTitulo'];
    $codigoActividadRealizada=$_REQUEST['codigoActividadRealizada'];
    $trimestre=$_REQUEST['trimestre'];
    //echo ".-.----".$trimestre;
    if($selAvance==0){
        $selAvance==1;
    }
    else{
        $selAvance=$_REQUEST['selAvance'];
    }
    if($selAvance==1){
        $selActoadmin=99;
        $textNombreAcuerdo="NA";
        $textNombreTitulo="NA";
    }
    else{
        $textNombreAcuerdo=$_REQUEST['textNombreAcuerdo'];
        $textNombreTitulo=$_REQUEST['textNombreTitulo'];
        $selActoadmin=$_REQUEST['selActoadmin'];
    }
  
    
 
    
   


    
    $updateActividad = new UdteCtvdad();
    $updateActividad->setCodigoActividadRealizada($codigoActividadRealizada);
    $updateActividad->setCodigoActividad($codigoActividad);
    $updateActividad->setTipoActividad($selTipoActividad);
    $updateActividad->setTipoValorAvance($selAvance);
    $updateActividad->setNumeroVeces($textNumeroVeces);
    $updateActividad->setAvanceLogrado($textCantidad);
    $updateActividad->setPersonaSistema($personaSistema);
    $updateActividad->setActoAdministrativo($selActoadmin);
    $updateActividad->setNombreAcuerdo($textNombreAcuerdo);
    $updateActividad->setNombreTitulo($textNombreTitulo);
    $updateActividad->setTrimestre($trimestre);

    echo $updateActividad->updateRegistroActividad();


?>