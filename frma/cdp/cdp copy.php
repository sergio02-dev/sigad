<?php
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú","ñ");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú","Ñ");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    include('crud/rs/cdp/cdp.php');

    $codigo_cdp = $_REQUEST['codigo_cdp'];

    if($codigo_cdp){
        $url_guardar="modificarcdp";
        $task = "MODIFICAR EXPEDICI&Oacute;N CDP";
        $form_cdp = $objCdp->form_cdp($codigo_cdp);
        $descrpcion = "modificar";
        foreach ($form_cdp as $dat_frma_cdp) {
            $cdp_codigo = $dat_frma_cdp['cdp_codigo']; 
            $cdp_solicitud = $dat_frma_cdp['cdp_solicitud']; 
            $cdp_fecha = $dat_frma_cdp['cdp_fecha'];
            $cdp_numeroexpedicion = $dat_frma_cdp['cdp_numeroexpedicion'];
        }

        $fecha_expedicion = $cdp_fecha;
    }
    else{
        $url_guardar="registrocdp";
        $task = "EXPEDIR CDP";
        $fecha_expedicion = date('Y-m-d');
        $descrpcion = "expedir";
    }

    $codigo_solicitud = $_REQUEST['codigo_solicitud'];

   

    $datos_solicitud = $objCdp->datos_solicitud($codigo_solicitud);

    foreach($datos_solicitud as $dta_slctud){
        $scdp_codigo = $dta_slctud['scdp_codigo'];
        $scdp_fecha = $dta_slctud['scdp_fecha'];
        $scdp_numero = $dta_slctud['scdp_numero'];
        $scdp_accion = $dta_slctud['scdp_accion'];
    }

    $codigo_plan_accion = $objCdp->codigo_plan_accion($scdp_accion);
    $nombre_nivel_tres = $objCdp->nombre_nivel_tres($codigo_plan_accion);
    $descripcion_accion = $objCdp->descripcion_accion($scdp_accion);
    
?>
<style>
    .alert.alert-danger.alerta-forcliente{
        display: none;
        padding: 0;
        color: red ;
        font-weight: bold;
    }
</style>
<form id="cdpform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?></strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-sm-12" id="carga_guardar"  style="display:none">
                <img src="img/carga_form.gif" width="150px" height="150px"/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-5">
                <div class="form-group">
                    <label for="txtFechaExpedicion" class="font-weight-bold">Fecha de Expedici&oacute;n *</label>
                    <input type="date" class="form-control caja_texto_sizer" id="txtFechaExpedicion" name="txtFechaExpedicion" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $fecha_expedicion; ?>" required>
                    <div class="alert alert-danger alerta-forcliente" id="error_fecha_expedicion" role="alert"></div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="form-group">
                    <label for="txtNumeroExpedicion" class="font-weight-bold">N&uacute;mero CDP*</label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtNumeroExpedicion" name="txtNumeroExpedicion" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $cdp_numeroexpedicion; ?>" required>
                    <div class="alert alert-danger alerta-forcliente" id="error_numero_expedicion" role="alert"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th colspan="3" style="text-align: center;">DATOS SOLICITUD CDP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"><strong>No.</strong> <?php echo $scdp_numero; ?></td>
                            <td><strong>Fecha</strong> <?php echo $scdp_fecha; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><?php echo "<strong>".strtoupper(tildes($nombre_nivel_tres))."</strong>. ".$descripcion_accion; ?></td>
                        </tr>
                        <?php
                            $actividades_solicitud = $objCdp->actividades_solicitud($codigo_solicitud);
                            if($actividades_solicitud){
                                foreach ($actividades_solicitud as $dat_actividades_solicitud) {
                                    $aes_actividad = $dat_actividades_solicitud['aes_actividad'];
                                    $acp_referencia = $dat_actividades_solicitud['acp_referencia'];
                                    $acp_numero = $dat_actividades_solicitud['acp_numero'];
                                    $acp_descripcion = $dat_actividades_solicitud['acp_descripcion'];
                        ?>
                        <tr>
                            <td colspan="3"><strong>ACTIVIDAD: <?php echo $acp_referencia.".".$acp_numero; ?></strong> <?php echo $acp_descripcion; ?></td>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align: center;">ETAPAS</th>
                        </tr>
                        <?php
                                    $etapa_actividad_solicitud = $objCdp->etapa_actividad_solicitud($codigo_solicitud, $aes_actividad);
                                    if($etapa_actividad_solicitud){
                                        foreach ($etapa_actividad_solicitud as $dta_etpas) {
                                            $aes_codigo = $dta_etpas['aes_codigo'];
                                            $aes_etapa = $dta_etpas['aes_etapa'];
                                            $aes_valoretapa = $dta_etpas['aes_valoretapa']; 
                                            $aes_otrovalor = $dta_etpas['aes_etapa'];
                                            $poa_referencia = $dta_etpas['poa_referencia'];
                                            $poa_numero = $dta_etpas['poa_numero']; 
                                            $poa_objeto = $dta_etpas['poa_objeto'];

                                           $descripcion_etapa = $poa_referencia.".".$poa_numero." ".$poa_objeto;
                        ?>
                        <tr>
                            <td colspan="2"><?php echo $descripcion_etapa; ?></td>
                            <td><?php echo "$".number_format($aes_valoretapa,0,'','.'); ?></td>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align: center;">FUENTES DE FINANCIACI&Oacute;N</th>
                        </tr>
                        <?php
                                            $clasificadores_solicitud = $objCdp->clasificadores_solicitud($codigo_solicitud, $aes_etapa);

                                            $recursos_designados = $objCdp->recursos_designados($codigo_solicitud, $aes_etapa);
                                            $cantidad_recursos = count($recursos_designados);
                                            $num = 1;
                                            foreach ($recursos_designados as $dta_rcrsos) {
                                                $aso_codigo = $dta_rcrsos['aso_codigo']; 
                                                $aso_otrovalor  = $dta_rcrsos['aso_otrovalor'];
                                                $aso_valor = $dta_rcrsos['aso_valor'];
                                                $asre_vigenciarecurso = $dta_rcrsos['asre_vigenciarecurso'];
                                                $ffi_nombre = $dta_rcrsos['ffi_nombre'];
                                                

                                                $descrpcion_recurso = $asre_vigenciarecurso." ".str_replace('INV -','', $ffi_nombre);
                        ?>
                        <tr>
                            <td><?php echo $descrpcion_recurso; ?></td>
                            <td><?php echo "$".number_format($aso_valor,0,'','.'); ?></td>
                            <?php
                                if($num == 1){
                            ?>
                            <td rowspan="<?php echo $cantidad_recursos; ?>">
                                <strong>Clasificadores: </strong><br>
                                <?php echo $clasificadores_solicitud; ?>
                            </td>
                            <?php
                                }
                            ?>
                        </tr>
                        <?php
                                                $num++;
                                            }

                                        }
                                    }
                                    
                                }
                            }
                        ?>  
                        
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 validacion">&nbsp;</div>
        </div>

        <div class="row">
            <div class="col-md-1 validacion" style="display: none;">
                <i class="fas fa-exclamation-triangle" style="font-size: 35px; color: #E5770A;"></i> 
            </div>
            <div class="col-md-11 validacion" style="display: none;">
                <p id="texto_validacion"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-12 validacion" style="display: none;">
                <button type="button" class="btn btn-primary" id="aceptar">Aceptar</button>
                <button type="button" class="btn btn-danger" id="cancelar">Cancelar</button>
            </div>
        </div>

        

        
        
        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="descrpcion" id="descrpcion" value="<?php echo $descrpcion; ?>">
        <input type="hidden" name="codigo_cdp" id="codigo_cdp" value="<?php echo $codigo_cdp; ?>">
        <input type="hidden" name="codigo_solicitud" id="codigo_solicitud" value="<?php echo $codigo_solicitud; ?>">
        <input type="hidden" name="url_proceso" id="url_proceso" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="validar_expedicion();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_cdp.js"></script>
