<?php
    include('prcsos/plndsrrllo/plndsrrllo.php');

    $objRsPlanDesarrollo = new PlnDsrrllo();

    $rs_ActoAdministrativo=$objRsPlanDesarrollo->sqlActoAdministrativo(); 
    
?>