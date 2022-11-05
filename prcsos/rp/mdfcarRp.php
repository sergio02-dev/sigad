<?php
    include('classRp.php');
    class MdfcarRp extends Rp{
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function modificar_rp(){
        
            $updte_rp = "UPDATE cdp.rp
                            SET rp_fecha = '".$this->getFecha()."', 
                                rp_numerorp = ".$this->getNumero().", 
                                rp_otrovalor = ".$this->getOtroValor().", 
                                rp_valor = ".$this->getValorRP().", 
                                rp_fechamodifico = NOW(), 
                                rp_personamodifico = ".$this->getPersonaSistema().",
                                rp_proveedor = '".$this->getProveedor()."',
                                rp_actoadmin = '".$this->getActoAdministrativo()."',
                                rp_servicio = '".$this->getServicio()."'
                          WHERE rp_codigo = ".$this->getCodigo().";";
    
            $resultado = $this->cnxion->ejecutar($updte_rp);

            return $updte_rp;
        }

        
    }
    
?>