<?php
/**
 * Karen Yuliana Palacio Minú
 * 21 de Noviembre 2019 6:34 am
 *  Clase Apertura Reporte
 */
Class Apertura {
    private $codigoApertura;
    private $fechaInicio;
    private $fechaFin;
    private $trimestre;
    private $trim;
    private $personaSistema;
    
    public function getCodigoApertura(){
        return $this->codigoApertura;
    } 

    public function setCodigoApertura($codigoApertura){
        $this->codigoApertura=$codigoApertura;
    }

    public function getFechaInicio(){
        return $this->fechaInicio;
    } 

    public function setFechaInicio($fechaInicio){
        $this->fechaInicio=$fechaInicio;
    }

    public function getFechaFin(){
        return $this->fechaFin;
    } 

    public function setFechaFin($fechaFin){
        $this->fechaFin=$fechaFin;
    }

    public function getTrimestre(){
        return $this->trimestre;
    } 

    public function setTrimestre($trimestre){
        $this->trimestre=$trimestre;
    }

    public function getTrim(){
        return $this->trim;
    } 

    public function setTrim($trim){
        $this->trim=$trim;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 

    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }


}
?>