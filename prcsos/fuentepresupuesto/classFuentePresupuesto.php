<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 * 24 de enero 2023 15:41pm
 * Clase Fuente presupuesto
 */
Class FuentePresupuesto {
    private $codigo;
    private $nombre;
    private $codigoLinix;
    private $estado;
    private $personaSistema;
    private $facultad;

    public function getFacultad(){
        return $this->facultad;
    } 
    public function setFacultad($facultad){
        $this->facultad=$facultad;
    }



    
    public function getCodigo(){
        return $this->codigo;
    } 
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

      
    public function getCodigoLinix(){
        return $this->codigoLinix;
    } 
    public function setCodigoLinix($codigoLinix){
        $this->codigoLinix=$codigoLinix;
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