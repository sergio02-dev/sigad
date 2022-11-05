<?php

    class Vinculacion {

        private $cnxion;
        private $codigo;
        private $persona;
        private $cargo;
        private $oficina;
        private $estado;
        private $personaSistema;
        


        function Vinculacion(){}

        
        public function getCodigo(){
            return $this->codigo;
        }
        public function setCodigo($codigo){
            $this->codigo=$codigo;
        }
        
        public function getPersona(){
            return $this->persona;
        }
        public function setPersona($persona){
            $this->persona=$persona;
        }

        public function getCargo(){
            return $this->cargo;
        }
        public function setCargo($cargo){
            $this->cargo=$cargo;
        }

        public function getOficina(){
            return $this->oficina;
        }
        public function setOficina($oficina){
            $this->oficina=$oficina;
        }
        
        public function getEstado(){
            return $this->estado;
        }
        public function setEstado($estado){
            $this->estado=$estado;
        }

        public function getPersonaSistema(){
            return  $this->personaSistema;
        }
        public function setPersonaSistema($personaSistema){
            $this->personaSistema=$personaSistema;
        }


    }



?>