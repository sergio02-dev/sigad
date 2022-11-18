<?php
/**
 * Sergio Stewar Sánchez Salazar
 * 17 de Noviembre 2022 10:52pm
 * Clase Facultades
 */
Class Facultades {
    private $codigo;
    private $nombre;
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

    public function setEstado($estado){
        $this->estado=$estado;
    }
    public function getEstado(){
        return $this->estado;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }

}
?>