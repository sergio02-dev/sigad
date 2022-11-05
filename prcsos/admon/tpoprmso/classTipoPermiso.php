<?php
    class TipoPermiso{
        private $codigoTipoPermiso;
        private $nombreTipoPermiso;
        private $estadoTipoPermiso;
        private $textoTipoPermiso;
        private $personaSistema;

        public function TipoPermiso(){}

        public function getCodigoTipoPermiso(){
            return $this->codigoTipoPermiso;
        }
        public function setCodigoTipoPermiso($codigoTipoPermiso){
            $this->codigoTipoPermiso=$codigoTipoPermiso;
        }

        public function getNombreTipoPermiso(){
            return $this->nombreTipoPermiso;
        }
        public function setNombreTipoPermiso($nombreTipoPermiso){
            $this->nombreTipoPermiso=$nombreTipoPermiso;
        }

        public function getEstadoTipoPermiso(){
            return $this->estadoTipoPermiso;
        }
        public function setEstadoTipoPermiso($estadoTipoPermiso){
            $this->estadoTipoPermiso=$estadoTipoPermiso;
        }

        public function getTextoTipoPermiso(){
            return $this->textoTipoPermiso;
        }
        public function setTextoTipoPermiso($textoTipoPermiso){
            $this->textoTipoPermiso=$textoTipoPermiso;
        }

        public function getPersonaSistema(){
            return $this->personaSistema;
        }
        public function setPersonaSistema($personaSistema){
            $this->personaSistema=$personaSistema;
        }
    }
?>
