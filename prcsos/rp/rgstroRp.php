<?php
    include('classRp.php');
    class RgstroRp extends Rp{
        private $codigo_rp;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_rp = date('YmdHis').rand(99,99999);
        }

        public function registro_rp(){
        
            $insert_rp = "INSERT INTO cdp.rp(
                                      rp_codigo, 
                                      rp_cdp, 
                                      rp_fecha, 
                                      rp_numerorp, 
                                      rp_otrovalor, 
                                      rp_valor,
                                      rp_fechacreo, 
                                      rp_fechamodifico, 
                                      rp_personacreo, 
                                      rp_personamodifico,
                                      rp_proveedor,
                                      rp_actoadmin,
                                      rp_servicio)
                              VALUES (".$this->codigo_rp.", 
                                      ".$this->getCodigoCdp().", 
                                      '".$this->getFecha()."', 
                                      ".$this->getNumero().", 
                                      ".$this->getOtroValor().",
                                      ".$this->getValorRP().",
                                      NOW(), 
                                      NOW(), 
                                      ".$this->getPersonaSistema().", 
                                      ".$this->getPersonaSistema().",
                                      '".$this->getProveedor()."',
                                      '".$this->getActoAdministrativo()."',
                                      '".$this->getServicio()."');";
    
            $resultado = $this->cnxion->ejecutar($insert_rp);

            return $insert_rp;
        }

        
    }
    
?>