<?php
    include('prcsos/ctvdad/rsRgstroCtvdad.php');

    $objRsRgstroCtvdad = new RsRgstroCtvdad();

    $objRsRgstroCtvdad->setCodigoActividadRealizada($codigo_activida_realizada);

    $actividadRealiza=$objRsRgstroCtvdad->sqlRsDatosActividad();

?>