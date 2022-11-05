<?php
include('classFto.php');
class UpdteFoto  extends Foto{


    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

   
    public function updateFoto(){


        $updateFoto="UPDATE principal.persona
                         SET per_personamodifico=".$this->getPersonaSistema().", 
                             per_fechamodifico=NOW(), 
                             per_foto='".$this->getFotoFoto()."'
                       WHERE per_codigo=".$this->getPersonaFoto().";";
           
        $this->cnxion->ejecutar($updateFoto);


        return $updateFoto;

    }
}
?>
