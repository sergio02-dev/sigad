<?php
    include('classPpi.php');
    class RsPPI extends Ppi{

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

        public function list_fuente_financiacion($codigo_plan, $tipo_fuente){

            $sql_list_fuente_financiacione="SELECT ffi_codigo, ffi_nombre, ffi_descripcion, 
                                                   ffi_tipofuente, ffi_estado
                                              FROM planaccion.fuente_financiacion
                                             WHERE ffi_codigo NOT IN(SELECT ppi_fuente FROM ppi.ppi 
                                                                    WHERE ppi_plan = $codigo_plan)
                                                AND ffi_estado = 1
                                                AND ffi_codigolinix NOT IN(0)
                                                /*AND EXTRACT(YEAR from ffi_fechacreo) >=2022*/
                                               AND ffi_tipofuente = $tipo_fuente;";

            $query_list_fuente_financiacion=$this->cnxion->ejecutar($sql_list_fuente_financiacione);

            while($data_list_fuente_financiacion=$this->cnxion->obtener_filas($query_list_fuente_financiacion)){
                $datalist_fuente_financiacion[] = $data_list_fuente_financiacion;
            }
            return $datalist_fuente_financiacion;
        }

        public function list_datos_fuentes($codigo_plan){

            $sql_list_datos_fuentes="  SELECT DISTINCT ppi_fuente, ffi_nombre, pde_nombre, 
                                              ppi_plan, ppi_codigoppi, ppi_estado,
                                              tff_codigo, tff_nombre
                                         FROM ppi.ppi, planaccion.fuente_financiacion, 
                                              plandesarrollo.plan_desarrollo,
                                              planaccion.tipo_fuente_financiacion
                                        WHERE ppi_fuente = ffi_codigo
                                          AND ppi_plan = pde_codigo
                                          AND ffi_tipofuente = tff_codigo
                                          AND ppi_plan = $codigo_plan";

            $query_list_datos_fuentes=$this->cnxion->ejecutar($sql_list_datos_fuentes);

            while($data_list_datos_fuentes=$this->cnxion->obtener_filas($query_list_datos_fuentes)){
                $datalist_datos_fuentes[] = $data_list_datos_fuentes;
            }
            return $datalist_datos_fuentes;
        }
        
        public function estado_ppi($codigo_ppi){

            $sql_estado_ppi="SELECT epp_codigo, epp_estado
                               FROM ppi.estado_ppi_plan
                              WHERE epp_codigo = $codigo_ppi;";
    
            $query_estado_ppi=$this->cnxion->ejecutar($sql_estado_ppi);
    
            $data_estado_ppi=$this->cnxion->obtener_filas($query_estado_ppi);
            
            $epp_estado = $data_estado_ppi['epp_estado'];
    
            return $epp_estado;
        }

        public function dtaTipoFuente($codigo_plan){
            $codigo_plan = $codigo_plan;

            $rs_tipo_fuente=$this->list_datos_fuentes($codigo_plan);

            if($rs_tipo_fuente){
                foreach ($rs_tipo_fuente as $dat_tipo_fuente) {
                    $ppi_fuente = $dat_tipo_fuente['ppi_fuente'];
                    $ffi_nombre = $dat_tipo_fuente['ffi_nombre'];
                    $pde_nombre = $dat_tipo_fuente['pde_nombre'];
                    $ppi_plan = $dat_tipo_fuente['ppi_plan'];
                    $ppi_codigoppi = $dat_tipo_fuente['ppi_codigoppi'];
                    $ppi_estado = $dat_tipo_fuente['ppi_estado'];
                    $tff_codigo = $dat_tipo_fuente['tff_codigo'];
                    $tff_nombre = $dat_tipo_fuente['tff_nombre'];

                    if($ppi_estado == 1){
                        $estado = "Activo";
                    }

                    if($ppi_estado == 0){
                        $estado = "Inactivo";
                    }

                    $estado_ppi = $this->estado_ppi($ppi_codigoppi);
    
                    $rsTipoFuente[] = array('ppi_fuente'=> $ppi_fuente,
                                            'ffi_nombre'=> $ffi_nombre,
                                            'pde_nombre'=> $pde_nombre,
                                            'ppi_plan'=> $ppi_plan,
                                            'ppi_codigoppi'=> $ppi_codigoppi,
                                            'estado'=> $estado,
                                            'estado_ppi'=> $estado_ppi,
                                            'tff_nombre'=> $tff_nombre
                                        );
                }
    
                $dtaTipoFuente=json_encode(array("data"=>$rsTipoFuente));
            }
            else{
                $dtaTipoFuente=json_encode(array("data"=>""));
            }
            return $dtaTipoFuente;
        }

        public function recursos_fuente($codigo_plan, $codigo_fuente){

            $sql_recursos_fuente="SELECT ppi_codigo, ppi_plan, ppi_codigoppi, 
                                         ppi_fuente, ppi_vigencia, ppi_valor, 
                                         ppi_estado
                                    FROM ppi.ppi
                                   WHERE ppi_plan = $codigo_plan
                                     AND ppi_fuente = $codigo_fuente
                                   ORDER BY ppi_vigencia ASC;";

            $query_recursos_fuente = $this->cnxion->ejecutar($sql_recursos_fuente);

            while($data_recursos_fuente = $this->cnxion->obtener_filas($query_recursos_fuente)){
                $datarecursos_fuente[] = $data_recursos_fuente;
            }
            return $datarecursos_fuente;
        }

        public function nombre_fuente($codigo_fuente){

            $sql_nombre_fuente="SELECT ffi_codigo, ffi_nombre, 
                                       ffi_descripcion, tff_nombre
                                  FROM planaccion.fuente_financiacion,
                                       planaccion.tipo_fuente_financiacion
                                 WHERE ffi_tipofuente = tff_codigo
                                   AND ffi_codigo = $codigo_fuente";

            $query_nombre_fuente = $this->cnxion->ejecutar($sql_nombre_fuente);

            $data_nombre_fuente = $this->cnxion->obtener_filas($query_nombre_fuente);

            $tff_nombre = $data_nombre_fuente['tff_nombre'];

            $ffi_nombre = $data_nombre_fuente['ffi_nombre'];

            return $tff_nombre." - ".$ffi_nombre;
        }

        public function estdo_ppi($codigo_plan, $codigo_ppi, $codigo_fuente){

            $sql_estdo_ppi="SELECT DISTINCT ppi_estado
                             FROM ppi.ppi
                            WHERE ppi_plan = $codigo_plan
                              AND ppi_codigoppi = $codigo_ppi
                              AND ppi_fuente = $codigo_fuente
                             GROUP BY ppi_estado ;";

            $query_estdo_ppi = $this->cnxion->ejecutar($sql_estdo_ppi);

            $data_estdo_ppi = $this->cnxion->obtener_filas($query_estdo_ppi);

            $ppi_estado = $data_estdo_ppi['ppi_estado'];

            return $ppi_estado;
        }

        public function valor_fuente($codigo_plan, $codigo_ppi, $codigo_fuente, $vigencia){

            $sql_valor_fuente="SELECT ppi_estado, ppi_valor
                                 FROM ppi.ppi
                                WHERE ppi_plan = $codigo_plan
                                  AND ppi_codigoppi = $codigo_ppi
                                  AND ppi_fuente = $codigo_fuente
                                  AND ppi_vigencia = $vigencia;";

            $query_valor_fuente = $this->cnxion->ejecutar($sql_valor_fuente);

            $data_valor_fuente = $this->cnxion->obtener_filas($query_valor_fuente);

            $ppi_valor = $data_valor_fuente['ppi_valor'];

            return $ppi_valor;
        }

        public function list_tipo_fuente(){

            $sql_list_tipo_fuente="SELECT tff_codigo, tff_nombre, 
                                          tff_estado, tff_descripcion
                                     FROM planaccion.tipo_fuente_financiacion
                                    WHERE tff_estado = 1;";

            $query_list_tipo_fuente = $this->cnxion->ejecutar($sql_list_tipo_fuente);

            while($data_list_tipo_fuente = $this->cnxion->obtener_filas($query_list_tipo_fuente)){
                $datalist_tipo_fuente[] = $data_list_tipo_fuente;
            }
            return $datalist_tipo_fuente;
        }

    }



?>