<?php

    include('classTitular.php');

    class RsTitular extends Titular{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_titular(){

            $sql_list_titular="SELECT tit_codigo, tit_tipotitular, tit_tipoidentificacion, 
                                      tit_identificacion, tit_digitoverificacion, tit_nombre, 
                                      tit_sigla, tit_logo, tit_correo, tit_direccion, 
                                      tit_estado
                                 FROM principal.titular;";

            $query_list_titular=$this->cnxion->ejecutar($sql_list_titular);

            while($data_list_titular=$this->cnxion->obtener_filas($query_list_titular)){
                $datalist_titular[]=$data_list_titular;
            }
            return $datalist_titular;
        }

        public function tipo_identificacion(){

            $sql_tipo_identificacion="SELECT tid_codigo, tid_nombre, tid_referencia
                                        FROM principal.tipo_identificacion
                                       WHERE tid_codigo NOT IN(6,5,4);";

            $query_tipo_identificacion=$this->cnxion->ejecutar($sql_tipo_identificacion);

            while($data_tipo_identificacion=$this->cnxion->obtener_filas($query_tipo_identificacion)){
                $datatipo_identificacion[]=$data_tipo_identificacion;
            }
            return $datatipo_identificacion;
        }

        public function nombre_tipo_id($codigo_tipoID){

            $sql_nombre_tipo_id="SELECT tid_codigo, tid_nombre, tid_referencia
                                   FROM principal.tipo_identificacion
                                  WHERE tid_codigo = $codigo_tipoID";

            $query_nombre_tipo_id=$this->cnxion->ejecutar($sql_nombre_tipo_id);

            $data_nombre_tipo_id=$this->cnxion->obtener_filas($query_nombre_tipo_id);

            $tid_nombre = $data_nombre_tipo_id['tid_nombre'];

            return $tid_nombre;
        }

        public function form_titular($codigo_titular){

            $sql_form_titular="SELECT tit_codigo, tit_tipotitular, tit_tipoidentificacion, 
                                      tit_identificacion, tit_digitoverificacion, tit_nombre, 
                                      tit_sigla, tit_logo, tit_correo, tit_direccion, 
                                      tit_estado
                                 FROM principal.titular
                                WHERE tit_codigo = $codigo_titular;";

            $query_form_titular=$this->cnxion->ejecutar($sql_form_titular);

            while($data_form_titular=$this->cnxion->obtener_filas($query_form_titular)){
                $dataform_titular[]=$data_form_titular;
            }
            return $dataform_titular;
        }

        public function dtaTitular(){

            $rs_sector=$this->list_titular();
            
            if($rs_sector){
                foreach ($rs_sector as $dat_sector) {
                    $tit_codigo = $dat_sector['tit_codigo'];
                    $tit_tipotitular = $dat_sector['tit_tipotitular'];
                    $tit_tipoidentificacion = $dat_sector['tit_tipoidentificacion'];
                    $tit_identificacion = $dat_sector['tit_identificacion'];
                    $tit_digitoverificacion = $dat_sector['tit_digitoverificacion'];
                    $tit_nombre = $dat_sector['tit_nombre'];
                    $tit_sigla = $dat_sector['tit_sigla'];
                    $tit_logo = $dat_sector['tit_logo'];
                    $tit_correo = $dat_sector['tit_correo'];
                    $tit_direccion = $dat_sector['tit_direccion'];
                    $tit_estado = $dat_sector['tit_estado'];

                    $nombre_tipo_id = $this->nombre_tipo_id($tit_tipoidentificacion);

                    if($tit_tipotitular == 1){
                        $digito_verificacion = "";
                        $sigla = "";
                        $tipo_titular = "Persona Natural";
                        $logo = "";
                    }
                    else{
                        $digito_verificacion = $tit_digitoverificacion;
                        $sigla = $tit_sigla;
                        $tipo_titular = "Persona Juridica";
                        $logo = $tit_logo;
                    }
    
                    if($tit_estado == 1){
                        $estado = "Activo";
                    }
                    if($tit_estado == 0){
                        $estado = "Inactivo";
                    }
    
                    $rsTtlar[] = array('tit_codigo'=> $tit_codigo,
                                       'tipo_titular'=> $tipo_titular,
                                       'digito_verificacion'=> $digito_verificacion,
                                       'tit_tipotitular'=> $tit_tipotitular,
                                       'nombre_tipo_id'=> $nombre_tipo_id,
                                       'tit_identificacion'=> $tit_identificacion,
                                       'tit_nombre'=> $tit_nombre,
                                       'sigla'=> $sigla,
                                       'tit_logo'=> $logo,
                                       'tit_correo'=> $tit_correo,
                                       'tit_direccion'=> $tit_direccion,
                                       'estado'=> $estado
                                    );
                }
                $dattitular=json_encode(array("data"=>$rsTtlar));
            }
            else{
                $dattitular = json_encode(array("data"=>""));
            }  
            return $dattitular;
        }
    }
?>