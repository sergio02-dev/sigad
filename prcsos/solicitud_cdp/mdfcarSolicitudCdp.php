<?php
include('classSolicitudCdp.php');
class MdfcarSolicitudCdp extends SolicitudCdp{

    private $updte_solicitud_cdp;
    private $codigoSolicitud;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoSolicitud = date('YmdHis').rand(99,99999);
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

    public function cod_etpa_slctud(){

        $sql_cod_etpa_slctud="SELECT MAX(aes_codigo) AS cod_etpslcclass
                                FROM cdp.actividad_etapa_solicitud;";

        $query_cod_etpa_slctud=$this->cnxion->ejecutar($sql_cod_etpa_slctud);

        $data_cod_etpa_slctud=$this->cnxion->obtener_filas($query_cod_etpa_slctud);

        $cod_etpslcclass = $data_cod_etpa_slctud['cod_etpslcclass'];

        if($cod_etpslcclass){
            $cod_etplcclass = $cod_etpslcclass + 1;
        }
        else{
            $cod_etplcclass = 1;
        }
        return $cod_etplcclass;
    }

    public function cod_clasf(){

        $sql_cod_clasf="SELECT MAX(esc_codigo) AS cod_clss
                        FROM cdp.etapa_solicitud_clasificador;";

        $query_cod_clasf=$this->cnxion->ejecutar($sql_cod_clasf);

        $data_cod_clasf=$this->cnxion->obtener_filas($query_cod_clasf);

        $cod_clss = $data_cod_clasf['cod_clss'];

        if($cod_clss){
            $cod_classf = $cod_clss + 1;
        }
        else{
            $cod_classf = 1;
        }
        return $cod_classf;
    }

    public function mdfcarSolicitud(){

        $updte_solicitud_cdp ="UPDATE cdp.solicitud_cdp
                                  SET scdp_fecha = '".$this->getFecha()."', 
                                      scdp_estado = ".$this->getEstado().", 
                                      scdp_personamodifico = ".$this->getPersonaSistema().", 
                                      scdp_fechamodifico = NOW(),
                                      scdp_objeto = '".$this->getObjeto()."'
                                WHERE scdp_codigo = ".$this->getCodigo().";";
                      
        $this->cnxion->ejecutar($updte_solicitud_cdp);

        $datos_etapa = $this->getArrayDatos();

        if($datos_etapa){
            $dlte_actvdad_slctud ="DELETE FROM cdp.actividad_etapa_solicitud
                                    WHERE aes_solicitud = ".$this->getCodigo().";";
                        
            $this->cnxion->ejecutar($dlte_actvdad_slctud);

            $dlte_clsfcdor_cdp ="DELETE FROM cdp.etapa_solicitud_clasificador
                                           WHERE esc_solicitud = ".$this->getCodigo().";";
                                
            $this->cnxion->ejecutar($dlte_clsfcdor_cdp);

            $dlte_asignacion_cdp ="DELETE FROM cdp.asignacion_solicitud
                                    WHERE aso_solicitud = ".$this->getCodigo().";";

            $this->cnxion->ejecutar($dlte_asignacion_cdp);

            foreach ($datos_etapa as $dta_etapas) {
                $codigo_etapa = $dta_etapas['codigo_etapa'];
                $codigo_actividad = $dta_etapas['codigo_actividad'];
                $recurso = $dta_etapas['recurso'];
                $other_value = $dta_etapas['other_value'];
                $cdgo_clasificador = $dta_etapas['codigo_clasificador'];
                $asignaciones_solicitud = $dta_etapas['asignaciones_solicitud'];

                $codigo_etapa_solicitud = $this->cod_etpa_slctud();

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
                                             ".$this->getCodigo().", 
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

                if($cdgo_clasificador){
                    foreach ($cdgo_clasificador as $dta_clasificadores) {
                        $codigo_clasificador = $dta_clasificadores['codigo_clasificador'];
                        $valor_clasificador = $dta_clasificadores['valor_clasificador'];
                        $codigo_dane = $dta_clasificadores['codigo_dane'];
                        $descripcion_dane = $dta_clasificadores['descripcion_dane'];


                        $cod_clasf = $this->cod_clasf();

                        $sql_insrt_clsfcdor = "INSERT INTO cdp.etapa_solicitud_clasificador(
                                                           esc_codigo, 
                                                           esc_solicitud, 
                                                           esc_etapa, 
                                                           esc_solitudetapa, 
                                                           esc_clasificador, 
                                                           esc_personacreo, 
                                                           esc_personamodifico, 
                                                           esc_fechacreo, 
                                                           esc_fechamodifico,
                                                           esc_valor,
                                                           esc_dane,
                                                           esc_deq)
                                                   VALUES ($cod_clasf, 
                                                          ".$this->getCodigo().", 
                                                          $codigo_etapa, 
                                                          $codigo_etapa_solicitud, 
                                                          '".$codigo_clasificador."', 
                                                          ".$this->getPersonaSistema().", 
                                                          ".$this->getPersonaSistema().", 
                                                          NOW(), 
                                                          NOW(),
                                                          ".$valor_clasificador.",
                                                          '".$codigo_dane."',
                                                          '".$descripcion_dane."');";
                                                                        
                        $this->cnxion->ejecutar($sql_insrt_clsfcdor);
                    }
                }

                //fuentes recrsos 

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
                                                          ".$this->getCodigo().", 
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
        
        return $updte_solicitud_cdp;
    }
}
?>