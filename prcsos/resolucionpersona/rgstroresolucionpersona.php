<?php
include_once('classResolucionpersona.php');

class RgstroResolucionPersona extends ResolucionPersona {

    private $sql_resolucion_persona;
    private $codigo_resolucion_persona;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_resolucion_persona =date('YmdHis').rand(99,99999);
    }

    public function resolucion_persona(){
        
        $sql_resolucion_persona="INSERT INTO usco.resolucion_persona(
                                                            rep_codigo, 
                                                            rep_persona, 
                                                            rep_resolucion, 
                                                            rep_fecharesolucion, 
                                                            rep_estado, 
                                                            rep_personacreo, 
                                                            rep_personamodifico, 
                                                            rep_fechacreo, 
                                                            rep_fechamodifico)
                                                    VALUES (".$this->codigo_resolucion_persona.",
                                                            ".$this->getPersona().",
                                                            '".$this->getCodigoResolucion()."',
                                                            '".$this->getFecha()."',
                                                            ".$this->getEstado().",
                                                            ".$this->getPersonaSistema().",
                                                            ".$this->getPersonaSistema().",
                                                            NOW(),
                                                            NOW())";



        $this->cnxion->ejecutar($sql_resolucion_persona);

        return $sql_resolucion_persona;

    }
}
?>