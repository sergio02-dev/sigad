<?php

    class Acceso extends Dtbs{

        private $cnxion;
        private $user;
        private $passwd;

        public function Acceso(){
        }

        function getConexion() {
            return $this->cnxion = Dtbs::getInstance();
        }

        public function getUser() {
            return $this->user;
        }
        public function setUser($user) {
            $this->user = $user;
        }

        public function getPasswd() {
            return $this->passwd;
        }
        public function setPasswd($passwd) {
            $this->passwd = $passwd;
        }


    }