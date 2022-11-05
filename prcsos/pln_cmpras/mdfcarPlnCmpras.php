<?php
include_once('classPlanCompras.php');

class MdfcarPlanCmpras extends PlanCompras{

    private $sql_insert_plan_cmpras;
    private $codigo_plan_cmpras;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_plan_cmpras =date('YmdHis').rand(99,99999);
    }

    public function updtePlanCompras(){

        $datos = $this->getArrayDatos();

        if($datos){
            foreach ($datos as $dta_datos) {
                $codigo_compra = $dta_datos['codigo_compra'];
                $descripcion = $dta_datos['descripcion'];
                $cantidad = $dta_datos['cantidad'];
                $valor_unitario = $dta_datos['valor_unitario'];
                $estado = $dta_datos['estado'];
                $persona_sistema = $dta_datos['persona_sistema'];


                $sql_mdfcar_plan_cmpras="UPDATE usco.plan_compras
                                            SET pco_descrpcion = '$descripcion', 
                                                pco_cantidad = $cantidad, 
                                                pco_valorunitario = $valor_unitario, 
                                                pco_estado = $estado, 
                                                pco_fechamodifico = NOW(),
                                                pco_personamodifico = $persona_sistema
                                          WHERE pco_codigo = $codigo_compra ;";

                $this->cnxion->ejecutar($sql_mdfcar_plan_cmpras);

                echo "<br/> ".$sql_mdfcar_plan_cmpras;
            }
        }

    }
}
?>
