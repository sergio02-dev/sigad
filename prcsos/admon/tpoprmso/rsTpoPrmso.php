<?php

    include('classTipoPermiso.php');

    class RsTpoPermiso extends TipoPermiso{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_tpo_prmso(){

            $sql_list_tpo_prmso="SELECT tpe_codigo, tpe_descripcion, 
                                        tpe_campoescritura, tpe_estado   
                                   FROM principal.tipo_permiso;";

            $query_list_tpo_prmso=$this->cnxion->ejecutar($sql_list_tpo_prmso);

            while($data_list_tpo_prmso=$this->cnxion->obtener_filas($query_list_tpo_prmso)){
                $datalist_tpo_prmso[]=$data_list_tpo_prmso;
            }
            return $datalist_tpo_prmso;
        }

        public function form_tpo_prmso($codigo_tipo){

            $sql_form_tpo_prmso="SELECT tpe_codigo, tpe_descripcion, 
                                        tpe_campoescritura, tpe_estado   
                                   FROM principal.tipo_permiso
                                  WHERE tpe_codigo = $codigo_tipo;";

            $query_form_tpo_prmso=$this->cnxion->ejecutar($sql_form_tpo_prmso);

            while($data_form_tpo_prmso=$this->cnxion->obtener_filas($query_form_tpo_prmso)){
                $dataform_tpo_prmso[]=$data_form_tpo_prmso;
            }
            return $dataform_tpo_prmso;
        }

        public function dtaTipoPermiso(){

            $rs_tpoPrmso=$this->list_tpo_prmso();
            
            if($rs_tpoPrmso){
                foreach ($rs_tpoPrmso as $dat_tipopermiso) {
                    $tpe_codigo = $dat_tipopermiso['tpe_codigo'];
                    $tpe_descripcion = $dat_tipopermiso['tpe_descripcion'];
                    $tpe_campoescritura = $dat_tipopermiso['tpe_campoescritura'];
                    $tpe_estado = $dat_tipopermiso['tpe_estado'];
    
                    if($tpe_estado==1){
                        $estado="Activo";
                    }
                    if($tpe_estado==0){
                        $estado="Inactivo";
                    }

                    if($tpe_campoescritura==1){
                        $campo_escritura="Si";
                    }
                    if($tpe_campoescritura==0){
                        $campo_escritura="No";
                    }
    
                    $rsTpoPrmso[] = array('tpe_codigo'=> $tpe_codigo,
                                          'tpe_descripcion'=> $tpe_descripcion,
                                          'campo_escritura'=> $campo_escritura,
                                          'estado'=> $estado
                                        );
                }
                $dattTpoPrmso=json_encode(array("data"=>$rsTpoPrmso));
            }
            else{
                $dattTpoPrmso = json_encode(array("data"=>""));
            }  
            return $dattTpoPrmso;
        }
    }
?>