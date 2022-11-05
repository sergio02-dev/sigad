<?php 
class PlanDesarrollo{

    private $codigoPlanDesarrollo;
    private $nombrePlanDesarrollo;
    private $yearInicioPlanDesarrollo;
    private $yearFinPlanDesarrollo;
    private $actoAdminPlanDesarrollo;
    private $personaSistemaPlanDesarrollo;
    private $nivelUnoPlanDesarrollo;
    private $nivelDosPlanDesarrollo;
    private $nivelTresPlanDesarrollo;
    private $referenciaNivelUnoPlanDesarrollo;
    private $referenciaNivelDosPlanDesarrollo;
    private $responsablePlanDesarrollo;
    private $oficinaPlanDesarrollo;

    public function getCodigoPlanDesarrollo(){
        return $this->codigoPlanDesarrollo;
    } 

    public function setCodigoPlanDesarrollo($codigoPlanDesarrollo){
        $this->codigoPlanDesarrollo=$codigoPlanDesarrollo;
    } 

    public function getNombrePlanDesarrollo(){
        return $this->nombrePlanDesarrollo;
    } 

    public function setNombrePlanDesarrollo($nombrePlanDesarrollo){
        $this->nombrePlanDesarrollo=$nombrePlanDesarrollo;
    } 

    public function getYearInicioPlanDesarrollo(){
        return $this->yearInicioPlanDesarrollo;
    } 

    public function setYearIncioPlanDesarrollo($yearInicioPlanDesarrollo){
        $this->yearInicioPlanDesarrollo=$yearInicioPlanDesarrollo;
    } 

    public function getYearFinPlanDesarrollo(){
        return $this->yearFinPlanDesarrollo;
    } 

    public function setYearFinPlanDesarrollo($yearFinPlanDesarrollo){
        $this->yearFinPlanDesarrollo=$yearFinPlanDesarrollo;
    } 

    public function getActoAdminPlanDesarrollo(){
        return $this->actoAdminPlanDesarrollo;
    } 

    public function setActoAdminPlanDesarrollo($actoAdminPlanDesarrollo){
        $this->actoAdminPlanDesarrollo=$actoAdminPlanDesarrollo;
    }

    public function getPersonaSistemaPlanDesarrollo(){
        return $this->personaSistemaPlanDesarrollo;
    } 

    public function setPersonaSistemaPlanDesarrollo($personaSistemaPlanDesarrollo){
        $this->personaSistemaPlanDesarrollo=$personaSistemaPlanDesarrollo;
    }

    public function getNivelUnoPlanDesarrollo(){
        return $this->nivelUnoPlanDesarrollo;
    } 

    public function setNivelUnoPlanDesarrollo($nivelUnoPlanDesarrollo){
        $this->nivelUnoPlanDesarrollo=$nivelUnoPlanDesarrollo;
    }

    public function getNivelDosPlanDesarrollo(){
        return $this->nivelDosPlanDesarrollo;
    } 

    public function setNivelDosPlanDesarrollo($nivelDosPlanDesarrollo){
        $this->nivelDosPlanDesarrollo=$nivelDosPlanDesarrollo;
    }

    public function getNivelTresPlanDesarrollo(){
        return $this->nivelTresPlanDesarrollo;
    } 

    public function setNivelTresPlanDesarrollo($nivelTresPlanDesarrollo){
        $this->nivelTresPlanDesarrollo=$nivelTresPlanDesarrollo;
    }

    public function getReferenciaNivelUnoPlanDesarrollo(){
        return $this->referenciaNivelUnoPlanDesarrollo;
    } 

    public function setReferenciaNivelUnoPlanDesarrollo($referenciaNivelUnoPlanDesarrollo){
        $this->referenciaNivelUnoPlanDesarrollo=$referenciaNivelUnoPlanDesarrollo;
    }  
    
    public function getReferenciaNivelDosPlanDesarrollo(){
        return $this->referenciaNivelDosPlanDesarrollo;
    } 

    public function setReferenciaNivelDosPlanDesarrollo($referenciaNivelDosPlanDesarrollo){
        $this->referenciaNivelDosPlanDesarrollo=$referenciaNivelDosPlanDesarrollo;
    } 
    
    public function getResponsablePlanDesarrollo(){
        return $this->responsablePlanDesarrollo;
    } 

    public function setResponsablePlanDesarrollo($responsablePlanDesarrollo){
        $this->responsablePlanDesarrollo=$responsablePlanDesarrollo;
    }  
    
    public function getOficinaPlanDesarrollo(){
        return $this->oficinaPlanDesarrollo;
    } 

    public function setOficinaPlanDesarrollo($oficinaPlanDesarrollo){
        $this->oficinaPlanDesarrollo=$oficinaPlanDesarrollo;
    } 
    

}
?>