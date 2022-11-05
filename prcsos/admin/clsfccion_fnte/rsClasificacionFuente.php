<?php
    include('classClasificacionFuente.php');
    class RsClsfccionFnte extends ClasificacionFuente{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_clasificacion_fuente(){

            $sql_list_clasificacion_fuente="SELECT cla_codigo, cla_nombre, 
                                                   cla_descripcion, cla_estado
                                              FROM planaccion.clasificacion";

            $query_list_clasificacion_fuente=$this->cnxion->ejecutar($sql_list_clasificacion_fuente);

            while($data_list_clasificacion_fuente=$this->cnxion->obtener_filas($query_list_clasificacion_fuente)){
                $datalist_clasificacion_fuente[] = $data_list_clasificacion_fuente;
            }
            return $datalist_clasificacion_fuente;
        }

        public function dtaClasfcacionFuente(){

            $rs_clasificacion_fuente=$this->list_clasificacion_fuente();

            if($rs_clasificacion_fuente){
                foreach ($rs_clasificacion_fuente as $dat_clasificacion_fuente) {
                    $cla_codigo = $dat_clasificacion_fuente['cla_codigo'];
                    $cla_nombre = $dat_clasificacion_fuente['cla_nombre'];
                    $cla_descripcion = $dat_clasificacion_fuente['cla_descripcion'];
                    $cla_estado = $dat_clasificacion_fuente['cla_estado'];
        
                    if($cla_codigo == 1){
                        $estado = "Activo";
                    }
    
                    if($cla_codigo == 0){
                        $estado = "Inactivo";
                    }
    
                    $rsClsificacionFuente[] = array('cla_codigo'=> $cla_codigo,
                                                    'cla_nombre'=> $cla_nombre,
                                                    'cla_descripcion'=> $cla_descripcion,
                                                    'estado'=> $estado,
                                                );
                }
    
                $dtaClasificacionFuente=json_encode(array("data"=>$rsClsificacionFuente));
            }
            else{
                $dtaClasificacionFuente=json_encode(array("data"=>""));
            }
            return $dtaClasificacionFuente;
        }

        public function form_clsfccion_fuente($codigo_clasificacion){

            $sql_form_clsfccion_fuente="SELECT cla_codigo, cla_nombre, 
                                               cla_descripcion, cla_estado
                                          FROM planaccion.clasificacion
                                         WHERE cla_codigo = $codigo_clasificacion;";

            $query_form_clsfccion_fuente = $this->cnxion->ejecutar($sql_form_clsfccion_fuente);

            while($data_form_clsfccion_fuente = $this->cnxion->obtener_filas($query_form_clsfccion_fuente)){
                $dataform_clsfccion_fuente[] = $data_form_clsfccion_fuente;
            }
            return $dataform_clsfccion_fuente;
        }

    }



?>