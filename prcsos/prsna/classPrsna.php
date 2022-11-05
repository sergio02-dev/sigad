<?php

    class Persona {

        private $cnxion;
        private $codigoPersona;
        private $nombrePersona;
        private $primerApellidoPersona;
        private $segundoApellidoPersona;
        private $generoPersona;
        private $tipoIdentificacionPersona;
        private $identificacionPersona;
        private $estadoPersona;
        private $personaSistema;
        private $entidadPersona;
        


        function Persona(){}

        
        public function getCodigoPersona(){
            return $this->codigoPersona;
        }
        public function setCodigoPersona($codigoPersona){
            $this->codigoPersona=$codigoPersona;
        }
        
        public function getNombrePersona(){
            return $this->nombrePersona;
        }
        public function setNombrePersona($nombrePerosna){
            $this->nombrePersona=$nombrePerosna;
        }

        public function getPrimerApellidoPersona(){
            return $this->primerApellidoPersona;
        }
        public function setPrimerApellidoPersona($primerApellidoPersona){
            $this->primerApellidoPersona=$primerApellidoPersona;
        }

        public function getSegundoApellidoPersona(){
            return $this->segundoApellidoPersona;
        }
        public function setSegundoApellidoPersona($segundoApellidoPersona){
            $this->segundoApellidoPersona=$segundoApellidoPersona;
        }

        public function getGeneroPersona(){
            return  $this->generoPersona;
        }
        public function setGeneroPersona($generoPersona){
            $this->generoPersona=$generoPersona;
        }

        public function getTipoIdentificacionPersona(){
            return  $this->tipoIdentificacionPersona;
        }
        public function setTipoIdentificacionPersona($tipoIdentificacionPersona){
            $this->tipoIdentificacionPersona=$tipoIdentificacionPersona;
        }

        public function getIdentificacionPersona(){
            return  $this->identificacionPersona;
        }
        public function setIdentificacionPersona($identificacionPersona){
            $this->identificacionPersona=$identificacionPersona;
        }

        public function getEstadoPersona(){
            return $this->estadoPersona;
        }
        public function setEstadoPersona($estadoPersona){
            $this->estadoPersona=$estadoPersona;
        }

        public function getPersonaSistema(){
            return $this->personaSistema;
        }
        public function setPersonaSistema($personaSistema){
            $this->personaSistema=$personaSistema;
        }

        public function getEntidadPersona(){
            return $this->entidadPersona;
        }
        public function setEntidadPersona($entidadPersona){
            $this->entidadPersona=$entidadPersona;
        }


    }



?>