<?php
    include('classRp.php');
    class RprteRp extends Rp{
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function pln_desarrollo(){
    
            $sql_pln_desarrollo="SELECT pde_codigo, pde_nombre, 
                                        pde_yearinicio, pde_yearfin
                                   FROM plandesarrollo.plan_desarrollo
                                  ORDER BY pde_yearinicio DESC;";
     
            $query_pln_desarrollo=$this->cnxion->ejecutar($sql_pln_desarrollo);
    
            while($data_pln_desarrollo=$this->cnxion->obtener_filas($query_pln_desarrollo)){
                $datapln_desarrollo[]=$data_pln_desarrollo;
            }
            return $datapln_desarrollo;
        }

        public function vigencia_plan_accion($codigo_plan){
    
            $sql_vigencia_plan_accion="SELECT DISTINCT(acp_vigencia)AS codigo_vigencia
                                         FROM planaccion.actividad_poai
                                        INNER JOIN plandesarrollo.accion ON acp_accion = acc_codigo
                                        INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                        INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                        WHERE acp_estado = '1'
                                          AND pde_codigo = $codigo_plan;";
     
            $query_vigencia_plan_accion=$this->cnxion->ejecutar($sql_vigencia_plan_accion);
    
            while($data_vigencia_plan_accion=$this->cnxion->obtener_filas($query_vigencia_plan_accion)){
                $datavigencia_plan_accion[]=$data_vigencia_plan_accion;
            }
            return $datavigencia_plan_accion;
        }

        public function nivel_uno($codigo_plan){
    
            $sql_nivel_uno="SELECT pde_codigo, pde_niveluno
                              FROM plandesarrollo.plan_desarrollo
                             WHERE pde_codigo = $codigo_plan;";
     
            $query_nivel_uno=$this->cnxion->ejecutar($sql_nivel_uno);
    
            $data_nivel_uno=$this->cnxion->obtener_filas($query_nivel_uno);

            $pde_niveluno = $data_nivel_uno['pde_niveluno'];

            return $pde_niveluno;
        }

        public function nivel_dos($codigo_plan){
    
            $sql_nivel_dos = "SELECT pde_codigo, pde_niveldos
                                FROM plandesarrollo.plan_desarrollo
                               WHERE pde_codigo = $codigo_plan;";
     
            $query_nivel_dos = $this->cnxion->ejecutar($sql_nivel_dos);
    
            $data_nivel_dos = $this->cnxion->obtener_filas($query_nivel_dos);

            $pde_niveldos = $data_nivel_dos['pde_niveldos'];

            return $pde_niveldos;
        }

        public function nivel_tres($codigo_plan){
    
            $sql_nivel_tres ="SELECT pde_codigo, pde_niveltres
                                FROM plandesarrollo.plan_desarrollo
                               WHERE pde_codigo = $codigo_plan;";
     
            $query_nivel_tres = $this->cnxion->ejecutar($sql_nivel_tres);
    
            $data_nivel_tres = $this->cnxion->obtener_filas($query_nivel_tres);

            $pde_niveltres = $data_nivel_tres['pde_niveltres'];

            return $pde_niveltres;
        }

        public function list_nivel_uno($codigo_plan){
    
            $sql_list_nivel_uno="SELECT sub_codigo, sub_nombre, 
                                        pde_codigo, sub_referencia, 
                                        sub_ref
                                   FROM plandesarrollo.subsistema
                                  WHERE pde_codigo = $codigo_plan;";
     
            $query_list_nivel_uno=$this->cnxion->ejecutar($sql_list_nivel_uno);
    
            while($data_list_nivel_uno=$this->cnxion->obtener_filas($query_list_nivel_uno)){
                $datalist_nivel_uno[]=$data_list_nivel_uno;
            }
            return $datalist_nivel_uno;
        }

        public function list_nivel_dos($codigo_subsistema){
    
            $sql_list_nivel_dos="SELECT plandesarrollo.subsistema.sub_codigo, sub_nombre, 
                                        pde_codigo, sub_referencia, 
                                        sub_ref, pro_codigo, pro_referencia, 
                                        pro_numero, pro_descripcion,
                                        pro_objetivo
                                   FROM plandesarrollo.subsistema
                                  INNER JOIN plandesarrollo.proyecto ON plandesarrollo.subsistema.sub_codigo = plandesarrollo.proyecto.sub_codigo
                                  WHERE plandesarrollo.subsistema.sub_codigo = $codigo_subsistema
                                  ORDER BY pro_referencia, pro_numero ASC;";
     
            $query_list_nivel_dos=$this->cnxion->ejecutar($sql_list_nivel_dos);
    
            while($data_list_nivel_dos=$this->cnxion->obtener_filas($query_list_nivel_dos)){
                $datalist_nivel_dos[]=$data_list_nivel_dos;
            }
            return $datalist_nivel_dos;
        }

        public function list_nivel_tres($codigo_proyecto){
    
            $sql_list_nivel_tres="SELECT pde_codigo, sub_referencia, 
                                         sub_ref, acc_codigo, acc_referencia, 
                                         acc_descripcion, acc_proyecto, 
                                         acc_numero
                                    FROM plandesarrollo.subsistema
                                   INNER JOIN plandesarrollo.proyecto ON plandesarrollo.subsistema.sub_codigo = plandesarrollo.proyecto.sub_codigo
                                   INNER JOIN plandesarrollo.accion ON pro_codigo = acc_proyecto
                                   WHERE acc_proyecto = $codigo_proyecto
                                   ORDER BY acc_numero, acc_referencia ASC";
     
            $query_list_nivel_tres=$this->cnxion->ejecutar($sql_list_nivel_tres);
    
            while($data_list_nivel_tres=$this->cnxion->obtener_filas($query_list_nivel_tres)){
                $datalist_nivel_tres[]=$data_list_nivel_tres;
            }
            return $datalist_nivel_tres;
        }

        public function list_nivel_cuatro($codigo_accion){
    
            $sql_list_nivel_cuatro="SELECT acp_codigo, acp_referencia, 
                                           acp_numero, acp_descripcion
                                      FROM planaccion.actividad_poai
                                     WHERE acp_estado = '1'
                                       AND acp_accion = $codigo_accion;";
     
            $query_list_nivel_cuatro=$this->cnxion->ejecutar($sql_list_nivel_cuatro);
    
            while($data_list_nivel_cuatro=$this->cnxion->obtener_filas($query_list_nivel_cuatro)){
                $datalist_nivel_cuatro[]=$data_list_nivel_cuatro;
            }
            return $datalist_nivel_cuatro;
        }

        public function list_acciones_ejecucion($codigo_proyecto, $codigo_vigencia){

            $sql_list_acciones_ejecucion="SELECT acc_codigo, acc_referencia, 
                                                 acc_numero, acc_descripcion, 
                                                 acc_proyecto, ind_unidadmedida, 
                                                 ind_lineabase, ind_metaresultado,
                                                 ind_tendencia, ind_sede,
                                                 ivi_presupuesto, ind_tipocomportamiento,
                                                 ind_codigo
                                            FROM plandesarrollo.accion
                                           INNER JOIN plandesarrollo.indicador ON ind_accion = acc_codigo
                                           INNER JOIN plandesarrollo.indicador_vigencia ON ind_codigo = ivi_indicador
                                           WHERE acc_proyecto = $codigo_proyecto
                                             AND ivi_vigencia = $codigo_vigencia;";
                                
            $query_list_acciones_ejecucion=$this->cnxion->ejecutar($sql_list_acciones_ejecucion);
    
            while($data_list_acciones_ejecucion=$this->cnxion->obtener_filas($query_list_acciones_ejecucion)){
                $datalist_acciones_ejecucion[]=$data_list_acciones_ejecucion;
            }
            return $datalist_acciones_ejecucion;
        }

        public function sigla_nivel_uno($codigo_subsistema){

            $sql_sigla_nivel_uno="SELECT sub_codigo, sub_nombre, 
                                         sub_referencia, sub_ref
                                    FROM plandesarrollo.subsistema
                                   WHERE sub_codigo = $codigo_subsistema;";
    
            $query_sigla_nivel_uno=$this->cnxion->ejecutar($sql_sigla_nivel_uno);
    
            $data_sigla_nivel_uno=$this->cnxion->obtener_filas($query_sigla_nivel_uno);
    
            $sub_referencia = $data_sigla_nivel_uno['sub_referencia'];
            $sub_ref = $data_sigla_nivel_uno['sub_ref'];

            $referencia = $sub_referencia.$sub_ref;
    
            return $referencia;
        }

        public function nombre_subsistema($codigo_subsistema){

            $sql_nombre_subsistema="SELECT sub_codigo, sub_nombre, 
                                           sub_referencia, sub_ref
                                      FROM plandesarrollo.subsistema
                                     WHERE sub_codigo = $codigo_subsistema;";
    
            $query_nombre_subsistema=$this->cnxion->ejecutar($sql_nombre_subsistema);
    
            $data_nombre_subsistema=$this->cnxion->obtener_filas($query_nombre_subsistema);
    
            $sub_nombre = $data_nombre_subsistema['sub_nombre'];
    
            return $sub_nombre;
        }

        public function nombre_nivel_uno($codigo_plan){

            $sql_nombre_nivel_uno="SELECT pde_codigo, pde_niveluno
                                     FROM plandesarrollo.plan_desarrollo
                                    WHERE pde_codigo = $codigo_plan;";
    
            $query_nombre_nivel_uno=$this->cnxion->ejecutar($sql_nombre_nivel_uno);
    
            $data_nombre_nivel_uno=$this->cnxion->obtener_filas($query_nombre_nivel_uno);
    
            $pde_niveluno = $data_nombre_nivel_uno['pde_niveluno'];
    
            return $pde_niveluno;
        }

        public function nombre_nivel_dos($codigo_plan){

            $sql_nombre_nivel_dos="SELECT pde_codigo, pde_niveldos
                                     FROM plandesarrollo.plan_desarrollo
                                    WHERE pde_codigo = $codigo_plan;";
    
            $query_nombre_nivel_dos=$this->cnxion->ejecutar($sql_nombre_nivel_dos);
    
            $data_nombre_nivel_dos=$this->cnxion->obtener_filas($query_nombre_nivel_dos);
    
            $pde_niveldos = $data_nombre_nivel_dos['pde_niveldos'];
    
            return $pde_niveldos;
        }
        
        public function nombre_nivel_tres($codigo_plan){

            $sql_nombre_nivel_tres="SELECT pde_codigo, pde_niveltres
                                      FROM plandesarrollo.plan_desarrollo
                                     WHERE pde_codigo = $codigo_plan;";
    
            $query_nombre_nivel_tres=$this->cnxion->ejecutar($sql_nombre_nivel_tres);
    
            $data_nombre_nivel_tres=$this->cnxion->obtener_filas($query_nombre_nivel_tres);
    
            $pde_niveltres = $data_nombre_nivel_tres['pde_niveltres'];
    
            return $pde_niveltres;
        }
        
        public function anios_plan($codigo_plan){

            $sql_anios_plan="SELECT pde_codigo, pde_yearinicio, pde_yearfin
                               FROM plandesarrollo.plan_desarrollo
                              WHERE pde_codigo = $codigo_plan;";
    
            $query_anios_plan=$this->cnxion->ejecutar($sql_anios_plan);
    
            $data_anios_plan=$this->cnxion->obtener_filas($query_anios_plan);
    
            $pde_yearinicio = $data_anios_plan['pde_yearinicio'];
            $pde_yearfin = $data_anios_plan['pde_yearfin'];
    
            return array($pde_yearinicio, $pde_yearfin);
        } 

        public function tipo_meta($codigo_tipo_comportamiento){

            $sql_tipo_meta="SELECT tco_codigo, tco_nombre, 
                                   tco_descripcion, tco_estado
                              FROM plandesarrollo.tipo_comportamiento
                             WHERE tco_codigo = $codigo_tipo_comportamiento;";
    
            $query_tipo_meta=$this->cnxion->ejecutar($sql_tipo_meta);
    
            $data_tipo_meta=$this->cnxion->obtener_filas($query_tipo_meta);
    
            $tco_nombre = $data_tipo_meta['tco_nombre'];
    
            return $tco_nombre;
        }

        public function rfrncia_accion($codigo_accion){

            $sql_rfrncia_accion="SELECT acc_codigo, acc_proyecto, sub_referencia, 
                                        sub_ref, acc_referencia, acc_numero,
                                        pde_codigo
                                   FROM plandesarrollo.accion
                                  INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                  INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                  WHERE acc_codigo = $codigo_accion";
                                
            $query_rfrncia_accion = $this->cnxion->ejecutar($sql_rfrncia_accion);
    
            $data_rfrncia_accion = $this->cnxion->obtener_filas($query_rfrncia_accion);
    
            $sub_referencia = $data_rfrncia_accion['sub_referencia'];
            $sub_ref = $data_rfrncia_accion['sub_ref'];
            $acc_referencia = $data_rfrncia_accion['acc_referencia'];
            $acc_numero = $data_rfrncia_accion['acc_numero'];

            if($pde_codigo == 1){
                $ref_accion = $sub_referencia.$sub_ref.".".$acc_referencia;
            }
            else{
                $ref_accion = $acc_referencia.".".$acc_numero;
            }
            return $ref_accion;
        }

        public function nombre_sede($codigo_sede){

            $sql_nombre_sede="SELECT sed_codigo, sed_nombre
                                FROM principal.sedes
                               WHERE sed_codigo = $codigo_sede;";
    
            $query_nombre_sede = $this->cnxion->ejecutar($sql_nombre_sede);
    
            $data_nombre_sede = $this->cnxion->obtener_filas($query_nombre_sede);
    
            $sed_nombre = $data_nombre_sede['sed_nombre'];
    
            return $sed_nombre;
        }

        public function list_proyecto($codigo_proyecto){
    
            $sql_list_proyecto="SELECT plandesarrollo.subsistema.sub_codigo, sub_nombre, 
                                       pde_codigo, sub_referencia, 
                                       sub_ref, pro_codigo, pro_referencia, 
                                       pro_numero, pro_descripcion,
                                       pro_objetivo
                                  FROM plandesarrollo.subsistema
                                 INNER JOIN plandesarrollo.proyecto ON plandesarrollo.subsistema.sub_codigo = plandesarrollo.proyecto.sub_codigo
                                 WHERE pro_codigo = $codigo_proyecto
                                 ORDER BY pro_referencia, pro_numero ASC;";
     
            $query_list_proyecto=$this->cnxion->ejecutar($sql_list_proyecto);
    
            while($data_list_proyecto=$this->cnxion->obtener_filas($query_list_proyecto)){
                $datalist_proyecto[]=$data_list_proyecto;
            }
            return $datalist_proyecto;
        }

        public function list_prycto_subsstema($codigo_subsistema){
    
            $sql_list_prycto_subsstema="SELECT plandesarrollo.subsistema.sub_codigo, sub_nombre, 
                                               pde_codigo, sub_referencia, 
                                               sub_ref, pro_codigo, pro_referencia, 
                                               pro_numero, pro_descripcion,
                                               pro_objetivo
                                          FROM plandesarrollo.subsistema
                                         INNER JOIN plandesarrollo.proyecto ON plandesarrollo.subsistema.sub_codigo = plandesarrollo.proyecto.sub_codigo
                                         WHERE plandesarrollo.subsistema.sub_codigo = $codigo_subsistema
                                         ORDER BY pro_referencia, pro_numero ASC;";
     
            $query_list_prycto_subsstema=$this->cnxion->ejecutar($sql_list_prycto_subsstema);
    
            while($data_list_prycto_subsstema=$this->cnxion->obtener_filas($query_list_prycto_subsstema)){
                $datalist_prycto_subsstema[]=$data_list_prycto_subsstema;
            }
            return $datalist_prycto_subsstema;
        }

        public function list_accion_ejecucion($codigo_proyecto, $codigo_accion, $codigo_vigencia){

            $sql_list_accion_ejecucion="SELECT acc_codigo, acc_referencia, 
                                               acc_numero, acc_descripcion, 
                                               acc_proyecto, ind_unidadmedida, 
                                               ind_lineabase, ind_metaresultado,
                                               ind_tendencia, ind_sede,
                                               ivi_presupuesto, ind_tipocomportamiento,
                                               ind_codigo
                                          FROM plandesarrollo.accion
                                         INNER JOIN plandesarrollo.indicador ON ind_accion = acc_codigo
                                         INNER JOIN plandesarrollo.indicador_vigencia ON ind_codigo = ivi_indicador
                                         WHERE acc_proyecto = $codigo_proyecto
                                           AND acc_codigo = $codigo_accion
                                           AND ivi_vigencia = $codigo_vigencia;";
                                
            $query_list_accion_ejecucion=$this->cnxion->ejecutar($sql_list_accion_ejecucion);
    
            while($data_list_accion_ejecucion=$this->cnxion->obtener_filas($query_list_accion_ejecucion)){
                $datalist_accion_ejecucion[]=$data_list_accion_ejecucion;
            }
            return $datalist_accion_ejecucion;
        }

        public function list_accion_ejecucion_x_proyecto($codigo_proyecto, $codigo_vigencia){

            $sql_list_accion_ejecucion_x_proyecto="SELECT acc_codigo, acc_referencia, 
                                                          acc_numero, acc_descripcion, 
                                                          acc_proyecto, ind_unidadmedida, 
                                                          ind_lineabase, ind_metaresultado,
                                                          ind_tendencia, ind_sede,
                                                          ivi_presupuesto, ind_tipocomportamiento,
                                                          ind_codigo
                                                     FROM plandesarrollo.accion
                                                    INNER JOIN plandesarrollo.indicador ON ind_accion = acc_codigo
                                                    INNER JOIN plandesarrollo.indicador_vigencia ON ind_codigo = ivi_indicador
                                                    WHERE acc_proyecto = $codigo_proyecto
                                                      AND ivi_vigencia = $codigo_vigencia;";
                                
            $query_list_accion_ejecucion_x_proyecto=$this->cnxion->ejecutar($sql_list_accion_ejecucion_x_proyecto);
    
            while($data_list_accion_ejecucion_x_proyecto=$this->cnxion->obtener_filas($query_list_accion_ejecucion_x_proyecto)){
                $datalist_accion_ejecucion_x_proyecto[]=$data_list_accion_ejecucion_x_proyecto;
            }
            return $datalist_accion_ejecucion_x_proyecto;
        }

        public function list_actividades($codigo_accion, $codigo_vigencia, $codigo_indicador){

            $sql_list_actividades="SELECT acp_codigo, acp_referencia, 
                                          acp_numero, acp_descripcion
                                     FROM planaccion.actividad_poai
                                    WHERE acp_estado = '1'
                                      AND acp_accion = $codigo_accion
                                      AND acp_vigencia = $codigo_vigencia
                                      AND acp_sedeindicador = $codigo_indicador
                                    ORDER BY acp_numero ASC;";
                                
            $query_list_actividades=$this->cnxion->ejecutar($sql_list_actividades);
    
            while($data_list_actividades=$this->cnxion->obtener_filas($query_list_actividades)){
                $datalist_actividades[]=$data_list_actividades;
            }
            return $datalist_actividades;
        }
      
        public function cantidad_etapas($codigo_actividad){

            $sql_cantidad_etapas="SELECT COUNT(*) AS cantdad_etapas
                                    FROM planaccion.poai
                                   WHERE poa_estado = '1'
                                     AND acp_codigo = $codigo_actividad;";
    
            $query_cantidad_etapas = $this->cnxion->ejecutar($sql_cantidad_etapas);
    
            $data_cantidad_etapas = $this->cnxion->obtener_filas($query_cantidad_etapas);
    
            $cantdad_etapas = $data_cantidad_etapas['cantdad_etapas'];

            if($cantdad_etapas == 0){
                $cantidad_datos = 0;
            }
            else{
                $cantidad_datos = $cantdad_etapas - 1;
            }
            return $cantidad_datos;
        }

        public function list_etapas($codigo_actividad){

            $sql_list_etapas="SELECT poa_codigo, poa_referencia, poa_numero, 
                                     poa_objeto, poa_recurso, poa_logro, 
                                     poa_estado, poa_logroejecutado,
                                     poa_logro*poa_logroejecutado AS avance_esperado
                                FROM planaccion.poai
                               WHERE poa_estado = '1'
                                 AND acp_codigo = $codigo_actividad
                               ORDER BY poa_numero ASC;";
                                
            $query_list_etapas=$this->cnxion->ejecutar($sql_list_etapas);
    
            while($data_list_etapas=$this->cnxion->obtener_filas($query_list_etapas)){
                $datalist_etapas[]=$data_list_etapas;
            }
            return $datalist_etapas;
        }
        
        public function valor_actividad($codigo_actividad){

            $sql_valor_actividad="SELECT SUM(poa_recurso) AS total_actividad
                                    FROM planaccion.poai
                                   WHERE poa_estado = '1'
                                     AND acp_codigo = $codigo_actividad;";
    
            $query_valor_actividad = $this->cnxion->ejecutar($sql_valor_actividad);
    
            $data_valor_actividad = $this->cnxion->obtener_filas($query_valor_actividad);
    
            $total_actividad = $data_valor_actividad['total_actividad'];
    
            return $total_actividad;
        }

        public function valor_poai($codigo_etapa){

            $sql_valor_poai="SELECT SUM(asre_recurso) AS poai
                               FROM planaccion.asignacion_recuersos_etapa
                              WHERE asre_estado = 1
                                AND asre_etapa = $codigo_etapa;";
    
            $query_valor_poai = $this->cnxion->ejecutar($sql_valor_poai);
    
            $data_valor_poai = $this->cnxion->obtener_filas($query_valor_poai);
    
            $poai = $data_valor_poai['poai'];
    
            return $poai;
        }

        public function valor_cdp($codigo_etapa){

            $sql_valor_cdp="SELECT SUM(aso_valor) AS valor_cdp
                              FROM cdp.cdp
                             INNER JOIN cdp.solicitud_cdp ON cdp_solicitud = scdp_codigo
                             INNER JOIN cdp.actividad_etapa_solicitud ON cdp_solicitud = aes_solicitud
                             INNER JOIN cdp.asignacion_solicitud ON cdp_solicitud = aso_solicitud
                             WHERE aes_etapa = aso_etapa
                               AND aes_etapa = $codigo_etapa;";
    
            $query_valor_cdp = $this->cnxion->ejecutar($sql_valor_cdp);
    
            $data_valor_cdp = $this->cnxion->obtener_filas($query_valor_cdp);
    
            $valor_cdp = $data_valor_cdp['valor_cdp'];

            if($valor_cdp){
                $vlor_cdp = $valor_cdp;
            }
            else{
                $vlor_cdp = 0;
            }
            return $vlor_cdp;
        }

        public function valor_rp($codigo_etapa){

            $sql_valor_rp="SELECT SUM(rp_valor) AS valor_rps
                             FROM cdp.rp
                            INNER JOIN cdp.cdp ON rp_cdp = cdp_codigo
                            INNER JOIN cdp.solicitud_cdp ON cdp_solicitud = scdp_codigo
                            INNER JOIN cdp.actividad_etapa_solicitud ON aes_solicitud = scdp_codigo
                            WHERE aes_etapa = $codigo_etapa;";
    
            $query_valor_rp = $this->cnxion->ejecutar($sql_valor_rp);
    
            $data_valor_rp = $this->cnxion->obtener_filas($query_valor_rp);
    
            $valor_rps = $data_valor_rp['valor_rps'];

            if($valor_rps){
                $vlor_rp = $valor_rps;
            }
            else{
                $vlor_rp = 0;
            }
            return $vlor_rp;
        }


        public function list_acciones_codigo($codigo_proyecto, $codigo_accion){

            $sql_list_acciones_codigo="SELECT acc_codigo, acc_referencia, 
                                              acc_numero, acc_descripcion, 
                                              acc_proyecto
                                         FROM plandesarrollo.accion
                                        WHERE acc_proyecto = $codigo_proyecto
                                          AND acc_codigo = $codigo_accion;";
                                
            $query_list_acciones_codigo=$this->cnxion->ejecutar($sql_list_acciones_codigo);
    
            while($data_list_acciones_codigo=$this->cnxion->obtener_filas($query_list_acciones_codigo)){
                $datalist_acciones_codigo[]=$data_list_acciones_codigo;
            }
            return $datalist_acciones_codigo;
        }
        public function list_acciones($codigo_proyecto){

            $sql_list_acciones="SELECT acc_codigo, acc_referencia, 
                                       acc_numero, acc_descripcion, 
                                       acc_proyecto
                                  FROM plandesarrollo.accion
                                 WHERE acc_proyecto = $codigo_proyecto
                                 ORDER BY acc_numero ASC;";
                                
            $query_list_acciones=$this->cnxion->ejecutar($sql_list_acciones);
    
            while($data_list_acciones=$this->cnxion->obtener_filas($query_list_acciones)){
                $datalist_acciones[]=$data_list_acciones;
            }
            return $datalist_acciones;
        }

        public function actvddes_accion($codigo_accion, $codigo_vigencia){

            $sql_actvddes_accion="SELECT acp_codigo, acp_accion, acp_referencia, 
                                         acp_numero, acp_descripcion, acp_objetivo, 
                                         acp_estado, acp_vigencia, acp_sedeindicador, 
                                         acp_unidad
                                    FROM planaccion.actividad_poai
                                   WHERE acp_estado = '1'
                                     AND acp_vigencia = $codigo_vigencia
                                     AND acp_accion = $codigo_accion
                                   ORDER BY acp_numero ASC;";
                                
            $query_actvddes_accion = $this->cnxion->ejecutar($sql_actvddes_accion);
    
            while($data_actvddes_accion = $this->cnxion->obtener_filas($query_actvddes_accion)){
                $dataactvddes_accion[] = $data_actvddes_accion;
            }
            return $dataactvddes_accion;
        }

        public function cantidad_cdp_etapa($codigo_etapa){

            $sql_cantidad_cdp_etapa="SELECT COUNT(DISTINCT(esc_etapa, scdp_codigo)) AS cantidad_campos
                                       FROM cdp.etapa_solicitud_clasificador 
                                      INNER JOIN cdp.solicitud_cdp ON esc_solicitud = scdp_codigo
                                      INNER JOIN cdp.cdp ON scdp_codigo = cdp_solicitud
                                      WHERE esc_etapa = $codigo_etapa;";
    
            $query_cantidad_cdp_etapa = $this->cnxion->ejecutar($sql_cantidad_cdp_etapa);
    
            $data_cantidad_cdp_etapa = $this->cnxion->obtener_filas($query_cantidad_cdp_etapa);
    
            $cantidad_campos = $data_cantidad_cdp_etapa['cantidad_campos'];

            if($cantidad_campos == 0){
                $cantidad_cmpos = 0;
            }
            else{
                $cantidad_cmpos = $cantidad_campos - 1;
            }
            return $cantidad_cmpos;
        }

        public function cantidad_convinar($codigo_actividad){
            $cantidad_etapas = $this->cantidad_etapas($codigo_actividad);
            $list_etapas = $this->list_etapas($codigo_actividad);
            if($list_etapas){
                foreach($list_etapas as $dat_etpas){
                    $poa_codigo = $dat_etpas['poa_codigo'];

                    $cantidad_cdp_etapa = $this->cantidad_cdp_etapa($poa_codigo);

                    $cantidad_etapas = $cantidad_etapas + $cantidad_cdp_etapa;
                }
            }
            return $cantidad_etapas;
        } 
        
        public function datos_indicador($codigo_indicador){

            $sql_datos_indicador="SELECT ind_codigo, ind_unidadmedida, 
                                         ind_estado, ind_sede, 
                                         sed_nombre
                                    FROM plandesarrollo.indicador, 
                                         principal.sedes
                                   WHERE ind_sede = sed_codigo
                                     AND ind_codigo = $codigo_indicador;";
    
            $resultado_datos_indicador=$this->cnxion->ejecutar($sql_datos_indicador);
    
            while ($data_datos_indicador = $this->cnxion->obtener_filas($resultado_datos_indicador)){
                $datadatos_indicador[] = $data_datos_indicador;
            }
            return $datadatos_indicador;
        }

        public function list_cdp($codigo_etapa){

            $sql_list_cdp="SELECT cdp_codigo, cdp_solicitud, cdp_fecha, 
                                  cdp_numeroexpedicion, aes_etapa, 
                                  aes_valoretapa
                             FROM cdp.cdp
                            INNER JOIN cdp.solicitud_cdp ON cdp_solicitud = scdp_codigo
                            INNER JOIN cdp.actividad_etapa_solicitud ON scdp_codigo = aes_solicitud
                            WHERE aes_etapa = $codigo_etapa;";
    
            $resultado_list_cdp=$this->cnxion->ejecutar($sql_list_cdp);
    
            while ($data_list_cdp = $this->cnxion->obtener_filas($resultado_list_cdp)){
                $datalist_cdp[] = $data_list_cdp;
            }
            return $datalist_cdp;
        }

        public function list_clasfcdres($codigo_solicitud, $codigo_etapa){

            $sql_list_clasfcdres="SELECT esc_codigo, esc_clasificador
                                    FROM cdp.etapa_solicitud_clasificador
                                   WHERE esc_solicitud = $codigo_solicitud
                                     AND esc_etapa = $codigo_etapa;";
    
            $resultado_list_clasfcdres=$this->cnxion->ejecutar($sql_list_clasfcdres);
    
            $clafcdores = "";
            while ($data_list_clasfcdres = $this->cnxion->obtener_filas($resultado_list_clasfcdres)){
                $num_clsfcdor = $data_list_clasfcdres['esc_clasificador'];
                $clafcdores = $clafcdores.$num_clsfcdor."\n";
            }
            return $clafcdores;
        }

        public function list_fuentes($codigo_solicitud, $codigo_etapa){

            $sql_list_fuentes="SELECT DISTINCT ffi_codigo, ffi_codigolinix
                                 FROM cdp.asignacion_solicitud
                                INNER JOIN planaccion.asignacion_recuersos_etapa ON aso_asignacion = asre_codigo
                                INNER JOIN planaccion.fuente_financiacion ON asre_fuente = ffi_codigo
                                WHERE aso_valor > 0
                                  AND aso_solicitud = $codigo_solicitud
                                  AND aso_etapa = $codigo_etapa;";
    
            $resultado_list_fuentes=$this->cnxion->ejecutar($sql_list_fuentes);
    
            $num_fuente = "";
            while ($data_list_fuentes = $this->cnxion->obtener_filas($resultado_list_fuentes)){
                $ffi_codigolinix = $data_list_fuentes['ffi_codigolinix'];
                $num_fuente = $num_fuente.$ffi_codigolinix."\n";
            }
            return $num_fuente;
        }

        public function val_cdp($codigo_cdp){

            $sql_val_cdp="SELECT SUM(aso_valor) AS suma_cdp
                            FROM cdp.cdp
                           INNER JOIN cdp.solicitud_cdp ON cdp_solicitud = scdp_codigo
                           INNER JOIN cdp.asignacion_solicitud ON scdp_codigo = aso_solicitud
                           WHERE cdp_codigo = $codigo_cdp;";
    
            $query_val_cdp = $this->cnxion->ejecutar($sql_val_cdp);
    
            $data_val_cdp = $this->cnxion->obtener_filas($query_val_cdp);
    
            $suma_cdp = $data_val_cdp['suma_cdp'];

            if($suma_cdp){
                $total_cdp = $suma_cdp;
            }
            else{
                $total_cdp = 0;
            }
            return $total_cdp;
        }

        public function datos_rp($codigo_cdp){

            $sql_datos_rp="SELECT rp_codigo, rp_cdp, rp_fecha, 
                                  rp_numerorp, rp_otrovalor, 
                                  rp_valor, rp_proveedor, 
                                  rp_actoadmin, rp_servicio
                             FROM cdp.rp
                            WHERE rp_cdp = $codigo_cdp;";
    
            $resultado_datos_rp=$this->cnxion->ejecutar($sql_datos_rp);
    
            while ($data_datos_rp = $this->cnxion->obtener_filas($resultado_datos_rp)){
                $datadatos_rp[] = $data_datos_rp;
            }
            return $datadatos_rp;
        }

        public function avanceEsperado($codigo_actividad){
        
            $sql_avanceEsperado="SELECT poa_logroejecutado,poa_logro
                                   FROM planaccion.poai,planaccion.actividad_poai
                                  WHERE planaccion.poai.acp_codigo = planaccion.actividad_poai.acp_codigo
                                    AND poa_estado = '1'
                                    AND planaccion.poai.acp_codigo = $codigo_actividad ";
    
            $resultado_avanceEsperado=$this->cnxion->ejecutar($sql_avanceEsperado);
    
            while ($data_avanceEsperado = $this->cnxion->obtener_filas($resultado_avanceEsperado)){
                $dataAvanceEsperado[] = $data_avanceEsperado;
            }
            return $dataAvanceEsperado;
        }
        
    }
    
?>