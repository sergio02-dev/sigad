<?php
include('classRprteActvdadPoai.php');
class RgstroRprteActvdad extends ReporteActividadPoai{

    private $insert_reporte_actividad_poai;
    private $codigo_reporte_actividad;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigo_reporte_actividad=date('YmdHis').rand(99,99999);
    }

    public function vigencia_actividadpoai(){

        $sql_vigencia_actividadpoai="SELECT acp_codigo, acp_descripcion, acp_vigencia
                                     FROM planaccion.actividad_poai
                                    WHERE acp_codigo = ".$this->getCodigoActividadPoai().";";

        $query_vigencia_actividadpoai=$this->cnxion->ejecutar($sql_vigencia_actividadpoai);

        $data_vigencia_actividadpoai=$this->cnxion->obtener_filas($query_vigencia_actividadpoai);
        
        $acp_vigencia = $data_vigencia_actividadpoai['acp_vigencia'];

        return $acp_vigencia;
    }

    public function insertReporteActividadPoai(){

        $vigencia_actividadpoai = $this->vigencia_actividadpoai();

        $insert_reporte_actividad_poai="INSERT INTO planaccion.reporte_actividad(
                                                    rac_codigo, 
                                                    rac_codigoactividadpoai, 
                                                    rac_logro, 
                                                    rac_acto, 
                                                    rac_vigencia, 
                                                    rac_numero, 
                                                    rac_titulo, 
                                                    rac_fechacreo, 
                                                    rac_fechamodifico, 
                                                    rac_personacreo, 
                                                    rac_personamodifico)
                                            VALUES (".$this->codigo_reporte_actividad.", 
                                                    ".$this->getCodigoActividadPoai().", 
                                                    ".$this->getLogro().", 
                                                    ".$this->getActoAdministrativo().", 
                                                    $vigencia_actividadpoai, 
                                                    '".$this->getNumeroActo()."', 
                                                    '".$this->getTituloActo()."', 
                                                    NOW(), 
                                                    NOW(), 
                                                    ".$this->getPersonaSistema().", 
                                                    ".$this->getPersonaSistema().");";


                                                 

        $this->cnxion->ejecutar($insert_reporte_actividad_poai);

        
        return $insert_reporte_actividad_poai;
    }
}
?>