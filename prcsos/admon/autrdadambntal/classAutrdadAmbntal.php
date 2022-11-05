<?php
    class Autoridad{
        private $codigoAutoridad;
        private $nombreAutoridad;
        private $numeroAutoridad;
        private $referenciaAutoridad;
        private $estadoAutoridad;
        private $personaSistema;

        public function Autoridad(){}

        public function getCodigoAutoridad(){
            return $this->codigoAutoridad;
        }
        public function setCodigoAutoridad($codigoAutoridad){
            $this->codigoAutoridad=$codigoAutoridad;
        }

        public function getNumeroAutoridad(){
            return $this->numeroAutoridad;
        }
        public function setNumeroAutoridad($numeroAutoridad){
            $this->numeroAutoridad=$numeroAutoridad;
        }
        
        public function getReferenciaAutoridad(){
            return $this->referenciaAutoridad;
        }
        public function setReferenciaAutoridad($referenciaAutoridad){
            $this->referenciaAutoridad=$referenciaAutoridad;
        }

        public function getNombreAutoridad(){
            return $this->nombreAutoridad;
        }
        public function setNombreAutoridad($nombreAutoridad){
            $this->nombreAutoridad=$nombreAutoridad;
        }

        public function getEstadoAutoridad(){
            return $this->estadoAutoridad;
        }
        public function setEstadoAutoridad($estadoAutoridad){
            $this->estadoAutoridad=$estadoAutoridad;
        }

        public function getPersonaSistema(){
            return $this->personaSistema;
        }
        public function setPersonaSistema($personaSistema){
            $this->personaSistema=$personaSistema;
        }
    }
?>
