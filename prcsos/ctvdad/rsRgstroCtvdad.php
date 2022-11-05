<?php

    include_once('classRgstroCtvdad.php');
    class RsRgstroCtvdad extends RegistroActividades{

        private $sqlRegistroActividades;
        private $dataRegistroActividades;


        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }
        

        public function sqlRsRegistroActividades(){

            $sqlRegistroActividades=" SELECT are_codigo, are_actividad, are_numeroveces, are_tipoavance, are_avancelogrado, are_tipoactividad, tav_codigo, tav_nombre, 
                                            planaccion.tipo_actividad.tac_codigo, planaccion.tipo_actividad.tac_nombre,
                                            plandesarrollo.tipo_actoadmin.tac_codigo, plandesarrollo.tipo_actoadmin.tac_nombre as actoadmin, 
                                            are_acuerdo, are_numeroacuerdoresolucion, are_titulonombre, are_trimestre

                                        FROM planaccion.actividad_realizada, planaccion.tipo_actividad, planaccion.tipo_avance, plandesarrollo.tipo_actoadmin
                                        WHERE planaccion.actividad_realizada.are_tipoactividad=planaccion.tipo_actividad.tac_codigo
                                        AND planaccion.actividad_realizada.are_tipoavance=planaccion.tipo_avance.tav_codigo
                                        AND planaccion.actividad_realizada.are_acuerdo=plandesarrollo.tipo_actoadmin.tac_codigo
                                      AND are_actividad=".$this->getCodigoActividad()."
                                      ORDER BY are_fechacreo ASC; ";
            $queryRegistroActividades=$this->cnxion->ejecutar($sqlRegistroActividades);


            while($data_RegistroActividades=$this->cnxion->obtener_filas($queryRegistroActividades)){
                $dataRegistroActividades[]=$data_RegistroActividades;
            }
            return $dataRegistroActividades;
        }

        public function sqlRsDatosActividad(){

            $sqlRsDatosActividad="SELECT are_codigo, are_personacreo, are_personamodifico, are_fechacreo, 
                                            are_fechamodifico, are_actividad, are_numeroveces, are_tipoavance, 
                                            are_avancelogrado, are_tipoactividad, are_acuerdo, are_numeroacuerdoresolucion, 
                                            are_titulonombre, are_trimestre, are_padre
                                        FROM planaccion.actividad_realizada
                                        WHERE  are_codigo=".$this->getCodigoActividadRealizada().";";

            $queryRsDatosActividad=$this->cnxion->ejecutar($sqlRsDatosActividad);


            while($data_RsDatosActividad=$this->cnxion->obtener_filas($queryRsDatosActividad)){
                $dataRsDatosActividad[]=$data_RsDatosActividad;
            }
            return $dataRsDatosActividad;
        }
        public function RsVigencia(){

            $sqlRsVigencia="SELECT MAX(apr_trimestres) AS trimestre
                        FROM planaccion.apertura_reporte;";

            $queryRsVigencia=$this->cnxion->ejecutar($sqlRsVigencia);
            $data_RsVigencia=$this->cnxion->obtener_filas($queryRsVigencia);
            
            $trimestre=$data_RsVigencia['trimestre'];

            return $trimestre;
        }

        public function avanceAcumulado($are_codigo){

            $sqlavanceAcumulado="SELECT SUM(are_avancelogrado) AS avance
                                    FROM planaccion.actividad_realizada
                                    WHERE are_padre=$are_codigo OR are_codigo=$are_codigo;";

            $queryavanceAcumulado=$this->cnxion->ejecutar($sqlavanceAcumulado);
            $data_avanceAcumulado=$this->cnxion->obtener_filas($queryavanceAcumulado);
            
            $avance=$data_avanceAcumulado['avance'];

            return $avance;
        }

        public function descripcion_proyecto($codigo_accion){

            $sql_descripcion_proyecto="SELECT pro_codigo, pro_descripcion,
                                              pro_referencia, pro_numero
                                         FROM plandesarrollo.proyecto, plandesarrollo.accion
                                        WHERE pro_codigo = acc_proyecto
                                          AND acc_codigo = $codigo_accion;";

            $query_descripcion_proyecto=$this->cnxion->ejecutar($sql_descripcion_proyecto);

            $data_descripcion_proyecto=$this->cnxion->obtener_filas($query_descripcion_proyecto);
            
            $pro_referencia = $data_descripcion_proyecto['pro_referencia'];
            $pro_numero = $data_descripcion_proyecto['pro_numero'];
            $pro_descripcion = $data_descripcion_proyecto['pro_descripcion'];
            
            $descpcion = $pro_referencia.".".$pro_numero." ".$pro_descripcion;

            return $descpcion;
        }

        public function reporte_x_etapa($codigo_certificado, $codigo_activdadpoai, $codigo_etapa){

            $sql_reporte_x_etapa="SELECT rea_codigo, rea_codigocertificado, 
                                         rea_codigoactividadpoai, rea_codigoetapa, 
                                         rea_codigoactividad, rea_numeroveces, 
                                         rea_logrado, rea_vigencia, tac_nombre 
                                    FROM planaccion.reporte_actividad_etapa, planaccion.tipo_actividad
                                   WHERE rea_codigoactividad = tac_codigo
                                     AND rea_codigocertificado = $codigo_certificado
                                     AND rea_codigoactividadpoai = $codigo_activdadpoai
                                     AND rea_codigoetapa = $codigo_etapa;";

            $query_reporte_x_etapa=$this->cnxion->ejecutar($sql_reporte_x_etapa);

            while($data_reporte_x_etapa=$this->cnxion->obtener_filas($query_reporte_x_etapa)){
                $datareporte_x_etapa[]=$data_reporte_x_etapa;
            }
            return $datareporte_x_etapa;
        }

        public function activdad_etpa_edtar($codigo_actividad_etapa){

            $sql_activdad_etpa_edtar="SELECT rea_codigo, rea_codigocertificado, 
                                             rea_codigoactividadpoai, rea_codigoetapa, 
                                             rea_codigoactividad, rea_numeroveces, 
                                             rea_logrado, rea_vigencia
                                        FROM planaccion.reporte_actividad_etapa
                                       WHERE rea_codigo = $codigo_actividad_etapa;";

            $query_activdad_etpa_edtar=$this->cnxion->ejecutar($sql_activdad_etpa_edtar);

            while($data_activdad_etpa_edtar=$this->cnxion->obtener_filas($query_activdad_etpa_edtar)){
                $dataactivdad_etpa_edtar[]=$data_activdad_etpa_edtar;
            }
            return $dataactivdad_etpa_edtar;
        }

        public function cantidad_rprtes($codigo_actividad){

            $sql_cantidad_rprtes="SELECT COUNT(*) AS cntdad_rprte
                                    FROM planaccion.reporte_actividad
                                   WHERE rac_codigoactividadpoai = $codigo_actividad;";

            $query_cantidad_rprtes=$this->cnxion->ejecutar($sql_cantidad_rprtes);

            $data_cantidad_rprtes=$this->cnxion->obtener_filas($query_cantidad_rprtes);
            
            $cntdad_rprte=$data_cantidad_rprtes['cntdad_rprte'];

            return $cntdad_rprte;
        }

    }



?>