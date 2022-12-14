<?php
include('classSolicitudCdp.php');
Class RsSolicitudCdp extends SolicitudCdp{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function codigo_plan(){

        $sql_codigo_plan="SELECT pde_codigo, pde_nombre 
                            FROM plandesarrollo.plan_desarrollo
                           ORDER BY pde_fechacreo DESC
                           LIMIT 1 OFFSET 0;";

        $query_codigo_plan=$this->cnxion->ejecutar($sql_codigo_plan);

        $data_codigo_plan=$this->cnxion->obtener_filas($query_codigo_plan);

        $pde_codigo = $data_codigo_plan['pde_codigo'];

        return $pde_codigo;
    }

    public function codigo_plan_accion($codigo_accion){

        $sql_codigo_plan_accion="SELECT acc_codigo, acc_referencia, 
                                        acc_descripcion, acc_numero, 
                                        pde_codigo
                                   FROM plandesarrollo.accion
                                  INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                  INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                  WHERE acc_codigo = $codigo_accion;";

        $query_codigo_plan_accion=$this->cnxion->ejecutar($sql_codigo_plan_accion);

        $data_codigo_plan_accion=$this->cnxion->obtener_filas($query_codigo_plan_accion);

        $pde_codigo = $data_codigo_plan_accion['pde_codigo'];

        return $pde_codigo;
    }

    public function datos_accion($codigo_accion){

        $sql_datos_accion="SELECT acc_codigo, acc_referencia, 
                                  acc_numero, acc_descripcion
                             FROM plandesarrollo.accion
                            WHERE acc_codigo = $codigo_accion;";

        $query_datos_accion=$this->cnxion->ejecutar($sql_datos_accion);

        $data_datos_accion=$this->cnxion->obtener_filas($query_datos_accion);

        $acc_referencia = $data_datos_accion['acc_referencia'];
        $acc_numero = $data_datos_accion['acc_numero'];
        $acc_descripcion = $data_datos_accion['acc_descripcion'];

        $dtos_accion = $acc_referencia.".".$acc_numero." ".$acc_descripcion;

        return $dtos_accion;
    }

    public function nombre_nivel_tres($codigo_plan){

        $sql_nombre_nivel_tres="SELECT pde_niveltres
                                  FROM plandesarrollo.plan_desarrollo
                                 WHERE pde_codigo = $codigo_plan;";

        $query_nombre_nivel_tres=$this->cnxion->ejecutar($sql_nombre_nivel_tres);

        $data_nombre_nivel_tres=$this->cnxion->obtener_filas($query_nombre_nivel_tres);
        
        $pde_niveltres = $data_nombre_nivel_tres['pde_niveltres'];
        
        return $pde_niveltres;
    }

    public function plan_accion_consulta($codigo_plan){

        $codigo_session = $_SESSION['idusuario'];
        
        if($codigo_session == 1 || $codigo_session==201604281729001 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1){
            $sql_plan_accion="SELECT DISTINCT plandesarrollo.plan_desarrollo.pde_codigo, pde_nombre,  
                                              sub_nombre, pro_descripcion, acc_descripcion, acc_referencia,
                                              acc_numero, plandesarrollo.subsistema.sub_codigo, 
                                              plandesarrollo.proyecto.pro_codigo, 
                                              plandesarrollo.accion.acc_codigo
                                         FROM plandesarrollo.plan_desarrollo,
                                              plandesarrollo.subsistema,
                                              plandesarrollo.proyecto,
                                              plandesarrollo.accion
                                        WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                          AND plandesarrollo.subsistema.sub_codigo=plandesarrollo.proyecto.sub_codigo
                                          AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                                          AND plandesarrollo.plan_desarrollo.pde_codigo=$codigo_plan";
        }
        else{
            $sql_plan_accion="SELECT DISTINCT plandesarrollo.plan_desarrollo.pde_codigo, pde_nombre,  
                                              sub_nombre, pro_descripcion, acc_descripcion, acc_referencia,
                                              acc_numero, plandesarrollo.subsistema.sub_codigo, 
                                              plandesarrollo.proyecto.pro_codigo, 
                                              plandesarrollo.accion.acc_codigo
                                         FROM plandesarrollo.plan_desarrollo,
                                              plandesarrollo.subsistema,
                                              plandesarrollo.proyecto,
                                              plandesarrollo.accion
                                        WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                          AND plandesarrollo.subsistema.sub_codigo=plandesarrollo.proyecto.sub_codigo
                                          AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                                          AND plandesarrollo.plan_desarrollo.pde_codigo=$codigo_plan
                                          AND plandesarrollo.subsistema.sub_codigo IN(SELECT DISTINCT res_codigonivel
                                                                                        FROM usco.vinculacion, usco.responsable
                                                                                        WHERE vin_persona = $codigo_session
                                                                                        AND res_codigocargo = vin_cargo
                                                                                        AND vin_oficina = res_codigooficina
                                                                                        AND res_estado = 1
                                                                                        AND vin_estado = 1
                                                                                        AND res_nivel = 1)
                              UNION 
                              SELECT DISTINCT plandesarrollo.plan_desarrollo.pde_codigo, pde_nombre,  
                                              sub_nombre, pro_descripcion, acc_descripcion, acc_referencia,
                                              acc_numero, plandesarrollo.subsistema.sub_codigo, 
                                              plandesarrollo.proyecto.pro_codigo, 
                                              plandesarrollo.accion.acc_codigo
                                         FROM plandesarrollo.plan_desarrollo,
                                              plandesarrollo.subsistema,
                                              plandesarrollo.proyecto,
                                              plandesarrollo.accion
                                        WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                          AND plandesarrollo.subsistema.sub_codigo=plandesarrollo.proyecto.sub_codigo
                                          AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                                          AND plandesarrollo.plan_desarrollo.pde_codigo=$codigo_plan
                                          AND plandesarrollo.proyecto.pro_codigo IN(SELECT DISTINCT res_codigonivel
                                                                                        FROM usco.vinculacion, usco.responsable
                                                                                        WHERE vin_persona = $codigo_session
                                                                                        AND res_codigocargo = vin_cargo
                                                                                        AND vin_oficina = res_codigooficina
                                                                                        AND res_estado = 1
                                                                                        AND vin_estado = 1
                                                                                        AND res_nivel = 2)
                             UNION 
                             SELECT DISTINCT plandesarrollo.plan_desarrollo.pde_codigo, pde_nombre,  
                                              sub_nombre, pro_descripcion, acc_descripcion, acc_referencia,
                                              acc_numero, plandesarrollo.subsistema.sub_codigo, 
                                              plandesarrollo.proyecto.pro_codigo, 
                                              plandesarrollo.accion.acc_codigo
                                         FROM plandesarrollo.plan_desarrollo,
                                              plandesarrollo.subsistema,
                                              plandesarrollo.proyecto,
                                              plandesarrollo.accion
                                        WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                          AND plandesarrollo.subsistema.sub_codigo=plandesarrollo.proyecto.sub_codigo
                                          AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                                          AND plandesarrollo.plan_desarrollo.pde_codigo=$codigo_plan
                                          AND  plandesarrollo.accion.acc_codigo IN(SELECT DISTINCT res_codigonivel
                                                                                        FROM usco.vinculacion, usco.responsable
                                                                                        WHERE vin_persona = $codigo_session
                                                                                        AND res_codigocargo = vin_cargo
                                                                                        AND vin_oficina = res_codigooficina
                                                                                        AND res_estado = 1
                                                                                        AND vin_estado = 1
                                                                                        AND res_nivel = 3)";
            
        }            
        $resultado_plan_accion=$this->cnxion->ejecutar($sql_plan_accion);

        while ($data_plan_accion = $this->cnxion->obtener_filas($resultado_plan_accion)){
            $dataplan_accion[] = $data_plan_accion;
        }
        return $dataplan_accion;
    }

    public function suma_etapas($codigo_actividad){

        $sql_suma_etapas="SELECT SUM(poa_logro) AS suma
                            FROM planaccion.poai
                           WHERE poa_estado = '1'
                             AND acp_codigo = $codigo_actividad;";

        $query_suma_etapas=$this->cnxion->ejecutar($sql_suma_etapas);

        $data_suma_etapas=$this->cnxion->obtener_filas($query_suma_etapas);

        $suma = $data_suma_etapas['suma'];

        return $suma;
    }

    public function list_actividades($codigo_accion){

        if($_SESSION['idusuario']==1 || $_SESSION['idusuario']==201604281729001 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1 ){
            $condicionVer="";
        }
        else{
            $condicionVer="AND planaccion.actividad_poai.acp_codigo IN(SELECT DISTINCT acp_codigo
                                                                            FROM planaccion.actividad_poai, usco.vinculacion
                                                                        WHERE  acp_oficina = vin_oficina
                                                                        AND acp_cargo = vin_cargo 
                                                                        AND vin_persona = ".$_SESSION['idusuario']." )";
        }

        $sql_list_actividades="SELECT acp_codigo, acp_descripcion, acp_accion, 
                                      acp_referencia, acp_numero, acp_estado 
                                 FROM planaccion.actividad_poai
                                WHERE acp_estado = '1'
                                  AND acp_accion = $codigo_accion
                                  $condicionVer
                                ORDER BY acp_numero ASC;";

        $query_list_actividades=$this->cnxion->ejecutar($sql_list_actividades);

        while($data_list_actividades=$this->cnxion->obtener_filas($query_list_actividades)){
            $datalist_actividades[]=$data_list_actividades;
        }
        return $datalist_actividades;
    }

    public function actividades_accion($codigo_accion){

        $array_actividades = array();
        $list_actividades = $this->list_actividades($codigo_accion);

        if($list_actividades){
            foreach ($list_actividades as $dta_lsta_actvddes) {
                $acp_codigo = $dta_lsta_actvddes['acp_codigo'];
                $acp_descripcion = $dta_lsta_actvddes['acp_descripcion'];
                $acp_referencia = $dta_lsta_actvddes['acp_referencia'];
                $acp_numero = $dta_lsta_actvddes['acp_numero'];

                $referencia = $acp_referencia.".".$acp_numero;

                $suma_etapas = $this->suma_etapas($acp_codigo);

                if($suma_etapas == 100){
                    $array_actividades[] = array('codigo_actividad'=> $acp_codigo,
                                                 'descripcion'=> $acp_descripcion,
                                                 'referencia'=> $referencia,
                                           );
                }                
            }
        }
        return $array_actividades;
    }

    public function etapas_actividad($cdigo_actividad){

        $sql_etapas_actividad = "SELECT poa_codigo, poa_referencia, 
                                        poa_objeto, poa_recurso, 
                                        poa_estado, poa_numero, 
                                        poa_vigencia, acp_codigo, 
                                        poa_logroejecutado
                                FROM planaccion.poai
                                WHERE acp_codigo IN($cdigo_actividad)
                                AND poa_estado = '1'
                                ORDER BY acp_codigo, poa_numero;";

        $resultado_etapas_actividad = $this->cnxion->ejecutar($sql_etapas_actividad);

        while ($data_etapas_actividad = $this->cnxion->obtener_filas($resultado_etapas_actividad)){
            $dataetapas_actividad[] = $data_etapas_actividad;
        }
        return $dataetapas_actividad;
    }
    
    public function list_solicitudes(){

        $sql_list_solicitudes="SELECT scdp_codigo, scdp_fecha, scdp_accion, 
                                      scdp_oficina, scdp_cargo, scdp_numero,
                                      scdp_proceso
                                 FROM cdp.solicitud_cdp ;";

        $query_list_solicitudes=$this->cnxion->ejecutar($sql_list_solicitudes);

        while($data_list_solicitudes=$this->cnxion->obtener_filas($query_list_solicitudes)){
            $datalist_solicitudes[]=$data_list_solicitudes;
        }
        return $datalist_solicitudes;
    }

    public function fuentes_solctud($codigo_solicitud){

        $sql_fuentes_solctud="SELECT aso_codigo, aso_solicitud, 
                                     aso_etapa, aso_asignacion, 
                                     aso_otrovalor, aso_valor,
                                     asre_vigenciarecurso, ffi_nombre
                                FROM cdp.asignacion_solicitud
                               INNER JOIN planaccion.asignacion_recuersos_etapa ON aso_asignacion = asre_codigo
                               INNER JOIN planaccion.fuente_financiacion ON asre_fuente = ffi_codigo
                                WHERE aso_solicitud = $codigo_solicitud
                                ORDER BY asre_vigenciarecurso ASC";
 
        $query_fuentes_solctud=$this->cnxion->ejecutar($sql_fuentes_solctud);

        while($data_fuentes_solctud=$this->cnxion->obtener_filas($query_fuentes_solctud)){
            $datafuentes_solctud[]=$data_fuentes_solctud;
        }
        return $datafuentes_solctud;
    }

    public function gasto_asignacion($codigo_asignacion, $codigo_solicitud){
        if($codigo_solicitud){
            $sql_condicion = "AND aso_solicitud NOT IN($codigo_solicitud)";
        }
        else{
            $sql_condicion = "";
        }

        $sql_gasto_asignacion="SELECT SUM(aso_valor) AS sum_val
                                 FROM cdp.asignacion_solicitud
                                WHERE aso_asignacion = $codigo_asignacion
                                $sql_condicion;";

        $query_gasto_asignacion=$this->cnxion->ejecutar($sql_gasto_asignacion);

        $data_gasto_asignacion=$this->cnxion->obtener_filas($query_gasto_asignacion);

        $sum_val = $data_gasto_asignacion['sum_val'];

        if($sum_val){
            $suma_asignacion = $sum_val;
        }
        else{
            $suma_asignacion = 0; 
        }
        return $suma_asignacion;
    }
    
    public function descripcion_accion($codigo_accion){

        $sql_descripcion_accion="SELECT acc_codigo, acc_referencia, 
                                        acc_descripcion, acc_numero
                                   FROM plandesarrollo.accion
                                  WHERE acc_codigo = $codigo_accion;";

        $query_descripcion_accion=$this->cnxion->ejecutar($sql_descripcion_accion);

        $data_descripcion_accion=$this->cnxion->obtener_filas($query_descripcion_accion);

        $acc_referencia = $data_descripcion_accion['acc_referencia'];
        $acc_numero = $data_descripcion_accion['acc_numero'];
        $acc_descripcion = $data_descripcion_accion['acc_descripcion'];

        $dscrpcion = $acc_referencia.".".$acc_numero." ".$acc_descripcion;

        return $dscrpcion;
    }


    public function nombre_fuente($codigo_fuente){

        $sql_nombre_fuente="SELECT ffi_codigo, ffi_nombre, ffi_descripcion, 
                                   ffi_tipofuente, ffi_estado
                              FROM planaccion.fuente_financiacion
                             WHERE ffi_codigo = $codigo_fuente;";

        $query_nombre_fuente=$this->cnxion->ejecutar($sql_nombre_fuente);

        $data_nombre_fuente=$this->cnxion->obtener_filas($query_nombre_fuente);

        $ffi_nombre = $data_nombre_fuente['ffi_nombre'];

        return $ffi_nombre;
    }

    public function act_solicitud($codigo_solicitud){

        $sql_act_solicitud="SELECT DISTINCT aes_actividad, acp_codigo, 
                                   acp_descripcion, acp_referencia, 
                                   acp_estado, acp_vigencia, 
                                   acp_numero, acp_objetivo
                              FROM cdp.actividad_etapa_solicitud,
                                   planaccion.actividad_poai
                             WHERE aes_actividad = acp_codigo
                               AND aes_solicitud = $codigo_solicitud;";

        $query_act_solicitud=$this->cnxion->ejecutar($sql_act_solicitud);

        while($data_act_solicitud=$this->cnxion->obtener_filas($query_act_solicitud)){
            $dataact_solicitud[]=$data_act_solicitud;
        }
        return $dataact_solicitud;
    }

    public function etpa_solicitud($codigo_solicitud){

        $sql_etpa_solicitud="SELECT aes_codigo, aes_solicitud, aes_actividad, 
                                    aes_etapa, aes_valoretapa, poa_referencia,
                                    poa_numero, poa_objeto
                               FROM cdp.actividad_etapa_solicitud, 
                                    planaccion.poai
                              WHERE aes_etapa = poa_codigo
                                AND aes_solicitud = $codigo_solicitud;";

        $query_etpa_solicitud=$this->cnxion->ejecutar($sql_etpa_solicitud);

        while($data_etpa_solicitud=$this->cnxion->obtener_filas($query_etpa_solicitud)){
            $dataetpa_solicitud[]=$data_etpa_solicitud;
        }
        return $dataetpa_solicitud;
    }

    public function suma_valor_solicitud($codigo_solicitud){

        $sql_suma_valor_solicitud="SELECT SUM(aso_valor) AS valor_cdp
                                     FROM cdp.asignacion_solicitud
                                    WHERE aso_solicitud = $codigo_solicitud;";

        $query_suma_valor_solicitud=$this->cnxion->ejecutar($sql_suma_valor_solicitud);

        $data_suma_valor_solicitud=$this->cnxion->obtener_filas($query_suma_valor_solicitud);

        $valor_cdp = $data_suma_valor_solicitud['valor_cdp'];

        return $valor_cdp;
    }

    public function codigo_cdp($codigo_solicitud){

        $sql_codigo_cdp = "SELECT cdp_codigo, cdp_solicitud
                             FROM cdp.cdp
                            WHERE cdp_solicitud = $codigo_solicitud;";

        $query_codigo_cdp = $this->cnxion->ejecutar($sql_codigo_cdp);

        $data_codigo_cdp = $this->cnxion->obtener_filas($query_codigo_cdp);

        $cdp_codigo = $data_codigo_cdp['cdp_codigo'];

        return $cdp_codigo;
    }

    public function datListSolicitudes(){
        
        $rs_solicitudes = $this->list_solicitudes();

        if($rs_solicitudes){
            foreach ($rs_solicitudes as $dta_solicitud) {
                $scdp_codigo = $dta_solicitud['scdp_codigo'];
                $scdp_fecha = $dta_solicitud['scdp_fecha'];
                $scdp_accion = $dta_solicitud['scdp_accion'];
                $scdp_numero = $dta_solicitud['scdp_numero'];
                $scdp_proceso = $dta_solicitud['scdp_proceso'];

                if($scdp_proceso == 2){
                    $codigo_cdp = $this->codigo_cdp($scdp_codigo);
                }
                else{
                    $codigo_cdp = 0;
                }

                $suma_valor_solicitud = $this->suma_valor_solicitud($scdp_codigo);

                $descripcion_accion = $this->descripcion_accion($scdp_accion);

                $fuentes_solctud = $this->fuentes_solctud($scdp_codigo);
                $fntes = '';
                if($fuentes_solctud){
                    foreach ($fuentes_solctud as $dta_fuents_solctud) {
                        $aso_codigo = $dta_fuents_solctud['aso_codigo'];
                        $asre_vigenciarecurso = $dta_fuents_solctud['asre_vigenciarecurso'];
                        $ffi_nombre = $dta_fuents_solctud['ffi_nombre'];

                        $fntes = $fntes.$asre_vigenciarecurso." ".str_replace('INV -','', $ffi_nombre)." <br>";
                    }
                }

    
                $rsRslciones[] = array('scdp_codigo'=> $scdp_codigo, 
                                       'scdp_fecha'=> $scdp_fecha, 
                                       'scdp_numero'=> $scdp_numero,
                                       'descripcion_accion'=> $descripcion_accion,
                                       'valor_cdp'=> "$ ".number_format($suma_valor_solicitud,0,'','.'),
                                       'nombre_fuente'=> $fntes,
                                       'scdp_proceso'=> $scdp_proceso,
                                       'codigo_cdp'=> $codigo_cdp
                                    );
    
            }
            $datResolucion=json_encode(array("data"=>$rsRslciones));
        }
        else{
            $datResolucion=json_encode(array("data"=>""));
        } 
        return $datResolucion;
    }

    public function form_solicitud_cdp($codigo_solicitud){

        $sql_form_solicitud_cdp="SELECT scdp_codigo, scdp_fecha, 
                                        scdp_numero, scdp_accion, 
                                        scdp_estado, scdp_proceso
                                   FROM cdp.solicitud_cdp
                                  WHERE scdp_codigo = $codigo_solicitud;";

        $query_form_solicitud_cdp=$this->cnxion->ejecutar($sql_form_solicitud_cdp);

        while($data_form_solicitud_cdp=$this->cnxion->obtener_filas($query_form_solicitud_cdp)){
            $dataform_solicitud_cdp[]=$data_form_solicitud_cdp;
        }
        return $dataform_solicitud_cdp;
    }

    

    public function cantidad_chequed_actividades($codigo_solicitud){

        $sql_cantidad_chequed_actividades="SELECT COUNT(DISTINCT aes_actividad) AS cantidad
                                             FROM cdp.actividad_etapa_solicitud
                                            WHERE aes_solicitud = $codigo_solicitud;";

        $query_cantidad_chequed_actividades=$this->cnxion->ejecutar($sql_cantidad_chequed_actividades);

        $data_cantidad_chequed_actividades=$this->cnxion->obtener_filas($query_cantidad_chequed_actividades);

        $cantidad = $data_cantidad_chequed_actividades['cantidad'];

        return $cantidad;
    }

    public function chequed_actividad($codigo_solicitud, $codigo_actividad){

        $sql_chequed_actividad="SELECT COUNT(DISTINCT aes_actividad) AS chequeo
                                  FROM cdp.actividad_etapa_solicitud
                                 WHERE aes_solicitud = $codigo_solicitud
                                   AND aes_actividad = $codigo_actividad;";

        $query_chequed_actividad = $this->cnxion->ejecutar($sql_chequed_actividad);

        $data_chequed_actividad = $this->cnxion->obtener_filas($query_chequed_actividad);

        $chequeo = $data_chequed_actividad['chequeo'];

        return $chequeo;
    }

    public function etapa_editar($codigo_solicitud){

        $sql_etapa_editar="SELECT poa_codigo, poa_referencia, 
                                  poa_objeto, poa_recurso, 
                                  poa_estado, poa_numero, 
                                  poa_vigencia, acp_codigo, 
                                  poa_logroejecutado
                             FROM planaccion.poai
                            WHERE acp_codigo IN(SELECT DISTINCT aes_actividad
                                                  FROM cdp.actividad_etapa_solicitud
                                                 WHERE aes_solicitud = $codigo_solicitud)
                              AND poa_estado = '1'
                            ORDER BY acp_codigo, poa_numero;";

        $query_etapa_editar=$this->cnxion->ejecutar($sql_etapa_editar);

        while($data_etapa_editar=$this->cnxion->obtener_filas($query_etapa_editar)){
            $dataetapa_editar[]=$data_etapa_editar;
        }
        return $dataetapa_editar;
    }

    public function chequed_etapa($codigo_solicitud, $codigo_etapa){

        $sql_chequed_etapa="SELECT COUNT(*) AS chequeo_etpa
                              FROM cdp.actividad_etapa_solicitud
                             WHERE aes_solicitud = $codigo_solicitud
                               AND aes_etapa = $codigo_etapa;";

        $query_chequed_etapa = $this->cnxion->ejecutar($sql_chequed_etapa);

        $data_chequed_etapa = $this->cnxion->obtener_filas($query_chequed_etapa);

        $chequeo_etpa = $data_chequed_etapa['chequeo_etpa'];

        return $chequeo_etpa;
    }

    public function list_fuentes_accion($codigo_accion){

        $sql_list_fuentes_accion="SELECT DISTINCT ffi_codigo, ffi_nombre,
                                         ffi_referencialinix, 1 AS poa
                                    FROM planaccion.poai_veinte_veintidos, 
                                         planaccion.fuente_financiacion
                                   WHERE poav_fuentefinanciacion = ffi_codigo
                                     AND poav_estado = 1
                                     AND poav_accion = $codigo_accion
                                   ORDER BY ffi_nombre ASC;";

        $query_list_fuentes_accion=$this->cnxion->ejecutar($sql_list_fuentes_accion);

        while($data_list_fuentes_accion=$this->cnxion->obtener_filas($query_list_fuentes_accion)){
            $datalist_fuentes_accion[]=$data_list_fuentes_accion;
        }
        return $datalist_fuentes_accion;
    }

    public function list_saldo_fuentes($codigo_plan){

        $sql_list_saldo_fuentes="SELECT sff_codigo, sff_vigencia, 
                                        sff_fuente, sff_saldo, sff_estado, 
                                        ffi_nombre, 2 AS poa
                                   FROM planaccion.saldos_fuente_financiacion, 
                                        planaccion.fuente_financiacion
                                  WHERE sff_fuente = ffi_codigo
                                    AND sff_estado = 1
                                    AND sff_plan = $codigo_plan";

        $query_list_saldo_fuentes=$this->cnxion->ejecutar($sql_list_saldo_fuentes);

        while($data_list_saldo_fuentes=$this->cnxion->obtener_filas($query_list_saldo_fuentes)){
            $datalist_saldo_fuentes[]=$data_list_saldo_fuentes;
        }
        return $datalist_saldo_fuentes;
    }

    public function datos_etapa_solicitud($codigo_solicitud, $codigo_etapa){

        $sql_datos_etapa_solicitud="SELECT aes_etapa, aes_valoretapa, 
                                           aes_otrovalor
                                      FROM cdp.actividad_etapa_solicitud
                                     WHERE aes_solicitud = $codigo_solicitud
                                       AND aes_etapa = $codigo_etapa;";

        $query_datos_etapa_solicitud=$this->cnxion->ejecutar($sql_datos_etapa_solicitud);

        while($data_datos_etapa_solicitud=$this->cnxion->obtener_filas($query_datos_etapa_solicitud)){
            $datadatos_etapa_solicitud[]=$data_datos_etapa_solicitud;
        }
        return $datadatos_etapa_solicitud;
    }

    public function codigos_clasificadores_etapas($codigo_solicitud, $codigo_etapa){

        $sql_codigos_clasificadores_etapas="SELECT esc_codigo, esc_solicitud, 
                                                   esc_etapa, esc_solitudetapa, 
                                                   esc_clasificador
                                              FROM cdp.etapa_solicitud_clasificador
                                             WHERE esc_solicitud = $codigo_solicitud
                                               AND esc_etapa = $codigo_etapa
                                             ORDER BY esc_fechacreo ASC;";

        $query_codigos_clasificadores_etapas=$this->cnxion->ejecutar($sql_codigos_clasificadores_etapas);

        while($data_codigos_clasificadores_etapas=$this->cnxion->obtener_filas($query_codigos_clasificadores_etapas)){
            $datacodigos_clasificadores_etapas[]=$data_codigos_clasificadores_etapas;
        }
        return $datacodigos_clasificadores_etapas;
    }

    public function info_cdp($codigo_solicitud){

        $sql_info_cdp="SELECT aes_codigo, aes_solicitud, aes_actividad, 
                              aes_etapa, aes_valoretapa, aes_otrovalor,
                              acp_descripcion, acp_referencia,
                              acp_numero, poa_referencia,
                              poa_numero, poa_objeto
                         FROM cdp.actividad_etapa_solicitud, 
                              planaccion.actividad_poai,
                              planaccion.poai
                        WHERE aes_actividad = planaccion.actividad_poai.acp_codigo
                          AND aes_etapa = poa_codigo
                          AND planaccion.actividad_poai.acp_codigo = planaccion.poai.acp_codigo
                          AND aes_solicitud = $codigo_solicitud
                        ORDER BY planaccion.actividad_poai.acp_codigo, acp_numero, 
                              poa_codigo, poa_numero;";

        $query_info_cdp=$this->cnxion->ejecutar($sql_info_cdp);

        while($data_info_cdp=$this->cnxion->obtener_filas($query_info_cdp)){
            $datainfo_cdp[]=$data_info_cdp;
        }
        return $datainfo_cdp;
    }

    public function fuentes_poai_accion($codigo_actividades){

        $sql_fuentes_poai_accion="SELECT DISTINCT poav_codigo, poav_accion, 
                                         poav_fuentefinanciacion, poav_sede, 
                                         poav_recurso, ffi_nombre, 
                                         poav_indicador, acp_sedeindicador
                                    FROM planaccion.poai_veinte_veintidos, 
                                         planaccion.actividad_poai,
                                         planaccion.fuente_financiacion
                                   WHERE poav_accion = acp_accion
                                     AND poav_fuentefinanciacion = ffi_codigo
                                     AND poav_indicador = acp_sedeindicador
                                     AND acp_codigo IN($codigo_actividades);";

        $query_fuentes_poai_accion=$this->cnxion->ejecutar($sql_fuentes_poai_accion);

        while($data_fuentes_poai_accion=$this->cnxion->obtener_filas($query_fuentes_poai_accion)){
            $datafuentes_poai_accion[]=$data_fuentes_poai_accion;
        }
        return $datafuentes_poai_accion;
    }

    public function gastos_poai($codigo_poai){

        $sql_gastos_poai="SELECT SUM(fsc_valor) AS solctado 
                            FROM cdp.fuentes_solicitud_cdp
                           WHERE fsc_poai = $codigo_poai;";

        $query_gastos_poai=$this->cnxion->ejecutar($sql_gastos_poai);

        $data_gastos_poai=$this->cnxion->obtener_filas($query_gastos_poai);

        $solctado = $data_gastos_poai['solctado'];

        if($solctado == ''){
            $valor_slctado = 0;
        }
        else{
            $valor_slctado = $solctado;
        }
        return $valor_slctado;
    }



    public function lista_recursos_disponibles($codigo_actividades){
        $codigo_actividades = $codigo_actividades;
        $array_fuentes_disponibles = array();
        $fuentes_poai_accion = $this->fuentes_poai_accion($codigo_actividades);
        if($fuentes_poai_accion){
            foreach ($fuentes_poai_accion as $dat_fntes_poai){
                $poav_codigo = $dat_fntes_poai['poav_codigo'];
                $poav_accion = $dat_fntes_poai['poav_accion'];
                $poav_fuentefinanciacion = $dat_fntes_poai['poav_fuentefinanciacion'];
                $poav_recurso = $dat_fntes_poai['poav_recurso'];
                $ffi_nombre = $dat_fntes_poai['ffi_nombre'];
                $poav_indicador = $dat_fntes_poai['ffi_nombre'];

                $gastos_poai = $this->gastos_poai($poav_codigo);


                if($valor_fuente > 0){
                    $array_fuentes_disponibles[] = array('codigo_poai'=> $poav_codigo, 
                                                         'codigo_fuente'=> $poav_fuentefinanciacion,
                                                         'recursos'=> $valor_fuente,
                                                         'nombre_fuente'=> $ffi_nombre,
                                                        );
                }
            }
        }
        return $array_fuentes_disponibles;
    }

    public function poai_etapa_gasto($codigo_etapa, $codigo_solicitud){
        if($codigo_solicitud){
            $sql_condicion = "AND aso_solicitud NOT IN($codigo_solicitud)";
        }
        else{
            $sql_condicion = "";
        }

        $sql_poai_etapa_gasto="SELECT SUM(aso_valor) AS valor_expedido
                                 FROM cdp.asignacion_solicitud
                                WHERE aso_etapa = $codigo_etapa
                                $sql_condicion;";

        $query_poai_etapa_gasto=$this->cnxion->ejecutar($sql_poai_etapa_gasto);

        $data_poai_etapa_gasto=$this->cnxion->obtener_filas($query_poai_etapa_gasto);

        $valor_expedido = $data_poai_etapa_gasto['valor_expedido'];

        if($valor_expedido == ''){
            $valor_expddo = 0;
        }
        else{
            $valor_expddo = $valor_expedido;
        }
        return $valor_expddo;
    }


    public function poai_etpa_gasto_mod($codigo_etapa, $codigo_solicitud){

        $sql_poai_etapa_gasto="SELECT SUM(aes_valoretapa) AS valor_expedido
                                 FROM cdp.actividad_etapa_solicitud
                                WHERE aes_etapa = $codigo_etapa
                                  AND aes_solicitud NOT IN($codigo_solicitud);";

        $query_poai_etapa_gasto=$this->cnxion->ejecutar($sql_poai_etapa_gasto);

        $data_poai_etapa_gasto=$this->cnxion->obtener_filas($query_poai_etapa_gasto);

        $valor_expedido = $data_poai_etapa_gasto['valor_expedido'];

        if($valor_expedido == ''){
            $valor_expddo = 0;
        }
        else{
            $valor_expddo = $valor_expedido;
        }
        return $valor_expddo;
    }

    public function fuente_asignada_etapa($codigo_etapa){

        $sql_fuente_asignada_etapa = "SELECT asre_codigo, asre_etapa, asre_accion, 
                                             asre_fuente, asre_indicador, 
                                             asre_recurso, asre_estado,
                                             ffi_nombre, asre_vigenciarecurso,
                                             asre_fechacreo
                                        FROM planaccion.asignacion_recuersos_etapa,
                                             planaccion.fuente_financiacion
                                       WHERE ffi_codigo = asre_fuente
                                         AND asre_etapa = $codigo_etapa
                                         AND asre_estado = 1
                                       ORDER BY asre_fechacreo ASC;";

        $query_fuente_asignada_etapa = $this->cnxion->ejecutar($sql_fuente_asignada_etapa);

        while($data_fuente_asignada_etapa=$this->cnxion->obtener_filas($query_fuente_asignada_etapa)){
            $datafuente_asignada_etapa[] = $data_fuente_asignada_etapa;
        }
        return $datafuente_asignada_etapa;
    }

    public function actividades_solicitud($codigo_solicitud){

        $sql_actividades_solicitud = "SELECT DISTINCT aes_actividad, acp_referencia, 
                                             acp_numero, acp_descripcion
                                        FROM cdp.actividad_etapa_solicitud
                                       INNER JOIN planaccion.actividad_poai ON aes_actividad = acp_codigo
                                       WHERE aes_solicitud = $codigo_solicitud
                                       ORDER BY acp_numero ASC ;";

        $query_actividades_solicitud = $this->cnxion->ejecutar($sql_actividades_solicitud);

        while($data_actividades_solicitud=$this->cnxion->obtener_filas($query_actividades_solicitud)){
            $dataactividades_solicitud[] = $data_actividades_solicitud;
        }
        return $dataactividades_solicitud;
    }

    public function etapas_solicitud($codigo_actividad, $codigo_solicitud){

        $sql_etapas_solicitud = "SELECT aes_codigo, aes_solicitud, aes_actividad, 
                                        aes_etapa, aes_valoretapa, aes_otrovalor, 
                                        poa_codigo, poa_referencia, poa_numero, 
                                        poa_objeto, poa_recurso, poa_logro, 
                                        poa_estado, poa_vigencia, acp_codigo
                                   FROM cdp.actividad_etapa_solicitud
                                  INNER JOIN planaccion.poai ON aes_etapa = poa_codigo
                                  WHERE aes_actividad = $codigo_actividad
                                    AND aes_solicitud = $codigo_solicitud;";

        $query_etapas_solicitud = $this->cnxion->ejecutar($sql_etapas_solicitud);

        while($data_etapas_solicitud=$this->cnxion->obtener_filas($query_etapas_solicitud)){
            $dataetapas_solicitud[] = $data_etapas_solicitud;
        }
        return $dataetapas_solicitud;
    }

    public function presupuesto_x_fuente($codigo_solicitud, $codigo_asignacion){

        $sql_presupuesto_x_fuente="SELECT aso_codigo, aso_solicitud, 
                                          aso_etapa, aso_asignacion, 
                                          aso_otrovalor, aso_valor
                                     FROM cdp.asignacion_solicitud
                                    WHERE aso_solicitud = $codigo_solicitud
                                      AND aso_asignacion = $codigo_asignacion;";

        $query_presupuesto_x_fuente = $this->cnxion->ejecutar($sql_presupuesto_x_fuente);

        $data_presupuesto_x_fuente = $this->cnxion->obtener_filas($query_presupuesto_x_fuente);

        $aso_otrovalor = $data_presupuesto_x_fuente['aso_otrovalor'];
        $aso_valor = $data_presupuesto_x_fuente['aso_valor'];

        return array($aso_otrovalor, $aso_valor);
    }

    public function clasificador_etapa_solicitud($codigo_solicitud, $codigo_etapa){

        $sql_clasificador_etapa_solicitud = "SELECT esc_codigo, esc_solicitud, esc_etapa, 
                                                    esc_solitudetapa, esc_clasificador
                                               FROM cdp.etapa_solicitud_clasificador
                                              WHERE esc_solicitud = $codigo_solicitud
                                                AND esc_etapa = $codigo_etapa;";

        $query_clasificador_etapa_solicitud = $this->cnxion->ejecutar($sql_clasificador_etapa_solicitud);

        while($data_clasificador_etapa_solicitud=$this->cnxion->obtener_filas($query_clasificador_etapa_solicitud)){
            $dataclasificador_etapa_solicitud[] = $data_clasificador_etapa_solicitud;
        }
        return $dataclasificador_etapa_solicitud;
    }


}
?>