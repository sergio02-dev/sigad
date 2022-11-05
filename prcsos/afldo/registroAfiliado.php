<?php
include('classAfldo.php');
class RgstroAfldo  extends Afiliado{

    private $insertPersona;
    private $insertDatosBasicos;
    private $insertAfiliado;
    private $codigoPersona;
    private $codigoAfiliado;
    private $codigoDatosBasicos;
    private $aleatoreo;
    private $codigoUsuario;
    private $codigoPtp;
    private $insertUsuario;
    private $insertTipoPersona;


    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoPersona=date('YmdHis').rand(99,999);
        $this->codigoAfiliado=date('YmdHis').rand(99,999);
        $this->codigoDatosBasicos=date('YmdHis').rand(99,999);
        $this->aleatoreo=date('YmdHis').rand(99,999);
        $this->codigoUsuario=date('YmdHis').rand(99,999);
        $this->codigoPtp=date('YmdHis').rand(99,999);
    }

    function passwrd($paswd){
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

    public function insert_afiliado(){

        $insertPersona="INSERT INTO principal.persona(
                                    per_codigo, per_nombre, per_primerapellido, 
                                    per_segundoapellido, per_personacreo, per_personamodifico, 
                                    per_fechacreo, per_fechamodifico, per_genero, 
                                    per_tipoidentificacion, per_identificacion, per_estado, 
                                    per_segundonombre, per_fechanacimiento, per_municipionacimiento, 
                                    per_aleatoreo)
                            VALUES (".$this->codigoPersona.", '".$this->getPrimerNombreAfiliado()."', '".$this->getPrimerApellidoAfiliado()."',
                                    '".$this->getSegundoApellidoAfiliado()."', '".$this->getPersonaSistema()."', '".$this->getPersonaSistema()."',
                                    NOW(), NOW(), '".$this->getGeneroAfiliado()."',
                                    ".$this->getTipoIdeAfiliado().", '".$this->getIdentificacionAfiliado()."', '1',
                                    '".$this->getSegundoNombreAfiliado()."', '".$this->getFechaNacimientoAfiliado()."', ".$this->getMunicipioNacimientoAfiliado().",
                                    ".$this->aleatoreo.");";

        $this->cnxion->ejecutar($insertPersona);

        $insertDatosBasicos="INSERT INTO principal.datos_basicos(
                                         dba_codigo, dba_persona, dba_estadocivil, 
                                         dba_profesion, dba_rh, dba_direccion,
                                         dba_municipioresidencia, dba_correo, dba_telefono,
                                         dba_celular, dba_estado, dba_fechacreo,
                                         dba_fechamodifico, dba_personacreo, dba_personamodifico)
                                 VALUES (".$this->codigoDatosBasicos.",".$this->codigoPersona.", ".$this->getEstadoCivilAfiliado().",
                                         ".$this->getProfesionAfiliado().", ".$this->getRhAfiliado().", '".$this->getDireccionAfiliado()."',
                                         ".$this->getMunicipioResidenciaAfiliado().", '".$this->getCorreoAfiliado()."', '".$this->getTelefonoAfiliado()."',
                                         ".$this->getCelularAfiliado().", 1, NOW(),
                                         NOW(), ".$this->getPersonaSistema().", ".$this->getPersonaSistema().");";

        $this->cnxion->ejecutar($insertDatosBasicos);

        $insertAfiliado="INSERT INTO afiliado.afiliado(
                                     afi_codigo, afi_persona, afi_fechaafiliacion,
                                     afi_peso, afi_estatura, afi_estado,
                                     afi_observacion, afi_fechacreo, afi_fechamodifico,
                                     afi_personacreo, afi_personamodifico)
                             VALUES (".$this->codigoAfiliado.", ".$this->codigoPersona.", '".$this->getFechaAfliacionAfiliado()."',
                                     ".$this->getPesoAfiliado().", ".$this->getEstaturaAfiliado().", 1,
                                     '".$this->getObservacionesAfiliado()."', NOW(), NOW(),
                                     ".$this->getPersonaSistema().", ".$this->getPersonaSistema().");";

        $this->cnxion->ejecutar($insertAfiliado);


        $psswd=$this->getIdentificacionAfiliado();
        $clavePersona=sha1($psswd);
        $claveInsertar=$this->passwrd($clavePersona);

        $insertUsuario="INSERT INTO principal.usepersona(
                                    use_codigo, per_codigo, use_pswd, 
                                    use_estado, use_fechacreo, use_alias, use_change)
                             VALUES (".$this->codigoUsuario.", ".$this->codigoPersona.",'".$claveInsertar."',
                                     '1', NOW(), '".$this->getIdentificacionAfiliado()."',
                                     0);";

        $this->cnxion->ejecutar($insertUsuario);

        $insertTipoPersona="INSERT INTO principal.persona_tipopersona(
                                        ptp_codigo, ptp_tipopersona, ptp_persona, 
                                        ptp_estado, ptp_fechacreo, ptp_fechamodifico, 
                                        ptp_personacreo, ptp_personamodifico)
                                VALUES (".$this->codigoPtp.", 2, ".$this->codigoPersona.",
                                         1, NOW(), NOW(), 
                                         ".$this->getPersonaSistema().", ".$this->getPersonaSistema().");";

        

        $this->cnxion->ejecutar($insertTipoPersona);



        return $this->codigoPersona;
        //return $insertPersona." <br><br> ".$insertDatosBasicos." <br><br> ".$insertAfiliado;
    }
}

?>