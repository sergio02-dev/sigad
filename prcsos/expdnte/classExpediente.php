<?php
    class Expediente{
        private $codigo;
        private $numero;
        private $proyecto;
        private $autoridadAmbiental;
        private $sector;
        private $titular;
        private $tipoPermiso;
        private $otroTipoPermiso;
        private $estado;
        private $personaSistema;

        public function Expediente(){}

        public function getCodigo(){
            return $this->codigo;
        }
        public function setCodigo($codigo){
            $this->codigo=$codigo;
        }

        public function getNumero(){
            return $this->numero;
        }
        public function setNumero($numero){
            $this->numero=$numero;
        }

        public function getProyecto(){
            return $this->proyecto;
        }
        public function setProyecto($proyecto){
            $this->proyecto=$proyecto;
        }

        public function getAutoridadAmbiental(){
            return $this->autoridadAmbiental;
        }
        public function setAutoridadAmbiental($autoridadAmbiental){
            $this->autoridadAmbiental=$autoridadAmbiental;
        }
        
        public function getSector(){
            return $this->sector;
        }
        public function setSector($sector){
            $this->sector=$sector;
        }
        
        public function getTitular(){
            return $this->titular;
        }
        public function setTitular($titular){
            $this->titular=$titular;
        }
        
        public function getTipoPermiso(){
            return $this->tipoPermiso;
        }
        public function setTipoPermiso($tipoPermiso){
            $this->tipoPermiso=$tipoPermiso;
        }
        
        public function getOtroTipoPermiso(){
            return $this->otroTipoPermiso;
        }
        public function setOtroTipoPermiso($otroTipoPermiso){
            $this->otroTipoPermiso=$otroTipoPermiso;
        }

        public function getEstado(){
            return $this->estado;
        }
        public function setEstado($estado){
            $this->estado=$estado;
        }

        public function getPersonaSistema(){
            return $this->personaSistema;
        }
        public function setPersonaSistema($personaSistema){
            $this->personaSistema=$personaSistema;
        }
    }
?>
