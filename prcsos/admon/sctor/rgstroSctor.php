<?php
    
    include('classSector.php');


    class RgstroSctor extends Sector{

        private $codigo_sector;
        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_sector = date('YmdHis').rand(99,999);
        }

        public function insert_sctor(){
            
            $sql_insert_sector="INSERT INTO principal.sector(
                                            sec_codigo, 
                                            sec_numero, 
                                            sec_descripcion, 
                                            sec_estado, 
                                            sec_fechacreo, 
                                            sec_fechamodifico, 
                                            sec_personacreo, 
                                            sec_personamodifico)
                                    VALUES (".$this->codigo_sector.", 
                                            '".$this->getNumeroSector()."', 
                                            '".$this->getNombreSector()."', 
                                            ".$this->getEstadoSector().", 
                                            NOW(), 
                                            NOW(), 
                                            ".$this->getPersonaSistema().", 
                                            ".$this->getPersonaSistema().");";
            
            $query_insert_eps=$this->cnxion->ejecutar($sql_insert_sector);

            return $sql_insert_sector;
        }

    }



?>

