<?php
include_once('classFacultades.php');

class MdfcarFacultades extends Facultades{

    private $sql_updte_facultades;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateFacultades(){
        
        $sql_updte_facultades="UPDATE usco.facultades
                                   SET fac_nombre='".$this->getNombre()."',
                                       fac_estado=".$this->getEstado().", 
                                       fac_fechamodifico=NOW(), 
                                       fac_personamodifico=".$this->getPersonaSistema()."
                                 WHERE fac_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($sql_updte_facultades);


        return $sql_updte_facultades;

    }
}
?>
