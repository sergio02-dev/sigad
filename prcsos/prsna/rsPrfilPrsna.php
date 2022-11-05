<?php
include('classPrflPrsna.php');
class PrflPrsna extends PerfilPersona{

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function Menu(){

        $sqlMenu="SELECT sys_codigo, sys_nombre, sys_url, sys_file, sys_dir, sys_imagen, 
                         sys_estado, sys_tipo, sys_nivel, sys_padre, sys_nivelurl
                    FROM principal.system
                   WHERE sys_nivel=1
                     AND sys_tipo IN(1,0)
                ORDER BY sys_codigo ASC;";

        $queryMenu=$this->cnxion->ejecutar($sqlMenu);

        while($data_Menu=$this->cnxion->obtener_filas($queryMenu)){
            $dataMenu[]=$data_Menu;
        }
        return $dataMenu;
    }
    public function SubMenu($sys_codigo){

        $sqlSubMenu="SELECT sys_codigo, sys_nombre, sys_url, sys_file, sys_dir, sys_imagen, 
                         sys_estado, sys_tipo, sys_nivel, sys_padre, sys_nivelurl
                    FROM principal.system
                   WHERE sys_tipo=2
                   AND sys_padre=$sys_codigo
                ORDER BY sys_codigo ASC;";

        $querySubMenu=$this->cnxion->ejecutar($sqlSubMenu);

        while($data_SubMenu=$this->cnxion->obtener_filas($querySubMenu)){
            $dataSubMenu[]=$data_SubMenu;
        }
        return $dataSubMenu;
    }

    public function perfil(){

        $sqlPerfil="SELECT pfr_codigo, pfr_nombre
                        FROM principal.perfil;";

        $queryPerfil=$this->cnxion->ejecutar($sqlPerfil);

        while($data_Perfil=$this->cnxion->obtener_filas($queryPerfil)){
            $dataPerfil[]=$data_Perfil;
        }
        return $dataPerfil;
    }

    public function perfilPersona(){

        $sqlPerfilPersona="SELECT ppf_codigo, ppf_persona, ppf_perfil
                             FROM principal.persona_perfil
                            WHERE ppf_persona='".$this->getCodigoPersona()."';";

        $queryPerfilPersona=$this->cnxion->ejecutar($sqlPerfilPersona);

        while($data_PerfilPersona=$this->cnxion->obtener_filas($queryPerfilPersona)){
            $dataPerfilPersona[]=$data_PerfilPersona;
        }
        return $dataPerfilPersona;
    }

    public function usuarioPersona(){

        $sqlUsuarioPersona="SELECT use_codigo, per_codigo, use_pswd, use_estado, use_fechacreo, 
                                   use_alias
                              FROM principal.usepersona
                             WHERE per_codigo=".$this->getCodigoPersona().";";

        $queryUsuarioPersona=$this->cnxion->ejecutar($sqlUsuarioPersona);

        while($data_UsuarioPersona=$this->cnxion->obtener_filas($queryUsuarioPersona)){
            $dataUsuarioPersona[]=$data_UsuarioPersona;
        }
        return $dataUsuarioPersona;
    }

    public function nombrePersona(){

        $sqlNombrePersona="SELECT per_codigo, per_nombre || ' ' || per_primerapellido || ' ' || per_segundoapellido AS nombre
                             FROM principal.persona
                            WHERE per_codigo=".$this->getCodigoPersona().";";

        $queryNombrePersona=$this->cnxion->ejecutar($sqlNombrePersona);

        $data_NombrePersona=$this->cnxion->obtener_filas($queryNombrePersona);

        $nombre=$data_NombrePersona['nombre'];
            
        return $nombre;
    }

    
    public function checkeadoMenu(){

        $sqlCheckeadoMenu="SELECT COUNT(*) AS checkead 
                            FROM principal.persona_sistema
                            WHERE spe_persona='".$this->getCodigoPersona()."'
                              AND spe_sistema='".$this->getSistema()."';";

        $queryCheckeadoMenu=$this->cnxion->ejecutar($sqlCheckeadoMenu);

        $data_CheckeadoMenu=$this->cnxion->obtener_filas($queryCheckeadoMenu);

        $checkead=$data_CheckeadoMenu['checkead'];
         
        return $checkead;
    }

}
?>