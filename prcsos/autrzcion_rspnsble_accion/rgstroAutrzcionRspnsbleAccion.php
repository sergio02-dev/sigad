<?php
    include('classAutrzcionRspnsbleAccion.php');

    class RgstroAutrzcionRspnsbleAccion extends AutorizacionResponsableAccion{

        private $codigo_autorizacionresponsableaccion;
        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
            $this->codigo_autorizacionresponsableaccion = date('YmdHis').rand(99,999);
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
        
        public function list_autorizacion_financiera($codigo_accion){

            $sql_list_autorizacion_financiera="SELECT DISTINCT res_nivel, vin_persona, vin_codigo, 
                                                     per_nombre, per_correo, per_primerapellido
                                                FROM usco.responsable,usco.vinculacion, principal.persona 
                                               WHERE res_codigocargo = vin_cargo
                                                 AND res_codigooficina = vin_oficina
                                                 AND vin_persona = per_codigo
                                                 AND vin_estado = 1
                                                 AND res_estado = 1
                                                 AND res_nivel = 3
                                                 AND res_tiporesponsable = 3
                                                 AND res_clasificacion = 2
                                                 AND res_codigonivel = $codigo_accion";
    
            $query_list_autorizacion_financiera=$this->cnxion->ejecutar($sql_list_autorizacion_financiera);
    
            while($data_list_autorizacion_financiera=$this->cnxion->obtener_filas($query_list_autorizacion_financiera)){
                $datalist_autorizacion_financiera[]=$data_list_autorizacion_financiera;
            }
            return $datalist_autorizacion_financiera;
        }

        public function insert_autorizacion_rspnsble_accion(){
            
            $sql_insert_autorizacion_rspnsble_accion="INSERT INTO cdp.aprovacion_solicitud(
                                                                  asol_codigo, 
                                                                  asol_solicitud, 
                                                                  asol_clasificacion, 
                                                                  asol_estado, 
                                                                  asol_fechacreo, 
                                                                  asol_fechamodifico,
                                                                  asol_personacreo, 
                                                                  asol_personamodifico)
                                                          VALUES (".$this->codigo_autorizacionresponsableaccion.", 
                                                                  ".$this->getSolicitud().", 
                                                                  3, 
                                                                  1, 
                                                                  NOW(), 
                                                                  NOW(), 
                                                                  ".$this->getPersonaSistema().", 
                                                                  ".$this->getPersonaSistema().");";
            //echo "insert uno ".$sql_insert_autorizacion_rspnsble_accion;
            $query_insert_acto_administrativo=$this->cnxion->ejecutar($sql_insert_autorizacion_rspnsble_accion);

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
                                                   ".$this->codigo_autorizacionresponsableaccion.", 
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

            return $sql_insert_autorizacion_rspnsble_accion;
        }
    }
?>