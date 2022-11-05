<?php
    include('prcsos/rporteacvdad/rgstroRporteacvdadPoai.php');

    $personaSistema = $_SESSION['idusuario'];

    $codigo_reporte = $_REQUEST['codigo_reporte'];
    $codigo_actividadpoai = $_REQUEST['codigo_actividadpoai'];
    $acto_administrativo = $_REQUEST['selActoAdministrativo'];
    $numero_acuerdo = $_REQUEST['txtNumeroAcuerdo'];
    $titulo_nombre = $_REQUEST['txtTituloNombre'];
    $logro = $_REQUEST['txtLogro'];

    $registroreporteactividad = new RgstroRprteActvdad();

    $registroreporteactividad->setCodigoActividadPoai($codigo_actividadpoai);
    $registroreporteactividad->setActoAdministrativo($acto_administrativo);
    $registroreporteactividad->setNumeroActo($numero_acuerdo);
    $registroreporteactividad->setTituloActo($titulo_nombre);
    $registroreporteactividad->setLogro($logro);
    $registroreporteactividad->setPersonaSistema($personaSistema);

    echo $registroreporteactividad->insertReporteActividadPoai();
?>