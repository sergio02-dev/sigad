<?php

    include_once('classCtvdad.php');

    class Ctvdad extends Actividad{

        private $sqlActividad;
        private $dataActividad;

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

        public function vigencia(){

            $sqlvigencia="SELECT DISTINCT apr_trimestres
                                    FROM planaccion.apertura_reporte
                                    WHERE apr_trim IS NOT NULL;";
    
            $queryvigencia=$this->cnxion->ejecutar($sqlvigencia);
    
            while($data_vigencia=$this->cnxion->obtener_filas($queryvigencia)){
                $datavigencia[]=$data_vigencia;
            }
            return $datavigencia;
        }

        public function selectActividad($subsistema, $trimestreshow){             
            
            $sqlActividad=" SELECT act_codigo, acc_descripcion, act_descripcion, act_fechaexpedicion, act_accion, 
                                act_proyecto, act_dependencia, act_referencia, act_estado, act_fechacreo, 
                                act_fechamodifico, act_personacreo, act_personamodifico, pro_descripcion, 
                                aco_valor, aco_vigencia, act_certificado, acc_referencia
                            FROM planaccion.actividad,plandesarrollo.proyecto,plandesarrollo.accion, planaccion.actividad_costo
                            WHERE planaccion.actividad.act_proyecto=plandesarrollo.proyecto.pro_codigo
                            AND planaccion.actividad.act_accion=plandesarrollo.accion.acc_codigo
                            AND planaccion.actividad_costo.aco_actividad=planaccion.actividad.act_codigo
                            AND planaccion.actividad_costo.aco_vigencia=2019
                            /*AND planaccion.actividad.act_trimestre IN(1,2)*/
                            AND planaccion.actividad.act_trimestre IN($trimestreshow)
                            AND plandesarrollo.proyecto.sub_codigo=$subsistema; ";
            $queryActividad=$this->cnxion->ejecutar($sqlActividad);

             while($data_actividad=$this->cnxion->obtener_filas($queryActividad)){
                $dataActividad[]=$data_actividad;
            }

            $this->dataActividad=$dataActividad;
        }


        public function dataActividad(){
        
            $rs_actividad=$this->dataActividad;
            
            foreach ($rs_actividad as $datosActividad) {
                
                $act_codigo = $datosActividad['act_codigo'];
                $pro_descripcion = $datosActividad['pro_descripcion'];
                $act_referencia = $datosActividad['act_referencia'];
                $acc_referencia = $datosActividad['acc_referencia']; 
                $acc_descripcion = $datosActividad['acc_descripcion']; 
                $act_descripcion = $datosActividad['act_descripcion'];
                $act_certificado = $datosActividad['act_certificado'];
                $aco_valor ="$".number_format($datosActividad['aco_valor'], 0, ',', ',');
                $act_fechaexpedicion=date('d/m/Y',strtotime($datosActividad['act_fechaexpedicion']));
 
                 $rsActividad[] = array('pro_descripcion'=> $pro_descripcion, 
                                   'acc_referencia'=> $acc_referencia, 
                                   'acc_descripcion'=> $acc_descripcion, 
                                   'act_descripcion'=> $act_descripcion,
                                   'act_certificado'=> $act_certificado,
                                   'aco_valor' => $aco_valor,
                                   'act_fechaexpedicion' => $act_fechaexpedicion,
                                   'act_codigo' => $act_codigo,
                                   'act_referencia' => $act_referencia
                                  );

            }

                $datActividadJson=json_encode(array("data"=>$rsActividad));
                
                return $datActividadJson;



        }


    }




?>