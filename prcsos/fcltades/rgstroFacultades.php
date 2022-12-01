<?php
include_once('classFacultades.php');

class RgstroFacultades extends Facultades {

    private $sql_entidad;
    private $codigo_facultades;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_facultades =date('YmdHis').rand(99,99999);
    }

    public function insertFacultades(){
        
        $sql_entidad="INSERT INTO principal.entidad(
                                                    ent_codigo,
                                                    ent_nombre, 
                                                    ent_descripcion, 
                                                    ent_estado, 
                                                    ent_fechacreo, 
                                                    ent_fechamodifico, 
                                                    ent_personacreo, 
                                                    ent_personamodifico, 
                                                    ent_tipoentidad)
                                                VALUES (".$this->codigo_facultades.",
                                                        '".$this->getNombre()."',
                                                        '',
                                                        ".$this->getEstado().",
                                                        NOW(),
                                                        NOW(),
                                                        ".$this->getPersonaSistema().",
                                                        ".$this->getPersonaSistema().",
                                                        1)";

        $this->cnxion->ejecutar($sql_entidad);

        return $sql_entidad;

    }
}
?>