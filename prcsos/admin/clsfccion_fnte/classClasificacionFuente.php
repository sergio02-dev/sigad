<?php
/**
 * Karen Yuliana Palacio Minú
 * 10 de Enero 2022 02.23pm
 * Clase Clasificacion Financiacion
 */
Class ClasificacionFuente {
    private $codigo;
    private $nombre;
    private $descripcion;
    private $estado;
    private $personaSistema;
    
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

    public function getDescripcion(){
        return $this->descripcion;
    } 

    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
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
}
?>