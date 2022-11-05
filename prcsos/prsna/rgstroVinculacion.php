<?php
/**
 * Karen Yuliana Palacio Minú
 * 15 de Enero 2020 12:29pm
 * Registro Vinculacion
 */
include('classVinculacion.php');
class RgstroVnclcion extends Vinculacion{

    private $codigo_vinculacion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_vinculacion = date('YmdHis').rand(99,99999);
    }

    public function insert_vinculacion(){

        $insert_vnculacion="INSERT INTO usco.vinculacion(
                                        vin_codigo, 
                                        vin_persona, 
                                        vin_oficina, 
                                        vin_cargo, 
                                        vin_estado, 
                                        vin_fechacreo, 
                                        vin_fechamodifico, 
                                        vin_personacreo, 
                                        vin_personamodifico)
                                VALUES (".$this->codigo_vinculacion.", 
                                        ".$this->getPersona().", 
                                        ".$this->getOficina().", 
                                        ".$this->getCargo().", 
                                        ".$this->getEstado().", 
                                        NOW(), 
                                        NOW(), 
                                        ".$this->getPersonaSistema().", 
                                        ".$this->getPersonaSistema().");";

        $this->cnxion->ejecutar($insert_vnculacion);
        
        return $insert_vnculacion;
    }
}
?>