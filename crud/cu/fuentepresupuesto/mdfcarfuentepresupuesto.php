<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('prcsos/fuentepresupuesto/mdfcarfuentepresupuesto.php');

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
    $codigo_fuentepresupuesto = $_REQUEST['codigo_fuentepresupuesto'];
    


    $modificarfuentepresupuesto = new MdfcarFuentePresupuesto();

    $modificarfuentepresupuesto ->setPersonaSistema($personaSistema);
    $modificarfuentepresupuesto ->setNombre($txtNombre);
    $modificarfuentepresupuesto ->setEstado($chkestado);
    $modificarfuentepresupuesto ->setCodigoLinix($txtCodigoLinix);
    $modificarfuentepresupuesto->setCodigo($codigo_fuentepresupuesto);
    $modificarfuentepresupuesto->setFacultad($checkFacultad);

    $modificarfuentepresupuesto ->updateFuentePresupuesto();
?>