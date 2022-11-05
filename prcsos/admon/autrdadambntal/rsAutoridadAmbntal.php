<?php

    include('classAutrdadAmbntal.php');

    class RsAutoridadAmbiental extends Autoridad{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_autoridad_ambiental(){

            $sql_list_autoridad_ambiental="SELECT aam_codigo, aam_numero, aam_descripcion, 
                                                  aam_siglas, aam_estado
                                             FROM principal.autoridad_ambiental;";

            $query_list_autoridad_ambiental=$this->cnxion->ejecutar($sql_list_autoridad_ambiental);

            while($data_list_autoridad_ambiental=$this->cnxion->obtener_filas($query_list_autoridad_ambiental)){
                $datalist_autoridad_ambiental[]=$data_list_autoridad_ambiental;
            }
            return $datalist_autoridad_ambiental;
        }

        public function form_ambiental($codigo_ambiental){

            $sql_form_ambiental="SELECT aam_codigo, aam_numero, aam_descripcion, 
                                        aam_siglas, aam_estado
                                   FROM principal.autoridad_ambiental
                                  WHERE aam_codigo = $codigo_ambiental;";

            $query_form_ambiental=$this->cnxion->ejecutar($sql_form_ambiental);

            while($data_form_ambiental=$this->cnxion->obtener_filas($query_form_ambiental)){
                $dataform_ambiental[]=$data_form_ambiental;
            }
            return $dataform_ambiental;
        }

        public function dtaAmbiental(){

            $rs_ambiental=$this->list_autoridad_ambiental();
            
            if($rs_ambiental){
                foreach ($rs_ambiental as $dat_ambiental) {
                    $aam_codigo = $dat_ambiental['aam_codigo'];
                    $aam_numero = $dat_ambiental['aam_numero'];
                    $aam_descripcion = $dat_ambiental['aam_descripcion'];
                    $aam_siglas = $dat_ambiental['aam_siglas'];
                    $aam_estado = $dat_ambiental['aam_estado'];

                    if($aam_estado==1){
                        $estado="Activo";
                    }
                    if($aam_estado==0){
                        $estado="Inactivo";
                    }
    
                    $rsAmbntal[] = array('aam_codigo'=> $aam_codigo,
                                         'aam_numero'=> $aam_numero,
                                         'aam_descripcion'=> $aam_descripcion,
                                         'aam_siglas'=> $aam_siglas,
                                         'estado'=> $estado
                                    );
                }
                $dattAmbiental=json_encode(array("data"=>$rsAmbntal));
            }
            else{
                $dattAmbiental = json_encode(array("data"=>""));
            }  
            return $dattAmbiental;
        }
    }
?>