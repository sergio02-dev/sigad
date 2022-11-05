<?php
include('classPoai.php');
class MdfcarPOAI extends POAI{

    private $update_poai;
    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updatePOAI(){

        $update_poai="UPDATE planaccion.poai_veinte_veintidos
                         SET poav_accion=".$this->getAccion().", 
                             poav_fuentefinanciacion=".$this->getFuente().", 
                             poav_sede=".$this->getSede().", 
                             poav_recurso=".$this->getRecurso().", 
                             poav_estado=".$this->getEstado().", 
                             poav_fechamodifico=NOW(),
                             poav_personamodifico=".$this->getPersonaSistema().",
                             poav_vigencia = ".$this->getVigencia().",
                             poav_indicador = ".$this->getIndicador().",
                             poav_adicion = ".$this->getAdicion().",
                             poav_acuerdo = ".$this->getAcuerdo()."
                       WHERE poav_codigo=".$this->getCodigo().";";

        $this->cnxion->ejecutar($update_poai);
        
        return $update_poai;
    }
}
?>