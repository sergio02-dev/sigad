<?php
include('classClasificacionPlaneacion.php');
class RgstroClsfccionPlncion extends ClasificacionPlaneacion{

    private $codigoClasificacionPlaneacion;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoClasificacionPlaneacion=date('YmdHis').rand(99,99999);
    }

    public function insert_clasificacion_plncion(){

        $insert_clsfccion_plncion="INSERT INTO planaccion.clasificacion_planeacion(
                                               cpl_codigo, 
                                               cpl_nombre, 
                                               cpl_descripcion, 
                                               cpl_estado, 
                                               cpl_fechacreo, 
                                               cpl_fechamodifico, 
                                               cpl_personacreo, 
                                               cpl_personamodifico)
                                       VALUES (".$this->codigoClasificacionPlaneacion.", 
                                               '".$this->getNombre()."', 
                                               '".$this->getDescripcion()."', 
                                               ".$this->getEstado().", 
                                               NOW(), 
                                               NOW(), 
                                               ".$this->getPersonaSistema().", 
                                               ".$this->getPersonaSistema().");";

        $this->cnxion->ejecutar($insert_clsfccion_plncion);
        
        return $insert_clsfccion_plncion;
    }
}
?>