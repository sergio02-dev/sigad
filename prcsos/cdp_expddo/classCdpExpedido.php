<?php
/**
 * Karen Yuliana Palacio Minú
 * 09 de Junio 2022 09.27 a.m
 * Clase CDP
 */
Class CdpExpedido {
    private $codigo;
    private $codigoSolicitud;
    private $fecha;
    private $numero;
    private $estado;
    private $personaSistema;
    
    public function getCodigo(){
        return $this->codigo;
    } 
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function setCodigoSolicitud($codigoSolicitud){
        $this->codigoSolicitud=$codigoSolicitud;
    }
    public function getCodigoSolicitud(){
        return $this->codigoSolicitud;
    }

    public function setFecha($fecha){
        $this->fecha=$fecha;
    }
    public function getFecha(){
        return $this->fecha;
    } 

    public function seNumero($numero){
        $this->numero=$numero;
    }
    public function getNumero(){
        return $this->numero;
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