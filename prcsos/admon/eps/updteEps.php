<?php
    
    include('classEps.php');


    class UpdteEps extends Eps{

        private $codigo_eps;
        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_eps = date('YmdHis').rand(99,999);
        }

        public function updateEps(){
            
            $sql_update_eps="UPDATE principal.eps
                                SET eps_descripcion = '".$this->getNombreEps()."', 
                                    eps_estado = '".$this->getEstadoEps()."', 
                                    eps_personamodifico = '".$this->getPersonaSistemaEps()."',
                                    eps_fechamodifico = NOW()
                              WHERE eps_codigo=".$this->getCodigoEps().";";
            
            $query_update_eps=$this->cnxion->ejecutar($sql_update_eps);

            return $sql_update_eps;
        }

    }



?>

