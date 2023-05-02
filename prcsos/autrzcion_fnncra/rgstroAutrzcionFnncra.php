<?php
    include('classAutrzcionFnncra.php');

    class RgstroAutrzcionFnnciera extends AutorizacionFinanciera{

        private $codigo_autorizacionfnanciera;
        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_autorizacionfnanciera = date('YmdHis').rand(99,999);
        }

        public function codigo_autorizacion_clasificador(){

            $sql_codigo_autorizacion_clasificador="SELECT MAX(ascl_codigo) AS cdgo
                                                     FROM cdp.aprovacion_solicitud_clasificador;";
    
            $query_codigo_autorizacion_clasificador=$this->cnxion->ejecutar($sql_codigo_autorizacion_clasificador);
    
            $data_codigo_autorizacion_clasificador=$this->cnxion->obtener_filas($query_codigo_autorizacion_clasificador);
    
            $cdgo = $data_codigo_autorizacion_clasificador['cdgo'];

            if($cdgo){
                $cdigo = $cdgo + 1;
            }
            else{
                $cdigo = 1;
            }
    
            return $cdigo;
        }
        
        public function insert_autorizacion_financiera(){
            
            $sql_insert_autorizacion_financiera="INSERT INTO cdp.aprovacion_solicitud(
                                                             asol_codigo, 
                                                             asol_solicitud, 
                                                             asol_clasificacion, 
                                                             asol_estado, 
                                                             asol_fechacreo, 
                                                             asol_fechamodifico,
                                                             asol_personacreo, 
                                                             asol_personamodifico)
                                                     VALUES (".$this->codigo_autorizacionfnanciera.", 
                                                             ".$this->getSolicitud().", 
                                                             2, 
                                                             1, 
                                                             NOW(), 
                                                             NOW(), 
                                                             ".$this->getPersonaSistema().", 
                                                             ".$this->getPersonaSistema().");";
            //echo "insert uno ".$sql_insert_autorizacion_financiera;
            $query_insert_acto_administrativo=$this->cnxion->ejecutar($sql_insert_autorizacion_financiera);

            $array_datos = $this->getArrayDatos();
            if($array_datos){
                foreach ($array_datos as $dta_array_dtos) {
                    $codigo_actividad = $dta_array_dtos['codigo_actividad'];
                    $codigo_etapa = $dta_array_dtos['codigo_etapa'];
                    $codigo_clasificador = $dta_array_dtos['codigo_clasificador'];
                    $codigo_aprobacion = $dta_array_dtos['codigo_aprobacion'];

                    $codigo_autorizacion_clasificador = $this->codigo_autorizacion_clasificador();

                    $sql_aprobacion = "INSERT INTO cdp.aprovacion_solicitud_clasificador(
                                                   ascl_codigo, 
                                                   ascl_aprovacionsolicitud, 
                                                   ascl_actividad, 
                                                   ascl_etapa, 
                                                   ascl_etapasolicitudclasificador, 
                                                   ascl_aprovacion, 
                                                   ascl_fechacreo, 
                                                   ascl_fechamodifico, 
                                                   ascl_personacreo, 
                                                   ascl_personamodifico)
                                           VALUES ($codigo_autorizacion_clasificador,
                                                   ".$this->codigo_autorizacionfnanciera.", 
                                                   $codigo_actividad, 
                                                   $codigo_etapa, 
                                                   $codigo_clasificador, 
                                                   $codigo_aprobacion, 
                                                   NOW(), 
                                                   NOW(), 
                                                   ".$this->getPersonaSistema().", 
                                                   ".$this->getPersonaSistema().");";

                    //echo "<br><br> insert uno ".$sql_aprobacion;
                    $query_aprobacion=$this->cnxion->ejecutar($sql_aprobacion);

                }
            }

            return $sql_insert_autorizacion_financiera;
        }
    }
?>