<?php
    include('prcsos/resolucionpersona/rgstroresolucionpersona.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNumero = $_REQUEST['txtNumero'];
    $txtFecha = $_REQUEST['txtFecha'];
    $chkestado = $_REQUEST['chkestado'];
    $codigo_persona = $_REQUEST['codigo_persona'];

    $regstroresolucionpersona = new RgstroResolucionPersona();

    $regstroresolucionpersona->setPersonaSistema($personaSistema);
    $regstroresolucionpersona->setCodigoResolucion($txtNumero);
    $regstroresolucionpersona->setFecha($txtFecha);
    $regstroresolucionpersona->setEstado($chkestado);
    $regstroresolucionpersona->setPersona($codigo_persona);

    echo $regstroresolucionpersona->resolucion_persona();
?>