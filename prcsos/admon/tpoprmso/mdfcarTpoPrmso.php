<?php
    
    include('classTipoPermiso.php');

    class MdfcarTpoPrmso extends TipoPermiso{

        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function mdfcar_tpoprmso(){
            
            $sql_mdfcar_tipo_prmso="UPDATE principal.tipo_permiso
                                       SET tpe_descripcion = '".$this->getNombreTipoPermiso()."', 
                                           tpe_campoescritura = ".$this->getTextoTipoPermiso().", 
                                           tpe_estado = ".$this->getEstadoTipoPermiso().", 
                                           tpe_fechamodifico = NOW(), 
                                           tpe_personamodifico = ".$this->getPersonaSistema()."
                                     WHERE tpe_codigo = ".$this->getCodigoTipoPermiso().";";
            
            $query_mdfcar_tipo_prmiso = $this->cnxion->ejecutar($sql_mdfcar_tipo_prmso);

            return $sql_mdfcar_tipo_prmso;
        }

    }



?>

