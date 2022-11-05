<?php
/**
 * Karen Yuliana Palacio Minú
 * 25 de Abril 2022 12.24pm
 * Clase Asignacion Recursos
 */
Class AsignacionRecursoss {
    private $codigo;
    private $etapaAsignacion;
    private $accion;
    private $fuente;
    private $indicador;
    private $vigenciaRecurso;
    private $vigenciaPoai;
    private $recurso;
    private $estado;
    private $tipo;
    private $personaSistema;

    public function AsignacionRecursos(){}

    public function getCodigo(){
        return $this->codigo;
    } 
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function getEtapaAsignacion(){
        return $this->etapaAsignacion;
    }
    public function setEtapaAsignacion($etapaAsignacion){
        $this->etapaAsignacion=$etapaAsignacion;
    }

    public function getAccion(){
        return $this->accion;
    }
    public function setAccion($accion){
        $this->accion=$accion;
    }
    
    public function getFuente(){
        return $this->fuente;
    }
    public function setFuente($fuente){
        $this->fuente=$fuente;
    }
    
    public function getIndicador(){
        return $this->indicador;
    }
    public function setIndicador($indicador){
        $this->indicador=$indicador;
    }
    
    public function getVigenciaRecurso(){
        return $this->vigenciaRecurso;
    }
    public function setVigenciaRecurso($vigenciaRecurso){
        $this->vigenciaRecurso=$vigenciaRecurso;
    }
    
    public function getVigenciaPoai(){
        return $this->vigenciaPoai;
    }
    public function setVigenciaPoai($vigenciaPoai){
        $this->vigenciaPoai=$vigenciaPoai;
    }
    
    public function getRecurso(){
        return $this->recurso;
    }
    public function setRecurso($recurso){
        $this->recurso=$recurso;
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
    
    public function getTipo(){
        return $this->tipo;
    } 
    public function setTipo($tipo){
        $this->tipo=$tipo;
    }
}
?>