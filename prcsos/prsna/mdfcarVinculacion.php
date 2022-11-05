<?php
/**
 * Karen Yuliana Palacio Minú
 * 15 de Enero 2020 12:29pm
 * Modificar Vinculacion
 */
include('classVinculacion.php');
class MdfcarVnclcion extends Vinculacion{

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function mdfcar_vinculacion(){

        $update_vnculacion="UPDATE usco.vinculacion
                               SET vin_oficina = ".$this->getOficina().", 
                                   vin_cargo = ".$this->getCargo().", 
                                   vin_estado = ".$this->getEstado().", 
                                   vin_fechamodifico = NOW(), 
                                   vin_personamodifico = ".$this->getPersonaSistema()."
                             WHERE vin_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($update_vnculacion);
        
        return $update_vnculacion;
    }
}
?>