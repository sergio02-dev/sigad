<?php
include('classOficinafuente.php');
Class RsOficinafuente extends OficinaFuente{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function list_oficina(){

        $sql_list_oficina = "SELECT ofi_codigo, 
                                    ofi_nombre 
                                    FROM usco.oficina
                                    ORDER by ofi_nombre ASC;";

        $resultado_list_oficina = $this->cnxion->ejecutar($sql_list_oficina);

        while ($data_list_oficina = $this->cnxion->obtener_filas($resultado_list_oficina)){
            $datalist_oficina[] = $data_list_oficina;
        }
        return $datalist_oficina;
    }

    public function nombre_oficina($codigo_oficina){
        
        $sql_nombre_oficina= "SELECT ofi_nombre
                              FROM usco.oficina
                             WHERE ofi_codigo = $codigo_oficina;";

        $resultado_nombre_oficina = $this->cnxion->ejecutar($sql_nombre_oficina);

        $data_nombre_oficina= $this->cnxion->obtener_filas($resultado_nombre_oficina);
        
        $ofi_nombre = $data_nombre_oficina['ofi_nombre'];

        return $ofi_nombre;
    }
    public function nombre_cargo($codigo_cargo){
        
        $sql_nombre_cargo= "SELECT car_nombre
                              FROM usco.cargo
                             WHERE car_codigo = $codigo_cargo;";

        $resultado_nombre_cargo = $this->cnxion->ejecutar($sql_nombre_cargo);

        $data_nombre_cargo= $this->cnxion->obtener_filas($resultado_nombre_cargo);
        
        $car_nombre = $data_nombre_cargo['car_nombre'];

        return $car_nombre;
    }
    public function nombre_fuente($codigo_fuente){
        
        $sql_nombre_fuente= "SELECT ffi_nombre
                              FROM planaccion.fuente_financiacion
                             WHERE ffi_codigo = $codigo_fuente;";

        $resultado_nombre_fuente = $this->cnxion->ejecutar($sql_nombre_fuente);

        $data_nombre_fuente= $this->cnxion->obtener_filas($resultado_nombre_fuente);
        
        $ffi_nombre = $data_nombre_fuente['ffi_nombre'];

        return $ffi_nombre;
    }

    public function list_cargo(){

        $sql_list_cargo = "SELECT   car_codigo, 
                                    car_nombre
                                    FROM usco.cargo
                                    ORDER by car_nombre ASC;";

        $resultado_list_cargo = $this->cnxion->ejecutar($sql_list_cargo);

        while ($data_list_cargo = $this->cnxion->obtener_filas($resultado_list_cargo)){
            $datalist_cargo[] = $data_list_cargo;
        }
        return $datalist_cargo;
    }

    public function list_fuente(){

        $sql_list_cargo = "SELECT ffi_codigo, ffi_nombre 
                            FROM planaccion.fuente_financiacion
                         WHERE ffi_clasificacion=3;";

        $resultado_list_cargo = $this->cnxion->ejecutar($sql_list_cargo);

        while ($data_list_cargo = $this->cnxion->obtener_filas($resultado_list_cargo)){
            $datalist_cargo[] = $data_list_cargo;
        }
        return $datalist_cargo;
    }

    public function list_oficina_fuente(){

        $sql_list_oficina_fuente = "SELECT off_oficina, 
                                           off_cargo,
                                           off_fuente
                                        FROM usco.oficinafuente;";

        $resultado_list_oficina_fuente = $this->cnxion->ejecutar($sql_list_oficina_fuente);

        while ($data_list_oficina_fuente = $this->cnxion->obtener_filas($resultado_list_oficina_fuente)){
            $datalist_oficina_fuente[] = $data_list_oficina_fuente;
        }
        return $datalist_oficina_fuente;
    }
    

    public function datOficinafuente(){
        
        $list_oficinafuente = $this->list_oficina_fuente();

        if($list_oficinafuente){
            foreach ($list_oficinafuente as $dat_oficinafuente) {
                $off_oficina = $dat_oficinafuente['off_oficina'];
                $off_cargo = $dat_oficinafuente['off_cargo'];
                $off_fuente = $dat_oficinafuente['off_fuente'];
                $off_estado = $dat_oficinafuente['off_estado'];

                $nombre_oficina = $this->nombre_oficina($off_oficina);
                $nombre_cargo = $this->nombre_oficina($off_cargo);
                $nombre_fuente = $this->nombre_oficina($off_fuente);

                if($off_estado == 1){
                    $estado = "Activo";
                }
                else{
                    $estado = "Inactivo";
                }

    
                $rsOficinafuente[] = array('ofi_nombre'=> $nombre_oficina, 
                                           'car_nombre'=> $nombre_cargo,
                                           'ffi_nombre'=> $nombre_fuente, 
                                           'estado'=> $estado,
                                        );
    
            }
            $dattOficinafuente=json_encode(array("data"=>$rsOficinafuente));
        }
        else{
            $dattOficinafuente=json_encode(array("data"=>""));
        } 
        return $dattOficinafuente;
    }

 

    


}
?>