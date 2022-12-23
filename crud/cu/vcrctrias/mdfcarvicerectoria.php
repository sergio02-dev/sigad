<?php
    include('prcsos/vcrctrias/mdfcarVicerectoria.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $chkestado = $_REQUEST['chkestado'];
    $codigo_vicerrectoria = $_REQUEST['codigo_vicerrectoria'];

    $modificarvicerrectoria = new MdfcarVicerrectoria();

    $modificarvicerrectoria->setPersonaSistema($personaSistema);
    $modificarvicerrectoria->setNombre($txtNombre);
    $modificarvicerrectoria->setEstado($chkestado);
    $modificarvicerrectoria->setCodigo($codigo_vicerrectoria);

    $modificarvicerrectoria->updateVicerrectoria();
?>