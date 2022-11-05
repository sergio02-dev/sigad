<?php
    include('prcsos/rslcnes/rgstroResoluciones.php');

    $personaSistema = $_SESSION['idusuario'];
    $nombre = $_REQUEST['txtNombre'];
    $txtVigencia = $_REQUEST['txtVigencia'];
    $selAcuerdo = $_REQUEST['selAcuerdo'];
    $txtDescripcion = $_REQUEST['txtDescripcion'];
    $txtUrl = $_REQUEST['txtUrl'];
   
    $registroresolucion = new RgstroRslcion();

    $registroresolucion->setNombreResolucion($nombre);
    $registroresolucion->setPersonaSistema($personaSistema);
    $registroresolucion->setVigenciaResolucion($txtVigencia);
    $registroresolucion->setUrlResolucion($txtUrl);
    $registroresolucion->setAcuerdo($selAcuerdo);
    $registroresolucion->setDescripcion($txtDescripcion);

    echo $registroresolucion->insertResolucion();
?>