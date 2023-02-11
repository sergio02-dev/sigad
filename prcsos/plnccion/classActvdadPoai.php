<?php
Class ActividadPoai{

    private $personaSistema;
    private $codigoActividad;
    private $codigoSubsistema;
    private $codigoProyecto;
    private $codigoAccion;
    private $referenciaAccion;
    private $selActividad;
    private $estado;
    private $vigenciaActividad;
    private $objetivo;
    private $sede;
    private $unidad;
    private $arrayIndicadores;

    public function setArrayIndicadores($arrayIndicadores){
        $this->arrayIndicadores=$arrayIndicadores;
    }
    public function getArrayIndicadores(){
        return $this->arrayIndicadores;
    } 

    public function ActividadPoai(){}

    public function getCodigoActividad(){
        return $this->codigoActividad;
    }

    public function setCodigoActividad($codigoActividad){
        $this->codigoActividad=$codigoActividad;
    }
    public function getCodigoSubsistema(){
        return $this->codigoSubsistema;
    }

    public function setCodigoSubsistema($codigoSubsistema){
        $this->codigoSubsistema=$codigoSubsistema;
    }

    public function getCodigoProyecto(){
        return $this->codigoProyecto;
    }

    public function setCodigoProyecto($codigoProyecto){
        $this->codigoProyecto=$codigoProyecto;

    }

    public function getCodigoAccion(){
        return $this->codigoAccion;
    }

    public function setCodigoAccion($codigoAccion){
        $this->codigoAccion=$codigoAccion;
    }

    public function getReferencia(){
        return $this->referenciaAccion;
    }

    public function setReferencia($referenciaAccion){
        $this->referenciaAccion=$referenciaAccion;
    }

    public function getNombreActividad(){
        return $this->selActividad;
    }

    public function setNombreActividad($selActividad){
        $this->selActividad=$selActividad;
    }

    public function getVigenciaActividad(){
        return $this->vigenciaActividad;
    }

    public function setVigenciaActividad($vigenciaActividad){
        $this->vigenciaActividad=$vigenciaActividad;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado=$estado;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    }

    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }
    
    public function getObjetivo(){
        return $this->objetivo;
    }

    public function setObjetivo($objetivo){
        $this->objetivo=$objetivo;
    }
    
    public function getSede(){
        return $this->sede;
    }

    public function setSede($sede){
        $this->sede=$sede;
    }
    

    public function getUnidad(){
        return $this->unidad;
    }

    public function setUnidad($unidad){
        $this->unidad=$unidad;
    }
}
?>
