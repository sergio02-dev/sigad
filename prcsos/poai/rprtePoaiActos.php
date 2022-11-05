<?php
Class rprtePoaiActos{
   
  public function __construct(){
      $this->cnxion = Dtbs::getInstance();
  } 

  public function nombre_casilla($codigo_plan){

    $sql_nombre_casilla="SELECT pde_codigo, pde_nombre, pde_niveldos,
                                pde_niveltres
                            FROM plandesarrollo.plan_desarrollo
                          WHERE pde_codigo = $codigo_plan;";

    $query_nombre_casilla=$this->cnxion->ejecutar($sql_nombre_casilla);

    $data_nombre_casilla=$this->cnxion->obtener_filas($query_nombre_casilla);

    $pde_niveldos = $data_nombre_casilla['pde_niveldos'];
    $pde_niveltres = $data_nombre_casilla['pde_niveltres'];

    return $pde_niveldos."/".$pde_niveltres;
  }

  public function list_fuente_financiacion($codigo_plan, $vigencia, $codigo_acto){

    $sql_list_fuente_financiacion="SELECT DISTINCT ffi_clasificacion, ffi_nombre, ffi_codigo, poav_vigencia AS vigencia_fuente
                                      FROM plandesarrollo.accion
                                    INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                                    INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                                    INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                    INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                    WHERE plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                      AND poav_vigencia = $vigencia
                                      AND poav_acuerdo = $codigo_acto
                                      AND poav_estado = 1
                                      AND ffi_clasificacion = 3
                                      AND poav_recurso > 0
                                    UNION
                                    SELECT DISTINCT ffi_clasificacion, ffi_nombre, ffi_codigo, sff_vigencia AS vigencia_fuente
                                      FROM plandesarrollo.accion
                                    INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                                    INNER JOIN planaccion.adicion_poai ON poav_codigo = apoai_poai
                                    INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                                    INNER JOIN planaccion.fuente_financiacion ON sff_fuente = ffi_codigo
                                    INNER JOIN plandesarrollo.proyecto ON acc_codigo = poav_accion
                                    INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                    WHERE plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                      AND sff_acto = $codigo_acto
                                      AND poav_estado = 1
                                      AND ffi_clasificacion = 3
                                    UNION
                                    SELECT DISTINCT ffi_clasificacion, ffi_nombre, ffi_codigo, poav_vigencia AS vigencia_fuente
                                      FROM planaccion.traslados_poai
                                    INNER JOIN planaccion.poai_veinte_veintidos ON tpo_codigorecuerso = poav_codigo
                                    INNER JOIN plandesarrollo.accion ON acc_codigo = tpo_accion
                                    INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                                    INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                    INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                    WHERE tpo_estado = 1
                                      AND ffi_clasificacion = 3
                                      AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                      AND tpo_acuerdo = $codigo_acto
                                    UNION
                                    SELECT DISTINCT ffi_clasificacion, ffi_nombre, ffi_codigo, sff_vigencia AS vigencia_fuente
                                      FROM planaccion.traslados_poai
                                    INNER JOIN planaccion.poai_veinte_veintidos ON tpo_poai = poav_codigo
                                    INNER JOIN planaccion.adicion_poai ON tpo_codigorecuerso = apoai_codigo
                                    INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                                    INNER JOIN plandesarrollo.accion ON acc_codigo = tpo_accion
                                    INNER JOIN planaccion.fuente_financiacion ON sff_fuente = ffi_codigo
                                    INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                    INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                    WHERE tpo_estado = 1
                                      AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                      AND tpo_acuerdo = $codigo_acto
                                    ORDER BY ffi_nombre, ffi_codigo, vigencia_fuente";

    $query_list_fuente_financiacion=$this->cnxion->ejecutar($sql_list_fuente_financiacion);

    while($data_list_fuente_financiacion=$this->cnxion->obtener_filas($query_list_fuente_financiacion)){
      $datalist_fuente_financiacion[]=$data_list_fuente_financiacion;
    }
    return $datalist_fuente_financiacion;
  }

  public function anio_inicio_plan($codigo_plan){

    $sql_anio_inicio_plan="SELECT pde_codigo, pde_nombre, 
                                  pde_yearinicio, pde_yearfin
                              FROM plandesarrollo.plan_desarrollo
                            WHERE pde_codigo = $codigo_plan;";

    $query_anio_inicio_plan=$this->cnxion->ejecutar($sql_anio_inicio_plan);

    $data_anio_inicio_plan=$this->cnxion->obtener_filas($query_anio_inicio_plan);

    $pde_yearinicio = $data_anio_inicio_plan['pde_yearinicio'];

    return $pde_yearinicio;
  }

  public function lista_poai($codigo_plan){

    $sql_lista_poai="SELECT acc_codigo, acc_referencia, acc_numero, 
                            acc_descripcion, pro_codigo, pde_codigo,
                            ind_codigo, ind_unidadmedida, ind_sede,
                            sed_nombre
                        FROM principal.sedes,
                            plandesarrollo.indicador,
                            plandesarrollo.accion,
                            plandesarrollo.proyecto,
                            plandesarrollo.subsistema
                      WHERE sed_codigo = ind_sede
                        AND ind_accion = acc_codigo
                        AND acc_proyecto = pro_codigo
                        AND plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                        AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                        AND ind_estado = '1'
                      ORDER BY plandesarrollo.proyecto.sub_codigo, 
                            plandesarrollo.proyecto.pro_codigo,
                            plandesarrollo.proyecto.pro_numero,
                            acc_codigo, acc_numero, sed_nombre ASC;";

    $query_lista_poai=$this->cnxion->ejecutar($sql_lista_poai);

    while($data_lista_poai=$this->cnxion->obtener_filas($query_lista_poai)){
        $datalista_poai[]=$data_lista_poai;
    }
    return $datalista_poai;
  }

  public function unidad_vigencia($codigo_indicador, $codigo_calendario){

    $sql_unidad_vigencia="SELECT ivi_codigo, ivi_valorlogrado
                            FROM plandesarrollo.indicador_vigencia
                            WHERE ivi_vigencia = $codigo_calendario
                              AND ivi_indicador = $codigo_indicador;";

    $query_unidad_vigencia = $this->cnxion->ejecutar($sql_unidad_vigencia);

    $data_unidad_vigencia = $this->cnxion->obtener_filas($query_unidad_vigencia);

    $ivi_valorlogrado = $data_unidad_vigencia['ivi_valorlogrado'];

    return $ivi_valorlogrado;
  }

  public function restar_trasladado($codigo_recurso){

    $sql_restar_trasladado="SELECT SUM(tpo_valor) AS valortraslado
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

  public function suma_accion_traslado($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador, $vigencia_poai, $codigo_acuerdo){

    $sql_suma_accion_traslado="SELECT tpo_codigo, tpo_valor
                                 FROM planaccion.traslados_poai
                                INNER JOIN planaccion.poai_veinte_veintidos ON tpo_codigorecuerso = poav_codigo
                                INNER JOIN plandesarrollo.accion ON acc_codigo = tpo_accion
                                INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                                INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                WHERE tpo_estado = 1
                                  AND ffi_clasificacion = 3
                                  AND tpo_accion = $codigo_accion
                                  AND poav_vigencia = $codigo_calendario
                                  AND poav_fuentefinanciacion = $fuente_financiacion
                                  AND tpo_indicador = $indicador
                                  AND poav_vigencia = $vigencia_poai
                                  AND tpo_acuerdo = $codigo_acuerdo
                                UNION
                               SELECT tpo_codigo, tpo_valor
                                 FROM planaccion.traslados_poai
                                INNER JOIN planaccion.poai_veinte_veintidos ON tpo_poai = poav_codigo
                                INNER JOIN planaccion.adicion_poai ON tpo_codigorecuerso = apoai_codigo
                                INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                                INNER JOIN plandesarrollo.accion ON acc_codigo = tpo_accion
                                INNER JOIN planaccion.fuente_financiacion ON sff_fuente = ffi_codigo
                                INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                WHERE tpo_estado = 1
                                  AND tpo_accion = $codigo_accion
                                  AND sff_vigencia = $codigo_calendario
                                  AND sff_fuente = $fuente_financiacion
                                  AND tpo_indicador = $indicador
                                  AND poav_vigencia = $vigencia_poai
                                  AND tpo_acuerdo = $codigo_acuerdo";

    $query_suma_accion_traslado=$this->cnxion->ejecutar($sql_suma_accion_traslado);

    $num_filas = $this->cnxion->numero_filas($query_suma_accion_traslado);

    $sum_traslado = 0;
    if($num_filas > 0){
      while($data_suma_accion_traslado=$this->cnxion->obtener_filas($query_suma_accion_traslado)){
        $sum_traslado = $sum_traslado + $data_suma_accion_traslado['tpo_valor'];
      }
    }
    return $sum_traslado;
  }

  public function valor_poai_acuerdo($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador, $vigencia_poai, $codigo_acuerdo){

    $sql_valor_poai="SELECT poav_codigo AS codigo_recuerso, poav_recurso AS recursos
                        FROM planaccion.poai_veinte_veintidos
                      WHERE poav_estado = 1
                        AND poav_vigencia = $codigo_calendario
                        AND poav_vigencia = $vigencia_poai
                        AND poav_accion = $codigo_accion
                        AND poav_fuentefinanciacion = $fuente_financiacion
                        AND poav_indicador = $indicador
                        AND poav_acuerdo = $codigo_acuerdo
                      UNION 
                      SELECT apoai_codigo AS codigo_recuerso, apoai_valor AS recursos
                        FROM planaccion.poai_veinte_veintidos
                      INNER JOIN planaccion.adicion_poai ON poav_codigo = apoai_poai
                      INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                      WHERE apoai_estado = 1
                        AND poav_estado = 1
                        AND poav_vigencia = $vigencia_poai
                        AND sff_vigencia = $codigo_calendario
                        AND poav_accion = $codigo_accion
                        AND sff_fuente = $fuente_financiacion
                        AND poav_indicador = $indicador
                        AND sff_acto = $codigo_acuerdo;";

    $query_valor_poai=$this->cnxion->ejecutar($sql_valor_poai);

    $num_filas = $this->cnxion->numero_filas($query_valor_poai);

    $sum_rec = 0;
    if($num_filas > 0){
      while($data_valor_poai=$this->cnxion->obtener_filas($query_valor_poai)){
        $codigo_recuerso = $data_valor_poai['codigo_recuerso'];
        $valor_rcrso = $data_valor_poai['recursos'];

        $restar_trasladado = $this->restar_trasladado($codigo_recuerso);

        $sub_total = $valor_rcrso - $restar_trasladado;

        $sum_rec = $sum_rec + $sub_total;
      }
    }
    $suma_accion_traslado = $this->suma_accion_traslado($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador, $vigencia_poai, $codigo_acuerdo);
    $sum_rec = $sum_rec + $suma_accion_traslado;
    return $sum_rec;
  }

  public function suma_traslados_fuente($codigo_plan, $codigo_fuente, $vigencia_fuente, $codigo_calendario, $codigo_acuerdo){

    $sql_suma_traslados_fuente="SELECT tpo_codigo, tpo_valor
                                  FROM planaccion.traslados_poai
                                 INNER JOIN planaccion.poai_veinte_veintidos ON tpo_codigorecuerso = poav_codigo
                                 INNER JOIN plandesarrollo.accion ON acc_codigo = tpo_accion
                                 INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                                 INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                 INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                 WHERE tpo_estado = 1
                                   AND ffi_clasificacion = 3
                                   AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                   AND poav_vigencia = $codigo_calendario
                                   AND poav_fuentefinanciacion = $codigo_fuente
                                   AND poav_vigencia = $vigencia_fuente
                                   AND tpo_acuerdo = $codigo_acuerdo
                                 UNION
                                SELECT tpo_codigo, tpo_valor
                                  FROM planaccion.traslados_poai
                                 INNER JOIN planaccion.poai_veinte_veintidos ON tpo_poai = poav_codigo
                                 INNER JOIN planaccion.adicion_poai ON tpo_codigorecuerso = apoai_codigo
                                 INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                                 INNER JOIN plandesarrollo.accion ON acc_codigo = tpo_accion
                                 INNER JOIN planaccion.fuente_financiacion ON sff_fuente = ffi_codigo
                                 INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                 INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                 WHERE tpo_estado = 1
                                   AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                   AND poav_vigencia = $codigo_calendario
                                   AND sff_fuente = $codigo_fuente
                                   AND sff_vigencia = $vigencia_fuente
                                   AND tpo_acuerdo = $codigo_acuerdo";

    $query_suma_traslados_fuente=$this->cnxion->ejecutar($sql_suma_traslados_fuente);

    $num_filas = $this->cnxion->numero_filas($query_suma_traslados_fuente);

    $sum_traslado = 0;
    if($num_filas > 0){
      while($data_suma_traslados_fuente=$this->cnxion->obtener_filas($query_suma_traslados_fuente)){
        $sum_traslado = $sum_traslado + $data_suma_traslados_fuente['tpo_valor'];
      }
    }
    return $sum_traslado;
  }

  public function sum_fuente_plan_acuerdo($codigo_plan, $codigo_fuente, $vigencia_fuente, $codigo_calendario, $codigo_acuerdo){

    $sql_sum_fuente_plan_acuerdo="SELECT poav_codigo AS codigo_recurso, poav_recurso AS valor_fuente_vigencia
                                    FROM plandesarrollo.accion
                                    INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                                    INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                                    INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                    INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                    WHERE poav_estado = 1
                                      AND ffi_clasificacion = 3
                                      AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                      AND poav_fuentefinanciacion = $codigo_fuente
                                      AND poav_vigencia = $codigo_calendario
                                      AND poav_vigencia = $vigencia_fuente
                                      AND poav_acuerdo = $codigo_acuerdo
                                    UNION
                                  SELECT apoai_codigo AS codigo_recurso, apoai_valor AS valor_fuente_vigencia
                                    FROM plandesarrollo.accion
                                    INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                                    INNER JOIN planaccion.adicion_poai ON poav_codigo = apoai_poai
                                    INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                                    INNER JOIN planaccion.fuente_financiacion ON sff_fuente = ffi_codigo
                                    INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                    INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                  WHERE poav_estado = 1
                                    AND ffi_clasificacion = 3
                                    AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                    AND poav_vigencia = $codigo_calendario
                                    AND sff_fuente = $codigo_fuente
                                    AND sff_vigencia = $vigencia_fuente
                                    AND sff_acto = $codigo_acuerdo";

    $query_sum_fuente_plan_acuerdo=$this->cnxion->ejecutar($sql_sum_fuente_plan_acuerdo);

    $num_sldo = $this->cnxion->numero_filas($query_sum_fuente_plan_acuerdo);

    $total_fuente = 0;
    if($num_sldo > 0){
      while($data_sum_fuente_plan_acuerdo = $this->cnxion->obtener_filas($query_sum_fuente_plan_acuerdo)){
        $codigo_recurso = $data_sum_fuente_plan_acuerdo['codigo_recurso'];
        $valor_fuente_vigencia = $data_sum_fuente_plan_acuerdo['valor_fuente_vigencia'];

        $restar_trasladado = $this->restar_trasladado($codigo_recurso);

        $sub_total = $valor_fuente_vigencia - $restar_trasladado;

        $total_fuente = $total_fuente + $sub_total;
      }
    }
    $suma_traslados_fuente = $this->suma_traslados_fuente($codigo_plan, $codigo_fuente, $vigencia_fuente, $codigo_calendario, $codigo_acuerdo);
    $total_fuente = $total_fuente + $suma_traslados_fuente;
    return $total_fuente;
  }

  public function suma_traslados_subistema($codigo_plan, $codigo_subsistema, $codigo_calendario, $codigo_fuente, $vigencia_fuente, $codigo_acuerdo){

    $sql_suma_traslados_subistema="SELECT tpo_codigo, tpo_valor
                                      FROM planaccion.traslados_poai
                                      INNER JOIN planaccion.poai_veinte_veintidos ON tpo_codigorecuerso = poav_codigo
                                      INNER JOIN plandesarrollo.accion ON acc_codigo = tpo_accion
                                      INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                                      INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                      INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                      WHERE tpo_estado = 1
                                        AND ffi_clasificacion = 3
                                        AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                        AND plandesarrollo.subsistema.sub_codigo = $codigo_subsistema
                                        AND poav_vigencia = $codigo_calendario
                                        AND poav_fuentefinanciacion = $codigo_fuente
                                        AND poav_vigencia = $vigencia_fuente
                                        AND tpo_acuerdo = $codigo_acuerdo
                                      UNION
                                    SELECT tpo_codigo, tpo_valor
                                      FROM planaccion.traslados_poai
                                      INNER JOIN planaccion.poai_veinte_veintidos ON tpo_poai = poav_codigo
                                      INNER JOIN planaccion.adicion_poai ON tpo_codigorecuerso = apoai_codigo
                                      INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                                      INNER JOIN plandesarrollo.accion ON acc_codigo = tpo_accion
                                      INNER JOIN planaccion.fuente_financiacion ON sff_fuente = ffi_codigo
                                      INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                      INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                      WHERE tpo_estado = 1
                                        AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                        AND plandesarrollo.subsistema.sub_codigo = $codigo_subsistema
                                        AND poav_vigencia = $codigo_calendario
                                        AND sff_fuente = $codigo_fuente
                                        AND tpo_acuerdo = $codigo_acuerdo";

    $query_suma_traslados_subistema=$this->cnxion->ejecutar($sql_suma_traslados_subistema);

    $num_filas = $this->cnxion->numero_filas($query_suma_traslados_subistema);

    $sum_traslado = 0;
    if($num_filas > 0){
      while($data_suma_traslados_subistema=$this->cnxion->obtener_filas($query_suma_traslados_subistema)){
        $sum_traslado = $sum_traslado + $data_suma_traslados_subistema['tpo_valor'];
      }
    }
    return $sum_traslado;
  }

  public function sum_fuente_subsistema($codigo_plan, $codigo_subsistema, $codigo_calendario, $codigo_fuente, $vigencia_fuente, $codigo_acuerdo){

    $sql_sum_fuente_subsistema="SELECT poav_codigo AS codigo_recurso, poav_recurso AS valor_recurso
                                  FROM plandesarrollo.accion
                                INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                                INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                                INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                WHERE poav_estado = 1
                                  AND ffi_clasificacion = 3
                                  AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                  AND plandesarrollo.subsistema.sub_codigo = $codigo_subsistema
                                  AND poav_vigencia = $codigo_calendario
                                  AND poav_fuentefinanciacion = $codigo_fuente
                                  AND poav_vigencia = $vigencia_fuente
                                  AND poav_acuerdo = $codigo_acuerdo
                                UNION
                                SELECT apoai_codigo AS codigo_recurso, apoai_valor AS valor_recurso
                                  FROM plandesarrollo.accion
                                INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                                INNER JOIN planaccion.adicion_poai ON poav_codigo = apoai_poai
                                INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                                INNER JOIN planaccion.fuente_financiacion ON sff_fuente = ffi_codigo
                                INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                WHERE poav_estado = 1
                                  AND apoai_estado = 1
                                  AND ffi_clasificacion = 3
                                  AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                  AND plandesarrollo.subsistema.sub_codigo = $codigo_subsistema
                                  AND poav_vigencia = $codigo_calendario
                                  AND sff_fuente = $codigo_fuente
                                  AND sff_vigencia = $vigencia_fuente
                                  AND sff_acto = $codigo_acuerdo";

    $query_sum_fuente_subsistema=$this->cnxion->ejecutar($sql_sum_fuente_subsistema);

    while($data_sum_fuente_subsistema= $this->cnxion->obtener_filas($query_sum_fuente_subsistema)){
      $datasum_fuente_subsistema[] = $data_sum_fuente_subsistema;
    }
    return $datasum_fuente_subsistema;
  }

  public function suma_poai_subsistema($codigo_plan, $codigo_subsistema, $codigo_calendario, $codigo_fuente, $vigencia_fuente, $codigo_acuerdo){
   
    $sub_valor = 0;
    $valor_subsistema_fuente = 0;
    $sum_fuente_subsistema = $this->sum_fuente_subsistema($codigo_plan, $codigo_subsistema, $codigo_calendario, $codigo_fuente, $vigencia_fuente, $codigo_acuerdo);
    if($sum_fuente_subsistema){
      foreach ($sum_fuente_subsistema as $dat_plan_fuente) {
        $codigo_recurso = $dat_plan_fuente['codigo_recurso'];
        $valor_recurso = $dat_plan_fuente['valor_recurso'];

        $sub_valor = $sub_valor + $valor_recurso;

      }
    }
    $suma_traslados_subistema = $this->suma_traslados_subistema($codigo_plan, $codigo_subsistema, $codigo_calendario, $codigo_fuente, $vigencia_fuente, $codigo_acuerdo);
    $valor_subsistema_fuente = $sub_valor + $suma_traslados_subistema;

    return $valor_subsistema_fuente;
  }

}
?>