<?php

    include_once('classCcso.php');

    class Csso extends Acceso{

        private $prsona;
        private $nomprsona;
        private $apeprsona;
        private $string;
        private $largo;
        private $final_array;
        private $caracter;
        private $sql_login;
        private $consulta_login;
        private $numero;
        private $datos;
        private $entroAcceso;
        private $perfil;
        private $cnxion;
        private $subsispersona;
        private $sql_subsistema;
        private $visibilidadbotones;
        private $sql_perfil;
        private $sql_visibilidadBotones;

        public function __construct(){

            $this->prsona = $prsona;
            $this->nomprsona = $nomprsona;
            $this->apeprsona = $apeprsona;
            $this->entroAcceso= $entroAcceso;

        }

        public function acceso(){ //$user, $paswd
            $cnxion =  $this->getConexion();
            $usuario = $this->getUser();
            $paswd = $this->getPasswd();

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
            
            
            $sql_login="SELECT principal.usepersona.per_codigo, principal.usepersona.use_alias, principal.usepersona.use_pswd, principal.usepersona.use_estado,
                               principal.usepersona.use_fechacreo, principal.persona.per_nombre, principal.persona.per_primerapellido, principal.persona.per_segundoapellido
                        FROM principal.usepersona, principal.persona
                        WHERE md5(principal.usepersona.use_alias)='".$usuario."'
                        AND principal.usepersona.use_pswd='".$pass."'
                        AND principal.usepersona.per_codigo=persona.per_codigo
                        AND principal.persona.per_estado='1'";
            //echo $sql_login;
            
            $consulta_login=$cnxion->ejecutar($sql_login);
            $numero=$cnxion->numero_filas($consulta_login);
            $datos=$cnxion->obtener_filas($consulta_login);
            
            if($numero > 0){
                $this->entroAcceso = "acceso_ok";
            }
            else{
                $this->entroAcceso = "acceso_nok".$pass;
            }

            ////////Karen Yuliana 

            $sql_visibilidadBotones="SELECT COUNT(*) AS visibilidad
                                        FROM principal.persona_perfil
                                        WHERE CAST(ppf_perfil AS bigint)=3
                                        AND CAST(ppf_persona AS bigint)=".$datos['per_codigo'].";";

            $consulta_visibilidadBotones=$cnxion->ejecutar($sql_visibilidadBotones);
            $data_visibilidad=$cnxion->obtener_filas($consulta_visibilidadBotones);

            $numero_visibilidad=$data_visibilidad['visibilidad'];

            if($numero_visibilidad==0){
                $this->visibilidadbotones="block";
            }
            else{
                $this->visibilidadbotones="none";
            }


            $sql_perfil="SELECT ppf_codigo, ppf_persona, ppf_perfil
                           FROM principal.persona_perfil
                          WHERE CAST(ppf_persona AS bigint)=".$datos['per_codigo'].";";

            $consulta_perfil=$cnxion->ejecutar($sql_perfil);
            $data_perfil=$cnxion->obtener_filas($consulta_perfil);

            $this->perfil=$data_perfil['ppf_perfil'];


            //////////////////////////

            $sql_subsistema=" SELECT epe_entidad
                                FROM principal.entidad_persona
                                WHERE epe_persona=".$datos['per_codigo'].";";
            $consulta_subsistema=$cnxion->ejecutar($sql_subsistema);
            $numeroSubsistema=$cnxion->numero_filas($consulta_subsistema);
            $datos_subsistema=$cnxion->obtener_filas($consulta_subsistema);


            $this->prsona=$datos['per_codigo'];
            $this->nomprsona=$datos['per_nombre'];
            $this->apeprsona=$datos['per_primerapellido']." ".$datos['per_segundoapellido'];
            
            if($numeroSubsistema>0){
                $this->subsispersona=$datos_subsistema['epe_entidad'];
            }
            else{
                 $this->subsispersona=0;
            }
            


           //return $sql_login;           
        }
		
        public function getPrsona(){
            return $this->prsona;
        }
        public function getNompersona(){
            return $this->nomprsona;
        }
        public function getApeprsona(){
            return $this->apeprsona;
        }
        public function getEntroAcceso(){
            return $this->entroAcceso;
        }
        public function getSubsispersona(){
            return $this->subsispersona;
        }

        public function getPerfil(){
            return $this->perfil;
        }

        public function getVisibilidadBotones(){
            return $this->visibilidadbotones;
        }


    }



?>