<?php
    
    include('classExpediente.php');

    class ModificarExpediente extends Expediente{

        private $codigo_expediente;
        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_expediente = date('YmdHis').rand(99,999);
        }

        public function updateexpediente(){
            
            $sql_update_expediente="UPDATE principal.expediente
                                       SET exp_numero = '".$this->getNumero()."', 
                                           exp_descripcion = '".$this->getProyecto()."', 
                                           exp_autoridadambiental = ".$this->getAutoridadAmbiental().", 
                                           exp_sector = ".$this->getSector().", 
                                           exp_titular = ".$this->getTitular().", 
                                           exp_tipopermiso = ".$this->getTipoPermiso().", 
                                           exp_otropermiso = '".$this->getOtroTipoPermiso()."', 
                                           exp_estado = ".$this->getEstado().", 
                                           exp_fechamodifico = NOW(), 
                                           exp_personamodifico = ".$this->getPersonaSistema()."
                                     WHERE exp_codigo = ".$this->getCodigo().";";
            
            $query_update_expediente=$this->cnxion->ejecutar($sql_update_expediente);

            return $sql_update_expediente;
        }

    }
?>