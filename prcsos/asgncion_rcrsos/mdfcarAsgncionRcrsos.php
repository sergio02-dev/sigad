<?php
    include('classAsignacionRecurso.php');
    class MdfcarAsgncionRcrsos extends AsignacionRecursoss{

        private $updte_asignacion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
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

        public function recrso_asignado($codigo_poai, $codigo_asignacion){
      
            $sql_recurso_asignado="SELECT SUM(asre_recurso) AS recurso_asigno
                                     FROM planaccion.asignacion_recuersos_etapa
                                    WHERE asre_estado = 1 
                                      AND asre_etapa = $codigo_poai
                                      AND asre_codigo NOT IN($codigo_asignacion);";
    
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

        public function mdfcartAsgncionRcrso(){

            $updte_asignacion="UPDATE planaccion.asignacion_recuersos_etapa
                                  SET asre_etapa = ".$this->getEtapaAsignacion().", 
                                      asre_accion = ".$this->getAccion().", 
                                      asre_fuente = ".$this->getFuente().", 
                                      asre_indicador = ".$this->getIndicador().", 
                                      asre_vigenciarecurso = ".$this->getVigenciaRecurso().", 
                                      asre_vigenciapoai = ".$this->getVigenciaPoai().", 
                                      asre_recurso = ".$this->getRecurso().", 
                                      asre_estado = ".$this->getEstado().", 
                                      asre_fechamodifico = NOW(), 
                                      asre_personamodifico = ".$this->getPersonaSistema().",
                                      asre_tipo = 1
                                WHERE asre_codigo = ".$this->getCodigo().";";

            $this->cnxion->ejecutar($updte_asignacion);
            
            return $updte_asignacion;
        }
    }
?>