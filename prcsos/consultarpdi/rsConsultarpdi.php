<?php
include('classConsultarpdi.php');
Class RsConsultarPdi extends ConsultarPDI{


    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 


    public function nombre_sede($codigo_sede){
        
        $sql_nombre_sede = "SELECT sed_nombre
                              FROM principal.sedes
                             WHERE sed_codigo = $codigo_sede;";

        $resultado_nombre_sede = $this->cnxion->ejecutar($sql_nombre_sede);

        $data_nombre_sede= $this->cnxion->obtener_filas($resultado_nombre_sede);
        
        $sed_nombre = $data_nombre_sede['sed_nombre'];

        if($sed_nombre==""){
            $sed_nombre= 'NA';
        }
        else{
            $sed_nombre = $sed_nombre;
        }

        return $sed_nombre;
    }

    public function nombre_vicerrectoria($codigo_vicerrectoria){
        
        $sql_nombre_vicerrectoria = "SELECT ent_nombre
                                        FROM principal.entidad
                                      WHERE ent_codigo = $codigo_vicerrectoria;";

        $resultado_nombre_vicerrectoria = $this->cnxion->ejecutar($sql_nombre_vicerrectoria);

        $data_nombre_vicerrectoria= $this->cnxion->obtener_filas($resultado_nombre_vicerrectoria);
        
        $ent_nombre = $data_nombre_vicerrectoria['ent_nombre'];

        if($ent_nombre==""){
            $ent_nombre= 'NA';
        }
        else{
            $ent_nombre = $ent_nombre;
        }

        return $ent_nombre;
    }

    public function nombre_facultad($codigo_facultad){
        
        $sql_nombre_facultad = "SELECT ent_nombre
                                    FROM principal.entidad
                                  WHERE ent_codigo = $codigo_facultad;";

        $resultado_nombre_facultad = $this->cnxion->ejecutar($sql_nombre_facultad);

        $data_nombre_facultad= $this->cnxion->obtener_filas($resultado_nombre_facultad);
        
        $fac_nombre = $data_nombre_facultad['ent_nombre'];

        if($fac_nombre==""){
            $fac_nombre= 'NA';
        }
        else{
            $fac_nombre = $fac_nombre;
        }

        return $fac_nombre;
    }

    public function nombre_area($codigo_area){
        
        $sql_nombre_area = "SELECT are_nombre
                                FROM usco.areas
                              WHERE are_codigo = $codigo_area;";

        $resultado_nombre_area = $this->cnxion->ejecutar($sql_nombre_area);

        $data_nombre_area= $this->cnxion->obtener_filas($resultado_nombre_area);
        
        $are_nombre = $data_nombre_area['are_nombre'];

        if($are_nombre==""){
            $are_nombre= 'NA';
        }
        else{
            $are_nombre = $are_nombre;
        }

        return $are_nombre;
    }




    public function nombre_dependencia($codigo_dependencia){
        
        $sql_nombre_dependencia = "SELECT ofi_nombre
                              FROM usco.oficina
                             WHERE ofi_codigo = $codigo_dependencia;";

        $resultado_nombre_dependencia= $this->cnxion->ejecutar($sql_nombre_dependencia);

        $data_nombre_dependencia= $this->cnxion->obtener_filas($resultado_nombre_dependencia);
        
        $ofi_nombre = $data_nombre_dependencia['ofi_nombre'];

        
        if($ofi_nombre == ""){
            $ofi_nombre = 'NA';
        }
        else{
            $ofi_nombre = $ofi_nombre;
        }
        

        return $ofi_nombre;
    }

    public function nombre_accion($codigo_accion){
        
        $sql_nombre_accion = "SELECT acc_referencia , acc_numero
                              FROM plandesarrollo.accion
                             WHERE acc_codigo = $codigo_accion;";

        $resultado_nombre_accion= $this->cnxion->ejecutar($sql_nombre_accion);

        $data_nombre_accion= $this->cnxion->obtener_filas($resultado_nombre_accion);
        
        $acc_referencia = $data_nombre_accion['acc_referencia'];
        $acc_numero = $data_nombre_accion['acc_numero'];

        $acc_nombre = $acc_referencia.'.'.$acc_numero;


        return $acc_nombre;
    }


    public function nombre_equipo($codigo_equipo){
        
        $sql_nombre_equipo = "SELECT equi_nombre
                              FROM inventario.equipo
                             WHERE equi_codigo = $codigo_equipo;";

        $resultado_nombre_equipo= $this->cnxion->ejecutar($sql_nombre_equipo);

        $data_nombre_equipo= $this->cnxion->obtener_filas($resultado_nombre_equipo);
        
        $equi_nombre = $data_nombre_equipo['equi_nombre'];

        
        if($equi_nombre == ""){
            $equi_nombre = 'NA';
        }
        else{
            $equi_nombre = $equi_nombre;
        }

        return $equi_nombre;
    }

    public function nombre_linea($codigo_linea){
        
        $sql_nombre_linea = "SELECT lin_nombre
                                FROM inventario.linea
                              WHERE lin_codigo = $codigo_linea;";

        $resultado_nombre_linea= $this->cnxion->ejecutar($sql_nombre_linea);

        $data_nombre_linea= $this->cnxion->obtener_filas($resultado_nombre_linea);
        
        $lin_nombre = $data_nombre_linea['lin_nombre'];

        

        if($lin_nombre == ""){
            $lin_nombre = 'NA';
        }
        else{
            $lin_nombre = $lin_nombre;
        }

        return $lin_nombre;
    }

    public function nombre_sublinea($codigo_sublinea){
        
        $sql_nombre_sublinea = "SELECT slin_nombre
                                    FROM inventario.sub_linea
                                    WHERE slin_codigo = $codigo_sublinea;";

        $resultado_nombre_sublinea= $this->cnxion->ejecutar($sql_nombre_sublinea);

        $data_nombre_sublinea= $this->cnxion->obtener_filas($resultado_nombre_sublinea);
        
        $slin_nombre = $data_nombre_sublinea['slin_nombre'];

        if($slin_nombre == ""){
            $slin_nombre = 'NA';
        }
        else{
            $slin_nombre = $slin_nombre;
        }

       
        return $slin_nombre;
    }


    public function nombre_descripcionEquipo($codigo_descripcion){
        
        $sql_nombre_descripcionEquipo = "SELECT deq_descripcion
                                            FROM inventario.descripcion_equipo
                                          WHERE deq_codigo = $codigo_descripcion;";

        $resultado_nombre_descripcionEquipo= $this->cnxion->ejecutar($sql_nombre_descripcionEquipo);

        $data_nombre_descripcionEquipo= $this->cnxion->obtener_filas($resultado_nombre_descripcionEquipo);
        
        $deq_descripcion= $data_nombre_descripcionEquipo['deq_descripcion'];


        if($deq_descripcion == ""){
            $deq_descripcion = 'NA';
        }
        else{
            $deq_descripcion = $deq_descripcion;
        }

        return $deq_descripcion;

        


    }






    public function list_plan_compras_pdi(){

        
        $sql_list_plan_compras_pdi = "SELECT pdi_codigo,pdi_sede, pdi_dependencia, pdi_area,
                                             pdi_accion,pdi_plantafisica,
                                             pdi_linea, pdi_sublinea,
                                             pdi_equipo, pdi_equipodescripcion,
                                             pdi_valorunitario, pdi_cantidad,pdi_estado,
                                             pdi_vicerrectoria, pdi_facultad
                                        FROM usco.formulariopdi;";

        $resultado_list_plan_compras_pdi = $this->cnxion->ejecutar($sql_list_plan_compras_pdi);

        while ($data_list_plan_compras_pdi = $this->cnxion->obtener_filas($resultado_list_plan_compras_pdi)){
            $datalist_plan_compras_pdi[] = $data_list_plan_compras_pdi;
        }
        return $datalist_plan_compras_pdi;
    }

    public function validar_botoneditar_plancompras($codigo_plancompras){
        $sql_validar_botoneditar_plancompras= "SELECT COUNT(*) AS boton
                                                FROM usco.plancompras_accion
                                                WHERE pca_plancompras =$codigo_plancompras
                                                AND pca_estado = 1;";

        $query_validar_botoneditar_plancompras=$this->cnxion->ejecutar($sql_validar_botoneditar_plancompras);

        $data_validar_botoneditar_plancompras=$this->cnxion->obtener_filas($query_validar_botoneditar_plancompras);

        $boton = $data_validar_botoneditar_plancompras['boton'];

        if($boton > 0){
            $display = "none";
        }
        else{
            $display = "block";
        }

        return $display;
    }



    public function datConsultarpdi(){
            
            $list_plan_compras_pdi= $this->list_plan_compras_pdi();
            
            if($list_plan_compras_pdi){
                foreach ($list_plan_compras_pdi as $dat_consultarpdi) {
                    $pdi_codigo = $dat_consultarpdi['pdi_codigo'];
                    $pdi_sede = $dat_consultarpdi['pdi_sede'];
                    $pdi_vicerretoria = $dat_consultarpdi['pdi_vicerrectoria'];
                    $pdi_facultad = $dat_consultarpdi['pdi_facultad'];
                    $pdi_dependencia = $dat_consultarpdi['pdi_dependencia'];
                    $pdi_area =$dat_consultarpdi['pdi_area'];
                    $pdi_accion = $dat_consultarpdi['pdi_accion'];
                    $pdi_plantafisica = $dat_consultarpdi['pdi_plantafisica'];
                    $pdi_linea = $dat_consultarpdi['pdi_linea'];
                    $pdi_sublinea = $dat_consultarpdi['pdi_sublinea'];
                    $pdi_equipo = $dat_consultarpdi['pdi_equipo'];
                    $pdi_equipodescripcion = $dat_consultarpdi['pdi_equipodescripcion'];
                    $pdi_cantidad = $dat_consultarpdi['pdi_cantidad'];
                    $pdi_valorunitario = $dat_consultarpdi['pdi_valorunitario'];
                    $pdi_estado = $dat_consultarpdi['pdi_estado'];
                    
                    $nombre_sede = $this->nombre_sede($pdi_sede);
                    $nombre_dependencia = $this->nombre_dependencia($pdi_dependencia);
                    $nombre_accion = $this->nombre_accion($pdi_accion);
                    $nombre_equipo = $this->nombre_equipo($pdi_equipo);
                    $nombre_facultad = $this->nombre_facultad($pdi_facultad);
                    $nombre_area = $this->nombre_area($pdi_area);
                    $nombre_linea = $this->nombre_linea($pdi_linea);
                    $nombre_sublinea = $this->nombre_sublinea($pdi_sublinea);
                    $nombre_descripcionEquipo = $this->nombre_descripcionEquipo($pdi_equipodescripcion);
                    $nombre_vicerrectoria = $this->nombre_vicerrectoria($pdi_vicerretoria);
                    $boton= $this->validar_botoneditar_plancompras($pdi_codigo);

                    if($pdi_estado == 1){
                        $estado = "Activo";
                    }
                    else{
                        $estado = "Inactivo";
                    }
                

        
                    $rsConsultarpdi[] = array('pdi_codigo'=> $pdi_codigo,
                                                'sed_nombre'=> $nombre_sede, 
                                                'ent_nombre'=> $nombre_vicerrectoria,
                                                'fac_nombre' => $nombre_facultad,
                                                'ofi_nombre'=> $nombre_dependencia,
                                                'are_nombre' => $nombre_area,
                                                'acc_nombre'=> $nombre_accion,
                                                'pdi_plantafisica' => $pdi_plantafisica,
                                                'lin_nombre'=>$nombre_linea,
                                                'slin_nombre'=>$nombre_sublinea,
                                                'equi_nombre'=> $nombre_equipo,
                                                'deq_descripcion'=> $nombre_descripcionEquipo,
                                                'pdi_valorunitario'=> $pdi_valorunitario,
                                                'pdi_cantidad'=> $pdi_cantidad,
                                                'estado'=> $estado,
                                                'boton'=> $boton,
                                            );
        
                }
                $dattConsultarpdi=json_encode(array("data"=>$rsConsultarpdi));
            }
            else{
                $dattConsultarpdi=json_encode(array("data"=>""));
            } 
                
            return $dattConsultarpdi;
        }

}
?>