<?php
include('classPrsna.php');

class RsPersona extends Persona{

    private $cnxion;
    private $codigoPersona;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }


    public function datos_padres($per_codigo){

        $sql_datos_padres="SELECT DISTINCT per_codigo,per_identificacion, 
                                           per_nombre, per_primerapellido, 
                                           per_segundoapellido, per_segundonombre,
                                           papaninios.pni_tipo
                            FROM principal.persona as persona,principal.papas_ninios as papaninios
                            WHERE persona.per_codigo=papaninios.pni_papas
                            AND papaninios.pni_ninio=$per_codigo
                            AND papaninios.pni_tipo IN(1,2);";

        $query_datos_padres=$this->cnxion->ejecutar($sql_datos_padres);

        while($data_datos_padres=$this->cnxion->obtener_filas($query_datos_padres)){
        $datadatos_padres[]=$data_datos_padres;
        }
        return $datadatos_padres;
    }

    public function datos_basicos($per_codigo){

        $sql_datos_basicos="SELECT per_codigo, per_nombre, per_segundonombre, 
                                   per_primerapellido, per_segundoapellido, 
                                   per_tipoidentificacion, per_identificacion, 
                                   per_lugarexpedicion, per_fechanacimiento, 
                                   per_genero, per_estado, dba_municipioresidencia, 
                                   dba_direccionresidencia, dba_celular, 
                                   dba_telefono, dba_correo, tid_nombre
                              FROM principal.persona, principal.datos_basicos, 
                                   principal.tipo_identificacion
                             WHERE per_codigo = dba_persona
                               AND per_tipoidentificacion = tid_codigo 
                               AND per_codigo = $per_codigo;";

        $query_datos_basicos=$this->cnxion->ejecutar($sql_datos_basicos);

        while($data_datos_basicos=$this->cnxion->obtener_filas($query_datos_basicos)){
        $datadatos_basicos[]=$data_datos_basicos;
        }
        return $datadatos_basicos;
    }

    public function ref_tipoId($codigo_reftid){

        $sql_ref_tipoId="SELECT tid_codigo, tid_nombre, tid_referencia
                           FROM principal.tipo_identificacion
                          WHERE tid_codigo = $codigo_reftid;";

        $query_ref_tipoId=$this->cnxion->ejecutar($sql_ref_tipoId);

        $data_ref_tipoId=$this->cnxion->obtener_filas($query_ref_tipoId);

        $tid_referencia = $data_ref_tipoId['tid_referencia'];

        return $tid_referencia;

    }

    public function selectEps(){

        $sql_eps="SELECT eps_codigo, eps_descripcion, eps_estado
                    FROM principal.eps
                ORDER BY eps_descripcion ASC;";

        $query_eps=$this->cnxion->ejecutar($sql_eps);

        while($data_eps=$this->cnxion->obtener_filas($query_eps)){
            $dataeps[]=$data_eps;
        }
        return $dataeps;

    }

    public function selectDepartamento(){

        $sql_departamento="SELECT dep_codigo, dep_nombre, dep_dane
                             FROM principal.departamento
                             ORDER BY dep_nombre ASC;";

        $query_departamento=$this->cnxion->ejecutar($sql_departamento);

        while($data_departamento=$this->cnxion->obtener_filas($query_departamento)){
            $datadepartamento[]=$data_departamento;
        }
        return $datadepartamento;

    }

    public function selectMunicipio($departamento){

        $sql_municipio="SELECT mun_codigo, mun_nombre, dep_codigo, mun_dane
                          FROM principal.municipio
                          WHERE dep_codigo=$departamento
                         ORDER BY mun_nombre ASC;";

        $query_municipio=$this->cnxion->ejecutar($sql_municipio);

        while($data_municipio=$this->cnxion->obtener_filas($query_municipio)){
            $datamunicipio[]=$data_municipio;
        }
        return $datamunicipio;

    }



    public function selectPersonaPorCodigo($codigo_persona){
        $sql_persona="SELECT per_codigo, per_nombre, per_primerapellido, 
                             per_segundoapellido, per_tipoidentificacion, 
                             per_identificacion, per_segundonombre, 
                             per_lugarexpedicion, per_fechanacimiento, 
                             per_genero, per_estado, dba_codigo, 
                             dba_persona, dba_municipioresidencia, 
                             dba_direccionresidencia, dba_celular, 
                             dba_telefono, dba_correo
                        FROM principal.persona,principal.datos_basicos
                       WHERE per_codigo = dba_persona
                        AND per_codigo =  $codigo_persona;";

        $query_persona=$this->cnxion->ejecutar($sql_persona);

        while($data_persona=$this->cnxion->obtener_filas($query_persona)){
            $dataPersona[]=$data_persona;
        }
        return $dataPersona;
    }



    
    public function municipioDatos($mun_codigo){

        $sql_municipioDatos="SELECT mun_codigo, mun_nombre, dep_codigo, mun_dane
                                FROM principal.municipio
                               WHERE mun_codigo=$mun_codigo;";

        $query_municipioDatos=$this->cnxion->ejecutar($sql_municipioDatos);

        while($data_municipioDatos=$this->cnxion->obtener_filas($query_municipioDatos)){
            $datamunicipioDatos[]=$data_municipioDatos;
        }
        return $datamunicipioDatos;
    }

    
    public function municipio_nombre($mun_codigo){

        $sql_municipio_nombre="SELECT mun_codigo, mun_nombre, dep_codigo, mun_dane
                                 FROM principal.municipio
                                WHERE mun_codigo=$mun_codigo;";

        $query_municipio_nombre=$this->cnxion->ejecutar($sql_municipio_nombre);

        $data_municipio_nombre=$this->cnxion->obtener_filas($query_municipio_nombre);

        $nombre_mun=$data_municipio_nombre['mun_nombre'];

        return $nombre_mun;
    }

    public function departamento_nombre($mun_codigo){

        $sql_departamento_nombre="SELECT DEP.dep_codigo, dep_nombre, dep_dane, mun_nombre
                                    FROM principal.departamento as DEP, principal.municipio AS MUN
                                   WHERE CAST(dep_dane AS BIGINT)=MUN.dep_codigo
                                     AND mun_codigo=$mun_codigo;";

        $query_departamento_nombre=$this->cnxion->ejecutar($sql_departamento_nombre);

        $data_departamento_nombre=$this->cnxion->obtener_filas($query_departamento_nombre);

        $nombre_dep=$data_departamento_nombre['dep_nombre'];

        return $nombre_dep;
    }



    public function usuario(){

        $sql_usuario="SELECT use_codigo, per_codigo, use_pswd, use_estado, 
                             use_alias
                        FROM principal.usepersona
                       WHERE per_codigo=".$this->getCodigoPersona().";";

        $query_usuario=$this->cnxion->ejecutar($sql_usuario);

        while($data_usuario=$this->cnxion->obtener_filas($query_usuario)){
            $datausuario[]=$data_usuario;
        }
        return $datausuario;
    }

    public function selectTipoIdentificacion(){

        $sql_tipoidentificacion=" SELECT tid_codigo, tid_nombre, tid_referencia
                                  FROM principal.tipo_identificacion
                                  ORDER BY tid_codigo ASC;";
        $query_tipoidentificacion=$this->cnxion->ejecutar($sql_tipoidentificacion);
        while($data_tipoidentificacion=$this->cnxion->obtener_filas($query_tipoidentificacion)){
            $dataTipoIdentificacion[]=$data_tipoidentificacion;
        }

        return $dataTipoIdentificacion;

    }

    public function clave($pswd){

        $paswd=sha1($pswd);

        $string=$paswd;
        $largo = strlen($paswd);
        $final_array = array();
        for($i = 0; $i < $largo; $i++)  {
            $caracter = $string[$i];
            array_push($final_array,$caracter);
        }
    
        for($arr=$largo; $arr >= 0; $arr--){
            $clave.=$final_array[$arr];
        }
    
        $pass=md5($clave);
        return $pass;
    }

    public function selectPersona(){

        $sql_persona="SELECT per_codigo, per_nombre, per_primerapellido, 
                             per_segundoapellido, per_tipoidentificacion, 
                             per_identificacion, per_segundonombre, 
                             per_lugarexpedicion, per_fechanacimiento, 
                             per_genero, per_estado, dba_municipioresidencia, 
                             dba_direccionresidencia, dba_celular, dba_telefono, 
                             dba_correo, tid_nombre
                        FROM principal.persona, principal.datos_basicos, 
                             principal.tipo_identificacion
                       WHERE per_codigo = dba_persona
                         AND per_tipoidentificacion = tid_codigo
                       ORDER BY per_nombre, per_segundonombre, 
                             per_primerapellido, per_segundoapellido ASC;";

        $query_persona=$this->cnxion->ejecutar($sql_persona);

        while($data_persona=$this->cnxion->obtener_filas($query_persona)){
            $dataPersona[]=$data_persona;
        }
        return $dataPersona;
    }

    public function dtaPersona(){
        $rs_persona=$this->selectPersona();
        if($rs_persona){
            foreach ($rs_persona as $datPersona) {
                $per_codigo = $datPersona['per_codigo'];
                $per_nombre = $datPersona['per_nombre'];
                $per_segundonombre = $datPersona['per_segundonombre'];
                $per_primerapellido = $datPersona['per_primerapellido'];
                $per_segundoapellido = $datPersona['per_segundoapellido'];
                $per_tipoidentificacion = $datPersona['per_tipoidentificacion'];
                $per_identificacion = $datPersona['per_identificacion'];
                $per_lugarexpedicion = $datPersona['per_lugarexpedicion'];
                $per_fechanacimiento = $datPersona['per_fechanacimiento'];
                $per_genero = $datPersona['per_genero'];
                $per_estado = $datPersona['per_estado'];
                $dba_direccionresidencia = $datPersona['dba_direccionresidencia'];
                $dba_celular = $datPersona['dba_celular'];
                $dba_telefono = $datPersona['dba_telefono'];
                $dba_correo = $datPersona['dba_correo'];
                $tid_nombre = $datPersona['tid_nombre'];

    
                $nombrePersona=$per_nombre." ".$per_segundonombre." ".$per_primerapellido." ".$per_segundoapellido;
    
                if($per_genero==1){
                    $genero="Masculino";
                }
                if($per_genero==2){
                    $genero="Femenino";
                }
                
                $rsPersona[] = array('per_codigo'=> $per_codigo,
                                     'per_nombre'=> $per_nombre,
                                     'per_primerapellido'=> $per_primerapellido,
                                     'per_segundoapellido'=> $per_segundoapellido,
                                     'per_genero'=> $per_genero,
                                     'per_tipoidentificacion'=> $per_tipoidentificacion,
                                     'per_identificacion'=> $per_identificacion,
                                     'genero'=> $genero,
                                     'tid_nombre'=> $tid_nombre,
                                     'nombrePersona'=>$nombrePersona,
                                );
               
            }
            $datPersonaJson=json_encode(array("data"=>$rsPersona));
        }
        else{
            $datPersonaJson=json_encode(array("data"=>""));
        }
        
        return $datPersonaJson;
    }



    public function nombre_persona($codigo_persona){

        $sql_nombre_persona="SELECT per_codigo, per_nombre, per_segundonombre, 
                                    per_primerapellido, per_segundoapellido
                                FROM principal.persona
                            WHERE per_codigo = $codigo_persona;";

        $query_nombre_persona=$this->cnxion->ejecutar($sql_nombre_persona);

        $data_nombre_persona=$this->cnxion->obtener_filas($query_nombre_persona);

        $per_nombre=$data_nombre_persona['per_nombre'];
        $per_segundonombre=$data_nombre_persona['per_segundonombre'];
        $per_primerapellido=$data_nombre_persona['per_primerapellido'];
        $per_segundoapellido=$data_nombre_persona['per_segundoapellido'];

        $people=$per_nombre." ".$per_segundonombre." ".$per_primerapellido." ".$per_segundoapellido;

        return $people;
    }
    
    public function foto_persona($codigo_persona){

        $sql_nombre_persona="SELECT per_codigo, per_foto
                               FROM principal.persona
                              WHERE per_codigo = $codigo_persona;";

        $query_nombre_persona=$this->cnxion->ejecutar($sql_nombre_persona);

        $data_nombre_persona=$this->cnxion->obtener_filas($query_nombre_persona);

        $per_foto=$data_nombre_persona['per_foto'];

        return $per_foto;
    }

    public function lugar_nacimiento($mun_nace){

        $sql_lugar_nacimiento="SELECT mun_codigo, mun_nombre, DEP.dep_codigo, mun_dane,dep_nombre 
                                 FROM principal.municipio AS MUN, principal.departamento AS DEP
                                WHERE CAST(DEP.dep_dane AS BIGINT)=MUN.dep_codigo
                                  AND  mun_codigo=$mun_nace;";

        $query_lugar_nacimiento=$this->cnxion->ejecutar($sql_lugar_nacimiento);

        $data_lugar_nacimiento=$this->cnxion->obtener_filas($query_lugar_nacimiento);

        $mun_nombre=$data_lugar_nacimiento['mun_nombre'];
        $dep_nombre=$data_lugar_nacimiento['dep_nombre'];

        $nombre_lugar=$mun_nombre." / ".$dep_nombre;

        return $nombre_lugar;

    }

  
    public function foto_descarga($codigo_ninio){

        $sql_foto_descarga="SELECT per_codigo, per_nombre, per_primerapellido, per_segundoapellido, per_identificacion
                              FROM principal.persona
                             WHERE per_codigo = '$codigo_ninio';";

        $query_foto_descarga=$this->cnxion->ejecutar($sql_foto_descarga);

        $data_foto_descarga=$this->cnxion->obtener_filas($query_foto_descarga);

        $per_identificacion=$data_foto_descarga['per_identificacion'];
        $per_nombre=$data_foto_descarga['per_nombre'];
        $per_primerapellido=$data_foto_descarga['per_primerapellido'];

        $nmbre_fto = strtoupper($per_identificacion."_".$per_nombre.$per_primerapellido);

        $nmbre_fto=str_replace(' ','',$nmbre_fto);

        return $nmbre_fto;
    }



    public function vldar_persona($identificacion){

        $sql_vldar_persona="SELECT per_codigo, per_nombre, per_segundonombre, 
                                   per_primerapellido, per_segundoapellido, 
                                   per_genero, per_tipoidentificacion, per_identificacion, 
                                   per_estado, per_fechanacimiento, per_municipionacimiento,
                                   per_foto, per_nacionalidad, per_otranacionalidad,
                                   dba_estadocivil, dba_rh, dba_direccion, 
                                   dba_municipioresidencia, dba_correo, dba_telefono, 
                                   dba_celular, dba_estado, dba_lugarexpedicion,
                                   dba_eps, dba_sisben, dba_ocupacion, dba_estrato
                              FROM principal.persona, principal.datos_basicos
                             WHERE per_codigo = dba_persona
                               AND per_identificacion = '$identificacion';";

        $query_vldar_persona=$this->cnxion->ejecutar($sql_vldar_persona);

        while($data_vldar_persona=$this->cnxion->obtener_filas($query_vldar_persona)){
            $datavldar_persona[]=$data_vldar_persona;
        }
        return $datavldar_persona;
    }

   

    public function dane_dep($codigo_municipio){

        $sql_dane_dep="SELECT mun_codigo, mun_nombre, 
                              principal.departamento.dep_dane, 
                              mun_dane,
                              principal.municipio.dep_codigo, 
                              principal.departamento.dep_codigo as codigo_departamento
                         FROM principal.municipio, principal.departamento
                        WHERE principal.municipio.dep_codigo = CAST(principal.departamento.dep_dane AS BIGINT)
                          AND CAST(mun_codigo AS BIGINT)= $codigo_municipio;";

        $resultado_dane_dep=$this->cnxion->ejecutar($sql_dane_dep);

        $data_dane_dep=$this->cnxion->obtener_filas($resultado_dane_dep);

        $dep_dane = $data_dane_dep['dep_dane'];

        return $dep_dane;
    }

    public function cdgo_dprtmnto($dne){

        $sql_cdgo_dprtmnto="SELECT dep_codigo, dep_nombre, dep_dane
                            FROM principal.departamento
                            WHERE dep_dane = '$dne';";

        $resultado_cdgo_dprtmnto=$this->cnxion->ejecutar($sql_cdgo_dprtmnto);

        $data_cdgo_dprtmnto=$this->cnxion->obtener_filas($resultado_cdgo_dprtmnto);

        $dep_codigo = $data_cdgo_dprtmnto['dep_codigo'];

        return $dep_codigo;
    }

    public function dtaVldcion($identificacion){
        $rs_vldcion=$this->vldar_persona($identificacion);
        if($rs_vldcion){
            foreach ($rs_vldcion as $dta_vldcion) {
                $per_codigo = $dta_vldcion['per_codigo'];
                $per_nombre = $dta_vldcion['per_nombre'];
                $per_segundonombre = $dta_vldcion['per_segundonombre'];
                $per_primerapellido = $dta_vldcion['per_primerapellido'];
                $per_segundoapellido = $dta_vldcion['per_segundoapellido'];
                $per_genero = $dta_vldcion['per_genero'];
                $per_tipoidentificacion = $dta_vldcion['per_tipoidentificacion'];
                $per_identificacion = $dta_vldcion['per_identificacion'];
                $per_estado = $dta_vldcion['per_estado'];
                $per_fechanacimiento = $dta_vldcion['per_fechanacimiento'];
                $per_municipionacimiento = $dta_vldcion['per_municipionacimiento'];
                $per_foto = $dta_vldcion['per_foto'];
                $per_nacionalidad = $dta_vldcion['per_nacionalidad'];
                $per_otranacionalidad = $dta_vldcion['per_otranacionalidad'];
                $dba_estadocivil = $dta_vldcion['dba_estadocivil'];
                $dba_rh = $dta_vldcion['dba_rh'];
                $dba_direccion = $dta_vldcion['dba_direccion'];
                $dba_municipioresidencia = $dta_vldcion['dba_municipioresidencia'];
                $dba_correo = $dta_vldcion['dba_correo'];
                $dba_telefono = $dta_vldcion['dba_telefono'];
                $dba_celular = $dta_vldcion['dba_celular'];
                $dba_estado = $dta_vldcion['dba_estado'];
                $dba_lugarexpedicion = $dta_vldcion['dba_lugarexpedicion'];
                $dba_eps = $dta_vldcion['dba_eps'];
                $dba_sisben = $dta_vldcion['dba_sisben'];
                $dba_ocupacion = $dta_vldcion['dba_ocupacion'];
                $dba_estrato = $dta_vldcion['dba_estrato'];
    
                $fecha_nacimiento = substr($per_fechanacimiento,0,10);

                $rs_dtos_gnrales = $this->dtos_gnrales($per_codigo);
                if($rs_dtos_gnrales){
                    foreach ($rs_dtos_gnrales as $dta_dtos_gnerales) {
                        $dge_codigo = $dta_dtos_gnerales['dge_codigo'];
                        $dge_estado = $dta_dtos_gnerales['dge_estado'];
                        $dge_fechaingreso = $dta_dtos_gnerales['dge_fechaingreso'];
                        $dge_estatura = $dta_dtos_gnerales['dge_estatura'];
                        $dge_peso = $dta_dtos_gnerales['dge_peso'];
                        $dge_camisa = $dta_dtos_gnerales['dge_camisa'];
                        $dge_tallapantalon = $dta_dtos_gnerales['dge_tallapantalon'];
                        $dge_zapatos = $dta_dtos_gnerales['dge_zapatos'];
                        $dge_materiafavorita = $dta_dtos_gnerales['dge_materiafavorita'];
                        $dge_vivecon = $dta_dtos_gnerales['dge_vivecon'];
                        $dge_hobbies = $dta_dtos_gnerales['dge_hobbies'];
                        $dge_comidafavorita = $dta_dtos_gnerales['dge_comidafavorita'];
                        $dge_contextofamiliar = $dta_dtos_gnerales['dge_contextofamiliar'];
                        $dge_avances = $dta_dtos_gnerales['dge_avances'];
                        $dge_valoracionesmedicas = $dta_dtos_gnerales['dge_valoracionesmedicas'];
                        $dge_condicionsalud = $dta_dtos_gnerales['dge_condicionsalud']; 
                        $dge_vacuna = $dta_dtos_gnerales['dge_vacuna'];
                        $dge_descripcionvacuna = $dta_dtos_gnerales['dge_descripcionvacuna']; 
                        $dge_alergia = $dta_dtos_gnerales['dge_alergia'];
                        $dge_descripcionalergia = $dta_dtos_gnerales['dge_descripcionalergia'];
                        $dge_medicamento = $dta_dtos_gnerales['dge_medicamento'];
                        $dge_descripcionmedicamento = $dta_dtos_gnerales['dge_descripcionmedicamento'];
                        $dge_procesoicbf = $dta_dtos_gnerales['dge_procesoicbf'];
                        $dge_descripcionprocesoicbf = $dta_dtos_gnerales['dge_descripcionprocesoicbf'];

                        if($fecha_nacimiento && $dge_fechaingreso){
                            $diferencia_fechas= abs(strtotime($dge_fechaingreso) - strtotime($fecha_nacimiento));

                            $edad_ingreso = floor($diferencia_fechas / (365*60*60*24));
                        }
                    }
                }

                

                if($per_nacionalidad == 1){
                    if($per_municipionacimiento){
                        $dane_dep_nacimiento = $this->dane_dep($per_municipionacimiento);
                        if($dane_dep_nacimiento){
                            $dep_nace = $this->cdgo_dprtmnto($dane_dep_nacimiento);
                        }
                        else{
                            $dep_nace = 0;
                            $dane_dep_nacimiento = 0;
                        }
                    }
                    else{
                        $dane_dep_nacimiento = 0;
                        $dep_nace = 0;
                        $per_municipionacimiento = 0;
                    }
                    
                }
                else{
                    $dane_dep_nacimiento = 0;
                    $dep_nace = 0;
                    $per_municipionacimiento = 0;
                }

                if($dba_municipioresidencia){
                    $dane_dep_residencia = $this->dane_dep($dba_municipioresidencia);
                    if($dane_dep_residencia){
                        $dep_residencia = $this->cdgo_dprtmnto($dane_dep_residencia);
                    }
                    else{
                        $dep_residencia = 0;
                        $dane_dep_residencia = 0;
                    }
                }
                else{
                    $dane_dep_residencia = 0;
                    $dep_residencia = 0;
                    $dba_municipioresidencia = 0;
                }
                
                if($fecha_nacimiento){
                    $fecha_actual = date('Y-m-d');

                    $diferencia_fechas= abs(strtotime($fecha_actual) - strtotime($fecha_nacimiento));

                    $edad = floor($diferencia_fechas / (365*60*60*24));
                }
                else{
                    $edad = 0;
                }
    
            

                $rsVldcioness[] = array('per_codigo'=> $per_codigo,
                                        'primer_nombre'=> $per_nombre,
                                        'segundo_nombre'=> $per_segundonombre,
                                        'primer_apellido'=> $per_primerapellido,
                                        'segundo_apellido'=> $per_segundoapellido,
                                        'genero'=> $per_genero,
                                        'tipo_identificacion'=> $per_tipoidentificacion,
                                        'estado_persona'=> $per_estado,
                                        'nacionalidad'=> $per_nacionalidad,
                                        'fecha_nacimiento'=> $fecha_nacimiento,
                                        'edad'=> $edad,
                                        'dane_dep_nacimiento'=> $dane_dep_nacimiento,
                                        'dep_nace'=> $dep_nace,
                                        'municipio_nacimiento'=> $per_municipionacimiento,
                                        'foto'=> $per_foto,
                                        'otra_nacionalidad'=> $per_otranacionalidad,
                                        'estado_civil'=> $dba_estadocivil,
                                        'rh'=> $dba_rh,
                                        'dane_dep_residencia'=> $dane_dep_residencia,
                                        'dep_residencia'=> $dep_residencia,
                                        'direccion_residencia'=> $dba_direccion,
                                        'municipio_residencia'=> $dba_municipioresidencia,
                                        'correo_electronico'=> $dba_correo,
                                        'telefono'=> $dba_telefono,
                                        'celular'=> $dba_celular,
                                        'lugar_expedicion'=> $dba_lugarexpedicion,
                                        'eps'=> $dba_eps,
                                        'sisben'=> $dba_sisben,
                                        'ocupacion'=> $dba_ocupacion,
                                        'estrato'=> $dba_estrato,//
                                        'estado_ninio'=> $dge_estado,
                                        'fecha_ingreso'=> $dge_fechaingreso,
                                        'edad_ingreso'=> $edad_ingreso,
                                        'estatura'=> $dge_estatura,
                                        'peso'=> $dge_peso,
                                        'talla_camiseta'=> $dge_camisa,
                                        'talla_pantalon'=> $dge_tallapantalon,
                                        'talla_zapatos'=> $dge_zapatos,
                                        'materia_favorita'=> $dge_materiafavorita,
                                        'vivecon'=> $dge_vivecon,
                                        'hobbies'=> $dge_hobbies,
                                        'comida_favorita'=> $dge_comidafavorita,
                                        'contexto_familiar'=> $dge_contextofamiliar,
                                        'avances_hogar'=> $dge_avances,
                                        'valoracion_medica'=> $dge_valoracionesmedicas,
                                        'condicion_salud'=> $dge_condicionsalud,
                                        'vacuna'=> $dge_vacuna,
                                        'descripcion_vacuna'=> $dge_descripcionvacuna,
                                        'alergia'=> $dge_alergia,
                                        'descripcion_alergia'=> $dge_descripcionalergia,
                                        'medicamento'=> $dge_medicamento,
                                        'descripcion_medicamento'=> $dge_descripcionmedicamento,
                                        'proceso_icbf'=> $dge_procesoicbf,
                                        'descripcion_icbf'=> $dge_descripcionprocesoicbf,
                                        'status'=> 200,
                                        'sms'=> "La persona ya se encuentra registrada en el sistema",
                                    );
                
            }
            $dtaVlidcion=json_encode($rsVldcioness);
        }
        else{
            $rsVldcioness[] = array('status'=> 204,
                                    'sms'=> "Información Validada",
                                );
            $dtaVlidcion=json_encode($rsVldcioness);
        }
        return $dtaVlidcion;
    }

    

}
?>
