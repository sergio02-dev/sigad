<?php
include('classPrsnaPrfil.php');
class UpdtePrsnaPrfil  extends PersonaPerfil{
    
    private $updte_user;
    private $codigoUsuario;


    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoUsuario=date('YmdHis').rand(99,999);
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

    public function updatePersonaPerfil(){

        $psswd=$this->getContraseniaPersona();

        if($psswd){
            $clavePersona=sha1($psswd);

            $claveInsertar=$this->passwrd($clavePersona);
            
            $condicion_contrasenia=", use_pswd = '$claveInsertar'";
        }
        else{
            $condicion_contrasenia="";
        }
        

        $updte_user="UPDATE principal.usepersona
                        SET use_alias='".$this->getUsuarioPersona()."' $condicion_contrasenia
                      WHERE per_codigo=".$this->getPersonaPersonaPerfil().";";

        echo "Update Usuario <br>".$updte_user;
        $this->cnxion->ejecutar($updte_user);

        $cantidadInsert=$this->getCantidadInsertar();
        $perfiles=$this->getPerfilPersonaPerfil();

        $delete_perfil="DELETE FROM principal.persona_tipopersona
                              WHERE ptp_persona=".$this->getPersonaPersonaPerfil().";";

        echo "---> ".$delete_perfil;

        $this->cnxion->ejecutar($delete_perfil);

        for($inicioInsert=0; $inicioInsert<$cantidadInsert; $inicioInsert++){

            $codigoPersonaPerfil=date('YmdHis').rand(99,99999);

            $insertPerfil[$inicioInsert]="INSERT INTO principal.persona_tipopersona(
                                                      ptp_codigo, 
                                                      ptp_tipopersona, 
                                                      ptp_persona, 
                                                      ptp_estado, 
                                                      ptp_fechacreo, 
                                                      ptp_fechamodifico, 
                                                      ptp_personacreo,
                                                      ptp_personamodifico)
                                               VALUES (".$codigoPersonaPerfil.", 
                                                       ".$perfiles[$inicioInsert].", 
                                                       ".$this->getPersonaPersonaPerfil().", 
                                                       1, 
                                                       NOW(), 
                                                       NOW(), 
                                                       ".$this->getPersonaSistema().", 
                                                       ".$this->getPersonaSistema().");";

                echo "<br>---> ".$insertPerfil[$inicioInsert];
            $this->cnxion->ejecutar($insertPerfil[$inicioInsert]);
        }
    }
}
?>
