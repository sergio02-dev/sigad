<?php
    include('prcsos/rporteacvdad/mdfcarRporteActvdadPoai.php');

    $personaSistema = $_SESSION['idusuario'];

    $codigo_reporte = $_REQUEST['codigo_reporte'];
    $codigo_actividadpoai = $_REQUEST['codigo_actividadpoai'];
    $acto_administrativo = $_REQUEST['selActoAdministrativo'];
    $numero_acuerdo = $_REQUEST['txtNumeroAcuerdo'];
    $titulo_nombre = $_REQUEST['txtTituloNombre'];
    $logro = $_REQUEST['txtLogro'];

    $modificarreporteactividad = new MdfcarRprteActvdad();

    $modificarreporteactividad->setCodigo($codigo_reporte);
    $modificarreporteactividad->setCodigoActividadPoai($codigo_actividadpoai);
    $modificarreporteactividad->setActoAdministrativo($acto_administrativo);
    $modificarreporteactividad->setNumeroActo($numero_acuerdo);
    $modificarreporteactividad->setTituloActo($titulo_nombre);
    $modificarreporteactividad->setLogro($logro);
    $modificarreporteactividad->setPersonaSistema($personaSistema);

    echo $modificarreporteactividad->modificarReporteActividadPoai();
?>