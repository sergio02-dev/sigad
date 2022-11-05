<?php

    include('classCcion.php');

    class Ccion extends Accion{
        
        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

         public function selectAccion(){
            $sqlAccion=" SELECT acc_codigo, acc_referencia, acc_descripcion, acc_responsable, 
                                acc_lineabase, acc_metaresultado, acc_proyecto, acc_personacreo, 
                                acc_personamodifico, acc_fechacreo, acc_fechamodifico, acc_actoadmin, 
                                acc_numerovigencia, acc_comportamiento, acc_tendenciapositiva, 
                                acc_indicador
                            FROM plandesarrollo.accion;";
            $queryAccion=$this->cnxion->ejecutar($sqlAccion);

            while($dataAccion=$this->cnxion->obtener_filas($queryAccion)){
                $rsDataAccion[]=$dataAccion;
            }

            return $rsDataAccion;
            
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

         public function selectAccionProyecto(){

            if ($this->getResponsablaAccion()=="Facultad"){
               $condicionAccionIn=" AND acc_codigo IN(SELECT DISTINCT act_accion
                                    FROM planaccion.actividad
                                    INNER JOIN plandesarrollo.proyecto
                                    ON  planaccion.actividad.act_proyecto = plandesarrollo.proyecto.pro_codigo
                                   /* AND planaccion.actividad.act_trimestre IN (1,2)*/
                                   AND planaccion.actividad.act_trimestre IN (".$this->getTrimestre().")
                                    WHERE act_dependencia=".$this->getReferenciaAccion().") ";
            }
            else{
                $condicionAccionIn="";
            }


            $sqlAccionProyecto=" SELECT acc_codigo, acc_referencia, acc_descripcion, acc_responsable, 
                                acc_lineabase, acc_metaresultado, acc_proyecto, acc_personacreo, 
                                acc_personamodifico, acc_fechacreo, acc_fechamodifico, acc_actoadmin, 
                                acc_numerovigencia, acc_comportamiento, acc_tendenciapositiva, 
                                acc_indicador, acc_numero
                            FROM plandesarrollo.accion
                            WHERE acc_proyecto=".$this->getProyectoAccion()." ".$condicionAccionIn."
                            ORDER BY acc_codigo ASC; ";
            $queryAccionProyecto=$this->cnxion->ejecutar($sqlAccionProyecto);

            while($dataAccionProyecto=$this->cnxion->obtener_filas($queryAccionProyecto)){
                $rsDataAccionProyecto[]=$dataAccionProyecto;
            }

            return $rsDataAccionProyecto;

         }
        public function totalProyecto($codigoProyecto){

            $sqltotalProyecto="SELECT SUM(aco_valor) AS totalproyecto
                                    FROM planaccion.actividad_costo, planaccion.actividad, plandesarrollo.proyecto
                                    WHERE aco_actividad=act_codigo
                                    AND act_proyecto=pro_codigo
                                    AND pro_codigo=$codigoProyecto;";

            $querytotalProyecto=$this->cnxion->ejecutar($sqltotalProyecto);
            $data_totalProyecto=$this->cnxion->obtener_filas($querytotalProyecto);
            
            $totalProyecto=$data_totalProyecto['totalproyecto'];
            
            return $totalProyecto;
        }

    }




?>