<?php

    include('prcsos/rprtesbstma/rsRprteSbstma.php');

    $objRsrprteSbstma = new RsRprteSbstma();

    $rsProyectoSubsistema=$objRsrprteSbstma->sqlRsProyectoSubsistema($codigo_subsistema);


?>