<?php
    class Perfil{
        private $codigoPerfil;
        private $nombrePerfil;
        private $estadoPerfil;
        private $personaSistemaPerfil;

        public function Perfil(){}

        public function getCodigoPerfil(){
            return $this->codigoPerfil;
        }
        public function setCodigoPerfil($codigoPerfil){
            $this->codigoPerfil=$codigoPerfil;
        }

        public function getNombrePerfil(){
            return $this->nombrePerfil;
        }
        public function setNombrePerfil($nombrePerfil){
            $this->nombrePerfil=$nombrePerfil;
        }

        public function getEstadoPerfil(){
            return $this->estadoPerfil;
        }
        public function setEstadoPerfil($estadoPerfil){
            $this->estadoPerfil=$estadoPerfil;
        }

        public function getPersonaSistemaPerfil(){
            return $this->personaSistemaPerfil;
        }
        public function setPersonaSistemaPerfil($personaSistemaPerfil){
            $this->personaSistemaPerfil=$personaSistemaPerfil;
        }
    }
?>
