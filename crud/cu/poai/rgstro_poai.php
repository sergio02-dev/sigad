<?php
    include('prcsos/poai/rgstroPoai.php');

    $personaSistema = $_SESSION['idusuario'];
    $selAccion = $_REQUEST['selAccion'];
    $selFuenteFinanciacion = $_REQUEST['selFuenteFinanciacion'];
    $selSede = $_REQUEST['selSede'];
    $txtSaldo =  str_replace('.','',$_REQUEST['txtSaldo']);
    $chkestado = $_REQUEST['chkestado'];
    $selVigencia = $_REQUEST['selVigencia'];
    $selIndicador = $_REQUEST['selIndicador'];
    $adicionPoai = $_REQUEST['adicionPoai'];
    $selAcuerdo = $_REQUEST['selAcuerdo'];

    if($adicionPoai == 1){
        $adicion = 1;  
    }
    else{
        $adicion = 0;
    }
    
    $acuerdo = $selAcuerdo;

    $registropoai = new RgstroPOAI();

    $registropoai->setPersonaSistema($personaSistema);
    $registropoai->setAccion($selAccion);
    $registropoai->setFuente($selFuenteFinanciacion);
    $registropoai->setSede($selSede);
    $registropoai->setRecurso($txtSaldo);
    $registropoai->setEstado($chkestado);
    $registropoai->setVigencia($selVigencia);
    $registropoai->setIndicador($selIndicador);
    $registropoai->setAdicion($adicion);
    $registropoai->setAcuerdo($acuerdo);

    echo $registropoai->insertPOAI();
?>