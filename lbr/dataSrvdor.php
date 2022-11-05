<?php

    include('srvdor.php');
    include('mgbleUrl.php');

    
    $servicio = new Servidor();
    $online = $servicio->getOnline(); //  si es local o server real |
    $enlace = $servicio->getEnlace(); // | enlace de la url 
    
    $UrlAmigable = new UrlAmigable();

   // **** INICIO data de la URL **** //

   $UrlAmigable->urlRegla($online); // 
   $seccion_url=$UrlAmigable->getSeccionUrl(); // seccion de la url
   $contenido=$UrlAmigable->getContenido(); // valriables que tiene la url
   $iduno=$UrlAmigable->getCodigo_elemento1(); // valor codigo variable de la url
   $iddos=$UrlAmigable->getCodigo_elemento2(); // valor codigo variable de la url

    
    // **** FIN data de la URL **** //



?>