<?php
include('classEquipoPdi.php');
Class RsEquipoPdi extends EquipoPdi{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

 
    public function list_linea(){

        $sql_list_linea = "SELECT lin_codigo, lin_nombre, lin_estado
                                FROM inventario.linea
                                ORDER BY lin_nombre ASC;";

        $resultado_list_linea = $this->cnxion->ejecutar($sql_list_linea);

        while ($data_list_linea = $this->cnxion->obtener_filas($resultado_list_linea)){
            $datalist_linea[] = $data_list_linea;
        }
        return $datalist_linea;
    }



    public function list_sublinea($codigo_linea){


        $sql_list_sublinea = "SELECT slin_codigo, slin_linea, slin_nombre, slin_estado
                                FROM inventario.sub_linea
                               WHERE slin_linea = $codigo_linea
                                ORDER BY slin_nombre ASC;";

        $resultado_list_sublinea = $this->cnxion->ejecutar($sql_list_sublinea);

        while ($data_list_sublinea = $this->cnxion->obtener_filas($resultado_list_sublinea)){
            $datalist_sublinea[] = $data_list_sublinea;
        }
        return $datalist_sublinea;
    }   


}
?>
 
