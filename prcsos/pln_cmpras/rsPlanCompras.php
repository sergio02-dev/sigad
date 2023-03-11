<?php
    include('classPlanCompras.php');
    class RsPlanCmpras extends PlanCompras{

        private $cnxion;

        public function __construct(){
            $this->cnxion = Dtbs::getInstance();
        }

        public function datos_etapa($codigo_etapa){

            $sql_datos_etapa="SELECT poa_codigo, poa_referencia, 
                                     poa_objeto, poa_numero
                                FROM planaccion.poai
                               WHERE poa_codigo = $codigo_etapa;";
    
            $query_datos_etapa = $this->cnxion->ejecutar($sql_datos_etapa);
    
            $data_datos_etapa = $this->cnxion->obtener_filas($query_datos_etapa);
            
            $poa_referencia = $data_datos_etapa['poa_referencia'];
            $poa_numero = $data_datos_etapa['poa_numero'];
            $poa_objeto = $data_datos_etapa['poa_objeto'];

            $descripcion = "<strong>".$poa_referencia.".".$poa_numero."</strong><br/>".$poa_objeto;
            
            return $descripcion;
        }
        

        public function nombre_area($codigo_area){
        
            $sql_nombre_area = "SELECT are_nombre
                                    FROM usco.areas
                                  WHERE are_codigo = $codigo_area;";
    
            $resultado_nombre_area = $this->cnxion->ejecutar($sql_nombre_area);
    
            $data_nombre_area= $this->cnxion->obtener_filas($resultado_nombre_area);
            
            $area_nombre = $data_nombre_area['are_nombre'];
    
            return $area_nombre;
        }
    
    
    
    
        public function nombre_dependencia($codigo_dependencia){
            
            $sql_nombre_dependencia = "SELECT ofi_nombre
                                  FROM usco.oficina
                                 WHERE ofi_codigo = $codigo_dependencia;";
    
            $resultado_nombre_dependencia= $this->cnxion->ejecutar($sql_nombre_dependencia);
    
            $data_nombre_dependencia= $this->cnxion->obtener_filas($resultado_nombre_dependencia);
            
            $ofi_nombre = $data_nombre_dependencia['ofi_nombre'];
    
            return $ofi_nombre;
        }

        
        public function nombre_descripcionEquipo($codigo_descripcion){
            
            $sql_nombre_descripcionEquipo = "SELECT deq_descripcion
                                                FROM inventario.descripcion_equipo
                                            WHERE deq_codigo = $codigo_descripcion;";

            $resultado_nombre_descripcionEquipo= $this->cnxion->ejecutar($sql_nombre_descripcionEquipo);

            $data_nombre_descripcionEquipo= $this->cnxion->obtener_filas($resultado_nombre_descripcionEquipo);
            
            $deq_descripcion= $data_nombre_descripcionEquipo['deq_descripcion'];

            return $deq_descripcion;
        }
   

            
        public function nombre_sede($codigo_sede){
            
            $sql_nombre_sede = "SELECT sed_nombre
                                FROM principal.sedes
                                WHERE sed_codigo = $codigo_sede;";

            $resultado_nombre_sede = $this->cnxion->ejecutar($sql_nombre_sede);

            $data_nombre_sede= $this->cnxion->obtener_filas($resultado_nombre_sede);
            
            $sed_nombre = $data_nombre_sede['sed_nombre'];

            return $sed_nombre;
        }
       

        public function validar_sedeindicador($codigo_actividad){
            $sql_validar_sedeindicador = "SELECT acp_sedeindicador
                                            FROM planaccion.actividad_poai
                                            WHERE acp_codigo = $codigo_actividad";
            $resultado_validar_sedeindicador=$this->cnxion->ejecutar($sql_validar_sedeindicador);

            $data_validar_sedeindicador= $this->cnxion->obtener_filas($resultado_validar_sedeindicador);
            
            $acp_sedeindicador = $data_validar_sedeindicador['acp_sedeindicador'];

            return $acp_sedeindicador;
        }
        
        public function list_plan_cmpras($codigo_accion, $codigo_actividad){

            $codigo_indicador = $this->validar_sedeindicador($codigo_actividad);

            if($codigo_indicador > 0){
                $codigo_sede = "SELECT ind_sede
                                  FROM plandesarrollo.indicador
                                 WHERE ind_codigo = $codigo_indicador";
            }
            else{
                $codigo_sede = "SELECT ind_sede
                                  FROM planaccion.actividad_indicador,plandesarrollo.indicador
                                 WHERE ain_indicador = ind_codigo 
                                  AND  ain_actividad = $codigo_actividad";
            }


            if($_SESSION['idusuario']==1 || $_SESSION['idusuario']==201604281729001 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1){
                $condicion="";
            }
            else{
                $codigo_seesion = $_SESSION['idusuario'];
                $condicion = "AND pdi_dependencia IN(SELECT DISTINCT vin_oficina
                                                       FROM usco.vinculacion
                                                      WHERE vin_persona = $codigo_seesion)";
            }
            

            $sql_list_plan_cmpras="SELECT pdi_codigo,pdi_sede, pdi_dependencia, pdi_area,pdi_plantafisica,
                                          pdi_equipodescripcion, pdi_valorunitario, pdi_cantidad                                     
                                    FROM usco.formulariopdi
                                    WHERE pdi_accion = $codigo_accion
                                      AND pdi_sede IN($codigo_sede)
                                      $condicion
                                     ORDER BY pdi_equipodescripcion ASC;";

            $query_list_plan_cmpras=$this->cnxion->ejecutar($sql_list_plan_cmpras);
            while($data_list_plan_cmpras=$this->cnxion->obtener_filas($query_list_plan_cmpras)){
                $datalist_plan_cmpras[]=$data_list_plan_cmpras;
            }
            return $datalist_plan_cmpras;
        }

        public function check_arreglo($codigo_plancompras,$codigo_etapa){
            
            

            $sql_check_arreglo  = "SELECT COUNT(*) checkbox
                                         FROM usco.plancompras_accion
                                        WHERE pca_plancompras = $codigo_plancompras
                                        AND pca_estado = 1
                                        AND pca_etapa = $codigo_etapa;";
            
    
            $resultado_check_arreglo  = $this->cnxion->ejecutar($sql_check_arreglo);
    
            $data_check_arreglo = $this->cnxion->obtener_filas($resultado_check_arreglo);
    
            $checkbox = $data_check_arreglo['checkbox'];
    
            if($checkbox == 0){
                $checkear = "";
            }
            else{
                $checkear = "checked";
            }
    
            return $checkear;
        }
    


       
    }
?>