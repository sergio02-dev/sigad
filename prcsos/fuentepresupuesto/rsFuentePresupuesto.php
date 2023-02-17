<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 * 24 de enero 2023 15:41pm
 * Clase Fuente presupuesto
 */
include_once('classFuentePresupuesto.php');
Class RsFuentePresupuesto extends FuentePresupuesto{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function list_fuente_presupuesto(){

        
        $sql_list_fuente_presupuesto = "SELECT fup_codigo, fup_linix, fup_nombre, fup_estado,fup_excfacultad
                                          FROM usco.fuentes_presupuesto;";
        

        $resultado_list_fuente_presupuesto = $this->cnxion->ejecutar($sql_list_fuente_presupuesto);

        while ($data_list_fuente_presupuesto = $this->cnxion->obtener_filas($resultado_list_fuente_presupuesto)){
            $datalist_fuente_presupuesto[] = $data_list_fuente_presupuesto;
        }
        return $datalist_fuente_presupuesto;
    }

    

    public function datFuentePresupuesto(){
        
        $list_fuente_presupuesto = $this->list_fuente_presupuesto();

        if($list_fuente_presupuesto){
            foreach ($list_fuente_presupuesto as $dat_fuente_presupuesto) {
                $fup_codigo = $dat_fuente_presupuesto['fup_codigo'];
                $fup_nombre = $dat_fuente_presupuesto['fup_nombre'];
                $fup_estado = $dat_fuente_presupuesto['fup_estado'];
                $fup_linix = $dat_fuente_presupuesto['fup_linix'];
                $fup_excfacultad = $dat_fuente_presupuesto['fup_excfacultad'];


                if($fup_estado == 1){
                    $estado = "Activo";
                }
                else{
                    $estado = "Inactivo";
                }
                
               

    
                $rsFuentePresupuesto[] = array('fup_codigo'=> $fup_codigo, 
                                            'fup_linix'=> $fup_linix,
                                            'fup_nombre'=> $fup_nombre, 
                                            'estado'=> $estado,
                                            'fup_excfacultad'=> $fup_excfacultad,
                                        );
    
            }
            $dattFuentePresupuesto=json_encode(array("data"=>$rsFuentePresupuesto));
        }
        else{
            $dattFuentePresupuesto=json_encode(array("data"=>""));
        } 
        return $dattFuentePresupuesto;
    }

    public function form_fuente_presupuesto($codigo_fuentepresupuesto){
        
        $sql_form_fuente_presupuesto = "SELECT fup_codigo, fup_linix, fup_nombre, fup_estado, fup_excfacultad
                            FROM usco.fuentes_presupuesto
                           WHERE fup_codigo = $codigo_fuentepresupuesto;";

        $resultado_form_fuente_presupuesto = $this->cnxion->ejecutar($sql_form_fuente_presupuesto);

        ($data_form_fuente_presupuesto = $this->cnxion->obtener_filas($resultado_form_fuente_presupuesto));
        $dataform_fuente_presupuesto[] = $data_form_fuente_presupuesto;
        
        return $dataform_fuente_presupuesto;
    }

}
?>