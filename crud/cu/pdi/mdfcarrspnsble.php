<?php
    include('prcsos/plndsrrllo/mdfcarRsponsable.php');

    $personaSistema = $_SESSION['idusuario'];
    $codigo_responsable = $_REQUEST['codigo_responsable'];
    $nivel = $_REQUEST['nivel'];
    $codigo_nivel = $_REQUEST['codigo_nivel'];
    $selOficina = $_REQUEST['selOficina'];
    $selResponsable = $_REQUEST['selResponsable'];
    $estado = $_REQUEST['chkestado'];

    $modificarresponsablepdi = new MdfcarRspnsble();

    $modificarresponsablepdi->setCodigo($codigo_responsable);
    $modificarresponsablepdi->setNivel($nivel);
    $modificarresponsablepdi->setCodigoNivel($codigo_nivel);
    $modificarresponsablepdi->setOficina($selOficina);
    $modificarresponsablepdi->setCargo($selResponsable);
    $modificarresponsablepdi->setEstado($estado);
    $modificarresponsablepdi->setPersonaSistema($personaSistema);

    echo $modificarresponsablepdi->updteResponsable();
?>