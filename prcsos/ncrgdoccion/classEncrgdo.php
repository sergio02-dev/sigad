<?php 
class Encargado{
    private $codigoEncargado;
    private $codigoPersona;
    private $codigoAccion;
    private $cantidadInsert;
    private $personaSistema;

    public function getCodigoEncargado(){
        return $this->codigoEncargado;
    }

    public function setCodigoEncargado($codigoEncargado){
        $this->codigoEncargado=$codigoEncargado;
    }

    public function getCodigoPersona(){
        return $this->codigoPersona;
    }

    public function setCodigoPersona($codigoPersona){
        $this->codigoPersona=$codigoPersona;
    }

    public function getCodigoAccion(){
        return $this->codigoAccion;
    }

    public function setCodigoAccion($codigoAccion){
        $this->codigoAccion=$codigoAccion;
    }

    public function getCantidadInsert(){
        return $this->cantidadInsert;
    }

    public function setCantidadInsert($cantidadInsert){
        $this->cantidadInsert=$cantidadInsert;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    }

    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }

}
?>