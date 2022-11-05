<?php
    class TipoActoAdministrativo{
        private $codigoTipoActoAdministrativo;
        private $nombreTipoActoAdministrativo;
        private $estadoTipoActoAdministrativo;
        private $personaSistema;

        public function TipoActoAdministrativo(){}

        public function getCodigoTipoActoAdministrativo(){
            return $this->codigoTipoActoAdministrativo;
        }
        public function setCodigoTipoActoAdministrativo($codigoTipoActoAdministrativo){
            $this->codigoTipoActoAdministrativo=$codigoTipoActoAdministrativo;
        }

        public function getNombreTipoActoAdministrativo(){
            return $this->nombreTipoActoAdministrativo;
        }
        public function setNombreTipoActoAdministrativo($nombreTipoActoAdministrativo){
            $this->nombreTipoActoAdministrativo=$nombreTipoActoAdministrativo;
        }

        public function getEstadoTipoActoAdministrativo(){
            return $this->estadoTipoActoAdministrativo;
        }
        public function setEstadoTipoActoAdministrativo($estadoTipoActoAdministrativo){
            $this->estadoTipoActoAdministrativo=$estadoTipoActoAdministrativo;
        }

        public function getPersonaSistema(){
            return $this->personaSistema;
        }
        public function setPersonaSistema($personaSistema){
            $this->personaSistema=$personaSistema;
        }
    }
?>
