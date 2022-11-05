<?php 
    class ActoAdmnistrativo{
        private $codigo;
        private $codigoReferencia;
        private $fechaPublicacion;
        private $vigencia;
        private $titular;
        private $fechaNotificacion;
        private $adjunto;
        private $tipoActo;
        private $autoridadAmbiental;
        private $objeto;
        private $estado;
        private $tipoArchivo;
        private $expediente;
        private $personaSistema;

        public function ActoAdmnistrativo(){}

        public function getCodigo(){
            return $this->codigo;
        }
        public function setCodigo($codigo){
            $this->codigo=$codigo;
        }

        public function getCodigoReferencia(){
            return $this->codigoReferencia;
        }
        public function setCodigoReferencia($codigoReferencia){
            $this->codigoReferencia=$codigoReferencia;
        }

        public function getFechaPublicacion(){
            return $this->fechaPublicacion;
        }
        public function setFechaPublicacion($fechaPublicacion){
            $this->fechaPublicacion=$fechaPublicacion;
        }

        public function getVigencia(){
            return $this->vigencia;
        }
        public function setVigencia($vigencia){
            $this->vigencia=$vigencia;
        }

        public function getTitular(){
            return $this->titular;
        }
        public function setTitular($titular){
            $this->titular=$titular;
        }
        
        public function getFechaNotificacion(){
            return $this->fechaNotificacion;
        }
        public function setFechaNotificacion($fechaNotificacion){
            $this->fechaNotificacion=$fechaNotificacion;
        }
        
        public function getAdjunto(){
            return $this->adjunto;
        }
        public function setAdjunto($adjunto){
            $this->adjunto=$adjunto;
        }
        
        public function getTipoActo(){
            return $this->tipoActo;
        }
        public function setTipoActo($tipoActo){
            $this->tipoActo=$tipoActo;
        }
        
        public function getAutoridadAmbiental(){
            return $this->autoridadAmbiental;
        }
        public function setAutoridadAmbiental($autoridadAmbiental){
            $this->autoridadAmbiental=$autoridadAmbiental;
        }
        
        public function getObjeto(){
            return $this->objeto;
        }
        public function setObjeto($objeto){
            $this->objeto=$objeto;
        }
        
        public function getEstado(){
            return $this->estado;
        }
        public function setEstado($estado){
            $this->estado=$estado;
        }
        
        public function getTipoArchivo(){
            return $this->tipoArchivo;
        }
        public function setTipoArchivo($tipoArchivo){
            $this->tipoArchivo=$tipoArchivo;
        }
        
        public function getExpediente(){
            return $this->expediente;
        }
        public function setExpediente($expediente){
            $this->expediente=$expediente;
        }

        public function getPersonaSistema(){
            return $this->personaSistema;
        }
        public function setPersonaSistema($personaSistema){
            $this->personaSistema=$personaSistema;
        }

    }
?>