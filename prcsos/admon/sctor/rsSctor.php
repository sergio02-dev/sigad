<?php

    include('classSector.php');

    class RsSector extends Sector{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_sector(){

            $sql_list_sector="SELECT sec_codigo, sec_numero, 
                                     sec_descripcion, sec_estado
                                FROM principal.sector;";

            $query_list_sector=$this->cnxion->ejecutar($sql_list_sector);

            while($data_list_sector=$this->cnxion->obtener_filas($query_list_sector)){
                $datalist_sector[]=$data_list_sector;
            }
            return $datalist_sector;
        }

        public function form_sector($codigo_sector){

            $sql_form_sector="SELECT sec_codigo, sec_numero, 
                                     sec_descripcion, sec_estado
                                FROM principal.sector
                               WHERE sec_codigo = $codigo_sector";

            $query_form_sector=$this->cnxion->ejecutar($sql_form_sector);

            while($data_form_sector=$this->cnxion->obtener_filas($query_form_sector)){
                $dataform_sector[]=$data_form_sector;
            }
            return $dataform_sector;
        }

        public function dtaSector(){

            $rs_sector=$this->list_sector();
            
            if($rs_sector){
                foreach ($rs_sector as $dat_sector) {
                    $sec_codigo = $dat_sector['sec_codigo'];
                    $sec_numero = $dat_sector['sec_numero'];
                    $sec_descripcion = $dat_sector['sec_descripcion'];
                    $sec_estado = $dat_sector['sec_estado'];
    
                    if($sec_estado==1){
                        $estado="Activo";
                    }
                    if($sec_estado==0){
                        $estado="Inactivo";
                    }
    
                    $rsSctor[] = array('sec_codigo'=> $sec_codigo,
                                       'sec_numero'=> $sec_numero,
                                       'sec_descripcion'=> $sec_descripcion,
                                       'estado'=> $estado
                                    );
                }
                $dattSector=json_encode(array("data"=>$rsSctor));
            }
            else{
                $dattSector = json_encode(array("data"=>""));
            }  
            return $dattSector;
        }
    }
?>