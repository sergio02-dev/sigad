<?php
include('classNvlDos.php');
class UpdteNvlDos extends NivelDos{

    private $update_NivelDos;
    private $codigoNivelDos;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateNivelDos(){

        $update_NivelDos="UPDATE plandesarrollo.proyecto
                            SET pro_descripcion='".$this->getNombreNivelDos()."', sub_codigo=".$this->getCodigoNivelUno().",
                                pro_personamodifico=".$this->getPersonaSistemaNivelDos().",  pro_fechamodifico=NOW(), 
                                pro_referencia='".$this->getRefeneciaNivelDos()."', pro_objetivo='".$this->getObjetivo()."',
                                res_codigo=".$this->getResponsable()."
                        WHERE pro_codigo=".$this->getCodigoNivelDos().";";

        $this->cnxion->ejecutar($update_NivelDos);

        
        return $update_NivelDos;
    }
}
?>