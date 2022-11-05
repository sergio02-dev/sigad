<?php
    include_once('classPrycto.php');

    class Prycto extends Proyecto{

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
        public function selectProyecto(){

            $sqlProyecto=" SELECT pro_codigo, pro_descripcion, sub_codigo, pro_personacreo, pro_personamodifico, 
                                 pro_fechacreo, pro_fechamodifico, add_codigo, res_codigo, pro_referencia
                            FROM plandesarrollo.proyecto; ";
            $queryProyecto = $this->cnxion->ejecutar($sqlProyecto); 
        }


        public function selectProyectoSubsistema(){

            if($this->getResponsableProyecto()=="Facultad"){
                $condicionproyectoIn=" AND pro_codigo IN (SELECT DISTINCT act_proyecto
                                        FROM planaccion.actividad
                                        INNER JOIN plandesarrollo.proyecto
                                        ON  planaccion.actividad.act_proyecto = plandesarrollo.proyecto.pro_codigo
                                       /* WHERE planaccion.actividad.act_trimestre IN(1,2)*/
                                        WHERE planaccion.actividad.act_trimestre IN(".$this->getTrimestres().")
                                        AND act_dependencia=".$this->getReferenciaProyecto()."
                                        ORDER BY act_proyecto ASC ) ";
            }
            else{
                $condicionproyectoIn="";
            }

            $sqlProyectoSubsistema =" SELECT pro_codigo, pro_descripcion, sub_codigo, pro_personacreo, pro_personamodifico, 
                                 pro_fechacreo, pro_fechamodifico, add_codigo, res_codigo, pro_referencia, pro_numero
                            FROM plandesarrollo.proyecto
                            WHERE sub_codigo=".$this->getSubsistemaProyecto()." ".$condicionproyectoIn."
                            ORDER BY pro_codigo ASC; ";
            $queryProyectoSubsistema = $this->cnxion->ejecutar($sqlProyectoSubsistema);

            while($dataProyectoSubsistema=$this->cnxion->obtener_filas($queryProyectoSubsistema)){
                $rsProyectoSubsistema[]=$dataProyectoSubsistema;
            } 

            return $rsProyectoSubsistema;

        }

        public function totalSubsistema($codigo_subsistema){

            $sqltotalSubsistema="SELECT SUM(aco_valor) AS totalsubsistema
                                    FROM planaccion.actividad_costo, planaccion.actividad, plandesarrollo.proyecto
                                    WHERE aco_actividad=act_codigo
                                    AND act_proyecto=pro_codigo
                                    AND sub_codigo=$codigo_subsistema;";

            $querytotalSubsistema=$this->cnxion->ejecutar($sqltotalSubsistema);
            $data_totalSubsistema=$this->cnxion->obtener_filas($querytotalSubsistema);
            
            $totalSubsistema=$data_totalSubsistema['totalsubsistema'];
            
            return $totalSubsistema;
        }




    }




?>