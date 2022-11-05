<?php
    
    include('classTpoActoAdmnstratvo.php');


    class RgstroTpoActoAdmnstrtvo extends TipoActoAdministrativo{

        private $codigo_tipo_acto;
        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_tipo_acto = date('YmdHis').rand(99,999);
        }

        public function insert_tpoactoadmnstrtvo(){
            
            $sql_insert_tipo_acto="INSERT INTO principal.tipo_acto_administrativo(
                                               taa_codigo, 
                                               taa_descripcion, 
                                               taa_estado, 
                                               taa_fechacreo, 
                                               taa_fechamodifico, 
                                               taa_personacreo, 
                                               taa_personamodifico)
                                       VALUES (".$this->codigo_tipo_acto.", 
                                               '".$this->getNombreTipoActoAdministrativo()."', 
                                               ".$this->getEstadoTipoActoAdministrativo().", 
                                               NOW(), 
                                               NOW(), 
                                               ".$this->getPersonaSistema().", 
                                               ".$this->getPersonaSistema().");";
            
            $query_insert_tipo_acto = $this->cnxion->ejecutar($sql_insert_tipo_acto);

            return $sql_insert_tipo_acto;
        }

    }



?>

