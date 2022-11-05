<?php
include('classResponsable.php');
class MdfcarRspnsble extends Responsable{

    private $updte_responsable;
    private $codigo_responsable;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_responsable = date('YmdHis').rand(99,99999);
    }

    public function updteResponsable(){

        $updte_responsable="UPDATE usco.responsable
                               SET res_nivel = ".$this->getNivel().", 
                                   res_codigonivel = ".$this->getCodigoNivel().", 
                                   res_codigocargo = ".$this->getCargo().", 
                                   res_codigooficina = ".$this->getOficina().", 
                                   res_estado = ".$this->getEstado().", 
                                   res_fechamodifico = NOW(), 
                                   res_personamodifico = ".$this->getPersonaSistema()."
                             WHERE res_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($updte_responsable);

        return $updte_responsable;
    }
}
?>