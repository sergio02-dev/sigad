<?php
include('classReporteActividadEtpa.php');
class UpdteActvdadEtpa extends ReporteActividadEtapa{

    private $update_reporte_actividad_etapa;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function vigencia_certificado(){

        $sql_vigencia_certificado="SELECT act_codigo, act_vigencia
                                     FROM planaccion.actividad
                                    WHERE act_codigo = ".$this->getCodigoCertificado().";";

        $query_vigencia_certificado=$this->cnxion->ejecutar($sql_vigencia_certificado);

        $data_vigencia_certificado=$this->cnxion->obtener_filas($query_vigencia_certificado);
        
        $act_vigencia = $data_vigencia_certificado['act_vigencia'];

        return $act_vigencia;
    }

    public function updateReporteActividadEtapa(){

        $vigencia_certificado = $this->vigencia_certificado();

        $update_reporte_actividad_etapa="UPDATE planaccion.reporte_actividad_etapa
                                            SET rea_codigoactividad=".$this->getTipoActividad().", 
                                                rea_numeroveces=".$this->getNumeroVeces().", 
                                                rea_logrado=".$this->getLogro().", 
                                                rea_vigencia=$vigencia_certificado, 
                                                rea_fechamodifico=NOW(), 
                                                rea_personamodifico=".$this->getPersonaSistema()."
                                          WHERE rea_codigo=".$this->getCodigo().";";

        $this->cnxion->ejecutar($update_reporte_actividad_etapa);

        
        return $update_reporte_actividad_etapa;
    }
}
?>