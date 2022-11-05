<?php
    include('prcsos/asgncion_rcrsos/rgstroAsgncionRcrsos.php');

    $personaSistema = $_SESSION['idusuario'];
    $codigo_poai = $_REQUEST['codigo_poai'];
    $codigo_accion = $_REQUEST['codigo_accion'];
    $codigo_indicador = $_REQUEST['codigo_indicador'];
    $selFuente = $_REQUEST['selFuente'];
    $vigencia_actividad = $_REQUEST['vigencia_actividad'];
    $vigencia_recurso = $_REQUEST['vigencia_recurso'];
    $txtResurso =  str_replace('.','',$_REQUEST['txtResurso']);
    $chkestado = $_REQUEST['chkestado'];
    $codigo_tipo = $_REQUEST['codigo_tipo'];

    $registroasignacionrecursos = new RgstroAsgncionRcrsos();

    $registroasignacionrecursos->setPersonaSistema($personaSistema);
    $registroasignacionrecursos->setEtapaAsignacion($codigo_poai);
    $registroasignacionrecursos->setAccion($codigo_accion);
    $registroasignacionrecursos->setIndicador($codigo_indicador);
    $registroasignacionrecursos->setFuente($selFuente);
    $registroasignacionrecursos->setVigenciaRecurso($vigencia_recurso);
    $registroasignacionrecursos->setVigenciaPoai($vigencia_actividad);
    $registroasignacionrecursos->setRecurso($txtResurso);
    $registroasignacionrecursos->setEstado($chkestado);
    $registroasignacionrecursos->setTipo($codigo_tipo);

    $valor_etapa = $registroasignacionrecursos->valor_etapa($codigo_poai);


    $recrso_asignado = $registroasignacionrecursos->recrso_asignado($codigo_poai);

    $valor_asignado = $recrso_asignado + $txtResurso;

    if($valor_asignado > $valor_etapa){
        $data = 1;
    }
    else{
        $data = 0;
        $registroasignacionrecursos->insertAsgncionRcrso();
    }
    echo $data;    
?>