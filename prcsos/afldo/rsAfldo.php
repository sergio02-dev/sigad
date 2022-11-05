<?php 
include('classAfldo.php');
class RsAfldo extends Afiliado{

    private $cnxion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function selectTipoIdentificacion(){

        $sql_tipoidentificacion="SELECT tid_codigo, tid_nombre, tid_referencia
                                  FROM principal.tipo_identificacion
                                  ORDER BY tid_nombre ASC;";

        $query_tipoidentificacion=$this->cnxion->ejecutar($sql_tipoidentificacion);

        while($data_tipoidentificacion=$this->cnxion->obtener_filas($query_tipoidentificacion)){
            $dataTipoIdentificacion[]=$data_tipoidentificacion;
        }
        return $dataTipoIdentificacion;

    }

    public function selectRh(){

        $sql_rh="SELECT rh_codigo, rh_nombre, rh_estado
                   FROM principal.rh
                  ORDER BY rh_nombre ASC;";

        $query_rh=$this->cnxion->ejecutar($sql_rh);

        while($data_rh=$this->cnxion->obtener_filas($query_rh)){
            $datarh[]=$data_rh;
        }
        return $datarh;

    }

    public function selectEstadoCivil(){

        $sql_estadoCivil="SELECT eci_codigo, eci_nombre, eci_estado
                            FROM principal.estado_civil
                            ORDER BY eci_nombre ASC;";

        $query_estadoCivil=$this->cnxion->ejecutar($sql_estadoCivil);

        while($data_estadoCivil=$this->cnxion->obtener_filas($query_estadoCivil)){
            $dataestadoCivil[]=$data_estadoCivil;
        }
        return $dataestadoCivil;

    }

    public function selectProfesion(){

        $sql_profesion="SELECT pro_codigo, pro_nombre, pro_estado
                          FROM principal.profesion
                         ORDER BY pro_nombre ASC;";

        $query_profesion=$this->cnxion->ejecutar($sql_profesion);

        while($data_profesion=$this->cnxion->obtener_filas($query_profesion)){
            $dataprofesion[]=$data_profesion;
        }
        return $dataprofesion;

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

    public function selectAfiliadoNuevo($codigo_persona){

        $sql_afiliadoNuevo="SELECT per_codigo, per_nombre, per_primerapellido, per_segundoapellido,  per_segundonombre
                                FROM principal.persona, afiliado.afiliado
                                WHERE per_codigo=afi_persona
                                AND  per_codigo=$codigo_persona;";

        $query_afiliadoNuevo=$this->cnxion->ejecutar($sql_afiliadoNuevo);

        while($data_afiliadoNuevo=$this->cnxion->obtener_filas($query_afiliadoNuevo)){
            $dataafiliadoNuevo[]=$data_afiliadoNuevo;
        }
        return $dataafiliadoNuevo;

    }

    public function infoAfiliado($per_codigo){

        $sql_infoAfiliado="SELECT per_codigo, per_nombre, per_primerapellido, per_segundoapellido, per_genero, per_tipoidentificacion,
                                  per_identificacion,  per_segundonombre, per_fechanacimiento, per_municipionacimiento,
                                  afi_codigo, afi_fechaafiliacion, afi_peso, afi_estatura, afi_estado,
		                          afi_observacion, dba_codigo,  dba_estadocivil, dba_profesion, 
                                  dba_rh, dba_direccion, dba_municipioresidencia, dba_correo, 
                                  dba_telefono, dba_celular
                             FROM principal.persona, afiliado.afiliado, principal.datos_basicos
                             WHERE per_codigo=afi_persona
                               AND per_codigo=dba_persona
                               AND per_codigo=$per_codigo;";

        $query_infoAfiliado=$this->cnxion->ejecutar($sql_infoAfiliado);

        while($data_infoAfiliado=$this->cnxion->obtener_filas($query_infoAfiliado)){
            $datainfoAfiliado[]=$data_infoAfiliado;
        }
        return $datainfoAfiliado;

    }

    public function nombre_tipide($tipoIde){

        $sql_nombre_tipide="SELECT tid_codigo, tid_nombre, tid_referencia
                              FROM principal.tipo_identificacion
                             WHERE tid_codigo=$tipoIde;";

        $query_nombre_tipide=$this->cnxion->ejecutar($sql_nombre_tipide);

        $data_nombre_tipide=$this->cnxion->obtener_filas($query_nombre_tipide);

        $tid_nombre=$data_nombre_tipide['tid_nombre'];
        
        return $tid_nombre;

    }

    public function nombre_rh($rh_codigo){

        $sql_nombre_rh="SELECT rh_codigo, rh_nombre, rh_estado
                              FROM principal.rh
                             WHERE rh_codigo=$rh_codigo;";

        $query_nombre_rh=$this->cnxion->ejecutar($sql_nombre_rh);

        $data_nombre_rh=$this->cnxion->obtener_filas($query_nombre_rh);

        $rh_nombre=$data_nombre_rh['rh_nombre'];
        
        return $rh_nombre;

    }

    public function nombre_profesion($profesion){

        $sql_nombre_profesion="SELECT pro_codigo, pro_nombre, pro_estado
                                 FROM principal.profesion
                                WHERE pro_codigo=$profesion;";

        $query_nombre_profesion=$this->cnxion->ejecutar($sql_nombre_profesion);

        $data_nombre_profesion=$this->cnxion->obtener_filas($query_nombre_profesion);

        $pro_nombre=$data_nombre_profesion['pro_nombre'];
        
        return $pro_nombre;

    }

    public function nombre_estadocivil($estocivil){

        $sql_nombre_estadocivil="SELECT eci_codigo, eci_nombre, eci_estado
                                   FROM principal.estado_civil
                                  WHERE eci_codigo=$estocivil;";

        $query_nombre_estadocivil=$this->cnxion->ejecutar($sql_nombre_estadocivil);

        $data_nombre_estadocivil=$this->cnxion->obtener_filas($query_nombre_estadocivil);

        $eci_nombre=$data_nombre_estadocivil['eci_nombre'];
        
        return $eci_nombre;

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

    public function dep_nombre($dep){

        $sql_dep_nombre="SELECT dep_codigo, dep_nombre, dep_dane
                           FROM principal.departamento
                          WHERE CAST(dep_dane AS BIGINT)=$dep;";

        $query_dep_nombre=$this->cnxion->ejecutar($sql_dep_nombre);

        $data_dep_nombre=$this->cnxion->obtener_filas($query_dep_nombre);

        $dep_nombre=$data_dep_nombre['dep_nombre'];
        
        return $dep_nombre;

    }

    public function codigo_departamento($dep){

        $sql_codigo_departamento="SELECT dep_codigo, dep_nombre, dep_dane
                                    FROM principal.departamento
                                   WHERE CAST(dep_dane AS BIGINT)=$dep;";

        $query_codigo_departamento=$this->cnxion->ejecutar($sql_codigo_departamento);

        $data_codigo_departamento=$this->cnxion->obtener_filas($query_codigo_departamento);

        $dep_codigo=$data_codigo_departamento['dep_codigo'];
        
        return $dep_codigo;

    }

    public function selectCotizantes(){

        $sql_cotizante="SELECT per_codigo, per_nombre, per_primerapellido, per_segundoapellido,  per_segundonombre
                                FROM principal.persona, afiliado.afiliado
                                WHERE per_codigo=afi_persona
                                AND  afi_estado=1;";

        $query_cotizante=$this->cnxion->ejecutar($sql_cotizante);

        while($data_cotizante=$this->cnxion->obtener_filas($query_cotizante)){
            $datacotizante[]=$data_cotizante;
        }
        return $datacotizante;

    }

    
}


?>