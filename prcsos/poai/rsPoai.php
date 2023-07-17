<?php
include('classPoai.php');
Class RsPOAI extends POAI{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function acuerdo_list_poai($codigo_plan, $codigo_calendario){

        $sql_acuerdo_list_poai="SELECT DISTINCT poav_acuerdo as acuerdo, add_fechacreo
                                  FROM plandesarrollo.accion
                                 INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                 INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                 INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                                 INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                                 INNER JOIN principal.sedes ON poav_sede = sed_codigo
                                 INNER JOIN plandesarrollo.acto_administrativo ON poav_acuerdo = aad_codigo
                                 WHERE plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                   AND poav_vigencia = $codigo_calendario
                                 UNION 
                                SELECT DISTINCT sff_acto as acuerdo, add_fechacreo
                                  FROM plandesarrollo.accion
                                 INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                 INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                 INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                                 INNER JOIN planaccion.adicion_poai ON poav_codigo = apoai_poai
                                 INNER JOIN planaccion.saldos_fuente_financiacion ON apoai_saldo = sff_codigo
                                 INNER JOIN planaccion.fuente_financiacion ON sff_fuente = ffi_codigo
                                 INNER JOIN principal.sedes ON poav_sede = sed_codigo
                                 INNER JOIN plandesarrollo.acto_administrativo ON sff_acto = aad_codigo
                                 WHERE plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                   AND poav_vigencia = $codigo_calendario
                                 UNION 
                                SELECT tpo_acuerdo as acuerdo, add_fechacreo
                                  FROM planaccion.traslados_poai
                                 INNER JOIN planaccion.poai_veinte_veintidos ON tpo_poai = poav_codigo
                                 INNER JOIN plandesarrollo.accion ON tpo_accion = acc_codigo 
                                 INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                 INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                 INNER JOIN plandesarrollo.acto_administrativo ON tpo_acuerdo = aad_codigo
                                 WHERE plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                   AND poav_vigencia = $codigo_calendario
                                 ORDER BY add_fechacreo ASC;";

        $query_acuerdo_list_poai=$this->cnxion->ejecutar($sql_acuerdo_list_poai);

        while($data_acuerdo_list_poai=$this->cnxion->obtener_filas($query_acuerdo_list_poai)){
            $dataacuerdo_list_poai[]=$data_acuerdo_list_poai;
        }
        return $dataacuerdo_list_poai;
    }

    public function acuerdo_poai($codigo_acuerdo){

        $sql_acuerdo_poai="SELECT aad_codigo, add_nombre, add_tipoactoadmin, 
                                  add_urlactoadmin
                             FROM plandesarrollo.acto_administrativo
                            WHERE aad_codigo = $codigo_acuerdo;";

        $query_acuerdo_poai=$this->cnxion->ejecutar($sql_acuerdo_poai);

        $data_acuerdo_poai=$this->cnxion->obtener_filas($query_acuerdo_poai);

        $add_nombre = $data_acuerdo_poai['add_nombre'];

        return $add_nombre;
    }

    public function vigencia_pssai_plan($codigo_plan){

        $sql_vigencia_pssai_plan="SELECT DISTINCT poav_vigencia
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
                                    AND plandesarrollo.subsistema.pde_codigo = $codigo_plan;";

        $query_vigencia_pssai_plan=$this->cnxion->ejecutar($sql_vigencia_pssai_plan);

        while($data_vigencia_pssai_plan=$this->cnxion->obtener_filas($query_vigencia_pssai_plan)){
            $datavigencia_pssai_plan[]=$data_vigencia_pssai_plan;
        }
        return $datavigencia_pssai_plan;
    }

    public function list_poais($codigo_plan){

        $vigencia_pssai_plan = $this->vigencia_pssai_plan($codigo_plan);

        if($vigencia_pssai_plan){
            foreach ($vigencia_pssai_plan as $dta_vgncia) {
                $poav_vigencia = $dta_vgncia['poav_vigencia'];

                $array_poais[] = array('vigencia'=> $poav_vigencia,
                                       'acuerdo'=> 0,
                                       'descripcion'=> 'TODO '.$poav_vigencia);

                $acuerdo_list_poai = $this->acuerdo_list_poai($codigo_plan, $poav_vigencia);
                if($acuerdo_list_poai){
                    foreach ($acuerdo_list_poai as $dta_acuerdos) {
                        $acuerdo = $dta_acuerdos['acuerdo'];

                        $acuerdo_poai = $this->acuerdo_poai($acuerdo);

                        $descrpc = $poav_vigencia." ".$acuerdo_poai;

                        $array_poais[] = array('vigencia'=> $poav_vigencia,
                                               'acuerdo'=> $acuerdo,
                                               'descripcion'=> $descrpc);
                    }
                }
            }
        }
        return $array_poais;
    }

    public function anios_plan($codigo_plan){

        $sql_anios_plan="SELECT pde_codigo, pde_nombre, pde_yearinicio, pde_yearfin
                           FROM plandesarrollo.plan_desarrollo
                          WHERE pde_codigo = $codigo_plan;";

        $query_anios_plan=$this->cnxion->ejecutar($sql_anios_plan);

        $data_anios_plan=$this->cnxion->obtener_filas($query_anios_plan);

        $pde_yearinicio = $data_anios_plan['pde_yearinicio'];
        $pde_yearfin = $data_anios_plan['pde_yearfin'];

        return array($pde_yearinicio, $pde_yearfin);
    }

    public function list_acciones_plan($codigo_plan){

        $sql_list_acciones_plan="SELECT acc_codigo, acc_referencia, 
                                        acc_descripcion, acc_proyecto, 
                                        acc_numero, sub_referencia
                                   FROM plandesarrollo.accion, 
                                        plandesarrollo.proyecto,
                                        plandesarrollo.subsistema
                                  WHERE acc_proyecto = pro_codigo
                                    AND plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                    AND pde_codigo = $codigo_plan
                                  ORDER BY plandesarrollo.proyecto.sub_codigo, pro_numero, acc_numero ASC";

        $query_list_acciones_plan=$this->cnxion->ejecutar($sql_list_acciones_plan);

        while($data_list_acciones_plan=$this->cnxion->obtener_filas($query_list_acciones_plan)){
            $datalist_acciones_plan[]=$data_list_acciones_plan;
        }
        return $datalist_acciones_plan;
    }

    public function nombre_nivel_tres($codigo_plan){

        $sql_nombre_nivel_tres="SELECT pde_codigo, pde_nombre, pde_niveltres
                                  FROM plandesarrollo.plan_desarrollo
                                 WHERE pde_codigo = $codigo_plan;";

        $query_nombre_nivel_tres=$this->cnxion->ejecutar($sql_nombre_nivel_tres);

        $data_nombre_nivel_tres=$this->cnxion->obtener_filas($query_nombre_nivel_tres);

        $pde_niveltres = $data_nombre_nivel_tres['pde_niveltres'];

        return $pde_niveltres;
    }

    public function list_fuente_financiacion(){

        $sql_list_fuente_financiacion="SELECT ffi_codigo, ffi_nombre,  
                                              ffi_clasificacion, ffi_codigolinix, 
                                              ffi_referencialinix, 
                                              ffi_clasificacionplaneacion
                                         FROM planaccion.fuente_financiacion
                                        WHERE ffi_estado = 1
                                          AND ffi_clasificacion = 3
                                        ORDER BY ffi_nombre ASC";

        $query_list_fuente_financiacion=$this->cnxion->ejecutar($sql_list_fuente_financiacion);

        while($data_list_fuente_financiacion=$this->cnxion->obtener_filas($query_list_fuente_financiacion)){
            $datalist_fuente_financiacion[]=$data_list_fuente_financiacion;
        }
        return $datalist_fuente_financiacion;
    }

    public function list_sede(){

        $sql_list_sede="SELECT sed_codigo, sed_nombre, sed_estado
                          FROM principal.sedes
                         WHERE sed_estado = 1
                         ORDER BY sed_nombre ASC;";

        $query_list_sede=$this->cnxion->ejecutar($sql_list_sede);

        while($data_list_sede=$this->cnxion->obtener_filas($query_list_sede)){
            $datalist_sede[]=$data_list_sede;
        }
        return $datalist_sede;
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

        $sql_lista_poai="SELECT acc_codigo, acc_referencia, acc_numero, acc_descripcion, pro_codigo, ffi_codigo, 
                                ffi_nombre, sed_codigo, sed_nombre, poav_estado, poav_recurso, pde_codigo,
                                poav_sede, poav_accion, poav_codigo, poav_vigencia, poav_indicador, poav_acuerdo
                           FROM plandesarrollo.accion
                          INNER JOIN planaccion.poai_veinte_veintidos ON acc_codigo = poav_accion
                          INNER JOIN planaccion.fuente_financiacion ON poav_fuentefinanciacion = ffi_codigo
                          INNER JOIN principal.sedes ON poav_sede = sed_codigo
                          INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                          INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                          WHERE plandesarrollo.subsistema.pde_codigo = $codigo_plan
                          ORDER BY plandesarrollo.proyecto.sub_codigo, 
                                plandesarrollo.proyecto.pro_codigo,
                                plandesarrollo.proyecto.pro_numero,
                                acc_codigo, acc_numero ASC;";

        $query_lista_poai=$this->cnxion->ejecutar($sql_lista_poai);

        while($data_lista_poai=$this->cnxion->obtener_filas($query_lista_poai)){
            $datalista_poai[]=$data_lista_poai;
        }
        return $datalista_poai;
    }

    public function nombre_indicador($codigo_indicador){

        $sql_nombre_indicador="SELECT ind_codigo, ind_unidadmedida
                                 FROM plandesarrollo.indicador
                                WHERE ind_codigo = $codigo_indicador;";

        $query_nombre_indicador=$this->cnxion->ejecutar($sql_nombre_indicador);

        $data_nombre_indicador=$this->cnxion->obtener_filas($query_nombre_indicador);

        $ind_unidadmedida = $data_nombre_indicador['ind_unidadmedida'];

        return $ind_unidadmedida;
    }

    public function adiciones_poai($codigo_poai){

        $sql_adiciones_poai="SELECT SUM(apoai_valor) AS val_adicion
                               FROM planaccion.adicion_poai
                              WHERE apoai_estado = 1
                                AND apoai_poai = $codigo_poai;";

        $query_adiciones_poai=$this->cnxion->ejecutar($sql_adiciones_poai);

        $data_adiciones_poai=$this->cnxion->obtener_filas($query_adiciones_poai);

        $val_adicion = $data_adiciones_poai['val_adicion'];

        if($val_adicion==''){
            $valadicion = 0;
        }
        else{
            $valadicion = $val_adicion;
        }
        return $valadicion;
    }

    public function datos_poai($codigo_poai){

        $sql_datos_poai="SELECT poav_codigo, poav_accion, 
                                poav_fuentefinanciacion, poav_sede, 
                                poav_recurso, poav_estado, 
                                poav_vigencia, poav_indicador, 
                                poav_adicion, poav_acuerdo
                           FROM planaccion.poai_veinte_veintidos
                          WHERE poav_codigo = $codigo_poai;";

        $query_datos_poai=$this->cnxion->ejecutar($sql_datos_poai);

        $data_datos_poai=$this->cnxion->obtener_filas($query_datos_poai);
        
        $poav_accion = $data_datos_poai['poav_accion'];
        $poav_fuentefinanciacion = $data_datos_poai['poav_fuentefinanciacion'];
        $poav_indicador = $data_datos_poai['poav_indicador'];

        return array($poav_accion, $poav_fuentefinanciacion, $poav_indicador);
    }

    public function saldo_poai($codigo_poai){

        $adiciones_poai = $this->adiciones_poai($codigo_poai);

        $sql_saldo_poai="SELECT poav_codigo, poav_recurso
                           FROM planaccion.poai_veinte_veintidos
                          WHERE poav_codigo = $codigo_poai;";

        $query_saldo_poai=$this->cnxion->ejecutar($sql_saldo_poai);

        $data_saldo_poai=$this->cnxion->obtener_filas($query_saldo_poai);
        
        $poav_recurso = $data_saldo_poai['poav_recurso'];

        return $poav_recurso + $adiciones_poai;
    }

    public function total_asignado($codigo_poai){

        list($codigo_accion, $codigo_fuente, $codigo_indicador) = $this->datos_poai($codigo_poai);

        $sql_total_asignado="SELECT SUM(asre_recurso) AS valorasignado
                               FROM planaccion.asignacion_recuersos_etapa
                              WHERE asre_estado = 1
                                AND asre_accion = $codigo_accion
                                AND asre_fuente = $codigo_fuente
                                AND asre_indicador = $codigo_indicador;";

        $query_total_asignado=$this->cnxion->ejecutar($sql_total_asignado);

        $data_total_asignado=$this->cnxion->obtener_filas($query_total_asignado);

        $valorasignado = $data_total_asignado['valorasignado'];

        if($valorasignado){
            $valor_asignado = $valorasignado;
        }
        else{
            $valor_asignado = 0;
        }
        return $valor_asignado;
    }

    public function disponible_poai($codigo_poai){

        $saldo_poai = $this->saldo_poai($codigo_poai);
        $total_asignado = $this->total_asignado($codigo_poai);

        $dsponble = $saldo_poai - $total_asignado;

        return $dsponble;
    }

    public function valor_trasladado($codigo_poai){

        $sql_valor_trasladado="SELECT SUM(tpo_valor) AS valortraslado
                                 FROM planaccion.traslados_poai
                                WHERE tpo_poai = $codigo_poai;";

        $query_valor_trasladado=$this->cnxion->ejecutar($sql_valor_trasladado);

        $data_valor_trasladado=$this->cnxion->obtener_filas($query_valor_trasladado);

        $valortraslado = $data_valor_trasladado['valortraslado'];

        if($valortraslado){
            $valor_traslado = $valortraslado;
        }
        else{
            $valor_traslado = 0;
        }
        return $valor_traslado;
    }

    public function lista_traslados_poai($codigo_plan){

        $sql_lista_traslados_poai="SELECT acc_codigo, acc_referencia, acc_numero, acc_descripcion, pro_codigo, 
                                          tpo_codigo, tpo_poai, sed_codigo, sed_nombre,
                                          tpo_codigorecuerso, tpo_valor, 
                                          tpo_acuerdo, tpo_sede, tpo_indicador, tpo_estado
                                     FROM planaccion.traslados_poai
                                    INNER JOIN principal.sedes ON tpo_sede = sed_codigo
                                    INNER JOIN plandesarrollo.accion ON tpo_accion = acc_codigo
                                    INNER JOIN plandesarrollo.proyecto ON acc_proyecto = pro_codigo
                                    INNER JOIN plandesarrollo.subsistema ON plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                    WHERE plandesarrollo.subsistema.pde_codigo = $codigo_plan
                                    ORDER BY plandesarrollo.proyecto.sub_codigo, 
                                        plandesarrollo.proyecto.pro_codigo,
                                        plandesarrollo.proyecto.pro_numero,
                                        acc_codigo, acc_numero ASC;";

        $query_lista_traslados_poai=$this->cnxion->ejecutar($sql_lista_traslados_poai);

        while($data_lista_traslados_poai=$this->cnxion->obtener_filas($query_lista_traslados_poai)){
            $datalista_traslados_poai[]=$data_lista_traslados_poai;
        }
        return $datalista_traslados_poai;
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
        
        return array($codigo_vigencia, $nombre_fuente);
    }

    public function datListaPoai($codigo_plan){
        
        $rs_poai = $this->lista_poai($codigo_plan);

        if($rs_poai){
            foreach ($rs_poai as $dta_list_poai) {
                $poav_codigo = $dta_list_poai['poav_codigo'];
                $poav_accion = $dta_list_poai['poav_accion'];
                $poav_sede = $dta_list_poai['poav_sede'];
                $poav_recurso = $dta_list_poai['poav_recurso'];
                $poav_estado = $dta_list_poai['poav_estado'];
                $acc_referencia = $dta_list_poai['acc_referencia'];
                $acc_numero = $dta_list_poai['acc_numero'];
                $acc_descripcion = $dta_list_poai['acc_descripcion'];
                $ffi_nombre = $dta_list_poai['ffi_nombre'];
                $sed_nombre = $dta_list_poai['sed_nombre'];
                $pde_codigo = $dta_list_poai['pde_codigo'];
                $poav_vigencia = $dta_list_poai['poav_vigencia'];
                $poav_indicador = $dta_list_poai['poav_indicador'];
                $poav_acuerdo = $dta_list_poai['poav_acuerdo'];

                $disponible_poai = $this->disponible_poai($poav_codigo);

                if($disponible_poai == 0 || $disponible_poai < 0 ){
                    $boton_traslado = "none";
                }
                else{
                    $boton_traslado = "block";
                }

                $adiciones_poai = $this->adiciones_poai($poav_codigo);

                if($poav_acuerdo){
                    $acuerdo_poai = $this->acuerdo_poai($poav_acuerdo);
                }
                else{
                    $acuerdo_poai = "";
                }
                $valor_trasladado = $this->valor_trasladado($poav_codigo);

                $recuersos_poai = ($poav_recurso + $adiciones_poai - $valor_trasladado);

                if($poav_indicador){
                    $nombre_indicador = $this->nombre_indicador($poav_indicador);
                }
                else{
                    $nombre_indicador = "";
                }

                $referencia = $acc_referencia.".".$acc_numero;

                if($poav_estado == 1){
                    $estado = "Activo";
                }

                if($poav_estado == 0){
                    $estado = "Inactivo";
                }
    
                $rsDatosPoai[] = array('poav_codigo'=> $poav_codigo, 
                                       'pde_codigo'=> $pde_codigo, 
                                       'referencia'=> $referencia,
                                       'descripcion'=> $acc_descripcion,
                                       'estado'=> $estado,
                                       'recursos'=> "$ ".number_format($recuersos_poai,0,'','.'),
                                       'nombre_sede'=> $sed_nombre,
                                       'nombre_fuente'=>$ffi_nombre,
                                       'poav_vigencia'=> $poav_vigencia,
                                       'nombre_indicador'=> $nombre_indicador,
                                       'acuerdo_poai'=> $acuerdo_poai,
                                       'boton_traslado'=> $boton_traslado,
                                       'tipo'=> 1,
                                       'codigo_traslado'=> 0,
                                    );
    
            }
            $lista_traslados_poai = $this->lista_traslados_poai($codigo_plan);
            if($lista_traslados_poai){
                foreach ($lista_traslados_poai as $dat_traslados){
                    $acc_codigo = $dat_traslados['acc_codigo'];
                    $acc_referencia = $dat_traslados['acc_referencia'];
                    $acc_numero = $dat_traslados['acc_numero'];
                    $acc_descripcion = $dat_traslados['acc_descripcion'];
                    $pro_codigo = $dat_traslados['pro_codigo']; 
                    $tpo_codigo = $dat_traslados['tpo_codigo'];
                    $tpo_poai = $dat_traslados['tpo_poai'];
                    $sed_codigo = $dat_traslados['sed_codigo'];
                    $sed_nombre = $dat_traslados['sed_nombre'];
                    $tpo_codigorecuerso = $dat_traslados['tpo_codigorecuerso'];
                    $tpo_valor = $dat_traslados['tpo_valor'];
                    $tpo_acuerdo = $dat_traslados['tpo_acuerdo'];
                    $tpo_sede = $dat_traslados['tpo_sede'];
                    $tpo_indicador = $dat_traslados['tpo_indicador'];
                    $tpo_estado = $dat_traslados['tpo_estado'];

                    $referencia = $acc_referencia.".".$acc_numero;

                    if($tpo_estado == 1){
                        $estado = "Activo";
                    }

                    if($tpo_estado == 0){
                        $estado = "Inactivo";
                    }
                    
                    list($vigencia_recurso, $nombre_fuente) = $this->fuente_vigencia($tpo_codigorecuerso);

                    $nombre_indicador = $this->nombre_indicador($tpo_indicador);

                    $acuerdo_poai = $this->acuerdo_poai($tpo_acuerdo);

                    $rsDatosPoai[] = array('poav_codigo'=> $tpo_codigo, 
                                           'pde_codigo'=> $codigo_plan, 
                                           'referencia'=> $referencia,
                                           'descripcion'=> $acc_descripcion,
                                           'estado'=> $estado,
                                           'recursos'=> "$ ".number_format($tpo_valor,0,'','.'),
                                           'nombre_sede'=> $sed_nombre,
                                           'nombre_fuente'=> $nombre_fuente,
                                           'poav_vigencia'=> $vigencia_recurso,
                                           'nombre_indicador'=> $nombre_indicador,
                                           'acuerdo_poai'=> $acuerdo_poai,
                                           'boton_traslado'=> $boton_traslado,
                                           'tipo'=> 2,
                                           'codigo_traslado'=> $tpo_poai,
                                        );
                }

            }
            $datDatosPoai=json_encode(array("data"=>$rsDatosPoai));
        }
        else{
            $datDatosPoai=json_encode(array("data"=>""));
        } 
        return $datDatosPoai;
    }

    public function form_poai($codigo_poai){

        $sql_form_poai="SELECT poav_codigo, poav_accion, poav_fuentefinanciacion, 
                               poav_sede, poav_recurso, poav_estado, poav_vigencia,
                               poav_indicador, poav_adicion, poav_acuerdo
                          FROM planaccion.poai_veinte_veintidos
                         WHERE poav_codigo = $codigo_poai;";

        $query_form_poai=$this->cnxion->ejecutar($sql_form_poai);

        while($data_form_poai=$this->cnxion->obtener_filas($query_form_poai)){
            $dataform_poai[]=$data_form_poai;
        }
        return $dataform_poai;
    }

    public function indicador_accion_sede($codigo_accion, $codigo_sede){

        $sql_indicador_accion_sede="SELECT ind_codigo, ind_unidadmedida
                                      FROM plandesarrollo.indicador
                                     WHERE ind_accion = $codigo_accion
                                       AND ind_sede = $codigo_sede;";

        $query_indicador_accion_sede=$this->cnxion->ejecutar($sql_indicador_accion_sede);

        while($data_indicador_accion_sede=$this->cnxion->obtener_filas($query_indicador_accion_sede)){
            $dataindicador_accion_sede[]=$data_indicador_accion_sede;
        }
        return $dataindicador_accion_sede;
    }

    public function list_recursos_anteriores(){

        $sql_list_recursos_anteriores="SELECT sff_codigo, sff_vigencia, 
                                              sff_fuente, sff_saldo, sff_estado,
                                              ffi_nombre
                                         FROM planaccion.saldos_fuente_financiacion,
                                              planaccion.fuente_financiacion
                                        WHERE sff_fuente = ffi_codigo
                                          AND sff_estado = 1
                                        ORDER BY sff_vigencia ASC;";

        $query_list_recursos_anteriores=$this->cnxion->ejecutar($sql_list_recursos_anteriores);

        while($data_list_recursos_anteriores=$this->cnxion->obtener_filas($query_list_recursos_anteriores)){
            $datalist_recursos_anteriores[]=$data_list_recursos_anteriores;
        }
        return $datalist_recursos_anteriores;
    }
    
    public function gastos_recursos_anteriores($codigo_saldo, $codigo_adicion){

        if($codigo_adicion>0){
            $condicion = "AND apoai_codigo NOT IN($codigo_adicion)";
        }
        else{
            $condicion = "";
        }

        $sql_gastos_recursos_anteriores="SELECT SUM(apoai_valor) AS valor_adicionado
                                           FROM planaccion.adicion_poai
                                          WHERE apoai_estado = 1
                                            AND apoai_saldo = $codigo_saldo
                                            $condicion;";

        $query_gastos_recursos_anteriores=$this->cnxion->ejecutar($sql_gastos_recursos_anteriores);

        $data_gastos_recursos_anteriores=$this->cnxion->obtener_filas($query_gastos_recursos_anteriores);
        
        $valor_adicionado= $data_gastos_recursos_anteriores['valor_adicionado'];

        return $valor_adicionado;
    }

    public function saldo_fuente($codigo_saldo){

        $sql_saldo_fuente="SELECT sff_codigo, sff_vigencia, sff_fuente, sff_saldo
                             FROM planaccion.saldos_fuente_financiacion
                            WHERE sff_codigo = $codigo_saldo;";

        $query_saldo_fuente=$this->cnxion->ejecutar($sql_saldo_fuente);

        $data_saldo_fuente=$this->cnxion->obtener_filas($query_saldo_fuente);
        
        $sff_saldo= $data_saldo_fuente['sff_saldo'];

        return $sff_saldo;
    }

    public function saldo_disponible($codigo_saldo, $codigo_adicion){

        $saldo_fuente = $this->saldo_fuente($codigo_saldo);
        $gastos_recursos_anteriores = $this->gastos_recursos_anteriores($codigo_saldo, $codigo_adicion);

        $dsponble = $saldo_fuente - $gastos_recursos_anteriores;

        return $dsponble;
    }

    public function list_saldo_disponible($codigo_adicion){
        $codigo_adicion = $codigo_adicion;

        $array_saldos_fuente = array();
        $list_recursos_anteriores = $this->list_recursos_anteriores();
        if($list_recursos_anteriores){
            foreach($list_recursos_anteriores as $dta_recrsos){
                $sff_codigo = $dta_recrsos['sff_codigo'];
                $sff_vigencia = $dta_recrsos['sff_vigencia'];
                $sff_fuente = $dta_recrsos['sff_fuente'];
                $sff_saldo = $dta_recrsos['sff_saldo'];
                $sff_estado = $dta_recrsos['sff_estado']; 
                $ffi_nombre = $dta_recrsos['ffi_nombre'];

                $gastos_recursos_anteriores = $this->gastos_recursos_anteriores($sff_codigo, $codigo_adicion);
                
                if($gastos_recursos_anteriores){
                    $saldo_disponible = $sff_saldo - $gastos_recursos_anteriores;
                }
                else{
                    $saldo_disponible = $sff_saldo;
                }

                if($saldo_disponible>0){
                    $array_saldos_fuente[] = array('codigo'=> $sff_codigo,
                                                   'vigencia'=> $sff_vigencia,
                                                   'fuente'=> $ffi_nombre,
                                                   'saldo_disponible'=> $saldo_disponible
                                                );
                }
            }
        }
        return $array_saldos_fuente;
    }

    public function list_adicion_poai($codigo_poai){

        $sql_list_adicion_poai="SELECT apoai_codigo, apoai_poai, 
                                       apoai_saldo, apoai_valor, 
                                       apoai_estado, apoai_fechacreo, 
                                       sff_vigencia, ffi_nombre
                                  FROM planaccion.adicion_poai, 
                                       planaccion.saldos_fuente_financiacion,
                                       planaccion.fuente_financiacion
                                 WHERE apoai_saldo = sff_codigo
                                   AND sff_fuente = ffi_codigo
                                   AND apoai_poai = $codigo_poai
                                 ORDER BY apoai_fechacreo ASC;";

        $query_list_adicion_poai=$this->cnxion->ejecutar($sql_list_adicion_poai);

        while($data_list_adicion_poai=$this->cnxion->obtener_filas($query_list_adicion_poai)){
            $datalist_adicion_poai[]=$data_list_adicion_poai;
        }
        return $datalist_adicion_poai;
    }

    public function form_adicion($codigo_poai){

        $sql_form_adicion="SELECT apoai_codigo, apoai_poai, 
                                  apoai_saldo, apoai_valor, 
                                  apoai_estado
                             FROM planaccion.adicion_poai
                            WHERE apoai_codigo = $codigo_poai;";

        $query_form_adicion=$this->cnxion->ejecutar($sql_form_adicion);

        while($data_form_adicion=$this->cnxion->obtener_filas($query_form_adicion)){
            $dataform_adicion[]=$data_form_adicion;
        }
        return $dataform_adicion;
    }

    public function list_acuerdo(){

        $sql_list_acuerdo="SELECT aad_codigo, add_nombre, add_tipoactoadmin, 
                                  add_urlactoadmin, add_vigencia
                             FROM plandesarrollo.acto_administrativo
                            WHERE add_tipoactoadmin in(1,2)
                            ORDER BY add_vigencia, add_nombre ASC;";

        $query_list_acuerdo=$this->cnxion->ejecutar($sql_list_acuerdo);

        while($data_list_acuerdo=$this->cnxion->obtener_filas($query_list_acuerdo)){
            $datalist_acuerdo[]=$data_list_acuerdo;
        }
        return $datalist_acuerdo;
    }

    public function list_recurso_poai($codigo_poai){

        $sql_list_recurso_poai="SELECT poav_codigo AS codigo_recurso, 
                                       poav_recurso AS valor_recurso, 
                                       poav_vigencia AS codigo_vigencia, 
                                       poav_fuentefinanciacion AS codigo_fuente, 
                                       poav_indicador AS codigo_indicador,
                                       poav_accion AS codigo_accion, 
                                       poav_vigencia AS vigencia_poai
                                  FROM planaccion.poai_veinte_veintidos
                                WHERE poav_codigo = $codigo_poai 
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
                                  AND apoai_poai = $codigo_poai;";

        $query_list_recurso_poai=$this->cnxion->ejecutar($sql_list_recurso_poai);

        while($data_list_recurso_poai=$this->cnxion->obtener_filas($query_list_recurso_poai)){
            $datalist_recurso_poai[]=$data_list_recurso_poai;
        }
        return $datalist_recurso_poai;
    }

    public function sum_traslado($codigo_recurso, $codigo_traslado){

        $sql_sum_traslado = "SELECT SUM(tpo_valor) AS sumavalor
                               FROM planaccion.traslados_poai
                              WHERE tpo_estado = 1
                                AND tpo_codigorecuerso = $codigo_recurso
                                AND tpo_codigo NOT IN($codigo_traslado);";

        $query_sum_traslado = $this->cnxion->ejecutar($sql_sum_traslado);

        $data_sum_traslado = $this->cnxion->obtener_filas($query_sum_traslado);
        
        $sumavalor = $data_sum_traslado['sumavalor'];

        if($sumavalor){
            $suma_valor = $sumavalor;
        }
        else{
            $suma_valor = 0;
        }
        return $suma_valor;
    }

    public function descripcion_fuente($codigo_fuente){

        $sql_descripcion_fuente="SELECT ffi_codigo, ffi_nombre, ffi_descripcion
                                   FROM planaccion.fuente_financiacion
                                  WHERE ffi_codigo = $codigo_fuente;";

        $query_descripcion_fuente=$this->cnxion->ejecutar($sql_descripcion_fuente);

        $data_descripcion_fuente=$this->cnxion->obtener_filas($query_descripcion_fuente);
        
        $ffi_nombre = $data_descripcion_fuente['ffi_nombre'];

        return str_replace('INV - ','',$ffi_nombre);
    }

    public function asignado_fuente_vigencia($codigo_accion, $codigo_indicador, $codigo_fuente, $vigencia_poai, $vigencia_recurso){

        $sql_asignado_fuente_vigencia="SELECT SUM(asre_recurso) AS sumaasignado
                                         FROM planaccion.asignacion_recuersos_etapa
                                        WHERE asre_estado = 1
                                          AND asre_accion = $codigo_accion
                                          AND asre_indicador = $codigo_indicador
                                          AND asre_fuente = $codigo_fuente
                                          AND asre_vigenciapoai = $vigencia_poai
                                          AND asre_vigenciarecurso = $vigencia_recurso;";

        $query_asignado_fuente_vigencia=$this->cnxion->ejecutar($sql_asignado_fuente_vigencia);

        $data_asignado_fuente_vigencia=$this->cnxion->obtener_filas($query_asignado_fuente_vigencia);
        
        $sumaasignado = $data_asignado_fuente_vigencia['sumaasignado'];

        if($sumaasignado){
            $suma_asignado = $sumaasignado;
        }
        else{
            $suma_asignado = 0;
        }
        return $suma_asignado;
    }

    public function rcrsos_trasladar($codigo_poai, $codigo_traslado){
        $lista_recurso = $this->list_recurso_poai($codigo_poai);
        $array_valores = array();
        if($lista_recurso){
            foreach($lista_recurso as $dat_lsta_recurso){
                $codigo_recurso = $dat_lsta_recurso['codigo_recurso'];
                $valor_recurso = $dat_lsta_recurso['valor_recurso'];
                $codigo_vigencia = $dat_lsta_recurso['codigo_vigencia'];
                $codigo_fuente = $dat_lsta_recurso['codigo_fuente'];
                $codigo_indicador = $dat_lsta_recurso['codigo_indicador'];
                $codigo_accion = $dat_lsta_recurso['codigo_accion'];
                $vigencia_poai = $dat_lsta_recurso['vigencia_poai'];

                if($valor_recurso > 0){
                    $asignado_fuente_vigencia = $this->asignado_fuente_vigencia($codigo_accion, $codigo_indicador, $codigo_fuente, $vigencia_poai, $codigo_vigencia);

                    $sum_traslado = $this->sum_traslado($codigo_recurso, $codigo_traslado);

                    $valor_disponible = $valor_recurso - $asignado_fuente_vigencia - $sum_traslado;

                    $descripcion_fuente = $this->descripcion_fuente($codigo_fuente);

                    $descrpcion = $codigo_vigencia." ".$descripcion_fuente." $".number_format($valor_disponible,0,'','.');

                    if($valor_disponible > 0){
                        $array_valores[] = array('codigo_recursos'=> $codigo_recurso,
                                                 'valor_disponible'=> $valor_disponible,
                                                 'descrpcion'=> $descrpcion,
                                                );
                    }
                }
            }
        }
        return $array_valores;
    }

    public function form_traslado($codigo_traslado){

        $sql_form_traslado="SELECT tpo_codigo, tpo_poai, tpo_accion, 
                                   tpo_codigorecuerso, tpo_valor, 
                                   tpo_acuerdo, tpo_sede, 
                                   tpo_indicador, tpo_estado
                              FROM planaccion.traslados_poai
                             WHERE tpo_codigo = $codigo_traslado;";

        $query_form_traslado=$this->cnxion->ejecutar($sql_form_traslado);

        while($data_form_traslado=$this->cnxion->obtener_filas($query_form_traslado)){
            $dataform_traslado[]=$data_form_traslado;
        }
        return $dataform_traslado;
    }
    
    public function codigo_poai_proyecto($codigo_poai){

        $sql_codigo_poai_proyecto="SELECT poav_codigo, acc_proyecto
                                     FROM planaccion.poai_veinte_veintidos
                                    INNER JOIN plandesarrollo.accion ON acc_codigo = poav_accion
                                    WHERE poav_codigo = $codigo_poai;";

        $query_codigo_poai_proyecto=$this->cnxion->ejecutar($sql_codigo_poai_proyecto);

        $data_codigo_poai_proyecto=$this->cnxion->obtener_filas($query_codigo_poai_proyecto);

        $acc_proyecto = $data_codigo_poai_proyecto['acc_proyecto'];

        return $acc_proyecto;
    }

    public function proyecto_accion($codigo_accion){

        $sql_proyecto_accion="SELECT acc_codigo, acc_referencia, acc_proyecto
                                FROM plandesarrollo.accion
                               WHERE acc_codigo = $codigo_accion;";

        $query_proyecto_accion=$this->cnxion->ejecutar($sql_proyecto_accion);

        $data_proyecto_accion=$this->cnxion->obtener_filas($query_proyecto_accion);

        $acc_proyecto = $data_proyecto_accion['acc_proyecto'];

        return $acc_proyecto;
    }

    public function acuerdo_data(){

        $sql_acuerdo_data="SELECT aad_codigo, add_nombre, add_tipoactoadmin, 
                                  add_urlactoadmin, add_vigencia
                             FROM plandesarrollo.acto_administrativo
                            WHERE add_tipoactoadmin = 1
                            ORDER BY add_vigencia, add_nombre ASC;";

        $query_acuerdo_data=$this->cnxion->ejecutar($sql_acuerdo_data);

        while($data_acuerdo_data=$this->cnxion->obtener_filas($query_acuerdo_data)){
            $dataacuerdo_data[]=$data_acuerdo_data;
        }
        return $dataacuerdo_data;
    }

    public function resolucion_data(){

        $sql_resolucion_data="SELECT aad_codigo, add_nombre, add_tipoactoadmin, 
                                     add_urlactoadmin, add_vigencia
                                FROM plandesarrollo.acto_administrativo
                               WHERE add_tipoactoadmin = 2
                               ORDER BY add_vigencia, add_nombre ASC;";

        $query_resolucion_data=$this->cnxion->ejecutar($sql_resolucion_data);

        while($data_resolucion_data=$this->cnxion->obtener_filas($query_resolucion_data)){
            $dataresolucion_data[]=$data_resolucion_data;
        }
        return $dataresolucion_data;
    }
}
?>