<?php
include('classResoluciones.php');
class RgstroRslcion extends Resoluciones{

    private $insert_resolucion;
    private $codigoResolucion;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoResolucion=date('YmdHis').rand(99,99999);
    }

    public function insertResolucion(){

        $insert_resolucion="INSERT INTO plandesarrollo.acto_administrativo(
                                        aad_codigo, 
                                        add_nombre, 
                                        add_personacreo, 
                                        add_personamodifico, 
                                        add_fechacreo, 
                                        add_fechamodifico, 
                                        add_tipoactoadmin, 
                                        add_urlactoadmin,
                                        add_vigencia, 
                                        add_descripcion,
                                        add_padre)
                                 VALUES (".$this->codigoResolucion.", 
                                         '".$this->getNombreResolucion()."', 
                                         ".$this->getPersonaSistema().", 
                                         ".$this->getPersonaSistema().", 
                                         NOW(), 
                                         NOW(), 
                                         2, 
                                         '".$this->getUrlResolucion()."',
                                         ".$this->getVigenciaResolucion().",
                                         '".$this->getDescripcion()."',
                                         ".$this->getAcuerdo().");";

        $this->cnxion->ejecutar($insert_resolucion);
        
        return $insert_resolucion;
    }
}
?>