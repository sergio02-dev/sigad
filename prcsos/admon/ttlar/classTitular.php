<?php
    class Titular{
        private $codigoTitular;
        private $tipoTitular;
        private $nombreTitular;
        private $numeroTitular;
        private $tipoIdTitular;
        private $digitoTitular;
        private $correoTitular;
        private $direccionTitular;
        private $siglaTitular;
        private $logoTitular;
        private $estadoTitular;
        private $personaSistema;

        public function Titular(){}

        public function getCodigoTitular(){
            return $this->codigoTitular;
        }
        public function setCodigoTitular($codigoTitular){
            $this->codigoTitular=$codigoTitular;
        }
        
        public function getTipoTitular(){
            return $this->tipoTitular;
        }
        public function setTipoTitular($tipoTitular){
            $this->tipoTitular=$tipoTitular;
        }

        public function getNumeroTitular(){
            return $this->numeroTitular;
        }
        public function setNumeroTitular($numeroTitular){
            $this->numeroTitular=$numeroTitular;
        }
        
        public function getTipoIdTitular(){
            return $this->tipoIdTitular;
        }
        public function setTipoIdTitular($tipoIdTitular){
            $this->tipoIdTitular=$tipoIdTitular;
        }
        
        public function getDigitoTitular(){
            return $this->digitoTitular;
        }
        public function setDigitoTitular($digitoTitular){
            $this->digitoTitular=$digitoTitular;
        }

        public function getNombreTitular(){
            return $this->nombreTitular;
        }
        public function setNombreTitular($nombreTitular){
            $this->nombreTitular=$nombreTitular;
        }

        public function getCorreoTitular(){
            return $this->correoTitular;
        }
        public function setCorreoTitular($correoTitular){
            $this->correoTitular=$correoTitular;
        }
        
        public function getDireccionTitular(){
            return $this->direccionTitular;
        }
        public function setDireccionTitular($direccionTitular){
            $this->direccionTitular=$direccionTitular;
        }
        
        public function getSiglaTitular(){
            return $this->siglaTitular;
        }
        public function setSiglaTitular($siglaTitular){
            $this->siglaTitular=$siglaTitular;
        }
        
        public function getLogoTitular(){
            return $this->logoTitular;
        }
        public function setLogoTitular($logoTitular){
            $this->logoTitular=$logoTitular;
        }

        public function getEstadoTitular(){
            return $this->estadoTitular;
        }
        public function setEstadoTitular($estadoTitular){
            $this->estadoTitular=$estadoTitular;
        }

        public function getPersonaSistema(){
            return $this->personaSistema;
        }
        public function setPersonaSistema($personaSistema){
            $this->personaSistema=$personaSistema;
        }
    }
?>
