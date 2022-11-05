<?php
class ActoAdministrativo{

    private $codigoActoAdministrativo;
    private $nombreActoAdministrativo;
    private $tipoActoAdministrativo;
    private $vigenciaActoAdministrativo;
    private $urlActoAdministrativo;
    private $personaActoAdministrativo;
    private $descripcionActoAdministrativo;
    private $acuerdoPapa;
    

    public function getDescripcionActoAdministrativo(){
        return $this->descripcionActoAdministrativo;
    } 

    public function setDescripcionActoAdministrativo($descripcionActoAdministrativo){
        $this->descripcionActoAdministrativo=$descripcionActoAdministrativo;
    } 

    public function getAcuerdoPapa(){
        return $this->acuerdoPapa;
    } 

    public function setAcuerdoPapa($acuerdoPapa){
        $this->acuerdoPapa=$acuerdoPapa;
    } 

    public function getCodigoActoAdministrativo(){
        return $this->codigoActoAdministrativo;
    } 

    public function setCodigoActoAdministrativo($codigoActoAdministrativo){
        $this->codigoActoAdministrativo=$codigoActoAdministrativo;
    } 

    public function getNombreActoAdministrativo(){
        return $this->nombreActoAdministrativo;
    } 

    public function setNombreActoAdministrativo($nombreActoAdministrativo){
        $this->nombreActoAdministrativo=$nombreActoAdministrativo;
    }
    
    public function getTipoActoAdministrativo(){
        return $this->tipoActoAdministrativo;
    } 

    public function setTipoActoAdministrativo($tipoActoAdministrativo){
        $this->tipoActoAdministrativo=$tipoActoAdministrativo;
    }

    public function getVigenciaActoAdministrativo(){
        return $this->vigenciaActoAdministrativo;
    } 

    public function setVigenciaActoAdministrativo($vigenciaActoAdministrativo){
        $this->vigenciaActoAdministrativo=$vigenciaActoAdministrativo;
    }

    public function getUrlActoAdministrativo(){
        return $this->urlActoAdministrativo;
    } 

    public function setUrlActoAdministrativo($urlActoAdministrativo){
        $this->urlActoAdministrativo=$urlActoAdministrativo;
    }
    
    public function getPersonaActoAdministrativo(){
        return $this->personaActoAdministrativo;
    } 

    public function setPersonaActoAdministrativo($personaActoAdministrativo){
        $this->personaActoAdministrativo=$personaActoAdministrativo;
    } 
}
?>