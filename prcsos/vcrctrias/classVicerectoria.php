<?php
/**
 * Karen Yuliana Palacio Minú
 * 14 de Noviembre 2022 12:26pm
 * Clase Vicerrectoria
 */
Class Vicerrectoria {
    private $codigo;
    private $nombre;
    //private $sedes;
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

   /* public function setSedes($sedes){
        $this->sedes=$sedes;
    }
    public function getSedes(){
        return $this->sedes;
    }*/

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }

}
?>