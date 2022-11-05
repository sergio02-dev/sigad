<?php
/**
 * Karen Yuliana Palacio Minú 
 * 13 de Septiembre 2019 09:27 am
 * Rs Reporte substemas 
 */
    include('classRprteActvdadPoai.php');
    class rsReporteActividadPoai extends ReporteActividadPoai{

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function tipo_acto_admin(){

            $sql_tipo_acto_admin="SELECT tac_codigo, tac_nombre
                                    FROM plandesarrollo.tipo_actoadmin;";

            $query_tipo_acto_admin=$this->cnxion->ejecutar($sql_tipo_acto_admin);

            while($data_tipo_acto_admin=$this->cnxion->obtener_filas($query_tipo_acto_admin)){
                $datatipo_acto_admin[]=$data_tipo_acto_admin;
            }

            return $datatipo_acto_admin;
        }

        public function descripcion_actividad($codigo_actividad){

            $sql_descripcion_actividad="SELECT acp_codigo, acp_descripcion, 
                                               acp_accion, acp_referencia, 
                                               acp_numero
                                          FROM planaccion.actividad_poai
                                         WHERE acp_codigo = $codigo_actividad;";

            $query_descripcion_actividad=$this->cnxion->ejecutar($sql_descripcion_actividad);

            $data_descripcion_actividad=$this->cnxion->obtener_filas($query_descripcion_actividad);

            $acp_referencia = $data_descripcion_actividad['acp_referencia'];
            $acp_numero = $data_descripcion_actividad['acp_numero'];
            $acp_descripcion = $data_descripcion_actividad['acp_descripcion'];

            $dscrpcion = $acp_referencia.".".$acp_numero." ".$acp_descripcion;

            return $dscrpcion;
        }

        public function list_reporte_actividad($codigo_actividadpoai){

            $sql_list_reporte_actividad="SELECT rac_codigo, rac_codigoactividadpoai, 
                                                rac_logro, rac_acto, rac_vigencia, 
                                                rac_numero, rac_titulo, tac_nombre
                                           FROM planaccion.reporte_actividad, 
                                                plandesarrollo.tipo_actoadmin
                                          WHERE rac_acto = tac_codigo
                                            AND rac_codigoactividadpoai = $codigo_actividadpoai;";

            $query_list_reporte_actividad=$this->cnxion->ejecutar($sql_list_reporte_actividad);

            while($data_list_reporte_actividad=$this->cnxion->obtener_filas($query_list_reporte_actividad)){
                $datalist_reporte_actividad[]=$data_list_reporte_actividad;
            }
            return $datalist_reporte_actividad;
        }

        public function form_reporte_actividad($codigo_reporte){

            $sql_form_reporte_actividad="SELECT rac_codigo, rac_codigoactividadpoai, 
                                                rac_logro, rac_acto, rac_vigencia, 
                                                rac_numero, rac_titulo
                                           FROM planaccion.reporte_actividad
                                          WHERE rac_codigo = $codigo_reporte;";

            $query_form_reporte_actividad=$this->cnxion->ejecutar($sql_form_reporte_actividad);

            while($data_form_reporte_actividad=$this->cnxion->obtener_filas($query_form_reporte_actividad)){
                $dataform_reporte_actividad[]=$data_form_reporte_actividad;
            }
            return $dataform_reporte_actividad;
        }       

        
     

    }
?>