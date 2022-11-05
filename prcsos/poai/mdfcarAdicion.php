<?php
include('classAdicion.php');
class MdfcarAdicionPOAI extends AdicionPOAI{

    private $update_adicion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updteAdiccion(){

        $update_adicion="UPDATE planaccion.adicion_poai
                            SET apoai_poai = ".$this->getCodigoPoai().", 
                                apoai_saldo = ".$this->getCodigoSaldo().", 
                                apoai_valor = ".$this->getRecurso().", 
                                apoai_estado = ".$this->getEstado().",
                                apoai_fechamodifico = NOW(),
                                apoai_personamodifico = ".$this->getPersonaSistema()."
                          WHERE apoai_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($update_adicion);
        
        return $update_adicion;
    }
}
?>