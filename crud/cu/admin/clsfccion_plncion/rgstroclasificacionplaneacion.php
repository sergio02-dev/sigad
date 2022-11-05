<?php 
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í;", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('prcsos/admin/clsfccion_plncion/rgstroClasificacionPlaneacion.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $txtDescripcion = $_REQUEST['txtDescripcion'];
    $chkestado = $_REQUEST['chkestado'];

    $rsgistroclasificacionplaneacion = new RgstroClsfccionPlncion();

    $rsgistroclasificacionplaneacion->setPersonaSistema($personaSistema);
    $rsgistroclasificacionplaneacion->setNombre(strtoupper(tildes($txtNombre)));
    $rsgistroclasificacionplaneacion->setDescripcion($txtDescripcion);
    $rsgistroclasificacionplaneacion->setEstado($chkestado);

    echo $rsgistroclasificacionplaneacion->insert_clasificacion_plncion();

?>