<?php
include_once('classCrtfcdos.php');

class Crtfcdos extends Certificados{

  private $sqlInsertRac;
  private $codigoActividad;
  private $codigoCostos;

  public function __construct(){
    $this->cnxion = Dtbs::getInstance();
    $this->codigoActividad=date('YmdHis').rand(99,99999);
    $this->codigoCostos=date('YmdHis').rand(99,99999);
  }


  public function info_etapa($code_etapa){

    $sql_info_etapa="SELECT poa_codigo, acp_codigo, poa_recurso
                      FROM planaccion.poai
                    WHERE poa_codigo = $code_etapa;";

    $resultado_info_etapa=$this->cnxion->ejecutar($sql_info_etapa);

    while ($data_info_etapa = $this->cnxion->obtener_filas($resultado_info_etapa)){
      $datainfo_etapa[] = $data_info_etapa;
    }
    return $datainfo_etapa;
  }

  public function proyecto_accion($codigo_accion){

    $sql_proyecto_accion="SELECT acc_codigo, acc_referencia, acc_proyecto
                            FROM plandesarrollo.accion
                          WHERE acc_codigo = $codigo_accion;";

    $resultado_proyecto_accion=$this->cnxion->ejecutar($sql_proyecto_accion);

    $data_proyecto_accion = $this->cnxion->obtener_filas($resultado_proyecto_accion);

    $acc_proyecto = $data_proyecto_accion['acc_proyecto'];

    return $acc_proyecto;
  }

  public function info_etapa_mod($codigo_certificado){

    $sql_info_etapa_mod="SELECT cee_codigo, cee_certificado, 
                                cee_actividad, cee_etapa, 
                                cee_vigencia, cee_valor
                           FROM planaccion.certificado_etapa
                          WHERE cee_certificado = $codigo_certificado;";

    $resultado_info_etapa_mod=$this->cnxion->ejecutar($sql_info_etapa_mod);

    while ($data_info_etapa_mod = $this->cnxion->obtener_filas($resultado_info_etapa_mod)){
      $datainfo_etapa_mod[] = $data_info_etapa_mod;
    }
    return $datainfo_etapa_mod;
  }

  public function insertCertificados(){

    $sqlInsertRac=" INSERT INTO planaccion.actividad(act_codigo, act_descripcion, 
                                                    act_fechaexpedicion, act_accion, 
                                                    act_proyecto, act_dependencia, 
                                                    act_referencia, act_estado, 
                                                    act_fechacreo, act_fechamodifico, 
                                                    act_personacreo, act_personamodifico, 
                                                    act_certificado, act_vigencia, 
                                                    act_trimestre,act_certificadomod,
                                                    act_estadoactividad, act_certificadopadre,
                                                    act_resolucion, act_padrepadre)
                                            VALUES (".$this->codigoActividad.", '".$this->getActividad()."', 
                                                    '".$this->getFechaExpedicion()."', ".$this->getCodigoAccion().",
                                                    ".$this->getCodigoProyecto().", ".$this->getDependencia().",
                                                    '".$this->getReferencia()."','".$this->getEstado()."',
                                                    NOW(), NOW(),
                                                    ".$this->getPersonaSistema().", ".$this->getPersonaSistema().",
                                                    ".$this->getCertificado().",".$this->getVigencia().", 
                                                    ".$this->getTrimestre().", ".$this->getCertificadoMod().",
                                                    ".$this->getEstadoActividad().", ".$this->getCertificadoPadre().",
                                                    ".$this->getResolucion().", 0);";

    $this->cnxion->ejecutar($sqlInsertRac);

    $sqlInsertValor=" INSERT INTO planaccion.actividad_costo(aco_codigo, aco_actividad, 
                                                             aco_valor, aco_vigencia, 
                                                             aco_estado, aco_fechacreo, 
                                                             aco_fechamodifico, aco_personacreo, 
                                                             aco_personamodifico, aco_controotrovalor)
                                                    VALUES (".$this->codigoCostos.", ".$this->codigoActividad.",
                                                            ". $this->getvalor().", ".$this->getVigencia().", 
                                                            '".$this->getEstado()."', NOW(), 
                                                            NOW(),".$this->getPersonaSistema().", 
                                                            ".$this->getPersonaSistema().", 0);";

    $this->cnxion->ejecutar($sqlInsertValor);

    return $sqlInsertRac."".$sqlInsertValor;

  }

  public function insertCertificadosNuevoPlan(){

    $sqlInsertRac=" INSERT INTO planaccion.actividad(act_codigo, act_descripcion, act_fechaexpedicion, 
                                                    act_accion, act_proyecto, act_dependencia, 
                                                    act_referencia, act_estado, act_fechacreo,
                                                    act_fechamodifico, act_personacreo, 
                                                    act_personamodifico, act_certificado, 
                                                    act_vigencia, act_trimestre,act_certificadomod,
                                                    act_estadoactividad, act_certificadopadre,
                                                    act_resolucion, act_padrepadre)
                                            VALUES (".$this->codigoActividad.", '".$this->getActividad()."', 
                                                    '".$this->getFechaExpedicion()."', ". $this->getCodigoAccion().",
                                                    ".$this->getCodigoProyecto().", ".$this->getDependencia().",
                                                    '".$this->getReferencia()."','".$this->getEstado()."',
                                                  NOW(), NOW(),
                                                  ".$this->getPersonaSistema().", ".$this->getPersonaSistema().",
                                                ".$this->getCertificado().",".$this->getVigencia().", 
                                                ".$this->getTrimestre().", ".$this->getCertificadoMod().",
                                                ".$this->getEstadoActividad().", ".$this->getCertificadoPadre().",
                                                ".$this->getResolucion().", 0);";

    $this->cnxion->ejecutar($sqlInsertRac);

    $sqlInsertValor=" INSERT INTO planaccion.actividad_costo( aco_codigo, aco_actividad, 
                                                              aco_valor, aco_vigencia, 
                                                              aco_estado, aco_fechacreo, 
                                                              aco_fechamodifico, aco_personacreo, 
                                                              aco_personamodifico, aco_controotrovalor)
                                                    VALUES ( ".$this->codigoCostos.", ".$this->codigoActividad.",  
                                                              ".$this->getvalor().", ".$this->getVigencia().", 
                                                              '".$this->getEstado()."', NOW(), 
                                                              NOW(),".$this->getPersonaSistema().", 
                                                              ".$this->getPersonaSistema().", ".$this->getOtroValor().");";

    $this->cnxion->ejecutar($sqlInsertValor);


    $etapas = $this->getEtapas();

    for ($recorrerEtapas=0; $recorrerEtapas < count($etapas) ; $recorrerEtapas++) { 

      $codigo_etpCer[$recorrerEtapas]=date('YmdHis').rand(99,99999);


      $info_etapa = $this->info_etapa($etapas[$recorrerEtapas]);

      foreach ($info_etapa as $datInfEtpa) {
        $poa_codigo = $datInfEtpa['poa_codigo'];
        $acp_codigo = $datInfEtpa['acp_codigo'];
        $poa_recurso = $datInfEtpa['poa_recurso'];
      }


      $sqlInsertEtapa[$recorrerEtapas] ="INSERT INTO planaccion.certificado_etapa(
                                                    cee_codigo, cee_certificado, 
                                                    cee_actividad, cee_etapa, 
                                                    cee_vigencia, cee_valor, 
                                                    cee_certificadopadre, cee_actividadpadre, 
                                                    cee_fechacreo, cee_fechamodifico, 
                                                    cee_personacreo, cee_personamodifico)
                                            VALUES ($codigo_etpCer[$recorrerEtapas], ".$this->codigoActividad.", 
                                                    $acp_codigo, $poa_codigo, 
                                                    ".$this->getVigencia().", $poa_recurso, 
                                                    ".$this->getCertificadoPadre().", ".$this->getCertificadoMod().", 
                                                    NOW(), NOW(), 
                                                    ".$this->getPersonaSistema().", ".$this->getPersonaSistema().");";
  
      $this->cnxion->ejecutar($sqlInsertEtapa[$recorrerEtapas]);
      
    }
    /**   ETAPAS ACTIVIDAD */
    return $sqlInsertRac."".$sqlInsertValor;
  }

  public function insertCertificadosNuevoPlanReducir(){

    $sqlInsertRac=" INSERT INTO planaccion.actividad(act_codigo, act_descripcion, act_fechaexpedicion, 
                                                    act_accion, act_proyecto, act_dependencia, 
                                                    act_referencia, act_estado, act_fechacreo,
                                                    act_fechamodifico, act_personacreo, 
                                                    act_personamodifico, act_certificado, 
                                                    act_vigencia, act_trimestre,act_certificadomod,
                                                    act_estadoactividad, act_certificadopadre,
                                                    act_resolucion, act_padrepadre)
                                            VALUES (".$this->codigoActividad.", '".$this->getActividad()."', 
                                                    '".$this->getFechaExpedicion()."', ". $this->getCodigoAccion().",
                                                    ".$this->getCodigoProyecto().", ".$this->getDependencia().",
                                                    '".$this->getReferencia()."','".$this->getEstado()."',
                                                  NOW(), NOW(),
                                                  ".$this->getPersonaSistema().", ".$this->getPersonaSistema().",
                                                ".$this->getCertificado().",".$this->getVigencia().", 
                                                ".$this->getTrimestre().", ".$this->getCertificadoMod().",
                                                ".$this->getEstadoActividad().", ".$this->getCertificadoPadre().",
                                                ".$this->getResolucion().", 0);";

    $this->cnxion->ejecutar($sqlInsertRac);

    $sqlInsertValor=" INSERT INTO planaccion.actividad_costo( aco_codigo, aco_actividad, 
                                                              aco_valor, aco_vigencia, 
                                                              aco_estado, aco_fechacreo, 
                                                              aco_fechamodifico, aco_personacreo, 
                                                              aco_personamodifico, aco_controotrovalor)
                                                    VALUES ( ".$this->codigoCostos.", ".$this->codigoActividad.",  
                                                              ".$this->getvalor().", ".$this->getVigencia().", 
                                                              '".$this->getEstado()."', NOW(), 
                                                              NOW(),".$this->getPersonaSistema().", 
                                                              ".$this->getPersonaSistema().", ".$this->getOtroValor().");";

    $this->cnxion->ejecutar($sqlInsertValor);


    $etapas_certificado = $this->info_etapa_mod($this->getCertificadoPadre());

    if($etapas_certificado){
      foreach ($etapas_certificado as $data_etpas_crtfcado) {
        $cee_codigo = $data_etpas_crtfcado['cee_codigo'];
        $cee_certificado = $data_etpas_crtfcado['cee_certificado'];
        $cee_actividad = $data_etpas_crtfcado['cee_actividad'];
        $cee_etapa = $data_etpas_crtfcado['cee_etapa']; 
        $cee_valor = $data_etpas_crtfcado['cee_valor'];

        $codigo_etpCer=date('YmdHis').rand(99,99999);

        $sqlInsertEtapa ="INSERT INTO planaccion.certificado_etapa(
                                                      cee_codigo, cee_certificado, 
                                                      cee_actividad, cee_etapa, 
                                                      cee_vigencia, cee_valor, 
                                                      cee_certificadopadre, cee_actividadpadre, 
                                                      cee_fechacreo, cee_fechamodifico, 
                                                      cee_personacreo, cee_personamodifico)
                                              VALUES ($codigo_etpCer, ".$this->codigoActividad.", 
                                                      $cee_actividad, $cee_etapa, 
                                                      ".$this->getVigencia().", $cee_valor, 
                                                      ".$this->getCertificadoPadre().", 0, 
                                                      NOW(), NOW(), 
                                                      ".$this->getPersonaSistema().", ".$this->getPersonaSistema().");";

        $this->cnxion->ejecutar($sqlInsertEtapa);

        echo "<br> <br> ".$sqlInsertEtapa;
      }
    }

  
    /**   ETAPAS ACTIVIDAD */
    return $sqlInsertRac."".$sqlInsertValor;
  }
}
?>
