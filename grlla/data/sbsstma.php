<?php

    include('prcsos/sbsstema/sbsstma.php');

    $subsistema=new Sbsstma();

    $subsistema->setCodigoSubsistema($_SESSION['subsistema']);
    $subsistema->setResponsable($_SESSION['nameusuario']);
    $subsistema->setReferenciaSubsistema($_SESSION['idusuario']);
 
    $subsistema->setPlanDesarrollo($planDesarrollo);
 
    $dataSubsistema=$subsistema->selectSubsistema();

?>