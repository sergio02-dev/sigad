<?php
    include('prcsos/ppi/rgstroPpi.php');

    $personaSistema = $_SESSION['idusuario'];
    $codigo_plan = $_REQUEST['codigo_plan'];
    $codigo_ppi = $_REQUEST['codigo_ppi'];
    $txtVigencia = $_REQUEST['txtVigencia'];
    $txtValor = $_REQUEST['txtValor'];
    $selFuenteFinanciacion = $_REQUEST['selFuenteFinanciacion'];
    $chkestado = $_REQUEST['chkestado'];

    $array_datos = array();	
    
    $num_datos = count($txtVigencia);

    for ($datos_ppi=0; $datos_ppi < $num_datos; $datos_ppi++) { 
        if($txtValor[$datos_ppi]){
            $valor_ppi = $txtValor[$datos_ppi];
        }
        else{
            $valor_ppi = 0;
        }

        $array_datos[] = array('codigo_plan'=> $codigo_plan,
                               'codigo_ppi'=> $codigo_ppi,
                               'persona_creo'=> $personaSistema,
                               'vigencia_ppi'=> $txtVigencia[$datos_ppi],
                               'valor_ppi'=> $valor_ppi,
                               'fuente_ppi'=> $selFuenteFinanciacion,
                               'estado'=> $chkestado,
                            );
    }

    $regstroppi = new RgstroPPI();

    $regstroppi->setArrayDatos($array_datos);

    $regstroppi->insertPpi();

?>