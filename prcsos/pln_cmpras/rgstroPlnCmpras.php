<?php
include_once('classPlanCompras.php');

class RgstroPlanCompras extends PlanCompras{

    private $sql_insert_plan_cmpras;
    private $codigo_plan_cmpras;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_plan_cmpras =date('YmdHis').rand(99,99999);
    }

    public function insertPlanCompras(){
        
        $sql_insert_plan_cmpras="INSERT INTO usco.plan_compras(
                                             pco_codigo, 
                                             pco_etapa,
                                             pco_descrpcion, 
                                             pco_cantidad, 
                                             pco_valorunitario, 
                                             pco_estado, 
                                             pco_fechacreo, 
                                             pco_fechamodifico, 
                                             pco_personacreo, 
                                             pco_personamodifico)
                                     VALUES (".$this->codigo_plan_cmpras.",
                                             ".$this->getCodigoEtapa().",  
                                             '".$this->getDescripcion()."', 
                                             ".$this->getCantidad().", 
                                             ".$this->getValorUnitario().", 
                                             ".$this->getEstado().", 
                                             NOW(), 
                                             NOW(), 
                                             ".$this->getPersonaSistema().", 
                                             ".$this->getPersonaSistema().");";

        $this->cnxion->ejecutar($sql_insert_plan_cmpras);


        return $sql_insert_plan_cmpras;

    }
}
?>
