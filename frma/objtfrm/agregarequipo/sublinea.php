<?php
    include('crud/rs/formpdi/formpdi.php');

    $codigo_linea = $_REQUEST['codigo_linea'];
    
    $list_sublinea = $objFormpdi->list_sublinea($codigo_linea);
?>
<label for="selSublineaEquipo" class="font-weight-bold"> Sublinea de equipo</label>
<select name="selSublineaEquipo" id="selSublineaEquipo" class="form-control caja_texto_sizer selectpickersublineaagregar" data-rule-required="true" required>
    <option value="0" data-codigo_sublinea="0">Seleccione...</option>
    <?php
        foreach ($list_sublinea as $data_sublinea) {
            $slin_codigo=$data_sublinea['slin_codigo'];
            $slin_nombre=$data_sublinea['slin_nombre'];

    ?>
        <option value="<?php echo  $slin_codigo; ?>"data-codigo_sublinea="<?php echo $slin_codigo; ?>"><?php echo $slin_nombre; ?></option>
    <?php
        }
    ?>
</select>
<span class="help-block" id="error"></span>


<script>
    $('.selectpickersublineaagregar').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

</script>