<?php
/**
 * Karen Yuliana Palacio Minú
 * 14 de Marzo 2022 03.21pm
 * Clase Fuente de Financiación
 */
Class SaldoFuenteFinanciacion {
    private $codigo;
    private $vigencia;
    private $fuenteFinanciacion;
    private $saldo;
    private $estado;
    private $acuerdo;
    private $personaSistema;
    
    public function getCodigo(){
        return $this->codigo;
    } 
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function setVigencia($vigencia){
        $this->vigencia=$vigencia;
    }
    public function getVigencia(){
        return $this->vigencia;
    } 

    public function setFuenteFinanciacion($fuenteFinanciacion){
        $this->fuenteFinanciacion=$fuenteFinanciacion;
    }
    public function getFuenteFinanciacion(){
        return $this->fuenteFinanciacion;
    }

    public function setSaldo($saldo){
        $this->saldo=$saldo;
    }
    public function getSaldo(){
        return $this->saldo;
    }

    public function setEstado($estado){
        $this->estado=$estado;
    }
    public function getEstado(){
        return $this->estado;
    }
    
    public function setAcuerdo($acuerdo){
        $this->acuerdo=$acuerdo;
    }
    public function getAcuerdo(){
        return $this->acuerdo;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }
}
?>