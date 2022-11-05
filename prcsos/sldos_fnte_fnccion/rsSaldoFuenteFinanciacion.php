<?php
include('classSaldoFuenteFinanciacion.php');
Class RsSaldoFuentesFinanciacion extends SaldoFuenteFinanciacion{
   
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
    } 

    public function anio_inicio_plan($codigo_plan){

        $sql_anio_inicio_plan="SELECT pde_codigo, pde_nombre, 
                                      pde_yearinicio, pde_yearfin
                                 FROM plandesarrollo.plan_desarrollo
                                WHERE pde_codigo = $codigo_plan;";

        $query_anio_inicio_plan=$this->cnxion->ejecutar($sql_anio_inicio_plan);

        $data_anio_inicio_plan=$this->cnxion->obtener_filas($query_anio_inicio_plan);

        $pde_yearinicio = $data_anio_inicio_plan['pde_yearinicio'];

        return $pde_yearinicio;
    }
    
    public function list_fuente_financiacion(){

        $sql_list_fuente_financiacion="SELECT ffi_codigo, ffi_nombre,  
                                              ffi_clasificacion, ffi_codigolinix, 
                                              ffi_referencialinix, 
                                              ffi_clasificacionplaneacion
                                         FROM planaccion.fuente_financiacion
                                        WHERE ffi_estado = 1
                                          AND ffi_clasificacion = 3
                                        ORDER BY ffi_nombre ASC";

        $query_list_fuente_financiacion=$this->cnxion->ejecutar($sql_list_fuente_financiacion);

        while($data_list_fuente_financiacion=$this->cnxion->obtener_filas($query_list_fuente_financiacion)){
            $datalist_fuente_financiacion[]=$data_list_fuente_financiacion;
        }
        return $datalist_fuente_financiacion;
    }

    public function nombre_acto($codigo_acto){

        $sql_nombre_acto="SELECT aad_codigo, add_nombre, add_vigencia
                            FROM plandesarrollo.acto_administrativo
                           WHERE aad_codigo = $codigo_acto;";

        $query_nombre_acto=$this->cnxion->ejecutar($sql_nombre_acto);

        $data_nombre_acto=$this->cnxion->obtener_filas($query_nombre_acto);

        $add_nombre = $data_nombre_acto['add_nombre'];

        return $add_nombre;
    }

    public function list_saldos_fuente(){

        $sql_list_saldos_fuente = "SELECT sff_codigo, sff_vigencia, sff_fuente, 
                                          sff_saldo, sff_estado, ffi_nombre,
                                          sff_acto
                                     FROM planaccion.saldos_fuente_financiacion, 
                                          planaccion.fuente_financiacion
                                    WHERE sff_fuente = ffi_codigo;";

        $resultado_list_saldos_fuente = $this->cnxion->ejecutar($sql_list_saldos_fuente);

        while ($data_list_saldos_fuente = $this->cnxion->obtener_filas($resultado_list_saldos_fuente)){
            $datalist_saldos_fuente[] = $data_list_saldos_fuente;
        }
        return $datalist_saldos_fuente;
    }

    public function datListSaldosFuente(){
        
        $rs_saldosfuente = $this->list_saldos_fuente();

        if($rs_saldosfuente){
            foreach ($rs_saldosfuente as $dta_saldos_fuente) {
                $sff_codigo = $dta_saldos_fuente['sff_codigo'];
                $sff_vigencia = $dta_saldos_fuente['sff_vigencia'];
                $sff_fuente = $dta_saldos_fuente['sff_fuente'];
                $sff_saldo = $dta_saldos_fuente['sff_saldo'];
                $sff_estado = $dta_saldos_fuente['sff_estado'];
                $ffi_nombre = $dta_saldos_fuente['ffi_nombre'];
                $sff_acto = $dta_saldos_fuente['sff_acto'];

                $nombre_acto = $this->nombre_acto($sff_acto);

                if($sff_estado == 1){
                    $estado = "Activo";
                }

                if($sff_estado == 0){
                    $estado = "Inactivo";
                }
    
                $rsSaldoFuente[] = array('sff_codigo'=> $sff_codigo, 
                                         'sff_vigencia'=> $sff_vigencia,
                                         'estado'=> $estado,
                                         'sff_saldo'=> "$ ".number_format($sff_saldo,0,'','.'),
                                         'nombre_fuente'=> $ffi_nombre,
                                         'nombre_acto'=> $nombre_acto
                                    );
    
            }
            $datSaldosFuente=json_encode(array("data"=>$rsSaldoFuente));
        }
        else{
            $datSaldosFuente=json_encode(array("data"=>""));
        } 
        return $datSaldosFuente;
    }

    public function form_saldo_fuentes($codigo_saldo_fuente){

        $sql_form_saldo_fuentes="SELECT sff_codigo, sff_vigencia, 
                                        sff_fuente, sff_saldo, 
                                        sff_estado, sff_acto
                                   FROM planaccion.saldos_fuente_financiacion
                                  WHERE sff_codigo = $codigo_saldo_fuente;";

        $query_form_saldo_fuentes=$this->cnxion->ejecutar($sql_form_saldo_fuentes);

        while($data_form_saldo_fuentes=$this->cnxion->obtener_filas($query_form_saldo_fuentes)){
            $dataform_saldo_fuentes[]=$data_form_saldo_fuentes;
        }
        return $dataform_saldo_fuentes;
    }

    public function list_acuerdo(){

        $sql_list_acuerdo="SELECT aad_codigo, add_nombre, add_tipoactoadmin, 
                                  add_urlactoadmin, add_vigencia
                             FROM plandesarrollo.acto_administrativo
                            WHERE add_tipoactoadmin in(1,2)
                            ORDER BY add_vigencia, add_nombre ASC;";

        $query_list_acuerdo=$this->cnxion->ejecutar($sql_list_acuerdo);

        while($data_list_acuerdo=$this->cnxion->obtener_filas($query_list_acuerdo)){
            $datalist_acuerdo[]=$data_list_acuerdo;
        }
        return $datalist_acuerdo;
    }
}
?>