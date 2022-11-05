<?php 
class Foto{
    private $personaFoto;
    private $fotoFoto;
    private $personaSistema;

    public function Foto(){}

 
    public function getPersonaFoto(){
        return $this->personaFoto;
    }
    public function setPersonaFoto($personaFoto){
        $this->personaFoto=$personaFoto;
    }

    public function getFotoFoto(){
        return $this->fotoFoto;
    }
    public function setFotoFoto($fotoFoto){
        $this->fotoFoto=$fotoFoto;
    }

    public function getPersonaSistema(){
        return $this->personaSistema;
    }
    public function setPersonaSistema($personaSistema){
        $this->personaSistema=$personaSistema;
    }

}
?>