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
                                                    acp_objetivo,acp_unidad, acp_sedeindicador
                                               FROM planaccion.actividad_poai,plandesarrollo.proyecto,plandesarrollo.subsistema,plandesarrollo.plan_desarrollo,plandesarrollo.accion
                                              WHERE planaccion.actividad_poai.acp_proyecto=plandesarrollo.proyecto.pro_codigo
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

        public function check_arreglo($codigo_actividad, $codigo_indicador){
        
            $sql_check_arreglo  = "SELECT COUNT(*) checkbox
                                         FROM planaccion.actividad_indicador
                                        WHERE ain_actividad = $codigo_actividad
                                        AND ain_indicador = $codigo_indicador
                                        AND ain_estado = 1;";
            
    
            $resultado_check_arreglo  = $this->cnxion->ejecutar($sql_check_arreglo);
    
            $data_check_arreglo = $this->cnxion->obtener_filas($resultado_check_arreglo);
    
            $checkbox = $data_check_arreglo['checkbox'];
    
            if($checkbox == 0){
                $checkear = "";
            }
            else{
                $checkear = "checked";
            }
    
            return $checkear;
        }

        public function check_sedes_indicador($codigo_actividad, $codigo_indicador){
        
            $sql_check_arreglo  = "SELECT ain_indicador, ain_unidad
                                     FROM planaccion.actividad_indicador
                                    WHERE ain_actividad = $codigo_actividad
                                      AND ain_indicador = $codigo_indicador
                                      AND ain_estado = 1;";
    
            $resultado_check_arreglo  = $this->cnxion->ejecutar($sql_check_arreglo);

            $numero_filas = $this->cnxion->numero_filas($resultado_check_arreglo);

            if($numero_filas== 0){
                $data_check_arreglo = $this->cnxion->obtener_filas($resultado_check_arreglo);
                $checkedIndicador = "";
                $valor_unidad = "none";
                $unidad = 0;
                $campo_val = 0;
            }
            else{
                $data_check_arreglo = $this->cnxion->obtener_filas($resultado_check_arreglo);
    
                $checkedIndicador = "checked";
                $valor_unidad = "block";
                $unidad =  $data_check_arreglo['ain_unidad'];
                $campo_val = 1;
            }
    
            return array($checkedIndicador, $valor_unidad, $unidad, $campo_val);
        }

        public function check_sedeIndicador($codigo_actividad, $codigo_indicador){
        
            $sql_check_sedeIndicador  = "SELECT COUNT(*) checkbox
                                         FROM planaccion.actividad_poai
                                        WHERE acp_codigo = $codigo_actividad
                                        AND acp_sedeindicador = $codigo_indicador
                                        AND acp_estado = '1';";
            
    
            $resultado_check_sedeIndicador  = $this->cnxion->ejecutar($sql_check_sedeIndicador);
    
            $data_check_sedeIndicador = $this->cnxion->obtener_filas($resultado_check_sedeIndicador);
    
            $checkbox = $data_check_sedeIndicador['checkbox'];
    
            if($checkbox == 0){
                $checkear = "";
            }
            else{
                $checkear = "checked";
            }
    
            return $checkear;
        }

        public function unidad_sedeindicador($codigo_indicador,$codigo_actividad){
            
            $sql_unidad_sedeindicador="SELECT ain_unidad
                                   FROM planaccion.actividad_indicador
                                  WHERE ain_actividad = $codigo_actividad
                                  AND ain_indicador = $codigo_indicador
                                  AND ain_estado = 1;";

            $resultado_unidad_sedeindicador=$this->cnxion->ejecutar($sql_unidad_sedeindicador);

            $data_unidad_sedeindicador = $this->cnxion->obtener_filas($resultado_unidad_sedeindicador);

            $ain_unidad = $data_unidad_sedeindicador['ain_unidad'];

            return $ain_unidad;
        }

        public function sedeIndicador($actividad_code){
            $sql_sede_indicador = "SELECT  ain_indicador
                                    WHERE ain_actividad = $actividad_code";

            $resultado_sede_indicador=$this->cnxion->ejecutar($sql_sede_indicador);

            $data_sede_indicador = $this->cnxion->obtener_filas($resultado_sede_indicador);
            $ain_indicador = $data_sede_indicador['ain_indicador'];
            

            return $ain_indicador;

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
