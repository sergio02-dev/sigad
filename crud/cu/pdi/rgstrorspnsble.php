<?php
    include('prcsos/plndsrrllo/rgstroRsponsable.php');

    $personaSistema = $_SESSION['idusuario'];
    $nivel = $_REQUEST['nivel'];
    $codigo_nivel = $_REQUEST['codigo_nivel'];
    $selOficina = $_REQUEST['selOficina'];
    $selResponsable = $_REQUEST['selResponsable'];
    $estado = $_REQUEST['chkestado'];
    $tipo_responsable = $_REQUEST['tipo_responsable'];

    $registroresponsablepdi = new RgstroRspnsble();

    $registroresponsablepdi->setNivel($nivel);
    $registroresponsablepdi->setCodigoNivel($codigo_nivel);
    $registroresponsablepdi->setOficina($selOficina);
    $registroresponsablepdi->setCargo($selResponsable);
    $registroresponsablepdi->setEstado($estado);
    $registroresponsablepdi->setPersonaSistema($personaSistema);
    $registroresponsablepdi->setTipoResponsable($tipo_responsable);

    echo $registroresponsablepdi->insertResponsable();
?>