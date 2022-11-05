<?php
    include('classFuentesFinanciacion.php');
    class RsFuntesFinanciacion extends FuentesFinanciacion{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_tipo_fuente(){

            $sql_list_tipo_fuente="SELECT tff_codigo, tff_nombre, tff_estado
                                     FROM planaccion.tipo_fuente_financiacion
                                    WHERE tff_estado = 1
                                    ORDER BY tff_nombre ASC;";

            $query_list_tipo_fuente=$this->cnxion->ejecutar($sql_list_tipo_fuente);

            while($data_list_tipo_fuente=$this->cnxion->obtener_filas($query_list_tipo_fuente)){
                $datalist_tipo_fuente[] = $data_list_tipo_fuente;
            }
            return $datalist_tipo_fuente;
        }

        public function clasificacion_fuente(){

            $sql_clasificacion_fuente="SELECT cla_codigo, cla_nombre, cla_descripcion, cla_estado
                                         FROM planaccion.clasificacion
                                        WHERE cla_estado = 1
                                        ORDER BY cla_nombre ASC;";

            $query_clasificacion_fuente=$this->cnxion->ejecutar($sql_clasificacion_fuente);

            while($data_clasificacion_fuente=$this->cnxion->obtener_filas($query_clasificacion_fuente)){
                $dataclasificacion_fuente[] = $data_clasificacion_fuente;
            }
            return $dataclasificacion_fuente;
        }

        public function clasificacion_planeacion(){

            $sql_clasificacion_planeacion="SELECT cpl_codigo, cpl_nombre, cpl_descripcion, cpl_estado
                                             FROM planaccion.clasificacion_planeacion
                                            WHERE cpl_estado = 1
                                            ORDER BY cpl_nombre ASC;";

            $query_clasificacion_planeacion=$this->cnxion->ejecutar($sql_clasificacion_planeacion);

            while($data_clasificacion_planeacion=$this->cnxion->obtener_filas($query_clasificacion_planeacion)){
                $dataclasificacion_planeacion[] = $data_clasificacion_planeacion;
            }
            return $dataclasificacion_planeacion;
        }

        public function lista_fuentes(){

            $sql_lista_fuentes="SELECT ffi_codigo, ffi_nombre, 
                                       ffi_descripcion, ffi_tipofuente, 
                                       ffi_estado, ffi_clasificacion,
                                       ffi_codigolinix, ffi_referencialinix,
                                       ffi_clasificacionplaneacion
                                  FROM planaccion.fuente_financiacion
                                 WHERE ffi_codigolinix NOT IN(0);";

            $query_lista_fuentes=$this->cnxion->ejecutar($sql_lista_fuentes);

            while($data_lista_fuentes=$this->cnxion->obtener_filas($query_lista_fuentes)){
                $datalista_fuentes[] = $data_lista_fuentes;
            }
            return $datalista_fuentes;
        }

        public function nombre_tipo_fuente($codigo_tipo_fuente){

            $sql_nombre_tipo_fuente="SELECT tff_codigo, tff_nombre, tff_estado
                                       FROM planaccion.tipo_fuente_financiacion
                                      WHERE tff_codigo = $codigo_tipo_fuente";

            $query_nombre_tipo_fuente=$this->cnxion->ejecutar($sql_nombre_tipo_fuente);

            $data_nombre_tipo_fuente=$this->cnxion->obtener_filas($query_nombre_tipo_fuente);

            $tff_nombre = $data_nombre_tipo_fuente['tff_nombre'];

            return $tff_nombre;
        }

        public function nombre_clasificacion($codigo_clasificacion){

            $sql_nombre_clasificacion="SELECT cla_codigo, cla_nombre
                                         FROM planaccion.clasificacion
                                        WHERE cla_codigo = $codigo_clasificacion;";

            $query_nombre_clasificacion=$this->cnxion->ejecutar($sql_nombre_clasificacion);

            $data_nombre_clasificacion=$this->cnxion->obtener_filas($query_nombre_clasificacion);

            $cla_nombre = $data_nombre_clasificacion['cla_nombre'];

            return $cla_nombre;
        }

        public function nombre_clsfcccion_plncion($codigo_clasificacion){

            $sql_nombre_clsfcccion_plncion="SELECT cpl_codigo, cpl_nombre, cpl_descripcion, cpl_estado
                                              FROM planaccion.clasificacion_planeacion
                                             WHERE cpl_codigo = $codigo_clasificacion";

            $query_nombre_clsfcccion_plncion=$this->cnxion->ejecutar($sql_nombre_clsfcccion_plncion);

            $data_nombre_clsfcccion_plncion=$this->cnxion->obtener_filas($query_nombre_clsfcccion_plncion);

            $cpl_nombre = $data_nombre_clsfcccion_plncion['cpl_nombre'];

            return $cpl_nombre;
        }

        public function dtaFuentesFinanciacion(){

            $rs_fuentes_financiacion=$this->lista_fuentes();

            if($rs_fuentes_financiacion){
                foreach ($rs_fuentes_financiacion as $dat_fuentes_financiacion) {

                    $ffi_codigo = $dat_fuentes_financiacion['ffi_codigo'];
                    $ffi_nombre = $dat_fuentes_financiacion['ffi_nombre'];
                    $ffi_descripcion = $dat_fuentes_financiacion['ffi_descripcion'];
                    $ffi_tipofuente = $dat_fuentes_financiacion['ffi_tipofuente'];
                    $ffi_estado = $dat_fuentes_financiacion['ffi_estado'];
                    $ffi_clasificacion = $dat_fuentes_financiacion['ffi_clasificacion'];
                    $ffi_codigolinix = $dat_fuentes_financiacion['ffi_codigolinix'];
                    $ffi_referencialinix = $dat_fuentes_financiacion['ffi_referencialinix'];
                    $ffi_clasificacionplaneacion = $dat_fuentes_financiacion['ffi_clasificacionplaneacion'];
    
                    $nombre_tipo_fuente = $this->nombre_tipo_fuente($ffi_tipofuente);

                    $nombre_clasificacion = $this->nombre_clasificacion($ffi_clasificacion);

                    $nombre_clsfcccion_plncion = $this->nombre_clsfcccion_plncion($ffi_clasificacionplaneacion);
    
                    if($ffi_estado == 1){
                        $estado = "Activo";
                    }
    
                    if($ffi_estado == 0){
                        $estado = "Inactivo";
                    }
    
                    $rsFuentesFinanciacion[] = array('ffi_codigo'=> $ffi_codigo,
                                                     'ffi_nombre'=> $ffi_nombre,
                                                     'ffi_descripcion'=> $ffi_descripcion,
                                                     'nombre_tipo_fuente'=> $nombre_tipo_fuente,
                                                     'estado'=> $estado,
                                                     'nombre_clasificacion'=> $nombre_clasificacion,
                                                     'ffi_codigolinix'=> $ffi_codigolinix,
                                                     'ffi_referencialinix'=> $ffi_referencialinix,
                                                     'nombre_clsfcccion_plncion'=> $nombre_clsfcccion_plncion
                                                    );
                }
    
                $dtaFuenteFinanciacionJson=json_encode(array("data"=>$rsFuentesFinanciacion));
            }
            else{
                $dtaFuenteFinanciacionJson=json_encode(array("data"=>""));
            }
            return $dtaFuenteFinanciacionJson;
        }

        public function form_fuente_financiacion($codigo_fuente){

            $sql_form_fuente_financiacion="SELECT ffi_codigo, ffi_nombre, 
                                                  ffi_descripcion, ffi_tipofuente, 
                                                  ffi_estado, ffi_clasificacion,
                                                  ffi_codigolinix, ffi_referencialinix,
                                                  ffi_clasificacionplaneacion
                                             FROM planaccion.fuente_financiacion
                                            WHERE ffi_codigo = $codigo_fuente;";

            $query_form_fuente_financiacion = $this->cnxion->ejecutar($sql_form_fuente_financiacion);

            while($data_form_fuente_financiacion = $this->cnxion->obtener_filas($query_form_fuente_financiacion)){
                $dataform_fuente_financiacion[] = $data_form_fuente_financiacion;
            }
            return $dataform_fuente_financiacion;
        }

    }



?>