<?php
include_once('classFacultades.php');

class MdfcarFacultades extends Facultades{

    private $sql_updte_facultades;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateFacultades(){
        
        $sql_updte_facultades="UPDATE principal.entidad
                                SET     ent_nombre='".$this->getNombre()."',
                                        ent_estado=".$this->getEstado().", 
                                        ent_fechamodifico=NOW(),  
                                        ent_personamodifico=".$this->getPersonaSistema()."
                                WHERE ent_codigo=".$this->getCodigo().";";
        
     

        $this->cnxion->ejecutar($sql_updte_facultades);


        return $sql_updte_facultades;

    }
}
?>
