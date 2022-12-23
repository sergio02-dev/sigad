<?php
include_once('classFormpdi.php');

class RgstroFormpdi extends PlandeComprasPDI {

    private $sql_insertformpdi;
    private $codigo_formpdi;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_formpdi =date('YmdHis').rand(99,99999);
    }

    public function insertFormpdi(){
        
        $sql_insertformpdi="INSERT INTO usco.formulariopdi(
                            pdi_codigo, 
                            pdi_sede, 
                            pdi_vicerrectoria, 
                            pdi_facultad, 
                            pdi_dependencia, 
                            pdi_area,  
                            pdi_accion, 
                            pdi_plantafisica, 
                            pdi_linea, 
                            pdi_sublinea, 
                            pdi_equipo, 
                            pdi_equipodescripcion, 
                            pdi_valorunitario, 
                            pdi_cantidad, 
                            pdi_fechacreo, 
                            pdi_fechamodifico, 
                            pdi_personacreo, 
                            pdi_personamodifico,
                            pdi_estado)
                            VALUES (".$this->codigo_formpdi.",
                                    ".$this->getSede().",
                                    ".$this->getVicerrectoria().",
                                    ".$this->getFacultad().",
                                    ".$this->getDependencia().",
                                    ".$this->getArea().",
                                    ".$this->getAccion().",
                                    '".$this->getPlantafisica()."',
                                    ".$this->getLineaequipo().",
                                    ".$this->getSublineaequipo().",
                                    ".$this->getEquipo().",
                                    ".$this->getCaracteristicas().",
                                    ".$this->getValorunitario().",
                                    ".$this->getCantidad().",
                                    NOW(),
                                    NOW(),
                                    ".$this->getPersonaSistema().",
                                    ".$this->getPersonaSistema().",
                                      1)";

        $this->cnxion->ejecutar($sql_insertformpdi);

        return $sql_insertformpdi;

    }
}
?>