<?php
include_once('classVicerectoria.php');

class RgstroVicerectoria extends Vicerrectoria {

    private $sql_entidad;

    private $codigo_vicerrectoria;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_vicerrectoria =date('YmdHis').rand(99,99999);
    }

   public function insertVicerrectoria(){


        $sql_entidad="INSERT INTO principal.entidad(
                                  ent_codigo,
                                  ent_nombre, 
                               
                                  ent_estado, 
                                  ent_fechacreo, 
                               
                                  ent_personacreo, 
                               
                                  ent_tipoentidad)
                                VALUES (".$this->codigo_vicerrectoria.",
                                        '".$this->getNombre()."',
                                        
                                         ".$this->getEstado().",
                                         NOW(),
                                         
                                         ".$this->getPersonaSistema().",
                                         
                                          2);";
    
        $this->cnxion->ejecutar($sql_entidad);

      


        return $sql_entidad;

    }
}

?>
