<?php
    
    include('classActoAdmnstrtvo.php');


    class MdfcarActoAdminstrtivo extends ActoAdmnistrativo{

        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function updateActoAdministrativo(){

            if($this->getAdjunto()){
                $adjunto = ", aad_adjunto = '".$this->getAdjunto()."'";
            }
            else{
                $adjunto = "";
            }
            
            $sql_update_acto_administrativo="UPDATE acto_administrativo.acto_administrativo
                                                SET aad_codigoreferencia = '".$this->getCodigoReferencia()."', 
                                                    aad_fechapublicacion = '".$this->getFechaPublicacion()."', 
                                                    aad_vigencia = '".$this->getVigencia()."', 
                                                    aad_titular = '".$this->getTitular()."', 
                                                    aad_fechanotificacion = '".$this->getFechaNotificacion()."', 
                                                    aad_tipoacto = ".$this->getTipoActo().", 
                                                    aad_autoridadambiental = ".$this->getAutoridadAmbiental().", 
                                                    aad_objeto = '".$this->getObjeto()."',  
                                                    aad_estado = ".$this->getEstado().", 
                                                    aad_fechamodifico = NOW(),
                                                    aad_personamodifico = ".$this->getPersonaSistema()."
                                                    $adjunto
                                              WHERE aad_codigo = ".$this->getCodigo().";";
            
            $query_update_acto_administrativo=$this->cnxion->ejecutar($sql_update_acto_administrativo);

            return $sql_update_acto_administrativo;
        }

    }
?>