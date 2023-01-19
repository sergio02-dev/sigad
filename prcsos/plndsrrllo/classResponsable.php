<?php
    class Responsable{
        private $codigo;
        private $nivel;
        private $codigoNivel;
        private $oficina;
        private $cargo;
        private $clasificacion;
        private $estado;
        private $personaSistema;
        private $tipoResponsable;


        
        public function getClasificacion(){
            return $this->clasificacion;
        }
        public function setClasificacion($clasificacion){
            $this->clasificacion = $clasificacion;
        } 

        public function getCodigo(){
            return $this->codigo;
        }
        public function setCodigo($codigo){
            $this->codigo = $codigo;
        } 

        public function getNivel(){
            return $this->nivel;
        } 
        public function setNivel($nivel){
            $this->nivel = $nivel;
        }
        
        public function getCodigoNivel(){
            return $this->codigoNivel;
        } 
        public function setCodigoNivel($codigoNivel){
            $this->codigoNivel = $codigoNivel;
        }
        
        public function getOficina(){
            return $this->oficina;
        } 
        public function setOficina($oficina){
            $this->oficina = $oficina;
        }

        public function getCargo(){
            return $this->cargo;
        }
        public function setCargo($cargo){
            $this->cargo = $cargo;
        }
        
        public function getPersonaSistema(){
            return $this->personaSistema;
        } 
        public function setPersonaSistema($personaSistema){
            $this->personaSistema = $personaSistema;
        } 

        public function getEstado(){
            return $this->estado;
        } 
        public function setEstado($estado){
            $this->estado = $estado;
        }
        
        public function getTipoResponsable(){
            return $this->tipoResponsable;
        } 
        public function setTipoResponsable($tipoResponsable){
            $this->tipoResponsable = $tipoResponsable;
        }
    }
?>