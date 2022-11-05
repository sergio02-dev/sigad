<?php

    include_once('classCrtfcdos.php');

    class Crtfcdos extends Certificados{

        private $sqlAccion;
        private $SubsistemaAccion;
        private $dataAccion;


        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->SubsistemaAccion = $this->getCodigoSubsistema();
        }

        public function selectSubsistema(){
            $sql_selectsubsistema=" SELECT sub_codigo, sub_nombre, sub_personacreo, sub_personamodifico,
                                        sub_fechacreo, sub_fechamodifico, add_codigo, pde_codigo, res_codigo, sub_referencia
                            FROM plandesarrollo.subsistema ; ";
            $resultado_subsistema=$this->cnxion->ejecutar($sql_selectsubsistema);

            while ($data_subsistema = $this->cnxion->obtener_filas($resultado_subsistema)){
                $datasubsistema[] = $data_subsistema;
            }
            return $datasubsistema;
        }

        public function resoluciones(){

            $sql_resoluciones="SELECT aad_codigo, add_nombre,
                                      add_tipoactoadmin, add_urlactoadmin
                                 FROM plandesarrollo.acto_administrativo
                                WHERE add_tipoactoadmin = 2;";
            $resultado_resoluciones=$this->cnxion->ejecutar($sql_resoluciones);

            while ($data_resoluciones = $this->cnxion->obtener_filas($resultado_resoluciones)){
                $dataresoluciones[] = $data_resoluciones;
            }
            return $dataresoluciones;
        }


        public function selectProyecto($codigo_subsistema){

            $sql_selectproyecto=" SELECT  pro_codigo, pro_descripcion, pro_referencia,
                                          pro_numero, sub_referencia, sub_ref
                                  FROM plandesarrollo.subsistema,plandesarrollo.proyecto
                                  WHERE plandesarrollo.subsistema.sub_codigo=plandesarrollo.proyecto.sub_codigo $condicionSusbsitema
                                  AND plandesarrollo.proyecto.sub_codigo=$codigo_subsistema
                                  ORDER BY pro_numero, pro_referencia ";

            $resultado_proyecto=$this->cnxion->ejecutar($sql_selectproyecto);

            while ($data_proyecto = $this->cnxion->obtener_filas($resultado_proyecto)){
                $dataproyecto[] = $data_proyecto;
            }
            return $dataproyecto;
        }

        public function selectAccion($codigo_proyecto){
            $sql_selectaccion=" SELECT acc_codigo, acc_referencia, acc_descripcion, 
                                       acc_responsable, acc_proyecto, acc_numerovigencia,
                                       acc_numero, sub_referencia, sub_ref
                                  FROM plandesarrollo.accion,plandesarrollo.proyecto, plandesarrollo.subsistema
                                 WHERE plandesarrollo.accion.acc_proyecto=plandesarrollo.proyecto.pro_codigo
                                   AND plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                   AND plandesarrollo.accion.acc_proyecto=$codigo_proyecto
                                 ORDER BY acc_numero, acc_referencia";
            $resultado_accion=$this->cnxion->ejecutar($sql_selectaccion);

            while ($data_accion = $this->cnxion->obtener_filas($resultado_accion)){
                $dataaccion[] = $data_accion;

            }

                return $dataaccion;
        }
        public function Actividad(){

            $sql_selectactividad="SELECT act_codigo, act_descripcion, act_fechaexpedicion, act_accion,
                                         act_proyecto, act_dependencia, act_referencia, act_estado, act_fechacreo,
                                         act_fechamodifico, act_personacreo, act_personamodifico, act_certificado,
                                         act_vigencia, act_trimestre, aco_valor, act_certificadomod,
                                         act_estadoactividad,acc_descripcion,
                                         (SELECT COUNT(*) 
                                         FROM planaccion.actividad_realizada 
                                         WHERE are_actividad=act_codigo
                                         ) AS cantidadactividades, act_padrepadre
                                    FROM planaccion.actividad, planaccion.actividad_costo, plandesarrollo.accion
                                    WHERE act_codigo=aco_actividad
                                    AND act_accion=acc_codigo
                                    AND act_padrepadre = 0
                                    ORDER BY act_certificado DESC";
            $resultado_actividad=$this->cnxion->ejecutar($sql_selectactividad);

            while ($data_actividad = $this->cnxion->obtener_filas($resultado_actividad)){
                $dataacividad[] = $data_actividad;
            }
            return $dataacividad;
        }

        public function updateActividad($codigoActividad){

            $sql_updateactividad="SELECT act_codigo, act_descripcion, act_fechaexpedicion, act_accion,
                                   act_proyecto, act_dependencia, act_referencia, act_estado, act_fechacreo,
                                   act_fechamodifico, act_personacreo, act_personamodifico, act_certificado,
                                   act_vigencia, act_trimestre, aco_valor, sub_codigo,act_certificadomod,act_estadoactividad, 
                                   act_certificadopadre, act_resolucion, aco_controotrovalor
                                  FROM planaccion.actividad, planaccion.actividad_costo, plandesarrollo.proyecto
                                  WHERE act_codigo=aco_actividad
                                  AND act_proyecto=pro_codigo
                                  AND act_codigo=$codigoActividad";
            $resultado_actividad=$this->cnxion->ejecutar($sql_updateactividad);

            while ($data_actividad = $this->cnxion->obtener_filas($resultado_actividad)){
                $dataacividad[] = $data_actividad;
            }
            return $dataacividad;
        }
        public function responsable(){

            $sql_responsable="SELECT per_codigo, per_nombre, per_primerapellido, per_segundoapellido
                                FROM principal.persona
                                WHERE per_nombre LIKE 'Facultad%'
                                OR per_nombre LIKE 'Vicerrectoria%';";

            $query_responsable=$this->cnxion->ejecutar($sql_responsable);
            while($data_responsable=$this->cnxion->obtener_filas($query_responsable)){
                $dataResponsable[]=$data_responsable;
            }
            return $dataResponsable;
        }
        public function estado_certificado(){

            $sql_estado_certificado="SELECT ece_codigo, ece_nombre, ece_campocertificado, ece_estado
                                     FROM principal.estado_certificado
                                     ORDER BY ece_campocertificado ASC;";

            $query_estado_certificado=$this->cnxion->ejecutar($sql_estado_certificado);
            while($data_estado_certificado=$this->cnxion->obtener_filas($query_estado_certificado)){
                $dataestado_certificado[]=$data_estado_certificado;
            }
            return $dataestado_certificado;
        }

        public function certificadoMod(){

            $sql_certificadoMod="SELECT act_codigo, act_accion, 
                                            act_referencia, act_certificado
                                    FROM planaccion.actividad
                                    ORDER BY act_certificado ASC;";

            $query_certificadoMod=$this->cnxion->ejecutar($sql_certificadoMod);
            while($data_certificadoMod=$this->cnxion->obtener_filas($query_certificadoMod)){
                $datacertificadoMod[]=$data_certificadoMod;
            }
            return $datacertificadoMod;
        }

        public function certificadCertficado($certificado){
            
            $sql_certificadCertficado="SELECT act_codigo, act_descripcion, act_fechaexpedicion, 
                                                act_dependencia, act_referencia, act_certificado
                                        FROM planaccion.actividad
                                        WHERE act_certificado=$certificado;";

            $query_certificadCertficado=$this->cnxion->ejecutar($sql_certificadCertficado);
            while($data_certificadCertficado=$this->cnxion->obtener_filas($query_certificadCertficado)){
                $datacertificadCertficado[]=$data_certificadCertficado;
            }
            return $datacertificadCertficado;
        }

        public function traer_plan_certificado($codigo_proyecto){
            
            $sql_traer_plan_certificado="SELECT pro_codigo, pro_descripcion, 
                                                plandesarrollo.proyecto.sub_codigo, pde_codigo
                                            FROM plandesarrollo.proyecto, plandesarrollo.subsistema
                                        WHERE plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                        AND pro_codigo = $codigo_proyecto";

            $query_traer_plan_certificado=$this->cnxion->ejecutar($sql_traer_plan_certificado);

            $data_traer_plan_certificado=$this->cnxion->obtener_filas($query_traer_plan_certificado);
            
            $pde_codigo= $data_traer_plan_certificado['pde_codigo'];

            return $pde_codigo;
        }

        public function actividades_certificado($certificado){
            
            $sql_actividades_certificado="SELECT DISTINCT cee_actividad, acp_descripcion, acp_referencia, acp_numero
                                            FROM planaccion.certificado_etapa,  planaccion.actividad_poai
                                           WHERE cee_actividad = acp_codigo
                                           AND cee_certificado = $certificado
                                           GROUP BY cee_actividad, acp_descripcion, acp_referencia, acp_numero;";

            $query_actividades_certificado=$this->cnxion->ejecutar($sql_actividades_certificado);
            
            while($data_actividades_certificado=$this->cnxion->obtener_filas($query_actividades_certificado)){
                $dataactividades_certificado[]=$data_actividades_certificado;
            }
            return $dataactividades_certificado;
        }

        public function etapas_actividades($actividad, $certificado){
            
            $sql_etapas_actividades="SELECT poa_codigo, poa_referencia, 
                                            poa_objeto, poa_numero, cee_actividad,
                                            poa_recurso
                                    FROM planaccion.poai, planaccion.certificado_etapa
                                    WHERE poa_codigo = cee_etapa
                                    AND cee_actividad = $actividad
                                    AND cee_certificado = $certificado;";

            $query_etapas_actividades=$this->cnxion->ejecutar($sql_etapas_actividades);
            
            while($data_etapas_actividades=$this->cnxion->obtener_filas($query_etapas_actividades)){
                $dataetapas_actividades[]=$data_etapas_actividades;
            }
            return $dataetapas_actividades;
        }

        public function referencias_accion_plan_new($codigo_accion){
            
            $sql_referencias_accion_plan_new="SELECT acc_codigo, acc_referencia, acc_numero
                                                FROM plandesarrollo.accion
                                                WHERE acc_codigo = $codigo_accion;";

            $query_referencias_accion_plan_new=$this->cnxion->ejecutar($sql_referencias_accion_plan_new);
            
            $data_referencias_accion_plan_new=$this->cnxion->obtener_filas($query_referencias_accion_plan_new);

            $acc_referencia = $data_referencias_accion_plan_new['acc_referencia'];
            $acc_numero = $data_referencias_accion_plan_new['acc_numero'];

            $referencia_new = $acc_referencia.".".$acc_numero;

            return $referencia_new;
        }


        public function referencias_accion_plan_old($codigo_accion){
            
            $sql_referencias_accion_plan_old="SELECT acc_codigo, acc_referencia, acc_numero, 
                                                     acc_proyecto, pro_codigo, 
                                                     plandesarrollo.proyecto.sub_codigo, 
                                                     pro_referencia, pro_numero, 
                                                     sub_referencia
                                                FROM plandesarrollo.accion, plandesarrollo.proyecto, plandesarrollo.subsistema
                                               WHERE acc_proyecto = pro_codigo
                                                 AND plandesarrollo.proyecto.sub_codigo = plandesarrollo.subsistema.sub_codigo
                                                 AND acc_codigo = $codigo_accion;";

            $query_referencias_accion_plan_old=$this->cnxion->ejecutar($sql_referencias_accion_plan_old);
            
            $data_referencias_accion_plan_old=$this->cnxion->obtener_filas($query_referencias_accion_plan_old);

            $sub_referencia = $data_referencias_accion_plan_old['sub_referencia'];
            $acc_referencia = $data_referencias_accion_plan_old['acc_referencia'];

            $referencia_old = $sub_referencia.".".$acc_referencia;

            return $referencia_old;
        }

        public function cantidad_reportes($codigo_etapa){
            
            $sql_cantidad_reportes="SELECT COUNT(*)AS cntdad_rprtes
                                      FROM planaccion.reporte_actividad_etapa
                                     WHERE rea_codigoetapa = $codigo_etapa;";

            $query_cantidad_reportes=$this->cnxion->ejecutar($sql_cantidad_reportes);
            
            $data_cantidad_reportes=$this->cnxion->obtener_filas($query_cantidad_reportes);

            $cntdad_rprtes = $data_cantidad_reportes['cntdad_rprtes'];

            return $cntdad_rprtes;
        }

        public function consulta_estado($estado){

            $sql_consulta_estado="SELECT ece_codigo, ece_nombre, ece_campocertificado
                                      FROM principal.estado_certificado
                                     WHERE ece_codigo = $estado;";

            $query_consulta_estado=$this->cnxion->ejecutar($sql_consulta_estado);
            
            $data_consulta_estado=$this->cnxion->obtener_filas($query_consulta_estado);

            $ece_nombre = $data_consulta_estado['ece_nombre'];

            return $ece_nombre;
        }
        
        public function Certificados(){

            $rs_actividad=$this->Actividad();

            foreach ($rs_actividad as $dat_actividad) {

                $act_codigo = $dat_actividad['act_codigo'];
                $act_descripcion = $dat_actividad['act_descripcion'];
                $act_accion = $dat_actividad['act_accion'];
                $act_proyecto = $dat_actividad['act_proyecto'];
                $act_dependencia = $dat_actividad['act_dependencia'];
                $act_referencia = $dat_actividad['act_referencia'];
                $act_estado = $dat_actividad['act_estado'];
                $act_certificado = $dat_actividad['act_certificado'];
                $act_vigencia = $dat_actividad['act_vigencia'];
                $act_trimestre = $dat_actividad['act_trimestre'];
                $acc_descripcion = $dat_actividad['acc_descripcion'];
                $cantidadactividades = $dat_actividad['cantidadactividades'];
                $act_valor ="$".number_format($dat_actividad['aco_valor'], 0, ',', ',');
                $act_fechaexpedicion=date('d/m/Y',strtotime($dat_actividad['act_fechaexpedicion']));
                $act_certificadomod = $dat_actividad['act_certificadomod'];
                $act_estadoactividad = $dat_actividad['act_estadoactividad'];

                $traer_plan_certificado = $this->traer_plan_certificado($act_proyecto);

                if($traer_plan_certificado == 1){
                    $act_descripcion = $act_referencia." ".$act_descripcion;
                    $ref_mostrar = $this->referencias_accion_plan_old($act_accion);
                    $ver_edicion_eliminacion = "none";
                }
                else{
                    $cntdad_reporte = 0;
                    $actividades_certificado = $this->actividades_certificado($act_codigo);
                    $ref_mostrar = $this->referencias_accion_plan_new($act_accion);

                    if($actividades_certificado){
                        $act_descripcion = "";
                        foreach ($actividades_certificado as $dta_actividades_certificado) {
                            $cee_actividad = $dta_actividades_certificado['cee_actividad'];
                            $acp_descripcion = $dta_actividades_certificado['acp_descripcion'];
                            $acp_referencia = $dta_actividades_certificado['acp_referencia'];
                            $acp_numero = $dta_actividades_certificado['acp_numero'];

                            $descrpcionActividadCompleta = $acp_referencia.".".$acp_numero." ".$acp_descripcion;

                            $etapas = $this->etapas_actividades($cee_actividad, $act_codigo);

                            if($etapas){
                                $ett  = "";
                                foreach ($etapas as $dtaEptas) {
                                    $poa_codigo = $dtaEptas['poa_codigo'];
                                    $poa_referencia = $dtaEptas['poa_referencia'];
                                    $poa_objeto = $dtaEptas['poa_objeto'];
                                    $poa_numero = $dtaEptas['poa_numero'];
                                    $poa_recurso = $dtaEptas['poa_recurso'];

                                    $despEtapaCompleta = "&nbsp;&nbsp;".$poa_referencia.".".$poa_numero." ".$poa_objeto."  $".number_format($poa_recurso,0,'','.');

                                    $ett = $ett.$despEtapaCompleta."<br>";

                                    $cantidad_reportes = $this->cantidad_reportes($poa_codigo);

                                    $cntdad_reporte = $cntdad_reporte + $cantidad_reportes;
                                }
                                
                            }
                            $act_descripcion = $act_descripcion.$descrpcionActividadCompleta."<br>".$ett."<br>";
                            
                        }

                    }
                    if($cntdad_reporte ==0){
                        $ver_edicion_eliminacion = "block";
                    }
                    else{
                        $ver_edicion_eliminacion = "none";
                    }
                }

                $consulta_estado = $this->consulta_estado($act_estadoactividad);

                $rsActividad[] = array('act_codigo'=> $act_codigo,
                                       'act_descripcion'=> $act_descripcion,
                                       'act_fechaexpedicion'=> $act_fechaexpedicion,
                                       'act_accion'=> $act_accion,
                                       'act_dependencia'=> $act_dependencia,
                                       'act_referencia'=> $ref_mostrar,
                                       'act_estado'=> $act_estado,
                                       'act_certificado'=> $act_certificado,
                                       'act_vigencia'=> $act_vigencia,
                                       'act_trimestre'=> $act_trimestre,
                                       'act_proyecto'=> $act_proyecto,
                                       'act_valor'=> $act_valor,
                                       'acc_descripcion'=> $acc_descripcion, 
                                       'cantidadactividades'=>$cantidadactividades,
                                       'act_certificadomod'=>$act_certificadomod,
                                       'act_estadoactividad'=>$act_estadoactividad,
                                       'ver_edicion_eliminacion'=>$ver_edicion_eliminacion,
                                       'estado_certificado'=>$consulta_estado,
                                    );


            }

            $datActividad=json_encode(array("data"=>$rsActividad));

            return $datActividad;
        }

        public function plan_desarrollo(){

            $sql_plan_desarrollo="SELECT pde_codigo, pde_nombre, pde_actoadmin, 
                                         aad_codigo, add_nombre
                                    FROM plandesarrollo.plan_desarrollo, plandesarrollo.acto_administrativo
                                   WHERE pde_actoadmin =  aad_codigo;";

            $resultado_plan_desarrollo=$this->cnxion->ejecutar($sql_plan_desarrollo);

            while ($data_plan_desarrollo = $this->cnxion->obtener_filas($resultado_plan_desarrollo)){
                $dataplan_desarrollo[] = $data_plan_desarrollo;
            }
            return $dataplan_desarrollo;
        }

        public function subsistema_plan($codigo_plan){

            $sql_subsistema_plan=" SELECT sub_codigo, sub_nombre, sub_personacreo, sub_personamodifico,
                                           sub_fechacreo, sub_fechamodifico, add_codigo, pde_codigo, res_codigo, sub_referencia
                                    FROM plandesarrollo.subsistema
                                    WHERE  pde_codigo = $codigo_plan; ";

            $resultado_subsistema_plan=$this->cnxion->ejecutar($sql_subsistema_plan);

            while ($data_subsistema_plan = $this->cnxion->obtener_filas($resultado_subsistema_plan)){
                $datasubsistema_plan[] = $data_subsistema_plan;
            }
            return $datasubsistema_plan;
        }

        public function codigo_plan($codigo_subsistema){
            
            $sql_codigo_plan=" SELECT sub_codigo, sub_nombre, sub_personacreo, 
                                      sub_personamodifico, sub_fechacreo, 
                                      sub_fechamodifico, add_codigo, pde_codigo, 
                                      res_codigo, sub_referencia
                                 FROM plandesarrollo.subsistema
                                WHERE sub_codigo = $codigo_subsistema; ";

            $resultado_codigo_plan=$this->cnxion->ejecutar($sql_codigo_plan);

            $data_codigo_plan = $this->cnxion->obtener_filas($resultado_codigo_plan);

            $pde_codigo = $data_codigo_plan['pde_codigo'];

            return $pde_codigo;
        }

        public function checked_actividad($codigo_actividad, $codigo_certificado){
            
            $sql_checked_actividad="SELECT count(*) as cantidad_activ
                                FROM planaccion.certificado_etapa
                               WHERE cee_certificado = $codigo_certificado
                               AND cee_actividad = $codigo_actividad;";

            $resultado_checked_actividad=$this->cnxion->ejecutar($sql_checked_actividad);

            $data_checked_actividad = $this->cnxion->obtener_filas($resultado_checked_actividad);

            $cantidad_activ = $data_checked_actividad['cantidad_activ'];

            return $cantidad_activ;
        }

        public function etps_lista($codigo_certificado){
            
            $sql_etps_lista="SELECT poa_codigo, poa_referencia, 
                                    poa_objeto, poa_recurso, poa_logro, 
                                    poa_estado, poa_numero, poa_vigencia, 
                                    acp_codigo, poa_logroejecutado
                            FROM planaccion.poai
                            WHERE acp_codigo IN(SELECT DISTINCT cee_actividad
                                FROM planaccion.certificado_etapa
                            WHERE cee_certificado = $codigo_certificado)
                            ORDER BY acp_codigo, poa_referencia, poa_numero;";

            $resultado_etps_lista=$this->cnxion->ejecutar($sql_etps_lista);

            while ($data_etps_lista = $this->cnxion->obtener_filas($resultado_etps_lista)){
                $dataetps_lista[] = $data_etps_lista;
            }
            return $dataetps_lista;
        }

        public function checked_etapa($codigo_certificado, $codigo_etapa){
            
            $sql_checked_etapa="SELECT COUNT(*) AS checked_etpa
                                 FROM planaccion.certificado_etapa
                                WHERE cee_certificado = $codigo_certificado
                                  AND cee_etapa = $codigo_etapa;";

            $resultado_checked_etapa=$this->cnxion->ejecutar($sql_checked_etapa);

            $data_checked_etapa = $this->cnxion->obtener_filas($resultado_checked_etapa);

            $checked_etpa = $data_checked_etapa['checked_etpa'];

            return $checked_etpa;
        }

        public function sma_etpas($codigo_certificado){
            
            $sql_sma_etpas="SELECT SUM(poa_recurso) AS suma_etapas
                              FROM planaccion.certificado_etapa, planaccion.poai
                             WHERE cee_etapa = poa_codigo
                               AND cee_certificado = $codigo_certificado;";

            $resultado_sma_etpas=$this->cnxion->ejecutar($sql_sma_etpas);

            $data_sma_etpas = $this->cnxion->obtener_filas($resultado_sma_etpas);

            $suma_etapas = $data_sma_etpas['suma_etapas'];

            return $suma_etapas;
        }

        public function acciones_plan($codigo_plan){
            
            $sql_acciones_plan="SELECT acc_codigo, acc_referencia, acc_descripcion, acc_numero,
                                       pro_codigo, pro_descripcion, pro_referencia, pro_numero,
                                       sub_nombre, sub_referencia, sub_ref, pde_codigo
                                  FROM plandesarrollo.accion, plandesarrollo.proyecto, 
                                       plandesarrollo.subsistema
                                 WHERE acc_proyecto = pro_codigo
                                   AND plandesarrollo.subsistema.sub_codigo = plandesarrollo.proyecto.sub_codigo
                                   AND pde_codigo = $codigo_plan
                                 ORDER BY plandesarrollo.proyecto.sub_codigo, acc_referencia, acc_numero ASC;";

            $query_acciones_plan=$this->cnxion->ejecutar($sql_acciones_plan);
            
            while($data_acciones_plan=$this->cnxion->obtener_filas($query_acciones_plan)){
                $dataacciones_plan[]=$data_acciones_plan;
            }
            return $dataacciones_plan;
        }

        public function certificados_accion($codigo_accion){
            
            $sql_certificados_accion="SELECT act_codigo, act_descripcion, 
                                             act_fechaexpedicion, act_accion, 
                                             act_proyecto, act_dependencia, 
                                             act_referencia, act_estado, 
                                             act_certificado  
                                        FROM planaccion.actividad
                                       WHERE act_accion = $codigo_accion;";

            $query_certificados_accion=$this->cnxion->ejecutar($sql_certificados_accion);
            
            while($data_certificados_accion=$this->cnxion->obtener_filas($query_certificados_accion)){
                $datacertificados_accion[]=$data_certificados_accion;
            }
            return $datacertificados_accion;
        }

        public function actvdades_certificado($codigo_certificado){
            
            $sql_actvdades_certificado="SELECT DISTINCT cee_actividad, acp_codigo, 
                                               acp_referencia, acp_numero, acp_descripcion
                                          FROM planaccion.certificado_etapa, planaccion.actividad_poai
                                         WHERE cee_actividad = acp_codigo
                                           AND cee_certificado = $codigo_certificado;";

            $query_actvdades_certificado=$this->cnxion->ejecutar($sql_actvdades_certificado);
            
            while($data_actvdades_certificado=$this->cnxion->obtener_filas($query_actvdades_certificado)){
                $dataactvdades_certificado[]=$data_actvdades_certificado;
            }
            return $dataactvdades_certificado;
        }

        public function etpas_certificado($codigo_certificado, $codigo_actividad){
            
            $sql_etpas_certificado="SELECT cee_certificado, cee_actividad, 
                                           cee_etapa, poa_referencia, 
                                           poa_numero, poa_objeto,
                                           cee_valor
                                      FROM planaccion.certificado_etapa, planaccion.poai
                                     WHERE cee_etapa = poa_codigo
                                       AND acp_codigo = cee_actividad
                                       AND cee_certificado = $codigo_certificado
                                       AND cee_actividad = $codigo_actividad
                                     ORDER BY poa_numero;";

            $query_etpas_certificado=$this->cnxion->ejecutar($sql_etpas_certificado);
            
            while($data_etpas_certificado=$this->cnxion->obtener_filas($query_etpas_certificado)){
                $dataetpas_certificado[]=$data_etpas_certificado;
            }
            return $dataetpas_certificado;
        }

        public function valor_certificado($codigo_certificado){
            
            $sql_valor_certificado="SELECT aco_codigo, aco_actividad, aco_valor, 
                                           aco_estado, aco_controotrovalor
                                      FROM planaccion.actividad_costo
                                     WHERE aco_actividad = $codigo_certificado;";

            $resultado_valor_certificado=$this->cnxion->ejecutar($sql_valor_certificado);

            $data_valor_certificado = $this->cnxion->obtener_filas($resultado_valor_certificado);

            $aco_valor = $data_valor_certificado['aco_valor'];

            return $aco_valor;
        }

        

        
    }
?>
