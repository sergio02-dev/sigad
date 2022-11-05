<?php
    include('classMtaPrdcto.php');
    class RsMetaProducto extends MetaProducto{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }


        public function selectMetaProducto(){

            $sqlMetaProducto="SELECT mpr_codigo, mpr_accion, mpr_vigencia, mpr_valoresperado, mpr_personacreo, 
                                    mpr_personamodifico, mpr_fechacreo, mpr_fechamodifico, acc_indicador
                                FROM plandesarrollo.meta_producto, plandesarrollo.accion
                                WHERE plandesarrollo.meta_producto.mpr_accion=plandesarrollo.accion.acc_codigo
                                AND mpr_vigencia=2019
                                AND mpr_accion=".$this->getAccionMepro().";";
            $queryMetaProducto=$this->cnxion->ejecutar($sqlMetaProducto);

            while($rsDataMetaProducto=$this->cnxion->obtener_filas($queryMetaProducto)){

                $mpr_valoresperado=$rsDataMetaProducto['mpr_valoresperado'];
                $acc_indicador=$rsDataMetaProducto['acc_indicador'];

            }
            return array($mpr_valoresperado, $acc_indicador);
        }


        public function selectAccionEjecucion(){

            $sqlAccionEjecucion=" SELECT aej_codigo, aej_accion, aej_vigencia, aej_valor, aej_personacreo, 
                                         aej_personamodifico, aej_fechacreo, aej_fechamodifico
                                 FROM planaccion.accion_ejecucion
                                 WHERE aej_vigencia=2018
                                 AND aej_accion=".$this->getAccionMepro()." ;";
            $queryAccionEjecucion=$this->cnxion->ejecutar($sqlAccionEjecucion);

            while($rsDataAccionEjecucion=$this->cnxion->obtener_filas($queryAccionEjecucion)){

                $aej_valor=$rsDataAccionEjecucion['aej_valor'];

            }
            
            return $aej_valor;

        }
        public function Rstrimestre(){

            $sqlRstrimestre="SELECT MAX(apr_trimestres) AS trimestre
                        FROM planaccion.apertura_reporte;";

            $queryRstrimestre=$this->cnxion->ejecutar($sqlRstrimestre);
            $data_Rstrimestre=$this->cnxion->obtener_filas($queryRstrimestre);
            
            $trimestre=$data_Rstrimestre['trimestre'];

            return $trimestre;
        }
        public function datosAccion($codigo_accion){

            $sqldatosAccion="SELECT acc_lineabase, acc_metaresultado,
                                       acc_indicador
                                FROM plandesarrollo.accion
                                WHERE acc_codigo=$codigo_accion;";

            $querydatosAccion=$this->cnxion->ejecutar($sqldatosAccion);

            while($datadatosAccion=$this->cnxion->obtener_filas($querydatosAccion)){

                $acc_indicador=$datadatosAccion['acc_indicador'];
            }
            
            return $acc_indicador;
        }

        public function anio_inicio_fin($codigo_plan){

            $sql_anio_inicio_fin="SELECT pde_codigo, pde_nombre, pde_yearinicio, pde_yearfin
                                    FROM plandesarrollo.plan_desarrollo
                                   WHERE pde_codigo = $codigo_plan;";

            $query_anio_inicio_fin=$this->cnxion->ejecutar($sql_anio_inicio_fin);

            while($data_anio_inicio_fin=$this->cnxion->obtener_filas($query_anio_inicio_fin)){
                $inicio = $data_anio_inicio_fin['pde_yearinicio'];
                $fin = $data_anio_inicio_fin['pde_yearfin'];
            }
            return array($inicio, $fin);
        }

        public function unidad_linea_meta($codigo_accion){

            $sql_unidad_linea_meta="SELECT ind_codigo, ind_unidadmedida, ind_lineabase, ind_metaresultado, ind_accion
                                      FROM plandesarrollo.indicador
                                     WHERE ind_accion = $codigo_accion;";

            $query_unidad_linea_meta=$this->cnxion->ejecutar($sql_unidad_linea_meta);

            while($data_unidad_linea_meta=$this->cnxion->obtener_filas($query_unidad_linea_meta)){
                $unidad_medida = $data_unidad_linea_meta['ind_unidadmedida'];
                $linea_base = $data_unidad_linea_meta['ind_lineabase'];
                $meta_resultado =$data_unidad_linea_meta['ind_metaresultado'];
            }

            return array($unidad_medida, $linea_base, $meta_resultado);
        }

        public function actividad_descripcion($codigo_actividad){

            $sql_actividad_descripcion="SELECT acp_codigo, acp_referencia, acp_numero, acp_descripcion
                                          FROM planaccion.actividad_poai
                                         WHERE acp_codigo = $codigo_actividad;";

            $query_actividad_descripcion=$this->cnxion->ejecutar($sql_actividad_descripcion);

            $data_actividad_descripcion=$this->cnxion->obtener_filas($query_actividad_descripcion);
            
            $acp_referencia = $data_actividad_descripcion['acp_referencia'];
            $acp_numero = $data_actividad_descripcion['acp_numero'];
            $acp_descripcion = $data_actividad_descripcion['acp_descripcion'];

            $actvdad = $acp_referencia.".".$acp_numero." ".$acp_descripcion;

            return $actvdad;
        }

        public function etapa_descripcion($codigo_etapa){

            $sql_etapa_descripcion="SELECT poa_codigo, poa_referencia, 
                                           poa_numero, poa_objeto, poa_recurso
                                      FROM planaccion.poai
                                     WHERE poa_codigo = $codigo_etapa;";

            $query_etapa_descripcion=$this->cnxion->ejecutar($sql_etapa_descripcion);

            $data_etapa_descripcion=$this->cnxion->obtener_filas($query_etapa_descripcion);
            
            $poa_referencia = $data_etapa_descripcion['poa_referencia'];
            $poa_numero = $data_etapa_descripcion['poa_numero'];
            $poa_objeto = $data_etapa_descripcion['poa_objeto'];

            $etpadescpcion = $poa_referencia.".".$poa_numero." ".$poa_objeto;

            return $etpadescpcion;
        }

        public function porcentaje_cumplido_etapa($codigo_etapa){

            $sql_porcentaje_cumplido_etapa = "SELECT (poa_logro*poa_logroejecutado)/100 AS prcntje_cmpldo
                                                FROM planaccion.poai
                                               WHERE poa_codigo = $codigo_etapa;";

            $query_porcentaje_cumplido_etapa=$this->cnxion->ejecutar($sql_porcentaje_cumplido_etapa);

            $data_porcentaje_cumplido_etapa=$this->cnxion->obtener_filas($query_porcentaje_cumplido_etapa);
            
            $prcntje_cmpldo = $data_porcentaje_cumplido_etapa['prcntje_cmpldo'];

            $porcentaje_etapa = number_format($prcntje_cmpldo,0,'','');

            return $porcentaje_etapa;
        }

        public function logro_acumulado($codigo_certificado, $codigo_actividadpoai, $codigo_etapa){

            $sql_logro_acumulado = "SELECT SUM(rea_logrado) as lgro_acmldo
                                                FROM planaccion.reporte_actividad_etapa
                                               WHERE rea_codigocertificado = $codigo_certificado
                                                 AND rea_codigoactividadpoai = $codigo_actividadpoai
                                                 AND rea_codigoetapa = $codigo_etapa;";

            $query_logro_acumulado=$this->cnxion->ejecutar($sql_logro_acumulado);

            $data_logro_acumulado=$this->cnxion->obtener_filas($query_logro_acumulado);
            
            $lgro_acmldo = $data_logro_acumulado['lgro_acmldo'];

            if($lgro_acmldo==""){
                $logro = 0;
            }
            else{
                $logro = $lgro_acmldo;
            }
            return $logro;
        }

        public function descripcion_accion($codigo_accion){

            $sql_descripcion_accion="SELECT acc_codigo, acc_referencia, 
                                            acc_descripcion, acc_numero
                                       FROM plandesarrollo.accion
                                      WHERE acc_codigo = $codigo_accion;";

            $query_descripcion_accion=$this->cnxion->ejecutar($sql_descripcion_accion);

            $data_descripcion_accion=$this->cnxion->obtener_filas($query_descripcion_accion);
            
            $acc_descripcion = $data_descripcion_accion['acc_descripcion'];

            return $acc_descripcion;
        }

        


    }



?>