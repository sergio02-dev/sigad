<?php
/**
 * 
 * 
*            $sqlSubsistemaFac=" SELECT DISTINCT sub_codigo
*                                FROM planaccion.actividad
*                                INNER JOIN plandesarrollo.proyecto
*                                ON  planaccion.actividad.act_proyecto = plandesarrollo.proyecto.pro_codigo
*                                ORDER BY sub_codigo ASC; ";
*            
*
**            $sqlProyectoFac="   SELECT DISTINCT act_proyecto
*                                FROM planaccion.actividad
**                                INNER JOIN plandesarrollo.proyecto
*                                ON  planaccion.actividad.act_proyecto = plandesarrollo.proyecto.pro_codigo
*                                ORDER BY act_proyecto ASC; ";
*
*
*            $sqlAccionFac=" SELECT DISTINCT act_accion
**                            FROM planaccion.actividad
**                            INNER JOIN plandesarrollo.proyecto
*                            ON  planaccion.actividad.act_proyecto = plandesarrollo.proyecto.pro_codigo
**                            ORDER BY act_accion ASC; ";
 *           }

 */
    include_once('classSbsstma.php');

    class Sbsstma extends Subsistema{

        private $cnxion;
        private $sql_selectsubsistema;
        private $datasubsistema;
        private $condicionSusbsitema;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }


        public function selectSubsistema(){

            if($this->getCodigoSubsistema()==0){
                $condicionSusbsitema="";
            }
            else{
                 $condicionSusbsitema="WHERE sub_codigo=".$this->getCodigoSubsistema()." ";
            }

            if($this->getResponsable()=="Facultad"){
                $condicionSusbsitemaIn=" WHERE sub_codigo IN ( SELECT DISTINCT sub_codigo
                                        FROM planaccion.actividad
                                        INNER JOIN plandesarrollo.proyecto
                                        ON  planaccion.actividad.act_proyecto = plandesarrollo.proyecto.pro_codigo
                                        WHERE act_dependencia=".$this->getReferenciaSubsistema()."
                                        AND act_trimestre IN(1,2,3,4)
                                        ORDER BY sub_codigo ASC ) ";
                $condicionSusbsitema="";
                $condicionSusbsitema="";
            }
            else{
                $condicionSusbsitemaIn="";
                
            }

            $sql_selectsubsistema=" SELECT sub_codigo, sub_nombre, sub_personacreo, sub_personamodifico,
                                        sub_fechacreo, sub_fechamodifico, add_codigo, pde_codigo, res_codigo, sub_referencia
                            FROM plandesarrollo.subsistema ".$condicionSusbsitema.$condicionSusbsitemaIn."; ";
            $resultado_subsistema=$this->cnxion->ejecutar($sql_selectsubsistema);

            while ($data_subsistema = $this->cnxion->obtener_filas($resultado_subsistema)){
                $datasubsistema[] = $data_subsistema;

            }

            return $datasubsistema;
        }

    

        public function selectSubsistemaPlan(){

            if($this->getCodigoSubsistema()==0){
                $condicionSusbsitema="";
            }
            else{
                $condicionSusbsitema="AND sub_codigo=".$this->getCodigoSubsistema()." ";
            }

            if($this->getResponsable()=="Facultad"){
                $condicionSusbsitemaIn="AND sub_codigo IN ( SELECT DISTINCT sub_codigo
                                        FROM planaccion.actividad
                                        INNER JOIN plandesarrollo.proyecto
                                        ON  planaccion.actividad.act_proyecto = plandesarrollo.proyecto.pro_codigo
                                        WHERE act_dependencia=".$this->getReferenciaSubsistema()."
                                        AND act_trimestre IN(1,2,2,3)
                                        ORDER BY sub_codigo ASC ) ";
                $condicionSusbsitema="";
                $condicionSusbsitema="";
            }
            else{
                $condicionSusbsitemaIn="";
                
            }

            $sql_selectsubsistema=" SELECT sub_codigo, sub_nombre, sub_personacreo, sub_personamodifico,
                                        sub_fechacreo, sub_fechamodifico, add_codigo, pde_codigo, res_codigo, sub_referencia,
                                        sub_ref
                            FROM plandesarrollo.subsistema 
                            WHERE pde_codigo=".$this->getPlanDesarrollo()." ".$condicionSusbsitema.$condicionSusbsitemaIn."; ";
            $resultado_subsistema=$this->cnxion->ejecutar($sql_selectsubsistema);

            while ($data_subsistema = $this->cnxion->obtener_filas($resultado_subsistema)){
                $datasubsistema[] = $data_subsistema;

            }

            return $datasubsistema;
        }

        public function vigencias_certificado(){

            $sql_vigencias_certificado="SELECT DISTINCT act_vigencia
                                          FROM planaccion.actividad
                                         GROUP BY act_vigencia
                                         ORDER BY act_vigencia ASC;";

            $query_vigencias_certificado=$this->cnxion->ejecutar($sql_vigencias_certificado);

            while($data_vigencias_certificado=$this->cnxion->obtener_filas($query_vigencias_certificado)){
                $datavigencias_certificado[]=$data_vigencias_certificado;
            }
            return $datavigencias_certificado;
        }

    }









?>