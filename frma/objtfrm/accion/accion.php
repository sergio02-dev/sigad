<?php
    include('crud/rs/formpdi/formpdi.php');

    $codigo_proyecto = $_REQUEST['codigo_proyecto'];

     
    $list_accion = $objFormpdi->list_accion($codigo_proyecto);
?>


<label for="selAccion" class="font-weight-bold">Accion</label>
<select name="selAccion" id="selAccion" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
    <option value="0"  data-codigo_caracteristicas="0">Seleccione la accion</option>
    <?php
        foreach ($list_accion as $data_tipoAccion) {
            $acc_codigo=$data_tipoAccion['acc_codigo'];
            $acc_referencia = $data_tipoAccion['acc_referencia'];
            $acc_descripcion=$data_tipoAccion['acc_descripcion'];
            $acc_numero = $data_tipoAccion['acc_numero']

    ?>
        <option value="<?php echo  $acc_codigo; ?>" data-descripcion="<?php echo $acc_descripcion; ?>"><?php echo $acc_referencia.'.'.$acc_numero.' '.$acc_descripcion ?></option>
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