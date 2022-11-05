<?php
/**
 * Karen Yuliana Palacio Minú
 * 27 de Mayo 2021 05:48pm
 *  Clase Reporte Actividad Etapa
 */
Class ReporteActividadEtapa {
    private $codigo;
    private $codigoCertificado;
    private $codigoActividad;
    private $codigoEtapa;
    private $tipoActividad;
    private $numeroVeces;
    private $logro;
    private $personaSistema;
    
    public function getCodigo(){
        return $this->codigo;
    } 

    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function getCodigoCertificado(){
        return $this->codigoCertificado;
    } 

    public function setCodigoCertificado($codigoCertificado){
        $this->codigoCertificado=$codigoCertificado;
    }

    public function getCodigoActividad(){
        return $this->codigoActividad;
    } 

    public function setCodigoActividad($codigoActividad){
        $this->codigoActividad=$codigoActividad;
    }

    public function getCodigoEtapa(){
        return $this->codigoEtapa;
    } 

    public function setCodigoEtapa($codigoEtapa){
        $this->codigoEtapa=$codigoEtapa;
    }

    public function getTipoActividad(){
        return $this->tipoActividad;
    } 

    public function setTipoActividad($tipoActividad){
        $this->tipoActividad=$tipoActividad;
    }

    public function getNumeroVeces(){
        return $this->numeroVeces;
    } 

    public function setNumeroVeces($numeroVeces){
        $this->numeroVeces=$numeroVeces;
    }

    public function getLogro(){
        return $this->logro;
    } 

    public function setLogro($logro){
        $this->logro=$logro;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 

    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }


}
?>