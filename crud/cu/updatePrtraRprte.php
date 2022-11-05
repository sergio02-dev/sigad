<?php
    include('prcsos/prtra/updatePrtra.php');

    $personaSistema = $_SESSION['idusuario'];

    $txtFechaInicio=$_REQUEST['txtFechaInicio'];
    $txtFechaFin=$_REQUEST['txtFechaFin'];
    $txtTrimestre=$_REQUEST['txtTrimestre'];
    $codigo_apertura=$_REQUEST['codigoApertura'];

    $trim=substr($txtTrimestre,4,1);
   
    $objUpdateApertura= new UpdatePrtra();

    $objUpdateApertura->setCodigoApertura($codigo_apertura);
    $objUpdateApertura->setFechaInicio($txtFechaInicio);
    $objUpdateApertura->setFechaFin($txtFechaFin);
    $objUpdateApertura->setTrimestre($txtTrimestre);
    $objUpdateApertura->setTrim($trim);
    $objUpdateApertura->setPersonaSistema($personaSistema);

    echo $objUpdateApertura->updateApertura();

?>