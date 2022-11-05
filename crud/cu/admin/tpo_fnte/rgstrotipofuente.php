<?php 
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í;", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('prcsos/admin/tpo_fnte/rgstroTipoFuente.php');

    $personaSistema = $_SESSION['idusuario'];
    $txtNombre = $_REQUEST['txtNombre'];
    $txtDescripcion = $_REQUEST['txtDescripcion'];
    $chkestado = $_REQUEST['chkestado'];

    $regstrotpofuentefinanciacion = new RgstroTpoFnte();

    $regstrotpofuentefinanciacion->setPersonaSistema($personaSistema);
    $regstrotpofuentefinanciacion->setNombre(strtoupper(tildes($txtNombre)));
    $regstrotpofuentefinanciacion->setDescripcion($txtDescripcion);
    $regstrotpofuentefinanciacion->setEstado($chkestado);

    echo $regstrotpofuentefinanciacion->insert_tipo_fuente();

?>