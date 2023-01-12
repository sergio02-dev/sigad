<?php

    class OficinaFuente{

        private $codigo;
        private $oficina;
        private $cargo;
        private $fuente;
        private $estado;
        private $personaSistema;


        public function getCodigo()
        {
                return $this->codigo;
        }
        public function setCodigo($codigo)
        {
            $this->codigo=$codigo; 
        }

        public function getOficina()
        {
                return $this->oficina;
        }

        public function setOficina($oficina)
        {
                $this->oficina = $oficina;

                
        }

        public function getCargo()
        {
                return $this->cargo;
        }


        public function setCargo($cargo)
        {
                $this->cargo = $cargo;
        }

        public function getFuente()
        {
                return $this->fuente;
        }


        public function setFuente($fuente)
        {
                $this->fuente = $fuente;

        }


      public function setEstado($estado){
        $this->estado=$estado;
    }
    public function getEstado(){
        return $this->estado;
    }

        public function getPersonaSistema()
        {
                return $this->personaSistema;
        }

        public function setPersonaSistema($personaSistema)
        {
                $this->personaSistema = $personaSistema;
        }
    }