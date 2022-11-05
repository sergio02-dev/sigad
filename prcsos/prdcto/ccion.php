<?php

    include_once('classCcion.php');

    class Ccion extends Accion{

        private $sqlAccion;
        private $SubsistemaAccion;
        private $dataAccion;
        

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->SubsistemaAccion = $this->getCodigoSubsistema();
        }

        public function selectAccion($SubsistemaAccion){
            

            $sqlAccion=" SELECT acc_codigo, acc_referencia, acc_descripcion, acc_responsable, acc_lineabase, acc_metaresultado, acc_proyecto, acc_personacreo, acc_personamodifico,
                                  acc_fechacreo, acc_fechamodifico, acc_actoadmin, acc_numerovigencia, acc_comportamiento, acc_tendenciapositiva, acc_indicador,
                                  pro_descripcion, sub_codigo
                                  FROM plandesarrollo.accion,plandesarrollo.proyecto
                                  WHERE plandesarrollo.accion.acc_proyecto=plandesarrollo.proyecto.pro_codigo
                                  AND sub_codigo=".$SubsistemaAccion."
                                  ORDER BY acc_codigo ASC ";

            $queryAccion=$this->cnxion->ejecutar($sqlAccion);
            while($data_accion=$this->cnxion->obtener_filas($queryAccion)){
                $dataAccion[]=$data_accion;
            }

            //return $sqlAccion;
            $this->dataAccion=$dataAccion;
        }

        public function dataAccion(){
        
            $rs_accion=$this->dataAccion;
            
            foreach ($rs_accion as $datosAccion) {
                
                $acc_codigo=$datosAccion['acc_codigo'];
                $acc_referencia=$datosAccion['acc_referencia'];
                $acc_descripcion=$datosAccion['acc_descripcion'];
                $acc_lineabase=$datosAccion['acc_lineabase'];
                $acc_metaresultado=$datosAccion['acc_metaresultado'];
                $pro_descripcion=$datosAccion['pro_descripcion'];
                
                $rsAccion[] = array('acc_codigo'=> $acc_codigo, 
                                   'acc_referencia'=> $acc_referencia, 
                                   'acc_descripcion'=> $acc_descripcion, 
                                   'acc_lineabase'=> $acc_lineabase,
                                   'acc_metaresultado'=> $acc_metaresultado, 
                                   'pro_descripcion'=> $pro_descripcion 
                                   );

            }

                $datAccionJson=json_encode(array("data"=>$rsAccion));
                
                return $datAccionJson;



        }


    }



?>