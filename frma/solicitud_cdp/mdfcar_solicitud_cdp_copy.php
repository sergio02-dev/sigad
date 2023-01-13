<?php
    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $codigo_solicitud = $_REQUEST['codigo_solicitud'];

    $form_solicitud_cdp = $objSolicitudCdp->form_solicitud_cdp($codigo_solicitud);
    foreach($form_solicitud_cdp as $dta_form_solicitud_cdp){
        $scdp_codigo = $dta_form_solicitud_cdp['scdp_codigo'];
        $scdp_numero = $dta_form_solicitud_cdp['scdp_numero'];
        $scdp_fecha = $dta_form_solicitud_cdp['scdp_fecha'];
        $scdp_accion = $dta_form_solicitud_cdp['scdp_accion'];
        $scdp_estado = $dta_form_solicitud_cdp['scdp_estado'];
    }

    $codigo_plan = $objSolicitudCdp->codigo_plan_accion($scdp_accion);

    $nombre_nivel_tres = $objSolicitudCdp->nombre_nivel_tres($codigo_plan);

    $datos_accion = $objSolicitudCdp->datos_accion($scdp_accion);

    $plan_accion_consulta = $objSolicitudCdp->plan_accion_consulta($codigo_plan);
    
    $url_guardar="modificarsolicitudcdp";
    $task = "MODIFICAR SOLICITUD CDP";
    $fecha_solicitud = $scdp_fecha;

    if($scdp_estado == 1){
        $checkedA = "checked";
        $checkedI = "";
    }
    else{
        $checkedA = "";
        $checkedI = "checked";
    }
    
?>
<style>
    .alert.alert-danger.alerta-forcliente{
        display: none;
        padding: 0;
        color: red ;
        font-weight: bold;
    }
</style>
<form id="solicitudcdpform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?></strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="txtFechaSolicitud" class="font-weight-bold">Fecha de Solicitud </label>
                    <input type="date" class="form-control caja_texto_sizer" id="txtFechaSolicitud" name="txtFechaSolicitud" aria-describedby="textHelp" data-rule-required="true" value="<?php  echo $fecha_solicitud ; ?>" required>
                    <div class="alert alert-danger alerta-forcliente" id="error_fecha_solicitud" role="alert"></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="txtNumeroSolicitud" class="font-weight-bold">N&uacute;mero de Solicitud </label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtNumeroSolicitud" name="txtNumeroSolicitud" aria-describedby="textHelp" data-rule-required="true" value="<?php  echo $scdp_numero ; ?>" required>
                    <div class="alert alert-danger alerta-forcliente" id="error_numero_solicitud" role="alert"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label style="font-size: 15px;"><?php echo "<strong>".$nombre_nivel_tres.":</strong><br> ".$datos_accion; ?></label>
            </div>
        </div>

        <?php 
            $actividades_solicitud = $objSolicitudCdp->actividades_solicitud($codigo_solicitud);
            if($actividades_solicitud){
                foreach ($actividades_solicitud as $dat_actvdades_slctud) {
                    $aes_actividad = $dat_actvdades_slctud['aes_actividad'];
                    $acp_referencia = $dat_actvdades_slctud['acp_referencia'];
                    $acp_numero = $dat_actvdades_slctud['acp_numero'];
                    $acp_descripcion = $dat_actvdades_slctud['acp_descripcion'];

                    $descripcion_actividad = "<strong>Actividad: </strong><br>".$acp_referencia.".".$acp_numero." ".$acp_descripcion;
                
        ?>
                    <div class="row">
                        <div class="col-md-12">
                            <label style="font-size: 15px;"><?php echo $descripcion_actividad; ?></label>
                        </div>
                    </div>
                    <br>
        <?php
                    $etapas_solicitud = $objSolicitudCdp->etapas_solicitud($aes_actividad, $codigo_solicitud);
                    if($etapas_solicitud){
        ?>
                    <div class="form-group">
                        <label class="font-weight-bold">Etapas </label>
                        <table class="table table-sm">
        <?php
                        foreach($etapas_solicitud as $dat_etapas_slicitud){
                            $poa_codigo = $dat_etapas_slicitud['poa_codigo'];
                            $poa_referencia = $dat_etapas_slicitud['poa_referencia'];
                            $poa_numero = $dat_etapas_slicitud['poa_numero'];
                            $poa_objeto = $dat_etapas_slicitud['poa_objeto'];
                            $poa_recurso = $dat_etapas_slicitud['poa_recurso'];
                            $aes_valoretapa = $dat_etapas_slicitud['aes_valoretapa'];
                            $aes_otrovalor = $dat_etapas_slicitud['aes_otrovalor'];

                            $etpa_nombre = $poa_referencia.".".$poa_numero." ".$poa_objeto;

                            $poai_etapa_gasto = $objSolicitudCdp->poai_etapa_gasto($poa_codigo, $codigo_solicitud);

                            $rcursos_etapa = $poa_recurso - $poai_etapa_gasto;

                            if($aes_otrovalor == 1){
                                $control_valor = 1;
                                $otro_valor_campo = "block";
                                $checkVlor = "checked";
                            }
                            else{
                                $control_valor = 0;
                                $otro_valor_campo = "none";
                                $checkVlor = "";
                            }
        ?>
                            <tr>
                                <td>
                                    <?php echo $etpa_nombre; ?><br>
                                    <!--- Datos Otro valor --->
                                    <input type="hidden" name="valetapa<?php echo $poa_codigo; ?>" id="valetapa<?php echo $poa_codigo; ?>" value="<?php echo $rcursos_etapa; ?>">
                                    <input type="hidden" id="control_valor<?php echo $poa_codigo; ?>" value="<?php echo $control_valor; ?>">
                                    <input type="hidden" name="etapass[]" value="<?php echo $poa_codigo; ?>">
                                    <div class="row">
                                        <div class="col-sm-6 otro_valor<?php echo $poa_codigo; ?> " style="display: <?php echo $ver_check_caja; ?>;">
                                            <label for="codigo_clasificador<?php echo $poa_codigo; ?>" class="font-weight-bold" >Codigo Clasificador</label>

                                            <table class="clasfcdorCdgo<?php echo $poa_codigo; ?>">
                                            <?php
                                                $codigos_clasificadores_etapas = $objSolicitudCdp->codigos_clasificadores_etapas($codigo_solicitud, $poa_codigo);
                                                if($codigos_clasificadores_etapas){
                                                    $num_control = 0;
                                                    $nun_inicio = count($codigos_clasificadores_etapas);
                                                    foreach ($codigos_clasificadores_etapas as $dta_clsfcador) {
                                                        $esc_codigo = $dta_clsfcador['esc_codigo']; 
                                                        $esc_etapa = $dta_clsfcador['esc_etapa'];
                                                        $esc_solitudetapa = $dta_clsfcador['esc_solitudetapa'];
                                                        $esc_clasificador = $dta_clsfcador['esc_clasificador'];

                                                        if($num_control == 0){
                                            ?>
                                                <tr>
                                                    <td style="width: 90%"> <input type="text" class="form-control caja_texto_sizer" placeholder="Codigo Clasificador" name="codigo_clasificador<?php echo $poa_codigo; ?>[]" aria-describedby="textHelp" value="<?php echo $esc_clasificador; ?>"/> </td>
                                                    <td style="width: 10%"><i class="fas fa-plus fa-lg color_icono" onclick="Agregaitems<?php echo $poa_codigo; ?>('<?php echo $poa_codigo; ?>')"></i></td>
                                                </tr>
                                            <?php
                                                        }
                                                        else{
                                            ?>
                                                <tr class="<?php echo $poa_codigo.$num_control; ?>"> 
                                                    <td style="width: 90%"><input type="text" class="form-control caja_texto_sizer" placeholder="Codigo Clasificador" id="codigo_clasificador<?php echo $poa_codigo.$num_control; ?>" name="codigo_clasificador<?php echo $poa_codigo; ?>[]" value="<?php echo $esc_clasificador; ?>"/></td>
                                                    <td style="width: 10%"><i class="fas fa-minus fa-lg color_icono" id="botton<?php echo $poa_codigo.$num_control; ?>" onclick="eliminar_clasificador('<?php echo $num_control; ?>', '<?php echo $poa_codigo; ?>')"></i></td>
                                                </tr>
                                            <?php
                                                        }

                                                        $num_control++;
                                                    }
                                                }
                                                else{
                                                    $nun_inicio = 0;
                                            ?>
                                                <tr>
                                                    <td style="width: 90%"> <input type="text" class="form-control caja_texto_sizer" placeholder="Codigo Clasificador" name="codigo_clasificador<?php echo $poa_codigo; ?>[]" aria-describedby="textHelp" value=""/> </td>
                                                    <td style="width: 10%"><i class="fas fa-plus fa-lg color_icono" onclick="Agregaitems<?php echo $poa_codigo; ?>('<?php echo $poa_codigo; ?>')"></i></td>
                                                </tr>
                                            
                                            
                                            <?php
                                                }
                                            ?>
                                            </table>
                                            <div class="alert alert-danger alerta-forcliente" id="errro_clasificador<?php echo $poa_codigo; ?>" role="alert"></div>
                                        </div>
                                        <div class="col-sm-3 otro_valor<?php echo $poa_codigo; ?>" style="display: <?php echo $ver_check_caja; ?>;">
                                            <br>
                                            <lable>&nbsp;</label>
                                            &nbsp;&nbsp;<input type="checkbox" <?php echo $checkVlor; ?> name="checkOtrval<?php echo $poa_codigo; ?>" id="checkOtrval<?php echo $poa_codigo; ?>" value="1"> &nbsp;Otro valor
                                        </div>

                                    </div>
                                    <input type="hidden" name="num_ini" id="num_ini" value="<?php echo $nun_inicio; ?>">

                                    <script type="text/javascript">
                                        var cantida_clasificador = $('#num_ini').val();
                                        function getInput(type, poaCode){
                                            var poaCode = poaCode;
                                            cantida_clasificador = parseInt(cantida_clasificador) +1;
                                            var dta = '<tr class="'+poaCode+cantida_clasificador+'"><td style="width: 90%"><input type="text" class="form-control caja_texto_sizer" placeholder="Codigo Clasificador" id="codigo_clasificador'+poaCode+cantida_clasificador+'" name="codigo_clasificador'+poaCode+'[]" /></td><td style="width: 10%"><i class="fas fa-minus fa-lg color_icono" id="botton'+poaCode+cantida_clasificador+'" onclick="eliminar_clasificador(\''+cantida_clasificador+'\',\''+poaCode+'\')"></i><td></tr>'
                                            return dta;
                                        }

                                        function eliminar_clasificador(data_info, codPoa){
                                            var data_info = data_info;
                                            var codPoa = codPoa;
                                            var capa_remove = "."+codPoa+data_info;
                                            $(capa_remove).remove();
                                        }

                                        function append(className, nodoToAppend){
                                            var nodo = document.getElementsByClassName(className)[0];
                                            $('.'+className).append(nodoToAppend);
                                        }

                                        function Agregaitems<?php echo $poa_codigo; ?>(poaCode){
                                            var poaCode = poaCode;
                                            var nodo_clasificacion = getInput("text", poaCode);
                                            append("clasfcdorCdgo"+poaCode, nodo_clasificacion);
                                        }

                                        $('#checkOtrval<?php echo $poa_codigo; ?>').change(function(){
                                            var val_other = $('input:checkbox[name=checkOtrval<?php echo $poa_codigo; ?>]:checked').val();

                                            if(val_other==1){
                                                $('#text_valor<?php echo $poa_codigo; ?>').fadeIn(100);
                                                $('#control_valor<?php echo $poa_codigo; ?>').val(1);
                                            }
                                            else{
                                                $('#text_valor<?php echo $poa_codigo; ?>').fadeOut(100);
                                                $('#control_valor<?php echo $poa_codigo; ?>').val(0);
                                            }
                                        });
                                    </script>  
                                </td>
                                <td>
                                    &nbsp;<br><strong><?php echo "$".number_format($rcursos_etapa,0,'','.'); ?></strong>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12" id="text_valor<?php echo $poa_codigo; ?>" style="display: <?php echo $otro_valor_campo; ?>;">
                                            <div class="form-group">
                                                <label for="valor<?php echo $poa_codigo; ?>" class="font-weight-bold" >Valor </label>
                                                <input type="text" class="form-control caja_texto_sizer puntos_miles_etapa" min="0" max="<?php echo $rcursos_etapa; ?>" id="valor<?php echo $poa_codigo; ?>" name="valor<?php echo $poa_codigo; ?>" aria-describedby="textHelp" value="<?php echo number_format($aes_valoretapa,0,'','.'); ?>" required>
                                                <span id="error_valor_etpa<?php echo $poa_codigo; ?>" style="color:red; font-weight: bold;"></span>
                                            </div> 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label style="color: #C2240B;"  class="font-weight-bold" id="titulo_fuente<?php echo $poa_codigo; ?>"><strong>Fuentes</strong></label>
                                    <table class="table">
                                    <?php
                                        $fuente_asignada_etapa = $objSolicitudCdp->fuente_asignada_etapa($poa_codigo);
                                        if($fuente_asignada_etapa){
                                    ?>
                                        <tbody>
                                    <?php
                                            $cant = 0;
                                            foreach($fuente_asignada_etapa as $dta_fnte_asgnda_etpa){
                                                $asre_codigo = $dta_fnte_asgnda_etpa['asre_codigo'];
                                                $asre_etapa = $dta_fnte_asgnda_etpa['asre_etapa'];
                                                $asre_accion = $dta_fnte_asgnda_etpa['asre_etapa'];
                                                $asre_fuente = $dta_fnte_asgnda_etpa['asre_fuente']; 
                                                $asre_indicador = $dta_fnte_asgnda_etpa['asre_indicador'];
                                                $asrerecurso = $dta_fnte_asgnda_etpa['asre_recurso'];
                                                $ffi_nombre = $dta_fnte_asgnda_etpa['ffi_nombre'];
                                                $asre_vigenciarecurso = $dta_fnte_asgnda_etpa['asre_vigenciarecurso'];

                                                $gasto_asignacion = $objSolicitudCdp->gasto_asignacion($asre_codigo, $codigo_solicitud);

                                                $asre_recurso = $asrerecurso - $gasto_asignacion;
                                                
                                                list($otro_valor_asignacion, $valor_asignacion) = $objSolicitudCdp->presupuesto_x_fuente($codigo_solicitud, $asre_codigo);
                                                if($otro_valor_asignacion == 1){
                                                    $ver_caja = "block";
                                                    $check_valor = "checked";
                                                    $valor_suma_fuentes = $valor_suma_fuentes + $valor_asignacion; 
                                                    $asre_recurso_mod = $valor_asignacion;
                                                }
                                                else{
                                                    $ver_caja = "none";
                                                    $check_valor = "";
                                                    $valor_suma_fuentes = $valor_suma_fuentes + $asre_recurso; 
                                                    $asre_recurso_mod = $asre_recurso;
                                                }
                                    ?>
                                            <tr>
                                                <td>
                                                    <strong><?php echo $asre_vigenciarecurso." ".str_replace('INV -','', $ffi_nombre); ?></strong>
                                                </td>
                                                <td>
                                                    <strong><?php echo "$ ".number_format($asre_recurso,0,'','.'); ?></strong><br>
                                                    &nbsp;&nbsp;<input type="checkbox" name="checkCmbioval<?php echo $asre_codigo; ?>" id="checkCmbioval<?php echo $asre_codigo; ?>"  value="1" <?php echo $check_valor; ?>> &nbsp;Otro valor
                                                    <input type="hidden" id="recurso_asignado<?php echo $asre_codigo; ?>" name="recurso_asignado<?php echo $asre_codigo; ?>" value="<?php echo $asre_recurso; ?>">
                                                    <input type="hidden" name="codigo_recurso<?php echo $poa_codigo; ?>[]" value="<?php echo $asre_codigo; ?>">

                                                    <script type="text/javascript">
                                                        $('#checkCmbioval<?php echo $asre_codigo; ?>').change(function(){
                                                            var cambio_valor = $('input:checkbox[name=checkCmbioval<?php echo $asre_codigo; ?>]:checked').val();
                                                            var valor_solicitado = 0;

                                                            if(!cambio_valor){
                                                                $('.valor_cambio<?php echo $asre_codigo; ?>').fadeOut('100');
                                                            }
                                                            else{
                                                                $('.valor_cambio<?php echo $asre_codigo; ?>').fadeIn('100');
                                                            }

                                                            $("input[name='codigo_recurso<?php echo $poa_codigo; ?>[]']").each(function(indice, elemento) {
                                                                var codigo_asignacion = $(elemento).val();
                                                                var recurso_asignado = $('#recurso_asignado'+codigo_asignacion).val();
                                                                var fuente_cambio = $('#fuentes_asgnacion'+codigo_asignacion).val();
                                                                var cambio_valor = $('input:checkbox[name=checkCmbioval'+codigo_asignacion+']:checked').val();
                                                                
                                                                fuente_cambio = fuente_cambio.toString().replace(/\./g,'');

                                                                if(!cambio_valor){
                                                                    valor_solicitado = parseFloat(valor_solicitado) + parseFloat(recurso_asignado);
                                                                }
                                                                else{
                                                                    if(fuente_cambio == ''){
                                                                        $("#error_vacio_asignado"+codigo_asignacion).fadeIn('300');
                                                                        $('#error_vacio_asignado'+codigo_asignacion).html('El campo no puede ir vacío');
                                                                        return false;
                                                                    }
                                                                    else{
                                                                        $("#error_vacio_asignado"+codigo_asignacion).fadeOut('300');
                                                                        $('#error_vacio_asignado'+codigo_asignacion).html('');
                                                                    }
                                                                    valor_solicitado = parseFloat(valor_solicitado) + parseFloat(fuente_cambio);
                                                                }
                                                            });
                                                            

                                                            $('#suma_validacion<?php echo $poa_codigo; ?>').val(valor_solicitado);
                                                            $('#sumaValores<?php echo $poa_codigo; ?>').html(numberWithCommas(valor_solicitado));
                                                        });
                                                    </script>
                                                </td>
                                                <td> 
                                                    <div class="row valor_cambio<?php echo $asre_codigo; ?>" style="display: <?php echo $ver_caja;?>;">
                                                        <div class="col-md-12">
                                                            <div class="form-label-group form-group"> 
                                                                <input type="text" onblur="totales_solicitud<?php echo $poa_codigo; ?>()" class="form-control caja_texto_sizer puntos_miles" placeholder="$...." id="fuentes_asgnacion<?php echo $asre_codigo; ?>" name="fuentes_asgnacion<?php echo $asre_codigo; ?>" aria-describedby="textHelp" value="<?php echo number_format($asre_recurso_mod,0,'','.');?>" required> 
                                                                <div class="alert alert-danger alerta-forcliente" id="error_valor_asignado<?php echo $asre_codigo; ?>" role="alert"></div>
                                                                <div class="alert alert-danger alerta-forcliente" id="error_vacio_asignado<?php echo $asre_codigo; ?>" role="alert"></div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                                $cant++;
                                            }
                                    ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>TOTAL</th>
                                                <th colspan="2">
                                                    $ <span id="sumaValores<?php echo $poa_codigo; ?>"><?php echo number_format($valor_suma_fuentes,0,'','.'); ?> </span>
                                                    <input type="hidden" name="sumatoria_etapa<?php echo $poa_codigo; ?>" id="sumatoria_etapa<?php echo $poa_codigo; ?>" value="<?php echo $valor_suma_fuentes; ?>">
                                                    <input type="hidden" name="suma_validacion<?php echo $poa_codigo; ?>" id="suma_validacion<?php echo $poa_codigo; ?>" value="<?php echo $valor_suma_fuentes; ?>">
                                                    <div class="alert alert-danger alerta-forcliente" id="error_solicitado_etapa<?php echo $poa_codigo; ?>" role="alert"></div>
                                                </th>
                                            </tr> 
                                        </tfoot>
                                        <input type="hidden" id="cantidad_asignaciones<?php echo $poa_codigo; ?>" name="cantidad_asignaciones<?php echo $poa_codigo; ?>" value="<?php echo $cant; ?>">
                                    <?php
                                        }
                                        else{
                                            $cantidad_fuentes = 0;
                                    ?>
                                            <tr>
                                                <td>
                                                    <strong>No hay Recusos Asignados</strong>
                                                    <input type="hidden" id="validacion_recuersos<?php echo $poa_codigo; ?>" value="0"/>
                                                    <input type="hidden" id="cantidad_asignaciones<?php echo $poa_codigo; ?>" name="cantidad_asignaciones<?php echo $poa_codigo; ?>" value="0">
                                                    <div class="alert alert-danger alerta-forcliente" id="recurso_slctado<?php echo $poa_codigo; ?>" role="alert"></div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    ?>
                                    </table>
                                </td>
                            </tr>
                            <!------------ sumas fuentes ------------->
                            <script type="text/javascript">
                                function totales_solicitud<?php echo $poa_codigo; ?>(){
                                    var valor_solicitado = 0;

                                    $("input[name='codigo_recurso<?php echo $poa_codigo; ?>[]']").each(function(indice, elemento) {
                                        var codigo_asignacion = $(elemento).val();
                                        var recurso_asignado = $('#recurso_asignado'+codigo_asignacion).val();
                                        var fuente_cambio = $('#fuentes_asgnacion'+codigo_asignacion).val();
                                        var cambio_valor = $('input:checkbox[name=checkCmbioval'+codigo_asignacion+']:checked').val();
                                        
                                        fuente_cambio = fuente_cambio.toString().replace(/\./g,'');

                                        if(!cambio_valor){
                                            valor_solicitado = parseFloat(valor_solicitado) + parseFloat(recurso_asignado);
                                        }
                                        else{
                                            if(fuente_cambio == ''){
                                                $("#error_vacio_asignado"+codigo_asignacion).fadeIn('300');
                                                $('#error_vacio_asignado'+codigo_asignacion).html('El campo no puede ir vacío');
                                                return false;
                                            }
                                            else{
                                                $("#error_vacio_asignado"+codigo_asignacion).fadeOut('300');
                                                $('#error_vacio_asignado'+codigo_asignacion).html('');
                                            }
                                            valor_solicitado = parseFloat(valor_solicitado) + parseFloat(fuente_cambio);
                                        }
                                    });
                                    $('#suma_validacion<?php echo $poa_codigo; ?>').val(valor_solicitado);
                                    $('#sumaValores<?php echo $poa_codigo; ?>').html(numberWithCommas(valor_solicitado));
                                }
                            </script>
                            <!-- .................................. -->

        <?php
                        }
        ?>
                        </table>
                    </div>
        <?php
                    }
                }
            }
        ?>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="chkestado" class="font-weight-bold">Estado *</label>
                    <div class="radio tipo1">
                        <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                        <label for="ractivo">&nbsp;Activo &nbsp;&nbsp;</label>

                        <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> required />
                        <label for="rinactivo">&nbsp;Inactivo</label>
                        <div class="alert alert-danger alerta-forcliente" id="error_estado" role="alert"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="scdp_accion" id="scdp_accion" value="<?php echo $scdp_accion; ?>">
        <input type="hidden" name="codigo_solicitud" id="codigo_solicitud" value="<?php echo $codigo_solicitud; ?>">
        <input type="hidden" name="url_proceso" id="url_proceso" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="validar_solicitud_cdp();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="vjs/vldar_solicitud_cdp_mod.js"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    function numberWithCommas(formatoNumero) {
        return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

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

    $(".puntos_miles").on({
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

