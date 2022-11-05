<?php
    include('classAsignacionRecurso.php');
    class RgstroAsgncionRcrsos extends AsignacionRecursoss{

        private $insert_asignacion;
        private $codigoAsignacionRecursos;

        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigoAsignacionRecursos=date('YmdHis').rand(99,99999);
        }

        public function valor_etapa($codigo_poai){
    
            $sql_valor_etapa="SELECT poa_codigo, poa_recurso
                                FROM planaccion.poai
                               WHERE poa_codigo = $codigo_poai;";
    
            $query_valor_etapa=$this->cnxion->ejecutar($sql_valor_etapa);
    
            $data_valor_etapa=$this->cnxion->obtener_filas($query_valor_etapa);
    
            $poa_recurso = $data_valor_etapa['poa_recurso'];

            return $poa_recurso;
        }

        public function recrso_asignado($codigo_poai){

    
            $sql_recurso_asignado="SELECT SUM(asre_recurso) AS recurso_asigno
                                     FROM planaccion.asignacion_recuersos_etapa
                                    WHERE asre_estado = 1 
                                      AND asre_etapa = $codigo_poai;";
    
            $query_recurso_asignado=$this->cnxion->ejecutar($sql_recurso_asignado);
    
            $data_recurso_asignado=$this->cnxion->obtener_filas($query_recurso_asignado);
    
            $recurso_asigno = $data_recurso_asignado['recurso_asigno'];
    
            if($recurso_asigno){
                $gasto = $recurso_asigno;
            }
            else{
                $gasto = 0;
            }
            return $gasto;
        }

        public function insertAsgncionRcrso(){

            $insert_asignacion="INSERT INTO planaccion.asignacion_recuersos_etapa(
                                            asre_codigo, 
                                            asre_etapa, 
                                            asre_accion, 
                                            asre_fuente, 
                                            asre_indicador, 
                                            asre_vigenciarecurso, 
                                            asre_vigenciapoai, 
                                            asre_recurso, 
                                            asre_estado, 
                                            asre_fechacreo,
                                            asre_fechamodifico, 
                                            asre_personacreo, 
                                            asre_personamodifico,
                                            asre_tipo)
                                    VALUES (".$this->codigoAsignacionRecursos.", 
                                            ".$this->getEtapaAsignacion().", 
                                            ".$this->getAccion().", 
                                            ".$this->getFuente().", 
                                            ".$this->getIndicador().", 
                                            ".$this->getVigenciaRecurso().", 
                                            ".$this->getVigenciaPoai().", 
                                            ".$this->getRecurso().", 
                                            ".$this->getEstado().", 
                                            NOW(), 
                                            NOW(), 
                                            ".$this->getPersonaSistema().", 
                                            ".$this->getPersonaSistema().",
                                            1);";

            $this->cnxion->ejecutar($insert_asignacion);
            
            return $insert_asignacion;
        }
    }
?>