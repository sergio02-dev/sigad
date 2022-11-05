<?php
/**
 * Karen Yuliana Palacio Minú
 * 13 de Enero 2020 06:20 pm
 * Registro Persona
 */
include('classPrflPrsna.php');
class RgstroPrflPrsna extends PerfilPersona{

    private $codigoPerfil;
    private $codigoUsuario;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoPerfil=date('YmdHis').rand(99,99999);
        $this->codigoUsuario=date('YmdHis').rand(99,99999);
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
    
    public function insertPrflPrsna(){

        $psswd=$this->getContrasenia();
        echo "---> Clave Persona: ".$psswd."<br><br>";
        $clavePersona=sha1($psswd);

        $claveInsertar=$this->passwrd($clavePersona);


        $insert_user="INSERT INTO principal.usepersona(
                                    use_codigo, per_codigo, use_pswd, use_estado, use_fechacreo, 
                                    use_alias)
                            VALUES (".$this->codigoUsuario.", ".$this->getCodigoPersona().", '".$claveInsertar."', '1', NOW(), 
                                    '".$this->getAlias()."');";

        echo "Insert Usuario <br>".$insert_user;
        $this->cnxion->ejecutar($insert_user);

        $insert_perfil="INSERT INTO principal.persona_perfil(
                                     ppf_codigo, ppf_persona, ppf_perfil)
                            VALUES ('".$this->codigoPerfil."', '".$this->getCodigoPersona()."', '".$this->getPerfil()."');";

        echo "-->".$insert_perfil;
        $this->cnxion->ejecutar($insert_perfil);

        $cantidadInsert=$this->getCantidadInsert();
        $sistema=$this->getSistema();

        for($inicioInsert=0; $inicioInsert<$cantidadInsert; $inicioInsert++){

            $codigoSistemaPersona=date('YmdHis').rand(99,99999);

            $insertSistema[$inicioInsert]="INSERT INTO principal.persona_sistema(
                                                        spe_codigo, spe_persona, spe_sistema, spe_personacreo, spe_personamodifico, 
                                                        spe_fechacreo, spe_fechamodifico)
                                                VALUES (".$codigoSistemaPersona.", '".$this->getCodigoPersona()."', '".$sistema[$inicioInsert]."', '".$this->getPersonaSistema()."', '".$this->getPersonaSistema()."', 
                                                        NOW(), NOW());";
                echo "---> ".$insertSistema[$inicioInsert];
            $this->cnxion->ejecutar($insertSistema[$inicioInsert]);
        }

    }
}
?>