<?php
class User{
    private $codigoPersona;
    private $codigoUser;
    private $aliasUser;
    private $passUser;
    private $personaSistema;

    public function User(){}

    public function getCodigoPersona(){
        return $this->codigoPersona;
    }
    public function setCodigoPersona($codigoPersona){
        $this->codigoPersona=$codigoPersona;
    }

    public function getCodigoUser(){
        return $this->codigoUser;
    }
    public function setCodigoUser($codigoUser){
        $this->codigoUser=$codigoUser;
    }
    public function getAliasUser(){
        return $this->aliasUser;
    }
    public function setAliasUser($aliasUser){
        $this->aliasUser=$aliasUser;
    }

    public function getPassUser(){
        return $this->passUser;
    }
    public function setPassUser($passUser){
        $this->passUser=$passUser;
    }
    public function getPersonaSistema(){
        return $this->personaSistema;
    }
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }
  
}
?>
