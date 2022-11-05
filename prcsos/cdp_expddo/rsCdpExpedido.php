<?php
include('classCdpExpedido.php');
Class RsCDPExpddo extends CdpExpedido{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function cdp_expedido(){
        
        $sql_cdp_expedido = "SELECT scdp_codigo, scdp_fecha, 
                                    scdp_numero, scdp_accion, 
                                    scdp_estado, scdp_proceso,
                                    cdp_fecha, cdp_numeroexpedicion,
                                    cdp_codigo
                               FROM cdp.solicitud_cdp
                              INNER JOIN cdp.cdp ON scdp_codigo = cdp_solicitud
                              WHERE scdp_proceso = 2;";

        $resultado_cdp_expedido = $this->cnxion->ejecutar($sql_cdp_expedido);

        while ($data_cdp_expedido = $this->cnxion->obtener_filas($resultado_cdp_expedido)){
            $datacdp_expedido[] = $data_cdp_expedido;
        }
        return $datacdp_expedido;
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

    public function codigo_rp($codigo_cdp){

        $sql_codigo_rp="SELECT rp_codigo, rp_cdp
                          FROM cdp.rp
                         WHERE rp_cdp = $codigo_cdp;";

        $query_codigo_rp=$this->cnxion->ejecutar($sql_codigo_rp);

        $data_codigo_rp=$this->cnxion->obtener_filas($query_codigo_rp);

        $rp_codigo = $data_codigo_rp['rp_codigo'];

        return $rp_codigo;
    }

    public function datCdpExpedido(){

        if($codigo_session == 1 || $codigo_session==201604281729001 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1){
            $editar = 1;
        }
        else{
            $editar = 0;
        }
        
        $rs_cdp_expedido = $this->cdp_expedido();

        if($rs_cdp_expedido){
            foreach ($rs_cdp_expedido as $dta_cdp_expddo) {
                $scdp_codigo = $dta_cdp_expddo['scdp_codigo'];
                $cdp_codigo = $dta_cdp_expddo['cdp_codigo'];
                $scdp_fecha = $dta_cdp_expddo['scdp_fecha'];
                $scdp_numero = $dta_cdp_expddo['scdp_numero'];
                $scdp_accion = $dta_cdp_expddo['scdp_accion'];
                $cdp_fecha = $dta_cdp_expddo['cdp_fecha'];
                $cdp_numeroexpedicion = $dta_cdp_expddo['cdp_numeroexpedicion'];
               
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

                $codigo_rp = $this->codigo_rp($cdp_codigo);

                if($codigo_rp){
                    $validacion_rp = 1;
                }
                else{
                    $validacion_rp = 0;
                }
    
                $rsRslciones[] = array('codigo_solicitud'=> $scdp_codigo, 
                                       'codigo_cdp'=> $cdp_codigo,
                                       'fecha_solicitud'=> $scdp_fecha, 
                                       'fecha_expedicion'=> $cdp_fecha, 
                                       'numero_solicitud'=> $scdp_numero,
                                       'numero_expedicion'=> $cdp_numeroexpedicion,
                                       'descripcion_accion'=> $descripcion_accion,
                                       'valor_cdp'=> "$ ".number_format($suma_valor_solicitud,0,'','.'),
                                       'nombre_fuente'=> $fntes,
                                       'validacion_rp'=> $validacion_rp,
                                       'codigo_rp'=> $codigo_rp,
                                       'editar'=> $editar
                                    );
    
            }
            $datResolucion=json_encode(array("data"=>$rsRslciones));
        }
        else{
            $datResolucion=json_encode(array("data"=>""));
        } 
        return $datResolucion;
    }

    public function datos_cdp_expedido($cdp_expdido){

        $sql_datos_cdp_expedido="SELECT scdp_codigo, scdp_fecha, 
                                        scdp_numero, scdp_accion, 
                                        scdp_estado, scdp_proceso,
                                        cdp_fecha, cdp_numeroexpedicion,
                                        cdp_codigo
                                   FROM cdp.solicitud_cdp
                                  INNER JOIN cdp.cdp ON scdp_codigo = cdp_solicitud
                                  WHERE cdp_codigo = $cdp_expdido;";
                            
        $query_datos_cdp_expedido=$this->cnxion->ejecutar($sql_datos_cdp_expedido);

        while($data_datos_cdp_expedido=$this->cnxion->obtener_filas($query_datos_cdp_expedido)){
            $datadatos_cdp_expedido[]=$data_datos_cdp_expedido;
        }
        return $datadatos_cdp_expedido;
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

    public function nombre_nivel_tres($codigo_plan){

        $sql_nombre_nivel_tres="SELECT pde_niveltres
                                  FROM plandesarrollo.plan_desarrollo
                                 WHERE pde_codigo = $codigo_plan;";

        $query_nombre_nivel_tres=$this->cnxion->ejecutar($sql_nombre_nivel_tres);

        $data_nombre_nivel_tres=$this->cnxion->obtener_filas($query_nombre_nivel_tres);
        
        $pde_niveltres = $data_nombre_nivel_tres['pde_niveltres'];
        
        return $pde_niveltres;
    }

    public function actividades_solicitud($codigo_solicitud){

        $sql_actividades_solicitud="SELECT DISTINCT aes_solicitud, aes_actividad, 
                                           acp_referencia, acp_numero, 
                                           acp_descripcion
                                      FROM cdp.actividad_etapa_solicitud
                                     INNER JOIN planaccion.actividad_poai ON aes_actividad = acp_codigo
                                     WHERE aes_solicitud = $codigo_solicitud
                                     ORDER BY acp_numero ASC;";
 
        $query_actividades_solicitud=$this->cnxion->ejecutar($sql_actividades_solicitud);

        while($data_actividades_solicitud=$this->cnxion->obtener_filas($query_actividades_solicitud)){
            $dataactividades_solicitud[]=$data_actividades_solicitud;
        }
        return $dataactividades_solicitud;
    }

    public function etapa_actividad_solicitud($codigo_solicitud, $codigo_actividad){

        $sql_etapa_actividad_solicitud="SELECT aes_codigo, aes_etapa, aes_valoretapa, 
                                               aes_otrovalor, poa_referencia, poa_numero, 
                                               poa_objeto
                                          FROM cdp.actividad_etapa_solicitud
                                         INNER JOIN planaccion.poai ON aes_etapa = poa_codigo
                                         WHERE aes_solicitud = $codigo_solicitud
                                           AND aes_actividad = $codigo_actividad;";
                                    
        $query_etapa_actividad_solicitud=$this->cnxion->ejecutar($sql_etapa_actividad_solicitud);

        while($data_etapa_actividad_solicitud=$this->cnxion->obtener_filas($query_etapa_actividad_solicitud)){
            $dataetapa_actividad_solicitud[]=$data_etapa_actividad_solicitud;
        }
        return $dataetapa_actividad_solicitud;
    }

    public function recursos_designados($codigo_solicitud, $codigo_etapa){

        $sql_recursos_designados="SELECT aso_codigo, aso_solicitud, 
                                         aso_etapa, aso_asignacion, 
                                         aso_otrovalor, aso_valor,
                                         asre_vigenciarecurso, ffi_nombre
                                    FROM cdp.asignacion_solicitud
                                   INNER JOIN planaccion.asignacion_recuersos_etapa ON aso_asignacion = asre_codigo
                                   INNER JOIN planaccion.fuente_financiacion ON asre_fuente = ffi_codigo
                                   WHERE aso_solicitud = $codigo_solicitud
                                     AND aso_etapa = $codigo_etapa
                                   ORDER BY asre_vigenciarecurso ASC";
                                    
        $query_recursos_designados=$this->cnxion->ejecutar($sql_recursos_designados);

        while($data_recursos_designados=$this->cnxion->obtener_filas($query_recursos_designados)){
            $datarecursos_designados[]=$data_recursos_designados;
        }
        return $datarecursos_designados;
    }

    public function clasificadores_solicitud($codigo_solicitud, $codigo_etapa){

        $sql_clasificadores_solicitud="SELECT esc_codigo, esc_solicitud, 
                                              esc_etapa, esc_clasificador
                                         FROM cdp.etapa_solicitud_clasificador
                                        WHERE esc_solicitud = $codigo_solicitud
                                          AND esc_etapa = $codigo_etapa;";
                                    
        $query_clasificadores_solicitud=$this->cnxion->ejecutar($sql_clasificadores_solicitud);

        $clsfcdres = '';
        while($data_clasificadores_solicitud=$this->cnxion->obtener_filas($query_clasificadores_solicitud)){
            $clsfcdres = $clsfcdres.'- '.$data_clasificadores_solicitud['esc_clasificador']."<br>";
        }
        return $clsfcdres;
    }

    
    
}
?>