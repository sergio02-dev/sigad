<?php 
    include('prcsos/pln_cmpras/mdfcarPlnCmpras.php');

    $personaSistema = $_SESSION['idusuario'];
    $plancompras = $_REQUEST['plancompras'];
    $codigoPlanCompras = $_REQUEST['codigoPlanCompras'];
    $pco_etapa = $_REQUEST['codigo_poai'];
    
    
    $modificarplancompras = new MdfcarPlancmpras();

    $modificarplancompras->setPersonaSistema($personaSistema);
    $modificarplancompras->setPlancompras($plancompras);
    $modificarplancompras->setCodigoEtapa($pco_etapa);

    $modificarplancompras->updtePlanCompras();
        
        
?>