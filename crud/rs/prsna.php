<?php
    include('prcsos/prsna/prsna.php');

    $objRsPersona = new Prsna();

    $rs_persona=$objRsPersona->dataPersona(); 
    
    $rs_TipoIdentificacion=$objRsPersona->dataIdentificacion(); 
    

    

?>