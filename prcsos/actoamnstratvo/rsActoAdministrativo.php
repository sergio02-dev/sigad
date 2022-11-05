<?php

    include('classActoAdmnstrtvo.php');

    class RsActoAdministrativo extends ActoAdmnistrativo{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function tipo_acto(){

            $sql_tipo_acto="SELECT taa_codigo, taa_descripcion, taa_estado
                              FROM principal.tipo_acto_administrativo
                             WHERE  taa_estado = 1
                             ORDER BY taa_descripcion ASC;";

            $query_tipo_acto=$this->cnxion->ejecutar($sql_tipo_acto);

            while($data_tipo_acto=$this->cnxion->obtener_filas($query_tipo_acto)){
                $datatipo_acto[]=$data_tipo_acto;
            }
            return $datatipo_acto;
        }

        public function autoridad_ambiental(){

            $sql_autoridad_ambiental="SELECT aam_codigo, aam_numero, aam_descripcion, 
                                             aam_siglas, aam_estado
                                        FROM principal.autoridad_ambiental
                                       WHERE aam_estado = 1
                                       ORDER BY aam_descripcion ASC;";

            $query_autoridad_ambiental=$this->cnxion->ejecutar($sql_autoridad_ambiental);

            while($data_autoridad_ambiental=$this->cnxion->obtener_filas($query_autoridad_ambiental)){
                $dataautoridad_ambiental[]=$data_autoridad_ambiental;
            }
            return $dataautoridad_ambiental;
        }

        public function list_acto_administrativo(){

            $sql_list_acto_administrativo="SELECT aad_codigo, aad_codigoreferencia, aad_fechapublicacion, 
                                                  aad_vigencia, aad_titular, aad_fechanotificacion, 
                                                  aad_tipoacto, aad_autoridadambiental, aad_objeto, 
                                                  aad_adjunto, aad_estado, aad_archivoadjunto
                                             FROM acto_administrativo.acto_administrativo;";

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

        public function nombre_autoridad_ambiental($codigo_autoridadambiental){

            $sql_nombre_autoridad_ambiental="SELECT aam_codigo, aam_numero, aam_descripcion, 
                                                    aam_siglas, aam_estado
                                               FROM principal.autoridad_ambiental
                                              WHERE aam_codigo = $codigo_autoridadambiental;";

            $query_nombre_autoridad_ambiental=$this->cnxion->ejecutar($sql_nombre_autoridad_ambiental);

            $data_nombre_autoridad_ambiental=$this->cnxion->obtener_filas($query_nombre_autoridad_ambiental);

            $aam_descripcion = $data_nombre_autoridad_ambiental['aam_descripcion'];

            return $aam_descripcion;
        }

        public function form_acto_administrativo($codigo_acto){

            $sql_form_acto_administrativo="SELECT aad_codigo, aad_codigoreferencia, aad_fechapublicacion, 
                                                  aad_vigencia, aad_titular, aad_fechanotificacion, 
                                                  aad_tipoacto, aad_autoridadambiental, aad_objeto, 
                                                  aad_adjunto, aad_estado, aad_archivoadjunto
                                             FROM acto_administrativo.acto_administrativo
                                            WHERE aad_codigo = $codigo_acto;";

            $query_form_acto_administrativo=$this->cnxion->ejecutar($sql_form_acto_administrativo);

            while($data_form_acto_administrativo=$this->cnxion->obtener_filas($query_form_acto_administrativo)){
                $dataform_acto_administrativo[]=$data_form_acto_administrativo;
            }
            return $dataform_acto_administrativo;
        }

        public function dataActoAdministrativo(){

            $rs_actoadministrativo=$this->list_acto_administrativo();
            
            if($rs_actoadministrativo){
                foreach ($rs_actoadministrativo as $dta_acto_admnstrtvo) {
                    $aad_codigo = $dta_acto_admnstrtvo['aad_codigo'];
                    $aad_codigoreferencia = $dta_acto_admnstrtvo['aad_codigoreferencia'];
                    $aad_fechapublicacion = $dta_acto_admnstrtvo['aad_fechapublicacion'];
                    $aad_vigencia = $dta_acto_admnstrtvo['aad_vigencia'];
                    $aad_titular = $dta_acto_admnstrtvo['aad_titular'];
                    $aad_fechanotificacion = $dta_acto_admnstrtvo['aad_fechanotificacion'];
                    $aad_tipoacto = $dta_acto_admnstrtvo['aad_tipoacto'];
                    $aad_autoridadambiental = $dta_acto_admnstrtvo['aad_autoridadambiental'];
                    $aad_objeto = $dta_acto_admnstrtvo['aad_objeto'];
                    $aad_adjunto = $dta_acto_admnstrtvo['aad_adjunto'];
                    $aad_estado = $dta_acto_admnstrtvo['aad_estado'];
                    $aad_archivoadjunto = $dta_acto_admnstrtvo['aad_archivoadjunto'];

                    $nombre_tipo_acto = $this->nombre_tipo_acto($aad_tipoacto);

                    $nombre_autoridad_ambiental = $this->nombre_autoridad_ambiental($aad_autoridadambiental);
    
                    if($aad_estado == 1){
                        $estado = "Activo";
                    }
                    
                    if($aad_estado == 0){
                        $estado = "Inactivo";
                    }
    
                    $rsActoAdmnstrtvo[] = array('aad_codigo'=> $aad_codigo,
                                                'aad_codigoreferencia'=> $aad_codigoreferencia,
                                                'aad_fechapublicacion'=> $aad_fechapublicacion,
                                                'aad_vigencia'=> $aad_vigencia,
                                                'aad_titular'=> $aad_titular,
                                                'aad_fechanotificacion'=> $aad_fechanotificacion,
                                                'nombre_tipo_acto'=> $nombre_tipo_acto,
                                                'nombre_autoridad_ambiental'=> $nombre_autoridad_ambiental,
                                                'aad_objeto'=> $aad_objeto,
                                                'aad_adjunto'=> $aad_adjunto,
                                                'aad_archivoadjunto'=> $aad_archivoadjunto,
                                                'estado'=> $estado,
                                            );
                }
                $datActoAdmnstrtvo = json_encode(array("data"=>$rsActoAdmnstrtvo));
            }
            else{
                $datActoAdmnstrtvo = json_encode(array("data"=>""));
            }  
            return $datActoAdmnstrtvo;
        }
    }
?>