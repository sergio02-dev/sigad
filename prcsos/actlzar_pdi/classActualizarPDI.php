<?php
    class ActualizacionPDI{

        private $codigo;
        private $nombre;
        private $codigoPlan;
        private $yearInicio;
        private $yearFin;
        private $actoAdmin;
        private $oficina;
        private $responsable;
        private $personaSistema;

        public function ActualizacionPDI(){}

        public function getCodigo(){
            return $this->codigo;
        }
        public function setCodigo($codigo){
            $this->codigo=$codigo;
        }
        
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre=$nombre;
        }

        public function getCodigoPlan(){
            return $this->codigoPlan;
        }
        public function setCodigoPlan($codigoPlan){
            $this->codigoPlan=$codigoPlan;
        }

        public function getYearInicio(){
            return $this->yearInicio;
        }
        public function setYearInicio($yearInicio){
            $this->yearInicio=$yearInicio;
        }

        public function getYearFin(){
            return $this->yearFin;
        }
        public function setYearFin($yearFin){
            $this->yearFin=$yearFin;
        }

        public function getActoAdmin(){
            return $this->actoAdmin;
        }
        public function setActoAdmin($actoAdmin){
            $this->actoAdmin=$actoAdmin;
        }

        public function getOficina(){
            return $this->oficina;
        }
        public function setOficina($oficina){
            $this->oficina=$oficina;
        }

        public function getResponsable(){
            return $this->responsable;
        }
        public function setResponsable($responsable){
            $this->responsable=$responsable;
        }
        
        public function getPersonaSistema(){
            return $this->personaSistema;
        }
        public function setPersonaSistema($personaSistema){
            $this->personaSistema=$personaSistema;
        }
    }
?>