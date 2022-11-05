<?php
    
    include('classTitular.php');


    class RgstroTtlar extends Titular{

        private $codigo_titular;
        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_titular = date('YmdHis').rand(99,999);
        }

        public function insert_titular(){
            
            $sql_insert_titular="INSERT INTO principal.titular(
                                             tit_codigo, 
                                             tit_tipotitular, 
                                             tit_tipoidentificacion, 
                                             tit_identificacion, 
                                             tit_digitoverificacion, 
                                             tit_nombre, 
                                             tit_sigla, 
                                             tit_logo, 
                                             tit_correo, 
                                             tit_direccion, 
                                             tit_estado, 
                                             tit_fechacreo, 
                                             tit_fechamodico, 
                                             tit_personacreo, 
                                             tit_personamodifico)
                                     VALUES (".$this->codigo_titular.", 
                                             ".$this->getTipoTitular().", 
                                             ".$this->getTipoIdTitular().", 
                                             '".$this->getNumeroTitular()."', 
                                             ".$this->getDigitoTitular().", 
                                             '".$this->getNombreTitular()."', 
                                             '".$this->getSiglaTitular()."', 
                                             '".$this->getLogoTitular()."', 
                                             '".$this->getCorreoTitular()."', 
                                             '".$this->getDireccionTitular()."', 
                                             ".$this->getEstadoTitular().", 
                                             NOW(), 
                                             NOW(), 
                                             ".$this->getPersonaSistema().", 
                                             ".$this->getPersonaSistema().");";
            
            $query_insert_titular=$this->cnxion->ejecutar($sql_insert_titular);

            return $sql_insert_titular;
        }

    }



?>

