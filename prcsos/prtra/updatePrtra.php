<?php
include('classPrtra.php');
class UpdatePrtra extends Apertura{

    private $update_apertura;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateApertura(){

        $update_apertura="UPDATE planaccion.apertura_reporte
                             SET apr_fechainicio='".$this->getFechaInicio()."', apr_fechafin='".$this->getFechaFin()."', apr_trimestres=".$this->getTrimestre().", 
                                 apr_fechamodifico=NOW(), apr_personamodifico=".$this->getPersonaSistema().", apr_trim=".$this->getTrim()."
                           WHERE apr_codigo=".$this->getCodigoApertura().";";

        $this->cnxion->ejecutar($update_apertura);

        
        return $update_apertura;
    }
}
?>