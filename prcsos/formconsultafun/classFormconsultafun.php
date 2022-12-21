<?php

    class Consulta_funcionamiento {

        
        private $sede;
        
        
        private $dependencia;
        
   
        private $equipo;
        private $caracteristicas;
        private $cantidad;
        private $valorunitario;

   
        
      
        
        
        

        

        public function getDependencia() {
                return $this->dependencia;
        }
        
        public function setDependencia($dependencia){
                $this->dependencia = $dependencia;

        }
        


       
        public function getSede() {
                return $this->sede;
        }

        public function setSede($sede){
                $this->sede = $sede;
        }

        
        


        public function getEquipo() {
                return $this->equipo;
        }
        
        public function setEquipo($equipo){
                $this->equipo = $equipo;

        }

        public function getCantidad() {
                return $this->cantidad;
        }
        

        public function setCantidad($cantidad) {
                $this->cantidad = $cantidad;

        }
        public function getValorunitario() {
            return $this->valorunitario;
        }
        
        public function setValorunitario($valorunitario) {
                $this->valorunitario = $valorunitario;

        }

        
        public function getCaracteristicas() {
                return $this->caracteristicas;
        }
        

        public function setCaracteristicas($caracteristicas){
                $this->caracteristicas = $caracteristicas;
        
        }

  
}



?>