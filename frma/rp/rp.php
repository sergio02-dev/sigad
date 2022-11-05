<?php
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú","ñ");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú","Ñ");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    include('crud/rs/rp/rp.php');

    $codigo_rp = $_REQUEST['codigo_rp'];
    $codigo_cdp = $_REQUEST['codigo_cdp'];

    if($codigo_rp){
        $form_rp = $objRp->form_rp($codigo_rp);
        foreach($form_rp as $dta_frma_rp){
            $rp_codigo = $dta_frma_rp['rp_codigo'];
            $rp_cdp = $dta_frma_rp['rp_cdp'];
            $rp_fecha = $dta_frma_rp['rp_fecha'];
            $rp_numerorp = $dta_frma_rp['rp_numerorp']; 
            $rp_otrovalor = $dta_frma_rp['rp_otrovalor']; 
            $rp_valor = $dta_frma_rp['rp_valor'];
            $rp_proveedor = $dta_frma_rp['rp_proveedor'];
            $rp_actoadmin = $dta_frma_rp['rp_actoadmin'];
            $rp_servicio = $dta_frma_rp['rp_servicio'];
        }
    
        $valor_total_cdp = $objRp->valor_total_cdp($codigo_cdp);

        if($rp_otrovalor == 1){
            $otro_valor = "block";
            $check_valor = "checked";
            $valor_cambiar_cdp = $rp_valor;
        }
        else{
            $otro_valor = "none";
            $check_valor = "";
            $valor_cambiar_cdp = $valor_total_cdp;
        }

        $url_guardar = "modificarrp";
        $task = "MODIFICAR RP";
        $fecha_expedicion = $rp_fecha;
        $descripcion = "modificar";
    }
    else{
        $url_guardar = "registrorp";
        $task = "REGISTRO RP";
        $fecha_expedicion = date('Y-m-d');
        $otro_valor = "none";
        $valor_total_cdp = $objRp->valor_total_cdp($codigo_cdp);
        $valor_cambiar_cdp = $valor_total_cdp;
        $descripcion = "registrar";
    }

    

    $datos_cdp_expedido = $objRp->datos_cdp_expedido($codigo_cdp);

    foreach($datos_cdp_expedido as $dat_cdp_expedido){
        $scdp_codigo = $dat_cdp_expedido['scdp_codigo'];
        $scdp_fecha = $dat_cdp_expedido['scdp_fecha'];
        $scdp_numero = $dat_cdp_expedido['scdp_numero'];
        $scdp_accion = $dat_cdp_expedido['scdp_accion'];
        $cdp_numeroexpedicion = $dat_cdp_expedido['cdp_numeroexpedicion'];
        $cdp_fecha = $dat_cdp_expedido['cdp_fecha'];
    }

    $codigo_plan_accion = $objRp->codigo_plan_accion($scdp_accion);

    $nombre_nivel_tres = $objRp->nombre_nivel_tres($codigo_plan_accion);

    $descripcion_accion = $objRp->descripcion_accion($scdp_accion);

    
?>
<style>
    .alert.alert-danger.alerta-forcliente{
        display: none;
        padding: 0;
        color: red ;
        font-weight: bold;
    }
</style>
<form id="rpform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?></strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-sm-5">
                <div class="form-group">
                    <label for="txtFecha" class="font-weight-bold">Fecha de Expedici&oacute;n *</label>
                    <input type="date" class="form-control caja_texto_sizer" id="txtFecha" name="txtFecha" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $fecha_expedicion; ?>" required>
                    <div class="alert alert-danger alerta-forcliente" id="error_fecha_expedicion" role="alert"></div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="form-group">
                    <label for="txtCodigoRp" class="font-weight-bold">N&uacute;mero RP *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtCodigoRp" name="txtCodigoRp" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $rp_numerorp; ?>" required>
                    <div class="alert alert-danger alerta-forcliente" id="error_numero_expedicion" role="alert"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtProveedor" class="font-weight-bold">Proveedor o Contratista *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtProveedor" name="txtProveedor" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $rp_proveedor; ?>" required>
                    <div class="alert alert-danger alerta-forcliente" id="error_proveedor" role="alert"></div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtActoAdm" class="font-weight-bold">Acto Administrativo *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtActoAdm" name="txtActoAdm" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $rp_actoadmin; ?>" required>
                    <div class="alert alert-danger alerta-forcliente" id="error_acto_admi" role="alert"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="txtServicio" class="font-weight-bold">Servicio *</label>
                    <textarea class="form-control caja_texto_sizer" name="txtServicio" id="txtServicio" aria-describedby="textHelp" rows="4" data-rule-required="false"><?php echo $rp_servicio; ?></textarea>
                    <div class="alert alert-danger alerta-forcliente" id="error_servicio" role="alert"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th colspan="3" style="text-align: center;">DATOS CDP EXPEDIDO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Fecha Expedici&oacute;n</strong> <?php echo date('d/m/Y',strtotime($cdp_fecha)); ?></td>
                            <td colspan="2"><strong>No. CDP</strong> <?php echo $cdp_numeroexpedicion; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><?php echo "<strong>".strtoupper(tildes($nombre_nivel_tres))."</strong>. ".$descripcion_accion; ?></td>
                        </tr>
                        <?php
                            $actividades_solicitud = $objRp->actividades_solicitud($scdp_codigo);
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
                                    $etapa_actividad_solicitud = $objRp->etapa_actividad_solicitud($scdp_codigo, $aes_actividad);
                                    if($etapa_actividad_solicitud){
                                        foreach ($etapa_actividad_solicitud as $dta_etpas) {
                                            $aes_codigo = $dta_etpas['aes_codigo'];
                                            $aes_etapa = $dta_etpas['aes_etapa'];
                                            $aes_valoretapa = $dta_etpas['aes_valoretapa']; 
                                            $aes_otrovalor = $dta_etpas['aes_otrovalor'];
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
                                            $clasificadores_solicitud = $objRp->clasificadores_solicitud($scdp_codigo, $aes_etapa);

                                            $recursos_designados = $objRp->recursos_designados($scdp_codigo, $aes_etapa);
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
            <div class="col-md-3">
                <div class="form-label-group form-group">
                    <label style="font-size: 15px;"><strong>Valor</strong></label><br>
                    <label style="font-size: 15px;">$<?php echo number_format($valor_total_cdp,0,'','.'); ?></label>
                    <input type="hidden" id="txtValor" name="txtValor" value="<?php echo $valor_total_cdp; ?>"/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-label-group form-group">
                    <label>&nbsp;</label><br>
                    &nbsp;&nbsp;<input type="checkbox" name="checkOtrval" id="checkOtrval" value="1" <?php echo $check_valor; ?>> &nbsp;<span>Otro valor</span>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-label-group form-group" style="display: <?php echo $otro_valor; ?>;" id="text_valor">
                    <label for="valor" class="font-weight-bold">Valor </label>
                    <input type="text" class="form-control caja_texto_sizer puntos_miles_etapa" id="valor" name="valor" aria-describedby="textHelp" value="<?php echo number_format($valor_cambiar_cdp,0,'','.'); ?>" required>
                    <div class="alert alert-danger alerta-forcliente" id="error_valor" role="alert"></div>
                </div>
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
        <input type="hidden" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>"/>
        <input type="hidden" name="codigo_rp" id="codigo_rp" value="<?php echo $codigo_rp; ?>"/>
        <input type="hidden" name="codigo_cdp" id="codigo_cdp" value="<?php echo $codigo_cdp; ?>"/>
        <input type="hidden" name="url_proceso" id="url_proceso" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="validarRp();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>

<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_rp.js"></script>
<script type="text/javascript">
    $('#checkOtrval').change(function(){
        var val_other = $('input:checkbox[name=checkOtrval]:checked').val();
        
        $('.validacion').fadeOut(100);

        if(val_other==1){
            $('#text_valor').fadeIn(100);
        }
        else{
            $('#text_valor').fadeOut(100);
        }
    });

    $(".puntos_miles_etapa").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value ) {
                return value.replace(/\D/g, "").replace(/([0-9])([0-9]{0})$/, '$1').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
        }
    });
</script>
