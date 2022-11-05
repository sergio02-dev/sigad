<?php

    include('prcsos/ctvdad/ctvdad.php');

    $objRsctvdad = new Ctvdad();

    $trmstres=$objRsctvdad->trimestre();
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

    $objRsctvdad->selectActividad($codigo_subsistema, $trimestreshow); 
    //$objRsccion->setCodigoSubsistema($codigo_subsistema);
    $rs_actividad=$objRsctvdad->dataActividad();


?>