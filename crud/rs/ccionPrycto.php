<?php

    include('prcsos/ccion/ccionPrycto.php');

    $objRsccionProyecto = new Ccion;

    $trmstres=$objRsccionProyecto->trimestre();
    $trimestreshow="";
    $cantidad_trimestres=count($trmstres);
    $num=1;
    foreach($trmstres as $data_trmstres){
        $apr_trim=$data_trmstres['apr_trim'];
        if($num==$cantidad_trimestres){
            $coma="";
        }
        else{
            $coma=",";
        }
        $trmin=$apr_trim.$coma;
        $trimestreshow=$trimestreshow.$trmin;
        $num++;
    }
    //echo "---> ".$trimestreshow;
    $objRsccionProyecto->setTrimestre($trimestreshow);
    $objRsccionProyecto->setProyectoAccion($codigo_proyecto);
    $objRsccionProyecto->setResponsableAccion($_SESSION['nameusuario']);
    $objRsccionProyecto->setReferenciaAccion($_SESSION['idusuario']);
    $dataAccionProyecto=$objRsccionProyecto->selectAccionProyecto(); 

    $totalProyecto=$objRsccionProyecto->totalProyecto($codigo_proyecto);
   


?>