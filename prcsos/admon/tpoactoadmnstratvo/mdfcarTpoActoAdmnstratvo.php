<?php
    
    include('classTpoActoAdmnstratvo.php');


    class MdfcarTpoActoAdmnstrtvo extends TipoActoAdministrativo{

        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function update_tpoactoadmnstrtvo(){
            
            $sql_update_tipo_acto="UPDATE principal.tipo_acto_administrativo
                                      SET taa_descripcion = '".$this->getNombreTipoActoAdministrativo()."', 
                                          taa_estado = ".$this->getEstadoTipoActoAdministrativo().", 
                                          taa_fechamodifico = NOW(), 
                                          taa_personamodifico = ".$this->getPersonaSistema()."
                                    WHERE taa_codigo = ".$this->getCodigoTipoActoAdministrativo().";";
            
            $query_update_tipo_acto = $this->cnxion->ejecutar($sql_update_tipo_acto);

            return $sql_update_tipo_acto;
        }

    }



?>

