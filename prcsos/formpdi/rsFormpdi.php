<?php
include('classFormpdi.php');
Class RsFormpdi extends PlandeComprasPDI{
   

   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function list_formpdi(){

        $sql_list_formpdi = "SELECT ent_codigo, ent_nombre, 
                                         ent_descripcion, ent_estado
                                    FROM principal.entidad
                                   WHERE ent_tipoentidad = 1;";

        $resultado_list_formpdi = $this->cnxion->ejecutar($sql_list_formpdi);

        while ($data_list_formpdi = $this->cnxion->obtener_filas($resultado_list_formpdi)){
            $datalist_formpdi[] = $data_list_formpdi;
        }
        return $datalist_formpdi;
    }

    public function datFormpdi(){
        
        $list_formpdi = $this->list_formpdi();

        if($list_formpdi){
            foreach ($list_formpdi as $dat_formpdi) {
                $ent_codigo = $dat_formpdi['ent_codigo'];
                $ent_nombre = $dat_formpdi['ent_nombre'];
                $ent_descripcion = $dat_formpdi['ent_descripcion'];
                $ent_estado = $dat_formpdi['ent_estado'];

                if($ent_estado == 1){
                    $estado = "Activo";
                }
                else{
                    $estado = "Inactivo";
                }

    
                $rsPlandeComprasPDI[] = array('ent_codigo'=> $ent_codigo, 
                                           'ent_nombre'=> $ent_nombre, 
                                           'estado'=> $estado,
                                        );
    
            }
            $dattPlandeComprasPDI=json_encode(array("data"=>$rsPlandeComprasPDI));
        }
        else{
            $dattPlandeComprasPDI=json_encode(array("data"=>""));
        } 
        return $dattPlandeComprasPDI;
    }

   
    public function form_PlandeComprasPDI($codigo_formpdi){
        
        $sql_form_formpdi = "SELECT ent_codigo, ent_nombre, ent_estado
                                    FROM principal.entidad
                                  WHERE ent_codigo = $codigo_formpdi;";

        $resultado_form_formpdi = $this->cnxion->ejecutar($sql_form_formpdi);

        ($data_form_formpdi = $this->cnxion->obtener_filas($resultado_form_formpdi));
        $dataform_formpdi[] = $data_form_formpdi;
        return $dataform_formpdi;
    }

}
?>
 
