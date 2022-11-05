<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

    include('prcsos/ctvdad/rgstroCtvdadHjo.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $codigoActividad=$_REQUEST['codigoActividad'];
    $selTipoActividad=$_REQUEST['selTipoActividadHijo'];
    $textNumeroVeces=$_REQUEST['textNumeroVeces'];
    $selAvance=$_REQUEST['selAvanceHijo'];
    $textCantidad=$_REQUEST['textCantidad'];
    $selActoadmin=$_REQUEST['selActoadmin'];
    $textNombreAcuerdo=$_REQUEST['textNombreAcuerdo'];
    $textNombreTitulo=$_REQUEST['textNombreTitulo'];
    $codigoActividadRealizada=$_REQUEST['codigoActividadRealizada'];
    $trimestre=$_REQUEST['trimestre'];
    //echo ".-.----".$selAvance." <br>";
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
  
    
 
    
   


    
    $registroActividadHijo = new RgstroCtvdadHjo();
    $registroActividadHijo->setCodigoActividadRealizada($codigoActividadRealizada);
    $registroActividadHijo->setCodigoActividad($codigoActividad);
    $registroActividadHijo->setTipoActividad($selTipoActividad);
    $registroActividadHijo->setTipoValorAvance($selAvance);
    $registroActividadHijo->setNumeroVeces($textNumeroVeces);
    $registroActividadHijo->setAvanceLogrado($textCantidad);
    $registroActividadHijo->setPersonaSistema($personaSistema);
    $registroActividadHijo->setActoAdministrativo($selActoadmin);
    $registroActividadHijo->setNombreAcuerdo($textNombreAcuerdo);
    $registroActividadHijo->setNombreTitulo($textNombreTitulo);
    $registroActividadHijo->setTrimestre($trimestre);

    echo $registroActividadHijo->insertRegistroActividadHijo();


?>