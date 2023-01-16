<?php
include_once('classPlanCompras.php');

class RgstroPlanCompras extends PlanCompras{

    private $sql_insert_plan_cmpras;


    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function insertPlanCompras(){

        $plancompras = $this->getPlancompras();

        for ($lista_plancompras=0; $lista_plancompras < count($plancompras); $lista_plancompras++) { 

            $codigo_planComprasAccion[$lista_plancompras] = date('YmdHis').rand(99,99999);
        
            $sql_insert_plan_cmpras_accion[$lista_plancompras]="INSERT INTO usco.plancompras_accion(pca_codigo, 
                                                                                                    pca_etapa, 
                                                                                                    pca_plancompras, 
                                                                                                    pca_estado, 
                                                                                                    pca_fechacreo, 
                                                                                                    pca_fechamodifico, 
                                                                                                    pca_personacreo, 
                                                                                                    pca_personamodifico)
                                                                                    VALUES (".$codigo_planComprasAccion[$lista_plancompras] .", 
                                                                                            ".$this->getCodigoEtapa().",
                                                                                            ".$plancompras[$lista_plancompras].", 
                                                                                            1, 
                                                                                            NOW(), 
                                                                                            NOW(), 
                                                                                            ".$this->getPersonaSistema().", 
                                                                                            ".$this->getPersonaSistema().");";
            
            
            

                 $this->cnxion->ejecutar($sql_insert_plan_cmpras_accion[$lista_plancompras]);
        }


        return $sql_insert_plan_cmpras_accion;

    }
}
?>
