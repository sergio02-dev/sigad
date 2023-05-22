<?php
/**
 * Karen Yuliana Palacio Minú
 * 23 de Abril del 2023 
 * Rs Autorizacion Responsable Accion
 */
include('classAutrzcionRspnsbleAccion.php');
class RsAutrzcionRspnsbleAccion extends AutorizacionResponsableAccion{
    private $cnxion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function ultimo_plan(){

        $sql_ultimo_plan="SELECT pde_codigo, pde_nombre 
                            FROM plandesarrollo.plan_desarrollo
                           ORDER BY pde_yearinicio DESC
                           LIMIT 1 OFFSET 0;";

        $query_ultimo_plan=$this->cnxion->ejecutar($sql_ultimo_plan);

        $data_ultimo_plan=$this->cnxion->obtener_filas($query_ultimo_plan);
        
        $pde_codigo = $data_ultimo_plan['pde_codigo'];

        return $pde_codigo;
    }

    public function list_solicitudes(){

        $ultimo_plan = $this->ultimo_plan();

        if($_SESSION['idusuario']==1 || $_SESSION['idusuario']==201604281729001 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1){
            $condicion_listar = "AND scdp_accion IN(SELECT res_codigonivel
                                                      FROM usco.responsable
                                                     WHERE res_estado = 1
                                                       AND res_nivel = 3
                                                       AND res_tiporesponsable = 3
                                                       AND res_clasificacion = 3)";
        }
        else{
            $condicion_listar = "AND scdp_accion IN(SELECT res_codigonivel
                                                      FROM usco.responsable
                                                     WHERE res_estado = 1
                                                       AND res_nivel = 3
                                                       AND res_tiporesponsable = 3
                                                       AND res_clasificacion = 3
                                                       AND res_codigooficina IN(SELECT vin_oficina
                                                                                 FROM usco.vinculacion
                                                                                WHERE vin_estado = 1
                                                                                  AND vin_persona = ".$_SESSION['idusuario']."
                                                                                  AND vin_oficina = res_codigooficina)
                                                       AND res_codigocargo IN(SELECT vin_cargo
                                                                                FROM usco.vinculacion
                                                                               WHERE vin_estado = 1
                                                                                 AND vin_persona = ".$_SESSION['idusuario']."
                                                                                 AND vin_cargo = res_codigocargo))";
        }

        $sql_list_solicitudes="SELECT scdp_codigo, scdp_fecha, scdp_accion, 
                                      scdp_oficina, scdp_cargo, scdp_numero,
                                      scdp_proceso, scdp_consecutivo
                                 FROM cdp.solicitud_cdp
                           INNER JOIN plandesarrollo.accion ON scdp_accion = acc_codigo
                           INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                           INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                WHERE pde_codigo = $ultimo_plan
                                $condicion_listar;";

        $query_list_solicitudes=$this->cnxion->ejecutar($sql_list_solicitudes);

        while($data_list_solicitudes=$this->cnxion->obtener_filas($query_list_solicitudes)){
            $datalist_solicitudes[]=$data_list_solicitudes;
        }
        return $datalist_solicitudes;
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

    public function fuentes_solicitud($codigo_solicitud){

        $sql_fuentes_solctud="SELECT ffi_codigo,
                                     asre_vigenciarecurso, ffi_nombre
                                FROM cdp.asignacion_solicitud
                               INNER JOIN planaccion.asignacion_recuersos_etapa ON aso_asignacion = asre_codigo
                               INNER JOIN planaccion.fuente_financiacion ON asre_fuente = ffi_codigo
                               WHERE aso_solicitud = $codigo_solicitud
                                 AND aso_valor > 0
                                GROUP BY asre_vigenciarecurso,ffi_codigo,ffi_nombre
                                ORDER BY asre_vigenciarecurso,ffi_codigo,ffi_nombre ASC";
 
        $query_fuentes_solctud=$this->cnxion->ejecutar($sql_fuentes_solctud);

        while($data_fuentes_solctud=$this->cnxion->obtener_filas($query_fuentes_solctud)){
            $datafuentes_solctud[]=$data_fuentes_solctud;
        }
        return $datafuentes_solctud;
    }

    public function autorzacion_tecnica($codigo_solicitud){

        $sql_autorzacion_tecnica="SELECT COUNT(*) AS aprovacion_tecnica
                                    FROM cdp.aprovacion_solicitud
                                   WHERE asol_clasificacion = 1 
                                     AND asol_solicitud = $codigo_solicitud;";

        $query_autorzacion_tecnica=$this->cnxion->ejecutar($sql_autorzacion_tecnica);

        $data_autorzacion_tecnica=$this->cnxion->obtener_filas($query_autorzacion_tecnica);

        $aprovacion_tecnica = $data_autorzacion_tecnica['aprovacion_tecnica'];

        return $aprovacion_tecnica;
    }

    public function necesita_autorizacion_tecnica($codigo_accion){

        $sql_necesita_autorizacion_tecnica="SELECT COUNT(*) AS need_authorization
                                              FROM usco.responsable
                                             WHERE res_estado = 1
                                               AND res_nivel = 3
                                               AND res_tiporesponsable = 3
                                               AND res_clasificacion = 1
                                               AND res_codigonivel = $codigo_accion";

        $query_necesita_autorizacion_tecnica=$this->cnxion->ejecutar($sql_necesita_autorizacion_tecnica);

        $data_necesita_autorizacion_tecnica=$this->cnxion->obtener_filas($query_necesita_autorizacion_tecnica);

        $need_authorization = $data_necesita_autorizacion_tecnica['need_authorization'];

        return $need_authorization;
    }

    public function validar_aprovacion_solicitud($codigo_solicitud){

        $sql_validar_aprovacion_solicitud="SELECT COUNT(*) AS numero_aprovaciones
                                             FROM cdp.aprovacion_solicitud_clasificador
                                            INNER JOIN cdp.aprovacion_solicitud ON asol_codigo = ascl_aprovacionsolicitud
                                            WHERE ascl_aprovacion = 1
                                              AND asol_clasificacion = 1
                                              AND asol_solicitud = $codigo_solicitud;";

        $query_validar_aprovacion_solicitud=$this->cnxion->ejecutar($sql_validar_aprovacion_solicitud);

        $data_validar_aprovacion_solicitud=$this->cnxion->obtener_filas($query_validar_aprovacion_solicitud);

        $numero_aprovaciones = $data_validar_aprovacion_solicitud['numero_aprovaciones'];

        return $numero_aprovaciones;
    }

    public function autorizacion_responsable_accion($codigo_solicitud){

        $sql_autorizacion_responsable_accion="SELECT COUNT(*) AS aprovacion_responsable_accion
                                                FROM cdp.aprovacion_solicitud
                                               WHERE asol_clasificacion = 3
                                                 AND asol_solicitud = $codigo_solicitud;";

        $query_autorizacion_responsable_accion=$this->cnxion->ejecutar($sql_autorizacion_responsable_accion);

        $data_autorizacion_responsable_accion=$this->cnxion->obtener_filas($query_autorizacion_responsable_accion);

        $aprovacion_responsable_accion = $data_autorizacion_responsable_accion['aprovacion_responsable_accion'];

        return $aprovacion_responsable_accion;
    }

    public function suma_valor_solicitud($codigo_solicitud, $codigo_accion){

        $necesita_autorizacion_tecnica = $this->necesita_autorizacion_tecnica($codigo_accion);
        if($necesita_autorizacion_tecnica > 0){
            $condicion = "AND esc_codigo IN(SELECT DISTINCT ascl_etapasolicitudclasificador 
                                              FROM cdp.aprovacion_solicitud
                                             INNER JOIN cdp.aprovacion_solicitud_clasificador ON asol_codigo = ascl_aprovacionsolicitud
                                             WHERE asol_clasificacion = 1
                                               AND ascl_aprovacion = 1
                                               AND asol_solicitud = $codigo_solicitud)";
        }
        else{
            $condicion = "";
        }

        $sql_suma_valor_solicitud="SELECT SUM(esc_valor) AS valor_cdp
                                     FROM cdp.etapa_solicitud_clasificador
                                    WHERE esc_solicitud = $codigo_solicitud
                                    $condicion;";

        $query_suma_valor_solicitud=$this->cnxion->ejecutar($sql_suma_valor_solicitud);

        $data_suma_valor_solicitud=$this->cnxion->obtener_filas($query_suma_valor_solicitud);

        $valor_cdp = $data_suma_valor_solicitud['valor_cdp'];

        return $valor_cdp;
    }

    public function datListSolicitudes(){
        
        $rs_solicitudes = $this->list_solicitudes();
        $rsAutrzcion = array();
        if($rs_solicitudes){
            foreach ($rs_solicitudes as $dta_solicitud) {
                $scdp_codigo = $dta_solicitud['scdp_codigo'];
                $scdp_fecha = date('d/m/Y',strtotime($dta_solicitud['scdp_fecha']));
                $scdp_accion = $dta_solicitud['scdp_accion'];
                $scdp_numero = $dta_solicitud['scdp_numero'];
                $scdp_consecutivo = $dta_solicitud['scdp_consecutivo'];
                $scdp_proceso = $dta_solicitud['scdp_proceso'];                

                $suma_valor_solicitud = $this->suma_valor_solicitud($scdp_codigo, $scdp_accion);

                $descripcion_accion = $this->descripcion_accion($scdp_accion);

                $fuentes_solctud = $this->fuentes_solicitud($scdp_codigo);
                $fntes = '';
                if($fuentes_solctud){
                    foreach ($fuentes_solctud as $dta_fuents_solctud) {
                        $aso_codigo = $dta_fuents_solctud['aso_codigo'];
                        $asre_vigenciarecurso = $dta_fuents_solctud['asre_vigenciarecurso'];
                        $ffi_nombre = $dta_fuents_solctud['ffi_nombre'];

                        $fntes = $fntes.$asre_vigenciarecurso." ".str_replace('INV -','', $ffi_nombre)." <br>";

                    }
                }
                
                $ceros = '';

                if($scdp_consecutivo <10){
                    $ceros = '0000';
                    $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;
                }
                else if ($scdp_consecutivo > 9 && $scdp_consecutivo <100){
                    $ceros = '000';
                    $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;
                }
                else if( $scdp_consecutivo >99 && $scdp_consecutivo <1000){
                    $ceros = '00';
                    $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;
                }
                else if( $scdp_consecutivo >999 && $scdp_consecutivo <10000){
                    $ceros = '0';
                    $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;
                }
                else{
                    $numero_solicitudCDP = $scdp_numero.'-'.$scdp_consecutivo;
                }

                $necesita_autorizacion_tecnica = $this->necesita_autorizacion_tecnica($scdp_accion);

                
                if($necesita_autorizacion_tecnica > 0){
                    $autorzacion_tecnica = $this->autorzacion_tecnica($scdp_codigo);
                    if($autorzacion_tecnica > 0){
                        $validar_aprovacion_solicitud = $this->validar_aprovacion_solicitud($scdp_codigo);
                        
                        if($validar_aprovacion_solicitud > 0){
                            $autorizacion_responsable_accion = $this->autorizacion_responsable_accion($scdp_codigo);
                            if($autorizacion_responsable_accion == 0){
                                $rsAutrzcion[] = array('scdp_codigo'=> $scdp_codigo, 
                                                       'scdp_fecha'=> $scdp_fecha, 
                                                       'scdp_numero'=> $numero_solicitudCDP,
                                                       'scdp_accion' => $scdp_accion,
                                                       'descripcion_accion'=> $descripcion_accion,
                                                       'valor_cdp'=> "$ ".number_format($suma_valor_solicitud,0,'','.'),
                                                       'nombre_fuente'=> $fntes,
                                                       'scdp_proceso'=> $scdp_proceso
                                );
                            }
                        }
                        else{

                        }
                    }
                    else{

                    }
                }
                else{
                    $autorizacion_responsable_accion = $this->autorizacion_responsable_accion($scdp_codigo);
                    if($autorizacion_responsable_accion == 0){
                        $rsAutrzcion[] = array('scdp_codigo'=> $scdp_codigo, 
                                               'scdp_fecha'=> $scdp_fecha, 
                                               'scdp_numero'=> $numero_solicitudCDP,
                                               'scdp_accion' => $scdp_accion,
                                               'descripcion_accion'=> $descripcion_accion,
                                               'valor_cdp'=> "$ ".number_format($suma_valor_solicitud,0,'','.'),
                                               'nombre_fuente'=> $fntes,
                                               'scdp_proceso'=> $scdp_proceso
                        );
                    }
                }
            }

            if($rsAutrzcion){
                $datAutorizaciones=json_encode(array("data"=>$rsAutrzcion));
            }
            else{
                $datAutorizaciones=json_encode(array("data"=>""));
            }
        }
        else{
            $datAutorizaciones=json_encode(array("data"=>""));
        } 
        return $datAutorizaciones;
    }

    public function numero_res_accion(){
        
        $rs_solicitudes = $this->list_solicitudes();
        $numero_pendientes = 0;
        if($rs_solicitudes){
            foreach ($rs_solicitudes as $dta_solicitud) {
                $scdp_codigo = $dta_solicitud['scdp_codigo'];
                $scdp_accion = $dta_solicitud['scdp_accion'];

                $necesita_autorizacion_tecnica = $this->necesita_autorizacion_tecnica($scdp_accion);

                if($necesita_autorizacion_tecnica > 0){
                    $autorzacion_tecnica = $this->autorzacion_tecnica($scdp_codigo);
                    if($autorzacion_tecnica > 0){
                        $validar_aprovacion_solicitud = $this->validar_aprovacion_solicitud($scdp_codigo);
                        
                        if($validar_aprovacion_solicitud > 0){
                            $autorizacion_responsable_accion = $this->autorizacion_responsable_accion($scdp_codigo);
                            if($autorizacion_responsable_accion == 0){
                                $numero_pendientes++;
                            }
                        }
                    }
                }
            }
        }
        return $numero_pendientes;
    }

    public function datos_solicitud($codigo_solicitud){

        $sql_datos_solicitud="SELECT scdp_codigo, scdp_fecha, scdp_numero, 
                                     scdp_accion, scdp_resolucion, 
                                     scdp_fecharesolucion, scdp_objeto, 
                                     scdp_consecutivo, scdp_codigoresolucion
                                FROM cdp.solicitud_cdp
                               WHERE scdp_codigo = $codigo_solicitud;";
 
        $query_datos_solicitud=$this->cnxion->ejecutar($sql_datos_solicitud);

        while($data_datos_solicitud=$this->cnxion->obtener_filas($query_datos_solicitud)){
            $datadatos_solicitud[]=$data_datos_solicitud;
        }
        return $datadatos_solicitud;
    }

    public function actividades_solicitud($codigo_solicitud, $codigo_accion){

        $necesita_autorizacion_tecnica = $this->necesita_autorizacion_tecnica($codigo_accion);
        if($necesita_autorizacion_tecnica > 0){
            $condicion = "AND aes_actividad IN(SELECT DISTINCT ascl_actividad 
                                                 FROM cdp.aprovacion_solicitud
                                                INNER JOIN cdp.aprovacion_solicitud_clasificador ON asol_codigo = ascl_aprovacionsolicitud
                                                WHERE asol_clasificacion = 1
                                                  AND ascl_aprovacion = 1
                                                  AND asol_solicitud = $codigo_solicitud)";
        }
        else{
            $condicion = "";
        }

        $sql_actividades_solicitud = "SELECT DISTINCT aes_actividad, acp_referencia, 
                                             acp_numero, acp_descripcion
                                        FROM cdp.actividad_etapa_solicitud
                                       INNER JOIN planaccion.actividad_poai ON aes_actividad = acp_codigo
                                       WHERE aes_solicitud = $codigo_solicitud
                                       $condicion
                                       ORDER BY acp_numero ASC ;";

        $query_actividades_solicitud = $this->cnxion->ejecutar($sql_actividades_solicitud);

        while($data_actividades_solicitud=$this->cnxion->obtener_filas($query_actividades_solicitud)){
            $dataactividades_solicitud[] = $data_actividades_solicitud;
        }
        return $dataactividades_solicitud;
    }

    public function etapa_solicitud($codigo_solicitud, $codigo_actividad, $codigo_accion){

        $necesita_autorizacion_tecnica = $this->necesita_autorizacion_tecnica($codigo_accion);
        if($necesita_autorizacion_tecnica > 0){
            $condicion = "AND aes_etapa IN(SELECT DISTINCT ascl_etapa 
                                                 FROM cdp.aprovacion_solicitud
                                                INNER JOIN cdp.aprovacion_solicitud_clasificador ON asol_codigo = ascl_aprovacionsolicitud
                                                WHERE asol_clasificacion = 1
                                                  AND ascl_aprovacion = 1
                                                  AND asol_solicitud = $codigo_solicitud)";
        }
        else{
            $condicion = "";
        }


        $sql_etapa_solicitud = "SELECT aes_codigo, aes_solicitud, aes_actividad, 
                                       aes_etapa, aes_valoretapa, aes_otrovalor, 
                                       poa_referencia, poa_numero, poa_objeto
                                  FROM cdp.actividad_etapa_solicitud
                                 INNER JOIN planaccion.poai ON aes_etapa = poa_codigo
                                 WHERE aes_solicitud = $codigo_solicitud
                                   AND aes_actividad = $codigo_actividad
                                   $condicion;";

        $query_etapa_solicitud = $this->cnxion->ejecutar($sql_etapa_solicitud);

        while($data_etapa_solicitud=$this->cnxion->obtener_filas($query_etapa_solicitud)){
            $dataetapa_solicitud[] = $data_etapa_solicitud;
        }
        return $dataetapa_solicitud;
    }

    public function clasificador_etapa($codigo_solicitud, $codigo_etapa, $codigo_accion){

        $necesita_autorizacion_tecnica = $this->necesita_autorizacion_tecnica($codigo_accion);
        if($necesita_autorizacion_tecnica > 0){
            $condicion = "AND esc_codigo IN(SELECT DISTINCT ascl_etapasolicitudclasificador 
                                              FROM cdp.aprovacion_solicitud
                                             INNER JOIN cdp.aprovacion_solicitud_clasificador ON asol_codigo = ascl_aprovacionsolicitud
                                             WHERE asol_clasificacion = 1
                                               AND ascl_aprovacion = 1
                                               AND asol_solicitud = $codigo_solicitud)";
        }
        else{
            $condicion = "";
        }

        $sql_clasificador_etapa = "SELECT esc_codigo, esc_solicitud, esc_etapa, 
                                          esc_solitudetapa, esc_clasificador, 
                                          esc_valor, esc_dane
                                     FROM cdp.etapa_solicitud_clasificador
                                    WHERE esc_solicitud = $codigo_solicitud
                                      AND esc_etapa = $codigo_etapa
                                      $condicion;";

        $query_clasificador_etapa = $this->cnxion->ejecutar($sql_clasificador_etapa);

        while($data_clasificador_etapa=$this->cnxion->obtener_filas($query_clasificador_etapa)){
            $dataclasificador_etapa[] = $data_clasificador_etapa;
        }
        return $dataclasificador_etapa;
    }

    public function nmbre_clsfcdor($codigo_clasificador){

        $sql_nmbre_clsfcdor = "SELECT cla_codigo, cla_nombre, cla_numero, cla_estado
                                 FROM principal.clasificadores
                                WHERE cla_codigo = $codigo_clasificador";

        $query_nmbre_clsfcdor = $this->cnxion->ejecutar($sql_nmbre_clsfcdor);

        $data_nmbre_clsfcdor=$this->cnxion->obtener_filas($query_nmbre_clsfcdor);

        $cla_nombre = $data_nmbre_clsfcdor['cla_nombre'];
        $cla_numero = $data_nmbre_clsfcdor['cla_numero'];

        return array($cla_nombre, $cla_numero);
    }    
}
?>