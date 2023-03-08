<?php
    include('ociconectar/conexion.php');

    $objConsultaLinix = new ConsultaLinix();
     
    $jsonConsultarcdp = $objConsultaLinix->jsonnCDP();
?>