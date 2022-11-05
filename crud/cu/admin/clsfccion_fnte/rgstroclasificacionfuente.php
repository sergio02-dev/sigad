<?php 
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í;", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('prcsos/admin/clsfccion_fnte/rgstroClasificacionFuente.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $txtDescripcion = $_REQUEST['txtDescripcion'];
    $chkestado = $_REQUEST['chkestado'];

    $registroclasificacionfuentefinanciacion = new RgstroClsfccionFnte();

    $registroclasificacionfuentefinanciacion->setPersonaSistema($personaSistema);
    $registroclasificacionfuentefinanciacion->setNombre(strtoupper(tildes($txtNombre)));
    $registroclasificacionfuentefinanciacion->setDescripcion($txtDescripcion);
    $registroclasificacionfuentefinanciacion->setEstado($chkestado);

    echo $registroclasificacionfuentefinanciacion->insert_clasificacion_fuente();

?>