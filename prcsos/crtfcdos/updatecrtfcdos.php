<?php
include_once('classCrtfcdos.php');

class Crtfcdos extends Certificados{

  private $sqlupdateCert;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
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

    public function updateCertificados(){

        $sqlupdateCert=" UPDATE planaccion.actividad
                            SET act_descripcion= '".$this->getActividad()."', 
                                act_fechaexpedicion='".$this->getfechaExpedicion()."', 
                                act_accion=". $this->getcodigoAccion().",
                                act_proyecto=".$this->getcodigoProyecto().", 
                                act_dependencia= ".$this->getdependencia().",  
                                act_estado='".$this->getEstado()."',
                                act_fechamodifico= NOW(),  
                                act_personamodifico=".$this->getPersonaSistema().",
                                act_certificado=".$this->getcertificado().", 
                                act_vigencia=".$this->getvigencia().",
                                act_trimestre=".$this->gettrimestre().", 
                                act_referencia='".$this->getReferencia()."',
                                act_certificadomod=".$this->getCertificadoMod().",
                                act_estadoactividad=".$this->getEstadoActividad().",
                                act_certificadopadre=".$this->getCertificadoPadre().",
                                act_resolucion=".$this->getResolucion()."
                        WHERE act_codigo=".$this->getcodigoActividad().";";

        $this->cnxion->ejecutar($sqlupdateCert);

        $sqlUpdateValor=" UPDATE planaccion.actividad_costo
                          SET aco_valor=". $this->getvalor().", 
                              aco_vigencia= ".$this->getvigencia().", 
                              aco_estado='".$this->getEstado()."',
                              aco_fechamodifico= NOW(),
                              aco_personamodifico=".$this->getPersonaSistema().",
                              aco_controotrovalor = 0
                          WHERE aco_actividad= ".$this->getcodigoActividad().";";

        $this->cnxion->ejecutar($sqlUpdateValor);

        $delete_certificado_etapa="DELETE FROM planaccion.certificado_etapa
                                    WHERE cee_certificado = ".$this->getcodigoActividad().";";

        $this->cnxion->ejecutar($delete_certificado_etapa);

        return $sqlupdateCert."".$sqlUpdateValor;

    }

    public function updateCertificadosPlanNuevo(){

        $sqlupdateCert=" UPDATE planaccion.actividad
                            SET act_descripcion= '".$this->getActividad()."', 
                                act_fechaexpedicion='".$this->getfechaExpedicion()."', 
                                act_accion=". $this->getcodigoAccion().",
                                act_proyecto=".$this->getcodigoProyecto().", 
                                act_dependencia= ".$this->getdependencia().",  
                                act_estado='".$this->getEstado()."',
                                act_fechamodifico= NOW(),  
                                act_personamodifico=".$this->getPersonaSistema().",
                                act_certificado=".$this->getcertificado().", 
                                act_vigencia=".$this->getvigencia().",
                                act_trimestre=".$this->gettrimestre().", 
                                act_referencia='".$this->getReferencia()."',
                                act_certificadomod=".$this->getCertificadoMod().",
                                act_estadoactividad=".$this->getEstadoActividad().",
                                act_certificadopadre=".$this->getCertificadoPadre().",
                                act_resolucion=".$this->getResolucion()."
                          WHERE act_codigo=".$this->getcodigoActividad().";";

        $this->cnxion->ejecutar($sqlupdateCert);

        $sqlUpdateValor=" UPDATE planaccion.actividad_costo
                             SET aco_valor=". $this->getvalor().", 
                                 aco_vigencia= ".$this->getvigencia().", 
                                 aco_estado='".$this->getEstado()."',
                                 aco_fechamodifico= NOW(),
                                 aco_personamodifico=".$this->getPersonaSistema().",
                                 aco_controotrovalor = ".$this->getOtroValor()."
                           WHERE aco_actividad= ".$this->getcodigoActividad().";";

        $this->cnxion->ejecutar($sqlUpdateValor);

        $delete_certificado_etapa="DELETE FROM planaccion.certificado_etapa
                                    WHERE cee_certificado = ".$this->getcodigoActividad().";";

        $this->cnxion->ejecutar($delete_certificado_etapa);

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
                                                  VALUES ($codigo_etpCer[$recorrerEtapas], ".$this->getcodigoActividad().", 
                                                          $acp_codigo, $poa_codigo, 
                                                          ".$this->getVigencia().", $poa_recurso, 
                                                          ".$this->getCertificadoPadre().", ".$this->getCertificadoMod().", 
                                                          NOW(), NOW(), 
                                                          ".$this->getPersonaSistema().", ".$this->getPersonaSistema().");";
        
            $this->cnxion->ejecutar($sqlInsertEtapa[$recorrerEtapas]);

            echo "<br> Etapas ".$sqlInsertEtapa[$recorrerEtapas];
            
        }


        return $sqlupdateCert."".$sqlUpdateValor;

    }
}
?>
