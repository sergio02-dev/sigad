<?php
    include('prcsos/prtra/rgstroPrtra.php');

    $personaSistema = $_SESSION['idusuario'];

    $txtFechaInicio=$_REQUEST['txtFechaInicio'];
    $txtFechaFin=$_REQUEST['txtFechaFin'];
    $txtTrimestre=$_REQUEST['txtTrimestre'];

    $trim=substr($txtTrimestre,4,1);

    $objRegistroApertura= new RgstroPrtra();

    $objRegistroApertura->setFechaInicio($txtFechaInicio);
    $objRegistroApertura->setFechaFin($txtFechaFin);
    $objRegistroApertura->setTrimestre($txtTrimestre);
    $objRegistroApertura->setTrim($trim);
    $objRegistroApertura->setPersonaSistema($personaSistema);

    echo $objRegistroApertura->insertApertura();

?>