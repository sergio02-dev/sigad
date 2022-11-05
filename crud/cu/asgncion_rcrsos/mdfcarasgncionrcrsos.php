<?php
    include('prcsos/asgncion_rcrsos/mdfcarAsgncionRcrsos.php');

    $personaSistema = $_SESSION['idusuario'];
    $codigo_poai = $_REQUEST['codigo_poai'];
    $codigo_accion = $_REQUEST['codigo_accion'];
    $codigo_indicador = $_REQUEST['codigo_indicador'];
    $selFuente = $_REQUEST['selFuente'];
    $vigencia_actividad = $_REQUEST['vigencia_actividad'];
    $vigencia_recurso = $_REQUEST['vigencia_recurso'];
    $txtResurso =  str_replace('.','',$_REQUEST['txtResurso']);
    $chkestado = $_REQUEST['chkestado'];
    $codigo_asignacion = $_REQUEST['codigo_asignacion'];
    $codigo_tipo = $_REQUEST['codigo_tipo'];

    $modificrasignacionrecursos = new MdfcarAsgncionRcrsos();

    $modificrasignacionrecursos->setPersonaSistema($personaSistema);
    $modificrasignacionrecursos->setEtapaAsignacion($codigo_poai);
    $modificrasignacionrecursos->setAccion($codigo_accion);
    $modificrasignacionrecursos->setIndicador($codigo_indicador);
    $modificrasignacionrecursos->setFuente($selFuente);
    $modificrasignacionrecursos->setVigenciaRecurso($vigencia_recurso);
    $modificrasignacionrecursos->setVigenciaPoai($vigencia_actividad);
    $modificrasignacionrecursos->setRecurso($txtResurso);
    $modificrasignacionrecursos->setEstado($chkestado);
    $modificrasignacionrecursos->setCodigo($codigo_asignacion);
    $modificrasignacionrecursos->setTipo($codigo_tipo);

    $valor_etapa = $modificrasignacionrecursos->valor_etapa($codigo_poai);

    $recrso_asignado = $modificrasignacionrecursos->recrso_asignado($codigo_poai, $codigo_asignacion);

    $valor_asignado = $recrso_asignado + $txtResurso;

    if($valor_asignado > $valor_etapa){
        $data = 1;
    }
    else{
        $data = 0;
        $modificrasignacionrecursos->mdfcartAsgncionRcrso();
    }
    echo $data;
?>