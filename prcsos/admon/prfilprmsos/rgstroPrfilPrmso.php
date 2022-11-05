<?php
    
    include('classPerfilPermisos.php');


    class RgstroPrfilPrmso extends PerfilPermisosPermisos{

        private $cnxion;
        
        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function insertPerfilPermiso(){

            $hasta = count($this->getCodigoSistemaPerfilPermisos());

            $sistema = $this->getCodigoSistemaPerfilPermisos();


            $perfil = $this->getCodigoPerfilPermisos();

            $sql_perfil_permise = "UPDATE principal.perfil_sistema
                                      SET psi_estado = 0,
                                          psi_fechamodifico = NOW(),
                                          psi_personamodifico = ".$this->getPersonaSistemaPerfilPermisos()."
                                    WHERE psi_perfil = $perfil;";

            $query_perfil_permise = $this->cnxion->ejecutar($sql_perfil_permise);

            for ($desde = 0; $desde < $hasta; $desde++) { 

                $codigo_perfil[$desde] = date('YmdHis').rand(99,999);

                $sql_insert_perfil_permiso[$desde]="INSERT INTO principal.perfil_sistema(
                                                                psi_codigo, 
                                                                psi_perfil, 
                                                                psi_sistema, 
                                                                psi_estado, 
                                                                psi_fechacreo, 
                                                                psi_fechamodifico, 
                                                                psi_personacreo, 
                                                                psi_personamodifico)
                                                        VALUES ($codigo_perfil[$desde],
                                                                ".$this->getCodigoPerfilPermisos().", 
                                                                $sistema[$desde], 
                                                                1, 
                                                                NOW(), 
                                                                NOW(), 
                                                                ".$this->getPersonaSistemaPerfilPermisos().", 
                                                                ".$this->getPersonaSistemaPerfilPermisos().");";

                $query_insert_perfil[$desde]=$this->cnxion->ejecutar($sql_insert_perfil_permiso[$desde]);
            }
            
            

            
        }

    }



?>

