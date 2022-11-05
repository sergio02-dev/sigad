<?php

    class Actividad{

        private $codigoActividad;
        private $descripcionActividad;
        private $fechaExpedicionActividad;
        private $accionActividad;
        private $proyectoActividad;
        private $dependenciaActibvidad;
        private $referenciaActividad;
        private $estadoActividad;
        private $trimestreActividad;

        public function Actividad(){}

        public function getCodigoActividad(){
            return $this->codigoActividad;
        } 

        public function setCodigoActividad($codigoActividad){
            $this->codigoActividad=$codigoActividad;
        } 

        public function getDescripcionActividad(){
            return $this->descripcionActividad;
        } 

        public function setDescripcionActividad($descripcionActividad){
            $this->descripcionActividad=$descripcionActividad;
            
        } 

        public function getFechaExpedicionActividad(){
            return $this->fechaExpedicionActividad;
        } 

        public function setFechaExpedicionActividad($fechaExpedicionActividad){
            $this->fechaExpedicionActividad=$fechaExpedicionActividad;
        } 

        public function getAccionActividad(){
            return $this->accionActividad;
        } 

        public function setAccionActividad($accionActividad){
            $this->accionActividad=$accionActividad;
        } 

        public function getProyectoActividad(){
            return $this->proyectoActividad;
        } 

        public function setProyectoActividad($proyectoActividad){
            $this->proyectoActividad=$proyectoActividad;
        } 

        public function getReferenciaActividad(){
            return $this->referenciaActividad;
        } 

        public function setReferenciaActividad($referenciaActividad){
            $this->referenciaActividad=$referenciaActividad;
        } 

        public function getEstadoActividad(){
            return $this->estadoActividad;
        } 

        public function setEstadoActividad($estadoActividad){
            $this->estadoActividad=$estadoActividad;
        } 

        public function getTrimestreActividad(){
            return $this->trimestreActividad;
        } 

        public function setTrimestreActividad($trimestreActividad){
            $this->trimestreActividad=$trimestreActividad;
        } 

    }




?>