<?php 
Class Indicador{

    private $codigoIndicador;
    private $indicador;
    private $lineaBase;
    private $metaResultado;
    private $vigencia;
    private $tendenciaPositiva;
    private $comportamiento;
    private $unidad;
    private $presupuesto;
    private $personaSistema;
    private $codigoAccion;
    private $totalInsert;
    private $sede;

    public function getCodigoIndicador(){
        return $this->codigoIndicador;
    } 

    public function setCodigoIndicador($codigoIndicador){
        $this->codigoIndicador=$codigoIndicador;
    }

    public function getIndicador(){
        return $this->indicador;
    } 

    public function setIndicador($indicador){
        $this->indicador=$indicador;
    }

    public function getLineaBase(){
        return $this->lineaBase;
    } 

    public function setLineaBase($lineaBase){
        $this->lineaBase=$lineaBase;
    }

    public function getMetaResultado(){
        return $this->metaResultado;
    } 

    public function setMetaResultado($metaResultado){
        $this->metaResultado=$metaResultado;
    } 

    public function getVigencia(){
        return $this->vigencia;
    } 

    public function setVigencia($vigencia){
        $this->vigencia=$vigencia;
    } 

    public function getTendenciaPositiva(){
        return $this->tendenciaPositiva;
    } 

    public function setTendenciaPositiva($tendenciaPositiva){
        $this->tendenciaPositiva=$tendenciaPositiva;
    }

    public function getComportamiento(){
        return $this->comportamiento;
    } 

    public function setComportamiento($comportamiento){
        $this->comportamiento=$comportamiento;
    } 

    public function getUnidad(){
        return $this->unidad;
    } 

    public function setUnidad($unidad){
        $this->unidad=$unidad;
    }

    public function getPresupuesto(){
        return $this->presupuesto;
    } 

    public function setPresupuesto($presupuesto){
        $this->presupuesto=$presupuesto;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 

    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }

    public function getCodigoAccion(){
        return $this->codigoAccion;
    } 

    public function setCodigoAccion($codigoAccion){
        $this->codigoAccion=$codigoAccion;
    }

    public function getTotalInsert(){
        return $this->totalInsert;
    } 

    public function setTotalInsert($totalInsert){
        $this->totalInsert=$totalInsert;
    }

    public function getSede(){
        return $this->sede;
    } 

    public function setSede($sede){
        $this->sede=$sede;
    }
}


?>