<?php
    include('crud/rs/equipopdi/equipopdi.php');

    $codigo_linea = $_REQUEST['codigo_linea'];

    $list_sublinea = $objEquipoPdi->list_sublinea($codigo_linea);
?>
<label for="selSublineaEquipo" class="font-weight-bold"> Sublinea de equipo</label>
<select name="selSublineaEquipo" id="selSublineaEquipo" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
    <option value="0">Seleccione...</option>
    <?php
        foreach ($list_sublinea as $data_sublinea) {
            $slin_codigo=$data_sublinea['slin_codigo'];
            $slin_nombre=$data_sublinea['slin_nombre'];

        if($per_tipoidentificacion==$slin_codigo){
            $select_sublinea="selected";
        }
        else{
            $select_sublinea="";
        }
    ?>
        <option value="<?php echo  $slin_codigo; ?>"<?php echo $select_sublinea; ?>><?php echo $slin_nombre; ?></option>
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