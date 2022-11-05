<?php
class PerfilPersona{
    private $codigoPersonaSistema;
    private $codigoPersona;
    private $sistema;
    private $alias;
    private $contrasenia;
    private $perfil;
    private $codigoPerfilPersona;
    private $personaSistema;
    private $cantidadInsert;
    private $codigoUsuario;

    public function getCodigoPersonaSistema(){
        return $this->codigoPersonaSistema;
    } 

    public function setCodigoPersonaSistema($codigoPersonaSistema){
        $this->codigoPersonaSistema=$codigoPersonaSistema;
    } 

    public function getCodigoPersona(){
        return $this->codigoPersona;
    } 

    public function setCodigoPersona($codigoPersona){
        $this->codigoPersona=$codigoPersona;
    } 

    public function getSistema(){
        return $this->sistema;
    } 

    public function setSistema($sistema){
        $this->sistema=$sistema;
    } 

    public function getAlias(){
        return $this->alias;
    } 

    public function setAlias($alias){
        $this->alias=$alias;
    }

    public function getContrasenia(){
        return $this->contrasenia;
    } 

    public function setContrasenia($contrasenia){
        $this->contrasenia=$contrasenia;
    }

    public function getPerfil(){
        return $this->perfil;
    } 

    public function setPerfil($perfil){
        $this->perfil=$perfil;
    }

    public function getCodigoPerfilPersona(){
        return $this->codigoPerfilPersona;
    } 

    public function setCodigoPerfilPersona($codigoPerfilPersona){
        $this->codigoPerfilPersona=$codigoPerfilPersona;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    } 

    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }

    public function getCantidadInsert(){
        return $this->cantidadInsert;
    } 

    public function setCantidadInsert($cantidadInsert){
        $this->cantidadInsert=$cantidadInsert;
    }

    public function getCodigoUsuario(){
        return $this->codigoUsuario;
    } 

    public function setCodigoUsuario($codigoUsuario){
        $this->codigoUsuario=$codigoUsuario;
    }
}
?>