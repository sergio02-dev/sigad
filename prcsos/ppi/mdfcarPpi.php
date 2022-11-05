<?php
include('classPpi.php');
class MdfcarPPI extends Ppi{
    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    }

    public function updtePpi(){

        $datos_modificar = $this->getArrayDatos();

        foreach ($datos_modificar as $dta_datos_mdfcar) {
            $codigo_plan = $dta_datos_mdfcar['codigo_plan'];
            $codigo_ppi = $dta_datos_mdfcar['codigo_ppi'];
            $persona_creo = $dta_datos_mdfcar['persona_creo'];
            $vigencia_ppi = $dta_datos_mdfcar['vigencia_ppi'];
            $valor_ppi = $dta_datos_mdfcar['valor_ppi'];
            $fuente_ppi = $dta_datos_mdfcar['fuente_ppi'];
            $estado = $dta_datos_mdfcar['estado'];


            $updte_ppi ="UPDATE ppi.ppi
                            SET ppi_valor = $valor_ppi, 
                                ppi_estado = $estado, 
                                ppi_fechamodifico = NOW(),
                                ppi_personamodifico = $persona_creo
                          WHERE ppi_plan = $codigo_plan
                            AND ppi_codigoppi = $codigo_ppi
                            AND ppi_fuente = $fuente_ppi
                            AND ppi_vigencia = $vigencia_ppi;";

            $this->cnxion->ejecutar($updte_ppi);

        }

    }
}
?>