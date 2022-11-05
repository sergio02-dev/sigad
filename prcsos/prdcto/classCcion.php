<?php

    include_once('prcsos/sbsstema/classSbsstma.php');

    class Accion extends Subsistema{

        private $codigoAccion;
        private $referenciaAccion;
        private $descripcionAccion;
        private $responsableAccion;
        private $lineabaseAccion;
        private $metaresultadoAccion;
        private $proyectoAccion;
        private $actoadminAccion;
        private $numerovigenciaAccion;
        private $coportamientoAccion;
        private $tendenciapositivaAccion;
        private $indicadorAccion;
        



        public function __construct(){
            //$this->SubsistemaAccion = $this->getCodigoSubsistema();
        }


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

        public function getResponsableAccion(){
            return $this->responsableAccion;
        }
        public function setResponsableAccion($responsableAccion){
            $this->responsableAccion=$responsableAccion;
        }

        public function getLineabaseAccion(){
            return $this->lineabaseAccion;
        }
        public function setLineabaseAccion($lineabaseAccion){
            $this->lineabaseAccion=$lineabaseAccion;
        }

        public function getMetaresultadoAccion(){
            return $this->metaresultadoAccion;
        }
        public function setMetaresultadoAccion($metaresultadoAccion){
            $this->metaresultadoAccion=$metaresultadoAccion;
        }

        public function getProyectoAccion(){
            return $this->proyectoAccion;
        }
        public function setProyectoAccion($proyectoAccion){
            $this->proyectoAccion=$proyectoAccion;
        }

        public function getActoadminAccion(){
            return $this->actoadminAccion;
        }
        public function setActoadminAccion($actoadminAccion){
            $this->actoadminAccion=$actoadminAccion;
        }

        public function getNumerovigenciaAccion(){
            return $this->numerovigenciaAccion;
        }
        public function setNumerovigenciaAccion($numerovigenciaAccion){
            $this->numerovigenciaAccion=$numerovigenciaAccion;
        }

        public function getCoportamientoAccion(){
            return $this->coportamientoAccion;
        }
        public function setCoportamientoAccion($coportamientoAccion){
            $this->coportamientoAccion=$coportamientoAccion;
        }

        public function getTendenciapositivaAccion(){
            return $this->tendenciapositivaAccion;
        }
        public function setTendenciapositivaAccion($tendenciapositivaAccion){
            $this->tendenciapositivaAccion=$tendenciapositivaAccion;
        }

        public function getIndicadorAccion(){
            return $this->indicadorAccion;
        }
        public function setIndicadorAccion($indicadorAccion){
            $this->indicadorAccion=$indicadorAccion;
        }


    }


?>