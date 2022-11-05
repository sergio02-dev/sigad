<?php
    
    include('classSector.php');


    class mdfcarSctor extends Sector{

        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function update_sctor(){
            
            $sql_update_sector  ="UPDATE principal.sector
                                     SET sec_numero = '".$this->getNumeroSector()."', 
                                         sec_descripcion = '".$this->getNombreSector()."', 
                                         sec_estado = ".$this->getEstadoSector().",
                                         sec_fechamodifico = NOW(),
                                         sec_personamodifico = ".$this->getPersonaSistema()."
                                   WHERE sec_codigo = ".$this->getCodigoSector().";";
            
            $query_update_sector = $this->cnxion->ejecutar($sql_update_sector);

            return $sql_update_sector;
        }

    }



?>

