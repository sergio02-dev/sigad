<?php
    include('classTipoFuente.php');
    class RsTpoFnte extends TipoFuente{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_tipo_fuente(){

            $sql_list_tipo_fuente="SELECT tff_codigo, tff_nombre, 
                                          tff_estado, tff_descripcion
                                     FROM planaccion.tipo_fuente_financiacion;";

            $query_list_tipo_fuente=$this->cnxion->ejecutar($sql_list_tipo_fuente);

            while($data_list_tipo_fuente=$this->cnxion->obtener_filas($query_list_tipo_fuente)){
                $datalist_tipo_fuente[] = $data_list_tipo_fuente;
            }
            return $datalist_tipo_fuente;
        }

        public function dtaTipoFuente(){

            $rs_tipo_fuente=$this->list_tipo_fuente();

            if($rs_tipo_fuente){
                foreach ($rs_tipo_fuente as $dat_tipo_fuente) {
                    $tff_codigo = $dat_tipo_fuente['tff_codigo'];
                    $tff_nombre = $dat_tipo_fuente['tff_nombre'];
                    $tff_estado = $dat_tipo_fuente['tff_estado'];
                    $tff_descripcion = $dat_tipo_fuente['tff_descripcion'];
        
                    if($tff_estado == 1){
                        $estado = "Activo";
                    }
    
                    if($tff_estado == 0){
                        $estado = "Inactivo";
                    }
    
                    $rsTipoFuente[] = array('tff_codigo'=> $tff_codigo,
                                            'tff_nombre'=> $tff_nombre,
                                            'tff_descripcion'=> $tff_descripcion,
                                            'estado'=> $estado,
                                        );
                }
    
                $dtaTipoFuente=json_encode(array("data"=>$rsTipoFuente));
            }
            else{
                $dtaTipoFuente=json_encode(array("data"=>""));
            }
            return $dtaTipoFuente;
        }

        public function form_tipo_fuente($codigo_tipo_fuente){

            $sql_form_tipo_fuente="SELECT tff_codigo, tff_nombre, 
                                          tff_estado, tff_descripcion
                                     FROM planaccion.tipo_fuente_financiacion
                                    WHERE tff_codigo = $codigo_tipo_fuente;";

            $query_form_tipo_fuente = $this->cnxion->ejecutar($sql_form_tipo_fuente);

            while($data_form_tipo_fuente = $this->cnxion->obtener_filas($query_form_tipo_fuente)){
                $dataform_tipo_fuente[] = $data_form_tipo_fuente;
            }
            return $dataform_tipo_fuente;
        }

    }



?>