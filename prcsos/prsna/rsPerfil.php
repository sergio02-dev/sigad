<?php 
include('classPrfil.php');

class RsPerfil extends Perfil{

    private $cnxion;
    private $codigoPersona;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function selectPerfil(){

        $sql_persona="SELECT prf_codigo, prf_nombre, prf_estado, prf_fechacreo, prf_fechamodifico, 
                             prf_personacreo, prf_personamodifico
                        FROM principal.perfil;";

        $query_persona=$this->cnxion->ejecutar($sql_persona);

        while($data_persona=$this->cnxion->obtener_filas($query_persona)){
        $dataPersona[]=$data_persona;
        }
        return $dataPersona;
    }

    public function usuario($codigo_persona){

        $sql_usuario="SELECT use_codigo, per_codigo, use_pswd, 
                             use_estado, use_fechacreo, use_alias
                        FROM principal.usepersona
                       WHERE per_codigo=$codigo_persona;";

        $query_usuario=$this->cnxion->ejecutar($sql_usuario);

        while($data_usuario=$this->cnxion->obtener_filas($query_usuario)){
            $datausuario[]=$data_usuario;
        }
        return $datausuario;
    }

    public function perfiles_persona($codigo_persona, $codigo_perfil){

        $sql_perfiles_persona="SELECT COUNT(*) AS perfil
                                 FROM principal.persona_tipopersona
                                WHERE ptp_tipopersona=$codigo_perfil
                                  AND ptp_persona=$codigo_persona;";

        $query_perfiles_persona=$this->cnxion->ejecutar($sql_perfiles_persona);

        $data_perfiles_persona=$this->cnxion->obtener_filas($query_perfiles_persona);

        $perfil=$data_perfiles_persona['perfil'];

        return $perfil;
    }
}
?>