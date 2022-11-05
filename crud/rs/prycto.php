<?php

     
    include('prcsos/prycto/prycto.php');

    $objRsProyecto = new Prycto();


    $trmstres=$objRsProyecto->trimestre();
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

    
    $objRsProyecto->setTrimestres($trimestreshow);
    $objRsProyecto->setSubsistemaProyecto($codigo_subsistema);
    $objRsProyecto->setResponsableProyecto($_SESSION['nameusuario']);
    $objRsProyecto->setReferenciaProyecto($_SESSION['idusuario']);
    $dataProyecto=$objRsProyecto->selectProyectoSubsistema();

    $totalSubstistema=$objRsProyecto->totalSubsistema($codigo_subsistema);

?>