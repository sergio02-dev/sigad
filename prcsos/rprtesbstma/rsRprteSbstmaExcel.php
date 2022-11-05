<?php
/**
 * Karen Yuliana Palacio Minú 
 * 13 de Septiembre 2019 09:27 am
 * Rs Reporte substemas 
 */
    class RsRprteSbstmaExcel{
        private $slqProyectoSubsistema;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function sqlRsProyectoSubsistema($codigo_subsistema){//Si esta 

            $slqProyectoSubsistema="SELECT pro_codigo, pro_descripcion, sub_codigo,
                                           add_codigo, res_codigo, pro_referencia
                                      FROM plandesarrollo.proyecto
                                      WHERE sub_codigo=$codigo_subsistema
                                      ORDER BY pro_referencia ASC;";

            $queryProyectoSubsistema=$this->cnxion->ejecutar($slqProyectoSubsistema);

            while($data_ProyectoSubsistema=$this->cnxion->obtener_filas($queryProyectoSubsistema)){
                $dataProyectoSubsistema[]=$data_ProyectoSubsistema;
            }

            return $dataProyectoSubsistema;
        }

        public function sqlRsAccioProyecto($codigo_proyecto){//Si esta 

            $sqlRsAccioProyecto="SELECT acc_codigo, acc_referencia, acc_descripcion, acc_responsable, 
                                           acc_lineabase, acc_metaresultado, acc_proyecto,  
                                           acc_actoadmin, acc_numerovigencia, acc_comportamiento, 
                                           acc_tendenciapositiva, acc_indicador
                                      FROM plandesarrollo.accion
                                      WHERE acc_proyecto=$codigo_proyecto
                                      ORDER BY acc_codigo ASC;";

            $queryAccioProyecto=$this->cnxion->ejecutar($sqlRsAccioProyecto);

            while($data_AccioProyecto=$this->cnxion->obtener_filas($queryAccioProyecto)){
                $dataAccioProyecto[]=$data_AccioProyecto;
            }

            return $dataAccioProyecto;
        }
        public function sqlRsAtividad($codigo_proyecto, $codigo_accion, $trimestreee){//Si esta

            if($trimestreee==1){
                $condicion="AND act_trimestre IN(1)";
            }

            if($trimestreee==2){
                $condicion="AND act_trimestre IN(1,2)";
            }

            if($trimestreee==3){
                $condicion="AND act_trimestre IN(1,2,3)";
            }
            

            $sqlRsAtividad="SELECT act_codigo, act_descripcion, act_fechaexpedicion, act_accion, 
                                        act_proyecto, act_dependencia, act_referencia, act_estado,
                                        act_certificado, act_vigencia, act_dependencia
                                FROM planaccion.actividad
                                WHERE act_certificadopadre=0
                                AND act_proyecto=$codigo_proyecto
                                AND act_accion=$codigo_accion
                                $condicion
                                ORDER BY act_codigo ASC;";

            $queryAtividad=$this->cnxion->ejecutar($sqlRsAtividad);

            while($data_Atividad=$this->cnxion->obtener_filas($queryAtividad)){
                $dataAtividad[]=$data_Atividad;
            }

            return $dataAtividad;
        }
        public function cantidadActividadesAccion($codigo_proyecto, $codigo_accion, $trimestreee){//Si esta
            if($trimestreee==1){
                $condicion="AND act_trimestre IN(1)";
            }
            if($trimestreee==2){
                $condicion="AND act_trimestre IN(1,2)";
            }
            elseif($trimestreee==3){
                $condicion="AND act_trimestre IN(1,2,3)";
            }
            
            $sqlcantidadActividadesAccion="SELECT COUNT(*)AS cantidadactividadess
                                FROM planaccion.actividad
                                WHERE act_certificadopadre=0
                                AND act_proyecto=$codigo_proyecto
                                AND act_accion=$codigo_accion
                                $condicion;";

            $querycantidadActividadesAccion=$this->cnxion->ejecutar($sqlcantidadActividadesAccion);
            $data_cantidadActividadesAccion=$this->cnxion->obtener_filas($querycantidadActividadesAccion);
            
            $cantidadactivacc=$data_cantidadActividadesAccion['cantidadactividadess'];

            return $cantidadactivacc;
        }
        public function cantidadAcciones($codigo_proyecto){//Si esta

            $sqlcantidadAcciones="SELECT COUNT(*)AS cantidad_accion
                                FROM plandesarrollo.accion
                                WHERE acc_proyecto=$codigo_proyecto;";

            $querycantidadAcciones=$this->cnxion->ejecutar($sqlcantidadAcciones);
            $data_cantidadAcciones=$this->cnxion->obtener_filas($querycantidadAcciones);
            
            $cantidad_accion=$data_cantidadAcciones['cantidad_accion'];

            return $cantidad_accion;
        }

        public function sqlRsValorActividad($codigo_actividad){//Si esta

            $sqlRsValorActividad="SELECT aco_valor
                                FROM planaccion.actividad_costo
                                WHERE aco_actividad=$codigo_actividad;";

            $querysqlRsValorActividad=$this->cnxion->ejecutar($sqlRsValorActividad);
            $data_sqlRsValorActividad=$this->cnxion->obtener_filas($querysqlRsValorActividad);
            
            $valor=$data_sqlRsValorActividad['aco_valor'];

            return $valor;
        }
        public function sqlRsCantidadActividadRealizadaPorcentaje($codigo_actividad){//Si esta 

            $sqlRsCantidadActividadRealizadaPorcentaje="SELECT COUNT(*) AS cantidad_actividadrealizada
                                                            FROM planaccion.actividad_realizada
                                                            WHERE are_tipoavance=1
                                                            AND  are_trimestre IN (20191,20192,20193)
                                                            AND are_actividad=$codigo_actividad;";

            $querysqlRsCantidadActividadRealizadaPorcentaje=$this->cnxion->ejecutar($sqlRsCantidadActividadRealizadaPorcentaje);
            $data_sqlRsCantidadActividadRealizadaPorcentaje=$this->cnxion->obtener_filas($querysqlRsCantidadActividadRealizadaPorcentaje);
            
            $cantidad_actividadrealizada=$data_sqlRsCantidadActividadRealizadaPorcentaje['cantidad_actividadrealizada'];

            return $cantidad_actividadrealizada;
        }
        
        public function sqlLogroAvanzadoTotal($codigo_actividad, $trimestreee, $year ){//Si Esta 

            if($trimestreee==1){
                $condicion="AND are_trimestre IN(20191)";
            }           
            if($trimestreee==2){
                $condicion="AND are_trimestre IN(20191,20192)";
            }
            if($trimestreee==3){
                $condicion="AND are_trimestre IN(20191,20192,20193)";
            }
            

            $sqlLogroAvanzadoTotal="SELECT SUM(are_avancelogrado) logradototal
                                            FROM planaccion.actividad_realizada
                                            WHERE are_tipoavance=2
                                            $condicion
                                            AND are_actividad=$codigo_actividad;";

            $querysqlLogroAvanzadoTotal=$this->cnxion->ejecutar($sqlLogroAvanzadoTotal);
            $data_sqlLogroAvanzadoTotal=$this->cnxion->obtener_filas($querysqlLogroAvanzadoTotal);
            
            $logradototal=$data_sqlLogroAvanzadoTotal['logradototal'];

            return $logradototal;
        }
        
       
        public function cantidadActividadAccionExcel($codigo_proyecto, $codigo_accion, $trimestreee){//Si esta 

            if($trimestreee==1){
                $condicion="AND act_trimestre IN(1)";
            }
            if($trimestreee==2){
                $condicion="AND act_trimestre IN(1,2)";
            }
            if($trimestreee==3){
                $condicion="AND act_trimestre IN(1,2,3)";
            }
            

            $sqlcantidadActividadAccionExcel="SELECT COUNT(*)AS cant_accionactivity
                                FROM planaccion.actividad
                                WHERE act_certificadopadre=0
                                AND act_proyecto=$codigo_proyecto
                                AND act_accion=$codigo_accion
                                $condicion;";

            $querycantidadActividadAccionExcel=$this->cnxion->ejecutar($sqlcantidadActividadAccionExcel);
            $data_cantidadActividadAccionExcel=$this->cnxion->obtener_filas($querycantidadActividadAccionExcel);
            
            $cant_accionActivity=$data_cantidadActividadAccionExcel['cant_accionactivity'];

            return $cant_accionActivity;
        }
        public function MetaResultado($codigo_accion){

            $sqlMetaProducto="SELECT mpr_codigo, mpr_accion, mpr_vigencia, mpr_valoresperado, mpr_personacreo, 
                                    mpr_personamodifico, mpr_fechacreo, mpr_fechamodifico, acc_indicador
                                FROM plandesarrollo.meta_producto, plandesarrollo.accion
                                WHERE plandesarrollo.meta_producto.mpr_accion=plandesarrollo.accion.acc_codigo
                                AND mpr_vigencia=2019
                                AND mpr_accion=$codigo_accion;";
            $queryMetaProducto=$this->cnxion->ejecutar($sqlMetaProducto);

            while($rsDataMetaProducto=$this->cnxion->obtener_filas($queryMetaProducto)){

                $mpr_valoresperado=$rsDataMetaProducto['mpr_valoresperado'];
                $acc_indicador=$rsDataMetaProducto['acc_indicador'];

            }
            
            return $mpr_valoresperado;

        }
        public function LineaBase($codigo_accion){

            $sqlAccionEjecucion=" SELECT aej_codigo, aej_accion, aej_vigencia, aej_valor, aej_personacreo, 
                                         aej_personamodifico, aej_fechacreo, aej_fechamodifico
                                 FROM planaccion.accion_ejecucion
                                 WHERE aej_vigencia=2018
                                 AND aej_accion=$codigo_accion;";
            $queryAccionEjecucion=$this->cnxion->ejecutar($sqlAccionEjecucion);

            while($rsDataAccionEjecucion=$this->cnxion->obtener_filas($queryAccionEjecucion)){

                $aej_valor=$rsDataAccionEjecucion['aej_valor'];

            }
            
            return $aej_valor;

        }
        public function sqlRsAtividadProyectoCertificados($codigo_proyecto, $trimestreee){
            
            if($trimestreee==1){
                $condicion="AND act_trimestre IN(1)";
            }
            if($trimestreee==2){
                $condicion="AND act_trimestre IN(1,2)";
            }
            if($trimestreee==3){
                $condicion="AND act_trimestre IN(1,2,3)";
            }
            

            $sqlRsAtividadProyectoCertificados="SELECT act_codigo, act_descripcion, act_fechaexpedicion, act_accion, 
                                                        act_proyecto, act_dependencia, act_referencia, act_estado, act_certificado, 
                                                        act_vigencia, aco_valor
                                                FROM planaccion.actividad, planaccion.actividad_costo
                                                WHERE act_codigo=aco_actividad
                                                AND act_proyecto=$codigo_proyecto
                                                $condicion;";

            $queryRsAtividadProyectoCertificados=$this->cnxion->ejecutar($sqlRsAtividadProyectoCertificados);

            while($data_RsAtividadProyectoCertificados=$this->cnxion->obtener_filas($queryRsAtividadProyectoCertificados)){
                $dataRsAtividadProyectoCertificados[]=$data_RsAtividadProyectoCertificados;
            }

            return $dataRsAtividadProyectoCertificados;
        }
     
    
       
        public function RsCertificados($pro_codigo){

            $sqlRsCertificados="SELECT act_codigo, act_descripcion, act_fechaexpedicion, act_accion, 
                                        act_proyecto, act_dependencia, act_referencia, act_estado, act_certificado, 
                                        act_vigencia, aco_valor
                                    FROM planaccion.actividad, planaccion.actividad_costo, plandesarrollo.proyecto
                                    WHERE act_codigo=aco_actividad
                                    AND act_proyecto=pro_codigo
                                    AND act_trimestre IN (1,2,3)
                                    AND pro_codigo=$pro_codigo
                                    ORDER BY sub_codigo, pro_referencia, act_referencia ASC;";

            $queryRsCertificados=$this->cnxion->ejecutar($sqlRsCertificados);

            while($data_RsCertificados=$this->cnxion->obtener_filas($queryRsCertificados)){
                $dataRsCertificados[]=$data_RsCertificados;
            }

            return $dataRsCertificados;
        }
        public function RsProyecto(){

            $sqlRsProyecto="SELECT pro_codigo, pro_referencia, pro_descripcion, sub_codigo
                            FROM plandesarrollo.proyecto
                            ORDER BY pro_codigo ASC;";

            $queryRsProyecto=$this->cnxion->ejecutar($sqlRsProyecto);

            while($data_RsProyecto=$this->cnxion->obtener_filas($queryRsProyecto)){
                $dataRsProyecto[]=$data_RsProyecto;
            }
            return $dataRsProyecto;
        }
      
        public function RsDependencia($codigo_dependencia){//Si esta 

            $sqlRsDependencia="SELECT per_codigo, per_nombre, per_primerapellido, per_segundoapellido
                                FROM principal.persona
                                WHERE per_codigo=$codigo_dependencia;";

            $queryRsDependencia=$this->cnxion->ejecutar($sqlRsDependencia);
            $data_RsDependencia=$this->cnxion->obtener_filas($queryRsDependencia);
            
            $per_nombre=$data_RsDependencia['per_nombre'];
            $per_primerapellido=$data_RsDependencia['per_primerapellido'];
            $per_segundoapellido=$data_RsDependencia['per_segundoapellido'];
            
            $responsable=$per_nombre." ".$per_primerapellido." ".$per_segundoapellido;

            return $responsable;
        }
        public function lineaBase2018($codigo_accion){

            $sqllineaBase2018="SELECT  mpr_valoresperado
                                FROM plandesarrollo.meta_producto
                                WHERE mpr_accion=$codigo_accion
                                AND mpr_vigencia=2018;";

            $querylineaBase2018=$this->cnxion->ejecutar($sqllineaBase2018);
            $data_lineaBase2018=$this->cnxion->obtener_filas($querylineaBase2018);
            
            $mpr_valoresperado=$data_lineaBase2018['mpr_valoresperado'];
            
            return $mpr_valoresperado;
        }
        public function RsMetaHasta2019($codigo_accion){

            $sqlRsMetaHasta2019="SELECT SUM(mpr_valoresperado) AS valoresperado
                                    FROM plandesarrollo.meta_producto
                                    WHERE mpr_vigencia<=2019
                                    and mpr_accion=$codigo_accion;";

            $queryRsMetaHasta2019=$this->cnxion->ejecutar($sqlRsMetaHasta2019);
            $data_RsMetaHasta2019=$this->cnxion->obtener_filas($queryRsMetaHasta2019);
            
            $valoresperado=$data_RsMetaHasta2019['valoresperado'];
            
            return $valoresperado;
        }
        public function sqlLogroAvanzadoPorcentaje($codigo_actividad, $trimestreee, $year){
            
            if($trimestreee==1){
                $condicion="AND are_trimestre IN(20191)";
            }
            if($trimestreee==2){
                $condicion="AND are_trimestre IN(20191,20192)";
            }
            if($trimestreee==3){
                $condicion="AND are_trimestre IN(20191,20192,20193)";
            }
            
            $sqlLogroAvanzadoPorcentaje="SELECT AVG(are_avancelogrado) as suma, are_trimestre
                                            FROM planaccion.actividad_realizada, planaccion.actividad
                                            WHERE planaccion.actividad_realizada.are_actividad=planaccion.actividad.act_codigo
                                            AND are_tipoavance=1
                                            $condicion
                                            AND are_actividad=$codigo_actividad
                                            GROUP BY are_trimestre;";

            $querysqlLogroAvanzadoPorcentaje=$this->cnxion->ejecutar($sqlLogroAvanzadoPorcentaje);

            
            while($data_sqlLogroAvanzadoPorcentaje=$this->cnxion->obtener_filas($querysqlLogroAvanzadoPorcentaje)){
                $dataLogroAvanzadoPorcentaje[]=$data_sqlLogroAvanzadoPorcentaje;
            }   
            return $dataLogroAvanzadoPorcentaje;
        }


        public function nombreFormato($sub_code){

            $sqlnombreFormato="SELECT sub_codigo, sub_nombre
                                FROM  plandesarrollo.subsistema
                                WHERE sub_codigo=$sub_code;";

            $querynombreFormato=$this->cnxion->ejecutar($sqlnombreFormato);
            $data_nombreFormato=$this->cnxion->obtener_filas($querynombreFormato);
            
            $sub_nombre=$data_nombreFormato['sub_nombre'];
            
            return $sub_nombre;
        }

        public function certificadoHijo($codido_certificado, $trimestreee){

            if($trimestreee==1){
                $condicion="AND act_trimestre IN(1)";
            }
            if($trimestreee==2){
                $condicion="AND act_trimestre IN(1,2)";
            }
            if($trimestreee==3){
                $condicion="AND act_trimestre IN(1,2,3)";
            }

            $sqlcertificadoHijo="SELECT act_codigo, act_descripcion, act_certificado, 
                                        act_certificadomod, act_estadoactividad, 
                                        act_certificadopadre, aco_valor
                                FROM planaccion.actividad, planaccion.actividad_costo
                                WHERE act_codigo=aco_actividad
                                AND act_estadoactividad IN(2,3)
                                $condicion
                                AND act_certificadopadre=$codido_certificado;";

            $querycertificadoHijo=$this->cnxion->ejecutar($sqlcertificadoHijo);

            while($data_certificadoHijo=$this->cnxion->obtener_filas($querycertificadoHijo)){
                $datacertificadoHijo[]=$data_certificadoHijo;
            }
            return $datacertificadoHijo;
        }
        

    }
?>