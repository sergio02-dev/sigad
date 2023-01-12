<?php
    include('classPlanCompras.php');
    class RsPlanCmpras extends PlanCompras{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function datos_etapa($codigo_etapa){

            $sql_datos_etapa="SELECT poa_codigo, poa_referencia, 
                                     poa_objeto, poa_numero
                                FROM planaccion.poai
                               WHERE poa_codigo = $codigo_etapa;";
    
            $query_datos_etapa = $this->cnxion->ejecutar($sql_datos_etapa);
    
            $data_datos_etapa = $this->cnxion->obtener_filas($query_datos_etapa);
            
            $poa_referencia = $data_datos_etapa['poa_referencia'];
            $poa_numero = $data_datos_etapa['poa_numero'];
            $poa_objeto = $data_datos_etapa['poa_objeto'];

            $descripcion = "<strong>".$poa_referencia.".".$poa_numero."</strong><br/>".$poa_objeto;
            
            return $descripcion;
        }

        public function list_plan_cmpras($codigo_plan_cmpra){

            $sql_list_plan_cmpras="SELECT pdi_codigo,pdi_dependencia, pdi_area, 
                                          pdi_equipodescripcion, pdi_valorunitario, pdi_cantidad
                                        FROM usco.formulariopdi
                                      WHERE pdi_accion = $codigo_plan_cmpra
                                    ORDER BY pdi_equipodescripcion ASC;";

            $query_list_plan_cmpras=$this->cnxion->ejecutar($sql_list_plan_cmpras);
            while($data_list_plan_cmpras=$this->cnxion->obtener_filas($query_list_plan_cmpras)){
                $datalist_plan_cmpras[]=$data_list_plan_cmpras;
            }
            return $datalist_plan_cmpras;
        }
    }
?>
