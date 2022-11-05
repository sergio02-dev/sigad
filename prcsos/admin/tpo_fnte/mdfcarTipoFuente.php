<?php
include('classTipoFuente.php');
class MdfcarTpoFnte extends TipoFuente{

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function update_tipo_fuente(){

        $update_tpo_fnte="UPDATE planaccion.tipo_fuente_financiacion
                             SET tff_nombre = '".$this->getNombre()."', 
                                 tff_estado = ".$this->getEstado().", 
                                 tff_fechamodifico = NOW(), 
                                 tff_personamodifico = ".$this->getPersonaSistema().", 
                                 tff_descripcion = '".$this->getDescripcion()."'
                           WHERE tff_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($update_tpo_fnte);
        
        return $update_tpo_fnte;
    }
}
?>