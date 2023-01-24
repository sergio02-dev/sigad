<?php
    include('ociconectar/conexion.php');

    $objConsultaLinix = new ConsultaLinix();
     
    $jsonCsfcdores = $objConsultaLinix->jsonCsfcdores();
?>