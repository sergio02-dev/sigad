<?php
    class RprteRcrsosPoiaEtpa{
        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function subSistemasPlanDesarrollo($codigo_planDesarrollo){

            
            $sql_subSistemasPlanDesarrollo="SELECT sub_codigo, sub_nombre, 
                                                pde_codigo, sub_referencia, sub_ref
                                            FROM plandesarrollo.subsistema
                                            WHERE pde_codigo=$codigo_planDesarrollo;";

            $resultado_subSistemasPlanDesarrollo=$this->cnxion->ejecutar($sql_subSistemasPlanDesarrollo);

            while ($data_subSistemasPlanDesarrollo = $this->cnxion->obtener_filas($resultado_subSistemasPlanDesarrollo)){
                $datasubSistemasPlanDesarrollo[] = $data_subSistemasPlanDesarrollo;
            }
            return $datasubSistemasPlanDesarrollo;
        }

        public function proyecto_subsistema($sub_codigo){

            $sql_proyecto_subsistema="SELECT pro_codigo, pro_descripcion, sub_codigo, 
                                             add_codigo, res_codigo, pro_referencia, 
                                             pro_numero, pro_objetivo
                                        FROM plandesarrollo.proyecto
                                       WHERE sub_codigo = $sub_codigo
                                       ORDER BY pro_numero ASC;";
    
            $resultado_proyecto_subsistema=$this->cnxion->ejecutar($sql_proyecto_subsistema);
    
            while ($data_proyecto_subsistema = $this->cnxion->obtener_filas($resultado_proyecto_subsistema)){
                $dataproyecto_subsistema[] = $data_proyecto_subsistema;
    
            }
            return $dataproyecto_subsistema;
        }
    
    
        public function accion_proyecto($pro_codigo){
    
            $sql_accion_proyecto="SELECT acc_codigo, acc_referencia, 
                                         acc_descripcion, acc_responsable, 
                                         acc_proyecto, acc_numero
                                     FROM plandesarrollo.accion
                                    WHERE acc_proyecto =$pro_codigo
                                    ORDER BY acc_numero ASC;";
    
            $resultado_accion_proyecto=$this->cnxion->ejecutar($sql_accion_proyecto);
    
            while ($data_accion_proyecto = $this->cnxion->obtener_filas($resultado_accion_proyecto)){
                $dataaccion_proyecto[] = $data_accion_proyecto;
            }
            return $dataaccion_proyecto;
        }
    
        public function nombreNivelUno($codigo_planDesarrollo){
    
            $sql_nombreNivelUno="SELECT pde_niveluno
                                   FROM plandesarrollo.plan_desarrollo
                                  WHERE pde_codigo = $codigo_planDesarrollo;";
    
            $query_nombreNivelUno=$this->cnxion->ejecutar($sql_nombreNivelUno);
    
            $data_nombreNivelUno=$this->cnxion->obtener_filas($query_nombreNivelUno);
            
            $pde_niveluno = $data_nombreNivelUno['pde_niveluno'];
            
            return $pde_niveluno;
        }
    
        public function nombreNivelDos($codigo_planDesarrollo){
    
            $sql_nombreNivelDos="SELECT pde_niveldos
                                    FROM plandesarrollo.plan_desarrollo
                                   WHERE pde_codigo=$codigo_planDesarrollo;";
    
            $resultado_nombreNivelDos=$this->cnxion->ejecutar($sql_nombreNivelDos);
    
            $data_nombreNivelDos = $this->cnxion->obtener_filas($resultado_nombreNivelDos);
    
            $pde_niveldos = $data_nombreNivelDos['pde_niveldos'];
    
            return $pde_niveldos;
        }
    
        public function nombreNivelTres($codigo_planDesarrollo){
    
            $sql_nombreNivelTres="SELECT pde_niveltres
                                    FROM plandesarrollo.plan_desarrollo
                                   WHERE pde_codigo=$codigo_planDesarrollo;";
    
            $resultado_nombreNivelTres=$this->cnxion->ejecutar($sql_nombreNivelTres);
    
            $data_nombreNivelTres = $this->cnxion->obtener_filas($resultado_nombreNivelTres);
    
            $pde_niveltres=$data_nombreNivelTres['pde_niveltres'];
    
            return $pde_niveltres;
        }

        public function actividadPoai($codigo_Accion, $vigencia){

            $sql_actividadPoai="SELECT acp_codigo, acp_descripcion, acp_accion, 
                                       acp_proyecto, acp_referencia, acp_estado,
                                       acp_fechacreo, acp_fechamodifico, acp_personacreo, 
                                       acp_personamodifico, acp_vigencia, acp_numero,
                                       acp_oficina, acp_cargo, acp_sedeindicador, 
                                       acp_unidad, acp_objetivo
                                  FROM planaccion.actividad_poai
                                 WHERE acp_estado = '1'
                                   AND acp_accion = $codigo_Accion
                                   AND acp_vigencia = $vigencia
                                 ORDER BY acp_numero ASC;";
    
            $resultado_actividadPoai=$this->cnxion->ejecutar($sql_actividadPoai);
    
            while ($data_actividadPoai = $this->cnxion->obtener_filas($resultado_actividadPoai)){
                $dataactividadPoai[] = $data_actividadPoai;
            }
            return $dataactividadPoai;
        }

        public function etapas($codigo_actividad){

            $sql_etapas="SELECT poa_codigo, poa_referencia, 
                                poa_numero, poa_objeto, poa_recurso
                           FROM planaccion.poai
                          WHERE acp_codigo=$codigo_actividad
                          ORDER BY poa_numero ASC;";
    
            $resultado_etapas=$this->cnxion->ejecutar($sql_etapas);
    
            while ($data_etapas = $this->cnxion->obtener_filas($resultado_etapas)){
                $dataetapas[] = $data_etapas;
            }
            return $dataetapas;
        }
    }
    

?>