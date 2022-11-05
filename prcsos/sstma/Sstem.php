<?php

 require_once('ClassSstma.php');


class Sstema extends Sistema{

    //private $sistema;
    private $contenidoSistema;
    private $seccionUrl;
    private $conexion;
    private $nombre_modulosytem;
    private $imagen_modulosytem;
    private $includefile;
    private $padreSystem;

    public function __construct(){
        $this->nombre_modulosytem=$nombre_modulosytem;
        $this->imagen_modulosytem=$imagen_modulosytem;
        $this->includefile=$includefile;
    }
	
	/*function nivel_url(){
	
		$seccionUrl = trim($this->getSeccionurl(), "0123456789?=_*");
		
		$sql_niveles=" SELECT sys_codigo, sys_nombre, sys_url, sys_file, sys_dir, sys_imagen, sys_estado, sys_tipo, sys_nivel, sys_padre, sys_nivelurl
						FROM principal.system
						WHERE sys_url='".$seccionUrl."'";

        
        $query_niveles = $conexion->ejecutar($sql_niveles);
		
		$data_niveles = $conexion->obtener_filas($query_niveles);
		
		$sys_nivel = $data_niveles['sys_nivel'];
		
		return $sys_nivel
		
	}*/
	

    function mostrarsistema(){

        $conexion = $this->getConexion();
        //$seccionUrl = $this->getSeccionurl();
        $seccionUrl = trim($this->getSeccionurl(), "0123456789?=_*");
        $contenidoSistema = $this->getContenido();

       

        $sql_mdlstmas=" SELECT sys_codigo, sys_nombre, sys_url, sys_file, sys_dir, sys_imagen, sys_estado, sys_tipo, sys_nivel, sys_padre, sys_nivelurl
                        FROM principal.system
                        WHERE sys_url='".$seccionUrl."'
                        AND sys_nivelurl=".$contenidoSistema."
                        AND sys_estado='1'; ";

        
        $query_mdlstmas=$conexion->ejecutar($sql_mdlstmas);

        while ($data_mdlstmas = $conexion->obtener_filas($query_mdlstmas)){
            
                $system_codigo=$data_mdlstmas['sys_codigo'];
                $drectorio=$data_mdlstmas['sys_dir'];
                $urlchivo=$data_mdlstmas['sys_file'];
                $nombre_modulosytem=$data_mdlstmas['sys_nombre'];
                $nivel=$data_mdlstmas['sys_nivel'];
                $imagen_modulosytem=$data_mdlstmas['sys_imagen'];
                $padre=$data_mdlstmas['sys_padre'];
                $sys_url=$data_mdlstmas['sys_url'];    
            
                $nombre_completo_modulo=$nombre_modulosytem;

                $sql_padre=" SELECT sys_nombre
                                FROM principal.system
                                WHERE sys_codigo='".$padre."'; ";

                $query_padre=$conexion->ejecutar($sql_padre);

                $dato_padre=$conexion->obtener_filas($query_padre);
                $nombre_padre=$dato_padre['sys_nombre'];

                if($drectorio=='na'){
                    $includefile=$urlchivo;
                }
                else{

                    $includefile=$drectorio.'/'.$urlchivo;
                }

                if($seccion_url=='salir'){
                    $destroy=1;
                    session_unset();
                    session_destroy();
                }
                else{
                    $destroy=0;
                }

                $this->nombre_modulosytem=$nombre_modulosytem;
                $this->imagen_modulosytem=$imagen_modulosytem;
                $this->includefile=$includefile;
                $this->padreSystem=$padre;
        

            //echo $urlchivo;
        
        }
        
        return   $sql_mdlstmas;            

    }

    public function getNombre_modulosytem() {
        return $this->nombre_modulosytem;
    }
   
    public function getImagen_modulosytem() {
        return $this->imagen_modulosytem;
    }
   
    public function getIncludefile() {
        return $this->includefile;
    }
   
    public function getPadreSystem() {
        return $this->padreSystem;
    }

}

?>