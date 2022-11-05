<?php
    
    include('classTitular.php');

    class MdfcarTtlar extends Titular{

        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }
        
        public function update_titular(){

            if($this->getTipoTitular() == 0){
                if($this->getLogoTitular()){
                    $logo_update = ", tit_logo = '".$this->getLogoTitular()."'";
                }
                else{
                    $logo_update = "";
                }
            }
            else{
                $logo_update = ", tit_logo = ''";
            }
            
             
            
            $sql_update_titular="UPDATE principal.titular
                                    SET tit_tipotitular = ".$this->getTipoTitular().", 
                                        tit_tipoidentificacion = ".$this->getTipoIdTitular().", 
                                        tit_identificacion = '".$this->getNumeroTitular()."', 
                                        tit_digitoverificacion = ".$this->getDigitoTitular().", 
                                        tit_nombre = '".$this->getNombreTitular()."', 
                                        tit_sigla = '".$this->getSiglaTitular()."', 
                                        tit_correo = '".$this->getCorreoTitular()."', 
                                        tit_direccion = '".$this->getDireccionTitular()."', 
                                        tit_estado = ".$this->getEstadoTitular().", 
                                        tit_fechamodico = NOW(), 
                                        tit_personamodifico = ".$this->getPersonaSistema()."
                                        $logo_update
                                  WHERE tit_codigo = ".$this->getCodigoTitular().";";
            
            $query_update_titular=$this->cnxion->ejecutar($sql_update_titular);

            return $sql_update_titular;
        }

    }



?>

