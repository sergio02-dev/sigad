<?php
    class RsCopy{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_subsistemas($codigo_plan){

            $sql_list_subsistemas="SELECT sub_codigo, sub_nombre, add_codigo, 
                                          pde_codigo, res_codigo, sub_referencia, 
                                          sub_ref
                                     FROM plandesarrollo.subsistema
                                    WHERE pde_codigo = $codigo_plan;";

            $query_list_subsistemas=$this->cnxion->ejecutar($sql_list_subsistemas);

            while($data_list_subsistemas=$this->cnxion->obtener_filas($query_list_subsistemas)){
                $datalist_subsistemas[] = $data_list_subsistemas;
            }
            return $datalist_subsistemas;
        }

        public function list_proyecto($codigo_subsistema){

            $sql_list_proyecto="SELECT pro_codigo, pro_descripcion, sub_codigo, 
                                       add_codigo, res_codigo, pro_referencia, 
                                       pro_numero, pro_objetivo
                                  FROM plandesarrollo.proyecto
                                 WHERE sub_codigo = $codigo_subsistema;";

            $query_list_proyecto=$this->cnxion->ejecutar($sql_list_proyecto);

            while($data_list_proyecto=$this->cnxion->obtener_filas($query_list_proyecto)){
                $datalist_proyecto[] = $data_list_proyecto;
            }
            return $datalist_proyecto;
        }

        public function list_accion($codigo_proyecto){

            $sql_list_accion="SELECT acc_codigo, acc_referencia, acc_descripcion, 
                                     acc_responsable, acc_lineabase, acc_metaresultado, 
                                     acc_proyecto, acc_actoadmin, acc_numerovigencia, 
                                     acc_comportamiento, acc_tendenciapositiva, acc_indicador, 
                                     acc_numero
                                FROM plandesarrollo.accion
                               WHERE acc_proyecto = $codigo_proyecto;";

            $query_list_accion=$this->cnxion->ejecutar($sql_list_accion);

            while($data_list_accion=$this->cnxion->obtener_filas($query_list_accion)){
                $datalist_accion[] = $data_list_accion;
            }
            return $datalist_accion;
        }



    }

?>