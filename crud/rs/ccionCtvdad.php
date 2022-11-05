<?php

    include('prcsos/ctvdad/ctvdadCcion.php');

    $objRsctvdadCcion = new CcionCtvdad();

    $trmstres=$objRsctvdadCcion->trimestre();
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

    //echo "--> Trimestres ".$trimestreshow;
   
    $objRsctvdadCcion->setTrimestreActividad($trimestreshow);
    $objRsctvdadCcion->setAccionActividad($codigo_accion);
    $objRsctvdadCcion->setReferenciaActividad($_SESSION['idusuario']);
    $objRsctvdadCcion->setProyectoActividad($_SESSION['nameusuario']);
    $rsActividadAccion=$objRsctvdadCcion->dataAccionActividadAccion(); 
 
  
?>