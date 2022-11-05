<?php
Class rprtePoai{
   
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

    public function list_fuente_financiacion($codigo_plan){

        $sql_list_fuente_financiacion="SELECT DISTINCT ffi_clasificacion, ffi_nombre, ffi_codigo
                                         FROM plandesarrollo.accion,
                                              plandesarrollo.proyecto,
                                              plandesarrollo.subsistema,
                                              planaccion.poai_veinte_veintidos,
                                              planaccion.fuente_financiacion,
                                              principal.sedes
                                        WHERE acc_proyecto = pro_codigo
                                          AND plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                          AND acc_codigo = poav_accion
                                          AND poav_fuentefinanciacion = ffi_codigo
                                          AND poav_sede = sed_codigo
                                          AND plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                          AND poav_estado = 1
                                          AND ffi_clasificacion = 3
                                         ORDER BY ffi_clasificacion, ffi_nombre";

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
                                acc_codigo, acc_numero ASC; ";

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

    public function suma_adicion($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador){

        $sql_suma_adicion="SELECT SUM(apoai_valor) AS adicion
                             FROM planaccion.poai_veinte_veintidos,
                                  planaccion.adicion_poai
                            WHERE poav_codigo = apoai_poai
                              AND apoai_estado = 1
                              AND poav_estado = 1
                              AND poav_vigencia = $codigo_calendario
                              AND poav_accion = $codigo_accion
                              AND poav_fuentefinanciacion = $fuente_financiacion
                              AND poav_indicador = $indicador;";

        $query_suma_adicion = $this->cnxion->ejecutar($sql_suma_adicion);

        $data_suma_adicion = $this->cnxion->obtener_filas($query_suma_adicion);

        $adicion = $data_suma_adicion['adicion'];

        if($adicion){
            $valor_adicion = $adicion;
        }
        else{
            $valor_adicion = 0;
        }
        return $valor_adicion;
    }

    public function valor_poai($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador){

        $sql_valor_poai="SELECT SUM(poav_recurso) AS recursos
                           FROM planaccion.poai_veinte_veintidos
                          WHERE poav_estado = 1
                            AND poav_vigencia = $codigo_calendario
                            AND poav_accion = $codigo_accion
                            AND poav_fuentefinanciacion = $fuente_financiacion
                            AND poav_indicador = $indicador;";

        $query_valor_poai=$this->cnxion->ejecutar($sql_valor_poai);

        $data_valor_poai=$this->cnxion->obtener_filas($query_valor_poai);

        $recursos = $data_valor_poai['recursos'];

        if($recursos){
            $sum_rec = $recursos;
        }
        else{
            $sum_rec = 0;
        }
        return $sum_rec;
    }

    public function totalizado_poai($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador){

        $valor_normal = $this->valor_poai($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador);

        $adiciones = $this->suma_adicion($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador);

        $valor_total = $valor_normal + $adiciones;
       
        return $valor_total;
    }

    public function suma_adicin_acuerdo($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador, $acuerdo){

        $sql_suma_adicin_acuerdo="SELECT SUM(apoai_valor) AS adicion
                             FROM planaccion.poai_veinte_veintidos,
                                  planaccion.adicion_poai,
                                  planaccion.saldos_fuente_financiacion
                            WHERE poav_codigo = apoai_poai
                              AND apoai_saldo = sff_codigo
                              AND apoai_estado = 1
                              AND poav_estado = 1
                              AND poav_vigencia = $codigo_calendario
                              AND poav_accion = $codigo_accion
                              AND poav_fuentefinanciacion = $fuente_financiacion
                              AND poav_indicador = $indicador
                              AND sff_acto = $acuerdo;";

        $query_suma_adicin_acuerdo = $this->cnxion->ejecutar($sql_suma_adicin_acuerdo);

        $data_suma_adicin_acuerdo = $this->cnxion->obtener_filas($query_suma_adicin_acuerdo);

        $adicion = $data_suma_adicin_acuerdo['adicion'];

        if($adicion){
            $valor_adicion = $adicion;
        }
        else{
            $valor_adicion = 0;
        }
        return $valor_adicion;
    }

    public function valor_poai_acuerdo($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador, $acuerdo){

        $sql_valor_poai_acuerdo="SELECT SUM(poav_recurso) AS recursos
                           FROM planaccion.poai_veinte_veintidos
                          WHERE poav_estado = 1
                            AND poav_vigencia = $codigo_calendario
                            AND poav_accion = $codigo_accion
                            AND poav_fuentefinanciacion = $fuente_financiacion
                            AND poav_indicador = $indicador
                            AND poav_acuerdo = $acuerdo;";

        $query_valor_poai_acuerdo=$this->cnxion->ejecutar($sql_valor_poai_acuerdo);

        $data_valor_poai_acuerdo=$this->cnxion->obtener_filas($query_valor_poai_acuerdo);

        $recursos = $data_valor_poai_acuerdo['recursos'];

        if($recursos){
            $sum_rec = $recursos;
        }
        else{
            $sum_rec = 0;
        }
        return $sum_rec;
    }

    public function totalizado_poai_acuerdo($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador, $acuerdo){

        $valor_normal = $this->valor_poai_acuerdo($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador, $acuerdo);

        $adiciones = $this->suma_adicin_acuerdo($codigo_calendario, $codigo_accion, $fuente_financiacion, $indicador, $acuerdo);

        $valor_total = $valor_normal + $adiciones;
       
        return $valor_total;
    }


    public function sub_valor_poai($codigo_calendario, $fuente_financiacion){

        $sql_sub_valor_poai="SELECT SUM(poav_recurso) AS recursos
                               FROM planaccion.poai_veinte_veintidos
                              WHERE poav_estado = 1
                                AND poav_vigencia = $codigo_calendario
                                AND poav_fuentefinanciacion = $fuente_financiacion;";

        $query_sub_valor_poai=$this->cnxion->ejecutar($sql_sub_valor_poai);

        $data_sub_valor_poai=$this->cnxion->obtener_filas($query_sub_valor_poai);

        $recursos = $data_sub_valor_poai['recursos'];

        if($recursos){
            $sum_rec = $recursos;
        }
        else{
            $sum_rec = 0;
        }
        return $sum_rec;
    }

    public function adicion_fuente($codigo_calendario, $fuente_financiacion){

        $sql_adicion_fuente="SELECT SUM(apoai_valor) AS add_fuent
                               FROM planaccion.poai_veinte_veintidos,
                                    planaccion.adicion_poai
                              WHERE poav_codigo = apoai_poai
                                AND apoai_estado = 1
                                AND poav_estado = 1
                                AND poav_vigencia = $codigo_calendario
                                AND poav_fuentefinanciacion = $fuente_financiacion;";

        $query_adicion_fuente=$this->cnxion->ejecutar($sql_adicion_fuente);

        $data_adicion_fuente=$this->cnxion->obtener_filas($query_adicion_fuente);

        $add_fuent = $data_adicion_fuente['add_fuent'];

        if($add_fuent){
            $sum_fuente = $add_fuent;
        }
        else{
            $sum_fuente = 0;
        }
        return $sum_fuente;
    }

    public function totalizado_fuente_poai($codigo_calendario, $fuente_financiacion){

        $sub_valor_poai = $this->sub_valor_poai($codigo_calendario, $fuente_financiacion);

        $adicion_fuente = $this->adicion_fuente($codigo_calendario, $fuente_financiacion);

        $valor_fuente_total = $sub_valor_poai + $adicion_fuente;
       
        return $valor_fuente_total;
    }


    public function sub_valor_poai_acuerdo($codigo_calendario, $fuente_financiacion, $acuerdo){

        $sql_sub_valor_poai_acuerdo="SELECT SUM(poav_recurso) AS recursos
                               FROM planaccion.poai_veinte_veintidos
                              WHERE poav_estado = 1
                                AND poav_vigencia = $codigo_calendario
                                AND poav_fuentefinanciacion = $fuente_financiacion
                                AND poav_acuerdo = $acuerdo;";

        $query_sub_valor_poai_acuerdo=$this->cnxion->ejecutar($sql_sub_valor_poai_acuerdo);

        $data_sub_valor_poai_acuerdo=$this->cnxion->obtener_filas($query_sub_valor_poai_acuerdo);

        $recursos = $data_sub_valor_poai_acuerdo['recursos'];

        if($recursos){
            $sum_rec = $recursos;
        }
        else{
            $sum_rec = 0;
        }
        return $sum_rec;
    }

    public function adicion_fuente_acuerdo($codigo_calendario, $fuente_financiacion, $acuerdo){

        $sql_adicion_fuente_acuerdo="SELECT SUM(apoai_valor) AS add_fuent
                               FROM planaccion.poai_veinte_veintidos,
                                    planaccion.adicion_poai,
                                    planaccion.saldos_fuente_financiacion
                              WHERE poav_codigo = apoai_poai
                                AND apoai_saldo = sff_codigo
                                AND apoai_estado = 1
                                AND poav_estado = 1
                                AND poav_vigencia = $codigo_calendario
                                AND poav_fuentefinanciacion = $fuente_financiacion
                                AND sff_acto = $acuerdo;";

        $query_adicion_fuente_acuerdo=$this->cnxion->ejecutar($sql_adicion_fuente_acuerdo);

        $data_adicion_fuente_acuerdo=$this->cnxion->obtener_filas($query_adicion_fuente_acuerdo);

        $add_fuent = $data_adicion_fuente_acuerdo['add_fuent'];

        if($add_fuent){
            $sum_fuente = $add_fuent;
        }
        else{
            $sum_fuente = 0;
        }
        return $sum_fuente;
    }

    public function totalizado_fuente_poai_acuerdo($codigo_calendario, $fuente_financiacion, $acuerdo){

        $sub_valor_poai = $this->sub_valor_poai_acuerdo($codigo_calendario, $fuente_financiacion, $acuerdo);

        $adicion_fuente = $this->adicion_fuente_acuerdo($codigo_calendario, $fuente_financiacion, $acuerdo);

        $valor_fuente_total = $sub_valor_poai + $adicion_fuente;
       
        return $valor_fuente_total;
    }




}
?>