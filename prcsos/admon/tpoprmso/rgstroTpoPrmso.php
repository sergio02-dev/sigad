<?php
    
    include('classTipoPermiso.php');

    class RgstroTpoPrmso extends TipoPermiso{

        private $codigo_tipo_permiso;
        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_tipo_permiso = date('YmdHis').rand(99,999);
        }

        public function insert_tpoprmso(){
            
            $sql_insert_tipo_prmso="INSERT INTO principal.tipo_permiso(
                                                tpe_codigo, 
                                                tpe_descripcion, 
                                                tpe_estado, 
                                                tpe_fechacreo, 
                                                tpe_fechamodifico, 
                                                tpe_personacreo, 
                                                tpe_personamodifico,
                                                tpe_campoescritura)
                                        VALUES (".$this->codigo_tipo_permiso.", 
                                                '".$this->getNombreTipoPermiso()."', 
                                                ".$this->getEstadoTipoPermiso().", 
                                                NOW(), 
                                                NOW(), 
                                                ".$this->getPersonaSistema().", 
                                                ".$this->getPersonaSistema().",
                                                ".$this->getTextoTipoPermiso().");";
            
            $query_insert_tipo_prmiso = $this->cnxion->ejecutar($sql_insert_tipo_prmso);

            return $sql_insert_tipo_prmso;
        }

    }



?>

