<?php


    include_once('classCcso.php');
    class TokenLogin extends Acceso{

        private $usuario;
        private $password;

        public function TokenLogin(){}


        public function tokeningreso(){
            
            $usuario=$this->getUser();
            $password=$this->getPasswd();
            $timeingreso=date('YmdHis');
            $encriptacion=$usuario.$password.$timeingreso;

            $tokenData=hash('sha512', $encriptacion);

            return $tokenData;

        }
    }


?>