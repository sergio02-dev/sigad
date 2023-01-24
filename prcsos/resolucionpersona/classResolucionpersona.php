<?php
Class ResolucionPersona {
    private $codigo;
    private $codigoresolucion;
    private $fecha;
    private $persona;
    private $estado;
    private $personaSistema;
    
    public function getCodigo(){
        return $this->codigo;
    } 
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }


    public function setFecha($fecha){
        $this->fecha=$fecha;
    }
    public function getFecha(){
        return $this->fecha;
    } 

    public function setEstado($estado){
        $this->estado=$estado;
    }
    public function getEstado(){
        return $this->estado;
    }

    public function getPersona(){
        return $this->persona;
    } 
    public function setPersona($persona){
        $this->persona=$persona;
    }
    public function getCodigoResolucion(){
        return $this->codigoresolucion;
    } 
    public function setCodigoResolucion($codigoresolucion){
        $this->codigoresolucion=$codigoresolucion;
    }
    public function getPersonaSistema(){
        return $this->personaSistema;
    } 
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }
}
?>