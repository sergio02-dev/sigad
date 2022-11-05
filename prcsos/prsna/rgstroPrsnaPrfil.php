<?php
include('classPrsnaPrfil.php');
class RgsrtoPrsnaPrfil  extends PersonaPerfil{
    
    private $insert_user;
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

    public function insertPersonaPerfil(){

        $psswd=$this->getContraseniaPersona();

        $clavePersona=sha1($psswd);

        $claveInsertar=$this->passwrd($clavePersona);

        $insert_user="INSERT INTO principal.usepersona(
                                  use_codigo, per_codigo, use_pswd, use_estado, use_fechacreo, 
                                  use_alias)
                          VALUES (".$this->codigoUsuario.", ".$this->getPersonaPersonaPerfil().", '".$claveInsertar."', '1', NOW(), 
                                 '".$this->getUsuarioPersona()."');";

        echo "Insert Usuario <br>".$insert_user;
        $this->cnxion->ejecutar($insert_user);

        $cantidadInsert=$this->getCantidadInsertar();
        $perfiles=$this->getPerfilPersonaPerfil();

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
