<?php
/**
 * Karen Yuliana Palacio Minú
 * 03 de Enero 2021 02.32pm
 * Clase PPI
 */
Class Ppi {
    private $arrayDatos;
    private $personaSistema;
    private $codigoPpi;
    private $valor;
    private $anio;
    
    public function getArrayDatos(){
        return $this->arrayDatos;
    } 

    public function setArrayDatos($arrayDatos){
        $this->arrayDatos = $arrayDatos;
    }
    
    public function getPersonaSistema(){
        return $this->personaSistema;
    } 

    public function setPersonaSistema($personaSistema){
        $this->personaSistema = $personaSistema;
    }

    public function getCodigoPpi(){
        return $this->codigoPpi;
    } 

    public function setCodigoPpi($codigoPpi){
        $this->codigoPpi = $codigoPpi;
    }

    public function getValor(){
        return $this->valor;
    } 

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getAnio(){
        return $this->anio;
    } 

    public function setAnio($anio){
        $this->anio = $anio;
    }
}
?>