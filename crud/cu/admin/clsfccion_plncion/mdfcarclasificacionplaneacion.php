<?php 
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í;", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('prcsos/admin/clsfccion_plncion/mdfcarClasificacionPlaneacion.php');

    $personaSistema = $_SESSION['idusuario'];
    $codigo_clasificacion_planeacion = $_REQUEST['codigo_clasificacion_planeacion'];
    $txtNombre = $_REQUEST['txtNombre'];
    $txtDescripcion = $_REQUEST['txtDescripcion'];
    $chkestado = $_REQUEST['chkestado'];

    $mdfcarclsfccionplncion = new MdfcarClsfccionPlncion();

    $mdfcarclsfccionplncion->setPersonaSistema($personaSistema);
    $mdfcarclsfccionplncion->setCodigo($codigo_clasificacion_planeacion);
    $mdfcarclsfccionplncion->setNombre(strtoupper(tildes($txtNombre)));
    $mdfcarclsfccionplncion->setDescripcion($txtDescripcion);
    $mdfcarclsfccionplncion->setEstado($chkestado);

    echo $mdfcarclsfccionplncion->update_clasificacion_plncion();

?>