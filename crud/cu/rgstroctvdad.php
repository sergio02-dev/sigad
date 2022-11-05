<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

    include('prcsos/ctvdad/rgstroCtvdad.php');
    
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
    
    if($selAvance==0){
        $selAvance==1;
    }
    else{
        $selAvance=$_REQUEST['selAvance'];
    }

    if($textNombreAcuerdo==""){
        $textNombreAcuerdo="NA";
    }
    else {
        $textNombreAcuerdo=$_REQUEST['textNombreAcuerdo'];
    }

    if($textNombreTitulo==""){
        $textNombreTitulo="NA";
    }
    else {
        $textNombreTitulo=$_REQUEST['textNombreTitulo'];
    }
    
    if($selActoadmin==0){
        $selActoadmin=99;
    }
    else {
         $selActoadmin=$_REQUEST['selActoadmin'];
    }
    
   


    
    $registroActividad = new RgstroCtvdad();
    
    $registroActividad->setCodigoActividad($codigoActividad);
    $registroActividad->setTipoActividad($selTipoActividad);
    $registroActividad->setTipoValorAvance($selAvance);
    $registroActividad->setNumeroVeces($textNumeroVeces);
    $registroActividad->setAvanceLogrado($textCantidad);
    $registroActividad->setPersonaSistema($personaSistema);
    $registroActividad->setActoAdministrativo($selActoadmin);
    $registroActividad->setNombreAcuerdo($textNombreAcuerdo);
    $registroActividad->setNombreTitulo($textNombreTitulo);
    $registroActividad->setTrimestre($trimestre);

    echo $registroActividad->insertRegistroActividad();


?>