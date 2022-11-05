<?php
    class Sector{
        private $codigoSector;
        private $nombreSector;
        private $numeroSector;
        private $estadoSector;
        private $personaSistema;

        public function Sector(){}

        public function getCodigoSector(){
            return $this->codigoSector;
        }
        public function setCodigoSector($codigoSector){
            $this->codigoSector=$codigoSector;
        }

        public function getNumeroSector(){
            return $this->numeroSector;
        }
        public function setNumeroSector($numeroSector){
            $this->numeroSector=$numeroSector;
        }

        public function getNombreSector(){
            return $this->nombreSector;
        }
        public function setNombreSector($nombreSector){
            $this->nombreSector=$nombreSector;
        }

        public function getEstadoSector(){
            return $this->estadoSector;
        }
        public function setEstadoSector($estadoSector){
            $this->estadoSector=$estadoSector;
        }

        public function getPersonaSistema(){
            return $this->personaSistema;
        }
        public function setPersonaSistema($personaSistema){
            $this->personaSistema=$personaSistema;
        }
    }
?>
