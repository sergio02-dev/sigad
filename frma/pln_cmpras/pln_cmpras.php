<?php

   $codigo_poai = $_REQUEST['codigo_poai'];
   $codigo_accion = $_REQUEST['codigo_accion'];   
   
   include('crud/rs/pln_cmpras/pln_cmpras.php');

   $datos_etapa = $objPlanCompras->datos_etapa($codigo_poai);

    $url_guardar="registroplancompras";
    $codigo_formulario = $codigo_poai;
    $tarea = "REGISTRAR";
    $checkedA="checked";
    $checkedI="";
    $valor_uni = 0;
    $cantidad = 0;
?>
<form id="plancompraform" role="form">
    <div class="modal-header fondo-titulo">
        <h3 class="modal-title"><strong><?php echo $tarea; ?> PLAN DE COMPRAS</strong></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <p class="font-weight-bold">* Campos obligatorios </p>
        <!-- ******************** INICIO FORMULARIO ************************* -->

        
        <div class="row">
            <div class="col-md-12">
                <p style="font-size: 113%;"><?php echo $datos_etapa; ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">&nbsp;</div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="txtDescripcion" class="font-weight-bold">Descripci&oacute;n *</label>
                    <textarea class="form-control caja_texto_sizer" rows="4" name="txtDescripcion" id="txtDescripcion" aria-describedby="textHelp" data-rule-required="true"  required><?php echo $poa_objeto; ?></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="txtCantidad" class="font-weight-bold">Cantidad *</label>
                    <input type="number" class="form-control caja_texto_sizer sma" id="txtCantidad" name="txtCantidad" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $cantidad;?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="txtValorUnitario" class="font-weight-bold">Valor Unitario *</label>
                    <input type="text" class="form-control caja_texto_sizer sma" id="txtValorUnitario" name="txtValorUnitario" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $valor_uni; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="txtValorTotal" class="font-weight-bold">Valor Total *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtValorTotal" name="txtValorTotal" aria-describedby="textHelp" data-rule-required="false" value="<?php echo $poa_logroejecutado; ?>" readonly>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="textNumeroVeces" class="font-weight-bold">Estado *</label>
                    <div class="radio tipo1">
                        <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                        <label for="ractivo">&nbsp; Activo &nbsp;&nbsp;</label>

                        <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> required />
                        <label for="rinactivo">&nbsp; Inactivo</label>
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>            
        </div>
    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigo_formulario" id="codigo_formulario" value="<?php echo $codigo_formulario; ?>">
        <input type="hidden" name="codigo_accion" id="codigo_accion" value="<?php echo $codigo_accion; ?>">
        <input type="hidden" name="codigo_poai" id="codigo_poai" value="<?php echo $codigo_poai; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_plancompra();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>

<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_plan_compras.js"></script>
<script type="text/javascript">

    //Funcion para ponerle punto a una variable que se genera por medio de la resta o suma de dos variables.
    function numberWithCommas(formatoNumero) {
        return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $("#txtValorUnitario").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value ) {
                return value.replace(/\D/g, "").replace(/([0-9])([0-9]{0})$/, '$1').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
        }
    });

    $('.sma').change(function(){
        var undades = $('#txtCantidad').val();
        var str = $('#txtValorUnitario').val();
        var valor_unidades = 0;

        valor_unidades = str.toString().replace(/\./g,'');
        
        var total = undades * valor_unidades;

        $('#txtValorTotal').val(numberWithCommas(total));
    });

</script>
