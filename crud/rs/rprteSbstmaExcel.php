<?php
/**
 * Karen Yuliana Palacio Minú
 * 15 de Octubre 2019 16:14 pm
 * Rs Reporte Subsistema Excel 
 */

    include('prcsos/rprtesbstma/rsRprteSbstmaExcel.php');

    $objRsrprteSbstmaExcel = new RsRprteSbstmaExcel();

    $rsProyectoSubsistema=$objRsrprteSbstmaExcel->sqlRsProyectoSubsistema($codigo_subsistema);


?>