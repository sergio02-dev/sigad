<?php 
    include('crud/rs/rprte_plan_accion/rprte_plan_accion.php');

    $accion_codigo = $_REQUEST['accion_codigo'];

    $list_actividades = $objRprtePlnAccion->list_actividades($accion_codigo);
?>
<style>
    .alert.alert-danger.alerta-forcliente{
        display: none;
        padding: 0;
        color: red ;
        font-weight: bold;
    }
</style>
<label for="selActividad" class="font-weight-bold"> Actividad *</label>
<select name="selActividad" id="selActividad" class="form-control caja_texto_sizer selectpickerActividad" data-rule-required="true" required>
    <option value="0">Seleccione...</option>
    <?php
        foreach ($list_actividades as $dta_actvdades) {
            $acp_codigo = $dta_actvdades['acp_codigo'];
            $acp_referencia = $dta_actvdades['acp_referencia'];
            $acp_numero = $dta_actvdades['acp_numero'];
            $acp_descripcion = $dta_actvdades['acp_descripcion'];

            $dscrpcion = $acp_referencia.".".$acp_numero." ".$acp_descripcion;

    
    ?>
        <option value="<?php echo  $acp_codigo; ?>" ><?php echo substr($dscrpcion,0,110); ?> ...</option>
    <?php
        }
    ?>
</select>
<div class="alert alert-danger alerta-forcliente" id="error_actividad" role="alert"></div>

<script type="text/javascript">
    $('.selectpickerActividad').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>