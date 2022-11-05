<?php

    require 'cnxn/cnfg_db.php';
    require 'cnxn/cnf_class.php';

    class Sistema extends Dtbs{

        private $cnxion;
        private $contenido;
        private $seccionurl;

        // Constructor
        function Sistema(){
        }

        function getConexion() {
            return $this->cnxion = Dtbs::getInstance();
        }

        function getContenido() {
            return $this->contenido;
        }
        
        public function setContenido($contenido) {
            $this->contenido = $contenido;
        }

        function getSeccionurl() {
            return $this->seccionurl;
        }
        
        public function setSeccionurl($seccionurl) {
            $this->seccionurl = $seccionurl;
        }

        
    }



?>
