<?php
include('classAreas.php');
Class RsAreas extends Areas{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function list_areas(){

        
        $sql_list_areas = "SELECT are_codigo, are_nombre, are_estado
                                FROM usco.areas;";
        

        $resultado_list_areas = $this->cnxion->ejecutar($sql_list_areas);

        while ($data_list_areas = $this->cnxion->obtener_filas($resultado_list_areas)){
            $datalist_areas[] = $data_list_areas;
        }
        return $datalist_areas;
    }

    

    public function datAreas(){
        
        $list_areas = $this->list_areas();

        if($list_areas){
            foreach ($list_areas as $dat_area) {
                $are_codigo = $dat_area['are_codigo'];
                $are_nombre = $dat_area['are_nombre'];
                $are_estado = $dat_area['are_estado'];

                if($are_estado == 1){
                    $estado = "Activo";
                }
                else{
                    $estado = "Inactivo";
                }
               

    
                $rsAreas[] = array('are_codigo'=> $are_codigo, 
                                            'are_nombre'=> $are_nombre, 
                                            'estado'=> $estado,
                                        );
    
            }
            $dattAreas=json_encode(array("data"=>$rsAreas));
        }
        else{
            $dattAreas=json_encode(array("data"=>""));
        } 
        return $dattAreas;
    }

    public function form_areas($codigo_areas){
        
        $sql_form_area = "SELECT are_codigo, are_nombre, are_estado
                                    FROM usco.areas
                                  WHERE are_codigo = $codigo_areas;";

        $resultado_form_area = $this->cnxion->ejecutar($sql_form_area);

        while ($data_form_area = $this->cnxion->obtener_filas($resultado_form_area)){
            $dataform_area[] = $data_form_area;
        }
        return $dataform_area;
    }

}
?>