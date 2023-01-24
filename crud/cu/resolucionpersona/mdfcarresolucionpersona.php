

<?php
     include('prcsos/resolucionpersona/mdfcarresolucionpersona.php');

     $personaSistema = $_SESSION['idusuario'];
     $txtNumero = $_REQUEST['txtNumero'];
     $txtFecha = $_REQUEST['txtFecha'];
     $chkestado = $_REQUEST['chkestado'];
     $codigo_persona = $_REQUEST['codigo_persona'];
     $codigo_resolucion = $_REQUEST['codigo_resolucion'];

    $modificarresolucionpersona = new MdfcarResolucionPersona();

    $modificarresolucionpersona ->setPersonaSistema($personaSistema);
    $modificarresolucionpersona ->setCodigoResolucion($txtNumero);
    $modificarresolucionpersona ->setFecha($txtFecha);
    $modificarresolucionpersona ->setEstado($chkestado);
    $modificarresolucionpersona ->setPersona($codigo_persona);
    $modificarresolucionpersona->setCodigo($codigo_resolucion);

    $modificarresolucionpersona->updateResolucionPersona();
?>