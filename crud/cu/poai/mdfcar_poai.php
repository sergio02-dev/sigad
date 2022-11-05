<?php
    include('prcsos/poai/mdfcarPoai.php');

    $personaSistema = $_SESSION['idusuario'];
    $selAccion = $_REQUEST['selAccion'];
    $selFuenteFinanciacion = $_REQUEST['selFuenteFinanciacion'];
    $selSede = $_REQUEST['selSede'];
    $txtSaldo =  str_replace('.','',$_REQUEST['txtSaldo']);
    $chkestado = $_REQUEST['chkestado'];
    $selVigencia = $_REQUEST['selVigencia'];
    $codigo_poai = $_REQUEST['codigo_poai'];
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

    $modificarpoai = new MdfcarPOAI();

    $modificarpoai->setPersonaSistema($personaSistema);
    $modificarpoai->setAccion($selAccion);
    $modificarpoai->setFuente($selFuenteFinanciacion);
    $modificarpoai->setSede($selSede);
    $modificarpoai->setRecurso($txtSaldo);
    $modificarpoai->setEstado($chkestado);
    $modificarpoai->setCodigo($codigo_poai);
    $modificarpoai->setVigencia($selVigencia);
    $modificarpoai->setIndicador($selIndicador);
    $modificarpoai->setAdicion($adicion);
    $modificarpoai->setAcuerdo($acuerdo);

    echo $modificarpoai->updatePOAI();
?>