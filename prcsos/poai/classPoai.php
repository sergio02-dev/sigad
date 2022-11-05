<?php
/**
 * Karen Yuliana Palacio Minú
 * 16 de Marzo 2022 11.58am
 * Clase POAI
 */
Class POAI {
    private $codigo;
    private $accion;
    private $fuente;
    private $sede;
    private $recurso;
    private $vigencia;
    private $estado;
    private $indicador;
    private $personaSistema;
    private $adicion;
    private $acuerdo;
    
    public function getCodigo(){
        return $this->codigo;
    } 
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    
    public function getAccion(){
        return $this->accion;
    } 
    public function setAccion($accion){
        $this->accion = $accion;
    }

    public function getFuente(){
        return $this->fuente;
    } 
    public function setFuente($fuente){
        $this->fuente = $fuente;
    }

    public function getSede(){
        return $this->sede;
    } 
    public function setSede($sede){
        $this->sede = $sede;
    }

    public function getRecurso(){
        return $this->recurso;
    } 
    public function setRecurso($recurso){
        $this->recurso = $recurso;
    }
    
    public function getVigencia(){
        return $this->vigencia;
    } 
    public function setVigencia($vigencia){
        $this->vigencia = $vigencia;
    }

    public function getEstado(){
        return $this->estado;
    } 
    public function setEstado($estado){
        $this->estado = $estado;
    }
    
    public function getIndicador(){
        return $this->indicador;
    } 
    public function setIndicador($indicador){
        $this->indicador = $indicador;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 
    public function setPersonaSistema($personaSistema){
        $this->personaSistema = $personaSistema;
    }
   
    public function getAdicion(){
        return $this->adicion;
    } 
    public function setAdicion($adicion){
        $this->adicion = $adicion;
    }
    public function getAcuerdo(){
        return $this->acuerdo;
    } 
    public function setAcuerdo($acuerdo){
        $this->acuerdo = $acuerdo;
    }
}
?>