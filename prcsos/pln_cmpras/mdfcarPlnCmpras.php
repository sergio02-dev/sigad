<?php
include_once('classPlanCompras.php');

class MdfcarPlanCmpras extends PlanCompras{

    private $sql_insert_plan_cmpras;
    private $codigo_plan_cmpras;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updtePlanCompras(){

       

        $sql_updte_plancompras = "UPDATE usco.plancompras_accion
                                     SET pca_estado=0
                                    WHERE pca_etapa = ".$this->getCodigoEtapa().";";
        
        $this->cnxion->ejecutar($sql_updte_plancompras );

        

        $plancompras = $this->getPlancompras();

        for ($lista_plancompras=0; $lista_plancompras < count($plancompras); $lista_plancompras++) { 
            
            $codigo_plancompras[$lista_plancompras] = date('YmdHis').rand(99,99999);

            $sql_plancompras[$lista_plancompras]="INSERT INTO usco.plancompras_accion(pca_codigo, 
                                                                                      pca_etapa, 
                                                                                      pca_plancompras, 
                                                                                      pca_estado, 
                                                                                      pca_fechamodifico, 
                                                                                      pca_personamodifico)
                                                                              VALUES (".$codigo_plancompras[$lista_plancompras] .", 
                                                                                      ".$this->getCodigoEtapa().",
                                                                                      ".$plancompras[$lista_plancompras].", 
                                                                                      1, 
                                                                                      NOW(), 
                                                                                      ".$this->getPersonaSistema().");";

            
            $this->cnxion->ejecutar($sql_plancompras[$lista_plancompras]);
        }
        return $sql_updte_plancompras;

    }
}
?>