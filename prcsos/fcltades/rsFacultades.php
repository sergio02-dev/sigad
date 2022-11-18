<?php
include('classFacultades.php');
Class RsFacultades extends Facultades{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function list_facultades(){

        
        $sql_list_facultades = "SELECT fac_codigo, fac_nombre, fac_estado
                                    FROM usco.facultades;";

        $resultado_list_facultades = $this->cnxion->ejecutar($sql_list_facultades);

        while ($data_list_facultades = $this->cnxion->obtener_filas($resultado_list_facultades)){
            $datalist_facultades[] = $data_list_facultades;
        }
        return $datalist_facultades;
    }

    

    public function datFacultades(){
        
        $list_facultades = $this->list_facultades();

        if($list_facultades){
            foreach ($list_facultades as $dat_fcltades) {
                $fac_codigo = $dat_fcltades['fac_codigo'];
                $fac_nombre = $dat_fcltades['fac_nombre'];
                $fac_estado = $dat_fcltades['fac_estado'];

                if($fac_estado == 1){
                    $estado = "Activo";
                }
                else{
                    $estado = "Inactivo";
                }
               

    
                $rsFacultades[] = array('fac_codigo'=> $fac_codigo, 
                                            'fac_nombre'=> $fac_nombre, 
                                            'estado'=> $estado,
                                        );
    
            }
            $dattFacultades=json_encode(array("data"=>$rsFacultades));
        }
        else{
            $dattFacultades=json_encode(array("data"=>""));
        } 
        return $dattFacultades;
    }

    public function form_facultades($codigo_facultades){
        
        $sql_form_facultades = "SELECT fac_codigo, fac_nombre, fac_estado
                                    FROM usco.facultades
                                  WHERE fac_codigo = $codigo_facultades;";

        $resultado_form_facultades = $this->cnxion->ejecutar($sql_form_facultades);

        while ($data_form_facultades = $this->cnxion->obtener_filas($resultado_form_facultades)){
            $dataform_facultades[] = $data_form_facultades;
        }
        return $dataform_facultades;
    }

}
?>