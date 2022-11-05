<?php
include('classPlndsrrllo.php');
class RgsrtoPlnDsrrllo extends PlanDesarrollo{

    private $insertPlanDesarrollo;
    private $codigoPlanDesarrollo;
    private $codigo_ppi;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoPlanDesarrollo = date('YmdHis').rand(99,99999);
        $this->codigo_ppi = date('YmdHis').rand(99,99999);
    }

    public function insertPlanDesarrollo(){

        $insertPlanDesarrollo="INSERT INTO plandesarrollo.plan_desarrollo(
                                            pde_codigo, pde_nombre, pde_yearinicio, 
                                            pde_yearfin, pde_personacreo, 
                                            pde_personamodifico, pde_fechacreo, 
                                            pde_fechamodifico, pde_actoadmin,
                                            pde_niveluno, pde_niveldos, pde_niveltres, 
                                            pde_referencianiveluno, pde_referencianiveldos, 
                                            pde_responsable, pde_oficina)
                                    VALUES (".$this->codigoPlanDesarrollo.", '".$this->getNombrePlanDesarrollo()."', ".$this->getYearInicioPlanDesarrollo().", 
                                            ".$this->getYearFinPlanDesarrollo().", ".$this->getPersonaSistemaPlanDesarrollo().", 
                                            ".$this->getPersonaSistemaPlanDesarrollo().", NOW(), 
                                            NOW(), ".$this->getActoAdminPlanDesarrollo().",
                                            '".$this->getNivelUnoPlanDesarrollo()."', '".$this->getNivelDosPlanDesarrollo()."', '".$this->getNivelTresPlanDesarrollo()."', 
                                            '".$this->getReferenciaNivelUnoPlanDesarrollo()."', '".$this->getReferenciaNivelDosPlanDesarrollo()."',
                                            ".$this->getResponsablePlanDesarrollo().", ".$this->getOficinaPlanDesarrollo().");";

        $this->cnxion->ejecutar($insertPlanDesarrollo);

        $insert_ppi="INSERT INTO ppi.estado_ppi_plan(
                                 epp_codigo, 
                                 epp_plan, 
                                 epp_estado, 
                                 epp_fechacreo, 
                                 epp_fechamodifico, 
                                 epp_personacreo, 
                                 epp_personamodifico)
                         VALUES (".$this->codigo_ppi.", 
                                 ".$this->codigoPlanDesarrollo.", 
                                 0, 
                                 NOW(), 
                                 NOW(), 
                                 ".$this->getPersonaSistemaPlanDesarrollo().", 
                                 ".$this->getPersonaSistemaPlanDesarrollo().");";

        $this->cnxion->ejecutar($insert_ppi);

        
        return $insertPlanDesarrollo." ".$insert_ppi;
    }
}
?>