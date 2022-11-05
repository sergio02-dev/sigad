<?php
include('classResoluciones.php');
class MdfcarRslcion extends Resoluciones{

    private $updte_resolucion;
    private $codigoResolucion;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoResolucion=date('YmdHis').rand(99,99999);
    }

    public function updateResolucion(){

        $updte_resolucion="UPDATE plandesarrollo.acto_administrativo
                              SET add_nombre='".$this->getNombreResolucion()."', 
                                  add_personamodifico=".$this->getPersonaSistema().", 
                                  add_fechamodifico=NOW(),
                                  add_vigencia = ".$this->getVigenciaResolucion().",
                                  add_urlactoadmin = '".$this->getUrlResolucion()."',
                                  add_descripcion = '".$this->getDescripcion()."',
                                  add_padre = ".$this->getAcuerdo()."
                            WHERE aad_codigo=".$this->getCodigoResolucion().";";

        $this->cnxion->ejecutar($updte_resolucion);
        
        return $updte_resolucion;
    }
}
?>