<?php
include('classVicerectoria.php');
Class RsVicerrectoria extends Vicerrectoria{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function list_vicerctorias(){

        $sql_list_vicerctorias = "SELECT ent_codigo, ent_nombre, 
                                         ent_descripcion, ent_estado
                                    FROM principal.entidad
                                   WHERE ent_tipoentidad = 2;";

        $resultado_list_vicerctorias = $this->cnxion->ejecutar($sql_list_vicerctorias);

        while ($data_list_vicerctorias = $this->cnxion->obtener_filas($resultado_list_vicerctorias)){
            $datalist_vicerctorias[] = $data_list_vicerctorias;
        }
        return $datalist_vicerctorias;
    }

    

    public function datVicerrectorias(){
        
        $list_vicerctorias = $this->list_vicerctorias();

        if($list_vicerctorias){
            foreach ($list_vicerctorias as $dat_vices) {
                $ent_codigo = $dat_vices['ent_codigo'];
                $ent_nombre = $dat_vices['ent_nombre'];
                $ent_descripcion = $dat_vices['ent_descripcion'];
                $ent_estado = $dat_vices['ent_estado'];

                if($ent_estado == 1){
                    $estado = "Activo";
                }
                else{
                    $estado = "Inactivo";
                }

                
                
    
                $rsVicerrectoria[] = array('ent_codigo'=> $ent_codigo, 
                                           'ent_nombre'=> $ent_nombre, 
                                           'estado'=> $estado,
                                           
                                        );
    
            }
            $dattVicerrectoria=json_encode(array("data"=>$rsVicerrectoria));
        }
        else{
            $dattVicerrectoria=json_encode(array("data"=>""));
        } 
        return $dattVicerrectoria;
    }

    

    public function form_vicerrectoria($codigo_vicerrectoria){
        
        $sql_form_vicerrectoria = "SELECT ent_codigo, ent_nombre, ent_estado
                                    FROM principal.entidad
                                 WHERE ent_codigo = $codigo_vicerrectoria;";

        $resultado_form_vicerrectoria = $this->cnxion->ejecutar($sql_form_vicerrectoria);

        ($data_form_vicerrectoria = $this->cnxion->obtener_filas($resultado_form_vicerrectoria));
        $dataform_vicerrectoria[] = $data_form_vicerrectoria;
        return $dataform_vicerrectoria;
    }

}
?>