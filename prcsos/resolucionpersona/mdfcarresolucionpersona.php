<?php
include_once('classResolucionpersona.php');

class MdfcarResolucionPersona  extends ResolucionPersona{

    private $sql_updateResolucionPersona;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updateResolucionPersona(){
        
        $sql_updateResolucionPersona="UPDATE usco.resolucion_persona
                                         SET rep_persona=".$this->getPersona().",      
                                             rep_resolucion=".$this->getCodigoResolucion().", 
                                             rep_fecharesolucion='".$this->getFecha()."', 
                                             rep_estado=".$this->getEstado().", 
                                             rep_personamodifico=".$this->getPersonaSistema().",  
                                             rep_fechamodifico=NOW()
                                      WHERE rep_codigo=".$this->getCodigo().";";
        $this->cnxion->ejecutar($sql_updateResolucionPersona);


        return $sql_updateResolucionPersona;

    }
}
?>
