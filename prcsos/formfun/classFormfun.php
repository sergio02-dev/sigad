<?php

    class Funcionamiento {

        private $codigo;
        private $sede;
        private $vicerrectoria;
        private $facultad;
        private $dependencia;
        private $area;
        private $lineaequipo;
        private $sublineaequipo;
        private $equipo;
        private $caracteristicas;
        private $cantidad;
        private $valorunitario;
        private $personaSistema;
        private $estado;


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
        
        
        public function getVicerrectoria() {
                return $this->vicerrectoria;
        }
        
        public function setVicerrectoria($vicerrectoria){
                $this->vicerrectoria = $vicerrectoria;
        }

        public function getFacultad() {
                return $this->facultad;
        }
        
        public function setFacultad($facultad){
                $this->facultad = $facultad;
        }

        public function getDependencia() {
                return $this->dependencia;
        }
        
        public function setDependencia($dependencia){
                $this->dependencia = $dependencia;

        }
        public function getArea() {
                return $this->area;
        }
        
        public function setArea($area) {
                $this->area = $area;
        }


        public function getCodigo() {
                return $this->codigo;
        }
        
        public function setCodigo($codigo){
                $this->codigo = $codigo;
                
        }
        public function getSede() {
                return $this->sede;
        }

        public function setSede($sede){
                $this->sede = $sede;
        }

        public function getLineaequipo() {
                return $this->lineaequipo;
        }
        

        public function setLineaequipo($lineaequipo){
                $this->lineaequipo = $lineaequipo;

        }
        public function getSublineaequipo() {
                return $this->sublineaequipo;
        }
        
        public function setSublineaequipo($sublineaequipo){
                $this->sublineaequipo = $sublineaequipo;

        }


        public function getEquipo() {
                return $this->equipo;
        }
        
        public function setEquipo($equipo){
                $this->equipo = $equipo;

        }

        public function getCantidad() {
                return $this->cantidad;
        }
        

        public function setCantidad($cantidad) {
                $this->cantidad = $cantidad;

        }
        public function getValorunitario() {
            return $this->valorunitario;
        }
        
        public function setValorunitario($valorunitario) {
                $this->valorunitario = $valorunitario;

        }

        
        public function getCaracteristicas() {
                return $this->caracteristicas;
        }
        

        public function setCaracteristicas($caracteristicas){
                $this->caracteristicas = $caracteristicas;
        
        }

  
}



?>