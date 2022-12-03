<?php
include_once('classFormpdi.php');

class RgstroFormpdi extends PlandeComprasPDI {

    private $sql_entidad;
    private $codigo_formpdi;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_formpdi =date('YmdHis').rand(99,99999);
    }

    public function insertFormpdi(){
        
        $sql_formpdi="INSERT INTO principal.entidad(
                                                    ent_codigo,
                                                    ent_nombre, 
                                                    ent_descripcion, 
                                                    ent_estado, 
                                                    ent_fechacreo, 
                                                    ent_fechamodifico, 
                                                    ent_personacreo, 
                                                    ent_personamodifico, 
                                                    ent_tipoentidad)
                                                VALUES (".$this->codigo_formpdi.",
                                                        '".$this->getNombre()."',
                                                        '',
                                                        ".$this->getEstado().",
                                                        NOW(),
                                                        NOW(),
                                                        ".$this->getPersonaSistema().",
                                                        ".$this->getPersonaSistema().",
                                                        1)";

        $this->cnxion->ejecutar($sql_formpdi);

        return $sql_formpdi;

    }
}
?>