<?php

    class Subsistema{

        private $codigoSubsistema;
        private $nombreSubsistema;
        private $referenciaSubsistema;
        private $actoAdmin;
        private $responsable;
        private $planDesarrollo;

        public function Subsistema(){}

        public function getCodigoSubsistema(){
            return $this->codigoSubsistema;
        }
        public function setCodigoSubsistema($codigoSubsistema){
            $this->codigoSubsistema=$codigoSubsistema;
        }

        public function getNombreSubsistema(){
            return $this->nombreSubsistema;
        }
        public function setNombreSubsistema($nombreSubsistema){
            $this->nombreSubsistema=$nombreSubsistema;
        }

        public function getReferenciaSubsistema(){
            return $this->referenciaSubsistema;
        }
        public function setReferenciaSubsistema($referenciaSubsistema){
            $this->referenciaSubsistema=$referenciaSubsistema;
        }

        public function getActoAdmin(){
            return $this->actoAdmin;
        }
        public function setActoAdmin($actoAdmin){
            $this->actoAdmin=$actoAdmin;
        }

        public function getResponsable(){
            return $this->responsable;
        }
        public function setResponsable($responsable){
            $this->responsable=$responsable;
        }

        public function getPlanDesarrollo(){
            return $this->planDesarrollo;
        }
        public function setPlanDesarrollo($planDesarrollo){
            $this->planDesarrollo=$planDesarrollo;
        }



        





    }




?>