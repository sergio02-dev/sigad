<?php 
Class Delegado{
    private $codigoDelegado;
    private $codigoAccion;
    private $responsable;
    private $codigoPersona;
    private $nombrePersona;
    private $primerApellidoPersona;
    private $segundoApellidoPersona;
    private $generoPersona;
    private $tipoIdentificacionPersona;
    private $identificacionPersona;
    private $estadoPersona;


    public function getCodigoDelegado(){
        return $this->codigoDelegado;
    } 

    public function setCodigoDelegado($codigoDelegado){
        $this->codigoDelegado=$codigoDelegado;
    }

    public function getCodigoAccion(){
        return $this->codigoAccion;
    } 

    public function setCodigoAccion($codigoAccion){
        $this->codigoAccion=$codigoAccion;
    }

    public function getResponsable(){
        return $this->responsable;
    } 

    public function setResponsable($responsable){
        $this->responsable=$responsable;
    }

    public function getCodigoPersona(){
        return $this->codigoPersona;
    }
    public function setCodigoPersona($codigoPersona){
        $this->codigoPersona=$codigoPersona;
    }
    
    public function getNombrePersona(){
        return $this->nombrePersona;
    }
    public function setNombrePersona($nombrePerosna){
        $this->nombrePersona=$nombrePerosna;
    }

    public function getPrimerApellidoPersona(){
        return $this->primerApellidoPersona;
    }
    public function setPrimerApellidoPersona($primerApellidoPersona){
        $this->primerApellidoPersona=$primerApellidoPersona;
    }

    public function getSegundoApellidoPersona(){
        return $this->segundoApellidoPersona;
    }
    public function setSegundoApellidoPersona($segundoApellidoPersona){
        $this->segundoApellidoPersona=$segundoApellidoPersona;
    }

    public function getGeneroPersona(){
        return  $this->segundoApellidoPersona;
    }
    public function setGeneroPersona($generoPersona){
        $this->generoPersona=$generoPersona;
    }

    public function getTipoIdentificacionPersona(){
        return  $this->tipoIdentificacionPersona;
    }
    public function setTipoIdentificacionPersona($tipoIdentificacionPersona){
        $this->tipoIdentificacionPersona=$tipoIdentificacionPersona;
    }

    public function getIdentificacionPersona(){
        return  $this->identificacionPersona;
    }
    public function setIdentificacionPersona($identificacionPersona){
        $this->identificacionPersona=$identificacionPersona;
    }

    public function getEstadoPersona(){
        return $this->estadoPersona;
    }
    public function setEstadoPersona($estadoPersona){
        $this->estadoPersona=$estadoPersona;
    }
}

?>