<?php

// actividad realizada
    class RegistroActividades{


        private $codigoActividadRealizada;
        private $codigoActividad;
        private $tipoActividad;
        private $tipoValorAvance;
        private $numeroVeces;
        private $avanceLogrado;
        private $personaSistema;
        private $actoAdministrativo;
        private $nombreAcuerdo;
        private $nombreTitulo;
        private $trimestre;

        public function RegistroActividades(){}

        public function getCodigoActividadRealizada(){
            return $this->codigoActividadRealizada;
        } 
        public function setCodigoActividadRealizada($codigoActividadRealizada){
            $this->codigoActividadRealizada=$codigoActividadRealizada;
        } 

        public function getCodigoActividad(){
            return $this->codigoActividad;
        } 
        public function setCodigoActividad($codigoActividad){
            $this->codigoActividad = $codigoActividad;
        } 

        public function getTipoActividad(){
            return $this->tipoActividad;
        } 
        public function setTipoActividad($tipoActividad){
            $this->tipoActividad = $tipoActividad;
        } 

        public function getTipoValorAvance(){
            return $this->tipoValorAvance;
        } 
        public function setTipoValorAvance($tipoValorAvance){
            $this->tipoValorAvance = $tipoValorAvance;
        } 


        public function getNumeroVeces(){
            return $this->numeroVeces;
        } 
        public function setNumeroVeces($numeroVeces){
            $this->numeroVeces = $numeroVeces;
        } 


        public function getAvanceLogrado(){
            return $this->avanceLogrado;
        } 
        public function setAvanceLogrado($avanceLogrado){
            $this->avanceLogrado = $avanceLogrado;
        } 


        public function getPersonaSistema(){
            return $this->personaSistema;
        } 
        public function setPersonaSistema($personaSistema){
            $this->personaSistema = $personaSistema;
        } 

        public function getActoAdministrativo(){
            return $this->actoAdministrativo;
        } 
        public function setActoAdministrativo($actoAdministrativo){
            $this->actoAdministrativo = $actoAdministrativo;
        } 

        public function getNombreAcuerdo(){
            return $this->nombreAcuerdo;
        } 
        public function setNombreAcuerdo($nombreAcuerdo){
            $this->nombreAcuerdo = $nombreAcuerdo;
        } 

        public function getNombreTitulo(){
            return $this->nombreTitulo;
        } 
        public function setNombreTitulo($nombreTitulo){
            $this->nombreTitulo = $nombreTitulo;
        } 
        public function getTrimestre(){
            return $this->trimestre;
        }
        public function setTrimestre($trimestre){
            $this->trimestre = $trimestre;
        }

    }


?>