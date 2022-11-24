<?php
include_once('classAreas.php');

class MdfcarAreas extends Areas{

    private $sql_updte_areas;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateAreas(){
        
        $sql_updte_areas="UPDATE usco.areas
                                SET are_nombre='".$this->getNombre()."', 
                                    are_estado=".$this->getEstado().",
                                    are_fechamodifico=NOW(),
                                    are_personamodifico=".$this->getPersonaSistema()."
                                WHERE are_codigo = ".$this->getCodigo().";";
        
        $this->cnxion->ejecutar($sql_updte_areas);


        return $sql_updte_areas;

    }
}
?>
