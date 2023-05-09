<?php
    include('prcsos/plndsrrllo/mdfcarRsponsable.php');

    $codigo_responsable = $_REQUEST['codigo_responsable'];
    $tipo_responsable = $_REQUEST['tipo_responsable'];
    
    if($tipo_responsable == 3){
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
    $estado = $_REQUEST['chkestado'];
    $selRegistroOrdenador = $_REQUEST['selRegistroOrdenador'];

    $modificarresponsablepdi = new MdfcarRspnsble();

    $modificarresponsablepdi->setCodigo($codigo_responsable);
    $modificarresponsablepdi->setNivel($nivel);
    $modificarresponsablepdi->setCodigoNivel($codigo_nivel);
    $modificarresponsablepdi->setOficina($selOficina);
    $modificarresponsablepdi->setCargo($selResponsable);
    $modificarresponsablepdi->setClasificacion($selClasificacion);
    $modificarresponsablepdi->setEstado($estado);
    $modificarresponsablepdi->setPersonaSistema($personaSistema);
    $modificarresponsablepdi->setOrdenador($selRegistroOrdenador);
    $modificarresponsablepdi->setTipoResponsable($tipo_responsable);

    echo $modificarresponsablepdi->updteResponsable();
?>