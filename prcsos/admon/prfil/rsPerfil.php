<?php

    include('classPerfil.php');

    class RsPerfil extends Perfil{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_perfil(){

            $sql_list_perfil="SELECT prf_codigo, prf_nombre, prf_estado
                                FROM principal.perfil;";

            $query_list_perfil=$this->cnxion->ejecutar($sql_list_perfil);

            while($data_list_perfil=$this->cnxion->obtener_filas($query_list_perfil)){
                $datalist_perfil[]=$data_list_perfil;
            }
            return $datalist_perfil;
        }

        public function form_perfil($codigo_perfil){

            $sql_form_perfil="SELECT prf_codigo, prf_nombre, prf_estado
                                FROM principal.perfil
                               WHERE prf_codigo = $codigo_perfil;";

            $query_form_perfil=$this->cnxion->ejecutar($sql_form_perfil);

            while($data_form_perfil=$this->cnxion->obtener_filas($query_form_perfil)){
                $dataform_perfil[]=$data_form_perfil;
            }
            return $dataform_perfil;
        }

        public function dataPerfil(){

            $rs_perfil=$this->list_perfil();
            
            if($rs_perfil){
                foreach ($rs_perfil as $dat_perfil) {
                    $prf_codigo=$dat_perfil['prf_codigo'];
                    $prf_nombre=$dat_perfil['prf_nombre'];
                    $prf_estado=$dat_perfil['prf_estado'];
    
                    if($prf_estado==1){
                        $estado="Activo";
                    }
                    if($prf_estado==0){
                        $estado="Inactivo";
                    }
    
                    $rsPerfil[] = array('prf_codigo'=> $prf_codigo,
                                        'prf_nombre'=> $prf_nombre,
                                        'estado'=> $estado
                                    );
                }
                $datPerfil=json_encode(array("data"=>$rsPerfil));
            }
            else{
                $datPerfil = "";
            }  
            return $datPerfil;
        }
    }
?>