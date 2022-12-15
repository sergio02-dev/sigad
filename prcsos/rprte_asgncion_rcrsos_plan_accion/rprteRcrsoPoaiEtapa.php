<?php
    class RprteRcrsosPoiaEtpa{
        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function subSistemasPlanDesarrollo($codigo_planDesarrollo){

            
            $sql_subSistemasPlanDesarrollo="SELECT sub_codigo, sub_nombre, 
                                                   pde_codigo, sub_referencia,
                                                   sub_ref
                                              FROM plandesarrollo.subsistema
                                             WHERE pde_codigo=$codigo_planDesarrollo
                                             ORDER BY sub_ref ASC;";

            $resultado_subSistemasPlanDesarrollo=$this->cnxion->ejecutar($sql_subSistemasPlanDesarrollo);

            while ($data_subSistemasPlanDesarrollo = $this->cnxion->obtener_filas($resultado_subSistemasPlanDesarrollo)){
                $datasubSistemasPlanDesarrollo[] = $data_subSistemasPlanDesarrollo;
            }
            return $datasubSistemasPlanDesarrollo;
        }

        public function subSistemasXCodigo($codigo_planDesarrollo, $codigo_subsistema){

            
            $sql_subSistemasXCodigo="SELECT sub_codigo, sub_nombre, 
                                            pde_codigo, sub_referencia,
                                            sub_ref
                                       FROM plandesarrollo.subsistema
                                      WHERE pde_codigo=$codigo_planDesarrollo
                                        AND sub_codigo = $codigo_subsistema
                                      ORDER BY sub_ref ASC;";

            $resultado_subSistemasXCodigo=$this->cnxion->ejecutar($sql_subSistemasXCodigo);

            while ($data_subSistemasXCodigo = $this->cnxion->obtener_filas($resultado_subSistemasXCodigo)){
                $datasubSistemasXCodigo[] = $data_subSistemasXCodigo;
            }
            return $datasubSistemasXCodigo;
        }

        public function proyecto_subsistema($sub_codigo){

            $sql_proyecto_subsistema="SELECT pro_codigo, pro_descripcion, sub_codigo, 
                                             add_codigo, res_codigo, pro_referencia, 
                                             pro_numero, pro_objetivo
                                        FROM plandesarrollo.proyecto
                                       WHERE sub_codigo = $sub_codigo
                                       ORDER BY pro_numero ASC;";
    
            $resultado_proyecto_subsistema=$this->cnxion->ejecutar($sql_proyecto_subsistema);
    
            while ($data_proyecto_subsistema = $this->cnxion->obtener_filas($resultado_proyecto_subsistema)){
                $dataproyecto_subsistema[] = $data_proyecto_subsistema;
            }
            return $dataproyecto_subsistema;
        }

        public function proyecto_subsistema_x_codigo($sub_codigo, $codigo_proyecto){

            $sql_proyecto_subsistema_x_codigo="SELECT pro_codigo, pro_descripcion, sub_codigo, 
                                                      add_codigo, res_codigo, pro_referencia, 
                                                      pro_numero, pro_objetivo
                                                 FROM plandesarrollo.proyecto
                                                WHERE sub_codigo = $sub_codigo
                                                  AND pro_codigo = $codigo_proyecto 
                                                 ORDER BY pro_numero ASC;";
    
            $resultado_proyecto_subsistema_x_codigo=$this->cnxion->ejecutar($sql_proyecto_subsistema_x_codigo);
    
            while ($data_proyecto_subsistema_x_codigo = $this->cnxion->obtener_filas($resultado_proyecto_subsistema_x_codigo)){
                $dataproyecto_subsistema_x_codigo[] = $data_proyecto_subsistema_x_codigo;
            }
            return $dataproyecto_subsistema_x_codigo;
        }
    
    
        public function accion_proyecto($pro_codigo){
    
            $sql_accion_proyecto="SELECT acc_codigo, acc_referencia, 
                                         acc_descripcion, acc_responsable, 
                                         acc_proyecto, acc_numero
                                     FROM plandesarrollo.accion
                                    WHERE acc_proyecto = $pro_codigo
                                    ORDER BY acc_numero ASC;";
    
            $resultado_accion_proyecto=$this->cnxion->ejecutar($sql_accion_proyecto);
    
            while ($data_accion_proyecto = $this->cnxion->obtener_filas($resultado_accion_proyecto)){
                $dataaccion_proyecto[] = $data_accion_proyecto;
            }
            return $dataaccion_proyecto;
        }

        public function accion_proyect_x_codigo($pro_codigo, $codigo_accion){
    
            $sql_accion_proyect_x_codigo="SELECT acc_codigo, acc_referencia, 
                                                 acc_descripcion, acc_responsable, 
                                                 acc_proyecto, acc_numero
                                            FROM plandesarrollo.accion
                                           WHERE acc_proyecto = $pro_codigo
                                             AND acc_codigo = $codigo_accion
                                           ORDER BY acc_numero ASC;";
    
            $resultado_accion_proyect_x_codigo=$this->cnxion->ejecutar($sql_accion_proyect_x_codigo);
    
            while ($data_accion_proyect_x_codigo = $this->cnxion->obtener_filas($resultado_accion_proyect_x_codigo)){
                $dataaccion_proyect_x_codigo[] = $data_accion_proyect_x_codigo;
            }
            return $dataaccion_proyect_x_codigo;
        }
    
        public function nombreNivelUno($codigo_planDesarrollo){
    
            $sql_nombreNivelUno="SELECT pde_niveluno
                                   FROM plandesarrollo.plan_desarrollo
                                  WHERE pde_codigo = $codigo_planDesarrollo;";
    
            $query_nombreNivelUno=$this->cnxion->ejecutar($sql_nombreNivelUno);
    
            $data_nombreNivelUno=$this->cnxion->obtener_filas($query_nombreNivelUno);
            
            $pde_niveluno = $data_nombreNivelUno['pde_niveluno'];
            
            return $pde_niveluno;
        }
    
        public function nombreNivelDos($codigo_planDesarrollo){
    
            $sql_nombreNivelDos="SELECT pde_niveldos
                                    FROM plandesarrollo.plan_desarrollo
                                   WHERE pde_codigo=$codigo_planDesarrollo;";
    
            $resultado_nombreNivelDos=$this->cnxion->ejecutar($sql_nombreNivelDos);
    
            $data_nombreNivelDos = $this->cnxion->obtener_filas($resultado_nombreNivelDos);
    
            $pde_niveldos = $data_nombreNivelDos['pde_niveldos'];
    
            return $pde_niveldos;
        }
    
        public function nombreNivelTres($codigo_planDesarrollo){
    
            $sql_nombreNivelTres="SELECT pde_niveltres
                                    FROM plandesarrollo.plan_desarrollo
                                   WHERE pde_codigo=$codigo_planDesarrollo;";
    
            $resultado_nombreNivelTres=$this->cnxion->ejecutar($sql_nombreNivelTres);
    
            $data_nombreNivelTres = $this->cnxion->obtener_filas($resultado_nombreNivelTres);
    
            $pde_niveltres=$data_nombreNivelTres['pde_niveltres'];
    
            return $pde_niveltres;
        }

        public function actividadPoai($codigo_accion, $vigencia){

            $sql_actividadPoai="SELECT acp_codigo, acp_descripcion, acp_accion, 
                                       acp_proyecto, acp_referencia, acp_estado,
                                       acp_fechacreo, acp_fechamodifico, acp_personacreo, 
                                       acp_personamodifico, acp_vigencia, acp_numero,
                                       acp_oficina, acp_cargo, acp_sedeindicador, 
                                       acp_unidad, acp_objetivo
                                  FROM planaccion.actividad_poai
                                 WHERE acp_estado = '1'
                                   AND acp_accion = $codigo_accion
                                   AND acp_vigencia = $vigencia
                                 ORDER BY acp_numero ASC;";
    
            $resultado_actividadPoai=$this->cnxion->ejecutar($sql_actividadPoai);
    
            while ($data_actividadPoai = $this->cnxion->obtener_filas($resultado_actividadPoai)){
                $dataactividadPoai[] = $data_actividadPoai;
            }
            return $dataactividadPoai;
        }

        public function etapas($codigo_actividad){

            $sql_etapas="SELECT poa_codigo, poa_referencia, 
                                poa_numero, poa_objeto, poa_recurso
                           FROM planaccion.poai
                          WHERE acp_codigo=$codigo_actividad
                          ORDER BY poa_numero ASC;";
    
            $resultado_etapas=$this->cnxion->ejecutar($sql_etapas);
    
            while ($data_etapas = $this->cnxion->obtener_filas($resultado_etapas)){
                $dataetapas[] = $data_etapas;
            }
            return $dataetapas;
        }

        public function sede_indicar($codigo_indicador){
    
            $sql_sede_indicar="SELECT ind_codigo, ind_sede, sed_nombre
                                 FROM plandesarrollo.indicador
                                INNER JOIN principal.sedes ON ind_sede = sed_codigo
                                WHERE ind_codigo = $codigo_indicador;";
    
            $resultado_sede_indicar=$this->cnxion->ejecutar($sql_sede_indicar);
    
            $data_sede_indicar = $this->cnxion->obtener_filas($resultado_sede_indicar);
    
            $sed_nombre = $data_sede_indicar['sed_nombre'];
    
            return $sed_nombre;
        }

        public function fuentes_vigencia_accion($codigo_accion, $vigencia_actividad){

            $sql_fuentes_vigencia_accion="SELECT DISTINCT poav_fuentefinanciacion AS fuente_financiacion, 
                                                 poav_vigencia AS vigencia_recurso
                                            FROM planaccion.poai_veinte_veintidos, planaccion.fuente_financiacion
                                           WHERE poav_fuentefinanciacion = ffi_codigo
                                             AND poav_estado = 1
                                             AND poav_accion = $codigo_accion
                                             AND poav_vigencia = $vigencia_actividad
                                           UNION
                                          SELECT DISTINCT sff_fuente AS fuente_financiacion, 
                                                 sff_vigencia AS vigencia_recurso
                                            FROM planaccion.poai_veinte_veintidos, planaccion.adicion_poai, 
                                                 planaccion.saldos_fuente_financiacion, planaccion.fuente_financiacion
                                           WHERE poav_codigo = apoai_poai
                                             AND apoai_saldo = sff_codigo
                                             AND sff_fuente = ffi_codigo
                                             AND poav_estado = 1
                                             AND apoai_estado = 1
                                             AND poav_accion = $codigo_accion
                                             AND poav_vigencia = $vigencia_actividad
                                           UNION 
                                          SELECT DISTINCT poav_fuentefinanciacion AS fuente_financiacion, 
                                                 poav_vigencia AS vigencia_recurso
                                            FROM planaccion.poai_veinte_veintidos
                                           INNER JOIN planaccion.traslados_poai ON tpo_poai = tpo_codigorecuerso
                                           WHERE poav_codigo = tpo_poai
                                             AND tpo_accion = $codigo_accion
                                             AND poav_vigencia = $vigencia_actividad
                                           UNION 	
                                          SELECT DISTINCT sff_fuente AS fuente_financiacion, 
                                                 sff_vigencia AS vigencia_recurso
                                            FROM planaccion.adicion_poai
                                           INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                                           INNER JOIN planaccion.traslados_poai ON apoai_codigo = tpo_codigorecuerso
                                           INNER JOIN planaccion.poai_veinte_veintidos ON poav_codigo = tpo_poai
                                           WHERE tpo_accion = $codigo_accion
                                             AND poav_vigencia = $vigencia_actividad
                                           GROUP BY fuente_financiacion, vigencia_recurso
                                           ORDER BY vigencia_recurso, fuente_financiacion;";       
    
            $query_fuentes_vigencia_accion=$this->cnxion->ejecutar($sql_fuentes_vigencia_accion);
    
            while($data_fuentes_vigencia_accion=$this->cnxion->obtener_filas($query_fuentes_vigencia_accion)){
                $datafuentes_vigencia_accion[] = $data_fuentes_vigencia_accion;
            }
            return $datafuentes_vigencia_accion;
        }

        public function restar_trasladado($codigo_recurso){

            $sql_restar_trasladado="SELECT SUM(tpo_valor)AS valortraslado
                                      FROM planaccion.traslados_poai
                                     WHERE tpo_estado = 1
                                       AND tpo_codigorecuerso = $codigo_recurso;";
    
            $query_restar_trasladado=$this->cnxion->ejecutar($sql_restar_trasladado);
    
            $data_restar_trasladado=$this->cnxion->obtener_filas($query_restar_trasladado);
    
            $valortraslado = $data_restar_trasladado['valortraslado'];
    
            if($valortraslado){
                $valor_traslado = $valortraslado;
            }
            else{
                $valor_traslado = 0;
            }
            return $valor_traslado;
        }

        public function recursos_disponibles($codigo_accion, $vigencia_actividad, $codigo_fuente, $codigo_vigencia){

            $sql_recursos_disponibles="SELECT DISTINCT poav_codigo AS codigo_recurso, poav_fuentefinanciacion AS fuente_financiacion, 
                                              poav_vigencia AS vigencia_recurso, poav_recurso AS recursos
                                         FROM planaccion.poai_veinte_veintidos, planaccion.fuente_financiacion
                                        WHERE poav_fuentefinanciacion = ffi_codigo
                                          AND poav_estado = 1
                                          AND poav_accion = $codigo_accion
                                          AND poav_vigencia = $vigencia_actividad
                                          AND poav_fuentefinanciacion = $codigo_fuente
                                          AND poav_vigencia = $codigo_vigencia
                                        UNION
                                       SELECT DISTINCT apoai_codigo AS codigo_recurso, sff_fuente AS fuente_financiacion, 
                                              sff_vigencia AS vigencia_recurso, apoai_valor AS recursos
                                         FROM planaccion.poai_veinte_veintidos, planaccion.adicion_poai, 
                                              planaccion.saldos_fuente_financiacion, planaccion.fuente_financiacion
                                        WHERE poav_codigo = apoai_poai
                                          AND apoai_saldo = sff_codigo
                                          AND sff_fuente = ffi_codigo
                                          AND poav_estado = 1
                                          AND apoai_estado = 1
                                          AND poav_accion = $codigo_accion
                                          AND poav_vigencia = $vigencia_actividad
                                          AND sff_fuente = $codigo_fuente
                                          AND sff_vigencia = $codigo_vigencia
                                        UNION 
                                       SELECT DISTINCT tpo_codigo AS codigo_recurso, poav_fuentefinanciacion AS fuente_financiacion, 
                                              poav_vigencia AS vigencia_recurso, tpo_valor AS recursos
                                         FROM planaccion.poai_veinte_veintidos
                                        INNER JOIN planaccion.traslados_poai ON tpo_poai = tpo_codigorecuerso
                                        WHERE poav_codigo = tpo_poai
                                          AND tpo_accion = $codigo_accion
                                          AND poav_vigencia = $vigencia_actividad
                                          AND poav_fuentefinanciacion = $codigo_fuente
                                          AND poav_vigencia = $codigo_vigencia
                                        UNION 	
                                       SELECT DISTINCT tpo_codigo AS codigo_recurso, sff_fuente AS fuente_financiacion, 
                                              sff_vigencia AS vigencia_recurso, tpo_valor AS recursos
                                         FROM planaccion.adicion_poai
                                        INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                                        INNER JOIN planaccion.traslados_poai ON apoai_codigo = tpo_codigorecuerso
                                        INNER JOIN planaccion.poai_veinte_veintidos ON poav_codigo = tpo_poai
                                        WHERE tpo_accion = $codigo_accion
                                          AND poav_vigencia = $vigencia_actividad
                                          AND sff_fuente = $codigo_fuente
                                          AND sff_vigencia = $codigo_vigencia
                                        ORDER BY vigencia_recurso, fuente_financiacion;";       
    
            $query_recursos_disponibles=$this->cnxion->ejecutar($sql_recursos_disponibles);
    
            $numero_filas = $this->cnxion->numero_filas($query_recursos_disponibles);
    
            $recurso_disponible = 0;
            $sub_total = 0;
            if($numero_filas > 0){
                while($data_recursos_disponibles=$this->cnxion->obtener_filas($query_recursos_disponibles)){
                    $codigo_recurso = $data_recursos_disponibles['codigo_recurso'];
                    $recursos = $data_recursos_disponibles['recursos'];
    
                    $restar_trasladado = $this->restar_trasladado($codigo_recurso);
    
                    $sub_recursos = $recursos - $restar_trasladado;
    
                    $sub_total = $sub_total + $sub_recursos;
                }    
                $recurso_disponible = $sub_total;
            }
            else{
                $recurso_disponible = 0;
            }        
            return $recurso_disponible;
        }

        public function nombre_fuente($codigo_fuente){

            $sql_nombre_fuente="SELECT ffi_codigo, ffi_nombre
                                  FROM planaccion.fuente_financiacion
                                 WHERE ffi_codigo = $codigo_fuente;";
    
            $query_nombre_fuente=$this->cnxion->ejecutar($sql_nombre_fuente);
    
            $data_nombre_fuente=$this->cnxion->obtener_filas($query_nombre_fuente);
    
            $ffi_nombre = $data_nombre_fuente['ffi_nombre'];
    
            return $ffi_nombre;
        }

        public function list_fuente_disponibilidad($codigo_accion, $vigencia_actividad){
            $codigo_accion = $codigo_accion;
            $vigencia_actividad = $vigencia_actividad;

            $array_fuentes_asignacion = array();
    
            $fuentes_vigencia_accion = $this->fuentes_vigencia_accion($codigo_accion, $vigencia_actividad);
            if($fuentes_vigencia_accion){
                foreach ($fuentes_vigencia_accion as $dat_fuentes_vigencia) {
                    $fuente_financiacion = $dat_fuentes_vigencia['fuente_financiacion'];
                    $vigencia_recurso = $dat_fuentes_vigencia['vigencia_recurso'];
    
                    $recursos_disponibles = $this->recursos_disponibles($codigo_accion, $vigencia_actividad, $fuente_financiacion, $vigencia_recurso);
    
                    $nombre_fuente = $this->nombre_fuente($fuente_financiacion);
    
                    if($recursos_disponibles > 0){
                        $array_fuentes_asignacion[] = array('codigo_fuente'=> $fuente_financiacion,
                                                            'vigencia_recurso'=> $vigencia_recurso,
                                                            'nombre_fuente'=> $nombre_fuente,
                                                            'recurso_disponible'=> $recursos_disponibles
                                                        );
                    }
                }
            }
            return $array_fuentes_asignacion;
        }

        public function valor_asignado_actividad($codigo_actividad, $codigo_fuente, $vigencia_poai, $vigencia_recursos){

            $sql_valor_asignado_actividad="SELECT SUM(asre_recurso) AS valorasignaciones
                                             FROM planaccion.asignacion_recuersos_etapa
                                            INNER JOIN planaccion.poai ON asre_etapa = poa_codigo
                                            WHERE asre_estado = 1
                                              AND poa_estado = '1'
                                              AND acp_codigo = $codigo_actividad
                                              AND asre_fuente = $codigo_fuente
                                              AND asre_vigenciapoai = $vigencia_poai
                                              AND asre_vigenciarecurso = $vigencia_recursos;";
    
            $query_valor_asignado_actividad=$this->cnxion->ejecutar($sql_valor_asignado_actividad);
    
            $data_valor_asignado_actividad=$this->cnxion->obtener_filas($query_valor_asignado_actividad);
    
            $valorasignaciones = $data_valor_asignado_actividad['valorasignaciones'];

            if($valorasignaciones){
                $valor_asignaciones = $valorasignaciones;
            }
            else{
                $valor_asignaciones = 0;
            }
            return $valor_asignaciones;
        }

        public function valor_asignado_accion($codigo_accion, $codigo_fuente, $vigencia_poai, $vigencia_recursos){

            $sql_valor_asignado_accion="SELECT SUM(asre_recurso) AS valorasignadoaccion
                                          FROM planaccion.asignacion_recuersos_etapa
                                         INNER JOIN planaccion.poai ON asre_etapa = poa_codigo
                                         INNER JOIN planaccion.actividad_poai ON planaccion.poai.acp_codigo = planaccion.actividad_poai.acp_codigo
                                         WHERE asre_estado = 1
                                           AND poa_estado = '1'
                                           AND acp_accion = $codigo_accion
                                           AND asre_fuente = $codigo_fuente
                                           AND asre_vigenciapoai = $vigencia_poai
                                           AND asre_vigenciarecurso = $vigencia_recursos;";
    
            $query_valor_asignado_accion=$this->cnxion->ejecutar($sql_valor_asignado_accion);
    
            $data_valor_asignado_accion=$this->cnxion->obtener_filas($query_valor_asignado_accion);
    
            $valorasignadoaccion = $data_valor_asignado_accion['valorasignadoaccion'];

            if($valorasignadoaccion){
                $valor_asignado_accion = $valorasignadoaccion;
            }
            else{
                $valor_asignado_accion = 0;
            }
            return $valor_asignado_accion;
        }

        
    }
    

?>