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

    $list_cldfcadores = $objSolicitudCdp->list_cldfcadores();
    
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
                    $codigo_actividad = $dat_actvdades_slctud['aes_actividad'];
                    $acp_referencia = $dat_actvdades_slctud['acp_referencia'];
                    $acp_numero = $dat_actvdades_slctud['acp_numero'];
                    $acp_descripcion = $dat_actvdades_slctud['acp_descripcion'];

                    $descripcion_actividad = "<strong>Actividad: </strong><br>".$acp_referencia.".".$acp_numero." ".$acp_descripcion;
                
                    $etapas_list = $objSolicitudCdp->etapas_actividad($codigo_actividad);

                    $form_dta_etapa_solicitud = $objSolicitudCdp->form_dta_etapa_solicitud($codigo_actividad, $codigo_solicitud);
                    if($form_dta_etapa_solicitud){
                        foreach ($form_dta_etapa_solicitud as $dta_frma_etps) {
                            $cod_etp = $dta_frma_etps['aes_etapa'];
                            $ref_etp = $dta_frma_etps['poa_referencia'];
                            $num_etp = $dta_frma_etps['poa_numero'];
                            $objto_etp = $dta_frma_etps['poa_objeto'];
                            $rcrso_etp = $dta_frma_etps['poa_recurso'];
                            $other_val = $dta_frma_etps['aes_otrovalor'];
                            $val_slctdo = $dta_frma_etps['aes_valoretapa'];                     
                        }
                        $dscrpp = $ref_etp.".".$num_etp." ".$objto_etp;
                        $prcs = $rcrso_etp;
                    }
                    else{
                        $cod_etp = 0;
                        $dscrpp = "";
                        $prcs = 0;
                        $other_val = 0;
                    }

                    if($other_val == 1){
                        $display_otro_valor = "block";
                        $check_otro_valor = "checked";
                        $cmpo_otro = $val_slctdo;
                    }
                    else{
                        $display_otro_valor = "none";
                        $check_otro_valor = "";
                        $cmpo_otro = $prcs;
                    }
        ?>
                    <div class="row">
                        <div class="col-md-12">
                            <label style="font-size: 15px;"><?php echo $descripcion_actividad; ?></label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="etpass<?php echo $codigo_actividad; ?>" class="font-weight-bold">Etapa *</label>
                                <select name="etpass<?php echo $codigo_actividad; ?>" id="etpass<?php echo $codigo_actividad; ?>" class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true">
                                    <option value="0" data-codigo_etapa="0" data-descrpcion="" data-rcursos_etapa="0"> Seleccione ...</option>
                                    <?php
                                        if($etapas_list){
                                            foreach ($etapas_list as $dta_etpas_list) {
                                                $poa_codigo = $dta_etpas_list['poa_codigo'];
                                                $poa_referencia = $dta_etpas_list['poa_referencia'];
                                                $poa_objeto = $dta_etpas_list['poa_objeto']; 
                                                $poa_recurso = $dta_etpas_list['poa_recurso'];
                                                $poa_estado = $dta_etpas_list['poa_estado'];
                                                $poa_numero = $dta_etpas_list['poa_numero']; 
                                                $poa_vigencia = $dta_etpas_list['poa_vigencia'];

                                                $etpa_nombre = $poa_referencia.".".$poa_numero." ".$poa_objeto;

                                                $poai_etapa_gasto = $objSolicitudCdp->poai_etapa_gasto($poa_codigo, $codigo_solicitud);

                                                $rcursos_etapa = $poa_recurso - $poai_etapa_gasto;
                                                
                                                if($cod_etp == $poa_codigo){
                                                    $selected_etpa = "selected";
                                                }
                                                else{
                                                    $selected_etpa = "";
                                                }
                                    ?>
                                        <option value="<?php echo  $poa_codigo; ?>" <?php echo $selected_etpa; ?> data-codigo_etapa="<?php echo $poa_codigo; ?>" data-rprpcion="<?php echo $etpa_nombre; ?>" data-rcursos_etapa="<?php echo $rcursos_etapa; ?>"><?php echo substr($etpa_nombre,0,110); ?></option>
                                    <?php
                                            }
                                        }
                                        else{
                                    ?>
                                        <option value="0" data-codigo_etapa="0" data-pcion="" data-rcursos_etapa="0"> No hay Etapas</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <span id="error_etapa<?php echo $codigo_actividad; ?>" style="color:#C2240B; font-weight: bold;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="informacion_etapa<?php echo $codigo_actividad; ?>">
                        <div class="row">
                            <div class="col-md-8"><?php echo $dscrpp; ?></div>
                            <div class="col-md-4"><?php echo "$".number_format($prcs,0,'','.'); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                <input type="hidden" id="control_valor_chek<?php echo $codigo_actividad; ?>" value="0">
                                <input type="checkbox" name="checkOtrval<?php echo $codigo_actividad; ?>" id="checkOtrval<?php echo $codigo_actividad; ?>" value="1" <?php echo $check_otro_valor; ?>> &nbsp;Otro valor
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="text_valor<?php echo $codigo_actividad; ?>" style="display: <?php echo $display_otro_valor; ?>;">
                                    <label for="valor<?php echo $codigo_actividad; ?>" class="font-weight-bold" >Valor </label>
                                    <input type="text" class="form-control caja_texto_sizer puntos_miles_etapa" min="0" id="valor<?php echo $codigo_actividad; ?>" name="valor<?php echo $codigo_actividad; ?>" aria-describedby="textHelp" value="<?php echo number_format($cmpo_otro,0,'','.'); ?>" required>
                                    <span id="error_valor_etpa<?php echo $codigo_actividad; ?>" style="color:red; font-weight: bold;"></span>
                                    <input type="hidden" name="valor_etapa<?php echo $codigo_actividad; ?>" id="valor_etapa<?php echo $codigo_actividad; ?>" value="<?php echo $prcs; ?>">
                                </div> 
                            </div>
                        </div>                       
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table tablaClasificadores<?php echo $codigo_actividad; ?>">
                                <tr>
                                    <th colspan="3">Codigo Casificador</th>
                                </tr>
                                <?php 
                                    $codigos_clasificadores_etapas = $objSolicitudCdp->codigos_clasificadores_etapas($codigo_solicitud, $cod_etp);
                                    if($codigos_clasificadores_etapas){
                                        $num_control = 0;
                                        $nun_inicio = count($codigos_clasificadores_etapas);
                                        foreach ($codigos_clasificadores_etapas as $dta_clsfcador) {
                                            $esc_codigo = $dta_clsfcador['esc_codigo']; 
                                            $esc_etapa = $dta_clsfcador['esc_etapa'];
                                            $esc_solitudetapa = $dta_clsfcador['esc_solitudetapa'];
                                            $esc_clasificador = $dta_clsfcador['esc_clasificador'];
                                            $esc_valor = $dta_clsfcador['esc_valor'];

                                            if($num_control == 0){
                                ?>
                                <tr>
                                    <td style="width: 65%">
                                        <div class="form-label-group form-group" id="dtaClasificador<?php echo $codigo_actividad;?>">
                                            <select name="selClasificador<?php echo $codigo_actividad;?>[]" class="form-control caja_texto_sizer selectpicker<?php echo $codigo_actividad;?>" data-size="8">
                                                <option value="0">Seleccione...</option>
                                                <?php
                                                    if($list_cldfcadores){
                                                        foreach ($list_cldfcadores as $dat_clsfcdor) {
                                                            $cla_codigo = $dta_clsfcador['cla_codigo'];
                                                            $cla_nombre = $dta_clsfcador['cla_nombre'];
                                                            $cla_numero = $dta_clsfcador['cla_numero'];

                                                            if($esc_clasificador == $cla_codigo){
                                                                $selected_clas = "selected";
                                                            }
                                                            else{
                                                                $selected_clas = "";
                                                            }
                                                ?>
                                                <option value="<?php echo $cla_codigo; ?>" <?php echo $selected_clas; ?>><?php echo $cla_numero." ".$cla_nombre; ?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width: 30%">
                                        <div class="form-label-group form-group">
                                            <input type="text" class="form-control caja_texto_sizer puntos_miles_etapa" placeholder="$......." name="valor_clasificador<?php echo $codigo_actividad; ?>[]" aria-describedby="textHelp" value="" required> 
                                        </div>
                                    </td>
                                    <td style="width: 5%">
                                        <i class="fas fa-plus fa-lg color_icono" onclick="Agregaitems<?php echo $codigo_actividad; ?>('<?php echo $codigo_actividad; ?>')"></i>
                                    </td>
                                </tr>
                                <?php
                                            }
                                            else{
                                ?>
                                <tr class="<?php echo $codigo_actividad.$num_control; ?>">
                                    <td style="width: 65%">
                                        <div class="form-label-group form-group" id="dtaClasificador<?php echo $codigo_actividad;?>">
                                            <select name="selClasificador<?php echo $codigo_actividad;?>[]" class="form-control caja_texto_sizer selectpicker<?php echo $codigo_actividad;?>" data-size="8">
                                                <option value="0">Seleccione...</option>
                                                <?php
                                                    if($list_cldfcadores){
                                                        foreach ($list_cldfcadores as $dat_clsfcdor) {
                                                            $cla_codigo = $dta_clsfcador['cla_codigo'];
                                                            $cla_nombre = $dta_clsfcador['cla_nombre'];
                                                            $cla_numero = $dta_clsfcador['cla_numero'];

                                                            if($esc_clasificador == $cla_codigo){
                                                                $selected_clas = "selected";
                                                            }
                                                            else{
                                                                $selected_clas = "";
                                                            }
                                                ?>
                                                <option value="<?php echo $cla_codigo; ?>" <?php echo $selected_clas; ?>><?php echo $cla_numero." ".$cla_nombre; ?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width: 30%">
                                        <div class="form-label-group form-group">
                                            <input type="text" class="form-control caja_texto_sizer puntos_miles_etapa" placeholder="$......." name="valor_clasificador<?php echo $codigo_actividad; ?>[]" aria-describedby="textHelp" value="" required> 
                                        </div>
                                    </td>
                                    <td style="width: 5%">
                                        <i class="fas fa-minus fa-lg color_icono" onclick="eliminar_clasificador<?php echo $codigo_actividad; ?>('<?php echo $codigo_actividad.$num_control; ?>')"></i>
                                    </td>
                                </tr>
                                <?php
                                            }

                                ?>


                                <?php
                                            $num_control++;
                                        }
                                    }
                                ?>
                            </table>
                            <input type="hidden" name="num_ini<?php echo $codigo_actividad; ?>" id="num_ini<?php echo $codigo_actividad; ?>" value="<?php echo $nun_inicio; ?>">
                        </div>
                    </div>
                    
                    





        <?php
                    $etapas_solicitud = $objSolicitudCdp->etapas_solicitud($codigo_actividad, $codigo_solicitud);
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
        ?>
        <script type="text/javascript">
            var select_info<?php echo $codigo_actividad; ?> = '';
            var lista_opciones<?php echo $codigo_actividad; ?> = '';

            function cargar_select() {
                $.ajax({
                    url:"jclasificadores",
                    type:"POST",
                    data:'valor',
                    async:true,
                    dataType: 'json',
                    success: function(message){
                        datos = message.data;
                        $.each(datos, function(index, element){
                            lista_opciones<?php echo $codigo_actividad; ?> += '<option value="'+element.cla_codigo+'">'+element.cla_numero+' '+element.cla_nombre+'</option>';
                        });

                        select_info<?php echo $codigo_actividad; ?> = '<select name="selClasificador<?php echo $codigo_actividad;?>[]" class="form-control caja_texto_sizer selectpicker<?php echo $codigo_actividad;?>" data-size="8"><option value="0">Seleccione...</option>'+lista_opciones<?php echo $codigo_actividad; ?>+'</select>';

                    }
                });
            }

            var cantida_clasificador<?php echo $codigo_actividad; ?> = $('#num_ini<?php echo $codigo_actividad; ?>').val(); 
            function getInput(type, activCode){
                var activCode = activCode;
                cantida_clasificador<?php echo $codigo_actividad; ?> = cantida_clasificador<?php echo $codigo_actividad; ?> +1;
                var nombre_capa = '.'+activCode+cantida_clasificador<?php echo $codigo_actividad; ?>;
            
                var dta = '<tr class="'+activCode+cantida_clasificador<?php echo $codigo_actividad; ?>+'"><td style="width: 65%"><div class="form-label-group form-group">'+select_info<?php echo $codigo_actividad; ?>+'</div></td><td style="width: 30%"><div class="form-label-group form-group"><input type="text" class="form-control caja_texto_sizer puntos_miles_valor" placeholder="$......." name="valor_clasificador<?php echo $codigo_actividad; ?>[]" aria-describedby="textHelp" value="" required></div></td><td style="width: 5%"><i class="fas fa-minus fa-lg color_icono" onclick="eliminar_clasificador<?php echo $codigo_actividad; ?>(\''+nombre_capa+'\')"></i><td></tr>'
                nombre_capa = '';
                return dta;
            }

            function append(className, nodoToAppend){
                var nodo = document.getElementsByClassName(className)[0];
                $('.'+className).append(nodoToAppend);

                $('.selectpicker<?php echo $codigo_actividad;?>').selectpicker({
                    liveSearch: true,
                    maxOptions: 1
                });

                $(".puntos_miles_valor").on({
                    "focus": function (event) {
                        $(event.target).select();
                    },
                    "keyup": function (event) {
                        $(event.target).val(function (index, value ) {
                            return value.replace(/\D/g, "").replace(/([0-9])([0-9]{0})$/, '$1').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
                        });
                    }
                });
            }
            
            function Agregaitems<?php echo $codigo_actividad; ?>(activCode){
                cargar_select();
                var activCode = activCode;

                var nodo_clasificacion = getInput("text", activCode);
                append("tablaClasificadores"+activCode, nodo_clasificacion);
            }     
        </script>
        <?php
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

