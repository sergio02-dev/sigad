<?php 
class PersonaPerfil{

    private $codigoPersonaPerfil;
    private $personaPersonaPerfil;
    private $perfilPersonaPerfil;
    private $personaSistema;
    private $cantidadInsertar;
    private $usuarioPersona;
    private $contraseniaPersona;

    public function PersonaPerfil(){}

    public function getCodigoPersonaPerfil(){
        return $this->codigoPersonaPerfil;
    }
    public function setCodigoPersonaPerfil($codigoPersonaPerfil){
        $this->codigoPersonaPerfil=$codigoPersonaPerfil;
    }

    public function getPersonaPersonaPerfil(){
        return $this->personaPersonaPerfil;
    }
    public function setPersonaPersonaPerfil($personaPersonaPerfil){
        $this->personaPersonaPerfil=$personaPersonaPerfil;
    }

    public function getPerfilPersonaPerfil(){
        return $this->perfilPersonaPerfil;
    }
    public function setPerfilPersonaPerfil($perfilPersonaPerfil){
        $this->perfilPersonaPerfil=$perfilPersonaPerfil;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    }
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }

    public function getCantidadInsertar(){
        return $this->cantidadInsertar;
    }
    public function setCantidadInsertar($cantidadInsertar){
        $this->cantidadInsertar=$cantidadInsertar;
    }

    public function getUsuarioPersona(){
        return $this->usuarioPersona;
    }
    public function setUsuarioPersona($usuarioPersona){
        $this->usuarioPersona=$usuarioPersona;
    }

    public function getContraseniaPersona(){
        return $this->contraseniaPersona;
    }
    public function setContraseniaPersona($contraseniaPersona){
        $this->contraseniaPersona=$contraseniaPersona;
    }

}

?>