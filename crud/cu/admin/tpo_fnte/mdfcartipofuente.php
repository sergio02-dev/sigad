<?php 
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í;", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('prcsos/admin/tpo_fnte/mdfcarTipoFuente.php');

    $personaSistema = $_SESSION['idusuario'];
    $codigo_tipo_fuente = $_REQUEST['codigo_tipo_fuente'];
    $txtNombre = $_REQUEST['txtNombre'];
    $txtDescripcion = $_REQUEST['txtDescripcion'];
    $chkestado = $_REQUEST['chkestado'];

    $modfcartipofuentefinanciacion = new MdfcarTpoFnte();

    $modfcartipofuentefinanciacion->setPersonaSistema($personaSistema);
    $modfcartipofuentefinanciacion->setCodigo($codigo_tipo_fuente);
    $modfcartipofuentefinanciacion->setNombre(strtoupper(tildes($txtNombre)));
    $modfcartipofuentefinanciacion->setDescripcion($txtDescripcion);
    $modfcartipofuentefinanciacion->setEstado($chkestado);

    echo $modfcartipofuentefinanciacion->update_tipo_fuente();

?>