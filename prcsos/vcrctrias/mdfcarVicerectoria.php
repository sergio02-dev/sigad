<?php
include_once('classVicerectoria.php');

class MdfcarVicerrectoria extends Vicerrectoria{

    private $sql_updte_vicerrectoria;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateVicerrectoria(){
        
        $sql_updte_vicerrectoria="UPDATE principal.entidad
                                    SET ent_nombre='".$this->getNombre()."',
                                    ent_estado=".$this->getEstado().",
                                    ent_fechamodifico=NOW(),
                                    ent_personamodifico=".$this->getPersonaSistema()."
                                  WHERE ent_codigo = ".$this->getCodigo().";";
        
        

        $this->cnxion->ejecutar($sql_updte_vicerrectoria);


        return $sql_updte_vicerrectoria;

    }
}
?>