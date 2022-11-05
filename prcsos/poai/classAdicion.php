<?php
/**
 * Karen Yuliana Palacio Minú
 * 20 de Marzo 2022 03:39pm
 * Clase AdicionPoai
 */
Class AdicionPOAI {
    private $codigo;
    private $codigoPoai;
    private $codigoSaldo;
    private $recurso;
    private $estado;
    private $personaSistema;
    
    public function getCodigo(){
        return $this->codigo;
    } 
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    
    public function getCodigoPoai(){
        return $this->codigoPoai;
    } 
    public function setCodigoPoai($codigoPoai){
        $this->codigoPoai = $codigoPoai;
    }

    public function getCodigoSaldo(){
        return $this->codigoSaldo;
    } 
    public function setCodigoSaldo($codigoSaldo){
        $this->codigoSaldo = $codigoSaldo;
    }

    public function getRecurso(){
        return $this->recurso;
    } 
    public function setRecurso($recurso){
        $this->recurso = $recurso;
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