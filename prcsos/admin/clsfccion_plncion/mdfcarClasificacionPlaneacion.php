<?php
include('classClasificacionPlaneacion.php');
class MdfcarClsfccionPlncion extends ClasificacionPlaneacion{

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function update_clasificacion_plncion(){

        $update_clsfccion_plncion="UPDATE planaccion.clasificacion_planeacion
                                      SET cpl_nombre = '".$this->getNombre()."', 
                                          cpl_descripcion = '".$this->getDescripcion()."', 
                                          cpl_estado = ".$this->getEstado().", 
                                          cpl_fechamodifico = NOW(),
                                          cpl_personamodifico = ".$this->getPersonaSistema()."
                                    WHERE cpl_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($update_clsfccion_plncion);
        
        return $update_clsfccion_plncion;
    }
}
?>