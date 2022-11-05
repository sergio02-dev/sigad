<?php
include_once('classPlnccion.php');

class PlnAccon extends PlanAccion{

  private $sqlupdateEtapas;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }


    public function suma(){
      $sqlnumero="SELECT SUM(poa_logro) AS numerosuma
                         FROM planaccion.poai
                         WHERE acp_codigo=".$this->getCodigoActividad().";";
      $querynumero=$this->cnxion->ejecutar($sqlnumero);
      $data_numero=$this->cnxion->obtener_filas($querynumero);

      $numeroSuma=$data_numero['numerosuma'];

      return $numeroSuma;
    }

    public function updateActividadPoai(){

        $sqlupdateEtapas=" UPDATE planaccion.poai
                                SET poa_objeto='".$this->getObjeto()."', 
                                    poa_recurso=".$this->getRecurso().",
                                    poa_logro=".$this->getLogro().",
                                    poa_logroejecutado=".$this->getLogroEjecutado().",
                                    poa_vigencia=".$this->getVigenciaActividad().",
                                    poa_fechamodifico=NOW(), 
                                    poa_personamodifico=".$this->getPersonaSistema().",
                                    poa_estado='".$this->getEstado()."',
                                    poa_codigoclasificadorpresupuestal = '".$this->getCodigoClasificador()."',
                                    poa_descripcionclasificador = '".$this->getDescripcionClasificador()."',
                                    poa_dane = '".$this->getDane()."',
                                    poa_plancompras = ".$this->getPlanCompras()."
                              WHERE poa_codigo=".$this->getCodigoPoai().";";

        $this->cnxion->ejecutar($sqlupdateEtapas);


        return $sqlupdateEtapas;

    }
}
?>
