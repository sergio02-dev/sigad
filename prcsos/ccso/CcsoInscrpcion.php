<?php

    include_once('classCcso.php');

    class Csso extends Acceso{

        private $actualizacion;
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
        private $cnxion;

        public function __construct(){

            $this->actualizacion=$actualizacion;
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
            
            
            $sql_login="SELECT principal.usepersona.per_codigo, principal.usepersona.use_alias, 
                               principal.usepersona.use_pswd, principal.usepersona.use_estado,
                               principal.usepersona.use_fechacreo, principal.persona.per_nombre, 
                               principal.persona.per_primerapellido, principal.persona.per_segundoapellido
                        FROM principal.usepersona, principal.persona
                        WHERE md5(principal.usepersona.use_alias)='".$usuario."'
                        AND principal.usepersona.use_pswd='".$pass."'
                        AND principal.usepersona.per_codigo=persona.per_codigo";
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


            $this->prsona=$datos['per_codigo'];
            $this->nomprsona=$datos['per_nombre'];
            $this->apeprsona=$datos['per_primerapellido']." ".$datos['per_segundoapellido'];

           // return $sql_login;           
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

    }



?>