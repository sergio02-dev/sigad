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

    $nombre_nivel_tres = $objPoai->nombre_nivel_tres($codigo_plan);

    $list_acciones_plan = $objPoai->list_acciones_plan($codigo_plan);

    list($anio_inicio, $anio_fin) = $objPoai->anios_plan($codigo_plan);

    $list_fuente_financiacion = $objPoai->list_fuente_financiacion();

    $list_sede = $objPoai->list_sede();

    if($codigo_poai){
        $url_guardar="modificarpoai";
        $task = "MODIFICAR SALDO FUENTE";

        $form_poai = $objPoai->form_poai($codigo_poai);

        foreach ($form_poai as $dat_form_poai) {
            $poav_codigo = $dat_form_poai['poav_codigo'];
            $poav_accion = $dat_form_poai['poav_accion'];
            $poav_fuentefinanciacion = $dat_form_poai['poav_fuentefinanciacion'];
            $poav_sede = $dat_form_poai['poav_sede'];
            $poav_recurso = $dat_form_poai['poav_recurso'];
            $poav_estado = $dat_form_poai['poav_estado'];
            $poav_vigencia = $dat_form_poai['poav_vigencia'];
            $poav_indicador = $dat_form_poai['poav_indicador'];
        }

        if($poav_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }

        if($poav_estado == 0){
            $checkedA = "";
            $checkedI = "checked";
        }

        
    }
    else{
        $url_guardar="registropoai";
        $task = "REGISTRAR POAI";
        $checkedA = "checked";
        $checkedI = "";
        $poav_vigencia = 2022;
        $acto_poai = "none";
    }

    $capa_direccion = ".capa_poai";
    $url_direccion = "dtapoai?codigo_plandesarrollo=".$codigo_plan;
    
?>
<form id="poaiform" role="form">
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
                    <label for="selAccion" class="font-weight-bold"> <?php echo strtoupper(tildes($nombre_nivel_tres)); ?> *</label>
                    <select name="selAccion" id="selAccion"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                    <option value="0" data-accion="0"> Seleccione ...</option>
                        <?php
                            if($list_acciones_plan){
                                foreach ($list_acciones_plan as $dta_list_acciones) {
                                    $acc_codigo = $dta_list_acciones['acc_codigo'];
                                    $sub_referencia = $dta_list_acciones['sub_referencia'];
                                    $acc_referencia = $dta_list_acciones['acc_referencia'];
                                    $acc_numero = $dta_list_acciones['acc_numero'];
                                    $acc_descripcion = $dta_list_acciones['acc_descripcion'];
                                    

                                    if($codigo_plan == 1){
                                        $descrpcion = $sub_referencia.".".$acc_referencia." ".$acc_descripcion;
                                    }
                                    else{
                                        $descrpcion = $acc_referencia.".".$acc_numero." ".$acc_descripcion;
                                    }

                                    if($poav_accion == $acc_codigo){
                                        $selected_accion = "selected";
                                    }
                                    else{
                                        $selected_accion = "";
                                    }
                            
                        ?>
                            <option value="<?php echo  $acc_codigo; ?>" data-accion="<?php echo $acc_codigo; ?>" <?php echo $selected_accion; ?>><?php echo substr($descrpcion,0,105)."..."; ?></option>
                        <?php
                                }
                            }
                            else{
                        ?>
                            <option value="0" data-accion="<?php echo $acc_codigo; ?>"> No hay <?php echo strtoupper(tildes($nombre_nivel_tres)); ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selFuenteFinanciacion" class="font-weight-bold">Fuente de Financiaci&oacute;n *</label>
                    <select name="selFuenteFinanciacion" id="selFuenteFinanciacion"  class="form-control caja_texto_sizer selectpickerfuente" data-size="8" data-rule-required="true" required>
                    <option value="0" data-tipo_fuente="0"> Seleccione ...</option>
                        <?php
                            if($list_fuente_financiacion){
                                foreach ($list_fuente_financiacion as $dta_fuentes_fnnccion) {
                                    $ffi_codigo = $dta_fuentes_fnnccion['ffi_codigo'];
                                    $ffi_nombre = $dta_fuentes_fnnccion['ffi_nombre'];

                                    if($poav_fuentefinanciacion == $ffi_codigo){
                                        $selected_fuente = "selected";
                                    }
                                    else{
                                        $selected_fuente = "";
                                    }
                            
                        ?>
                            <option value="<?php echo  $ffi_codigo; ?>" <?php echo $selected_fuente; ?>><?php echo $ffi_nombre; ?></option>
                        <?php
                                }
                            }
                            else{
                        ?>
                            <option value="0"> No hay Fuentes de Financiaci&oacute;n</option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selVigencia" class="font-weight-bold">Vigencia *</label>
                    <select name="selVigencia" id="selVigencia"  class="form-control caja_texto_sizer selectpickervigencia" data-size="8" data-rule-required="true" required>
                    <option value="0" > Seleccione ...</option>
                        <?php
                            for ($list_vigencia=$anio_inicio; $list_vigencia <= $anio_fin; $list_vigencia++) { 
                                   
                                if($list_vigencia == $poav_vigencia){
                                    $selected_vigencia = "selected";
                                }
                                else{
                                    $selected_vigencia = "";
                                }
                        ?>
                            <option value="<?php echo  $list_vigencia; ?>" <?php echo $selected_vigencia; ?>><?php echo $list_vigencia; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="selSede" class="font-weight-bold">Sede *</label>
                    <select name="selSede" id="selSede"  class="form-control caja_texto_sizer selectpickersede" data-size="8" data-rule-required="true" required>
                    <option value="0" data-sede_cod="0"> Seleccione ...</option>
                        <?php
                            if($list_sede){
                                foreach ($list_sede as $dta_lsta_sede) {
                                    $sed_codigo = $dta_lsta_sede['sed_codigo'];
                                    $sed_nombre = $dta_lsta_sede['sed_nombre'];

                                    if($sed_codigo == $poav_sede){
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
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group indc">
                    <label for="selIndicador" class="font-weight-bold">Indicador *</label>
                    <select name="selIndicador" id="selIndicador"  class="form-control caja_texto_sizer selectpickerindicador" data-size="8" data-rule-required="true" required>
                    <option value="0" data-tipo_fuente="0"> Seleccione ...</option>
                        <?php
                        if($codigo_poai){
                            $indicador_accion_sede = $objPoai->indicador_accion_sede($poav_accion, $poav_sede);
                            if($indicador_accion_sede){
                                foreach ($indicador_accion_sede as $dta_indcdor) {
                                    $ind_codigo = $dta_indcdor['ind_codigo'];
                                    $ind_unidadmedida = $dta_indcdor['ind_unidadmedida'];

                                    if($poav_indicador == $ind_codigo){
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
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="txtSaldo" class="font-weight-bold">Valor *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtSaldo" name="txtSaldo" aria-describedby="textHelp" data-rule-required="true" value="<?php echo number_format($poav_recurso,0,'','.'); ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>

            
        </div>

        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <input id="adicionPoai" class="checkAdicion" name="adicionPoai" type="checkbox" value="1" <?php echo $checked_fuentes; ?> data-rule-required="true" required>
                    <label for="txtEstado" class="font-weight-bold">Adici&oacute;n *</label>
                </div>
            </div>

            <div class="col-sm-4 actoPoai">
                <div class="form-group">
                    <label for="selAcuerdo" class="font-weight-bold">Acuerdo *</label>
                    <select name="selAcuerdo" id="selAcuerdo"  class="form-control caja_texto_sizer selectpickeracuerdo" data-size="8" data-rule-required="true" required>
                    <option value="0" data-tipo_fuente="0"> Seleccione ...</option>
                        <?php
                            $list_acuerdo = $objPoai->list_acuerdo($poav_accion, $poav_sede);
                            if($list_acuerdo){
                                foreach ($list_acuerdo as $dta_indcdor) {
                                    $ind_codigo = $dta_indcdor['ind_codigo'];
                                    $ind_unidadmedida = $dta_indcdor['ind_unidadmedida'];

                                    if($poav_indicador == $ind_codigo){
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
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
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
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="codigo_plan" id="codigo_plan" value="<?php echo $codigo_plan; ?>">
        <input type="hidden" name="codigo_poai" id="codigo_poai" value="<?php echo $codigo_poai; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_poai();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_poai.js"></script>

<script type="text/javascript">

    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('.selectpickerfuente').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
    
    $('.selectpickervigencia').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('.selectpickersede').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('.selectpickerindicador').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
    
    $('.selectpickeracuerdo').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
    
    
    

    

   /* $('.checkAdicion').change(function(){
        var adiicion =$('input:checkbox[name=adicionPoai]:checked').val();
        if(adiicion){
            $('.actoPoai').fadeIn(100);
        }
        else{
            $('.actoPoai').fadeOut(100);
        }
    });*/


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

