<?php

    include('classEps.php');

    class RsEps extends Eps{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_eps(){

            $sql_list_eps="SELECT eps_codigo, eps_descripcion, eps_estado
                             FROM principal.eps;";

            $query_list_eps=$this->cnxion->ejecutar($sql_list_eps);

            while($data_list_eps=$this->cnxion->obtener_filas($query_list_eps)){
                $datalist_eps[]=$data_list_eps;
            }
            return $datalist_eps;
        }

        public function form_eps($codigo_pregunta){

            $sql_form_eps="SELECT eps_codigo, eps_descripcion, eps_estado
                             FROM principal.eps
                            WHERE eps_codigo = $codigo_pregunta;";

            $query_form_eps=$this->cnxion->ejecutar($sql_form_eps);

            while($data_form_eps=$this->cnxion->obtener_filas($query_form_eps)){
                $dataform_eps[]=$data_form_eps;
            }
            return $dataform_eps;
        }

        public function dataEps(){

            $rs_eps=$this->list_eps();
            
            if($rs_eps){
                foreach ($rs_eps as $dta_eps) {
                    $eps_codigo=$dta_eps['eps_codigo'];
                    $eps_descripcion=$dta_eps['eps_descripcion'];
                    $eps_estado=$dta_eps['eps_estado'];
    
                    if($eps_estado==1){
                        $estado="Activo";
                    }
                    if($eps_estado==0){
                        $estado="Inactivo";
                    }
    
                    $rsEps[] = array('eps_codigo'=> $eps_codigo,
                                     'eps_descripcion'=> $eps_descripcion,
                                     'estado'=> $estado
                                    );
                }
                $datEps=json_encode(array("data"=>$rsEps));
            }
            else{
                $datEps = "";
            }  
            return $datEps;
        }
    }
?>