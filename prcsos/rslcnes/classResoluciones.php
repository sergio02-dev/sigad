<?php
/**
 * Karen Yuliana Palacio Minú
 * 02 de Agosto 2021 10.13am
 * Clase Resoluciones
 */
Class Resoluciones {
    private $codigoResolucion;
    private $nombreResolucion;
    private $vigenciaResolucion;
    private $urlResolucion;
    private $personaSistema;
    private $acuerdo;
    private $descripcion;
    
    public function getCodigoResolucion(){
        return $this->codigoResolucion;
    } 

    public function setCodigoResolucion($codigoResolucion){
        $this->codigoResolucion=$codigoResolucion;
    }

    public function getTipoResolucion(){
        return $this->tipoResolucion;
    } 

    public function setNombreResolucion($nombreResolucion){
        $this->nombreResolucion=$nombreResolucion;
    }

    public function getNombreResolucion(){
        return $this->nombreResolucion;
    } 

    public function setVigenciaResolucion($vigenciaResolucion){
        $this->vigenciaResolucion=$vigenciaResolucion;
    }

    public function getVigenciaResolucion(){
        return $this->vigenciaResolucion;
    } 

    public function setUrlResolucion($urlResolucion){
        $this->urlResolucion=$urlResolucion;
    }

    public function getUrlResolucion(){
        return $this->urlResolucion;
    } 

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 

    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }

    public function getAcuerdo(){
        return $this->acuerdo;
    } 

    public function setAcuerdo($acuerdo){
        $this->acuerdo=$acuerdo;
    }

    public function getDescripcion(){
        return $this->descripcion;
    } 

    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }
    

}
?>