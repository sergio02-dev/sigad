<?php
include('classClasificacionFuente.php');
class MdfcarClsfccionFnte extends ClasificacionFuente{

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function update_clasificacion_fuente(){

        $update_clsfccion_fnte="UPDATE planaccion.clasificacion
                                    SET cla_nombre = '".$this->getNombre()."', 
                                        cla_estado = ".$this->getEstado().", 
                                        cla_fechamodifico = NOW(), 
                                        cla_personamodifico = ".$this->getPersonaSistema().", 
                                        cla_descripcion = '".$this->getDescripcion()."'
                                WHERE cla_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($update_clsfccion_fnte);
        
        return $update_clsfccion_fnte;
    }
}
?>