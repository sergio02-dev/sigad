<?php
  Class rprtePoai{
    
    public function __construct(){
      $this->cnxion = Dtbs::getInstance();
    } 

    public function list_subsistema($codigo_plan){

      $sql_list_subsistema="SELECT sub_codigo, sub_nombre, res_codigo, 
                                  sub_referencia, sub_ref, UPPER(pde_niveluno) as nivel_uno
                            FROM plandesarrollo.subsistema
                            INNER JOIN plandesarrollo.plan_desarrollo ON plandesarrollo.plan_desarrollo.pde_codigo = plandesarrollo.subsistema.pde_codigo
                            WHERE plandesarrollo.plan_desarrollo.pde_codigo = $codigo_plan
                            ORDER BY sub_nombre ASC;";

      $query_list_subsistema=$this->cnxion->ejecutar($sql_list_subsistema);

      while($data_list_subsistema=$this->cnxion->obtener_filas($query_list_subsistema)){
        $datalist_subsistema[]=$data_list_subsistema;
      }
      return $datalist_subsistema;
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

    public function list_fuente_financiacion($codigo_plan, $vigencia){

      $sql_list_fuente_financiacion="SELECT DISTINCT ffi_clasificacion, ffi_nombre, ffi_codigo, poav_vigencia AS vigencia_fuente
                                        FROM plandesarrollo.accion
                                      INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                                      INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                                      INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                      INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                      WHERE plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                        AND poav_estado = 1
                                        AND ffi_clasificacion = 3
                                        AND poav_vigencia = $vigencia
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
                                        AND poav_estado = 1
                                        AND ffi_clasificacion = 3
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
                          FROM principal.sedes
                        INNER JOIN plandesarrollo.indicador ON sed_codigo = ind_sede
                        INNER JOIN plandesarrollo.accion ON ind_accion = acc_codigo
                        INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                        INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                        WHERE ind_estado = '1'
                          AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
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

    public function suma_accion_traslado($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador, $vigencia_poai){

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
                                    AND poav_vigencia = $vigencia_poai";

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

    public function valor_poai($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador, $vigencia_poai){

      $sql_valor_poai="SELECT poav_codigo AS codigo_recurso, poav_recurso AS recursos
                        FROM planaccion.poai_veinte_veintidos
                        WHERE poav_estado = 1
                          AND poav_vigencia = $vigencia_poai
                          AND poav_vigencia = $codigo_calendario
                          AND poav_accion = $codigo_accion
                          AND poav_fuentefinanciacion = $fuente_financiacion
                          AND poav_indicador = $indicador
                        UNION 
                        SELECT apoai_codigo AS codigo_recurso, apoai_valor AS recursos
                          FROM planaccion.poai_veinte_veintidos
                        INNER JOIN planaccion.adicion_poai ON poav_codigo = apoai_poai
                        INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                        WHERE apoai_estado = 1
                          AND poav_estado = 1
                          AND poav_vigencia = $vigencia_poai
                          AND sff_vigencia = $codigo_calendario
                          AND poav_accion = $codigo_accion
                          AND sff_fuente = $fuente_financiacion
                          AND poav_indicador = $indicador;";

      $query_valor_poai=$this->cnxion->ejecutar($sql_valor_poai);

      $num_filas = $this->cnxion->numero_filas($query_valor_poai);

      $sum_rec = 0;
      if($num_filas > 0){
        while($data_valor_poai=$this->cnxion->obtener_filas($query_valor_poai)){
          $codigo_recurso = $data_valor_poai['codigo_recurso'];

          $restar_trasladado = $this->restar_trasladado($codigo_recurso);

          $sub_valor = $data_valor_poai['recursos'] - $restar_trasladado;
          $sum_rec = $sum_rec + $sub_valor;
        }
        
      }
      $suma_accion_traslado = $this->suma_accion_traslado($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador, $vigencia_poai);
      $sum_rec = $sum_rec + $suma_accion_traslado;
      
      return $sum_rec;
    }  

    public function suma_traslados_subistema($codigo_plan, $codigo_subsistema, $codigo_calendario, $codigo_fuente, $vigencia_fuente){

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
                                          AND sff_fuente = $codigo_fuente";

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

    public function suma_traslados_fuente($codigo_plan, $codigo_fuente, $vigencia_fuente, $codigo_calendario){

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
                                    AND sff_vigencia = $vigencia_fuente";

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

    public function sum_fuente_plan($codigo_plan, $codigo_fuente, $vigencia_fuente, $codigo_calendario){

      $sql_sum_fuente_plan="SELECT poav_codigo AS codigo_recurso, poav_recurso AS valor_recurso
                              FROM plandesarrollo.accion
                            INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                            INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                            INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                            INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                            WHERE poav_estado = 1
                              AND ffi_clasificacion = 3
                              AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                              AND poav_vigencia = $codigo_calendario
                              AND poav_fuentefinanciacion = $codigo_fuente
                              AND poav_vigencia = $vigencia_fuente
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
                              AND poav_vigencia = $codigo_calendario
                              AND sff_fuente = $codigo_fuente
                              AND sff_vigencia = $vigencia_fuente";

      $query_sum_fuente_plan=$this->cnxion->ejecutar($sql_sum_fuente_plan);

      $num_filas = $this->cnxion->numero_filas($query_sum_fuente_plan);
      $valor_suma = 0;
      if($num_filas>0){
        while($data_sum_fuente_plan = $this->cnxion->obtener_filas($query_sum_fuente_plan)){
          $codigo_recurso = $data_sum_fuente_plan['codigo_recurso'];
          $valor_recurso = $data_sum_fuente_plan['valor_recurso'];

          $restar_trasladado = $this->restar_trasladado($codigo_recurso);

          $sub_total = $valor_recurso - $restar_trasladado;

          $valor_suma = $valor_suma + $sub_total;
        }
      }
      $suma_traslados_fuente = $this->suma_traslados_fuente($codigo_plan, $codigo_fuente, $vigencia_fuente, $codigo_calendario);
      $valormostrar = $valor_suma + $suma_traslados_fuente;
      return $valormostrar;
    }

    public function sum_fuente_subsistema($codigo_plan, $codigo_subsistema, $codigo_calendario, $codigo_fuente, $vigencia_fuente){

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
                                    AND sff_vigencia = $vigencia_fuente";

      $query_sum_fuente_subsistema=$this->cnxion->ejecutar($sql_sum_fuente_subsistema);

      while($data_sum_fuente_subsistema= $this->cnxion->obtener_filas($query_sum_fuente_subsistema)){
        $datasum_fuente_subsistema[] = $data_sum_fuente_subsistema;
      }
      return $datasum_fuente_subsistema;
    }

    public function suma_poai_subsistema($codigo_plan, $codigo_subsistema, $codigo_calendario, $codigo_fuente, $vigencia_fuente){
    
      $sub_valor = 0;
      $valor_subsistema_fuente = 0;
      $sum_fuente_subsistema = $this->sum_fuente_subsistema($codigo_plan, $codigo_subsistema, $codigo_calendario, $codigo_fuente, $vigencia_fuente);
      if($sum_fuente_subsistema){
        foreach ($sum_fuente_subsistema as $dat_plan_fuente) {
          $codigo_recurso = $dat_plan_fuente['codigo_recurso'];
          $valor_recurso = $dat_plan_fuente['valor_recurso'];

          $sub_valor = $sub_valor + $valor_recurso;
        }
      }
      $suma_traslados_subistema = $this->suma_traslados_subistema($codigo_plan, $codigo_subsistema, $codigo_calendario, $codigo_fuente, $vigencia_fuente);
      $valor_subsistema_fuente = $sub_valor + $suma_traslados_subistema;

      return $valor_subsistema_fuente;
    }

    public function trslddo_de($codigo_recurso){

      $sql_trslddo_de="SELECT poav_codigo AS codigo_recurso, 
                              poav_recurso AS valor_recurso, 
                              poav_vigencia AS codigo_vigencia, 
                              poav_fuentefinanciacion AS codigo_fuente, 
                              poav_indicador AS codigo_indicador,
                              poav_accion AS codigo_accion, 
                              poav_vigencia AS vigencia_poai
                         FROM planaccion.poai_veinte_veintidos
                        WHERE poav_codigo = $codigo_recurso 
                      UNION   
                      SELECT apoai_codigo AS codigo_recurso, 
                              apoai_valor AS valor_recurso,
                              sff_vigencia AS codigo_vigencia, 
                              sff_fuente AS codigo_fuente,
                              poav_indicador AS codigo_indicador,
                              poav_accion AS codigo_accion,
                              poav_vigencia AS vigencia_poai
                        FROM planaccion.poai_veinte_veintidos
                      INNER JOIN planaccion.adicion_poai ON poav_codigo = apoai_poai
                      INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                      WHERE apoai_estado = 1
                        AND apoai_codigo = $codigo_recurso;";

      $query_trslddo_de=$this->cnxion->ejecutar($sql_trslddo_de);

      while($data_trslddo_de=$this->cnxion->obtener_filas($query_trslddo_de)){
        $datatrslddo_de[]=$data_trslddo_de;
      }
      return $datatrslddo_de;
    }

    public function traslados_plan($codigo_plan){

      $sql_traslados_plan="SELECT tpo_codigo, tpo_poai, tpo_accion, 
                                  tpo_codigorecuerso, tpo_valor, 
                                  tpo_acuerdo, tpo_sede, 
                                  tpo_indicador, tpo_estado, 
                                  acc_referencia, acc_numero,
                                  acc_descripcion
                            FROM planaccion.traslados_poai
                            INNER JOIN plandesarrollo.accion ON tpo_accion = acc_codigo
                            INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                            INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                            WHERE tpo_estado = 1
                              AND pde_codigo = $codigo_plan";

      $query_traslados_plan=$this->cnxion->ejecutar($sql_traslados_plan);

      while($data_traslados_plan= $this->cnxion->obtener_filas($query_traslados_plan)){
        $datatraslados_plan[] = $data_traslados_plan;
      }
      return $datatraslados_plan;
    }

    public function sede_indicador($codigo_indicador){

      $sql_sede_indicador="SELECT ind_codigo, ind_unidadmedida,  
                                  ind_sede, sed_nombre
                             FROM plandesarrollo.indicador
                            INNER JOIN principal.sedes ON ind_sede = sed_codigo
                            WHERE ind_codigo = $codigo_indicador;";

      $query_sede_indicador=$this->cnxion->ejecutar($sql_sede_indicador);

      $data_sede_indicador=$this->cnxion->obtener_filas($query_sede_indicador);

      $ind_unidadmedida = $data_sede_indicador['ind_unidadmedida'];
      $sed_nombre = $data_sede_indicador['sed_nombre'];

      return array($sed_nombre, $ind_unidadmedida);
    }

    public function accion_descripcion($codigo_accion){

      $sql_accion_descripcion="SELECT acc_codigo, acc_referencia, 
                                      acc_descripcion, acc_numero
                                 FROM plandesarrollo.accion
                                WHERE acc_codigo = $codigo_accion;";

      $query_accion_descripcion=$this->cnxion->ejecutar($sql_accion_descripcion);

      $data_accion_descripcion=$this->cnxion->obtener_filas($query_accion_descripcion);

      $acc_referencia = $data_accion_descripcion['acc_referencia'];
      $acc_numero = $data_accion_descripcion['acc_numero'];
      $acc_descripcion = $data_accion_descripcion['acc_descripcion'];

      $desc = $acc_referencia.".".$acc_numero." ".$acc_descripcion;

      return $desc;
    }

    public function nombre_fuente($codigo_fuente){

      $sql_nombre_fuente="SELECT ffi_codigo, ffi_nombre, ffi_descripcion
                            FROM planaccion.fuente_financiacion
                           WHERE ffi_codigo = $codigo_fuente;";

      $query_nombre_fuente=$this->cnxion->ejecutar($sql_nombre_fuente);

      $data_nombre_fuente=$this->cnxion->obtener_filas($query_nombre_fuente);

      $ffi_nombre = $data_nombre_fuente['ffi_nombre'];

      return  str_replace('INV -','',$ffi_nombre);
    }

    public function lista_traslados_plan($codigo_plan){
      $array_datos = array();
      $list_trsldos = $this->traslados_plan($codigo_plan);
      if($list_trsldos){
        foreach ($list_trsldos as $dat_trsldos) {
          $tpo_codigo = $dat_trsldos['tpo_codigo'];
          $tpo_poai = $dat_trsldos['tpo_poai'];
          $tpo_codigorecuerso = $dat_trsldos['tpo_codigorecuerso'];
          $tpo_valor = $dat_trsldos['tpo_valor'];
          $tpo_indicador = $dat_trsldos['tpo_indicador'];
          $tpo_accion = $dat_trsldos['tpo_accion'];

          $accion_a = $this->accion_descripcion($tpo_accion);
          list($sede_a, $indicador_a) = $this->sede_indicador($tpo_indicador);

          $list_traslddo_de = $this->trslddo_de($tpo_codigorecuerso);
          if($list_traslddo_de){
            foreach ($list_traslddo_de as $dat_trsladdo_de) {
              $codigo_recurso = $dat_trsladdo_de['codigo_recurso'];
              $valor_recurso = $dat_trsladdo_de['valor_recurso'];
              $codigo_vigencia = $dat_trsladdo_de['codigo_vigencia'];
              $codigo_fuente = $dat_trsladdo_de['codigo_fuente'];
              $codigo_indicador = $dat_trsladdo_de['codigo_indicador'];
              $codigo_accion = $dat_trsladdo_de['codigo_accion'];

              $accion_de = $this->accion_descripcion($codigo_accion);
              list($sede_de, $indicador_de) = $this->sede_indicador($codigo_indicador);   
              $nmbre_fuente = $this->nombre_fuente($codigo_fuente);
            }

            $array_datos[] = array('accion_a'=> $accion_a,
                                   'sede_a'=> $sede_a,
                                   'indicador_a'=> $indicador_a,
                                   'accion_de'=> $accion_de,
                                   'sede_de'=> $sede_de,
                                   'indicador_de'=> $indicador_de,
                                   'nombre_fuente'=> $nmbre_fuente." ".$codigo_vigencia,
                                   'valor'=> $tpo_valor
                                  );
          }
        }
      }
      return $array_datos;
    }



  }
?>