<?php
class NivelDos{

    private $codigoNivelDos;
    private $nombreNivelDos;
    private $actoAdminNivelDos;
    private $referenciaNivelDos;
    private $personaSistemaNivelDos;
    private $codigoNivelUno;
    private $numeroNivelDos;
    private $objetivo;
    private $responsable;
    
    

    public function getCodigoNivelDos(){
        return $this->codigoNivelDos;
    } 

    public function setCodigoNivelDos($codigoNivelDos){
        $this->codigoNivelDos=$codigoNivelDos;
    }

    public function getNombreNivelDos(){
        return $this->nombreNivelDos;
    } 

    public function setNombreNivelDos($nombreNivelDos){
        $this->nombreNivelDos=$nombreNivelDos;
    }
    
    public function getActoAdminNivelDos(){
        return $this->actoAdminNivelDos;
    } 

    public function setActoAdminNivelDos($actoAdminNivelDos){
        $this->actoAdminNivelDos=$actoAdminNivelDos;
    }
    
    public function getRefeneciaNivelDos(){
        return $this->referenciaNivelDos;
    } 

    public function setReferenciaNivelDos($referenciaNivelDos){
        $this->referenciaNivelDos=$referenciaNivelDos;
    }
    
    public function getPersonaSistemaNivelDos(){
        return $this->personaSistemaNivelDos;
    } 

    public function setPersonaSistemaNivelDos($personaSistemaNivelDos){
        $this->personaSistemaNivelDos=$personaSistemaNivelDos;
    } 

    public function getCodigoNivelUno(){
        return $this->codigoNivelUno;
    } 

    public function setCodigoNivelUno($codigoNivelUno){
        $this->codigoNivelUno=$codigoNivelUno;
    } 

    public function getNumeroNivelDos(){
        return $this->numeroNivelDos;
    } 

    public function setNumeroNivelDos($numeroNivelDos){
        $this->numeroNivelDos=$numeroNivelDos;
    } 

    public function getObjetivo(){
        return $this->objetivo;
    } 

    public function setObjetivo($objetivo){
        $this->objetivo=$objetivo;
    } 

    public function getResponsable(){
        return $this->responsable;
    } 

    public function setResponsable($responsable){
        $this->responsable=$responsable;
    }
    
}
?>