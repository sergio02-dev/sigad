<?php
/**
 * Karen Yuliana Palacio Minú
 * 03 de Febrero 2022 11:32am
 * Clase Solicitud CDP
 */
Class SolicitudCdp {
    private $codigo;
    private $fecha;
    private $codigoSolicitud;
    private $accion;
    private $estado;
    private $otroValor;
    private $valorCdp;
    private $arrayDatos;
    private $fuentesFinanciacion;
    private $codigoPresupuesto;
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

    public function setCodigoSolicitud($codigoSolicitud){
        $this->codigoSolicitud=$codigoSolicitud;
    }
    public function getCodigoSolicitud(){
        return $this->codigoSolicitud;
    }

    public function setAccion($accion){
        $this->accion=$accion;
    }
    public function getAccion(){
        return $this->accion;
    } 

    public function setArrayDatos($arrayDatos){
        $this->arrayDatos=$arrayDatos;
    }
    public function getArrayDatos(){
        return $this->arrayDatos;
    } 

    public function setEstado($estado){
        $this->estado=$estado;
    }
    public function getEstado(){
        return $this->estado;
    }

    public function setOtroValor($otroValor){
        $this->otroValor=$otroValor;
    }
    public function getOtroValor(){
        return $this->otroValor;
    }
   
    public function setValorCdp($valorCdp){
        $this->valorCdp=$valorCdp;
    }
    public function getValorCdp(){
        return $this->valorCdp;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }

    public function getFuentesFinanciacion(){
        return $this->fuentesFinanciacion;
    } 
    public function setFuentesFinanciacion($fuentesFinanciacion){
        $this->fuentesFinanciacion=$fuentesFinanciacion;
    }

    public function getCodigoPresupuesto(){
        return $this->codigoPresupuesto;
    } 
    public function setCodigoPresupuesto($codigoPresupuesto){
        $this->codigoPresupuesto=$codigoPresupuesto;
    }
}
?>