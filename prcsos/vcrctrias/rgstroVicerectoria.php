<?php
include_once('classVicerectoria.php');

class RgstroVicerectoria extends Vicerrectoria {

    private $sql_entidad;
    private $sql_sedes_vicerrectoria;
    private $codigo_vicerrectoria;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_vicerrectoria =date('YmdHis').rand(99,99999);
    }

   public function insertVicerrectoria(){


        $sql_sede_vice ="INSERT INTO usco.sede_vicerrectoria(
                                                svi_codigo, 
                                                svi_sede, 
                                                svi_vicerrectoria, 
                                                svi_fechacreo, 
                                                svi_fechamodifico, 
                                                svi_personacreo, 
                                                svi_personamodifico, 
                                                svi_estado)
                                            VALUES (".$this->codigo_vicerrectoria.",
                                                    ".$this->getSedes()."',
                                                    '".$this->getNombre()."',
                                                    NOW(),
                                                    ,
                                                    ".$this->getPersonaSistema().",
                                                    ,
                                                    ".$this->getEstado().")";    

        $this->cnxion->ejecutar($sql_sede_vice);
        
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
                                VALUES (".$this->codigo_vicerrectoria.",
                                        '".$this->getNombre()."',
                                         ,
                                         ".$this->getEstado().",
                                         NOW(),
                                         ,
                                         ".$this->getPersonaSistema().",
                                         ,
                                          2)";
    
        $this->cnxion->ejecutar($sql_entidad);

      


        return $sql_entidad;

    }
}

?>
