<?php
include_once('classTpoctvdad.php');

    class TpoCtvdad extends TipoActividad{

        private $sqlTipoActividad;
        private $dataTipoActividad;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }


        public function selectTipoACtividad(){
            $sqlTipoActividad=" SELECT tac_codigo, tac_nombre, tac_descripcion, tac_personacreo, tac_personamodifico, 
                                      tac_fechacreo, tac_fechamodifico
                                FROM planaccion.tipo_actividad; ";
             $queryTipoActividad=$this->cnxion->ejecutar($sqlTipoActividad);

             while($data_tipoactividad=$this->cnxion->obtener_filas($queryTipoActividad)){
                $dataTipoActividad[]=$data_tipoactividad;
            }

            //$this->dataTipoActividad=$dataTipoActividad;

            return $dataTipoActividad;
            
        }

        public function accion_actividad($act_codigo){

            $sql_accion_actividad="SELECT act_codigo, act_descripcion
                                 FROM planaccion.actividad
                                WHERE act_codigo=$act_codigo;";

            $query_accion_actividad=$this->cnxion->ejecutar($sql_accion_actividad);

            $data_accion_actividad=$this->cnxion->obtener_filas($query_accion_actividad);

            $act_descripcion=$data_accion_actividad['act_descripcion'];

            return $act_descripcion; 
        }


    }

    ?>