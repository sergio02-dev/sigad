<?php
include('classClasificacionFuente.php');
class RgstroClsfccionFnte extends ClasificacionFuente{

    private $codigoClasificacionFuente;

    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoClasificacionFuente=date('YmdHis').rand(99,99999);
    }

    public function insert_clasificacion_fuente(){

        $insert_clsfccion_fnte="INSERT INTO planaccion.clasificacion(
                                            cla_codigo, 
                                            cla_nombre, 
                                            cla_descripcion, 
                                            cla_estado, 
                                            cla_fechacreo, 
                                            cla_fechamodifico, 
                                            cla_personacreo, 
                                            cla_personamodifico)
                                    VALUES (".$this->codigoClasificacionFuente.",
                                            '".$this->getNombre()."', 
                                            '".$this->getDescripcion()."', 
                                            ".$this->getEstado().", 
                                            NOW(), 
                                            NOW(), 
                                            ".$this->getPersonaSistema().", 
                                            ".$this->getPersonaSistema()."
                                        );";

        $this->cnxion->ejecutar($insert_clsfccion_fnte);
        
        return $insert_clsfccion_fnte;
    }
}
?>