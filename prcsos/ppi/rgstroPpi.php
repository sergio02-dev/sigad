<?php
include('classPpi.php');
class RgstroPPI extends Ppi{
    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function insertPpi(){

        $datos_insertar = $this->getArrayDatos();

        foreach ($datos_insertar as $dta_datos_insertar) {
            $codigo_plan = $dta_datos_insertar['codigo_plan'];
            $codigo_ppi = $dta_datos_insertar['codigo_ppi'];
            $persona_creo = $dta_datos_insertar['persona_creo'];
            $vigencia_ppi = $dta_datos_insertar['vigencia_ppi'];
            $valor_ppi = $dta_datos_insertar['valor_ppi'];
            $fuente_ppi = $dta_datos_insertar['fuente_ppi'];
            $estado = $dta_datos_insertar['estado'];

            $codigo_datos = date('YmdHis').rand(99,99999);

            $insert_ppi="INSERT INTO ppi.ppi(
                                     ppi_codigo, 
                                     ppi_plan, 
                                     ppi_codigoppi, 
                                     ppi_fuente, 
                                     ppi_vigencia, 
                                     ppi_valor, 
                                     ppi_estado, 
                                     ppi_fechacreo, 
                                     ppi_fechamodifico, 
                                     ppi_personacreo, 
                                     ppi_personamodifico)
                             VALUES ($codigo_datos, 
                                     $codigo_plan, 
                                     $codigo_ppi, 
                                     $fuente_ppi,
                                     $vigencia_ppi, 
                                     $valor_ppi, 
                                     $estado, 
                                     NOW(), 
                                     NOW(), 
                                     $persona_creo, 
                                     $persona_creo);";

            $this->cnxion->ejecutar($insert_ppi);

        }

    }
}
?>