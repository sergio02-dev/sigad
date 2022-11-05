<?php

    include_once('prcsos/crtfcdos/classCrtfcdos.php');

    class Certificados {

        private $resolucion;
        private $codigoActividad;
        private $codigoSubsistema;
        private $codigoProyecto;
        private $codigoAccion;
        private $Actividad;
        private $certificado;
        private $trimestre;
        private $vigencia;
        private $valor;
        private $fechaExpedicion;
        private $dependencia;
        private $personaSistema;
        private $estado;
        private $referencia;
        private $act_certificadomod;
        private $estadoActividad;
        private $certificadoPadre;
        private $etapas;
        private $otroValor;

        public function __construct(){
            //$this->SubsistemaAccion = $this->getCodigoSubsistema();
        }

        
        public function getResolucion(){
            return $this->resolucion;
        }
        public function setResolucion($resolucion){
            $this->resolucion=$resolucion;
        }
        public function getCodigoActividad(){
            return $this->codigoActividad;
        }
        public function setCodigoActividad($codigoActividad){
            $this->codigoActividad=$codigoActividad;
        }
        public function getCodigoSubsistema(){
            return $this->codigoSubsistema;
        }
        public function setCodigoSubsistema($codigoSubsistema){
            $this->codigoSubsistema=$codigoSubsistema;
        }
        public function getCodigoProyecto(){
            return $this->codigoProyecto;
        }
        public function setCodigoProyecto($codigoProyecto){
            $this->codigoProyecto=$codigoProyecto;
        }
        public function getCodigoAccion(){
            return $this->codigoAccion;
        }
        public function setCodigoAccion($codigoAccion){
            $this->codigoAccion=$codigoAccion;
        }
        public function getActividad(){
            return $this->Actividad;
        }
        public function setActividad($Actividad){
            $this->Actividad=$Actividad;
        }
        public function getCertificado(){
            return $this->codigoCertificado;
        }
        public function setCertificado($codigoCertificado){
            $this->codigoCertificado=$codigoCertificado;
        }
        public function getTrimestre(){
            return $this->trimestre;
        }
        public function setTrimestre($trimestre){
            $this->trimestre=$trimestre;
        }
        public function getVigencia(){
            return $this->vigencia;
        }
        public function setVigencia($vigencia){
            $this->vigencia=$vigencia;
        }
        public function getvalor(){
            return $this->valor;
        }
        public function setValor($valor){
            $this->valor=$valor;
        }
        public function getFechaExpedicion(){
            return $this->fechaExpedicion;
        }
        public function setFechaExpedicion($fechaExpedicion){
            $this->fechaExpedicion=$fechaExpedicion;
        }
        public function getDependencia(){
            return $this->dependencia;
        }
        public function setDependencia($dependencia){
            $this->dependencia=$dependencia;
        }
        public function getPersonaSistema(){
            return $this->personaSistema;
        }
        public function setPersonaSistema($personaSistema){
            $this->personaSistema=$personaSistema;
        }
        public function getEstado(){
            return $this->estado;
        }
        public function setEstado($estado){
            $this->estado=$estado;
        }
        public function getReferencia(){
            return $this->referencia;
        }
        public function setReferencia($referencia){
            $this->referencia=$referencia;
        }
        public function getCertificadoMod(){
            return $this->act_certificadomod;
        }
        public function setCertificadoMod($act_certificadomod){
            $this->act_certificadomod=$act_certificadomod;
        }
        public function getEstadoActividad(){
            return $this->estadoActividad;
        }
        public function setEstadoActividad($estadoActividad){
            $this->estadoActividad=$estadoActividad;
        }
        public function getCertificadoPadre(){
            return $this->certificadoPadre;
        }
        public function setCertificadoPadre($certificadoPadre){
            $this->certificadoPadre=$certificadoPadre;
        }
        public function getEtapas(){
            return $this->etapas;
        }
        public function setEtapas($etapas){
            $this->etapas=$etapas;
        }
        public function getOtroValor(){
            return $this->otroValor;
        }
        public function setOtroValor($otroValor){
            $this->otroValor=$otroValor;
        }
        
    }


?>
