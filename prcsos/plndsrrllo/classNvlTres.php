<?php
class NivelTres{

    private $codigo;
    private $referencia;
    private $descripcion;
    private $responsable;
    private $lineaBase;
    private $metaResultado;
    private $actoAdmin;
    private $numeroVigencia;
    private $comportamiento;
    private $tendenciaPositiva;
    private $indicador;
    private $numero;
    private $codigoNivelDos;
    private $personaSistema;
    private $planCompras;
    private $plantaFisica;
       

    public function getCodigo(){
        return $this->codigo;
    } 

    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function getReferencia(){
        return $this->referencia;
    } 

    public function setReferencia($referencia){
        $this->referencia=$referencia;
    }
    
    public function getDescripcion(){
        return $this->descripcion;
    } 

    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }
    
    public function getResponsable(){
        return $this->responsable;
    } 
    public function setResponsable($responsable){
        $this->responsable=$responsable;
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

    public function getActoAdmin(){
        return $this->actoAdmin;
    } 

    public function setActoAdmin($actoAdmin){
        $this->actoAdmin=$actoAdmin;
    } 

    public function getNumeroVigencia(){
        return $this->numeroVigencia;
    } 

    public function setNumeroVigencia($numeroVigencia){
        $this->numeroVigencia=$numeroVigencia;
    } 

    public function getComportamiento(){
        return $this->comportamiento;
    } 

    public function setComportamiento($comportamiento){
        $this->comportamiento=$comportamiento;
    } 

    public function getTendenciaPositiva(){
        return $this->tendenciaPositiva;
    } 

    public function setTendenciaPositiva($tendenciaPositiva){
        $this->tendenciaPositiva=$tendenciaPositiva;
    }
    
    public function getIndicador(){
        return $this->indicador;
    } 

    public function setIndicador($indicador){
        $this->indicador=$indicador;
    }

    public function getNumero(){
        return $this->numero;
    } 

    public function setNumero($numero){
        $this->numero=$numero;
    }

    public function getCodigoNivelDos(){
        return $this->codigoNivelDos;
    } 

    public function setCodigoNivelDos($codigoNivelDos){
        $this->codigoNivelDos=$codigoNivelDos;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 

    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }

    public function getPlanCompras(){
        return $this->planCompras;
    } 

    public function setPlanCompras($planCompras){
        $this->planCompras=$planCompras;
    }

    public function getPlantaFisica(){
        return $this->plantaFisica;
    } 
    public function setPlantaFisica($plantaFisica){
        $this->plantaFisica=$plantaFisica;
    }


}
?>