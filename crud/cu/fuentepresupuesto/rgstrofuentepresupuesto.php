<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('prcsos/fuentepresupuesto/rgstrofuentepresupuesto.php');
    $checkFacultad = $_REQUEST['checkFacultad'];
    
    if($checkFacultad==''){
        $checkFacultad=0;   
    }else{
        $checkFacultad = $_REQUEST['checkFacultad']; 
    }
    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $txtCodigoLinix = $_REQUEST['txtCodigoLinix'];
    $chkestado = $_REQUEST['chkestado'];
   

    $registrofuentepresupuesto = new RgstroFuentePresupuesto();

    $registrofuentepresupuesto->setPersonaSistema($personaSistema);
    $registrofuentepresupuesto->setNombre($txtNombre);
    $registrofuentepresupuesto->setEstado($chkestado);
    $registrofuentepresupuesto->setCodigoLinix($txtCodigoLinix);
    $registrofuentepresupuesto->setFacultad($checkFacultad);

    $registrofuentepresupuesto->insertFuentePresupuesto();
?>