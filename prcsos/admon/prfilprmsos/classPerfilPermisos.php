<?php
    class PerfilPermisosPermisos{
        private $codigoPerfilPermisos;
        private $codigoSistemaPerfilPermisos;
        private $personaSistemaPerfilPermisos;

        public function PerfilPermisos(){}

        public function getCodigoPerfilPermisos(){
            return $this->codigoPerfilPermisos;
        }
        public function setCodigoPerfilPermisos($codigoPerfilPermisos){
            $this->codigoPerfilPermisos=$codigoPerfilPermisos;
        }

        public function getCodigoSistemaPerfilPermisos(){
            return $this->codigoSistemaPerfilPermisos;
        }
        public function setCodigoSistemaPerfilPermisos($codigoSistemaPerfilPermisos){
            $this->codigoSistemaPerfilPermisos=$codigoSistemaPerfilPermisos;
        }

        public function getPersonaSistemaPerfilPermisos(){
            return $this->personaSistemaPerfilPermisos;
        }
        public function setPersonaSistemaPerfilPermisos($personaSistemaPerfilPermisos){
            $this->personaSistemaPerfilPermisos=$personaSistemaPerfilPermisos;
        }
    }
?>
