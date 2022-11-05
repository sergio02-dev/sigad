<?php
    include('prcsos/rslcnes/updteResoluciones.php');

    $personaSistema = $_SESSION['idusuario'];
    $nombre = $_REQUEST['txtNombre'];
    $codigo_resolucion = $_REQUEST['codigo_resolucion'];
    $txtVigencia = $_REQUEST['txtVigencia'];
    $selAcuerdo = $_REQUEST['selAcuerdo'];
    $txtDescripcion = $_REQUEST['txtDescripcion'];
    $txtUrl = $_REQUEST['txtUrl'];
   
    $modificarresolucion = new MdfcarRslcion();

    $modificarresolucion->setNombreResolucion($nombre);
    $modificarresolucion->setPersonaSistema($personaSistema);
    $modificarresolucion->setCodigoResolucion($codigo_resolucion);
    $modificarresolucion->setVigenciaResolucion($txtVigencia);
    $modificarresolucion->setUrlResolucion($txtUrl);
    $modificarresolucion->setAcuerdo($selAcuerdo);
    $modificarresolucion->setDescripcion($txtDescripcion);

    echo $modificarresolucion->updateResolucion();
?>