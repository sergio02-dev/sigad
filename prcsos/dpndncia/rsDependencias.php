<?php
include('classDependencia.php');
Class RsDependencias extends Dependencia{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function list_dependencias(){

        
        $sql_list_dependencias = "SELECT ofi_codigo, ofi_nombre, ofi_estado
                                    FROM usco.oficina;";

        $resultado_list_dependencias = $this->cnxion->ejecutar($sql_list_dependencias);

        while ($data_list_dependencias = $this->cnxion->obtener_filas($resultado_list_dependencias)){
            $datalist_dependencias[] = $data_list_dependencias;
        }
        return $datalist_dependencias;
    }

    

    public function datDependencias(){
        
        $list_dependencias = $this->list_dependencias();

        if($list_dependencias){
            foreach ($list_dependencias as $dat_dpndncias) {
                $ofi_codigo = $dat_dpndncias['ofi_codigo'];
                $ofi_nombre = $dat_dpndncias['ofi_nombre'];
                $ofi_estado = $dat_dpndncias['ofi_estado'];

                if($ofi_estado == 1){
                    $estado = "Activo";
                }
                else{
                    $estado = "Inactivo";
                }
    
                $rsDependencias[] = array('ofi_codigo'=> $ofi_codigo, 
                                            'ofi_nombre'=> $ofi_nombre, 
                                            'estado'=> $estado,
                                        );
    
            }
            $dattDependencias=json_encode(array("data"=>$rsDependencias));
        }
        else{
            $dattDependencias=json_encode(array("data"=>""));
        } 
        return $dattDependencias;
    }

    public function form_dependencia($codigo_dependencia){
        
        $sql_form_dependencia = "SELECT ofi_codigo, ofi_nombre, ofi_estado
                                    FROM usco.oficina
                                  WHERE ofi_codigo = $codigo_dependencia;";

        $resultado_form_dependencia = $this->cnxion->ejecutar($sql_form_dependencia);

        while ($data_form_dependencia = $this->cnxion->obtener_filas($resultado_form_dependencia)){
            $dataform_dependencia[] = $data_form_dependencia;
        }
        return $dataform_dependencia;
    }

}
?>