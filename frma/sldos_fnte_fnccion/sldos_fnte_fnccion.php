<?php
    include('crud/rs/sldos_fnte_fnccion/sldos_fnte_fnccion.php');

    $anio_inicio_plan = date('Y');

    $list_fuente_financiacion = $objSaldoFuenteFinanciacion->list_fuente_financiacion();

    $list_acuerdo = $objSaldoFuenteFinanciacion->list_acuerdo();

    $codigo_saldo_fuente = $_REQUEST['codigo_saldo_fuente'];

    if($codigo_saldo_fuente){
        $url_guardar="modificarsaldofuentefinanciacion";
        $task = "MODIFICAR RECURSOS DE BALANCE";

        $form_saldo_fuentes = $objSaldoFuenteFinanciacion->form_saldo_fuentes($codigo_saldo_fuente);

        foreach ($form_saldo_fuentes as $dta_frma_saldo_fuentes) {
            $sff_codigo= $dta_frma_saldo_fuentes['sff_codigo'];
            $sff_plan = $dta_frma_saldo_fuentes['sff_plan'];
            $sff_vigencia = $dta_frma_saldo_fuentes['sff_vigencia'];
            $sff_fuente = $dta_frma_saldo_fuentes['sff_fuente'];
            $sff_saldo = $dta_frma_saldo_fuentes['sff_saldo'];
            $sff_estado = $dta_frma_saldo_fuentes['sff_estado'];
            $sff_acto = $dta_frma_saldo_fuentes['sff_acto'];
        }

        $checkedA = "checked";
        $checkedI = "";
    }
    else{
        $url_guardar="registrosaldofuentefinanciacion";
        $task = "REGISTRAR RECURSOS DE BALANCE";
        $checkedA = "checked";
        $checkedI = "";
    }

    $capa_direccion = ".saldo_fuente";
    $url_direccion = "dtasaldosfuentefinanciacion";
    
?>
<form id="saldosfuentefinanciacionform" role="form">
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
                    <label for="selAcuerdoActo" class="font-weight-bold">Acuerdo *</label>
                    <select name="selAcuerdoActo" id="selAcuerdoActo" class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                    <option value="0"> Seleccione ...</option>
                        <?php
                            if($list_acuerdo){
                                foreach ($list_acuerdo as $dta_lsta_acuerdo) {
                                    $aad_codigo = $dta_lsta_acuerdo['aad_codigo'];
                                    $add_nombre = $dta_lsta_acuerdo['add_nombre'];

                                    if($sff_acto == $aad_codigo){
                                        $select_acuerdo = "selected";
                                    }
                                    else{
                                        $select_acuerdo = "";
                                    }
                            
                        ?>
                            <option value="<?php echo  $aad_codigo; ?>" <?php echo $select_acuerdo; ?>><?php echo substr($add_nombre, 0,90)."..."; ?></option>
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
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selFuenteFinanciacion" class="font-weight-bold">Fuente Financiaci&oacute;n *</label>
                    <select name="selFuenteFinanciacion" id="selFuenteFinanciacion"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                    <option value="0"> Seleccione ...</option>
                        <?php
                            if($list_fuente_financiacion){
                                foreach ($list_fuente_financiacion as $dta_lista_fuente_financiacion) {
                                    $ffi_codigo = $dta_lista_fuente_financiacion['ffi_codigo'];
                                    $ffi_nombre = $dta_lista_fuente_financiacion['ffi_nombre'];

                                    if($sff_fuente == $ffi_codigo){
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
                    <select name="selVigencia" id="selVigencia"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                    <option value="0" data-tipo_fuente="0"> Seleccione ...</option>
                        <?php
                            for ($list_vigencia=2017; $list_vigencia <= $anio_inicio_plan; $list_vigencia++) { 
                                   
                                if($list_vigencia == $sff_vigencia){
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
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtSaldo" class="font-weight-bold">Valor *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtSaldo" name="txtSaldo" aria-describedby="textHelp" data-rule-required="true" value="<?php echo number_format($sff_saldo,0,'','.'); ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6">
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
        <input type="hidden" name="codigo_saldo_fuente" id="codigo_saldo_fuente" value="<?php echo $codigo_saldo_fuente; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_saldo_fuente_financiacion();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_sldos_fnte_fnccion.js"></script>

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


</script>

