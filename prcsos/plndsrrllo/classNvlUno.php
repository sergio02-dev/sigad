<?php
class NivelUno{
    private $codigoNivelUno;
    private $nombreNivelUno;
    private $actoAdminNivenUno;
    private $planDesarrolloNivelUno;
    private $referenciaNivelUno;
    private $personaSistemaNivelUno;
    private $ref;
    private $responsable;
    private $oficina;
    private $cargo;
    private $codigoLevel;
    private $tipoResponsable;

    public function getCodigoNivelUno(){
        return $this->codigoNivelUno;
    } 

    public function setCodigoNivelUno($codigoNivelUno){
        $this->codigoNivelUno=$codigoNivelUno;
    } 

    public function getNombreNivelUno(){
        return $this->nombreNivelUno;
    } 

    public function setNombreNivelUno($nombreNivelUno){
        $this->nombreNivelUno=$nombreNivelUno;
    }
    
    public function getActoAdminNivelUno(){
        return $this->actoAdminNivenUno;
    } 

    public function setActoAdminNivelUno($actoAdminNivenUno){
        $this->actoAdminNivenUno=$actoAdminNivenUno;
    }
    
    public function getPlanDesarrolloNivelUno(){
        return $this->planDesarrolloNivelUno;
    } 

    public function setPlanDesarrolloNivelUno($planDesarrolloNivelUno){
        $this->planDesarrolloNivelUno=$planDesarrolloNivelUno;
    }

    public function getRefereciaNivelUno(){
        return $this->referenciaNivelUno;
    } 

    public function setReferenciaNivelUno($referenciaNivelUno){
        $this->referenciaNivelUno=$referenciaNivelUno;
    }
    
    public function getPersonaSistemaNivelUno(){
        return $this->personaSistemaNivelUno;
    } 

    public function setPersonaSistemaNivelUno($personaSistemaNivelUno){
        $this->personaSistemaNivelUno=$personaSistemaNivelUno;
    } 

    public function getRef(){
        return $this->ref;
    } 

    public function setRef($ref){
        $this->ref=$ref;
    }

    public function getResponsable(){
        return $this->responsable;
    } 
    public function setResponsable($responsable){
        $this->responsable=$responsable;
    }

    public function getOficina(){
        return $this->oficina;
    } 
    public function setOficina($oficina){
        $this->oficina=$oficina;
    }

    public function getCargo(){
        return $this->cargo;
    } 
    public function setCargo($cargo){
        $this->cargo=$cargo;
    }
    
    public function getCodigoLevel(){
        return $this->codigoLevel;
    } 
    public function setCodigoLevel($codigoLevel){
        $this->codigoLevel=$codigoLevel;
    }
    
    public function getTipoResponsable(){
        return $this->tipoResponsable;
    } 
    public function setTipoResponsable($tipoResponsable){
        $this->tipoResponsable=$tipoResponsable;
    }
}
?>