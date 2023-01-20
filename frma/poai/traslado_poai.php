<?php
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }

    include('crud/rs/poai/poai.php');

    $codigo_plan = $_REQUEST['codigo_plan'];
    $codigo_poai = $_REQUEST['codigo_poai'];

    $list_acciones_plan = $objPoai->list_acciones_plan($codigo_plan);

    $list_sede = $objPoai->list_sede();

    $codigo_traslado = $_REQUEST['codigo_traslado'];

    if($codigo_traslado){
        $url_guardar="modificartraslados";
        $task = "MODIFICAR TRASLADO POAI";

        $form_traslado = $objPoai->form_traslado($codigo_traslado);

        foreach ($form_traslado as $dat_frma_traslado) {
            $tpo_codigo = $dat_frma_traslado['tpo_codigo'];
            $tpo_poai = $dat_frma_traslado['tpo_poai'];
            $tpo_accion = $dat_frma_traslado['tpo_accion'];
            $tpo_codigorecuerso = $dat_frma_traslado['tpo_codigorecuerso'];
            $tpo_valor = $dat_frma_traslado['tpo_valor'];
            $tpo_acuerdo = $dat_frma_traslado['tpo_acuerdo'];
            $tpo_sede = $dat_frma_traslado['tpo_sede'];
            $tpo_indicador = $dat_frma_traslado['tpo_indicador'];
            $tpo_estado = $dat_frma_traslado['tpo_estado'];
        }

        if($tpo_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }

        if($tpo_estado == 0){
            $checkedA = "";
            $checkedI = "checked";
        }

        $maximo_recursos = $tpo_valor; 
        $rcrsos_trasladar = $objPoai->rcrsos_trasladar($codigo_poai, $codigo_traslado);
    }
    else{
        $url_guardar="registrotraslado";
        $task = "REGISTRO TRASLADO POAI";
        $checkedA = "checked";
        $checkedI = "";
        $maximo_recursos = 0;
        $rcrsos_trasladar = $objPoai->rcrsos_trasladar($codigo_poai, 0);


    }

    

    $capa_direccion = ".capa_poai";
    $url_direccion = "dtapoai?codigo_plandesarrollo=".$codigo_plan;
?>
<style>
    .alert.alert-danger.alerta-forcliente{
        display: none;
        padding: 0;
        color: red ;
        font-weight: bold;
    }
</style>
<form id="trasladopoaiform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?></strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->    
        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selAccion" class="font-weight-bold">Acción *</label>
                    <select name="selAccion" id="selAccion"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                        <option value="0"> Seleccione ...</option>
                        <?php
                            if($list_acciones_plan){
                                foreach ($list_acciones_plan as $dat_acciones) {
                                    $acc_codigo = $dat_acciones['acc_codigo']; 
                                    $acc_referencia = $dat_acciones['acc_referencia'];
                                    $acc_descripcion = $dat_acciones['acc_descripcion'];
                                    $acc_proyecto = $dat_acciones['acc_proyecto'];
                                    $acc_numero = $dat_acciones['acc_numero']; 
                                    $sub_referencia = $dat_acciones['sub_referencia'];

                                    $descrpcion = $acc_referencia.".".$acc_numero." ".$acc_descripcion;

                                    if($acc_codigo == $tpo_accion){
                                        $selected_accion = "selected";
                                    }
                                    else{
                                        $selected_accion = "";
                                    }
                            
                        ?>
                            <option value="<?php echo  $acc_codigo; ?>" <?php echo $selected_accion; ?>><?php echo substr($descrpcion,0,100)."..."; ?></option>
                        <?php
                                }
                            }
                            else{
                        ?>
                            <option value="0"> No hay Datos</option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                    <div class="alert alert-danger alerta-forcliente" id="error_accion" role="alert"></div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selAcuerdo" class="font-weight-bold">Acuerdo *</label>
                    <select name="selAcuerdo" id="selAcuerdo"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                    <option value="0" data-tipo_fuente="0"> Seleccione ...</option>
                        <?php
                            $list_acuerdo = $objPoai->list_acuerdo();
                            if($list_acuerdo){
                                foreach ($list_acuerdo as $dat_acuerdo) {
                                    $aad_codigo = $dat_acuerdo['aad_codigo'];
                                    $add_nombre = $dat_acuerdo['add_nombre'];

                                    $caracteres = strlen($add_nombre);
                                    if($caracteres > 60){
                                        $descripcion = substr($add_nombre,0,100)."...";
                                    }
                                    else{
                                        $descripcion = $add_nombre;
                                    }

                                    if($aad_codigo == $tpo_acuerdo){
                                        $selectAcuerdo = "selected";
                                    }
                                    else{
                                        $selectAcuerdo = "";
                                    }
                            
                        ?>
                            <option value="<?php echo  $aad_codigo; ?>" <?php echo $selectAcuerdo; ?>><?php echo $descripcion; ?></option>
                        <?php
                                }
                            }
                            else{
                        ?>
                            <option value="0"> No hay Acuerdos</option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                    <div class="alert alert-danger alerta-forcliente" id="error_acuerdo" role="alert"></div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selRecurso" class="font-weight-bold">Recursos *</label>
                    <select name="selRecurso" id="selRecurso"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                    <option value="0" data-valor_recurso="0"> Seleccione ...</option>
                        <?php
                            if($rcrsos_trasladar){
                                foreach ($rcrsos_trasladar as $dat_rcrsos_trsldar) {
                                    $codigo_recursos = $dat_rcrsos_trsldar['codigo_recursos'];
                                    $valor_disponible = $dat_rcrsos_trsldar['valor_disponible'];
                                    $descrpcion = $dat_rcrsos_trsldar['descrpcion'];

                                    $caracteres = strlen($descrpcion);
                                    if($caracteres > 60){
                                        $descripcion = substr($descrpcion,0,100)."...";
                                    }
                                    else{
                                        $descripcion = $descrpcion;
                                    }

                                    if($codigo_recursos == $tpo_codigorecuerso){
                                        $selectedRecursos = "selected";
                                    }
                                    else{
                                        $selectedRecursos = "";
                                    }
                            
                        ?>
                            <option value="<?php echo  $codigo_recursos; ?>" <?php echo $selectedRecursos; ?> data-valor_recurso="<?php echo $valor_disponible; ?>"><?php echo $descripcion; ?></option>
                        <?php
                                }
                            }
                            else{
                        ?>
                            <option value="0"> No hay Acuerdos</option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                    <div class="alert alert-danger alerta-forcliente" id="error_recurso" role="alert"></div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="selSede" class="font-weight-bold">Sede *</label>
                    <select name="selSede" id="selSede"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                    <option value="0" data-sede_cod="0"> Seleccione ...</option>
                        <?php
                            if($list_sede){
                                foreach ($list_sede as $dta_lsta_sede) {
                                    $sed_codigo = $dta_lsta_sede['sed_codigo'];
                                    $sed_nombre = $dta_lsta_sede['sed_nombre'];

                                    if($sed_codigo == $tpo_sede){
                                        $selected_sede = "selected";
                                    }
                                    else{
                                        $selected_sede = "";
                                    }
                            
                        ?>
                            <option value="<?php echo  $sed_codigo; ?>" data-sede_cod="<?php echo  $sed_codigo; ?>" <?php echo $selected_sede; ?>><?php echo $sed_nombre; ?></option>
                        <?php
                                }
                            }
                            else{
                        ?>
                            <option value="0" data-sede_cod="0"> No hay Sedes</option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                    <div class="alert alert-danger alerta-forcliente" id="error_sede" role="alert"></div>

                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group indc">
                    <label for="selIndicador" class="font-weight-bold">Indicador *</label>
                    <select name="selIndicador" id="selIndicador"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                    <option value="0" data-tipo_fuente="0"> Seleccione ...</option>
                        <?php
                        if($codigo_traslado){
                            $indicador_accion_sede = $objPoai->indicador_accion_sede($tpo_accion, $tpo_sede);
                            if($indicador_accion_sede){
                                foreach ($indicador_accion_sede as $dta_indcdor) {
                                    $ind_codigo = $dta_indcdor['ind_codigo'];
                                    $ind_unidadmedida = $dta_indcdor['ind_unidadmedida'];

                                    if($ind_codigo == $tpo_indicador){
                                        $selectedIndicador = "selected";
                                    }
                                    else{
                                        $selectedIndicador = "";
                                    }
                            
                        ?>
                            <option value="<?php echo  $ind_codigo; ?>" <?php echo $selectedIndicador; ?>><?php echo substr($ind_unidadmedida,0,33)."..."; ?></option>
                        <?php
                                }
                            }
                            else{
                        ?>
                            <option value="0"> No Indicadores</option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
                <div class="alert alert-danger alerta-forcliente" id="error_indicador" role="alert"></div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="txtSaldo" class="font-weight-bold">Valor *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtSaldo" name="txtSaldo" aria-describedby="textHelp" data-rule-required="true" value="<?php echo number_format($tpo_valor,0,'','.'); ?>" required>
                    <span class="help-block" id="error"></span>
                    <div class="alert alert-danger alerta-forcliente" id="error_valor" role="alert"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtEstado" class="font-weight-bold">Estado *</label>
                    <div class="radio tipo1">
                        <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                        <label for="ractivo"><span></span> Activo</label>

                        <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> required />
                        <label for="rinactivo"><span></span> Inactivo</label>
                    </div>
                </div>
            </div>            
        </div>
        
        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigo_traslado" id="codigo_traslado" value="<?php echo $codigo_traslado; ?>">
        <input type="hidden" name="maximo_recursos" id="maximo_recursos" value="<?php echo $maximo_recursos; ?>">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="codigo_plan" id="codigo_plan" value="<?php echo $codigo_plan; ?>">
        <input type="hidden" name="codigo_poai" id="codigo_poai" value="<?php echo $codigo_poai; ?>">
        <input type="hidden" name="url_proceso" id="url_proceso" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="validar_traslados();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_trsldo.js"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    function numberWithCommas(formatoNumero) {
        return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $("#txtSaldo").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value ) {
                return value.replace(/\D/g, "").replace(/([0-9])([0-9]{0})$/, '$1').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
        }
    });

    $('#selRecurso').change(function(){
        var valor_recurso = $(this).find(':selected').data('valor_recurso');
        
        $('#maximo_recursos').val(valor_recurso);
    });

    $('#selAccion').change(function(){
        var codigo_accion = $(this).find(':selected').data('accion');
        var codigo_sede = $('#selSede').val();

        if(codigo_accion> 0 && codigo_sede > 0 ){
            $.ajax({
                url:"indicadoraccionsede",
                type:"POST",
                data:"codigo_accion="+codigo_accion+'&codigo_sede='+codigo_sede,
                async:true,

                success: function(message){
                    $(".indc").empty().append(message);
                }
            });

        }
    });

    $('#selSede').change(function(){
        var codigo_sede = $(this).find(':selected').data('sede_cod');
        var codigo_accion = $('#selAccion').val();

        if(codigo_accion> 0 && codigo_sede > 0 ){
            $.ajax({
                url:"indicadoraccionsede",
                type:"POST",
                data:"codigo_accion="+codigo_accion+'&codigo_sede='+codigo_sede,
                async:true,

                success: function(message){
                    $(".indc").empty().append(message);
                }
            });

        }
    });


</script>

