<?php
include('classRprteActvdadPoai.php');
class MdfcarRprteActvdad extends ReporteActividadPoai{

    private $modificar_reporte_actividad_poai;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function modificarReporteActividadPoai(){


        $modificar_reporte_actividad_poai="UPDATE planaccion.reporte_actividad
                                              SET rac_logro = ".$this->getLogro().", 
                                                  rac_acto = ".$this->getActoAdministrativo().", 
                                                  rac_numero = '".$this->getNumeroActo()."', 
                                                  rac_titulo = '".$this->getTituloActo()."', 
                                                  rac_fechamodifico = NOW(),
                                                  rac_personamodifico = ".$this->getPersonaSistema()."
                                            WHERE rac_codigo = ".$this->getCodigo().";";

        $this->cnxion->ejecutar($modificar_reporte_actividad_poai);

        
        return $modificar_reporte_actividad_poai;
    }
}
?>