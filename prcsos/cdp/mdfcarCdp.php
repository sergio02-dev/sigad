<?php
include('classCdp.php');
class MdfcarCdp extends Cdp{
    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function data_etapa($codigo_etapa){

        $sql_data_etapa="SELECT poa_codigo, acp_codigo,  
                                poa_recurso
                           FROM planaccion.poai
                          WHERE poa_codigo = $codigo_etapa;";

        $query_data_etapa=$this->cnxion->ejecutar($sql_data_etapa);

        while($data_data_etapa=$this->cnxion->obtener_filas($query_data_etapa)){
            $datadata_etapa[]=$data_data_etapa;
        }
        return $datadata_etapa;
    }

    public function mdfcar_cdp(){

        $updte_cdp="UPDATE cdp.cdp
                       SET cdp_fecha = '".$this->getFecha()."', 
                           cdp_numeroexpedicion = ".$this->getNumero().",
                           cdp_fechamodifico = NOW(),
                           cdp_personamodifico = ".$this->getPersonaSistema()."
                     WHERE cdp_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($updte_cdp);

        $datos_etapa = $this->getArrayDatos();

        if($datos_etapa){
            $dlte_actvdad_slctud ="DELETE FROM cdp.actividad_etapa_solicitud
                                    WHERE aes_solicitud = ".$this->getCodigoSolicitud().";";
                        
            $this->cnxion->ejecutar($dlte_actvdad_slctud);

            foreach ($datos_etapa as $dta_etapas) {
                $codigo_etapa = $dta_etapas['codigo_etapa'];
                $codigo_actividad = $dta_etapas['codigo_actividad'];
                $recurso = $dta_etapas['recurso'];
                $other_value = $dta_etapas['other_value'];
                $codigo_clasificador = $dta_etapas['codigo_clasificador'];
                $asignaciones_solicitud = $dta_etapas['asignaciones_solicitud'];

                $codigo_etapa_solicitud = date('YmdHis').rand(99,99999);

                $insert_etpas = "INSERT INTO cdp.actividad_etapa_solicitud(
                                             aes_codigo, 
                                             aes_solicitud, 
                                             aes_actividad, 
                                             aes_etapa, 
                                             aes_valoretapa, 
                                             aes_personacreo, 
                                             aes_personamodifico, 
                                             aes_fechacreo, 
                                             aes_fechamodifico,
                                             aes_otrovalor)
                                     VALUES ($codigo_etapa_solicitud, 
                                             ".$this->getCodigoSolicitud().", 
                                             $codigo_actividad, 
                                             $codigo_etapa, 
                                             $recurso, 
                                             ".$this->getPersonaSistema().", 
                                             ".$this->getPersonaSistema().", 
                                             NOW(), 
                                             NOW(),
                                             $other_value);";

                $this->cnxion->ejecutar($insert_etpas);

                //Clasificadores etapas
                $dlte_clsfcdor_cdp ="DELETE FROM cdp.etapa_solicitud_clasificador
                                           WHERE esc_solicitud = ".$this->getCodigoSolicitud().";";
                                
                $this->cnxion->ejecutar($dlte_clsfcdor_cdp);

                for ($clasfcadorEtpa=0; $clasfcadorEtpa < count($codigo_clasificador) ; $clasfcadorEtpa++) { 
                    
                    $cdg[$clasfcadorEtpa] = date('YmdHis').rand(99,99999);

                    $sql_insrt_clsfcdor[$clasfcadorEtpa] = "INSERT INTO cdp.etapa_solicitud_clasificador(
                                                                        esc_codigo, 
                                                                        esc_solicitud, 
                                                                        esc_etapa, 
                                                                        esc_solitudetapa, 
                                                                        esc_clasificador, 
                                                                        esc_personacreo, 
                                                                        esc_personamodifico, 
                                                                        esc_fechacreo, 
                                                                        esc_fechamodifico)
                                                                VALUES ($cdg[$clasfcadorEtpa], 
                                                                        ".$this->getCodigoSolicitud().", 
                                                                        $codigo_etapa, 
                                                                        $codigo_etapa_solicitud, 
                                                                        '".strtoupper($codigo_clasificador[$clasfcadorEtpa])."', 
                                                                        ".$this->getPersonaSistema().", 
                                                                        ".$this->getPersonaSistema().", 
                                                                        NOW(), 
                                                                        NOW());";
                                                                        
                    $this->cnxion->ejecutar($sql_insrt_clsfcdor[$clasfcadorEtpa]);
                }

                //fuentes recrsos 
                $dlte_asignacion_cdp ="DELETE FROM cdp.asignacion_solicitud
                                        WHERE aso_solicitud = ".$this->getCodigoSolicitud().";";
                            
                $this->cnxion->ejecutar($dlte_asignacion_cdp);

                foreach ($asignaciones_solicitud as $dta_asignacion) {
                    $codigo_etapa = $dta_asignacion['codigo_etapa'];
                    $codigo_asignacion = $dta_asignacion['codigo_asignacion'];
                    $verificar_cambio = $dta_asignacion['verificar_cambio'];
                    $valor_cambio = $dta_asignacion['valor_cambio'];

                    $cdg_asign = date('YmdHis').rand(99,99999);

                    $sql_fuentes_solicitud = "INSERT INTO cdp.asignacion_solicitud(
                                                          aso_codigo, 
                                                          aso_solicitud, 
                                                          aso_etapa, 
                                                          aso_asignacion, 
                                                          aso_otrovalor, 
                                                          aso_valor, 
                                                          aso_fechacreo, 
                                                          aso_fechamodifico, 
                                                          aso_personacreo, 
                                                          aso_personamodifico)
                                                  VALUES ($cdg_asign, 
                                                          ".$this->getCodigoSolicitud().", 
                                                          $codigo_etapa, 
                                                          $codigo_asignacion, 
                                                          $verificar_cambio, 
                                                          $valor_cambio, 
                                                          NOW(), 
                                                          NOW(), 
                                                          ".$this->getPersonaSistema().", 
                                                          ".$this->getPersonaSistema().");";

                    $this->cnxion->ejecutar($sql_fuentes_solicitud);
                }
            }
        }
    }
}
?>