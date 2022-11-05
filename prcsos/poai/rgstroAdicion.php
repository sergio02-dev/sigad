<?php
include('classAdicion.php');
class RgstroAdicionPOAI extends AdicionPOAI{

    private $insert_adicion;
    private $codigoAdicion;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoAdicion=date('YmdHis').rand(99,99999);
    }

    public function insertAdiccion(){

        $insert_adicion="INSERT INTO planaccion.adicion_poai(
                                     apoai_codigo, 
                                     apoai_poai, 
                                     apoai_saldo, 
                                     apoai_valor, 
                                     apoai_estado, 
                                     apoai_fechacreo, 
                                     apoai_fechamodifico, 
                                     apoai_personacreo, 
                                     apoai_personamodifico)
                             VALUES (".$this->codigoAdicion.", 
                                     ".$this->getCodigoPoai().", 
                                     ".$this->getCodigoSaldo().", 
                                     ".$this->getRecurso().", 
                                     ".$this->getEstado().", 
                                     NOW(), 
                                     NOW(), 
                                     ".$this->getPersonaSistema().", 
                                     ".$this->getPersonaSistema().");";

        $this->cnxion->ejecutar($insert_adicion);
        
        return $insert_adicion;
    }
}
?>