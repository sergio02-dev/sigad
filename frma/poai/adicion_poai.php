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
    
    $codigo_adicion = $_REQUEST['codigo_adicion'];

    if($codigo_adicion){
        $list_saldo_disponible = $objPoai->list_saldo_disponible($codigo_adicion);
        $url_guardar="modificaradicionpoai";
        $task = "MODIFICAR ADICIÓN POAI";

        $form_adicion = $objPoai->form_adicion($codigo_adicion);

        foreach ($form_adicion as $dat_form_adicion) {
            $apoai_codigo = $dat_form_adicion['apoai_codigo'];
            $apoai_poai = $dat_form_adicion['apoai_poai'];
            $apoai_saldo = $dat_form_adicion['apoai_saldo'];
            $apoai_valor = $dat_form_adicion['apoai_valor'];
            $apoai_estado = $dat_form_adicion['apoai_estado'];
        }

        if($apoai_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }

        if($apoai_estado == 0){
            $checkedA = "";
            $checkedI = "checked";
        }

        $sldoo = $objPoai->saldo_disponible($apoai_saldo, $codigo_adicion);
    }
    else{
        $url_guardar="registroadicionpoai";
        $task = "REGISTRAR ADICIÓN POAI";
        $checkedA = "checked";
        $checkedI = "";

        $list_saldo_disponible = $objPoai->list_saldo_disponible(0);
    }

    $capa_direccion = "#info_poai".$codigo_poai;
    $url_direccion = "infopoai?codigo_plan=".$codigo_plan."&codigo_poai=".$codigo_poai;
    
?>
<form id="adicionform" role="form">
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
                    <label for="selFuenteFinanciacion" class="font-weight-bold">Fuente de Financiaci&oacute;n *</label>
                    <select name="selFuenteFinanciacion" id="selFuenteFinanciacion"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
                    <option value="0" data-tipo_fuente="0"> Seleccione ...</option>
                        <?php
                            if($list_saldo_disponible){
                                foreach ($list_saldo_disponible as $dta_list_sldo_dsponible) {
                                    $codigo = $dta_list_sldo_dsponible['codigo'];
                                    $vigencia = $dta_list_sldo_dsponible['vigencia'];
                                    $fuente = $dta_list_sldo_dsponible['fuente'];
                                    $saldo_disponible = $dta_list_sldo_dsponible['saldo_disponible'];

                                    $dscrpcion = $vigencia." ".$fuente." ".number_format($saldo_disponible,0,'','.');

                                    if($codigo == $apoai_saldo){
                                        $selected_fuente = "selected";
                                    }
                                    else{
                                        $selected_fuente = "";
                                    }
                            
                        ?>
                            <option value="<?php echo  $codigo; ?>" data-saldo_disp="<?php echo $saldo_disponible; ?>" <?php echo $selected_fuente; ?>><?php echo $dscrpcion; ?></option>
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
                    <input type="hidden" name="sldoo" id="sldoo" value="<?php echo $sldoo; ?>">
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtSaldo" class="font-weight-bold">Valor *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtSaldo" name="txtSaldo" aria-describedby="textHelp" data-rule-required="true" value="<?php echo number_format($apoai_valor,0,'','.'); ?>" required>
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
        <input type="hidden" name="codigo_plan" id="codigo_plan" value="<?php echo $codigo_plan; ?>">
        <input type="hidden" name="codigo_poai" id="codigo_poai" value="<?php echo $codigo_poai; ?>">
        <input type="hidden" name="codigo_adicion" id="codigo_adicion" value="<?php echo $codigo_adicion; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_adicion();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_adicion.js"></script>

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

    $('#selFuenteFinanciacion').change(function(){
        var saldo_disp = $(this).find(':selected').data('saldo_disp');

        $('#sldoo').val(saldo_disp);
      
    });



</script>

