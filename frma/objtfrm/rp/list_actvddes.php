<?php
    include('crud/rs/rp/rprte_rp.php');

    $codigo_accion = $_REQUEST['codigo_accion'];

    $list_nivel_cuatro = $objRprteRP->list_nivel_cuatro($codigo_accion);

?>
<div class="col-md-12">
    <div class="form-group">
        <label for="selActividad" class="font-weight-bold"> Actividad *</label>
        <select name="selActividad" id="selActividad" class="form-control caja_texto_sizer selectpickerActividad" data-rule-required="true">
            <option value="0">Seleccione...</option>
            <?php
            foreach ($list_nivel_cuatro as $dat_nivel_cuatro) {
                $acp_codigo = $dat_nivel_cuatro['acp_codigo'];
                $acp_referencia = $dat_nivel_cuatro['acp_referencia'];
                $acp_numero = $dat_nivel_cuatro['acp_numero'];
                $acp_descripcion = $dat_nivel_cuatro['acp_descripcion'];

                $descrpcion = $acp_referencia.".".$acp_numero." ".$acp_descripcion;

            ?>
                <option value="<?php echo $acp_codigo; ?>"><?php echo substr($descrpcion,0,85); ?> ...</option>
            <?php
                }
            ?>
        </select>
        <div class="alert alert-danger alerta-forcliente" id="error_actividad" role="alert"></div>
    </div>
</div>

<script type="text/javascript">

    $('.selectpickerActividad').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>