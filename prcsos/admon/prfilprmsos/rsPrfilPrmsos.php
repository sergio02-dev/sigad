<?php

    include('classPerfilPermisos.php');

    class RsPerfilPermiso extends PerfilPermisosPermisos{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function menu(){

            $sql_menu="SELECT sys_codigo, sys_nombre, sys_url, sys_file, sys_dir, sys_imagen, 
                              sys_estado, sys_tipo, sys_nivel, sys_padre, sys_nivelurl
                        FROM principal.system
                       WHERE sys_nivel=1
                         AND sys_codigo NOT IN(44, 45, 51, 52, 61, 70, 73)
                         AND sys_tipo IN(1,0)
                    ORDER BY sys_codigo ASC;";

            $query_menu=$this->cnxion->ejecutar($sql_menu);

            while($data_menu=$this->cnxion->obtener_filas($query_menu)){
                $datamenu[]=$data_menu;
            }
            return $datamenu;
        }

        public function sub_menu($sys_codigo){

            $sql_sub_menu="SELECT sys_codigo, sys_nombre, sys_url, sys_file, sys_dir, sys_imagen, 
                                  sys_estado, sys_tipo, sys_nivel, sys_padre, sys_nivelurl
                             FROM principal.system
                            WHERE sys_tipo=2
                              AND sys_padre=$sys_codigo
                             ORDER BY sys_codigo ASC";

            $query_sub_menu=$this->cnxion->ejecutar($sql_sub_menu);

            while($data_sub_menu=$this->cnxion->obtener_filas($query_sub_menu)){
                $datasub_menu[]=$data_sub_menu;
            }
            return $datasub_menu;
        }

        public function list_perfil(){

            $sql_list_perfil="SELECT prf_codigo, prf_nombre, prf_estado
                                FROM principal.perfil
                            WHERE prf_estado = 1;";

            $query_list_perfil=$this->cnxion->ejecutar($sql_list_perfil);

            while($data_list_perfil=$this->cnxion->obtener_filas($query_list_perfil)){
                $datalist_perfil[]=$data_list_perfil;
            }
            return $datalist_perfil;
        }

        public function perfil_permisos(){

            $sql_perfil_permisos="SELECT DISTINCT (psi_perfil)
                                    FROM principal.perfil_sistema
                                   WHERE psi_estado = 1;";

            $query_perfil_permisos=$this->cnxion->ejecutar($sql_perfil_permisos);

            while($data_perfil_permisos=$this->cnxion->obtener_filas($query_perfil_permisos)){
                $dataperfil_permisos[]=$data_perfil_permisos;
            }
            return $dataperfil_permisos;
        }

        public function nombre_perfil($codigo_perfil){

            $sql_nombre_perfil="SELECT prf_codigo, prf_nombre, prf_estado
                                  FROM principal.perfil
                                 WHERE prf_codigo = $codigo_perfil;";

            $query_nombre_perfil=$this->cnxion->ejecutar($sql_nombre_perfil);

            $data_nombre_perfil=$this->cnxion->obtener_filas($query_nombre_perfil);

            $prf_nombre = $data_nombre_perfil['prf_nombre'];

            return $prf_nombre;
        }

        public function sistema_permiso_perfil($perfil){

            $sql_sistema_permiso_perfil="SELECT psi_perfil, psi_codigo, psi_sistema, 
                                                psi_estado, sys_nombre, sys_codigo
                                            FROM principal.perfil_sistema, principal.system
                                        WHERE sys_codigo = psi_sistema
                                        AND sys_tipo IN(1,0)
                                        AND psi_estado = 1
                                        AND psi_perfil = $perfil;";

            $query_sistema_permiso_perfil=$this->cnxion->ejecutar($sql_sistema_permiso_perfil);

            while($data_sistema_permiso_perfil=$this->cnxion->obtener_filas($query_sistema_permiso_perfil)){
                $datasistema_permiso_perfil[]=$data_sistema_permiso_perfil;
            }
            return $datasistema_permiso_perfil;
        }

        public function sistema_permiso_prfil_inferion($perfil, $padre){

            $sql_sistema_permiso_prfil_inferion="SELECT psi_perfil, psi_codigo, psi_sistema, psi_estado, sys_nombre
                                                   FROM principal.perfil_sistema, principal.system
                                                  WHERE sys_codigo = psi_sistema
                                                    AND sys_tipo = 2
                                                    AND psi_estado = 1
                                                    AND psi_perfil = $perfil
                                                    AND sys_padre = $padre;";

            $query_sistema_permiso_prfil_inferion=$this->cnxion->ejecutar($sql_sistema_permiso_prfil_inferion);

            while($data_sistema_permiso_prfil_inferion=$this->cnxion->obtener_filas($query_sistema_permiso_prfil_inferion)){
                $datasistema_permiso_prfil_inferion[]=$data_sistema_permiso_prfil_inferion;
            }
            return $datasistema_permiso_prfil_inferion;
        }

        public function check_menu($codigo_perfil, $system){

            $sql_nombre_perfil="SELECT COUNT(*) AS chequear
                                  FROM principal.perfil_sistema
                                 WHERE psi_estado = 1
                                   AND psi_perfil = $codigo_perfil
                                   AND psi_sistema = $system";

            $query_nombre_perfil=$this->cnxion->ejecutar($sql_nombre_perfil);

            $data_nombre_perfil=$this->cnxion->obtener_filas($query_nombre_perfil);

            $chequear = $data_nombre_perfil['chequear'];

            return $chequear;
        }

       
    }
?>