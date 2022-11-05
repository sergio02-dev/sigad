<?php
/**
 * Karen Yuliana Palacio Minú
 * 25 de Abril 2022 12:31pm
 * Rs Asignacion Recursos
 */
include('classAsignacionRecurso.php');
class RsAsignacionRcrsos extends AsignacionRecursoss{

    private $cnxion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function vigencia_actividad($codigo_poai){

        $sql_vigencia_actividad="SELECT planaccion.actividad_poai.acp_codigo, acp_vigencia
                                   FROM planaccion.actividad_poai, 
                                        planaccion.poai
                                  WHERE planaccion.actividad_poai.acp_codigo = planaccion.poai.acp_codigo
                                    AND poa_codigo = $codigo_poai;";

        $query_vigencia_actividad=$this->cnxion->ejecutar($sql_vigencia_actividad);

        $data_vigencia_actividad=$this->cnxion->obtener_filas($query_vigencia_actividad);

        $acp_vigencia = $data_vigencia_actividad['acp_vigencia'];

        return $acp_vigencia;
    }

    public function fuente_indicdor($codigo_poai, $codigo_accion, $codigo_indicador, $vigencia_actividad){


        $sql_fuente_indicdor="SELECT DISTINCT poav_accion AS accion, poav_fuentefinanciacion AS fuente_financiacion, 
                                     poav_recurso AS recurso,  poav_vigencia AS vigencia_recurso, 
                                     ffi_nombre AS nombre_fuente, poav_indicador AS codigo_indicador,
                                     poav_codigo AS codigo_recurso, 1 AS codigo_tipo
                                FROM planaccion.poai_veinte_veintidos, planaccion.fuente_financiacion
                               WHERE poav_fuentefinanciacion = ffi_codigo
                                 AND poav_estado = 1
                                 AND poav_accion = $codigo_accion
                                 AND poav_vigencia = $vigencia_actividad
                                 AND poav_indicador = $codigo_indicador
                               UNION
                              SELECT poav_accion AS accion, sff_fuente AS fuente_financiacion, 
                                     apoai_valor AS recurso, sff_vigencia AS vigencia_recurso,
                                     ffi_nombre AS nombre_fuente, poav_indicador AS codigo_indicador,
                                     apoai_codigo AS codigo_recurso, 1 AS codigo_tipo
                                FROM planaccion.poai_veinte_veintidos, planaccion.adicion_poai, 
                                     planaccion.saldos_fuente_financiacion, planaccion.fuente_financiacion
                               WHERE poav_codigo = apoai_poai
                                 AND apoai_saldo = sff_codigo
                                 AND sff_fuente = ffi_codigo
                                 AND poav_estado = 1
                                 AND apoai_estado = 1
                                 AND poav_accion = $codigo_accion
                                 AND poav_vigencia = $vigencia_actividad
                                 AND poav_indicador = $codigo_indicador;";       

        $query_fuente_indicdor=$this->cnxion->ejecutar($sql_fuente_indicdor);

        while($data_fuente_indicdor=$this->cnxion->obtener_filas($query_fuente_indicdor)){
            $datafuente_indicdor[] = $data_fuente_indicdor;
        }
        return $datafuente_indicdor;
    }

    public function fuente_vigencia($codigo_recurso){

        $sql_fuente_vigencia="SELECT poav_codigo AS codigo_recurso, 
                                     poav_fuentefinanciacion AS codigo_fuente, 
                                     poav_vigencia AS codigo_vigencia, 
                                     ffi_nombre AS nombre_fuente
                                FROM planaccion.poai_veinte_veintidos
                               INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                               WHERE poav_codigo = $codigo_recurso
                               UNION 	
                              SELECT apoai_codigo AS codigo_recurso, 
                                     sff_fuente AS codigo_fuente, 
                                     sff_vigencia AS codigo_vigencia, 
                                     ffi_nombre AS nombre_fuente
                                FROM planaccion.adicion_poai
                               INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                               INNER JOIN planaccion.fuente_financiacion ON sff_fuente = ffi_codigo
                               WHERE apoai_codigo = $codigo_recurso;";

        $query_fuente_vigencia=$this->cnxion->ejecutar($sql_fuente_vigencia);

        $data_fuente_vigencia=$this->cnxion->obtener_filas($query_fuente_vigencia);

        $codigo_vigencia = $data_fuente_vigencia['codigo_vigencia'];
        $nombre_fuente = $data_fuente_vigencia['nombre_fuente'];
        $codigo_fuente = $data_fuente_vigencia['codigo_fuente'];
        
        return array($codigo_vigencia, $codigo_fuente, $nombre_fuente);
    }


    public function list_recursos_traladados($codigo_accion, $codigo_indicador, $vigencia_actividad){


        $sql_list_recursos_traladados="SELECT tpo_codigo, tpo_accion AS accion, 
                                              tpo_codigorecuerso AS codigo_recurso, 
                                              tpo_valor AS recurso, 
                                              tpo_indicador AS codigo_indicador, 
                                              2 AS codigo_tipo
                                         FROM planaccion.traslados_poai
                                        INNER JOIN planaccion.poai_veinte_veintidos ON poav_codigo = tpo_poai
                                        WHERE tpo_estado = 1
                                          AND poav_estado = 1
                                          AND tpo_accion = $codigo_accion
                                          AND poav_vigencia = $vigencia_actividad
                                          AND tpo_indicador = $codigo_indicador;";       

        $query_list_recursos_traladados=$this->cnxion->ejecutar($sql_list_recursos_traladados);

        while($data_list_recursos_traladados=$this->cnxion->obtener_filas($query_list_recursos_traladados)){
            $datalist_recursos_traladados[] = $data_list_recursos_traladados;
        }
        return $datalist_recursos_traladados;
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

    public function recrso_asignado($codigo_poai, $codigo_fuente, $codigo_accion, $codigo_indicador, $vigencia_recurso, $vigencia_actividad, $codigo_asignacion, $codigo_tipo){
        if($codigo_asignacion){
            $condicion_asignacion = "AND asre_codigo NOT IN($codigo_asignacion)";
        }
        else{
            $condicion_asignacion = "";
        }

        $sql_recurso_asignado="SELECT SUM(asre_recurso) AS recurso_asigno
                                 FROM planaccion.asignacion_recuersos_etapa
                                WHERE asre_estado = 1 
                                  AND asre_vigenciapoai = $vigencia_actividad
                                  AND asre_fuente = $codigo_fuente
                                  AND asre_accion = $codigo_accion
                                  AND asre_indicador = $codigo_indicador
                                  AND asre_vigenciarecurso = $vigencia_recurso
                                  AND asre_tipo = $codigo_tipo
                                  $condicion_asignacion;";

        $query_recurso_asignado=$this->cnxion->ejecutar($sql_recurso_asignado);

        $data_recurso_asignado=$this->cnxion->obtener_filas($query_recurso_asignado);

        $recurso_asigno = $data_recurso_asignado['recurso_asigno'];

        if($recurso_asigno){
            $gasto = $recurso_asigno;
        }
        else{
            $gasto = 0;
        }
        return $gasto;
    }

    public function list_fuente_disponibilidad($codigo_poai, $codigo_accion, $codigo_indicador, $codigo_asignacion){
        $codigo_poai = $codigo_poai;
        $codigo_accion = $codigo_accion;
        $codigo_indicador = $codigo_indicador;
        $codigo_asignacion = $codigo_asignacion;
        $vigencia_actividad = $this->vigencia_actividad($codigo_poai);
        $fuente_indicdor = $this->fuente_indicdor($codigo_poai, $codigo_accion, $codigo_indicador, $vigencia_actividad);

        if($fuente_indicdor){
            foreach($fuente_indicdor as $dta_fnte_fnnccion){
                $accion = $dta_fnte_fnnccion['accion'];
                $fuente_financiacion = $dta_fnte_fnnccion['fuente_financiacion'];
                $recurso = $dta_fnte_fnnccion['recurso'];
                $vigencia_recurso = $dta_fnte_fnnccion['vigencia_recurso'];
                $nombre_fuente = $dta_fnte_fnnccion['nombre_fuente'];
                $codigo_indicador = $dta_fnte_fnnccion['codigo_indicador'];
                $codigo_recurso = $dta_fnte_fnnccion['codigo_recurso'];
                $codigo_tipo = $dta_fnte_fnnccion['codigo_tipo'];

                $recurso_asignado = $this->recrso_asignado($codigo_poai, $fuente_financiacion, $codigo_accion, $codigo_indicador, $vigencia_recurso, $vigencia_actividad, $codigo_asignacion, $codigo_tipo);


                //Recurso Trasladado 
                $restar_trasladado = $this->restar_trasladado($codigo_recurso);

                //FIn 
                $recurso_disponible = $recurso - $recurso_asignado - $restar_trasladado;

                if($recurso_disponible>0){
                    $array_fuentes_asignacion[] = array('codigo_fuente'=> $fuente_financiacion,
                                                        'vigencia_recurso'=> $vigencia_recurso,
                                                        'nombre_fuente'=> $nombre_fuente,
                                                        'recurso_disponible'=> $recurso_disponible,
                                                        'codigo_tipo'=> $codigo_tipo
                                                    );
                }
            }

            $list_recursos_traladados = $this->list_recursos_traladados($codigo_accion, $codigo_indicador, $vigencia_actividad); 
            if($list_recursos_traladados){
                foreach($list_recursos_traladados as $dta_rcrsos_trsldos){
                    $tpo_codigo = $dta_rcrsos_trsldos['tpo_codigo'];
                    $accion = $dta_rcrsos_trsldos['accion']; 
                    $codigo_recurso = $dta_rcrsos_trsldos['codigo_recurso']; 
                    $recurso = $dta_rcrsos_trsldos['recurso']; 
                    $codigo_indicador = $dta_rcrsos_trsldos['codigo_indicador']; 
                    $codigo_tipo = $dta_rcrsos_trsldos['codigo_tipo'];

                    list($vigencia_recurso, $codigo_fuente, $nombre_fuente) = $this->fuente_vigencia($codigo_recurso);

                    $recurso_asignado = $this->recrso_asignado($codigo_poai, $codigo_fuente, $codigo_accion, $codigo_indicador, $vigencia_recurso, $vigencia_actividad, $codigo_asignacion, $codigo_tipo);

                    $recurso_disponible = $recurso - $recurso_asignado;

                    if($recurso_disponible>0){
                        $array_fuentes_asignacion[] = array('codigo_fuente'=> $codigo_fuente,
                                                            'vigencia_recurso'=> $vigencia_recurso,
                                                            'nombre_fuente'=> $nombre_fuente,
                                                            'recurso_disponible'=> $recurso_disponible,
                                                            'codigo_tipo'=> $codigo_tipo
                                                        );
                    }
                }
            }      
        }
        return $array_fuentes_asignacion;
    }  

    public function recurso_etapa($codigo_etapa){

        $sql_recurso_etapa="SELECT asre_codigo, asre_etapa, asre_accion, 
                                   asre_fuente, asre_indicador, 
                                   asre_recurso, asre_estado,
                                   ffi_nombre, asre_vigenciarecurso
                              FROM planaccion.asignacion_recuersos_etapa,
                                   planaccion.fuente_financiacion
                             WHERE ffi_codigo = asre_fuente
                               AND asre_etapa = $codigo_etapa;";

        $query_recurso_etapa=$this->cnxion->ejecutar($sql_recurso_etapa);

        while($data_recurso_etapa=$this->cnxion->obtener_filas($query_recurso_etapa)){
            $datarecurso_etapa[] = $data_recurso_etapa;
        }
        return $datarecurso_etapa;
    }

    
    public function asignacion_form($codigo_asignacion){

        $sql_asignacion_form="SELECT asre_codigo, asre_etapa, 
                                     asre_accion, asre_fuente, 
                                     asre_indicador, asre_vigenciarecurso, 
                                     asre_vigenciapoai, asre_recurso, 
                                     asre_estado, asre_tipo
                                FROM planaccion.asignacion_recuersos_etapa
                               WHERE asre_codigo = $codigo_asignacion;";

        $query_asignacion_form=$this->cnxion->ejecutar($sql_asignacion_form);

        while($data_asignacion_form=$this->cnxion->obtener_filas($query_asignacion_form)){
            $dataasignacion_form[] = $data_asignacion_form;
        }
        return $dataasignacion_form;
    }

    public function datos_etapa($codigo_poai){

        $sql_datos_etapa="SELECT poa_codigo, poa_referencia, poa_objeto, 
                                 poa_recurso, poa_logro, poa_estado, poa_numero, 
                                 poa_vigencia, poa_logroejecutado
                            FROM planaccion.poai
                           WHERE poa_codigo = $codigo_poai;";

        $query_datos_etapa=$this->cnxion->ejecutar($sql_datos_etapa);

        while($data_datos_etapa=$this->cnxion->obtener_filas($query_datos_etapa)){
            $datadatos_etapa[] = $data_datos_etapa;
        }
        return $datadatos_etapa;
    }
}

?>