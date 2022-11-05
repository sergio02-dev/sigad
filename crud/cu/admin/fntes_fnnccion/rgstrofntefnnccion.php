<?php 
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í;", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('prcsos/admin/fntes_fnnccion/rgstroFnteFnnciacion.php');

    $personaSistema = $_SESSION['idusuario'];
    $selTipoFuente = $_REQUEST['selTipoFuente'];
    $txtNombre = $_REQUEST['txtNombre'];
    $txtDescripcion = $_REQUEST['txtDescripcion'];
    $chkestado = $_REQUEST['chkestado'];
    $selClasificacion = $_REQUEST['selClasificacion'];
    $txtCodigoLinix = $_REQUEST['txtCodigoLinix'];
    $txtReferenciaLinix = $_REQUEST['txtReferenciaLinix'];
    $selClasificacionPlncion = $_REQUEST['selClasificacionPlncion'];

    $regstrofuentefinanciacion = new RgstroFntesFnnccion();

    $regstrofuentefinanciacion->setPersonaSistema($personaSistema);
    $regstrofuentefinanciacion->setTipo($selTipoFuente);
    $regstrofuentefinanciacion->setNombre(strtoupper(tildes($txtNombre)));
    $regstrofuentefinanciacion->setDescripcion($txtDescripcion);
    $regstrofuentefinanciacion->setEstado($chkestado);
    $regstrofuentefinanciacion->setClasificacion($selClasificacion);
    $regstrofuentefinanciacion->setCodigoLinix($txtCodigoLinix);
    $regstrofuentefinanciacion->setReferenciaLinix($txtReferenciaLinix);
    $regstrofuentefinanciacion->setClasificacionPlaneacion($selClasificacionPlncion);

    echo $regstrofuentefinanciacion->insertFuente();

?>