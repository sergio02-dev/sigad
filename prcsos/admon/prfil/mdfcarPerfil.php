<?php
    
    include('classPerfil.php');

    class MdfcarPrfil extends Perfil{

        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function updtePerfil(){
            
            $sql_update_perfil="UPDATE principal.perfil
                                   SET prf_nombre='".$this->getNombrePerfil()."', 
                                       prf_estado=".$this->getEstadoPerfil().", 
                                       prf_fechamodifico=NOW(), 
                                       prf_personamodifico=".$this->getPersonaSistemaPerfil()."
                                 WHERE prf_codigo=".$this->getCodigoPerfil().";";
            
            $query_update_perfil=$this->cnxion->ejecutar($sql_update_perfil);

            return $sql_update_perfil;
        }

    }



?>
