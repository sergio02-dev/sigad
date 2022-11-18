<?php
include_once('classFacultades.php');

class RgstroFacultades extends Facultades {

    private $sql_insert_facultades;
    private $codigo_facultades;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_facultades =date('YmdHis').rand(99,99999);
    }

    public function insertFacultades(){
        
        $sql_insert_facultades="INSERT INTO usco.facultades(
                                             fac_codigo, 
                                             fac_nombre, 
                                             fac_estado, 
                                             fac_fechacreo, 
                                             fac_fechamodifico, 
                                             fac_personacreo, 
                                             fac_personamodifico)
                                     VALUES (".$this->codigo_facultades.", 
                                             '".$this->getNombre()."',
                                             ".$this->getEstado().", 
                                             NOW(), 
                                             NOW(), 
                                             ".$this->getPersonaSistema().",
                                             ".$this->getPersonaSistema().");";

        $this->cnxion->ejecutar($sql_insert_facultades);


        return $sql_insert_facultades;

    }
}
?>