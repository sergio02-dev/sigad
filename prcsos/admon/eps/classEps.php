<?php
    class Eps{
        private $codigoEps;
        private $nombreEps;
        private $estadoEps;
        private $personaSistemaEps;

        public function Eps(){}

        public function getCodigoEps(){
            return $this->codigoEps;
        }
        public function setCodigoEps($codigoEps){
            $this->codigoEps=$codigoEps;
        }

        public function getNombreEps(){
            return $this->nombreEps;
        }
        public function setNombreEps($nombreEps){
            $this->nombreEps=$nombreEps;
        }

        public function getEstadoEps(){
            return $this->estadoEps;
        }
        public function setEstadoEps($estadoEps){
            $this->estadoEps=$estadoEps;
        }

        public function getPersonaSistemaEps(){
            return $this->personaSistemaEps;
        }
        public function setPersonaSistemaEps($personaSistemaEps){
            $this->personaSistemaEps=$personaSistemaEps;
        }
    }
?>
