<?php
include('classReporteActividadEtpa.php');
class RgstroActvdadEtpa extends ReporteActividadEtapa{

    private $insert_reporte_actividad_etapa;
    private $codigoRegistroActidadEtpa;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoRegistroActidadEtpa=date('YmdHis').rand(99,99999);
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

    public function insertReporteActividadEtapa(){

        $vigencia_certificado = $this->vigencia_certificado();

        $insert_reporte_actividad_etapa="INSERT INTO planaccion.reporte_actividad_etapa(
                                                     rea_codigo, 
                                                     rea_codigocertificado, 
                                                     rea_codigoactividadpoai, 
                                                     rea_codigoetapa, 
                                                     rea_codigoactividad, 
                                                     rea_numeroveces, 
                                                     rea_logrado, 
                                                     rea_vigencia, 
                                                     rea_fechacreo, 
                                                     rea_fechamodifico,
                                                     rea_personacreo, 
                                                     rea_personamodifico)
                                             VALUES (".$this->codigoRegistroActidadEtpa.", 
                                                     ".$this->getCodigoCertificado().", 
                                                     ".$this->getCodigoActividad().", 
                                                     ".$this->getCodigoEtapa().", 
                                                     ".$this->getTipoActividad().", 
                                                     ".$this->getNumeroVeces().", 
                                                     ".$this->getLogro().", 
                                                     $vigencia_certificado, 
                                                     NOW(), 
                                                     NOW(), 
                                                     ".$this->getPersonaSistema().", 
                                                     ".$this->getPersonaSistema().");";


                                                     

        $this->cnxion->ejecutar($insert_reporte_actividad_etapa);

        
        return $insert_reporte_actividad_etapa;
    }
}
?>