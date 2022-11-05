<?php
    include('classClasificacionPlaneacion.php');
    class RsClsfccionPlncion extends ClasificacionPlaneacion{
        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_clasificacion_plncion(){

            $sql_list_clasificacion_plncion="SELECT cpl_codigo, cpl_nombre, 
                                                    cpl_descripcion, cpl_estado
                                               FROM planaccion.clasificacion_planeacion;";

            $query_list_clasificacion_plncion=$this->cnxion->ejecutar($sql_list_clasificacion_plncion);

            while($data_list_clasificacion_plncion=$this->cnxion->obtener_filas($query_list_clasificacion_plncion)){
                $datalist_clasificacion_plncion[] = $data_list_clasificacion_plncion;
            }
            return $datalist_clasificacion_plncion;
        }

        public function dtaClasfcacionPlncion(){

            $rs_clasificacion_planeacion=$this->list_clasificacion_plncion();

            if($rs_clasificacion_planeacion){
                foreach ($rs_clasificacion_planeacion as $dat_clasificacion_fuente) {
                    $cpl_codigo = $dat_clasificacion_fuente['cpl_codigo'];
                    $cpl_nombre = $dat_clasificacion_fuente['cpl_nombre'];
                    $cpl_descripcion = $dat_clasificacion_fuente['cpl_descripcion'];
                    $cpl_estado = $dat_clasificacion_fuente['cpl_estado'];
        
                    if($cpl_estado == 1){
                        $estado = "Activo";
                    }
    
                    if($cpl_estado == 0){
                        $estado = "Inactivo";
                    }
    
                    $rsClsificacionFuente[] = array('cpl_codigo'=> $cpl_codigo,
                                                    'cpl_nombre'=> $cpl_nombre,
                                                    'cpl_descripcion'=> $cpl_descripcion,
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

        public function form_clsfccion_planeacion($codigo_clasificacion){

            $sql_form_clsfccion_planeacion="SELECT cpl_codigo, cpl_nombre, 
                                                   cpl_descripcion, cpl_estado
                                              FROM planaccion.clasificacion_planeacion
                                             WHERE cpl_codigo = $codigo_clasificacion;";

            $query_form_clsfccion_planeacion = $this->cnxion->ejecutar($sql_form_clsfccion_planeacion);

            while($data_form_clsfccion_planeacion = $this->cnxion->obtener_filas($query_form_clsfccion_planeacion)){
                $dataform_clsfccion_planeacion[] = $data_form_clsfccion_planeacion;
            }
            return $dataform_clsfccion_planeacion;
        }

    }



?>