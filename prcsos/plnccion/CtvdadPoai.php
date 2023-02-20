<?php
    class CtvdadPoai{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
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
        public function plan_accion($codigo_accion){
            $sql_plan_accion="SELECT DISTINCT plandesarrollo.accion.acc_codigo,acc_descripcion,
                                              acc_referencia,acc_numero, plandesarrollo.subsistema.sub_codigo,
                                              plandesarrollo.proyecto.pro_codigo,plandesarrollo.accion.acc_codigo
                                         FROM plandesarrollo.plan_desarrollo,plandesarrollo.subsistema,plandesarrollo.proyecto,plandesarrollo.accion
                                        WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                          AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                                          AND plandesarrollo.proyecto.sub_codigo=plandesarrollo.subsistema.sub_codigo
                                          AND plandesarrollo.accion.acc_codigo=$codigo_accion";
            $resultado_plan_accion=$this->cnxion->ejecutar($sql_plan_accion);

            while ($data_plan_accion = $this->cnxion->obtener_filas($resultado_plan_accion)){
                $dataplan_accion[] = $data_plan_accion;
            }

            return $dataplan_accion;
        }

        public function formActividadPoai($codigo_actividad){
            $sql_formActividadPoai="SELECT DISTINCT acp_codigo, acp_descripcion, acc_descripcion, pro_descripcion, acp_referencia,
                                                    acp_estado, acp_vigencia, acp_numero, sub_nombre,acp_fechacreo,acc_codigo,
                                                    acp_objetivo, ain_indicador,ain_unidad
                                               FROM planaccion.actividad_poai,plandesarrollo.proyecto,plandesarrollo.subsistema,plandesarrollo.plan_desarrollo,plandesarrollo.accion, planaccion.actividad_indicador
                                              WHERE planaccion.actividad_poai.acp_proyecto=plandesarrollo.proyecto.pro_codigo
                                              AND planaccion.actividad_indicador.ain_actividad = plandesarrollo.actividad_poai.acp_codigo
                                                AND plandesarrollo.proyecto.sub_codigo=plandesarrollo.subsistema.sub_codigo
                                                AND plandesarrollo.subsistema.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                                AND plandesarrollo.accion.acc_proyecto=plandesarrollo.proyecto.pro_codigo
                                                AND planaccion.actividad_poai.acp_codigo=$codigo_actividad ";

            $resultado_formActividadPoai=$this->cnxion->ejecutar($sql_formActividadPoai);

            while ($data_aformActividadPoai = $this->cnxion->obtener_filas($resultado_formActividadPoai)){
                $dataformActividadPoai[] = $data_aformActividadPoai;
            }

            return $dataformActividadPoai;
        }

        public function acciones($codigo_planaccion){

            $codigo_planaccion=$codigo_planaccion;

            $rs_plan_accion=$this->plan_accion_consulta($codigo_planaccion);
            //return $rs_planDesarrollo;

            foreach ($rs_plan_accion as $dataplan_accion) {

                $pde_codigo = $dataplan_accion['pde_codigo'];
                $pde_nombre = $dataplan_accion['pde_nombre'];
                $sub_nombre = $dataplan_accion['sub_nombre'];
                $pro_descripcion = $dataplan_accion['pro_descripcion'];
                $acc_descripcion = $dataplan_accion['acc_descripcion'];
                $acc_referencia = $dataplan_accion['acc_referencia'];
                $acc_numero = $dataplan_accion['acc_numero'];
                $pro_codigo = $dataplan_accion['pro_codigo'];
                $acc_codigo = $dataplan_accion['acc_codigo'];
                $sub_codigo = $dataplan_accion['sub_codigo'];

                if($pde_codigo==1){
                  $referenciaAccion=$acc_referencia;
                }
                else{
                    $referenciaAccion=$acc_referencia.'.'.$acc_numero;
                }


                $rsplan_accion[] = array('pde_nombre'=> $pde_nombre,
                                    'sub_nombre'=> $sub_nombre,
                                    'pro_descripcion'=> $pro_descripcion,
                                    'acc_descripcion'=> $acc_descripcion,
                                    'pde_codigo'=> $pde_codigo,
                                    'sub_codigo'=> $sub_codigo,
                                    'pro_codigo'=> $pro_codigo,
                                    'acc_codigo'=> $acc_codigo,
                                    'referenciaAccion'=> $referenciaAccion


                                );


            }

            $datAccion=json_encode(array("data"=>$rsplan_accion));

            return $datAccion;
        }

        public function descripcion_accion($codigo_accion){

            $sql_descripcion_accion="SELECT acc_descripcion
                                FROM plandesarrollo.accion
                                WHERE acc_codigo=$codigo_accion;";

            $query_descripcion_accion=$this->cnxion->ejecutar($sql_descripcion_accion);

            $data_descripcion_accion=$this->cnxion->obtener_filas($query_descripcion_accion);

            $acc_descripcion=$data_descripcion_accion['acc_descripcion'];

            return $acc_descripcion;
        }

        public function list_anios_plan($codigo_accion){

            $sql_list_anios_plan="SELECT DISTINCT plandesarrollo.accion.acc_codigo,acc_descripcion,
                                                  acc_referencia,acc_numero, plandesarrollo.subsistema.sub_codigo,
                                                  plandesarrollo.proyecto.pro_codigo,plandesarrollo.accion.acc_codigo,
                                                  pde_yearinicio, pde_yearfin
                                             FROM plandesarrollo.plan_desarrollo, plandesarrollo.subsistema,
                                                  plandesarrollo.proyecto, plandesarrollo.accion
                                            WHERE plandesarrollo.plan_desarrollo.pde_codigo=plandesarrollo.subsistema.pde_codigo
                                              AND plandesarrollo.proyecto.pro_codigo=plandesarrollo.accion.acc_proyecto
                                              AND plandesarrollo.proyecto.sub_codigo=plandesarrollo.subsistema.sub_codigo
                                              AND plandesarrollo.accion.acc_codigo=$codigo_accion";

            $resultado_list_anios_plan=$this->cnxion->ejecutar($sql_list_anios_plan);

            $data_list_anios_plan = $this->cnxion->obtener_filas($resultado_list_anios_plan);

            $pde_yearinicio = $data_list_anios_plan['pde_yearinicio'];
            $pde_yearfin = $data_list_anios_plan['pde_yearfin'];

            return array($pde_yearinicio, $pde_yearfin);
        }

        public function list_sedes($codigo_accion){

            $sql_list_sedes="SELECT ind_codigo, ind_unidadmedida, 
                                    ind_accion, ind_estado, ind_sede,
                                    sed_nombre
                               FROM plandesarrollo.indicador,
                                    principal.sedes
                              WHERE ind_sede = sed_codigo
                                AND ind_accion = $codigo_accion
                            ORDER BY sed_nombre ASC;";

            $resultado_list_sedes=$this->cnxion->ejecutar($sql_list_sedes);

            while ($data_list_sedes = $this->cnxion->obtener_filas($resultado_list_sedes)){
                $datalist_sedes[] = $data_list_sedes;
            }
            return $datalist_sedes;
        }
    }
?>
