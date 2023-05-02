<?php
/**
 * Karen Yuliana Palacio Minú
 * 01 Mayo 2023 03:34pm
 * Clase Autorizacion Financiera
 */
Class AutorizacionFinanciera {
    private $codigo;
    private $solicitud;
    private $arrayDatos;
    private $personaSistema;

    public function AutorizacionFinanciera(){}

    public function getCodigo(){
        return $this->codigo;
    } 
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function getSolicitud(){
        return $this->solicitud;
    } 
    public function setSolicitud($solicitud){
        $this->solicitud=$solicitud;
    }

    public function getArrayDatos(){
        return $this->arrayDatos;
    }
    public function setArrayDatos($arrayDatos){
        $this->arrayDatos=$arrayDatos;
    }
    
    public function getPersonaSistema(){
        return $this->personaSistema;
    } 
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }
    
}
?>