<?php
/**
 * Karen Yuliana Palacio Minú
 * 02 de Junio 2021 02:28pm
 * Clase Registro Actividad Poai
 */
Class ReporteActividadPoai {
    private $codigo;
    private $codigoActividadPoai;
    private $logro;
    private $actoAdministrativo;
    private $numeroActo;
    private $tituloActo;    
    private $personaSistema;
    
    public function getCodigo(){
        return $this->codigo;
    } 

    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function getCodigoActividadPoai(){
        return $this->codigoActividadPoai;
    } 

    public function setCodigoActividadPoai($codigoActividadPoai){
        $this->codigoActividadPoai=$codigoActividadPoai;
    }

    public function getLogro(){
        return $this->logro;
    } 

    public function setLogro($logro){
        $this->logro=$logro;
    }

    public function getActoAdministrativo(){
        return $this->actoAdministrativo;
    } 

    public function setActoAdministrativo($actoAdministrativo){
        $this->actoAdministrativo=$actoAdministrativo;
    }

    public function getNumeroActo(){
        return $this->numeroActo;
    } 

    public function setNumeroActo($numeroActo){
        $this->numeroActo=$numeroActo;
    }

    public function getTituloActo(){
        return $this->tituloActo;
    } 

    public function setTituloActo($tituloActo){
        $this->tituloActo=$tituloActo;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 

    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }


}
?>