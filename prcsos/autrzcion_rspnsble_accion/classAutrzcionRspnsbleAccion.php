<?php
/**
 * Karen Yuliana Palacio Minú
 * 28 de Abril 2023 09:32pm
 * Clase Autorizacion Responsable Acción
 */
Class AutorizacionResponsableAccion {
    private $codigo;
    private $solicitud;
    private $arrayDatos;
    private $personaSistema;

    public function AutorizacionResponsableAccion(){}

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