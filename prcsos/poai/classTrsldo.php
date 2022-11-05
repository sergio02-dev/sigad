<?php
/**
 * Karen Yuliana Palacio Minú
 * 16 de Marzo 2022 11.58am
 * Clase Traslados POAI
 */
Class TrasladosPOAI {
    private $codigo;
    private $poai;
    private $accion;
    private $acuerdo;
    private $recurso;
    private $sede;
    private $indicador;
    private $saldo;
    private $estado;
    private $personaSistema;
    
    public function getCodigo(){
        return $this->codigo;
    } 
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function getPoai(){
        return $this->poai;
    } 
    public function setPoai($poai){
        $this->poai = $poai;
    }
    
    public function getAccion(){
        return $this->accion;
    } 
    public function setAccion($accion){
        $this->accion = $accion;
    }

    public function getAcuerdo(){
        return $this->acuerdo;
    } 
    public function setAcuerdo($acuerdo){
        $this->acuerdo = $acuerdo;
    }

    public function getRecurso(){
        return $this->recurso;
    } 
    public function setRecurso($recurso){
        $this->recurso = $recurso;
    }

    public function getSede(){
        return $this->sede;
    } 
    public function setSede($sede){
        $this->sede = $sede;
    }

    public function getIndicador(){
        return $this->indicador;
    } 
    public function setIndicador($indicador){
        $this->indicador = $indicador;
    }
    
    public function getSaldo(){
        return $this->saldo;
    } 
    public function setSaldo($saldo){
        $this->saldo = $saldo;
    }

    public function getEstado(){
        return $this->estado;
    } 
    public function setEstado($estado){
        $this->estado = $estado;
    }
    
    public function getPersonaSistema(){
        return $this->personaSistema;
    } 
    public function setPersonaSistema($personaSistema){
        $this->personaSistema = $personaSistema;
    }
    
}
?>