<?php
include('classTrsldo.php');
class RgstroTrsldo extends TrasladosPOAI{

    private $insert_poai;
    private $codigoTraslado;
    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoTraslado = date('YmdHis').rand(99,99999);
    }

    public function insertTraslado(){

        $insert_trldo="INSERT INTO planaccion.traslados_poai(
                                   tpo_codigo, 
                                   tpo_poai, 
                                   tpo_accion, 
                                   tpo_codigorecuerso, 
                                   tpo_valor, 
                                   tpo_acuerdo, 
                                   tpo_sede, 
                                   tpo_indicador, 
                                   tpo_estado, 
                                   tpo_fechacreo, 
                                   tpo_fechamodifico, 
                                   tpo_personacreo, 
                                   tpo_personamodifico)
                           VALUES (".$this->codigoTraslado.", 
                                   ".$this->getPoai().", 
                                   ".$this->getAccion().", 
                                   ".$this->getRecurso().", 
                                   ".$this->getSaldo().",
                                   ".$this->getAcuerdo().", 
                                   ".$this->getSede().", 
                                   ".$this->getIndicador().", 
                                   ".$this->getEstado().", 
                                   NOW(), 
                                   NOW(), 
                                   ".$this->getPersonaSistema().", 
                                   ".$this->getPersonaSistema().");";

        $this->cnxion->ejecutar($insert_trldo);
        
        return $insert_trldo;
    }
}
?>