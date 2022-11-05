<?php
include_once('classPlnccion.php');

class PlnAccon extends PlanAccion{

  private $sqlInsertAcc;
  private $codigoaccion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoetapa=date('YmdHis').rand(99,99999);
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
    public function numeroEtapas(){
      $sqlnumeroEtapas="SELECT COUNT (poa_codigo) AS numeroetapas
                         FROM planaccion.poai
                         WHERE acp_codigo=".$this->getCodigoActividad().";";

      $querynumeroEtapas=$this->cnxion->ejecutar($sqlnumeroEtapas);

      $data_numeroEtapas=$this->cnxion->obtener_filas($querynumeroEtapas);

      $numeroetapas=$data_numeroEtapas['numeroetapas'];

      return $numeroetapas;
    }

    public function numero($codigoccion){
      $sqlnumero="SELECT MAX(poa_numero) AS numero
                         FROM planaccion.poai
                         WHERE acp_codigo=$codigoccion;";
       $querynumero=$this->cnxion->ejecutar($sqlnumero);

      $data_numero=$this->cnxion->obtener_filas($querynumero);

      $numero=$data_numero['numero'];

      return $numero;
    }
    public function insertPlanAccion(){
      $codigoccion=$this->getCodigoActividad();
      $numeroAccion=$this->numero($codigoccion);
      //echo "------>".$numeroAccion;
      if($numeroAccion){
        $numero_Accion=$numeroAccion+1;
      }
      else{
        $numero_Accion=1;
      }


      $sqlInsertAcc="INSERT INTO planaccion.poai(poa_codigo, poa_referencia, 
                                                poa_objeto, poa_recurso, 
                                                poa_logro, poa_fechacreo, 
                                                poa_fechamodifico, poa_personacreo,
                                                poa_personamodifico, poa_estado, 
                                                poa_numero, poa_vigencia,
                                                acp_codigo,poa_logroejecutado,
                                                poa_codigoclasificadorpresupuestal, 
                                                poa_descripcionclasificador,
                                                poa_dane,
                                                poa_plancompras)
                                        VALUES (".$this->codigoetapa.",  '". $this->getReferencia()."',
                                                '".$this->getObjeto()."', ".$this->getRecurso().",
                                                ".$this->getLogro().", NOW(), 
                                                NOW(),".$this->getPersonaSistema().", 
                                                ".$this->getPersonaSistema().",
                                                '".$this->getEstado()."',".$numero_Accion.", 
                                                ".$this->getVigenciaActividad().",
                                                ".$this->getCodigoActividad().",
                                                ".$this->getLogroEjecutado().",
                                                '".$this->getCodigoClasificador()."',
                                                '".$this->getDescripcionClasificador()."',
                                                '".$this->getDane()."',
                                                ".$this->getPlanCompras().");";

      $this->cnxion->ejecutar($sqlInsertAcc);


      return $sqlInsertAcc;

    }
}
?>
