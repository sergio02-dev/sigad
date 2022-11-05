<?php
include('classPlndsrrllo.php');
class UpdtePlnDsrrllo extends PlanDesarrollo{

    private $updatePlanDesarrollo;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updatePlanDesarrollo(){

        $updatePlanDesarrollo="UPDATE plandesarrollo.plan_desarrollo
                                  SET pde_nombre='".$this->getNombrePlanDesarrollo()."', 
                                      pde_yearinicio=".$this->getYearInicioPlanDesarrollo().", 
                                      pde_yearfin=".$this->getYearFinPlanDesarrollo().", 
                                      pde_personamodifico=".$this->getPersonaSistemaPlanDesarrollo().", 
                                      pde_fechamodifico=NOW(), 
                                      pde_actoadmin=".$this->getActoAdminPlanDesarrollo().", 
                                      pde_niveluno='".$this->getNivelUnoPlanDesarrollo()."',
                                      pde_niveldos='".$this->getNivelDosPlanDesarrollo()."', 
                                      pde_niveltres='".$this->getNivelTresPlanDesarrollo()."',
                                      pde_referencianiveluno='".$this->getReferenciaNivelUnoPlanDesarrollo()."', 
                                      pde_referencianiveldos='".$this->getReferenciaNivelDosPlanDesarrollo()."',
                                      pde_responsable=".$this->getResponsablePlanDesarrollo().",
                                      pde_oficina=".$this->getOficinaPlanDesarrollo()."
                                WHERE pde_codigo=".$this->getCodigoPlanDesarrollo().";";

        $this->cnxion->ejecutar($updatePlanDesarrollo);

        
        return $updatePlanDesarrollo;
    }
}
?>