<?php 
    include('prcsos/pln_cmpras/mdfcarPlnCmpras.php');

    $personaSistema = $_SESSION['idusuario'];
    $num_datos = $_REQUEST['num_datos'];

    $array_datos = array();

    for ($datos_plan_compra=1; $datos_plan_compra <= 4 ; $datos_plan_compra++) {
        $codigo_compra = $_REQUEST['codigo_mod'.$datos_plan_compra]; 
        $pdi_sede = $_REQUEST['pdi_sede'.$datos_plan_compra];
        $pdi_dependencia = $_REQUEST['pdi_dependencia'.$datos_plan_compra];
        $pdi_plantafisica = $_REQUEST['pdi_plantafisica'.$datos_plan_compra];
        $descripcion = $_REQUEST['txtDescripcion'.$datos_plan_compra];
        $cantidad = $_REQUEST['txtCantidad'.$datos_plan_compra];
        $valor_unitario = $_REQUEST['txtValorUnitario'.$datos_plan_compra];
        $estado = $_REQUEST['chkestado'.$datos_plan_compra];



        $array_datos[] = array('codigo_compra'=> $codigo_compra,
                               'pdi_sede'=> $pdi_sede,
                               'pdi_dependencia' => $pdi_dependencia,
                               'pdi_plantafisica' => str_replace("'","&apos;",$pdi_plantafisica),
                               'descripcion'=> str_replace("'","&apos;",$descripcion),
                               'cantidad'=> str_replace(',','.',$cantidad),
                               'valor_unitario'=> str_replace('.','',$valor_unitario),
                               'estado'=> $estado,
                               'persona_sistema'=> $personaSistema,
                            );
    
    }

    $modificarplanacccion = new MdfcarPlanCmpras();

    $modificarplanacccion->setArrayDatos($array_datos);
    
    echo $modificarplanacccion->updtePlanCompras();
        
        
?>