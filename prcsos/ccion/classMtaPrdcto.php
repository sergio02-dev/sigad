<?php


    class MetaProducto{

        private $codigoMepro;
        private $accionMepro;
        private $vigenciaMepro;
        private $valoresperadoMepro;


        public function MetaProducto(){}

        public function getCodigoMepro(){
            return $this->codigoMepro;
        }
        public function setCodigoMepro($codigoMepro){
            $this->codigoMepro=$codigoMepro;
        }

        public function getAccionMepro(){
            return $this->accionMepro;
        }
        public function setAccionMepro($accionMepro){
            $this->accionMepro=$accionMepro;
        }

        public function getVigenciaMepro(){
            return $this->vigenciaMepro;
        }
        public function setVigenciaMepro($vigenciaMepro){
            $this->vigenciaMepro=$vigenciaMepro;
        }

        public function getValoresperadoMepro(){
            return $this->valoresperadoMepro;
        }

        public function setValoresperadoMepro($valoresperadoMepro){
            $this->valoresperadoMepro=$valoresperadoMepro;
        }


    }




?>