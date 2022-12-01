<?php
    include('prcsos/actlzar_pdi/rgstroActlzarPDI.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre= $_REQUEST['txtNombre'];
    $selYearInicio = $_REQUEST['selYearInicio'];
    $selYearFin = $_REQUEST['selYearFin'];
    $selActoAdmin = $_REQUEST['selActoAdmin'];
    $selOficina = $_REQUEST['selOficina'];
    $selResponsable = $_REQUEST['selResponsable'];
    $codigo_plandesarrollo = $_REQUEST['codigo_plandesarrollo'];

    $registroactializacionpdi = new RgstroActlzcionPDI();

    $registroactializacionpdi->setNombre($txtNombre);
    $registroactializacionpdi->setYearInicio($selYearInicio);
    $registroactializacionpdi->setYearFin($selYearFin);
    $registroactializacionpdi->setActoAdmin($selActoAdmin);
    $registroactializacionpdi->setOficina($selOficina);
    $registroactializacionpdi->setResponsable($selResponsable);
    $registroactializacionpdi->setCodigoPlan($codigo_plandesarrollo);
    $registroactializacionpdi->setPersonaSistema($personaSistema);

    $registroactializacionpdi->actualizar_plan();

?>