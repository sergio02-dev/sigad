<?php

    include_once('classCtvdad.php');

    class CcionCtvdad extends Actividad{

        private $sqlAccionActividad;
        private $rsDataAccionActividad;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function trimestre(){

            $sqltrimestre="SELECT DISTINCT apr_trim
                                    FROM planaccion.apertura_reporte
                                    WHERE apr_trim IS NOT NULL;";
    
            $querytrimestre=$this->cnxion->ejecutar($sqltrimestre);
    
            while($data_trimestre=$this->cnxion->obtener_filas($querytrimestre)){
                $datatrimestre[]=$data_trimestre;
            }
            return $datatrimestre;
        }
        
        public function selectActividadAccion(){

            if($this->getProyectoActividad()=="Facultad"){
                $condicionActIn=" AND act_dependencia=".$this->getReferenciaActividad()." ";
            }
            else{
                $condicionActIn="";
            }
            
            $sqlAccionActividad=" SELECT act_codigo, acc_descripcion, act_descripcion, act_fechaexpedicion, act_accion, 
                                act_proyecto, act_dependencia, act_referencia, act_estado, act_fechacreo, 
                                act_fechamodifico, act_personacreo, act_personamodifico, pro_descripcion, 
                                aco_valor, aco_vigencia, act_certificado, acc_referencia
                            FROM planaccion.actividad,plandesarrollo.proyecto,plandesarrollo.accion, planaccion.actividad_costo
                            WHERE planaccion.actividad.act_proyecto=plandesarrollo.proyecto.pro_codigo
                            AND planaccion.actividad.act_accion=plandesarrollo.accion.acc_codigo
                            AND planaccion.actividad_costo.aco_actividad=planaccion.actividad.act_codigo
                            AND planaccion.actividad_costo.aco_vigencia=2019
                            /*AND planaccion.actividad.act_trimestre IN(1,2)*/
                            AND planaccion.actividad.act_trimestre IN(".$this->getTrimestreActividad().")
                            AND planaccion.actividad.act_accion=".$this->getAccionActividad()." $condicionActIn; ";
                            //--AND planaccion.actividad.act_accion=".$this->getAccionActividad()."


            $queryAccionActividad=$this->cnxion->ejecutar($sqlAccionActividad);

             while($dataAccionActividad=$this->cnxion->obtener_filas($queryAccionActividad)){
                $rsDataAccionActividad[]=$dataAccionActividad;
            }
            return $rsDataAccionActividad;
        }

        public function traerplan(){

            $sqltrimestre="SELECT DISTINCT apr_trim
                                    FROM planaccion.apertura_reporte
                                    WHERE apr_trim IS NOT NULL;";
    
            $querytrimestre=$this->cnxion->ejecutar($sqltrimestre);
    
            while($data_trimestre=$this->cnxion->obtener_filas($querytrimestre)){
                $datatrimestre[]=$data_trimestre;
            }
            return $datatrimestre;
        }




        public function dataAccionActividadAccion(){
        
            $rs_accionactividad= $this->selectActividadAccion();
            
            foreach ($rs_accionactividad as $datosAccionactividad) {
                
                $act_codigo = $datosAccionactividad['act_codigo'];
                $act_accion = $datosAccionactividad['act_accion'];
                $pro_descripcion = $datosAccionactividad['pro_descripcion'];
                $act_referencia = $datosAccionactividad['act_referencia']; 
                $acc_descripcion = $datosAccionactividad['acc_descripcion']; 
                $act_descripcion = $datosAccionactividad['act_descripcion'];
                $act_certificado = $datosAccionactividad['act_certificado'];
                $aco_valor ="$".number_format($datosAccionactividad['aco_valor'], 0, ',', ',');
                $act_fechaexpedicion=date('d/m/Y',strtotime($datosAccionactividad['act_fechaexpedicion']));
 
                 $rsActividad[] = array('pro_descripcion'=> $pro_descripcion, 
                                   'act_referencia'=> $act_referencia, 
                                   'acc_descripcion'=> $acc_descripcion, 
                                   'act_descripcion'=> $act_descripcion,
                                   'act_certificado'=> $act_certificado,
                                   'aco_valor' => $aco_valor,
                                   'act_fechaexpedicion' => $act_fechaexpedicion,
                                   'act_codigo' => $act_codigo,
                                   'act_accion' => $act_accion
                                  );

            }

            $datActividadAccionJson=json_encode(array("data"=>$rsActividad));
            
            return $datActividadAccionJson;            
        }

        public function list_actividad_accion($codigo_accion){

            $sql_list_actividad_accion="SELECT act_codigo, plandesarrollo.subsistema.sub_codigo, sub_nombre, 
                                               pde_codigo, sub_referencia, sub_ref, pro_codigo,
                                               pro_referencia, pro_numero, acc_codigo, acc_referencia, 
                                               acc_numero, act_referencia, act_descripcion,
                                               act_fechaexpedicion, act_certificado, aco_valor,
                                               act_vigencia, act_accion, cee_certificado, 
                                               cee_actividad, cee_etapa, acp_referencia,
                                               acp_numero, acp_descripcion, poa_referencia, 
                                               poa_objeto, poa_recurso, poa_numero, pro_descripcion,
                                               acc_descripcion
                                          FROM plandesarrollo.subsistema, plandesarrollo.proyecto, 
                                               plandesarrollo.accion, planaccion.actividad, planaccion.actividad_costo,
                                               planaccion.certificado_etapa, planaccion.actividad_poai, planaccion.poai
                                         WHERE plandesarrollo.subsistema.sub_codigo = plandesarrollo.proyecto.sub_codigo
                                          AND pro_codigo = acc_proyecto
                                          AND pro_codigo = act_proyecto
                                          AND acc_codigo = act_accion
                                          AND act_codigo = aco_actividad
                                          AND act_codigo = cee_certificado
                                          AND planaccion.actividad_poai.acp_codigo = cee_actividad
                                          AND planaccion.actividad_poai.acp_codigo = planaccion.poai.acp_codigo
                                          AND poa_codigo = cee_etapa
                                          AND acc_codigo = $codigo_accion
                                          ORDER BY act_certificado, pde_codigo, plandesarrollo.subsistema.sub_codigo, 
                                          acp_referencia, acp_numero, poa_referencia, poa_numero ASC;";


            $query_list_actividad_accion=$this->cnxion->ejecutar($sql_list_actividad_accion);

            while($data_list_actividad_accion=$this->cnxion->obtener_filas($query_list_actividad_accion)){
                $datalist_actividad_accion[]=$data_list_actividad_accion;
            }
            return $datalist_actividad_accion;
        }

        public function validacion_reporte_actividad($codigo_actividadpoai){

            $sql_validacion_reporte_actividad="SELECT COUNT(*) AS cantidad_reportes
                                                 FROM planaccion.reporte_actividad
                                                WHERE rac_codigoactividadpoai = $codigo_actividadpoai;";
    
            $query_validacion_reporte_actividad=$this->cnxion->ejecutar($sql_validacion_reporte_actividad);
    
            $data_validacion_reporte_actividad=$this->cnxion->obtener_filas($query_validacion_reporte_actividad);

            $cantidad_reportes = $data_validacion_reporte_actividad['cantidad_reportes'];

            if($cantidad_reportes == 0){
                $ver_boton = "block";
            }
            else{
                $ver_boton = "none";
            }

            return $ver_boton;
        }

        public function data_lista_actividades($codigo_accion){
        
            $rs_activity= $this->list_actividad_accion($codigo_accion);

            if($rs_activity){
                foreach ($rs_activity as $datos_activity) {
                
                    $act_codigo = $datos_activity['act_codigo'];
                    $act_accion = $datos_activity['act_accion'];
                    $pro_descripcion = $datos_activity['pro_descripcion'];
                    $acc_descripcion = $datos_activity['acc_descripcion']; 
                    $act_descripcion = $datos_activity['acp_descripcion'];
                    $act_certificado = $datos_activity['act_certificado'];
                    $aco_valor ="$".number_format($datos_activity['poa_recurso'], 0, ',', ',');
                    $act_fechaexpedicion=date('d/m/Y',strtotime($datos_activity['act_fechaexpedicion']));
                    $acp_referencia = $datos_activity['acp_referencia'];
                    $acp_numero = $datos_activity['acp_numero'];
                    $poa_referencia = $datos_activity['poa_referencia'];
                    $poa_numero = $datos_activity['poa_numero'];
                    $poa_objeto = $datos_activity['poa_objeto'];
                    $cee_etapa = $datos_activity['cee_etapa'];
                    $cee_actividad = $datos_activity['cee_actividad'];
                    $pde_codigo = $datos_activity['pde_codigo'];

                    $ver_boton = $this->validacion_reporte_actividad($cee_actividad);
    
                    $nombre_etapa = $poa_referencia.".".$poa_numero." ".$poa_objeto;
    
                    $act_referencia = $acp_referencia.".".$acp_numero;
     
                     $rsActividad[] = array('pro_descripcion'=> $pro_descripcion, 
                                            'act_referencia'=> $act_referencia, 
                                            'acc_descripcion'=> $acc_descripcion, 
                                            'act_descripcion'=> $act_descripcion,
                                            'act_certificado'=> $act_certificado,
                                            'aco_valor' => $aco_valor,
                                            'act_fechaexpedicion' => $act_fechaexpedicion,
                                            'act_codigo' => $act_codigo,
                                            'act_accion' => $act_accion,
                                            'nombre_etapa' => $nombre_etapa,
                                            'cee_etapa' => $cee_etapa,
                                            'cee_actividad' => $cee_actividad,
                                            'pde_codigo' => $pde_codigo,
                                            'ver_boton' => $ver_boton,
                                      );
    
                }
    
                $datActividadAccionJson = json_encode(array("data"=>$rsActividad));
            }
            else{
                $datActividadAccionJson = json_encode(array("data"=>''));
            }
            
            
            
            return $datActividadAccionJson;            
        }

        public function list_actividad_reportar($codigo_accion){

            $sql_list_actividad_reportar="SELECT DISTINCT cee_actividad, plandesarrollo.subsistema.sub_codigo, 
                                                          pde_codigo, acc_codigo, acp_referencia, acp_numero, 
                                                          acc_descripcion, acp_descripcion
                                                     FROM plandesarrollo.subsistema, plandesarrollo.proyecto, 
                                                          plandesarrollo.accion, planaccion.actividad,
                                                          planaccion.certificado_etapa, planaccion.actividad_poai
                                                    WHERE plandesarrollo.subsistema.sub_codigo = plandesarrollo.proyecto.sub_codigo
                                                      AND pro_codigo = acc_proyecto
                                                      AND pro_codigo = act_proyecto
                                                      AND acc_codigo = act_accion
                                                      AND act_codigo = cee_certificado
                                                      AND planaccion.actividad_poai.acp_codigo = cee_actividad
                                                      AND acc_codigo = $codigo_accion
                                                    ORDER BY pde_codigo, plandesarrollo.subsistema.sub_codigo, 
                                                          acp_referencia, acp_numero ASC;";


            $query_list_actividad_reportar=$this->cnxion->ejecutar($sql_list_actividad_reportar);

            while($data_list_actividad_reportar=$this->cnxion->obtener_filas($query_list_actividad_reportar)){
                $datalist_actividad_reportar[]=$data_list_actividad_reportar;
            }
            return $datalist_actividad_reportar;
        }

        public function list_etpas($codigo_actividad_poai){

            $sql_list_etpas="SELECT poa_codigo, poa_referencia, 
                                    poa_objeto, poa_recurso, 
                                    ((poa_logro * poa_logroejecutado)/100) AS porcentaje_logro, 
                                    poa_estado, poa_numero, acp_codigo
                               FROM planaccion.poai
                              WHERE acp_codigo = $codigo_actividad_poai;";


            $query_list_etpas=$this->cnxion->ejecutar($sql_list_etpas);

            while($data_list_etpas=$this->cnxion->obtener_filas($query_list_etpas)){
                $datalist_etpas[]=$data_list_etpas;
            }
            return $datalist_etpas;
        }

        public function cantidad_reportes_actividad($codigo_actividad, $codigo_etapa){

            $sql_cantidad_reportes_actividad="SELECT COUNT(*) AS cntdad_reportes
                                                FROM planaccion.reporte_actividad_etapa
                                               WHERE rea_codigoactividadpoai = $codigo_actividad
                                                 AND rea_codigoetapa = $codigo_etapa;";
    
            $query_cantidad_reportes_actividad=$this->cnxion->ejecutar($sql_cantidad_reportes_actividad);
    
            $data_cantidad_reportes_actividad=$this->cnxion->obtener_filas($query_cantidad_reportes_actividad);

            $cntdad_reportes = $data_cantidad_reportes_actividad['cntdad_reportes'];

            return $cntdad_reportes;
        }

        public function suma_reporte($codigo_actividad, $codigo_etapa){

            $sql_suma_reporte="SELECT SUM(rea_logrado) AS porcentajes_suma
                                 FROM planaccion.reporte_actividad_etapa
                                WHERE rea_codigoactividadpoai = $codigo_actividad
                                  AND rea_codigoetapa = $codigo_etapa;";
    
            $query_suma_reporte=$this->cnxion->ejecutar($sql_suma_reporte);
    
            $data_suma_reporte=$this->cnxion->obtener_filas($query_suma_reporte);

            $porcentajes_suma = $data_suma_reporte['porcentajes_suma'];

            return $porcentajes_suma;
        }

        public function actividad_certificado($codigo_certificado){

            $sql_actividad_certificado="SELECT DISTINCT cee_certificado, act_certificado
                                          FROM planaccion.certificado_etapa, planaccion.actividad
                                         WHERE act_codigo = cee_certificado
                                           AND cee_actividad = $codigo_certificado;";


            $query_actividad_certificado=$this->cnxion->ejecutar($sql_actividad_certificado);

            while($data_actividad_certificado=$this->cnxion->obtener_filas($query_actividad_certificado)){
                $dataactividad_certificado[]=$data_actividad_certificado;
            }
            return $dataactividad_certificado;
        }

        public function data_actividad_reporte($codigo_accion){
        
            $rs_rprte_atvdad= $this->list_actividad_reportar($codigo_accion);
            if($rs_rprte_atvdad){
                foreach ($rs_rprte_atvdad as $data_rprte_actvdad) {
                    $cee_actividad = $data_rprte_actvdad['cee_actividad'];
                    $sub_codigo = $data_rprte_actvdad['sub_codigo'];
                    $pde_codigo = $data_rprte_actvdad['pde_codigo'];
                    $acc_codigo = $data_rprte_actvdad['acc_codigo'];
                    $acp_referencia = $data_rprte_actvdad['acp_referencia']; 
                    $acp_numero = $data_rprte_actvdad['acp_numero'];
                    $acc_descripcion = $data_rprte_actvdad['acc_descripcion'];
                    $acp_descripcion = $data_rprte_actvdad['acc_descripcion'];

                    $cantidad_etapas_completo = 0;
                    $list_etpas = $this->list_etpas($cee_actividad);
                    if($list_etpas){
                        $cantidad_etapas = count($list_etpas);
                        
                        foreach ($list_etpas as $dta_list_etpas) {
                            $poa_codigo = $dta_list_etpas['poa_codigo'];
                            $porcentaje_logro = $dta_list_etpas['porcentaje_logro'];

                            $cantidad_reportes_actividad = $this->cantidad_reportes_actividad($cee_actividad, $poa_codigo);
                            if($cantidad_reportes_actividad > 0){
                                $suma_reporte = $this->suma_reporte($cee_actividad, $poa_codigo);

                                $porcentaje_final = $porcentaje_logro + $suma_reporte;

                                if($porcentaje_final == 100){
                                    $cantidad_etapas_completo++;
                                }
                            }
                            else{

                            }

                        }
                    }

                    $actividad_certificado = $this->actividad_certificado($cee_actividad);
                    if($actividad_certificado){
                        $crtfcdo = "";
                        foreach ($actividad_certificado as $data_cantd_crtfcado) {
                            $cee_certificado = $data_cantd_crtfcado['cee_certificado'];
                            $act_certificado = $data_cantd_crtfcado['act_certificado'];
    
                            $crtfcdo = $crtfcdo."\n".$act_certificado.",";
                        }
                    }
                    else{
                        $crtfcdo = "";
                    }
                    
                
                    if($cantidad_etapas == $cantidad_etapas_completo){

                        $ref_actividad = $acp_referencia.".".$acp_numero;
         
                        $rsActividad[] = array('codigo_actividad'=> $cee_actividad, 
                                               'codigo_accion'=> $acc_codigo, 
                                               'codigo_plan'=> $pde_codigo, 
                                               'ref_actividad'=> $ref_actividad,
                                               'acp_descripcion'=> $acp_descripcion,
                                               "certificados"=> $crtfcdo
                                            );
                    }

                    if($rsActividad){
                        $datActividadAccionJson = json_encode(array("data"=>$rsActividad));
                    }
                    else{
                        $datActividadAccionJson = json_encode(array("data"=>''));
                    }
                }
            }
            else{
                $datActividadAccionJson = json_encode(array("data"=>''));
            }
            return $datActividadAccionJson;            
        }


    }




?>