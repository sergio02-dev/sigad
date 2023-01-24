<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('prcsos/fuentepresupuesto/rgstrofuentepresupuesto.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $txtCodigoLinix = $_REQUEST['txtCodigoLinix'];
    $chkestado = $_REQUEST['chkestado'];

    $registrofuentepresupuesto = new RgstroFuentePresupuesto();

    $registrofuentepresupuesto->setPersonaSistema($personaSistema);
    $registrofuentepresupuesto->setNombre($txtNombre);
    $registrofuentepresupuesto->setEstado($chkestado);
    $registrofuentepresupuesto->setCodigoLinix($txtCodigoLinix);

    $registrofuentepresupuesto->insertFuentePresupuesto();
?>