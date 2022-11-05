<?php
    
    include('classExpediente.php');


    class RegistroExpediente extends Expediente{

        private $codigo_expediente;
        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_expediente = date('YmdHis').rand(99,999);
        }

        public function insertexpediente(){
            
            $sql_insert_expediente="INSERT INTO principal.expediente(
                                                exp_codigo, 
                                                exp_numero, 
                                                exp_descripcion, 
                                                exp_autoridadambiental, 
                                                exp_sector, 
                                                exp_titular, 
                                                exp_tipopermiso, 
                                                exp_otropermiso, 
                                                exp_estado, 
                                                exp_fechacreo, 
                                                exp_fechamodifico, 
                                                exp_personacreo, 
                                                exp_personamodifico)
                                        VALUES (".$this->codigo_expediente.", 
                                                '".$this->getNumero()."', 
                                                '".$this->getProyecto()."', 
                                                ".$this->getAutoridadAmbiental().", 
                                                ".$this->getSector().", 
                                                ".$this->getTitular().", 
                                                ".$this->getTipoPermiso().", 
                                                '".$this->getOtroTipoPermiso()."', 
                                                ".$this->getEstado().", 
                                                NOW(), 
                                                NOW(), 
                                                ".$this->getPersonaSistema().", 
                                                ".$this->getPersonaSistema().");";
            
            $query_insert_expediente=$this->cnxion->ejecutar($sql_insert_expediente);

            return $sql_insert_expediente;
        }

    }
?>