<?php
    
    include('classEps.php');


    class RgstroEps extends Eps{

        private $codigo_eps;
        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_eps = date('YmdHis').rand(99,999);
        }

        public function inserEps(){
            
            $sql_insert_eps="INSERT INTO principal.eps(
                                         eps_codigo, 
                                         eps_descripcion, 
                                         eps_estado, 
                                         eps_personacreo, 
                                         eps_personamodifico, 
                                         eps_fechacreo, 
                                         eps_fechamodifico)
                                 VALUES (".$this->codigo_eps.", 
                                         '".$this->getNombreEps()."', 
                                         '".$this->getEstadoEps()."', 
                                         '".$this->getPersonaSistemaEps()."', 
                                         '".$this->getPersonaSistemaEps()."', 
                                         NOW(), 
                                         NOW());";
            
            $query_insert_eps=$this->cnxion->ejecutar($sql_insert_eps);

            return $sql_insert_eps;
        }

    }



?>

