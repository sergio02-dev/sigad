<?php
    include('classPpi.php');
    class RsRprtePPI extends Ppi{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function anios_plan($codigo_plan){

            $sql_anios_plan="SELECT pde_codigo, pde_nombre, pde_yearinicio, pde_yearfin
                               FROM plandesarrollo.plan_desarrollo
                              WHERE pde_codigo = $codigo_plan;";

            $query_anios_plan=$this->cnxion->ejecutar($sql_anios_plan);

            $data_anios_plan=$this->cnxion->obtener_filas($query_anios_plan);

            $pde_yearinicio = $data_anios_plan['pde_yearinicio'];
            $pde_yearfin = $data_anios_plan['pde_yearfin'];

            return array($pde_yearinicio, $pde_yearfin);
        }

        public function list_fuentes($codigo_plan, $codigo_ppi){

            $sql_list_fuentes="SELECT DISTINCT ppi_fuente, ffi_nombre, ffi_tipofuente
                                 FROM ppi.ppi, planaccion.fuente_financiacion
                                WHERE ppi_fuente = ffi_codigo
                                  AND ppi_estado = 1
                                  AND ppi_plan = $codigo_plan
                                  AND ppi_codigoppi = $codigo_ppi
                                GROUP BY ppi_fuente, ffi_nombre, ffi_tipofuente
                                ORDER BY ffi_tipofuente, ffi_nombre, ppi_fuente";

            $query_list_fuentes=$this->cnxion->ejecutar($sql_list_fuentes);

            while($data_list_fuentes=$this->cnxion->obtener_filas($query_list_fuentes)){
                $datalist_fuentes[] = $data_list_fuentes;
            }
            return $datalist_fuentes;
        }

        public function numero_fuentes($codigo_plan, $codigo_ppi, $tipo_fuente){

            $sql_numero_fuentes ="SELECT COUNT(DISTINCT ppi_fuente) AS cantidad_fuentes
                                    FROM ppi.ppi, planaccion.fuente_financiacion
                                   WHERE ppi_fuente = ffi_codigo
                                     AND ppi_estado = 1
                                     AND ffi_tipofuente = $tipo_fuente
                                     AND ppi_plan = $codigo_plan
                                     AND ppi_codigoppi = $codigo_ppi;";

            $query_numero_fuentes = $this->cnxion->ejecutar($sql_numero_fuentes);

            $data_numero_fuentes = $this->cnxion->obtener_filas($query_numero_fuentes);

            $cantidad_fuentes = $data_numero_fuentes['cantidad_fuentes'];

            return $cantidad_fuentes;
        }

        public function recurso_fuente_vigencia($codigo_plan, $codigo_ppi, $vigencia, $codigo_fuente){

            $sql_recurso_fuente_vigencia="SELECT ppi_codigo, ppi_plan, ppi_codigoppi, 
                                                 ppi_fuente, ppi_vigencia, ppi_valor, 
                                                 ppi_estado
                                            FROM ppi.ppi
                                           WHERE ppi_estado = 1
                                             AND ppi_plan = $codigo_plan
                                             AND ppi_codigoppi = $codigo_ppi
                                             AND ppi_vigencia = $vigencia
                                             AND ppi_fuente = $codigo_fuente;";
    
            $query_recurso_fuente_vigencia=$this->cnxion->ejecutar($sql_recurso_fuente_vigencia);
    
            $data_recurso_fuente_vigencia=$this->cnxion->obtener_filas($query_recurso_fuente_vigencia);
            
            $ppi_valor = $data_recurso_fuente_vigencia['ppi_valor'];
    
            return $ppi_valor;
        }

        public function recursos_totales_fuente($codigo_plan, $codigo_ppi, $codigo_fuente){

            $sql_recursos_totales_fuente="SELECT SUM(ppi_valor) AS valor_total_fuente
                                            FROM ppi.ppi
                                           WHERE ppi_estado = 1
                                             AND ppi_plan = $codigo_plan
                                             AND ppi_codigoppi = $codigo_ppi
                                             AND ppi_fuente = $codigo_fuente;";
    
            $query_recursos_totales_fuente=$this->cnxion->ejecutar($sql_recursos_totales_fuente);
    
            $data_recursos_totales_fuente=$this->cnxion->obtener_filas($query_recursos_totales_fuente);
            
            $valor_total_fuente = $data_recursos_totales_fuente['valor_total_fuente'];
    
            return $valor_total_fuente;
        }

        public function recursos_ppi_vigencia($codigo_plan, $codigo_ppi, $codigo_vigencia){

            $sql_recursos_ppi_vigencia="SELECT SUM(ppi_valor) AS valor_total_vigencia
                                            FROM ppi.ppi
                                           WHERE ppi_estado = 1
                                             AND ppi_plan = $codigo_plan
                                             AND ppi_codigoppi = $codigo_ppi
                                             AND ppi_vigencia = $codigo_vigencia;";
    
            $query_recursos_ppi_vigencia=$this->cnxion->ejecutar($sql_recursos_ppi_vigencia);
    
            $data_recursos_ppi_vigencia=$this->cnxion->obtener_filas($query_recursos_ppi_vigencia);
            
            $valor_total_vigencia = $data_recursos_ppi_vigencia['valor_total_vigencia'];
    
            return $valor_total_vigencia;
        }

        public function recurso_final($codigo_plan, $codigo_ppi){

            $sql_recurso_final="SELECT SUM(ppi_valor) AS valor_ppi
                                  FROM ppi.ppi
                                 WHERE ppi_estado = 1
                                   AND ppi_plan = $codigo_plan
                                   AND ppi_codigoppi = $codigo_ppi";
    
            $query_recurso_final=$this->cnxion->ejecutar($sql_recurso_final);
    
            $data_recurso_final=$this->cnxion->obtener_filas($query_recurso_final);
            
            $valor_ppi = $data_recurso_final['valor_ppi'];
    
            return $valor_ppi;
        }

    }

?>