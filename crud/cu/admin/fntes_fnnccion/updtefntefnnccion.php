<?php 
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í;", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    
    include('prcsos/admin/fntes_fnnccion/mdfcarFnteFnnciacion.php');

    $personaSistema = $_SESSION['idusuario'];
    $codigo_fuente = $_REQUEST['codigo_fuente'];
    $selTipoFuente = $_REQUEST['selTipoFuente'];
    $txtNombre = $_REQUEST['txtNombre'];
    $txtDescripcion = $_REQUEST['txtDescripcion'];
    $chkestado = $_REQUEST['chkestado'];
    $selClasificacion = $_REQUEST['selClasificacion'];
    $txtCodigoLinix = $_REQUEST['txtCodigoLinix'];
    $txtReferenciaLinix = $_REQUEST['txtReferenciaLinix'];
    $selClasificacionPlncion = $_REQUEST['selClasificacionPlncion'];

    $modficarfuentefinanciacion = new MdfcarFntesFnnccion();

    $modficarfuentefinanciacion->setPersonaSistema($personaSistema);
    $modficarfuentefinanciacion->setCodigo($codigo_fuente);
    $modficarfuentefinanciacion->setTipo($selTipoFuente);
    $modficarfuentefinanciacion->setNombre(strtoupper(tildes($txtNombre)));
    $modficarfuentefinanciacion->setDescripcion($txtDescripcion);
    $modficarfuentefinanciacion->setEstado($chkestado);
    $modficarfuentefinanciacion->setClasificacion($selClasificacion);
    $modficarfuentefinanciacion->setCodigoLinix($txtCodigoLinix);
    $modficarfuentefinanciacion->setReferenciaLinix($txtReferenciaLinix);
    $modficarfuentefinanciacion->setClasificacionPlaneacion($selClasificacionPlncion);

    echo $modficarfuentefinanciacion->updteFuente();

?>