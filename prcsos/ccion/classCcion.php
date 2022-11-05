<?php


    class Accion{

        private $codigoAccion;
        private $referenciaAccion;
        private $descripcionAccion;
        private $responsableAccion;
        private $lineaBaseAccion;
        private $metaResultadoAccion;
        private $proyectoAccion;
        private $trimestre;

        public function Accion(){}

        public function getCodigoAccion(){
            return $this->codigoAccion;
        }

        public function setCodigoAccion($codigoAccion){
                $this->codigoAccion=$codigoAccion;
        }
        public function getReferenciaAccion(){
            return $this->referenciaAccion;
        }
        public function setReferenciaAccion($referenciaAccion){
            $this->referenciaAccion=$referenciaAccion;
        }
        public function getDescripcionAccion(){
            return $this->descripcionAccion;
        }
        public function setDescripcionAccion($descripcionAccion){
            $this->descripcionAccion=$descripcionAccion;
        }
        public function getResponsablaAccion(){
            return $this->responsableAccion;
        }
        public function setResponsableAccion($responsableAccion){
            $this->responsableAccion=$responsableAccion;
        }
        public function getLineaBaseAccion(){
            return $this->lineaBaseAccion;
        }
        public function setLineaBaseAccion($lineaBaseAccion){
            $this->lineaBaseAccion=$lineaBaseAccion;
        }
        
        public function getMetaResultadoAccion(){
            return $this->metaResultadoAccion;
        }
        public function setMetaResultadoAccion($metaResultadoAccion){
            $this->metaResultadoAccion=$metaResultadoAccion;
        }
        
        public function getProyectoAccion(){
            return $this->proyectoAccion;
        }
        public function setProyectoAccion($proyectoAccion){
            $this->proyectoAccion=$proyectoAccion;
        }

        public function getTrimestre(){
            return $this->trimestre;
        }
        public function setTrimestre($trimestre){
            $this->trimestre=$trimestre;
        }





    }


?>