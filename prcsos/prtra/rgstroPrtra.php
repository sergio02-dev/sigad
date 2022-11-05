<?php
include('classPrtra.php');
class RgstroPrtra extends Apertura{

    private $insert_apertura;
    private $codigoApertura;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoApertura=date('YmdHis').rand(99,99999);
    }

    public function insertApertura(){

        $insert_apertura="INSERT INTO planaccion.apertura_reporte(
                                      apr_codigo, apr_fechainicio, apr_fechafin, apr_trimestres, apr_estado, 
                                      apr_fechacreo, apr_fechamodifico, apr_personacreo, apr_personamodifico,
                                      apr_trim)
                               VALUES (".$this->codigoApertura.", '".$this->getFechaInicio()."', '".$this->getFechaFin()."', ".$this->getTrimestre().", '1', 
                                       NOW(), NOW(), ".$this->getPersonaSistema().", ".$this->getPersonaSistema().",
                                       ".$this->getTrim().");";

        $this->cnxion->ejecutar($insert_apertura);

        
        return $insert_apertura;
    }
}
?>