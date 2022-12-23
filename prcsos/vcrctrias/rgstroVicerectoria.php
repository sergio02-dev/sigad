<?php
include_once('classVicerectoria.php');

class RgstroVicerectoria extends Vicerrectoria {

    
    private $sql_sede_vice;
    private $codigo_vicerrectoria;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_vicerrectoria =date('YmdHis').rand(99,99999);
    }

    public function insertVicerrectoria(){


        $sql_sede_vice ="INSERT INTO principal.entidad(
                                        ent_codigo,
                                        ent_nombre, 
                                        ent_descripcion, 
                                        ent_estado, 
                                        ent_fechacreo, 
                                        ent_fechamodifico, 
                                        ent_personacreo, 
                                        ent_personamodifico, 
                                        ent_tipoentidad)
                                    VALUES (".$this->codigo_vicerrectoria.",
                                            '".$this->getNombre()."',
                                            '',
                                            ".$this->getEstado().",
                                            NOW(),
                                            NOW(),
                                            ".$this->getPersonaSistema().",
                                            ".$this->getPersonaSistema().",
                                            2)";    

        $this->cnxion->ejecutar($sql_sede_vice);
        
        
      


        return $sql_sede_vice;

    }
}
?>
