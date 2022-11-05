<?php

    class Racceso extends Dtbs{

        private $accCodigo;
        private $accPersona;
        private $accFechahora;
        private $accIp;
        private $accToken;
        private $accSystem;

        public function Racceso(){
        }

        function getConexion() {
            return $this->cnxion = Dtbs::getInstance();
        }

        public function getAccCodigo() {
            return $this->accCodigo;
        }
        public function setAccCodigo($accCodigo) {
            $this->accCodigo = $accCodigo;
        }


        public function getAccPersona() {
            return $this->accPersona;
        }
        public function setAccPersona($accPersona) {
            $this->accPersona = $accPersona;
        }


        public function getAccFechahora() {
            return $this->accFechahora;
        }
        public function setAccFechahora($accFechahora) {
            $this->accFechahora = $accFechahora;
        }

        public function getAccIp() {
            return $this->accIp;
        }
        public function setAccIp($accIp) {
            $this->accIp = $accIp;
        }

        public function getAccToken() {
            return $this->accToken;
        }
        public function setAccToken($accToken) {
            $this->accToken = $accToken;
        }

        public function getAccSystem() {
            return $this->accSystem;
        }
        public function setAccSystem($accSystem) {
            $this->accSystem = $accSystem;
        }


    }


?>