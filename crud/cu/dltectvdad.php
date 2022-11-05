<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

    include('prcsos/ctvdad/dlteCtvdad.php');
    
    $personaSistema = $_SESSION['idusuario'];
    
    $codigoActividadRealizada=$_REQUEST['codigoActividadRealizada'];

    
    $deleteActividad = new DlteCtvdad();
    $deleteActividad->setCodigoActividadRealizada($codigoActividadRealizada);
    $deleteActividad->setPersonaSistema($personaSistema);

    echo $deleteActividad->deleteRegistroActividad();


?>