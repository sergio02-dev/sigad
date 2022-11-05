<?php
include('classSolicitudCdp.php');
class RgstroSolicitudCdp extends SolicitudCdp{

    private $insert_solicitud_cdp;
    private $codigoSolicitud;

    
    public function __construct(){
        $this->cnxion = Dtbs::getInstance();
        $this->codigoSolicitud = date('YmdHis').rand(99,99999);
    }

    public function data_etapa($codigo_etapa){

        $sql_data_etapa="SELECT poa_codigo, acp_codigo,  
                                poa_recurso
                           FROM planaccion.poai
                          WHERE poa_codigo = $codigo_etapa;";

        $query_data_etapa=$this->cnxion->ejecutar($sql_data_etapa);

        while($data_data_etapa=$this->cnxion->obtener_filas($query_data_etapa)){
            $datadata_etapa[]=$data_data_etapa;
        }
        return $datadata_etapa;
    }

    public function actividad_sede_accion($codigo_etapas){

        $sql_actividad_sede_accion="SELECT DISTINCT planaccion.poai.acp_codigo AS actividad, 
                                           acp_sede AS sede, acp_accion AS accion
                                      FROM planaccion.poai, planaccion.actividad_poai
                                     WHERE planaccion.poai.acp_codigo = planaccion.actividad_poai.acp_codigo
                                       AND poa_codigo IN($codigo_etapas);";

        $query_actividad_sede_accion=$this->cnxion->ejecutar($sql_actividad_sede_accion);

        while($data_actividad_sede_accion=$this->cnxion->obtener_filas($query_actividad_sede_accion)){
            $dataactividad_sede_accion[]=$data_actividad_sede_accion;
        }
        return $dataactividad_sede_accion;
    }

    public function indicador_actividad($codigo_actividad){

        $sql_indicador_actividad="SELECT acp_codigo, acp_descripcion,  
                                         acp_sedeindicador
                                    FROM planaccion.actividad_poai
                                   WHERE acp_codigo = $codigo_actividad;";

        $query_indicador_actividad=$this->cnxion->ejecutar($sql_indicador_actividad);

        $data_indicador_actividad=$this->cnxion->obtener_filas($query_indicador_actividad);

        $acp_sedeindicador = $data_indicador_actividad['acp_sedeindicador'];

        return $acp_sedeindicador;
    }

    public function valores_solicitado($codigo_accion, $codigo_fuente, $codigo_sede){

        $sql_valores_solicitado="SELECT SUM((SELECT SUM(aes_valoretapa)
                                               FROM cdp.actividad_etapa_solicitud, 
                                                    planaccion.actividad_poai
                                              WHERE aes_actividad = acp_codigo
                                                AND acp_accion = $codigo_accion
                                                AND acp_sede = $codigo_sede
                                                AND aes_solicitud = scdp_codigo)) AS valor_solicitud
                                    FROM cdp.solicitud_cdp
                                   WHERE scdp_accion = $codigo_accion
                                     AND scdp_fuentefinanciacion = $codigo_fuente";

        $query_valores_solicitado=$this->cnxion->ejecutar($sql_valores_solicitado);

        $data_valores_solicitado=$this->cnxion->obtener_filas($query_valores_solicitado);

        $valor_solicitud = $data_valores_solicitado['valor_solicitud'];

        if($valor_solicitud){
            $vlor_slctdo = $valor_solicitud;
        }
        else{
            $vlor_slctdo = 0;
        }
        return $vlor_slctdo;
    }

    public function adiciones($codigo_poai){

        $sql_adiciones="SELECT SUM(apoai_valor) AS valor_adicional
                        FROM planaccion.adicion_poai
                      WHERE apoai_poai = $codigo_poai;";

        $query_adiciones=$this->cnxion->ejecutar($sql_adiciones);

        $data_adiciones=$this->cnxion->obtener_filas($query_adiciones);

        $valor_adicional = $data_adiciones['valor_adicional'];

        if($valor_adicional){
            $recursos_adi_poai = $valor_adicional;
        }
        else{
            $recursos_adi_poai = 0;
        }
        return $recursos_adi_poai;
    }

    public function valor_poai($codigo_accion, $codigo_fuente, $codigo_sede){

        $sql_valor_poai="SELECT poav_recurso, poav_codigo
                           FROM planaccion.poai_veinte_veintidos
                          WHERE poav_estado = 1
                            AND poav_accion = $codigo_accion
                            AND poav_fuentefinanciacion = $codigo_fuente
                            AND poav_sede = $codigo_sede;";

        $query_valor_poai=$this->cnxion->ejecutar($sql_valor_poai);

        $data_valor_poai=$this->cnxion->obtener_filas($query_valor_poai);

        $poav_recurso = $data_valor_poai['poav_recurso'];

        $poav_codigo = $data_valor_poai['poav_codigo'];

        if($poav_recurso){
            $adiciones = $this->adiciones($poav_codigo);
            $recursos_poai = $poav_recurso + $adiciones;
        }
        else{
            $recursos_poai = 0;
        }
        return $recursos_poai;
    }

    public function codigo_proyecto($codigoccion){

        $sql_codigo_proyecto="SELECT acc_codigo, acc_referencia, acc_proyecto
                                FROM plandesarrollo.accion
                               WHERE acc_codigo = $codigoccion;";

        $query_codigo_proyecto=$this->cnxion->ejecutar($sql_codigo_proyecto);

        $data_codigo_proyecto=$this->cnxion->obtener_filas($query_codigo_proyecto);

        $acc_proyecto=$data_codigo_proyecto['acc_proyecto'];

        return $acc_proyecto;
    }

    public function codigo_subsistema($codigo_proyecto){

        $sql_codigo_subsistema="SELECT pro_codigo, pro_descripcion, sub_codigo
                                  FROM plandesarrollo.proyecto
                                 WHERE pro_codigo = $codigo_proyecto;";

        $query_codigo_subsistema=$this->cnxion->ejecutar($sql_codigo_subsistema);

        $data_codigo_subsistema=$this->cnxion->obtener_filas($query_codigo_subsistema);

        $sub_codigo = $data_codigo_subsistema['sub_codigo'];

        return $sub_codigo;
    }

    
    public function ofi_cargo($codigo_nivel, $nivel){

        $sql_ofi_cargo="SELECT vin_codigo, vin_persona, vin_oficina, vin_cargo, vin_estado, res_codigonivel, res_nivel
                            FROM usco.vinculacion, usco.responsable
                            WHERE res_codigocargo = vin_cargo
                            AND res_codigooficina = vin_oficina
                            AND vin_estado = 1
                            AND res_estado = 1
                            AND res_nivel = $nivel
                            AND vin_persona = ".$this->getPersonaSistema()."
                            AND res_codigonivel = $codigo_nivel;";

        $query_ofi_cargo=$this->cnxion->ejecutar($sql_ofi_cargo);

        $data_ofi_cargo=$this->cnxion->obtener_filas($query_ofi_cargo);

        $vin_oficina = $data_ofi_cargo['vin_oficina'];

        $vin_cargo = $data_ofi_cargo['vin_cargo'];

        return array($vin_oficina, $vin_cargo);
    }

    public function gastos_poai($codigo_poai){

        $sql_gastos_poai="SELECT SUM(fsc_valor) AS suma_gastos_cdp
                            FROM cdp.fuentes_solicitud_cdp
                           WHERE fsc_poai = $codigo_poai;";

        $query_gastos_poai=$this->cnxion->ejecutar($sql_gastos_poai);

        $data_gastos_poai=$this->cnxion->obtener_filas($query_gastos_poai);

        $suma_gastos_cdp = $data_gastos_poai['suma_gastos_cdp'];

        if($suma_gastos_cdp==''){
            $suma_gastos_cdp = 0;
        }
        else{
            $suma_gastos_cdp = $suma_gastos_cdp;
        }

        return $suma_gastos_cdp;
    }

    public function adiciones_poai($codigo_poai){

        $sql_adiciones_poai = "SELECT SUM(apoai_valor) AS valor_adicional
                                 FROM planaccion.adicion_poai
                                WHERE apoai_estado = 1
                                  AND apoai_poai = $codigo_poai;";

        $query_adiciones_poai = $this->cnxion->ejecutar($sql_adiciones_poai);

        $data_adiciones_poai=$this->cnxion->obtener_filas($query_adiciones_poai);

        $valor_adicional = $data_adiciones_poai['valor_adicional'];

        if($valor_adicional == ''){
            $valor_adicional = 0;
        }
        else{
            $valor_adicional = $valor_adicional;
        }

        return $valor_adicional;
    }

    public function validacion_saldo_poai($codigo_poai){

        $sql_validacion_saldo_poai="SELECT poav_recurso
                                      FROM planaccion.poai_veinte_veintidos
                                     WHERE poav_estado = 1
                                       AND poav_codigo = $codigo_poai;";

        $query_validacion_saldo_poai=$this->cnxion->ejecutar($sql_validacion_saldo_poai);

        $data_validacion_saldo_poai=$this->cnxion->obtener_filas($query_validacion_saldo_poai);

        $poav_recurso = $data_validacion_saldo_poai['poav_recurso'];

        $adiciones_poai = $this->adiciones_poai($codigo_poai);

        $saldo_poai = $poav_recurso + $adiciones_poai;

        $gastos_poai = $this->gastos_poai($codigo_poai);

        $valor_disponible = $saldo_poai - $gastos_poai;

        return $valor_disponible;
    }


    public function duenio_nivel($codigo_nivel, $nivel){

        $sql_duenio_nivel="SELECT vin_codigo, vin_persona, vin_oficina, vin_cargo, vin_estado, res_codigonivel, res_nivel
                            FROM usco.vinculacion, usco.responsable
                            WHERE res_codigocargo = vin_cargo
                            AND res_codigooficina = vin_oficina
                            AND vin_estado = 1
                            AND res_estado = 1
                            AND res_nivel = $nivel
                            AND vin_persona = ".$this->getPersonaSistema()."
                            AND res_codigonivel = $codigo_nivel;";

        $query_duenio_nivel=$this->cnxion->ejecutar($sql_duenio_nivel);

        $data_duenio_nivel=$this->cnxion->obtener_filas($query_duenio_nivel);

        $cantidad = $this->cnxion->numero_filas($query_duenio_nivel);

        return $cantidad;
    }

    public function codigo_fuente_poai($codigo_poai){

        $sql_codigo_fuente_poai="SELECT poav_codigo, poav_accion, poav_fuentefinanciacion
                                   FROM planaccion.poai_veinte_veintidos
                                  WHERE poav_codigo = $codigo_poai;";

        $query_codigo_fuente_poai=$this->cnxion->ejecutar($sql_codigo_fuente_poai);

        $data_codigo_fuente_poai=$this->cnxion->obtener_filas($query_codigo_fuente_poai);

        $poav_fuentefinanciacion = $data_codigo_fuente_poai['poav_fuentefinanciacion'];

        return $poav_fuentefinanciacion;
    }

    public function oficina_cargo(){

        $codigo_proyecto = $this->codigo_proyecto($this->getAccion());
  
        $codigo_subssistema = $this->codigo_subsistema($codigo_proyecto);
  
        $level_uno = $this->duenio_nivel($codigo_subssistema, 1);
  
        if($level_uno>0){
            list($oficina_guardar, $cargo_guardar) = $this->ofi_cargo($codigo_subssistema, 1);
        }
        else{
            $level_dos = $this->duenio_nivel($codigo_proyecto, 2);
            if($level_dos>0){
                list($oficina_guardar, $cargo_guardar) = $this->ofi_cargo($codigo_proyecto, 2);
            }
            else{
                list($oficina_guardar, $cargo_guardar) = $this->ofi_cargo($this->getAccion(), 3);
            }
        }
        return array($oficina_guardar, $cargo_guardar);
    }

    public function insertSolicitud(){

        list($ofis, $cargs) = $this->oficina_cargo();

        if($ofis && $cargs){
            $ofis = $ofis;
            $cargs = $cargs;
        }
        else{
            $ofis = 0;
            $cargs = 0;
        }

        $insert_solicitud_cdp="INSERT INTO cdp.solicitud_cdp(
                                           scdp_codigo, 
                                           scdp_fecha, 
                                           scdp_numero, 
                                           scdp_accion, 
                                           scdp_oficina, 
                                           scdp_cargo, 
                                           scdp_estado, 
                                           scdp_proceso, 
                                           scdp_personacreo, 
                                           scdp_personamodifico, 
                                           scdp_fechacreo, 
                                           scdp_fechamodifico)
                                   VALUES (".$this->codigoSolicitud.", 
                                           '".$this->getFecha()."', 
                                           ".$this->getCodigoSolicitud().", 
                                           ".$this->getAccion().", 
                                           $ofis, 
                                           $cargs, 
                                           ".$this->getEstado().", 
                                           1, 
                                           ".$this->getPersonaSistema().", 
                                           ".$this->getPersonaSistema().", 
                                           NOW(), 
                                           NOW());";
                                        
        //echo "ejemplo ".$insert_solicitud_cdp;
        $this->cnxion->ejecutar($insert_solicitud_cdp);

        $datos_etapa = $this->getArrayDatos();

        if($datos_etapa){
            foreach ($datos_etapa as $dta_etapas) {
                $codigo_etapa = $dta_etapas['codigo_etapa'];
                $codigo_actividad = $dta_etapas['codigo_actividad'];
                $recurso = $dta_etapas['recurso'];
                $other_value = $dta_etapas['other_value'];
                $codigo_clasificador = $dta_etapas['codigo_clasificador'];
                $asignaciones_solicitud = $dta_etapas['asignaciones_solicitud'];

                $codigo_etapa_solicitud = date('YmdHis').rand(99,99999);

                $insert_etpas = "INSERT INTO cdp.actividad_etapa_solicitud(
                                             aes_codigo, 
                                             aes_solicitud, 
                                             aes_actividad, 
                                             aes_etapa, 
                                             aes_valoretapa, 
                                             aes_personacreo, 
                                             aes_personamodifico, 
                                             aes_fechacreo, 
                                             aes_fechamodifico,
                                             aes_otrovalor)
                                     VALUES ($codigo_etapa_solicitud, 
                                             ".$this->codigoSolicitud.", 
                                             $codigo_actividad, 
                                             $codigo_etapa, 
                                             $recurso, 
                                             ".$this->getPersonaSistema().", 
                                             ".$this->getPersonaSistema().", 
                                             NOW(), 
                                             NOW(),
                                             $other_value);";

                $this->cnxion->ejecutar($insert_etpas);

                //Clasificadores etapas
                for ($clasfcadorEtpa=0; $clasfcadorEtpa < count($codigo_clasificador) ; $clasfcadorEtpa++) { 
                    
                    $cdg[$clasfcadorEtpa] = date('YmdHis').rand(99,99999);

                    $sql_insrt_clsfcdor[$clasfcadorEtpa] = "INSERT INTO cdp.etapa_solicitud_clasificador(
                                                                        esc_codigo, 
                                                                        esc_solicitud, 
                                                                        esc_etapa, 
                                                                        esc_solitudetapa, 
                                                                        esc_clasificador, 
                                                                        esc_personacreo, 
                                                                        esc_personamodifico, 
                                                                        esc_fechacreo, 
                                                                        esc_fechamodifico)
                                                                VALUES ($cdg[$clasfcadorEtpa], 
                                                                        ".$this->codigoSolicitud.", 
                                                                        $codigo_etapa, 
                                                                        $codigo_etapa_solicitud, 
                                                                        '".strtoupper($codigo_clasificador[$clasfcadorEtpa])."', 
                                                                        ".$this->getPersonaSistema().", 
                                                                        ".$this->getPersonaSistema().", 
                                                                        NOW(), 
                                                                        NOW());";
                                                                        
                    $this->cnxion->ejecutar($sql_insrt_clsfcdor[$clasfcadorEtpa]);
                }

                //fuentes recrsos 

                foreach ($asignaciones_solicitud as $dta_asignacion) {
                    $codigo_etapa = $dta_asignacion['codigo_etapa'];
                    $codigo_asignacion = $dta_asignacion['codigo_asignacion'];
                    $verificar_cambio = $dta_asignacion['verificar_cambio'];
                    $valor_cambio = $dta_asignacion['valor_cambio'];

                    $cdg_asign = date('YmdHis').rand(99,99999);

                    $sql_fuentes_solicitud = "INSERT INTO cdp.asignacion_solicitud(
                                                          aso_codigo, 
                                                          aso_solicitud, 
                                                          aso_etapa, 
                                                          aso_asignacion, 
                                                          aso_otrovalor, 
                                                          aso_valor, 
                                                          aso_fechacreo, 
                                                          aso_fechamodifico, 
                                                          aso_personacreo, 
                                                          aso_personamodifico)
                                                  VALUES ($cdg_asign, 
                                                          ".$this->codigoSolicitud.", 
                                                          $codigo_etapa, 
                                                          $codigo_asignacion, 
                                                          $verificar_cambio, 
                                                          $valor_cambio, 
                                                          NOW(), 
                                                          NOW(), 
                                                          ".$this->getPersonaSistema().", 
                                                          ".$this->getPersonaSistema().");";

                    $this->cnxion->ejecutar($sql_fuentes_solicitud);
                }
            }
        }
        
        return $insert_solicitud_cdp;
    }
}
?>