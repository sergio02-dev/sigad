<?php 
    include('prcsos/plndsrrllo/plndsrrllo.php');

    $objRsPlanDesarrollo = new PlnDsrrllo();
    $objRsPlanDesarrollo->setCodigoPlanDesarrollo($codigo_planDesarrollo);

    $listaNivelUno=$objRsPlanDesarrollo->dataNivelUno();
?>