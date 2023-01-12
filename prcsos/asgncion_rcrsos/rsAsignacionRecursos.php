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

    public function recrso_asignado($codigo_fuente, $codigo_accion, $codigo_indicador, $vigencia_recurso, $vigencia_actividad, $codigo_asignacion){
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

    public function fuentes_vigencia_accion($codigo_accion, $codigo_indicador, $vigencia_actividad){

        if($_SESSION['idusuario']==1 || $_SESSION['idusuario']==201604281729001 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1){
            $codigo_session = $_SESSION['idusuario'];
            $condicion_uno="";
            $condicion_dos="";
        }
        else{
            $condicion_uno = "AND poav_fuentefinanciacion IN(SELECT DISTINCT off_fuente
                                                               FROM usco.vinculacion, usco.oficinafuente
                                                            WHERE vin_persona = $codigo_session
                                                                AND vin_cargo = off_cargo
                                                                AND vin_oficina = off_oficina
                                                                AND off_estado = 1
                                                                AND vin_estado = 1)";

            $condicion_dos = "AND sff_fuente IN(SELECT DISTINCT off_fuente
                                                               FROM usco.vinculacion, usco.oficinafuente
                                                            WHERE vin_persona = $codigo_session
                                                                AND vin_cargo = off_cargo
                                                                AND vin_oficina = off_oficina
                                                                AND off_estado = 1
                                                                AND vin_estado = 1)";
        }


        $sql_fuentes_vigencia_accion="SELECT DISTINCT poav_fuentefinanciacion AS fuente_financiacion, 
                                             poav_vigencia AS vigencia_recurso
                                        FROM planaccion.poai_veinte_veintidos, planaccion.fuente_financiacion
                                       WHERE poav_fuentefinanciacion = ffi_codigo
                                         AND poav_estado = 1
                                         AND poav_accion = $codigo_accion
                                         AND poav_vigencia = $vigencia_actividad
                                         AND poav_indicador = $codigo_indicador
                                         $condicion_uno
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
                                         AND poav_indicador = $codigo_indicador
                                         $condicion_dos
                                       UNION 
                                      SELECT DISTINCT poav_fuentefinanciacion AS fuente_financiacion, 
                                             poav_vigencia AS vigencia_recurso
                                        FROM planaccion.poai_veinte_veintidos
                                       INNER JOIN planaccion.traslados_poai ON tpo_poai = tpo_codigorecuerso
                                       WHERE poav_codigo = tpo_poai
                                         AND tpo_accion = $codigo_accion
                                         AND poav_vigencia = $vigencia_actividad
                                         AND tpo_indicador = $codigo_indicador
                                         $condicion_uno
                                       UNION 	
                                      SELECT DISTINCT sff_fuente AS fuente_financiacion, 
                                             sff_vigencia AS vigencia_recurso
                                        FROM planaccion.adicion_poai
                                       INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                                       INNER JOIN planaccion.traslados_poai ON apoai_codigo = tpo_codigorecuerso
                                       INNER JOIN planaccion.poai_veinte_veintidos ON poav_codigo = tpo_poai
                                       WHERE tpo_accion = $codigo_accion
                                         AND poav_vigencia = $vigencia_actividad
                                         AND tpo_indicador = $codigo_indicador
                                       GROUP BY fuente_financiacion, vigencia_recurso
	                                   ORDER BY vigencia_recurso, fuente_financiacion
                                       $condicion_dos;";       

        $query_fuentes_vigencia_accion=$this->cnxion->ejecutar($sql_fuentes_vigencia_accion);

        while($data_fuentes_vigencia_accion=$this->cnxion->obtener_filas($query_fuentes_vigencia_accion)){
            $datafuentes_vigencia_accion[] = $data_fuentes_vigencia_accion;
        }
        return $datafuentes_vigencia_accion;
    }

    public function recursos_disponibles($codigo_accion, $codigo_indicador, $vigencia_actividad, $codigo_fuente, $codigo_vigencia, $codigo_asignacion){

        $sql_recursos_disponibles="SELECT DISTINCT poav_codigo AS codigo_recurso, poav_fuentefinanciacion AS fuente_financiacion, 
                                          poav_vigencia AS vigencia_recurso, poav_recurso AS recursos
                                     FROM planaccion.poai_veinte_veintidos, planaccion.fuente_financiacion
                                    WHERE poav_fuentefinanciacion = ffi_codigo
                                      AND poav_estado = 1
                                      AND poav_accion = $codigo_accion
                                      AND poav_vigencia = $vigencia_actividad
                                      AND poav_indicador = $codigo_indicador
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
                                      AND poav_indicador = $codigo_indicador
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
                                      AND tpo_indicador = $codigo_indicador
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
                                      AND tpo_indicador = $codigo_indicador
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
            $recrso_asignado = $this->recrso_asignado($codigo_fuente, $codigo_accion, $codigo_indicador, $codigo_vigencia, $vigencia_actividad, $codigo_asignacion);

            $recurso_disponible = $sub_total - $recrso_asignado;
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

    public function list_fuente_disponibilidad($codigo_poai, $codigo_accion, $codigo_indicador, $codigo_asignacion){
        $codigo_poai = $codigo_poai;
        $codigo_accion = $codigo_accion;
        $codigo_indicador = $codigo_indicador;
        $codigo_asignacion = $codigo_asignacion;
        $vigencia_actividad = $this->vigencia_actividad($codigo_poai);

        $array_fuentes_asignacion = array();

        $fuentes_vigencia_accion = $this->fuentes_vigencia_accion($codigo_accion, $codigo_indicador, $vigencia_actividad);
        if($fuentes_vigencia_accion){
            foreach ($fuentes_vigencia_accion as $dat_fuentes_vigencia) {
                $fuente_financiacion = $dat_fuentes_vigencia['fuente_financiacion'];
                $vigencia_recurso = $dat_fuentes_vigencia['vigencia_recurso'];

                $recursos_disponibles = $this->recursos_disponibles($codigo_accion, $codigo_indicador, $vigencia_actividad, $fuente_financiacion, $vigencia_recurso, $codigo_asignacion);

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