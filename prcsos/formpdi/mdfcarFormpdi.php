<?php
include_once('classFormpdi.php');

class MdfcarFormpdi extends PlandeComprasPDI {

    private $sql_insertformpdi;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateformpdi(){
        
        $sql_updateformpdi="UPDATE usco.formulariopdi
                                SET pdi_sede=".$this->getSede().", 
                                pdi_vicerrectoria=".$this->getVicerrectoria().", 
                                pdi_facultad=".$this->getFacultad().", 
                                pdi_dependencia=".$this->getDependencia().", 
                                pdi_area=".$this->getArea().", 
                                pdi_accion=".$this->getAccion().", 
                                pdi_plantafisica='".$this->getPlantafisica()."', 
                                pdi_linea=".$this->getLineaequipo().", 
                                pdi_sublinea=".$this->getSublineaequipo().", 
                                pdi_equipo=".$this->getEquipo().", 
                                pdi_equipodescripcion=".$this->getCaracteristicas().", 
                                pdi_valorunitario=".$this->getValorunitario().", 
                                pdi_cantidad=".$this->getCantidad().", 
                                pdi_fechacreo=NOW(), 
                                pdi_fechamodifico=NOW(), 
                                pdi_personacreo=".$this->getPersonaSistema().", 
                                pdi_personamodifico=".$this->getPersonaSistema().",
                                pdi_estado = ".$this->getEstado()."
                            WHERE pdi_codigo = ".$this->getCodigo().";";
        
        
        $this->cnxion->ejecutar($sql_updateformpdi);

        return $sql_updateformpdi;

    }
}
?>