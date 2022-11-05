<?php

    class CcionCtvdadDscrpcion{

        private $sqlActividad;
        private $dataActividad;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }


        public function selectCcion($codigo_accion){
            
            $sqlselectCcion="SELECT acc_codigo, acc_referencia, acc_descripcion
                            FROM plandesarrollo.accion
                            WHERE acc_codigo=$codigo_accion; ";
            $queryselectCcion=$this->cnxion->ejecutar($sqlselectCcion);

             while($data_selectCcion=$this->cnxion->obtener_filas($queryselectCcion)){
                $dataselectCcion[]=$data_selectCcion;
            }

            return $dataselectCcion
            ;
        }
        public function selectActividad($codigo_actividad){
            
            $sqlselectActividad="SELECT act_codigo, act_descripcion
            FROM planaccion.actividad
            WHERE act_codigo=$codigo_actividad
            AND act_trimestre IN(1,2); ";
            $queryselectActividad=$this->cnxion->ejecutar($sqlselectActividad);

             while($data_selectActividad=$this->cnxion->obtener_filas($queryselectActividad)){
                $dataselectActividad[]=$data_selectActividad;
            }

            return $dataselectActividad;
        }

    }




?>