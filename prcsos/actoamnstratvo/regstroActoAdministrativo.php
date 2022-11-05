<?php
    
    include('classActoAdmnstrtvo.php');


    class RgstroActoAdminstrtivo extends ActoAdmnistrativo{

        private $codigo_actoadminstrativo;
        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_actoadminstrativo = date('YmdHis').rand(99,999);
        }

        public function insertActoAdministrativo(){
            
            $sql_insert_acto_administrativo="INSERT INTO acto_administrativo.acto_administrativo(
                                                         aad_codigo, 
                                                         aad_codigoreferencia, 
                                                         aad_fechapublicacion, 
                                                         aad_vigencia, 
                                                         aad_titular, 
                                                         aad_fechanotificacion, 
                                                         aad_tipoacto, 
                                                         aad_autoridadambiental, 
                                                         aad_objeto, 
                                                         aad_adjunto,
                                                         aad_estado,
                                                         aad_fechacreo, 
                                                         aad_fechamodifico, 
                                                         aad_personacreo, 
                                                         aad_personamodifico,
                                                         aad_archivoadjunto,
                                                         aad_expediente)
                                                 VALUES (".$this->codigo_actoadminstrativo.", 
                                                         '".$this->getCodigoReferencia()."', 
                                                         '".$this->getFechaPublicacion()."', 
                                                         '".$this->getVigencia()."', 
                                                         '".$this->getTitular()."', 
                                                         '".$this->getFechaNotificacion()."',
                                                         ".$this->getTipoActo().", 
                                                         ".$this->getAutoridadAmbiental().", 
                                                         '".$this->getObjeto()."', 
                                                         '".$this->getAdjunto()."', 
                                                         ".$this->getEstado().", 
                                                         NOW(), 
                                                         NOW(), 
                                                         ".$this->getPersonaSistema().", 
                                                         ".$this->getPersonaSistema().",
                                                         ".$this->getTipoArchivo().",
                                                         ".$this->getExpediente().");";
            
            $query_insert_acto_administrativo=$this->cnxion->ejecutar($sql_insert_acto_administrativo);

            return $sql_insert_acto_administrativo;
        }

    }
?>