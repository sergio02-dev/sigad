<?php
include('classPpi.php');
class ClsePPI extends Ppi{
    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function closePpi(){

        $cierre_ppi="UPDATE ppi.estado_ppi_plan
                        SET epp_estado = 1, 
                            epp_fechamodifico = NOW(),
                            epp_personamodifico = ".$this->getPersonaSistema()."
                      WHERE epp_codigo = ".$this->getCodigoPpi().";";

        $this->cnxion->ejecutar($cierre_ppi);
    }
}
?>