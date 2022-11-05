<?php

    include('classExpediente.php');

    class RsExpediente extends Expediente{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function list_autoridad_ambiental(){

            $sql_list_autoridad_ambiental="SELECT aam_codigo, aam_numero, aam_descripcion, 
                                                  aam_siglas, aam_estado
                                             FROM principal.autoridad_ambiental
                                            WHERE aam_estado = 1
                                            ORDER BY aam_descripcion ASC;";

            $query_list_autoridad_ambiental=$this->cnxion->ejecutar($sql_list_autoridad_ambiental);

            while($data_list_autoridad_ambiental=$this->cnxion->obtener_filas($query_list_autoridad_ambiental)){
                $datalist_autoridad_ambiental[]=$data_list_autoridad_ambiental;
            }
            return $datalist_autoridad_ambiental;
        }

        public function list_sector(){

            $sql_list_sector="SELECT sec_codigo, sec_numero, 
                                     sec_descripcion, sec_estado
                                FROM principal.sector
                               WHERE sec_estado = 1;";

            $query_list_sector=$this->cnxion->ejecutar($sql_list_sector);

            while($data_list_sector=$this->cnxion->obtener_filas($query_list_sector)){
                $datalist_sector[]=$data_list_sector;
            }
            return $datalist_sector;
        }

        public function list_titular(){

            $sql_list_titular="SELECT tit_codigo, tit_identificacion, tit_nombre, 
                                      tit_sigla, tit_logo, tit_correo, tit_direccion
                                 FROM principal.titular
                                WHERE tit_estado = 1;";

            $query_list_titular=$this->cnxion->ejecutar($sql_list_titular);

            while($data_list_titular=$this->cnxion->obtener_filas($query_list_titular)){
                $datalist_titular[]=$data_list_titular;
            }
            return $datalist_titular;
        }


        public function list_tipo_permiso(){

            $sql_list_tipo_permiso="SELECT tpe_codigo, tpe_descripcion, 
                                           tpe_campoescritura, tpe_estado
                                      FROM principal.tipo_permiso
                                     WHERE tpe_estado = 1;";

            $query_list_tipo_permiso=$this->cnxion->ejecutar($sql_list_tipo_permiso);

            while($data_list_tipo_permiso=$this->cnxion->obtener_filas($query_list_tipo_permiso)){
                $datalist_tipo_permiso[]=$data_list_tipo_permiso;
            }
            return $datalist_tipo_permiso;
        }

        public function list_expedientes(){

            $sql_list_expedientes="SELECT exp_codigo, exp_numero, exp_descripcion, 
                                          exp_autoridadambiental, exp_sector, exp_titular, 
                                          exp_tipopermiso, exp_otropermiso, exp_estado
                                     FROM principal.expediente;";

            $query_list_expedientes=$this->cnxion->ejecutar($sql_list_expedientes);

            while($data_list_expedientes=$this->cnxion->obtener_filas($query_list_expedientes)){
                $datalist_expedientes[]=$data_list_expedientes;
            }
            return $datalist_expedientes;
        }

        public function nombre_autoridad_ambiental($codigo_autoridad_ambient){

            $sql_nombre_autoridad_ambiental="SELECT aam_codigo, aam_numero, aam_descripcion, 
                                                    aam_siglas, aam_estado
                                               FROM principal.autoridad_ambiental
                                            WHERE aam_codigo = $codigo_autoridad_ambient;";

            $query_nombre_autoridad_ambiental=$this->cnxion->ejecutar($sql_nombre_autoridad_ambiental);

            $data_nombre_autoridad_ambiental=$this->cnxion->obtener_filas($query_nombre_autoridad_ambiental);

            $aam_descripcion = $data_nombre_autoridad_ambiental['aam_descripcion'];

            return $aam_descripcion;
        }

        public function nombre_sector($codigo_autoridad_ambient){

            $sql_nombre_sector="SELECT sec_codigo, sec_numero, sec_descripcion
                                  FROM principal.sector
                                 WHERE sec_codigo = $codigo_autoridad_ambient;";

            $query_nombre_sector=$this->cnxion->ejecutar($sql_nombre_sector);

            $data_nombre_sector=$this->cnxion->obtener_filas($query_nombre_sector);

            $sec_descripcion = $data_nombre_sector['sec_descripcion'];

            return $sec_descripcion;
        }

        public function nombre_titular($codigo_titular){

            $sql_nombre_titular="SELECT tit_codigo, tit_nombre, tit_sigla, 
                                        tit_logo, tit_correo, tit_direccion, 
                                        tit_estado
                                   FROM principal.titular
                                  WHERE tit_codigo = $codigo_titular;";

            $query_nombre_titular=$this->cnxion->ejecutar($sql_nombre_titular);

            $data_nombre_titular=$this->cnxion->obtener_filas($query_nombre_titular);

            $tit_nombre = $data_nombre_titular['tit_nombre'];

            return $tit_nombre;
        }

        public function nombre_tipo_permiso($codigo_tipo_permiso){

            $sql_nombre_tipo_permiso="SELECT tpe_codigo, tpe_descripcion, tpe_campoescritura
                                        FROM principal.tipo_permiso
                                       WHERE tpe_codigo = $codigo_tipo_permiso;";

            $query_nombre_tipo_permiso=$this->cnxion->ejecutar($sql_nombre_tipo_permiso);

            $data_nombre_tipo_permiso=$this->cnxion->obtener_filas($query_nombre_tipo_permiso);

            $tpe_descripcion = $data_nombre_tipo_permiso['tpe_descripcion'];
            $tpe_campoescritura = $data_nombre_tipo_permiso['tpe_campoescritura'];

            return array($tpe_descripcion, $tpe_campoescritura);
        }

        public function dtaListExpednte(){

            $rs_expednte=$this->list_expedientes();
            
            if($rs_expednte){
                foreach ($rs_expednte as $dat_expediente) {
                    $exp_codigo = $dat_expediente['exp_codigo'];
                    $exp_numero = $dat_expediente['exp_numero'];
                    $exp_descripcion = $dat_expediente['exp_descripcion'];
                    $exp_autoridadambiental = $dat_expediente['exp_autoridadambiental'];
                    $exp_sector = $dat_expediente['exp_sector'];
                    $exp_titular = $dat_expediente['exp_titular'];
                    $exp_tipopermiso = $dat_expediente['exp_tipopermiso'];
                    $exp_otropermiso = $dat_expediente['exp_otropermiso'];
                    $exp_estado = $dat_expediente['exp_estado'];
    
                    if($exp_estado==1){
                        $estado="Activo";
                    }
                    if($exp_estado==0){
                        $estado="Inactivo";
                    }

                    $nombre_autoridad_ambiental = $this->nombre_autoridad_ambiental($exp_autoridadambiental);
                    $nombre_sector = $this->nombre_sector($exp_sector);
                    $nombre_titular = $this->nombre_titular($exp_titular);
                    list($nombre_tipoprmso, $campo_escritura) = $this->nombre_tipo_permiso($exp_tipopermiso);

                    if($campo_escritura == 1){
                        $tipo_permiso = $exp_otropermiso;
                    }
                    else{
                        $tipo_permiso = $nombre_tipoprmso;
                    }

    
                    $rsSctor[] = array('exp_codigo'=> $exp_codigo,
                                       'exp_numero'=> $exp_numero,
                                       'exp_descripcion'=> $exp_descripcion,
                                       'nombre_autoridad_ambiental'=> $nombre_autoridad_ambiental,
                                       'nombre_sector'=> $nombre_sector,
                                       'nombre_titular'=> $nombre_titular,
                                       'tipo_permiso'=> $tipo_permiso,
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

        public function form_expediente($codigo_expediente){

            $sql_form_expediente="SELECT exp_codigo, exp_numero, exp_descripcion, 
                                         exp_autoridadambiental, exp_sector, 
                                         exp_titular, exp_tipopermiso, 
                                         exp_otropermiso, exp_estado
                                    FROM principal.expediente
                                   WHERE exp_codigo = $codigo_expediente;";

            $query_form_expediente=$this->cnxion->ejecutar($sql_form_expediente);

            while($data_form_expediente=$this->cnxion->obtener_filas($query_form_expediente)){
                $dataform_expediente[]=$data_form_expediente;
            }
            return $dataform_expediente;
        }

        public function list_acto_administrativo($codigo_expediente){

            $sql_list_acto_administrativo="SELECT aad_codigo, aad_codigoreferencia, aad_fechapublicacion, 
                                                  aad_vigencia, aad_titular, aad_fechanotificacion, 
                                                  aad_tipoacto, aad_autoridadambiental, aad_objeto, 
                                                  aad_adjunto, aad_estado, aad_archivoadjunto
                                             FROM acto_administrativo.acto_administrativo
                                            WHERE aad_expediente = $codigo_expediente;";

            $query_list_acto_administrativo=$this->cnxion->ejecutar($sql_list_acto_administrativo);

            while($data_list_acto_administrativo=$this->cnxion->obtener_filas($query_list_acto_administrativo)){
                $datalist_acto_administrativo[]=$data_list_acto_administrativo;
            }
            return $datalist_acto_administrativo;
        }

        public function nombre_tipo_acto($codigo_tipoacto){

            $sql_nombre_tipo_acto="SELECT taa_codigo, taa_descripcion, taa_estado
                                     FROM principal.tipo_acto_administrativo
                                    WHERE taa_codigo = $codigo_tipoacto";

            $query_nombre_tipo_acto=$this->cnxion->ejecutar($sql_nombre_tipo_acto);

            $data_nombre_tipo_acto=$this->cnxion->obtener_filas($query_nombre_tipo_acto);

            $taa_descripcion = $data_nombre_tipo_acto['taa_descripcion'];

            return $taa_descripcion;
        }

    }
?>