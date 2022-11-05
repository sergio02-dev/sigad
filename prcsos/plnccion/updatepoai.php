<?php
include_once('classActvdadPoai.php');

class CtvdadPoai extends ActividadPoai{

  private $sqlupdateActividadPoai;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }



    public function updateActividadPoai(){

        $sqlupdateActividadPoai=" UPDATE planaccion.actividad_poai
                                SET acp_descripcion='".$this->getNombreActividad()."', 
                                    acp_vigencia=".$this->getVigenciaActividad().",
                                    acp_fechamodifico=NOW(), 
                                    acp_personamodifico=".$this->getPersonaSistema().", 
                                    acp_estado='".$this->getEstado()."',
                                    acp_objetivo = '".$this->getObjetivo()."',
                                    acp_sedeindicador = ".$this->getSede().",
                                    acp_unidad = ".$this->getUnidad()."
                                WHERE acp_codigo=".$this->getCodigoActividad().";";

        $this->cnxion->ejecutar($sqlupdateActividadPoai);


        return $sqlupdateActividadPoai;

    }
}
?>
