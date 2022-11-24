<?php
include_once('classAreas.php');

class RgstroAreas extends Areas{

    private $sql_insert_areas;
    private $codigo_areas;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_areas =date('YmdHis').rand(99,99999);
    }

    public function insertAreas(){
        
        $sql_insert_areas="INSERT INTO usco.areas(
                                       are_codigo, 
                                       are_nombre, 
                                       are_estado, 
                                       are_fechacreo, 
                                       are_fechamodifico, 
                                       are_personacreo, 
                                       are_personamodifico)
                             VALUES (".$this->codigo_areas.", 
                                     '".$this->getNombre()."',
                                     ".$this->getEstado().", 
                                     NOW(), 
                                     NOW(), 
                                     ".$this->getPersonaSistema().",
                                     ".$this->getPersonaSistema().");";
        
        $this->cnxion->ejecutar($sql_insert_areas);


        return $sql_insert_areas;

    }
}
?>
