<?php

    include('classPrsna.php');


    class Prsna extends Persona{

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function selectPersona(){

            $sql_persona=" SELECT per_codigo, per_tipoidentificacion, per_identificacion, per_nombre,
                              per_primerapellido, per_segundoapellido,  per_genero,  per_estado
                        FROM principal.persona;";

            $query_perosna=$this->cnxion->ejecutar($sql_persona);
            while($data_persona=$this->cnxion->obtener_filas($query_perosna)){
                $dataPersona[]=$data_persona;
            }
            return $dataPersona;
        }

        public function selectIdentificacion(){

            $sql_selectIdentificacion=" SELECT tid_codigo, tid_nombre, tid_referencia
                                      FROM principal.tipo_identificacion;";

            $query_selectIdentificacion=$this->cnxion->ejecutar($sql_selectIdentificacion);

            while($data_selectIdentificacion=$this->cnxion->obtener_filas($query_selectIdentificacion)){
                $dataselectIdentificacion[]=$data_selectIdentificacion;
            }
            return $dataselectIdentificacion;
        }

        public function selectEntidad(){

            $sql_selectEntidad="SELECT ent_codigo, ent_nombre
                                  FROM principal.entidad
                                  WHERE ent_tipoentidad = 2
                                  AND ent_estado='1';";

            $query_selectEntidad=$this->cnxion->ejecutar($sql_selectEntidad);

            while($data_selectEntidad=$this->cnxion->obtener_filas($query_selectEntidad)){
                $dataselectEntidad[]=$data_selectEntidad;
            }
            return $dataselectEntidad;
        }

        public function selectFacultad(){

            $sql_selectFacultad="SELECT ent_codigo, ent_nombre
                                  FROM principal.entidad
                                  WHERE ent_tipoentidad = 1
                                  AND ent_estado='1';";

            $query_selectFacultad=$this->cnxion->ejecutar($sql_selectFacultad);

            while($data_selectFacultad=$this->cnxion->obtener_filas($query_selectFacultad)){
                $dataselectFacultad[]=$data_selectFacultad;
            }
            return $dataselectFacultad;
        }

        public function tipoIdentificacion($tipoId){

            $sql_tipoIdentificacion="SELECT tid_codigo, tid_nombre, tid_referencia
                                      FROM principal.tipo_identificacion
                                      WHERE tid_codigo=$tipoId;";

            $query_tipoIdentificacion=$this->cnxion->ejecutar($sql_tipoIdentificacion);

            $data_tipoIdentificacion=$this->cnxion->obtener_filas($query_tipoIdentificacion);

            $tid_nombre=$data_tipoIdentificacion['tid_nombre'];
             
            return $tid_nombre;
        }

        public function dataPersona(){

            $rs_persona=$this->selectPersona();

            foreach ($rs_persona as $dataPersona) {

                $per_codigo=$dataPersona['per_codigo'];
                $per_nombre=$dataPersona['per_nombre'];
                $per_primerapellido=$dataPersona['per_primerapellido'];
                $per_segundoapellido=$dataPersona['per_segundoapellido'];
                $per_genero=$dataPersona['per_genero'];
                $per_tipoidentificacion=$dataPersona['per_tipoidentificacion'];
                $per_identificacion=$dataPersona['per_identificacion'];

                $nombre_cmpltoprsna=$per_nombre.' '.$per_primerapellido.' '.$per_segundoapellido;

                if($per_tipoidentificacion==0){
                    $tipoIdentificacion='';
                }
                else{
                    $tipoIdentificacion=$this->tipoIdentificacion($per_tipoidentificacion);
                }

                if($per_genero=='H'){
                    $genero='Masculino';
                }
                elseif($per_genero=='M'){
                    $genero='Femenino';
                }
                else{
                    $genero='';
                }
                

                $rsPersona[] = array('per_codigo'=> $per_codigo,
                                   'per_nombre'=> $per_nombre,
                                   'per_primerapellido'=> $per_primerapellido,
                                   'per_segundoapellido'=> $per_segundoapellido,
                                   'per_genero'=> $per_genero,
                                   'per_tipoidentificacion'=> $tipoIdentificacion,
                                   'per_identificacion'=> $per_identificacion,
                                   'genero'=> $genero,
                                   'nombre_cmpltoprsna'=> $nombre_cmpltoprsna
                                   );

            }

                $datPersonaJson=json_encode(array("data"=>$rsPersona));
                return $datPersonaJson;

        }

        public function dataIdentificacion(){
            $sql_tipoidentificacion=" SELECT tid_codigo, tid_nombre, tid_referencia
                                      FROM principal.tipo_identificacion
                                      ORDER BY tid_codigo ASC;";
            $query_tipoidentificacion=$this->cnxion->ejecutar($sql_tipoidentificacion);
            while($data_tipoidentificacion=$this->cnxion->obtener_filas($query_tipoidentificacion)){
                $dataTipoIdentificacion[]=$data_tipoidentificacion;
            }

            return $dataTipoIdentificacion;

        }

        public function personaForm(){

            $sql_personaForm="SELECT per_codigo, per_nombre, per_primerapellido, per_segundoapellido,  
                                     per_genero, per_tipoidentificacion, per_identificacion, per_estado
                                FROM principal.persona
                               WHERE per_codigo=".$this->getCodigoPersona().";";

            $query_personaForm=$this->cnxion->ejecutar($sql_personaForm);

            while($data_personaForm=$this->cnxion->obtener_filas($query_personaForm)){
                $datapersonaForm[]=$data_personaForm;
            }
            return $datapersonaForm;
        }

        public function entidad($per_codigo){

            $sql_entidad="SELECT epe_entidad, epe_codigo
                            FROM principal.entidad_persona
                            WHERE epe_estado='1'
                              AND epe_persona=$per_codigo;";

            $query_entidad=$this->cnxion->ejecutar($sql_entidad);

            $data_entidad=$this->cnxion->obtener_filas($query_entidad);

            $epe_entidad=$data_entidad['epe_entidad'];
             
            return $epe_entidad;
        }

        public function facultad($per_codigo){

            $sql_facultad="SELECT epe_facultad, epe_codigo
                            FROM principal.entidad_persona
                            WHERE epe_estado='1'
                              AND epe_persona=$per_codigo;";

            $query_facultad=$this->cnxion->ejecutar($sql_facultad);

            $data_facultad=$this->cnxion->obtener_filas($query_facultad);

            $epe_facultad=$data_facultad['epe_facultad'];
             
            return $epe_facultad;
        }

        

        public function getSql_persona(){
            return $this->sql_persona=$this->selectPersona();
        }

        public function list_oficina(){

            $sql_list_oficina="SELECT ofi_codigo, ofi_nombre, ofi_estado
                                 FROM usco.oficina
                                WHERE ofi_estado = 1
                                ORDER BY ofi_nombre ASC;";

            $query_list_oficina=$this->cnxion->ejecutar($sql_list_oficina);

            while($data_list_oficina=$this->cnxion->obtener_filas($query_list_oficina)){
                $datalist_oficina[] = $data_list_oficina;
            }
            return $datalist_oficina;
        }

        public function list_cargo(){

            $sql_list_cargo="SELECT car_codigo, car_nombre, car_estado
                               FROM usco.cargo
                              WHERE car_estado = 1
                              ORDER BY car_nombre ASC ;";

            $query_list_cargo=$this->cnxion->ejecutar($sql_list_cargo);

            while($data_list_cargo=$this->cnxion->obtener_filas($query_list_cargo)){
                $datalist_cargo[] = $data_list_cargo;
            }
            return $datalist_cargo;
        }

        public function nombre_persona($codigo_persona){

            $sql_nombre_persona="SELECT per_codigo, per_nombre, per_primerapellido, 
                                        per_segundoapellido
                                   FROM principal.persona
                                  WHERE per_codigo = $codigo_persona;";

            $query_nombre_persona=$this->cnxion->ejecutar($sql_nombre_persona);

            $data_nombre_persona=$this->cnxion->obtener_filas($query_nombre_persona);

            $per_nombre = $data_nombre_persona['per_nombre'];
            $per_primerapellido = $data_nombre_persona['per_primerapellido'];
            $per_segundoapellido = $data_nombre_persona['per_segundoapellido'];

            $nmbre = $per_nombre." ".$per_primerapellido." ".$per_segundoapellido;
             
            return $nmbre;
        }

        public function vinculacion_form($codigo_vinculacion){

            $sql_vinculacion_form="SELECT vin_codigo, vin_persona, vin_oficina, 
                                          vin_cargo, vin_estado
                                     FROM usco.vinculacion
                                    WHERE vin_codigo = $codigo_vinculacion;";

            $query_vinculacion_form=$this->cnxion->ejecutar($sql_vinculacion_form);

            while($data_vinculacion_form=$this->cnxion->obtener_filas($query_vinculacion_form)){
                $datavinculacion_form[] = $data_vinculacion_form;
            }
            return $datavinculacion_form;
        }

        public function list_vinculacion_persona($codigo_persona){

            $sql_list_vinculacion_persona="SELECT vin_codigo, vin_persona, vin_oficina, 
                                                  vin_cargo, vin_estado, ofi_nombre,
                                                  car_nombre
                                             FROM usco.vinculacion, usco.cargo,
                                                  usco.oficina
                                            WHERE vin_cargo = car_codigo
                                              AND vin_oficina = ofi_codigo
                                              AND vin_persona = $codigo_persona
                                            ORDER BY ofi_nombre, car_nombre";

            $query_list_vinculacion_persona=$this->cnxion->ejecutar($sql_list_vinculacion_persona);

            while($data_list_vinculacion_persona=$this->cnxion->obtener_filas($query_list_vinculacion_persona)){
                $datalist_vinculacion_persona[] = $data_list_vinculacion_persona;
            }
            return $datalist_vinculacion_persona;
        }

        


    }



?>
