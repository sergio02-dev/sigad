<?php
include_once('classActvdadPoai.php');

class CtvdadPoai extends ActividadPoai{

  private $sqlInsertAcc;
  private $codigoaccion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoActividad=date('YmdHis').rand(99,99999);
    }

    public function numero($codigoccion){
      $sqlnumero="SELECT MAX(acp_numero) AS numero
                         FROM planaccion.actividad_poai
                         WHERE acp_accion=$codigoccion;";
       $querynumero=$this->cnxion->ejecutar($sqlnumero);

      $data_numero=$this->cnxion->obtener_filas($querynumero);

      $numero=$data_numero['numero'];

      return $numero;
    }
    public function numeroActividades($codigoccion, $persona){
      $sqlnumeroActividad="SELECT COUNT (acp_codigo) AS numeroactividad
                         FROM planaccion.actividad_poai
                         WHERE acp_accion=$codigoccion
                          AND acp_personacreo=$persona;";

      $querynumeroActividad=$this->cnxion->ejecutar($sqlnumeroActividad);

      $data_numeroActividad=$this->cnxion->obtener_filas($querynumeroActividad);

      $numeroactividad=$data_numeroActividad['numeroactividad'];

      return $numeroactividad;
    }

    public function insertRegistroActividadPoai(){

      $codigoccion=$this->getCodigoAccion();

      $numeroAccion=$this->numero($codigoccion);
      //echo "------>".$numeroAccion;
      if($numeroAccion){
        $numero_Accion=$numeroAccion+1;
      }
      else{
        $numero_Accion=1;
      }


        $sqlInsertAcc="INSERT INTO planaccion.actividad_poai(acp_codigo, acp_descripcion, acp_accion, acp_proyecto, 
                                                             acp_referencia, acp_estado, acp_fechacreo, acp_fechamodifico, acp_personacreo,
                                                            acp_personamodifico, acp_vigencia, acp_numero, acp_subsistema,
                                                            acp_objetivo)
                                                    VALUES (".$this->codigoActividad.", ' ".$this->getNombreActividad()."', ".$this->getCodigoAccion().",". $this->getCodigoProyecto().",
                                                            '".$this->getReferencia()."', '".$this->getEstado()."', NOW(), NOW(),".$this->getPersonaSistema().", ".$this->getPersonaSistema().",
                                                            ".$this->getVigenciaActividad().", ".$numero_Accion.",".$this->getCodigoSubsistema().",
                                                            '".$this->getObjetivo()."');";

        $this->cnxion->ejecutar($sqlInsertAcc);


        return $sqlInsertAcc;

    }
}
?>
