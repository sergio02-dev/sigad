<?php

    include('classTpoActoAdmnstratvo.php');

    class RsTpoActoAdmnstratvo extends TipoActoAdministrativo{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_tipo_acto(){

            $sql_list_tipo_acto="SELECT taa_codigo, taa_descripcion, taa_estado
                                  FROM principal.tipo_acto_administrativo;";

            $query_list_tipo_acto=$this->cnxion->ejecutar($sql_list_tipo_acto);

            while($data_list_tipo_acto=$this->cnxion->obtener_filas($query_list_tipo_acto)){
                $datalist_tipo_acto[]=$data_list_tipo_acto;
            }
            return $datalist_tipo_acto;
        }

        public function form_tipo_acto($codigo_tipo){

            $sql_form_tipo_acto="SELECT taa_codigo, taa_descripcion, taa_estado
                                   FROM principal.tipo_acto_administrativo
                                  WHERE taa_codigo = $codigo_tipo;";

            $query_form_tipo_acto=$this->cnxion->ejecutar($sql_form_tipo_acto);

            while($data_form_tipo_acto=$this->cnxion->obtener_filas($query_form_tipo_acto)){
                $dataform_tipo_acto[]=$data_form_tipo_acto;
            }
            return $dataform_tipo_acto;
        }

        public function dtaTipoActoAdmin(){

            $rs_tipoActo=$this->list_tipo_acto();
            
            if($rs_tipoActo){
                foreach ($rs_tipoActo as $dat_sector) {
                    $taa_codigo = $dat_sector['taa_codigo'];
                    $taa_descripcion = $dat_sector['taa_descripcion'];
                    $taa_estado = $dat_sector['taa_estado'];
    
                    if($taa_estado==1){
                        $estado="Activo";
                    }
                    if($taa_estado==0){
                        $estado="Inactivo";
                    }
    
                    $rsTpoActo[] = array('taa_codigo'=> $taa_codigo,
                                         'taa_descripcion'=> $taa_descripcion,
                                         'estado'=> $estado
                                    );
                }
                $dattTpoActo=json_encode(array("data"=>$rsTpoActo));
            }
            else{
                $dattTpoActo = json_encode(array("data"=>""));
            }  
            return $dattTpoActo;
        }
    }
?>