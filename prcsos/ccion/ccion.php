<?php 
    include('classCcion.php');
    class CcionProyecto extends Accion{
        
        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function selectAccionProyecto(){

            $sqlAccionProyecto="SELECT acc_codigo, acc_referencia, acc_descripcion, acc_lineabase, 
                                        acc_metaresultado, acc_proyecto, acc_indicador
                                FROM plandesarrollo.accion
                                WHERE acc_proyecto=".$this->getProyectoAccion().";";
            
            $queryAccionProyecto=$this->cnxion->ejecutar($sqlAccionProyecto);

            while($dataAccionProyectoo=$this->cnxion->obtener_filas($queryAccionProyecto)){
                $rsDataAccionProyecto[]=$dataAccionProyectoo;
            }
            return $rsDataAccionProyecto;
        }

        public function dataAccionProyecto(){

            $rs_accionproyecto= $this->selectAccionProyecto();

            
            foreach ($rs_accionproyecto as $datosAccionProyecto){
                
                $acc_referencia = $datosAccionProyecto['acc_referencia'];
                $acc_descripcion = $datosAccionProyecto['acc_descripcion'];
                $acc_indicador = $datosAccionProyecto['acc_indicador'];
                $acc_codigo = $datosAccionProyecto['acc_codigo'];
                
                $acc_proyecto = $datosAccionProyecto['acc_proyecto'];
                 
                

                $rsAccion[] = array('acc_referencia'=> $acc_referencia,
                                  'acc_descripcion'=> $acc_descripcion,
                                  'acc_indicador'=> $acc_indicador,
                                  'acc_codigo'=> $acc_codigo,
                                  'acc_proyecto'=> $acc_proyecto  
                                );
            }

            $dataAccionProyectoJson=json_encode(array("data"=>$rsAccion));

            return $dataAccionProyectoJson;
        }
    }
?>