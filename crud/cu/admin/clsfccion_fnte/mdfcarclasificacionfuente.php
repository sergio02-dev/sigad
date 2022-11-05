<?php 
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í;", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('prcsos/admin/clsfccion_fnte/mdfcarClasificacionFuente.php');

    $personaSistema = $_SESSION['idusuario'];
    $codigo_clasificacion_fuente = $_REQUEST['codigo_clasificacion_fuente'];
    $txtNombre = $_REQUEST['txtNombre'];
    $txtDescripcion = $_REQUEST['txtDescripcion'];
    $chkestado = $_REQUEST['chkestado'];

    $mdfcarclsfccionfuentefinnccion = new MdfcarClsfccionFnte();

    $mdfcarclsfccionfuentefinnccion->setPersonaSistema($personaSistema);
    $mdfcarclsfccionfuentefinnccion->setCodigo($codigo_clasificacion_fuente);
    $mdfcarclsfccionfuentefinnccion->setNombre(strtoupper(tildes($txtNombre)));
    $mdfcarclsfccionfuentefinnccion->setDescripcion($txtDescripcion);
    $mdfcarclsfccionfuentefinnccion->setEstado($chkestado);

    echo $mdfcarclsfccionfuentefinnccion->update_clasificacion_fuente();

?>