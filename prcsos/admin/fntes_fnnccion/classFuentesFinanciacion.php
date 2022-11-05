<?php
/**
 * Karen Yuliana Palacio Minú
 * 23 de Diciembre 2021 10.56am
 * Clase Fuentes Financiacion
 */
Class FuentesFinanciacion {
    private $codigo;
    private $nombre;
    private $personaSistema;
    private $descripcion;
    private $tipo;
    private $estado;
    private $clasificacion;
    private $codigoLinix;
    private $referenciaLinix; 
    private $clasificacionPlaneacion; 
    
    public function getCodigo(){
        return $this->codigo;
    } 
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function getNombre(){
        return $this->nombre;
    } 

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }

    public function getDescripcion(){
        return $this->descripcion;
    } 
    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }

    public function getTipo(){
        return $this->tipo;
    } 
    public function setTipo($tipo){
        $this->tipo=$tipo;
    }

    public function getEstado(){
        return $this->estado;
    } 
    public function setEstado($estado){
        $this->estado=$estado;
    }

    public function getClasificacion(){
        return $this->clasificacion;
    } 
    public function setClasificacion($clasificacion){
        $this->clasificacion=$clasificacion;
    }

    public function getCodigoLinix(){
        return $this->codigoLinix;
    } 
    public function setCodigoLinix($codigoLinix){
        $this->codigoLinix=$codigoLinix;
    }

    public function getReferenciaLinix(){
        return $this->referenciaLinix;
    } 
    public function setReferenciaLinix($referenciaLinix){
        $this->referenciaLinix=$referenciaLinix;
    }
    
    
    public function getClasificacionPlaneacion(){
        return $this->clasificacionPlaneacion;
    } 
    public function setClasificacionPlaneacion($clasificacionPlaneacion){
        $this->clasificacionPlaneacion=$clasificacionPlaneacion;
    }
}
?>