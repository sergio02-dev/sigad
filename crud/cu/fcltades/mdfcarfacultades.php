<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('prcsos/fcltades/mdfcarFacultades.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $chkestado = $_REQUEST['chkestado'];
    $codigo_facultades = $_REQUEST['codigo_facultades'];

    $modificarfacultades = new MdfcarFacultades();

    $modificarfacultades->setPersonaSistema($personaSistema);
    $modificarfacultades->setNombre($txtNombre);
    $modificarfacultades->setEstado($chkestado);
    $modificarfacultades->setCodigo($codigo_facultades);

    $modificarfacultades->updateFacultades();

?>