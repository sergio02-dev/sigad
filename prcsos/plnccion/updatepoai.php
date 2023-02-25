<?php
include_once('classActvdadPoai.php');

class CtvdadPoai extends ActividadPoai{

  private $sqlupdateActividadPoai;
  

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
       
    }

 



    public function updateActividadPoai(){
        $acp_sedeindicador = $_REQUEST['acp_sedeindicador'];
        $this->codigoActividad=date('YmdHis').rand(99,99999);

        $sqlupdateActividadPoai=" UPDATE planaccion.actividad_poai
                                    SET acp_descripcion='".$this->getNombreActividad()."', 
                                        acp_vigencia=".$this->getVigenciaActividad().",
                                        acp_fechamodifico=NOW(), 
                                        acp_personamodifico=".$this->getPersonaSistema().", 
                                        acp_estado='".$this->getEstado()."',
                                        acp_objetivo = '".$this->getObjetivo()."',
                                        acp_sedeindicador = 0,
                                        acp_unidad = 0
                                    WHERE acp_codigo=".$this->getCodigoActividad().";";

        $this->cnxion->ejecutar($sqlupdateActividadPoai);

        $datos_indicadores = $this->getArrayIndicadores();

        if($acp_sedeindicador > 0){
            if ($datos_indicadores) {
                foreach ($datos_indicadores as $dta_indicadores) {

                    $codigo_indicador = $dta_indicadores['codigo_indicador'];
                    $unidad_indicador = $dta_indicadores['unidad_indicador'];
            
                    $codigo_unidad_indicador = date('YmdHis') . rand(99, 99999);
            
                    $sqlupdateActividadIndicadorAntiguo = "INSERT INTO planaccion.actividad_indicador(
                                                                                        ain_codigo, 
                                                                                        ain_actividad, 
                                                                                        ain_indicador, 
                                                                                        ain_estado, 
                                                                                        ain_fechacreo, 
                                                                                        ain_fechamodifico, 
                                                                                        ain_personacre, 
                                                                                        ain_personamodifico,
                                                                                        ain_unidad)
                                                                                VALUES (".$codigo_unidad_indicador.",
                                                                                        ".$this->getCodigoActividad().",
                                                                                        $codigo_indicador,
                                                                                        ".$this->getEstado().",
                                                                                            NOW(), 
                                                                                            NOW(), 
                                                                                            ".$this->getPersonaSistema().",
                                                                                            ".$this->getPersonaSistema().", 
                                                                                            $unidad_indicador);";

                    $this->cnxion->ejecutar($sqlupdateActividadIndicadorAntiguo);
                    
                    echo $sqlupdateActividadIndicadorAntiguo;
                }
            }

        }
        else{

            $sqlupdateActividadIndicadorDeshabilitar="UPDATE planaccion.actividad_indicador
                                                         SET ain_estado=0 
                                                       WHERE ain_actividad=".$this->getCodigoActividad().";";

            $this->cnxion->ejecutar($sqlupdateActividadIndicadorDeshabilitar);            
      

            if ($datos_indicadores) {
                foreach ($datos_indicadores as $dta_indicadores) {

                    $codigo_indicador = $dta_indicadores['codigo_indicador'];
                    $unidad_indicador = $dta_indicadores['unidad_indicador'];
            
                    $codigo_unidad_indicador = date('YmdHis') . rand(99, 99999);
            
                    $sqlupdateActividadIndicador = "INSERT INTO planaccion.actividad_indicador(
                                                                                        ain_codigo, 
                                                                                        ain_actividad, 
                                                                                        ain_indicador, 
                                                                                        ain_estado, 
                                                                                        ain_fechacreo, 
                                                                                        ain_fechamodifico, 
                                                                                        ain_personacre, 
                                                                                        ain_personamodifico,
                                                                                        ain_unidad)
                                                                                VALUES (".$codigo_unidad_indicador.",
                                                                                        ".$this->getCodigoActividad().",
                                                                                        $codigo_indicador,
                                                                                        ".$this->getEstado().",
                                                                                            NOW(), 
                                                                                            NOW(), 
                                                                                            ".$this->getPersonaSistema().",
                                                                                            ". $this->getPersonaSistema().", 
                                                                                            $unidad_indicador);";

                    $this->cnxion->ejecutar($sqlupdateActividadIndicador);
                    echo $sqlupdateActividadIndicador;
                }
            }

        }

        

    }
}
?>
