<?php
    
    include_once('rgstroSstem.php');


    class ResgistrarAcceso extends Racceso{

        private $acc_codigo;
        private $acc_persona;
        private $acc_fechahora;
        private $acc_ip;
        private $acc_token;
        private $acc_system;


        
        public function __construct(){
            $this->cnxn=$this->getConexion();
        }


        public function insertAcceso(){

            $acc_codigo=$this->getAccCodigo();
            $acc_persona=$this->getAccPersona();
            $acc_fechahora=$this->getAccFechahora();
            $acc_ip=$this->getAccIp();
            $acc_token=$this->getAccToken();
            $acc_system=$this->getAccSystem();
            
            $sql_insertAcceso=" INSERT INTO principal.acceso(acc_codigo, acc_persona, acc_fechahora, acc_ip, acc_token, acc_system)
                                VALUES (".$acc_codigo.", ".$acc_persona.", NOW(), '". $acc_ip."', '".$acc_token."', '".$acc_system."'); ";
            $query_insertAcceso=$this->cnxn->ejecutar($sql_insertAcceso);

        }

    }



?>

