<?php
include('classPoai.php');
class RgstroPOAI extends POAI{

    private $insert_poai;
    private $codigoPoai;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoPoai=date('YmdHis').rand(99,99999);
    }

    public function insertPOAI(){

        $insert_poai="INSERT INTO planaccion.poai_veinte_veintidos(
                                  poav_codigo, 
                                  poav_accion, 
                                  poav_fuentefinanciacion, 
                                  poav_sede, 
                                  poav_recurso, 
                                  poav_estado, 
                                  poav_fechacreo, 
                                  poav_fechamodifico, 
                                  poav_personacreo, 
                                  poav_personamodifico,
                                  poav_vigencia,
                                  poav_indicador,
                                  poav_adicion,
                                  poav_acuerdo)
                          VALUES (".$this->codigoPoai.", 
                                  ".$this->getAccion().", 
                                  ".$this->getFuente().", 
                                  ".$this->getSede().", 
                                  ".$this->getRecurso().", 
                                  ".$this->getEstado().", 
                                  NOW(), 
                                  NOW(), 
                                  ".$this->getPersonaSistema().", 
                                  ".$this->getPersonaSistema().",
                                  ".$this->getVigencia().",
                                  ".$this->getIndicador().",
                                  ".$this->getAdicion().",
                                  ".$this->getAcuerdo().");";

        $this->cnxion->ejecutar($insert_poai);
        
        return $insert_poai;
    }
}
?>