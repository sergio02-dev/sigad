<?php
    include('prcsos/plndsrrllo/rgstroRsponsable.php');
    $tpo_responsable =$_REQUEST['tipo_responsable'];

    if($tpo_responsable == 3){
        $selClasificacion = $_REQUEST['selClasificacion']; 
    }
    else{
        $selClasificacion = 0;
    }

    $personaSistema = $_SESSION['idusuario'];
    $nivel = $_REQUEST['nivel'];
    $codigo_nivel = $_REQUEST['codigo_nivel'];
    $selOficina = $_REQUEST['selOficina'];
    $selResponsable = $_REQUEST['selResponsable'];
    $selClasificacion = 0;
    $estado = $_REQUEST['chkestado'];
    $selRegistroOrdenador = $_REQUEST['selRegistroOrdenador'];

    $registroresponsablepdi = new RgstroRspnsble();

    $registroresponsablepdi->setNivel($nivel);
    $registroresponsablepdi->setCodigoNivel($codigo_nivel);
    $registroresponsablepdi->setOficina($selOficina);
    $registroresponsablepdi->setCargo($selResponsable);
    $registroresponsablepdi->setClasificacion($selClasificacion);
    $registroresponsablepdi->setEstado($estado);
    $registroresponsablepdi->setPersonaSistema($personaSistema);
    $registroresponsablepdi->setTipoResponsable($tpo_responsable);
    $registroresponsablepdi->setOrdenador($selRegistroOrdenador);

    echo $registroresponsablepdi->insertResponsable();
?>