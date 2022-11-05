<?php
    include('crud/rs/poai/poai.php');
    $codigo_accion = $_REQUEST['codigo_accion'];
    $codigo_sede = $_REQUEST['codigo_sede'];

    $indicador_accion_sede = $objPoai->indicador_accion_sede($codigo_accion, $codigo_sede);

?>
<label for="selIndicador" class="font-weight-bold">Indicador *</label>
<select name="selIndicador" id="selIndicador"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required>
<option value="0" data-tipo_fuente="0"> Seleccione ...</option>
    <?php
        if($indicador_accion_sede){
            foreach ($indicador_accion_sede as $dta_indcdor) {
                $ind_codigo = $dta_indcdor['ind_codigo'];
                $ind_unidadmedida = $dta_indcdor['ind_unidadmedida'];
        
    ?>
        <option value="<?php echo  $ind_codigo; ?>" ><?php echo substr($ind_unidadmedida,0,33)."..."; ?></option>
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

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>