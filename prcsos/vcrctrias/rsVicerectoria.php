<?php
include('classVicerectoria.php');
Class RsVicerrectoria extends Vicerrectoria{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function list_vicerctorias(){

        $sql_list_vicerctorias = "SELECT ent_codigo, ent_nombre, 
                                         ent_estado
                                    FROM principal.entidad
                                   WHERE ent_tipoentidad = 2;";

        $resultado_list_vicerctorias = $this->cnxion->ejecutar($sql_list_vicerctorias);

        while ($data_list_vicerctorias = $this->cnxion->obtener_filas($resultado_list_vicerctorias)){
            $datalist_vicerctorias[] = $data_list_vicerctorias;
        }
        return $datalist_vicerctorias;
    }

    /*public function sedes_vicerrectoria($codigo_vicerrectoria){

        
        $sql_sedes_vicerrectoria = "SELECT svi_codigo, svi_sede, svi_vicerrectoria,
                                           sed_nombre
                                      FROM usco.sede_vicerrectoria
                                     INNER JOIN principal.sedes ON sed_codigo = svi_sede
                                     WHERE svi_vicerrectoria = $codigo_vicerrectoria;";

        $resultado_sedes_vicerrectoria = $this->cnxion->ejecutar($sql_sedes_vicerrectoria);

        while ($data_sedes_vicerrectoria = $this->cnxion->obtener_filas($resultado_sedes_vicerrectoria)){
            $datasedes_vicerrectoria[] = $data_sedes_vicerrectoria;
        }
        return $datasedes_vicerrectoria;
    }*/

    

    public function datVicerrectorias(){
        
        $list_vicerctorias = $this->list_vicerctorias();

        if($list_vicerctorias){
            foreach ($list_vicerctorias as $dat_vices) {
                $ent_codigo = $dat_vices['ent_codigo'];
                $ent_nombre = $dat_vices['ent_nombre'];
                $ent_estado = $dat_vices['ent_estado'];

                if($ent_estado == 1){
                    $estado = "Activo";
                }
                else{
                    $estado = "Inactivo";
                }

                /*$sedes_vicerrectoria = $this->sedes_vicerrectoria($ent_codigo);
                $nombre_sedes = '';
                if($sedes_vicerrectoria){
                    foreach ($sedes_vicerrectoria as $dat_sedes) {
                        $svi_sede = $dat_sedes['svi_sede'];
                        $sed_nombre = $dat_sedes['sed_nombre'];

                        $nombre_sedes = $nombre_sedes.$sed_nombre.'\n';
                    }
                }*/
    
                $rsVicerrectoria[] = array('ent_codigo'=> $ent_codigo, 
                                           'ent_nombre'=> $ent_nombre, 
                                           'estado'=> $estado,
                                           //'nombre_sedes'=> $nombre_sedes
                                        );
    
            }
            $dattVicerrectoria=json_encode(array("data"=>$rsVicerrectoria));
        }
        else{
            $dattVicerrectoria=json_encode(array("data"=>""));
        } 
        return $dattVicerrectoria;
    }

    /*public function list_sedes(){
        
        $sql_list_sedes = "SELECT sed_codigo, sed_nombre, sed_estado
                             FROM principal.sedes
                            WHERE sed_estado = 1
                            ORDER BY sed_nombre ASC;";

        $resultado_list_sedes = $this->cnxion->ejecutar($sql_list_sedes);

        while ($data_list_sedes = $this->cnxion->obtener_filas($resultado_list_sedes)){
            $datalist_sedes[] = $data_list_sedes;
        }
        return $datalist_sedes;
    }*/

    /*public function form_vicerrectoria($codigo_vicerrectoria){
        
        $sql_form_vicerrectoria = "SELECT ent_codigo, ent_nombre, ent_estado
                                    FROM principal.entidad
                                 WHERE ent_codigo = $codigo_vicerrectoria;";

        $resultado_form_vicerrectoria = $this->cnxion->ejecutar($sql_form_vicerrectoria);

        ($data_form_vicerrectoria = $this->cnxion->obtener_filas($resultado_form_vicerrectoria));
        $dataform_vicerrectoria[] = $data_form_vicerrectoria;
        return $dataform_vicerrectoria;
    }*/

    public function form_vicerrectoria($codigo_vicerrectoria){
        
        $sql_form_vicerrectoria  = "SELECT ent_codigo, ent_nombre, 
                                        ent_estado
                                     FROM principal.entidad
                                    WHERE ent_codigo = $codigo_vicerrectoria;";
        

        $resultado_form_vicerrectoria  = $this->cnxion->ejecutar($sql_form_vicerrectoria);

        ($data_form_vicerrectoria  = $this->cnxion->obtener_filas($resultado_form_vicerrectoria ));
         $dataform_vicerrectoria [] = $data_form_vicerrectoria ;
    
        return $dataform_vicerrectoria;
    }


}
?>