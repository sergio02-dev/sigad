<?php
    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $codigo_plan = $objSolicitudCdp->codigo_plan();

    $nombre_nivel_tres = $objSolicitudCdp->nombre_nivel_tres($codigo_plan);

    $plan_accion_consulta = $objSolicitudCdp->plan_accion_consulta($codigo_plan);

    

    $codigo_solicitud = $_REQUEST['codigo_solicitud'];

    $lista_recursos_dspnbles_mod = $objSolicitudCdp->lista_recursos_dspnbles_mod($codigo_solicitud);

    if($codigo_solicitud){
        $form_solicitud_cdp = $objSolicitudCdp->form_solicitud_cdp($codigo_solicitud);
        foreach($form_solicitud_cdp as $dta_form_solicitud_cdp){
            $scdp_codigo = $dta_form_solicitud_cdp['scdp_codigo'];
            $scdp_fecha = $dta_form_solicitud_cdp['scdp_fecha'];
            $scdp_accion = $dta_form_solicitud_cdp['scdp_accion'];
            $scdp_fuentefinanciacion = $dta_form_solicitud_cdp['scdp_fuentefinanciacion'];
            $scdp_estado = $dta_form_solicitud_cdp['scdp_estado'];
        }
        
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

    }
    else{
        $url_guardar="registrosolicitudcdp";
        $task = "REGISTRAR SOLICITUD CDP";
        $fecha_solicitud = date('Y-m-d');
        $checkedA = "checked";
        $checkedI = "";
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
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtFechaSolicitud" class="font-weight-bold">Fecha Solicitud: <?php  echo $fecha_solicitud; ?></label>
                    <input type="hidden" class="form-control caja_texto_sizer" id="txtFechaSolicitud" name="txtFechaSolicitud" aria-describedby="textHelp" data-rule-required="true" value="<?php  echo $fecha_solicitud ; ?>" required readonly>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selAccion" class="font-weight-bold"><?php echo $nombre_nivel_tres; ?> *</label>
                    <select name="selAccion" id="selAccion"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
                    <option value="0" data-codigo_accion="0"> Seleccione ...</option>
                        <?php
                            if($plan_accion_consulta){
                                foreach ($plan_accion_consulta as $dta_plan_accion_consulta) {
                                    $acc_codigo = $dta_plan_accion_consulta['acc_codigo'];
                                    $acc_referencia = $dta_plan_accion_consulta['acc_referencia'];
                                    $acc_numero = $dta_plan_accion_consulta['acc_numero'];
                                    $acc_descripcion = $dta_plan_accion_consulta['acc_descripcion'];

                                    $dscrpcion = $acc_referencia.".".$acc_numero." ".$acc_descripcion;

                                    if($acc_codigo == $scdp_accion){
                                        $selected_accion = "selected";
                                    }
                                    else{
                                        $selected_accion = "";
                                    }
                            
                        ?>
                            <option value="<?php echo  $acc_codigo; ?>" data-codigo_accion="<?php echo $acc_codigo; ?>" <?php echo $selected_accion; ?>><?php echo substr($dscrpcion,0,100); ?></option>
                        <?php
                                }
                            }
                            else{
                        ?>
                            <option value="0"> No hay <?php echo $nombre_nivel_tres; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <div class="alert alert-danger alerta-forcliente" id="error_accion" role="alert"></div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $('#selAccion').change(function(){
                var codigo_accion = $(this).find(':selected').data('codigo_accion');
                
                if(codigo_accion == 0){

                }
                else{
                    $.ajax({
                        url:"actividadaccionsdcpmod",
                        type:"POST",
                        data:"codigo_accion="+codigo_accion,
                        async:true,

                        success: function(message_uno){
                            $("#actvdades_lista").empty().append(message_uno);
                        }
                    });

                    $.ajax({
                        url:"fuentesaccion",
                        type:"POST",
                        data:"codigo_accion="+codigo_accion,
                        async:true,

                        success: function(message){
                            $("#fuenteAccion").empty().append(message);
                        }
                    });

                    
                }
                
            });
        </script>

        <div class="row">
            <div class="col-sm-12" >
                <div class="form-group" id="actvdades_lista">
                    <?php
                        if($codigo_solicitud){
                            $activity_list = $objSolicitudCdp->actividades_accion($scdp_accion);
                    ?>
                    <label class="font-weight-bold">Actividades * </label>
                    <div class="bg">
                        <div>
                        <?php
                            if($activity_list){
                                $activs = '';
                                $num_cheq = 1;
                                $cantidad_chequed_actividades  = $objSolicitudCdp->cantidad_chequed_actividades($codigo_solicitud);
                                foreach ($activity_list as $data_actvty_list) {
                                    $codigo_actividad = $data_actvty_list['codigo_actividad'];
                                    $referencia = $data_actvty_list['referencia'];
                                    $descripcion = $data_actvty_list['descripcion'];

                                    $dscrpcion = $referencia." ".$descripcion;

                                    $chequed_actividad = $objSolicitudCdp->chequed_actividad($codigo_solicitud, $codigo_actividad);
                                    if($chequed_actividad == 1){
                                        $checked_activity = "checked";
                                    }
                                    else{
                                        $checked_activity = "";
                                    }

                        ?>
                            <div class="chiller_cb">
                                <input id="actvddes<?php echo $codigo_actividad; ?>" class="actyvs" name="actvddes[]" type="checkbox" value="<?php echo $codigo_actividad; ?>" <?php echo $checked_activity; ?> >
                                <label for="actvddes<?php echo $codigo_actividad; ?>"><?php echo $dscrpcion; ?></label>
                                <span></span>
                            </div>
                        <?php
                                
                                }//Foreach Menu
                            }//if Menu
                            else{
                                echo "No hay Actividades";
                            }
                        ?>

                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                    <span id="error_solicitud" style="color:red; font-weight: bold;"></span>

                    <script type="text/javascript">

                        $('.actyvs').change(function(){
                            var codigo_actividad = new Array();
                            var codigo_solicitud = $('#codigo_solicitud').val();

                            $('[name="actvddes[]"]:checked').each(function() {
                                codigo_actividad.push($(this).val());
                            });
                            
                            if(codigo_actividad){
                                $.ajax({
                                    url:"etapasactividadscdpmod",
                                    type:"POST",
                                    data:'codigo_actividad='+codigo_actividad+'&codigo_solicitud='+codigo_solicitud,
                                    async:true,

                                    success: function(message){
                                        $("#etpas_lista").empty().append(message);
                                    }
                                });
                            }
                            
                        });

                        
                    </script>
                    <?php
                        }
                    ?>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12" id="etpas_lista">
                <?php 
                    if($codigo_solicitud){
                ?>
                <div class="form-group">
                    <label class="font-weight-bold">Etapas * </label>
                    <div class="bg">
                        <table class="table table-sm">
                            <?php 
                                $etapas_list = $objSolicitudCdp->etapa_editar($codigo_solicitud);
                                if($etapas_list){
                                    foreach($etapas_list as $dta_etpas_list){
                                        $poa_codigo = $dta_etpas_list['poa_codigo'];
                                        $poa_referencia = $dta_etpas_list['poa_referencia'];
                                        $poa_objeto = $dta_etpas_list['poa_objeto']; 
                                        $poa_recurso = $dta_etpas_list['poa_recurso'];
                                        $poa_estado = $dta_etpas_list['poa_estado'];
                                        $poa_numero = $dta_etpas_list['poa_numero']; 
                                        $poa_vigencia = $dta_etpas_list['poa_vigencia'];
                                        $acp_codigo = $dta_etpas_list['acp_codigo'];
                                        $poa_logroejecutado = $dta_etpas_list['poa_logroejecutado'];

                                        $etpa_nombre = $poa_referencia.".".$poa_numero." ".$poa_objeto;

                                        $poai_etapa_gasto = $objSolicitudCdp->poai_etpa_gasto_mod($poa_codigo, $codigo_solicitud);

                                        $rcursos_etapa = $poa_recurso - $poai_etapa_gasto;

                                        $checked_etapa = $objSolicitudCdp->chequed_etapa($codigo_solicitud, $poa_codigo);
                                        if($checked_etapa == 0){
                                            $checkear_etapa = "";
                                            $ver_check_caja = "none";
                                            $ver_otrovalor = "none";
                                            $control_valor = 0;
                                            $otro_valor_campo = "none";
                                        }
                                        else{
                                            $checkear_etapa = "checked";
                                            $valor_etps = $valor_etps + $poa_recurso;
                                            $ver_check_caja = "block";
                                            $control_valor = 1;
                                            $datos_etapa_solicitud = $objSolicitudCdp->datos_etapa_solicitud($codigo_solicitud, $poa_codigo);
                                            if($datos_etapa_solicitud){
                                                foreach($datos_etapa_solicitud as $dta_dtos_etpa){
                                                    $aes_etapa = $dta_dtos_etpa['aes_etapa'];
                                                    $aes_valoretapa = $dta_dtos_etpa['aes_valoretapa'];
                                                    $aes_otrovalor = $dta_dtos_etpa['aes_otrovalor'];
                                                    $aes_clasificador = $dta_dtos_etpa['aes_clasificador'];

                                                    if($aes_otrovalor == 1){
                                                        $otro_valor_campo = "block";
                                                        $cmpo_otro_valor = 1;
                                                        $checkVlor = "checked";
                                                    }
                                                    else{
                                                        $otro_valor_campo = "none";
                                                        $cmpo_otro_valor = 0;
                                                        $checkVlor = "";
                                                    }
                                                }
                                            }
                                        }

                                        
                            ?>
                            <tr>
                                <td>
                                    <div class="chiller_cb">
                                        <input id="actvddes<?php echo $poa_codigo; ?>" class="etapps" name="etpass[]" data-valor_etapa="<?php echo $rcursos_etapa; ?>" type="checkbox" value="<?php echo $poa_codigo; ?>" <?php echo $checkear_etapa; ?> data-rule-required="true">
                                        <label for="actvddes<?php echo $poa_codigo; ?>"><?php echo $etpa_nombre; ?></label>
                                        <span></span>
                                    </div>
                                    <!--- Datos Otro valor --->
                                    <input type="hidden" name="valetapa<?php echo $poa_codigo; ?>" id="valetapa<?php echo $poa_codigo; ?>" value="<?php echo $rcursos_etapa; ?>">
                                    <input type="hidden" id="control_valor<?php echo $poa_codigo; ?>" value="<?php echo $control_valor; ?>">
                                    <div class="row">
                                       
                                        
                                        <div class="col-sm-6 otro_valor<?php echo $poa_codigo; ?>" style="display: <?php echo $ver_check_caja; ?>;">
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
                                                    <td style="width: 90%"> <input type="text" class="form-control caja_texto_sizer" placeholder="Codigo Clasificador" name="codigo_clasificador<?php echo $poa_codigo; ?>[]" aria-describedby="textHelp" value="<?php echo $esc_clasificador; ?>" required /> </td>
                                                    <td style="width: 10%"><i class="fas fa-plus fa-lg color_icono" onclick="Agregaitems<?php echo $poa_codigo; ?>('<?php echo $poa_codigo; ?>')"></i></td>
                                                </tr>
                                            <?php
                                                        }
                                                        else{
                                            ?>
                                                <tr class="<?php echo $poa_codigo.$num_control; ?>"> 
                                                    <td style="width: 90%"><input type="text" class="form-control caja_texto_sizer" placeholder="Codigo Clasificador" id="codigo_clasificador<?php echo $poa_codigo.$num_control; ?>" name="codigo_clasificador<?php echo $poa_codigo; ?>[]" value="<?php echo $esc_clasificador; ?>" required /></td>
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
                                                    <td style="width: 90%"> <input type="text" class="form-control caja_texto_sizer" placeholder="Codigo Clasificador" name="codigo_clasificador<?php echo $poa_codigo; ?>[]" aria-describedby="textHelp" value="" required/> </td>
                                                    <td style="width: 10%"><i class="fas fa-plus fa-lg color_icono" onclick="Agregaitems<?php echo $poa_codigo; ?>('<?php echo $poa_codigo; ?>')"></i></td>
                                                </tr>
                                            
                                            
                                            <?php
                                                }
                                            ?>
                                            </table>
                                            
                                        </div>

                                        <div class="col-sm-3 otro_valor<?php echo $poa_codigo; ?>" style="display: <?php echo $ver_check_caja; ?>;">
                                            <br>
                                            <lable>&nbsp;</label>
                                            <input type="hidden" id="control_valor_chek<?php echo $poa_codigo; ?>" value="<?php echo $cmpo_otro_valor; ?>">
                                            &nbsp;&nbsp;<input type="checkbox" <?php echo $checkVlor; ?> name="checkOtrval<?php echo $poa_codigo; ?>" id="checkOtrval<?php echo $poa_codigo; ?>" value="1"> &nbsp;Otro valor
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="num_ini" id="num_ini" value="<?php echo $nun_inicio; ?>">
                                    
                                    <script type="text/javascript">
                                        var cantida_clasificador = $('#num_ini').val();
                                        function getInput(type, poaCode){
                                            var poaCode = poaCode;
                                            cantida_clasificador = parseInt(cantida_clasificador) +1;
                                            var dta = '<tr class="'+poaCode+cantida_clasificador+'"><td style="width: 90%"><input type="text" class="form-control caja_texto_sizer" placeholder="Codigo Clasificador" id="codigo_clasificador'+poaCode+cantida_clasificador+'" name="codigo_clasificador'+poaCode+'[]" required /></td><td style="width: 10%"><i class="fas fa-minus fa-lg color_icono" id="botton'+poaCode+cantida_clasificador+'" onclick="eliminar_clasificador(\''+cantida_clasificador+'\',\''+poaCode+'\')"></i><td></tr>'
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
                                                $('#control_valor_chek<?php echo $poa_codigo; ?>').val(1);
                                            }
                                            else{
                                                $('#text_valor<?php echo $poa_codigo; ?>').fadeOut(100);
                                                $('#control_valor_chek<?php echo $poa_codigo; ?>').val(0);
                                            }
                                        });
                                    </script>

                                    <!-- Validacion Otro valor --> 
                                </td>
                                <td>
                                    &nbsp;<br><?php echo "$".number_format($rcursos_etapa,0,'','.'); ?>
                                    <br>
                                    <div class="col-sm-12" id="text_valor<?php echo $poa_codigo; ?>" style="display: <?php echo $otro_valor_campo; ?>;">
                                        <div class="form-group">
                                            <label for="valor<?php echo $poa_codigo; ?>" class="font-weight-bold" >Valor </label>
                                            <input type="number" class="form-control caja_texto_sizer" id="valor<?php echo $poa_codigo; ?>" name="valor<?php echo $poa_codigo; ?>" aria-describedby="textHelp" value="<?php echo $aes_valoretapa; ?>" >
                                            <span id="error_valor_etpa<?php echo $poa_codigo; ?>" style="color:red; font-weight: bold;"></span>
                                        </div> 
                                    </div>
                                </td>
                            </tr>
                            <?php
                                    }
                                }
                                else{
                            ?>
                            <tr>
                                <td colspan="2">No hay Etapas</td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                        
                    </div>
                    <span class="help-block" id="error"></span>

                </div>

                <!--<div class="form-group">
                    <label for="SumTotal" class="font-weight-bold">Total*</label>
                    <input type="text" class="form-control" id="SumTotal" name="SumTotal" aria-describedby="textHelp" data-rule-required="true" value="<?php echo number_format($valor_etps,0,'','.'); ?>" required readonly>
                    <span class="help-block" id="error"></span>            
                </div>-->

                <input type="hidden" name="summaa" id="summaa" value="<?php echo $valor_etps; ?>">
                <script type="text/javascript">

                    var valor_total = new Array();

                    function numberWithCommas(formatoNumero) {
                        return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }

                    $('.etapps').change(function(){

                        var suma_etapa = 0;

                        //manejo visibilidad campo otro valor 
                        var codigo_etpa = this.value;
                        if($('#control_valor'+codigo_etpa).val() == 0){
                            $('#control_valor'+codigo_etpa).val(1);
                            $('.otro_valor'+codigo_etpa).fadeIn(1);
                        }
                        else{
                            $('#control_valor'+codigo_etpa).val(0);
                            $('.otro_valor'+codigo_etpa).fadeOut(1);
                            //$('#text_valor'+codigo_etpa).fadeOut(1);
                        }
                        //fin manejo visibilidad campo otro valor

                        valor_etapa = $('[name="etpass[]"]:checked').map(function () {
                                                return $(this).data('valor_etapa')
                                    }).get();

                        for (let index = 0; index < valor_etapa.length; index++) {
                            suma_etapa = parseInt(suma_etapa) + parseInt(valor_etapa[index]);   
                        }

                        //$('#SumTotal').val(numberWithCommas(suma_etapa));
                        $('#summaa').val(suma_etapa);
                        
                    });
                </script>
                <?php
                    }
                ?>
                <!-- valor fuente-->
                <div class="form-group">
                    <label class="font-weight-bold">Fuentes de Finaniaci&oacute;n * </label>
                    <div class="bg">
                        <table class="table table-sm">
                            <?php
                                if($lista_recursos_dspnbles_mod){
                                    foreach($lista_recursos_dspnbles_mod as $dat_rcsos_disponibles){
                                        $codigo_poai = $dat_rcsos_disponibles['codigo_poai'];
                                        $codigo_fuente = $dat_rcsos_disponibles['codigo_fuente'];
                                        $recursos = $dat_rcsos_disponibles['recursos'];
                                        $nombre_fuente = $dat_rcsos_disponibles['nombre_fuente'];

                                        $checkear_fuente = "";

                                        $check_fuente = $objSolicitudCdp->check_fuente($codigo_solicitud, $codigo_poai);
                                        if($check_fuente){
                                            foreach ($check_fuente as $dta_checked_fuente) {
                                                $fsc_codigo = $dta_checked_fuente['fsc_codigo'];
                                                $fsc_solicitud = $dta_checked_fuente['fsc_solicitud'];
                                                $fsc_poai = $dta_checked_fuente['fsc_poai'];
                                                $fsc_fuente = $dta_checked_fuente['fsc_fuente'];
                                                $fsc_valor = $dta_checked_fuente['fsc_valor'];
                                            }

                                            $checked_fuentes = "checked";
                                            $display_valor_fuente = "block";
                                        }
                                        else{
                                            $checked_fuentes = "";
                                            $display_valor_fuente = "none";
                                        }
                            ?>
                            <tr>
                                <td>
                                    <div class="chiller_cb">
                                        <input id="listffnte<?php echo $codigo_poai; ?>" class="fntesRcrsos" name="fuenntes[]" data-valor_fuentes="<?php echo $recursos; ?>" type="checkbox" value="<?php echo $codigo_poai; ?>" <?php echo $checked_fuentes; ?> data-rule-required="true" required>
                                        <label for="listffnte<?php echo $codigo_poai; ?>"><?php echo $nombre_fuente; ?></label>
                                        <span></span>
                                    </div>
                                </td>
                                <td>
                                    &nbsp;<br><?php echo "$".number_format($recursos,0,'','.'); ?>
                                    <br>
                                    <div class="row">
                                        <input type="hidden" id="control_fuente<?php echo $codigo_poai; ?>" value="0">
                                        <div class="col-sm-12" id="text_solicitud_fuente<?php echo $codigo_poai; ?>" style="display: <?php echo $display_valor_fuente; ?>;">
                                            <div class="form-group">
                                                <label for="valorpoai<?php echo $codigo_poai; ?>" class="font-weight-bold">Valor </label>
                                                <input type="number" class="form-control caja_texto_sizer" min="0" max="<?php echo $recursos; ?>" id="valorpoai<?php echo $codigo_poai; ?>" name="valorpoai<?php echo $codigo_poai; ?>" aria-describedby="textHelp" value="<?php echo $fsc_valor; ?>" required>
                                                <div class="alert alert-danger alerta-forcliente" id="error_valor_fuente<?php echo $codigo_poai; ?>" role="alert"></div>
                                            </div> 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                    }
                                }
                                else{
                            ?>
                            <tr>
                                <td>No hay Recursos</td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                        <div class="alert alert-danger alerta-forcliente" id="error_fuente" role="alert"></div>
                        <div class="alert alert-danger alerta-forcliente" id="error_valor_solicitado" role="alert"></div>
                        <div class="alert alert-danger alerta-forcliente" id="error_recursos_disponibles" role="alert"></div>
                    </div>
                </div>
                <!-- final-->
            </div>
        </div>


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
        <input type="hidden" name="codigo_solicitud" id="codigo_solicitud" value="<?php echo $codigo_solicitud; ?>">
        <input type="hidden" name="url_proceso" id="url_proceso" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="validar_solicitud_cdp();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="vjs/vldar_solicitud_cdp.js"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>

