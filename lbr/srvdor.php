<?php

    class Servidor{

        public $Server;
        public $Ruta;
        public $Carpeta;
        public $online;
        public $enlace;

        public function __construct(){
            //$this->Server=$Server;
            //$this->Ruta=$Ruta;
            //$this->Carpeta=$Carpeta;
            //$this->online=$online;
            //$this->enlace=$enlace;
            $this->Server=$_SERVER['SERVER_NAME'];
            $this->Ruta=$_SERVER['PHP_SELF'];
            $this->Carpeta=dirname($_SERVER['SCRIPT_NAME']);

            
        }

        public function datos_servidor(){

            $nombreCarpeta = explode('/',$this->Carpeta);
    
    
            if (empty($nombreCarpeta[1])){
                $online = true;
                $enlace = 'http://'.$this->Server."/";
            }
            else{
                $online = false;
                $enlace = 'http://'.$this->Server.$this->Carpeta."/";
            }
			
			return array($online,$enlace);
            
    
        }

        public function getOnline(){
            list($online,$enlace)=$this->datos_servidor();
            return $online;
        }

        public function getEnlace(){
            list($online,$enlace)=$this->datos_servidor();
            return $enlace;
        }



    }

?>