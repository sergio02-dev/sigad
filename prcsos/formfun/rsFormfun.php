<?php
include('classFuncionamiento.php');
Class RsFuncionamiento extends Funcionamiento{
   

   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function list_formfun(){

        $sql_list_formfun = "SELECT fun_codigo, fun_sede, 
                                        fun_descripcion, fun_estado
                                    FROM principal.entidad
                                   WHERE ent_tipoentidad = 1;";

        $resultado_list_formfun = $this->cnxion->ejecutar($sql_list_formfun);

        while ($data_list_formfun = $this->cnxion->obtener_filas($resultado_list_formfun)){
            $datalist_formfun[] = $data_list_formfun;
        }
        return $datalist_formfun;
    }

 

    

    public function datFuncionamiento(){
        
        $list_formfun = $this->list_formfun();

        if($list_formfun){
            foreach ($list_formfun as $dat_fun) {
                $fun_codigo = $dat_fun['fun_codigo'];
                $fun_nombre = $dat_fun['ent_nombre'];
                $fun_descripcion = $dat_fun['fun_descripcion'];
                $fun_estado = $dat_fun['fun_estado'];

                if($fun_estado == 1){
                    $estado = "Activo";
                }
                else{
                    $estado = "Inactivo";
                }

    
                $rsFuncionamiento[] = array('fun_codigo'=> $fun_codigo, 
                                           'estado'=> $estado,
                                        );
    
            }
            $dattFuncionamiento=json_encode(array("data"=>$rsFuncionamiento));
        }
        else{
            $dattFuncionamiento=json_encode(array("data"=>""));
        } 
        return $dattFuncionamiento;
    }

   
    public function form_funcionamiento($codigo_formfun){
        
        $sql_form_formfun = "SELECT fun_codigo, fun_estado
                                    FROM principal.entidad
                                  WHERE fun_codigo = $codigo_formfun;";

        $resultado_form_formfun = $this->cnxion->ejecutar($sql_form_formfun);

        ($data_form_formfun = $this->cnxion->obtener_filas($resultado_form_formfun));
        $dataform_formfun[] = $data_form_formfun;
        return $dataform_formfun;
    }

}
?>