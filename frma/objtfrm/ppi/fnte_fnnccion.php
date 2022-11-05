<?php
    include('crud/rs/ppi/ppi.php');

    $codigo_plan = $_REQUEST['codigo_plan'];

    $tipo_fuente = $_REQUEST['tipo_fuente'];

    $list_fuente = $objPPI->list_fuente_financiacion($codigo_plan, $tipo_fuente);
?>
<label for="selFuenteFinanciacion" class="font-weight-bold">Fuente de Financiaci&oacute;n *</label>
<select name="selFuenteFinanciacion" id="selFuenteFinanciacion"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
<option value="0"> Seleccione ...</option>
    <?php
        if($list_fuente){
            foreach ($list_fuente as $data_tipo_fuente) {
                $ffi_codigo = $data_tipo_fuente['ffi_codigo'];
                $ffi_nombre = $data_tipo_fuente['ffi_nombre'];
        
    ?>
        <option value="<?php echo  $ffi_codigo; ?>" ><?php echo $ffi_nombre; ?></option>
    <?php
            }
        }
        else{
    ?>
        <option value="0"> No hay fuentes de Financiacion</option>
    <?php
        }
    ?>
</select>
<span class="help-block" id="error"></span>

<script>
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>