<?php
Class EquipoPdi {
    private $codigo;
    private $equipoNombre;
    private $codigoCaracteristica;
    private $caracteristicaNombre;
    private $codigoSublinea;
    private $personaSistema;
    private $codigoCtic;
    private $valorunitario;

    
    public function getValorunitario(){
        return $this->valorunitario;
    } 
    public function setValorunitario($valorunitario){
        $this->valorunitario=$valorunitario;
    }
    
    public function getCodigoCtic(){
        return $this->codigoCtic;
    } 
    public function setCodigoCtic($codigoCtic){
        $this->codigo=$codigoCtic;
    }
    
    public function getCodigo(){
        return $this->codigo;
    } 
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function getEquipoNombre(){
        return $this->equipoNombre;
    } 
    public function setEquipoNombre($equipoNombre){
        $this->equipoNombre=$equipoNombre;
    }

    public function getCodigoCaracteristica(){
        return $this->codigoCaracteristica;
    } 
    public function setCodigoCaracteristica($codigoCaracteristica){
        $this->codigoCaracteristica=$codigoCaracteristica;
    }
    public function getCaracteristicaNombre(){
        return $this->caracteristicaNombre;
    } 
    public function setCaracteristicaNombre($caracteristicaNombre){
        $this->caracteristicaNombre=$caracteristicaNombre;
    }
    public function getCodigoSublinea(){
        return $this->codigoSublinea;
    } 
    public function setCodigoSublinea($codigoSublinea){
        $this->codigoSublinea=$codigoSublinea;
    }
    public function getPersonaSistema(){
        return $this->personaSistema;
    } 
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }
}
?>