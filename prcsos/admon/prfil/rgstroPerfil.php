<?php
    
    include('classPerfil.php');


    class RgstroPrfil extends Perfil{

        private $codigo_perfil;
        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_perfil = date('YmdHis').rand(99,999);
        }

        public function insertPerfil(){
            
            $sql_insert_perfil="INSERT INTO principal.perfil(
                                            prf_codigo, 
                                            prf_nombre, 
                                            prf_estado, 
                                            prf_fechacreo,
                                            prf_fechamodifico, 
                                            prf_personacreo, 
                                            prf_personamodifico)
                                    VALUES (".$this->codigo_perfil.", 
                                            '".$this->getNombrePerfil()."', 
                                            ".$this->getEstadoPerfil().", 
                                            NOW(), 
                                            NOW(), 
                                            ".$this->getPersonaSistemaPerfil().", 
                                            ".$this->getPersonaSistemaPerfil().");";
            
            $query_insert_perfil=$this->cnxion->ejecutar($sql_insert_perfil);

            return $sql_insert_perfil;
        }

    }



?>

