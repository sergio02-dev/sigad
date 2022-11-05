<?php
include('classTrsldo.php');
class MdfcarTrsldo extends TrasladosPOAI{

    private $insert_poai;
    private $codigoTraslado;
    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoTraslado = date('YmdHis').rand(99,99999);
    }

    public function updteTraslado(){

        $updte_trldo="UPDATE planaccion.traslados_poai
                         SET tpo_accion = ".$this->getAccion().", 
                             tpo_codigorecuerso = ".$this->getRecurso().", 
                             tpo_valor = ".$this->getSaldo().", 
                             tpo_acuerdo = ".$this->getAcuerdo().", 
                             tpo_sede = ".$this->getSede().", 
                             tpo_indicador = ".$this->getIndicador().", 
                             tpo_estado = ".$this->getEstado().", 
                             tpo_fechamodifico = NOW(), 
                             tpo_personamodifico = ".$this->getPersonaSistema()."
                       WHERE tpo_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($updte_trldo);
        
        return $updte_trldo;
    }
}
?>