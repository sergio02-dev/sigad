<?php
include('classFacultades.php');
Class RsFacultades extends Facultades{
   

   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function list_fcltades(){

        $sql_list_fcltades = "SELECT ent_codigo, ent_nombre, 
                                         ent_descripcion, ent_estado
                                    FROM principal.entidad
                                   WHERE ent_tipoentidad = 1;";

        $resultado_list_fcltades = $this->cnxion->ejecutar($sql_list_fcltades);

        while ($data_list_fcltades = $this->cnxion->obtener_filas($resultado_list_fcltades)){
            $datalist_fcltades[] = $data_list_fcltades;
        }
        return $datalist_fcltades;
    }

 

    

    public function datFacultades(){
        
        $list_facultades = $this->list_fcltades();

        if($list_facultades){
            foreach ($list_facultades as $dat_fac) {
                $ent_codigo = $dat_fac['ent_codigo'];
                $ent_nombre = $dat_fac['ent_nombre'];
                $ent_descripcion = $dat_fac['ent_descripcion'];
                $ent_estado = $dat_fac['ent_estado'];

                if($ent_estado == 1){
                    $estado = "Activo";
                }
                else{
                    $estado = "Inactivo";
                }

    
                $rsFacultades[] = array('ent_codigo'=> $ent_codigo, 
                                           'ent_nombre'=> $ent_nombre, 
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
        
        $sql_form_facultades = "SELECT ent_codigo, ent_nombre, ent_estado
                                    FROM principal.entidad
                                  WHERE ent_codigo = $codigo_facultades;";

        $resultado_form_facultades = $this->cnxion->ejecutar($sql_form_facultades);

        ($data_form_facultades = $this->cnxion->obtener_filas($resultado_form_facultades));
        $dataform_facultades[] = $data_form_facultades;
        return $dataform_facultades;
    }

}
?>