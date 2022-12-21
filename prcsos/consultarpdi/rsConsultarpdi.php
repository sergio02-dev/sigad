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

        return $sed_nombre;
    }

    public function nombre_dependencia($codigo_dependencia){
        
        $sql_nombre_dependencia = "SELECT ofi_nombre
                              FROM usco.oficina
                             WHERE ofi_codigo = $codigo_dependencia;";

        $resultado_nombre_dependencia= $this->cnxion->ejecutar($sql_nombre_dependencia);

        $data_nombre_dependencia= $this->cnxion->obtener_filas($resultado_nombre_dependencia);
        
        $ofi_nombre = $data_nombre_dependencia['ofi_nombre'];

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

        return $equi_nombre;
    }

    public function nombre_descripcionEquipo($codigo_descripcion){
        
        $sql_nombre_descripcionEquipo = "SELECT deq_descripcion
                                            FROM inventario.descripcion_equipo
                                          WHERE deq_codigo = $codigo_descripcion;";

        $resultado_nombre_descripcionEquipo= $this->cnxion->ejecutar($sql_nombre_descripcionEquipo);

        $data_nombre_descripcionEquipo= $this->cnxion->obtener_filas($resultado_nombre_descripcionEquipo);
        
        $deq_descripcion= $data_nombre_descripcionEquipo['deq_descripcion'];

        return $deq_descripcion;
    }






    public function list_plan_compras_pdi(){

        
        $sql_list_plan_compras_pdi = "SELECT pdi_sede, pdi_dependencia, 
                                             pdi_accion,pdi_equipo, pdi_equipodescripcion, 
                                             pdi_valorunitario, pdi_cantidad,pdi_estado
                                        FROM usco.formulariopdi";

        $resultado_list_plan_compras_pdi = $this->cnxion->ejecutar($sql_list_plan_compras_pdi);

        while ($data_list_plan_compras_pdi = $this->cnxion->obtener_filas($resultado_list_plan_compras_pdi)){
            $datalist_plan_compras_pdi[] = $data_list_plan_compras_pdi;
        }
        return $datalist_plan_compras_pdi;
    }




    public function datConsultarpdi(){
            
            $list_plan_compras_pdi= $this->list_plan_compras_pdi();
            
            if($list_plan_compras_pdi){
                foreach ($list_plan_compras_pdi as $dat_consultarpdi) {
                    $pdi_sede = $dat_consultarpdi['pdi_sede'];
                    $pdi_dependencia = $dat_consultarpdi['pdi_dependencia'];
                    $pdi_accion = $dat_consultarpdi['pdi_accion'];
                    $pdi_equipo = $dat_consultarpdi['pdi_equipo'];
                    $pdi_equipodescripcion = $dat_consultarpdi['pdi_equipodescripcion'];
                    $pdi_cantidad = $dat_consultarpdi['pdi_cantidad'];
                    $pdi_valorunitario = $dat_consultarpdi['pdi_valorunitario'];
                    $pdi_estado = $dat_consultarpdi['pdi_estado'];
                    
                    $nombre_sede = $this->nombre_sede($pdi_sede);
                    $nombre_dependencia = $this->nombre_dependencia($pdi_dependencia);
                    $nombre_accion = $this->nombre_accion($pdi_accion);
                    $nombre_equipo = $this->nombre_equipo($pdi_equipo);
                    $nombre_descripcionEquipo = $this->nombre_descripcionEquipo($pdi_equipodescripcion);

                    if($pdi_estado == 1){
                        $estado = "Activo";
                    }
                    else{
                        $estado = "Inactivo";
                    }
                

        
                    $rsConsultarpdi[] = array('sed_nombre'=> $nombre_sede, 
                                                'ofi_nombre'=> $nombre_dependencia,
                                                'acc_nombre'=> $nombre_accion,
                                                'equi_nombre'=> $nombre_equipo,
                                                'deq_descripcion'=> $nombre_descripcionEquipo,
                                                'pdi_valorunitario'=> $pdi_valorunitario,
                                                'pdi_cantidad'=> $pdi_cantidad,
                                                'estado'=> $estado,
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