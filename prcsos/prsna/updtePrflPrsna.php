<?php
/**
 * Karen Yuliana Palacio Minú
 * 15 de Enero 2020 06:20 pm
 * Update Perfil Persona
 */
include('classPrflPrsna.php');
class UpdtePrflPrsna extends PerfilPersona{

    private $codigoPerfil;
    private $codigoUsuario;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoPerfil=date('YmdHis').rand(99,99999);
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
    
    public function updatePrflPrsna(){

        $psswd=$this->getContrasenia();
        if($psswd){
            // echo "---> Clave Persona: ".$psswd."<br><br>";
            $clavePersona=sha1($psswd);
            $claveModificar=$this->passwrd($clavePersona);
            $condicion=",use_pswd='$claveModificar'";
        }
        else{
            $condicion="";
        }
    
        $update_user="UPDATE principal.usepersona
                         SET use_alias='".$this->getAlias()."' $condicion
                       WHERE use_codigo=".$this->getCodigoUsuario().";";

        echo "Update Usuario <br>".$update_user;
        $this->cnxion->ejecutar($update_user);


        ////////////////////////////////////////////////////////

        $delete_perfil="DELETE FROM principal.persona_perfil
                             WHERE ppf_persona='".$this->getCodigoPersona()."';";

                        echo "-->".$delete_perfil;
        $this->cnxion->ejecutar($delete_perfil);

        $insert_perfil="INSERT INTO principal.persona_perfil(
                                     ppf_codigo, ppf_persona, ppf_perfil)
                            VALUES ('".$this->codigoPerfil."', '".$this->getCodigoPersona()."', '".$this->getPerfil()."');";

        echo "-->".$insert_perfil;

        $this->cnxion->ejecutar($insert_perfil);

        /////////////////////////////////////////////////////////////////////

        $delete_personaSistema="DELETE FROM principal.persona_sistema
                        WHERE spe_persona='".$this->getCodigoPersona()."';";

        echo "-->".$delete_personaSistema;

        $this->cnxion->ejecutar($delete_personaSistema);

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
        ////////////////////////////////////////////////////////////
    }
}
?>