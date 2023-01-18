<?php
    include('prcsos/plndsrrllo/mdfcarRsponsable.php');

    
    $tipo_responsable = $_REQUEST['tipo_responsable'];

    if($tipo_responsable == 3){
        $codigo_responsable = $_REQUEST['codigo_responsable'];
        $personaSistema = $_SESSION['idusuario'];
        $nivel = $_REQUEST['nivel'];
        $codigo_nivel = $_REQUEST['codigo_nivel'];
        $selOficina = $_REQUEST['selOficina'];
        $selResponsable = $_REQUEST['selResponsable'];
        $selClasificacion = $_REQUEST['selClasificacion'];
        $estado = $_REQUEST['chkestado'];

  
    }else{
        $codigo_responsable = $_REQUEST['codigo_responsable'];
        $personaSistema = $_SESSION['idusuario'];
        $nivel = $_REQUEST['nivel'];
        $codigo_nivel = $_REQUEST['codigo_nivel'];
        $selOficina = $_REQUEST['selOficina'];
        $selResponsable = $_REQUEST['selResponsable'];
        $selClasificacion = 0;
        $estado = $_REQUEST['chkestado'];

        
    }

    $modificarresponsablepdi = new MdfcarRspnsble();

    $modificarresponsablepdi->setCodigo($codigo_responsable);
    $modificarresponsablepdi->setNivel($nivel);
    $modificarresponsablepdi->setCodigoNivel($codigo_nivel);
    $modificarresponsablepdi->setOficina($selOficina);
    $modificarresponsablepdi->setCargo($selResponsable);
    $modificarresponsablepdi->setClasificacion($selClasificacion);
    $modificarresponsablepdi->setEstado($estado);
    $modificarresponsablepdi->setPersonaSistema($personaSistema);

    echo $modificarresponsablepdi->updteResponsable();
?>