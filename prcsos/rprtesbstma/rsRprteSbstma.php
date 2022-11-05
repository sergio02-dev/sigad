<?php
/**
 * Karen Yuliana Palacio Minú 
 * 13 de Septiembre 2019 09:27 am
 * Rs Reporte substemas 
 */
    class RsRprteSbstma{
        private $slqProyectoSubsistema;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function sqlRsProyectoSubsistema($codigo_subsistema){

            $slqProyectoSubsistema="SELECT pro_codigo, pro_descripcion, sub_codigo,
                                           add_codigo, res_codigo, pro_referencia
                                      FROM plandesarrollo.proyecto
                                      WHERE sub_codigo=$codigo_subsistema
                                      ORDER BY pro_referencia ASC;";

            $queryProyectoSubsistema=$this->cnxion->ejecutar($slqProyectoSubsistema);

            while($data_ProyectoSubsistema=$this->cnxion->obtener_filas($queryProyectoSubsistema)){
                $dataProyectoSubsistema[]=$data_ProyectoSubsistema;
            }

            return $dataProyectoSubsistema;
        }

        public function sqlRsAccioProyecto($codigo_proyecto){

            $sqlRsAccioProyecto="SELECT acc_codigo, acc_referencia, acc_descripcion, acc_responsable, 
                                           acc_lineabase, acc_metaresultado, acc_proyecto,  
                                           acc_actoadmin, acc_numerovigencia, acc_comportamiento, 
                                           acc_tendenciapositiva, acc_indicador
                                      FROM plandesarrollo.accion
                                      WHERE acc_proyecto=$codigo_proyecto
                                      ORDER BY acc_codigo ASC;";

            $queryAccioProyecto=$this->cnxion->ejecutar($sqlRsAccioProyecto);

            while($data_AccioProyecto=$this->cnxion->obtener_filas($queryAccioProyecto)){
                $dataAccioProyecto[]=$data_AccioProyecto;
            }

            return $dataAccioProyecto;
        }
        public function sqlRsAtividad($codigo_proyecto, $codigo_accion){

            $sqlRsAtividad="SELECT act_codigo, act_descripcion, act_fechaexpedicion, act_accion, 
                                        act_proyecto, act_dependencia, act_referencia, act_estado,
                                        act_certificado, act_vigencia, act_dependencia
                                FROM planaccion.actividad
                                WHERE act_proyecto=$codigo_proyecto
                                AND act_accion=$codigo_accion
                                AND act_trimestre=1
                                ORDER BY act_codigo ASC;";

            $queryAtividad=$this->cnxion->ejecutar($sqlRsAtividad);

            while($data_Atividad=$this->cnxion->obtener_filas($queryAtividad)){
                $dataAtividad[]=$data_Atividad;
            }

            return $dataAtividad;
        }
        public function cantidadActividadesAccion($codigo_proyecto, $codigo_accion){

            $sqlcantidadActividadesAccion="SELECT COUNT(*)AS cantidadactividadess
                                FROM planaccion.actividad
                                WHERE act_proyecto=$codigo_proyecto
                                AND act_accion=$codigo_accion
                                AND act_trimestre=1;";

            $querycantidadActividadesAccion=$this->cnxion->ejecutar($sqlcantidadActividadesAccion);
            $data_cantidadActividadesAccion=$this->cnxion->obtener_filas($querycantidadActividadesAccion);
            
            $cantidadactivacc=$data_cantidadActividadesAccion['cantidadactividadess'];

            return $cantidadactivacc;
        }
        public function sqlRsAtividadProyecto($codigo_proyecto){

            $sqlRsAtividadProyecto="SELECT act_codigo, act_descripcion, act_fechaexpedicion, act_accion, 
                                        act_proyecto, act_dependencia, act_referencia, act_estado
                                        act_certificado, 
                                        act_vigencia
                                FROM planaccion.actividad
                                WHERE act_proyecto=$codigo_proyecto
                                AND act_trimestre=1;";

            $queryAtividadProyecto=$this->cnxion->ejecutar($sqlRsAtividadProyecto);

            while($data_AtividadProyecto=$this->cnxion->obtener_filas($queryAtividadProyecto)){
                $dataAtividadProyecto[]=$data_AtividadProyecto;
            }

            return $dataAtividadProyecto;
        }
        public function cantidadAcciones($codigo_proyecto){

            $sqlcantidadAcciones="SELECT COUNT(*)AS cantidad_accion
                                FROM plandesarrollo.accion
                                WHERE acc_proyecto=$codigo_proyecto;";

            $querycantidadAcciones=$this->cnxion->ejecutar($sqlcantidadAcciones);
            $data_cantidadAcciones=$this->cnxion->obtener_filas($querycantidadAcciones);
            
            $cantidad_accion=$data_cantidadAcciones['cantidad_accion'];

            return $cantidad_accion;
        }

        public function sqlRsValorActividad($codigo_actividad){

            $sqlRsValorActividad="SELECT aco_valor
                                FROM planaccion.actividad_costo
                                WHERE aco_actividad=$codigo_actividad;";

            $querysqlRsValorActividad=$this->cnxion->ejecutar($sqlRsValorActividad);
            $data_sqlRsValorActividad=$this->cnxion->obtener_filas($querysqlRsValorActividad);
            
            $valor=$data_sqlRsValorActividad['aco_valor'];

            return $valor;
        }
        public function sqlRsCantidadActividadRealizadaPorcentaje($codigo_actividad){

            $sqlRsCantidadActividadRealizadaPorcentaje="SELECT COUNT(*) AS cantidad_actividadrealizada
                                                            FROM planaccion.actividad_realizada
                                                            WHERE are_tipoavance=1
                                                            AND  are_trimestre=20191
                                                            AND are_actividad=$codigo_actividad;";

            $querysqlRsCantidadActividadRealizadaPorcentaje=$this->cnxion->ejecutar($sqlRsCantidadActividadRealizadaPorcentaje);
            $data_sqlRsCantidadActividadRealizadaPorcentaje=$this->cnxion->obtener_filas($querysqlRsCantidadActividadRealizadaPorcentaje);
            
            $cantidad_actividadrealizada=$data_sqlRsCantidadActividadRealizadaPorcentaje['cantidad_actividadrealizada'];

            return $cantidad_actividadrealizada;
        }
        public function sqlLogroAvanzadoPorcentaje($codigo_actividad){

            $sqlLogroAvanzadoPorcentaje="SELECT SUM(are_avancelogrado) logradoporcentaje
                                            FROM planaccion.actividad_realizada
                                            WHERE are_tipoavance=1
                                            AND  are_trimestre=20191
                                            AND are_actividad=$codigo_actividad;";

            $querysqlLogroAvanzadoPorcentaje=$this->cnxion->ejecutar($sqlLogroAvanzadoPorcentaje);
            $data_sqlLogroAvanzadoPorcentaje=$this->cnxion->obtener_filas($querysqlLogroAvanzadoPorcentaje);
            
            $logradoporcentaje=$data_sqlLogroAvanzadoPorcentaje['logradoporcentaje'];

            return $logradoporcentaje;
        }
        public function sqlLogroAvanzadoTotal($codigo_actividad){

            $sqlLogroAvanzadoTotal="SELECT SUM(are_avancelogrado) logradototal
                                            FROM planaccion.actividad_realizada
                                            WHERE are_tipoavance=2
                                            AND  are_trimestre=20191
                                            AND are_actividad=$codigo_actividad;";

            $querysqlLogroAvanzadoTotal=$this->cnxion->ejecutar($sqlLogroAvanzadoTotal);
            $data_sqlLogroAvanzadoTotal=$this->cnxion->obtener_filas($querysqlLogroAvanzadoTotal);
            
            $logradototal=$data_sqlLogroAvanzadoTotal['logradototal'];

            return $logradototal;
        }
        public function sqlRsCantidadPorcentaje($codigo_accion){

            $sqlRsCantidadPorcentaje="SELECT COUNT(*) AS cantidad_activity
                                        FROM planaccion.actividad 
                                        WHERE act_accion=$codigo_accion
                                        AND act_trimestre=1;";

            $querysqlRsCantidadPorcentaje=$this->cnxion->ejecutar($sqlRsCantidadPorcentaje);
            $data_sqlRsCantidadPorcentaje=$this->cnxion->obtener_filas($querysqlRsCantidadPorcentaje);
            
            $cantidad_actividadrealizada=$data_sqlRsCantidadPorcentaje['cantidad_activity'];

            return $cantidad_actividadrealizada;
        }
        public function sqlPorcentaje($codigo_accion){

            $sqlPorcentaje="SELECT SUM(are_avancelogrado) porcentajelogrado
                                FROM planaccion.actividad_realizada, planaccion.actividad
                                WHERE act_codigo=are_actividad
                                AND are_tipoavance=1
                                AND  are_trimestre=20191
                                AND act_accion=$codigo_accion
                                AND act_trimestre=1;";

            $querysqlPorcentaje=$this->cnxion->ejecutar($sqlPorcentaje);
            $data_sqlPorcentaje=$this->cnxion->obtener_filas($querysqlPorcentaje);
            
            $logradoporcentaje=$data_sqlPorcentaje['porcentajelogrado'];

            return $logradoporcentaje;
        }
        public function sqlTotal($codigo_accion){

            $sqlTotal="SELECT SUM(are_avancelogrado) total
                                FROM planaccion.actividad_realizada, planaccion.actividad
                                WHERE act_codigo=are_actividad
                                AND are_tipoavance=2
                                AND  are_trimestre=20191
                                AND act_accion=$codigo_accion
                                AND act_trimestre=1;";

            $querysqlTotal=$this->cnxion->ejecutar($sqlTotal);
            $data_sqlTotal=$this->cnxion->obtener_filas($querysqlTotal);
            
            $total=$data_sqlTotal['total'];

            return $total;
        }
        public function cantidadActividadAccionExcel($codigo_proyecto, $codigo_accion){

            $sqlcantidadActividadAccionExcel="SELECT COUNT(*)AS cant_accionactivity
                                FROM planaccion.actividad
                                WHERE act_proyecto=$codigo_proyecto
                                AND act_accion=$codigo_accion
                                AND act_trimestre=1;";

            $querycantidadActividadAccionExcel=$this->cnxion->ejecutar($sqlcantidadActividadAccionExcel);
            $data_cantidadActividadAccionExcel=$this->cnxion->obtener_filas($querycantidadActividadAccionExcel);
            
            $cant_accionActivity=$data_cantidadActividadAccionExcel['cant_accionactivity'];

            return $cant_accionActivity;
        }
        public function MetaResultado($codigo_accion){

            $sqlMetaProducto="SELECT mpr_codigo, mpr_accion, mpr_vigencia, mpr_valoresperado, mpr_personacreo, 
                                    mpr_personamodifico, mpr_fechacreo, mpr_fechamodifico, acc_indicador
                                FROM plandesarrollo.meta_producto, plandesarrollo.accion
                                WHERE plandesarrollo.meta_producto.mpr_accion=plandesarrollo.accion.acc_codigo
                                AND mpr_vigencia=2019
                                AND mpr_accion=$codigo_accion;";
            $queryMetaProducto=$this->cnxion->ejecutar($sqlMetaProducto);

            while($rsDataMetaProducto=$this->cnxion->obtener_filas($queryMetaProducto)){

                $mpr_valoresperado=$rsDataMetaProducto['mpr_valoresperado'];
                $acc_indicador=$rsDataMetaProducto['acc_indicador'];

            }
            
            return $mpr_valoresperado;

        }
        public function LineaBase($codigo_accion){

            $sqlAccionEjecucion=" SELECT aej_codigo, aej_accion, aej_vigencia, aej_valor, aej_personacreo, 
                                         aej_personamodifico, aej_fechacreo, aej_fechamodifico
                                 FROM planaccion.accion_ejecucion
                                 WHERE aej_vigencia=2018
                                 AND aej_accion=$codigo_accion;";
            $queryAccionEjecucion=$this->cnxion->ejecutar($sqlAccionEjecucion);

            while($rsDataAccionEjecucion=$this->cnxion->obtener_filas($queryAccionEjecucion)){

                $aej_valor=$rsDataAccionEjecucion['aej_valor'];

            }        
            return $aej_valor;
        }
        public function sqlRsAtividadProyectoCertificados($codigo_proyecto){

            $sqlRsAtividadProyectoCertificados="SELECT act_codigo, act_descripcion, act_fechaexpedicion, act_accion, 
                                                        act_proyecto, act_dependencia, act_referencia, act_estado, act_certificado, 
                                                        act_vigencia, aco_valor
                                                FROM planaccion.actividad, planaccion.actividad_costo
                                                WHERE act_codigo=aco_actividad
                                                AND act_proyecto=$codigo_proyecto
                                                AND act_trimestre=1;";

            $queryRsAtividadProyectoCertificados=$this->cnxion->ejecutar($sqlRsAtividadProyectoCertificados);

            while($data_RsAtividadProyectoCertificados=$this->cnxion->obtener_filas($queryRsAtividadProyectoCertificados)){
                $dataRsAtividadProyectoCertificados[]=$data_RsAtividadProyectoCertificados;
            }

            return $dataRsAtividadProyectoCertificados;
        }
        public function totalAccion($codigo_accion){

            $sqltotalAccion="SELECT SUM(aco_valor) AS totalaccion
                                FROM planaccion.actividad, planaccion.actividad_costo
                                WHERE act_codigo=aco_actividad
                                AND act_proyecto>0
                                AND act_accion>0
                                AND act_trimestre=1
                                AND act_accion=$codigo_accion;";

            $querytotalAccion=$this->cnxion->ejecutar($sqltotalAccion);
            $data_totalAccion=$this->cnxion->obtener_filas($querytotalAccion);
            
            $totalaccion=$data_totalAccion['totalaccion'];

            return $totalaccion;
        }
        public function totalProyecto($codigo_proyecto){

            $sqltotalProyecto="SELECT SUM(aco_valor) AS totalproyecto
                                FROM planaccion.actividad, planaccion.actividad_costo
                                WHERE act_codigo=aco_actividad
                                AND act_proyecto>0
                                AND act_accion>0
                                AND act_trimestre=1
                                AND act_proyecto=$codigo_proyecto";

            $querytotalProyecto=$this->cnxion->ejecutar($sqltotalProyecto);
            $data_totalProyecto=$this->cnxion->obtener_filas($querytotalProyecto);
            
            $totalproyecto=$data_totalProyecto['totalproyecto'];

            return $totalproyecto;
        }
        public function totalSubsistema($codigo_subsistema){

            $sqltotalSubsistema="SELECT SUM(aco_valor) AS totalsubsistema
                                            FROM planaccion.actividad, planaccion.actividad_costo, plandesarrollo.proyecto
                                            WHERE act_codigo=aco_actividad
                                            AND act_proyecto=pro_codigo
                                            AND act_proyecto>0
                                            AND act_accion>0
                                            AND act_trimestre=1
                                            AND sub_codigo=$codigo_subsistema;";

            $querytotalSubsistema=$this->cnxion->ejecutar($sqltotalSubsistema);
            $data_totalSubsistema=$this->cnxion->obtener_filas($querytotalSubsistema);
            
            $totalsubsistema=$data_totalSubsistema['totalsubsistema'];

            return $totalsubsistema;
        }
        public function cantidadActividadesProyecto($codigo_proyecto){

            $sqlcantidadActividadesProyecto="SELECT COUNT(*)AS cantidadactividades
                                FROM planaccion.actividad
                                WHERE act_proyecto=$codigo_proyecto
                                AND act_trimestre=1;";

            $querycantidadActividadesProyecto=$this->cnxion->ejecutar($sqlcantidadActividadesProyecto);
            $data_cantidadActividadesProyecto=$this->cnxion->obtener_filas($querycantidadActividadesProyecto);
            
            $cantidadactiv=$data_cantidadActividadesProyecto['cantidadactividades'];

            return $cantidadactiv;
        }
        public function RsCertificados($pro_codigo){

            $sqlRsCertificados="SELECT act_codigo, act_descripcion, act_fechaexpedicion, act_accion, 
                                        act_proyecto, act_dependencia, act_referencia, act_estado, act_certificado, 
                                        act_vigencia, aco_valor
                                    FROM planaccion.actividad, planaccion.actividad_costo, plandesarrollo.proyecto
                                    WHERE act_codigo=aco_actividad
                                    AND act_proyecto=pro_codigo
                                    AND pro_codigo=$pro_codigo
                                    ORDER BY act_certificado ASC;";

            $queryRsCertificados=$this->cnxion->ejecutar($sqlRsCertificados);

            while($data_RsCertificados=$this->cnxion->obtener_filas($queryRsCertificados)){
                $dataRsCertificados[]=$data_RsCertificados;
            }

            return $dataRsCertificados;
        }
        public function RsProyecto(){

            $sqlRsProyecto="SELECT pro_codigo, pro_referencia, pro_descripcion, sub_codigo
                            FROM plandesarrollo.proyecto
                            ORDER BY pro_codigo ASC;";

            $queryRsProyecto=$this->cnxion->ejecutar($sqlRsProyecto);

            while($data_RsProyecto=$this->cnxion->obtener_filas($queryRsProyecto)){
                $dataRsProyecto[]=$data_RsProyecto;
            }
            return $dataRsProyecto;
        }
        public function totalCostoAccion($codigo_proyecto, $codigo_accion){

            $sqltotalCostoAccion="SELECT SUM(aco_valor) AS totalaccion
                                FROM planaccion.actividad, planaccion.actividad_costo
                                WHERE act_codigo=aco_actividad
                                AND act_proyecto=$codigo_proyecto
                                AND act_accion=$codigo_accion
                                AND act_trimestre=1;";

            $querytotalCostoAccion=$this->cnxion->ejecutar($sqltotalCostoAccion);

            $data_totalCostoAccion=$this->cnxion->obtener_filas($querytotalCostoAccion);
            
            $totalAccion=$data_totalCostoAccion['totalaccion'];

            return $totalAccion;
        }
        public function RsDependencia($codigo_dependencia){

            $sqlRsDependencia="SELECT per_codigo, per_nombre, per_primerapellido, per_segundoapellido
                                FROM principal.persona
                                WHERE per_codigo=$codigo_dependencia;";

            $queryRsDependencia=$this->cnxion->ejecutar($sqlRsDependencia);
            $data_RsDependencia=$this->cnxion->obtener_filas($queryRsDependencia);
            
            $per_nombre=$data_RsDependencia['per_nombre'];
            $per_primerapellido=$data_RsDependencia['per_primerapellido'];
            $per_segundoapellido=$data_RsDependencia['per_segundoapellido'];
            
            $responsable=$per_nombre." ".$per_primerapellido." ".$per_segundoapellido;

            return $responsable;
        }

        public function listadoAperturaReporte(){

            $sqllistadoAperturaReporte="SELECT apr_codigo, apr_fechainicio, apr_fechafin, apr_trimestres, 
                                    apr_trim
                            FROM planaccion.apertura_reporte
                            ORDER BY apr_trimestres ASC;";

            $querylistadoAperturaReporte=$this->cnxion->ejecutar($sqllistadoAperturaReporte);

            while($data_listadoAperturaReporte=$this->cnxion->obtener_filas($querylistadoAperturaReporte)){
                $datalistadoAperturaReporte[]=$data_listadoAperturaReporte;
            }
            return $datalistadoAperturaReporte;
        }

        public function lista_todos_certificados($codigo_plan, $vigencia){

            if($codigo_plan ==""){
                $condicion_plan = "";
            }
            else{
                $condicion_plan = "AND pde_codigo = $codigo_plan";
            }

            if($vigencia==""){
                $condicion_vigencia = "";
            }
            else{
                $condicion_vigencia = "AND act_vigencia = $vigencia";
               
            }

            $sql_lista_todos_certificados="SELECT act_codigo, plandesarrollo.subsistema.sub_codigo, sub_nombre, 
                                               pde_codigo, sub_referencia, sub_ref, pro_codigo,
                                               pro_referencia, pro_numero, acc_codigo, acc_referencia, 
                                               acc_numero, act_referencia, act_descripcion,
                                               act_fechaexpedicion, act_certificado, aco_valor,
                                               act_vigencia, act_accion
                                          FROM plandesarrollo.subsistema, plandesarrollo.proyecto, 
                                               plandesarrollo.accion, planaccion.actividad, planaccion.actividad_costo
                                         WHERE plandesarrollo.subsistema.sub_codigo = plandesarrollo.proyecto.sub_codigo
                                           AND pro_codigo = acc_proyecto
                                           AND pro_codigo = act_proyecto
                                           AND acc_codigo = act_accion
                                           AND act_codigo = aco_actividad
                                           $condicion_plan 
                                           $condicion_vigencia
                                           ORDER BY act_certificado, pde_codigo, plandesarrollo.subsistema.sub_codigo ASC;";

            $query_lista_todos_certificados=$this->cnxion->ejecutar($sql_lista_todos_certificados);

            while($data_lista_todos_certificados=$this->cnxion->obtener_filas($query_lista_todos_certificados)){
                $datalista_todos_certificados[]=$data_lista_todos_certificados;
            }
            return $datalista_todos_certificados;
        }

        public function lista_tods_certificados_etapa($codigo_plan, $vigencia){

            if($codigo_plan ==""){
                $condicion_plan = "";
            }
            else{
                $condicion_plan = "AND pde_codigo = $codigo_plan";
            }

            if($vigencia==""){
                $condicion_vigencia = "";
            }
            else{
                $condicion_vigencia = "AND act_vigencia = $vigencia";
               
            }

            $sql_lista_tods_certificados_etapa="SELECT act_codigo, plandesarrollo.subsistema.sub_codigo, sub_nombre, 
                                                       pde_codigo, sub_referencia, sub_ref, pro_codigo,
                                                       pro_referencia, pro_numero, acc_codigo, acc_referencia, 
                                                       acc_numero, act_referencia, act_descripcion,
                                                       act_fechaexpedicion, act_certificado, aco_valor,
                                                       act_vigencia, act_accion, cee_certificado, 
                                                       cee_actividad, cee_etapa, acp_referencia,
                                                       acp_numero, acp_descripcion, poa_referencia, 
                                                       poa_objeto, poa_recurso, poa_numero
                                                  FROM plandesarrollo.subsistema, plandesarrollo.proyecto, 
                                                       plandesarrollo.accion, planaccion.actividad, planaccion.actividad_costo,
                                                       planaccion.certificado_etapa, planaccion.actividad_poai, planaccion.poai
                                                 WHERE plandesarrollo.subsistema.sub_codigo = plandesarrollo.proyecto.sub_codigo
                                                   AND pro_codigo = acc_proyecto
                                                   AND pro_codigo = act_proyecto
                                                   AND acc_codigo = act_accion
                                                   AND act_codigo = aco_actividad
                                                   AND act_codigo = cee_certificado
                                                   AND planaccion.actividad_poai.acp_codigo = cee_actividad
                                                   AND planaccion.actividad_poai.acp_codigo = planaccion.poai.acp_codigo
                                                   AND poa_codigo = cee_etapa
                                                   $condicion_plan 
                                                   $condicion_vigencia
                                                   ORDER BY act_certificado, pde_codigo, plandesarrollo.subsistema.sub_codigo, 
                                                   acp_referencia, acp_numero, poa_referencia, poa_numero ASC;";

            $query_lista_tods_certificados_etapa=$this->cnxion->ejecutar($sql_lista_tods_certificados_etapa);

            while($data_lista_tods_certificados_etapa=$this->cnxion->obtener_filas($query_lista_tods_certificados_etapa)){
                $datalista_tods_certificados_etapa[]=$data_lista_tods_certificados_etapa;
            }
            return $datalista_tods_certificados_etapa;
        }

        public function referencias_accion_plan_old($codigo_accion){
            
            $sql_referencias_accion_plan_old="SELECT acc_codigo, acc_referencia, acc_numero, 
                                                     acc_proyecto, pro_codigo, 
                                                     plandesarrollo.proyecto.sub_codigo, 
                                                     pro_referencia, pro_numero, 
                                                     sub_referencia
                                                FROM plandesarrollo.accion, plandesarrollo.proyecto, plandesarrollo.subsistema
                                               WHERE acc_proyecto = pro_codigo
                                                 AND plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                                 AND acc_codigo = $codigo_accion;";

            $query_referencias_accion_plan_old=$this->cnxion->ejecutar($sql_referencias_accion_plan_old);
            
            $data_referencias_accion_plan_old=$this->cnxion->obtener_filas($query_referencias_accion_plan_old);

            $sub_referencia = $data_referencias_accion_plan_old['sub_referencia'];
            $acc_referencia = $data_referencias_accion_plan_old['acc_referencia'];

            $referencia_old = $sub_referencia.".".$acc_referencia;

            return $referencia_old;
        }

        public function actividades_certificado($certificado){
            
            $sql_actividades_certificado="SELECT DISTINCT cee_actividad, acp_descripcion, acp_referencia, acp_numero
                                            FROM planaccion.certificado_etapa,  planaccion.actividad_poai
                                           WHERE cee_actividad = acp_codigo
                                           AND cee_certificado = $certificado
                                           GROUP BY cee_actividad, acp_descripcion, acp_referencia, acp_numero;";

            $query_actividades_certificado=$this->cnxion->ejecutar($sql_actividades_certificado);
            
            while($data_actividades_certificado=$this->cnxion->obtener_filas($query_actividades_certificado)){
                $dataactividades_certificado[]=$data_actividades_certificado;
            }
            return $dataactividades_certificado;
        }

        public function referencias_accion_plan_new($codigo_accion){
            
            $sql_referencias_accion_plan_new="SELECT acc_codigo, acc_referencia, acc_numero
                                                FROM plandesarrollo.accion
                                                WHERE acc_codigo = $codigo_accion;";

            $query_referencias_accion_plan_new=$this->cnxion->ejecutar($sql_referencias_accion_plan_new);
            
            $data_referencias_accion_plan_new=$this->cnxion->obtener_filas($query_referencias_accion_plan_new);

            $acc_referencia = $data_referencias_accion_plan_new['acc_referencia'];
            $acc_numero = $data_referencias_accion_plan_new['acc_numero'];

            $referencia_new = $acc_referencia.".".$acc_numero;

            return $referencia_new;
        }


        public function vigencias_certificado(){

            $sql_vigencias_certificado="SELECT DISTINCT act_vigencia
                                          FROM planaccion.actividad
                                         GROUP BY act_vigencia
                                         ORDER BY act_vigencia ASC;";

            $query_vigencias_certificado=$this->cnxion->ejecutar($sql_vigencias_certificado);

            while($data_vigencias_certificado=$this->cnxion->obtener_filas($query_vigencias_certificado)){
                $datavigencias_certificado[]=$data_vigencias_certificado;
            }
            return $datavigencias_certificado;
        }

        public function etapas_actividades($actividad, $certificado){
            
            $sql_etapas_actividades="SELECT poa_codigo, poa_referencia, 
                                            poa_objeto, poa_numero, cee_actividad,
                                            poa_recurso
                                    FROM planaccion.poai, planaccion.certificado_etapa
                                    WHERE poa_codigo = cee_etapa
                                    AND cee_actividad = $actividad
                                    AND cee_certificado = $certificado;";

            $query_etapas_actividades=$this->cnxion->ejecutar($sql_etapas_actividades);
            
            while($data_etapas_actividades=$this->cnxion->obtener_filas($query_etapas_actividades)){
                $dataetapas_actividades[]=$data_etapas_actividades;
            }
            return $dataetapas_actividades;
        }


    }
?>